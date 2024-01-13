<?php

use yii\web\Controller;
use yii\httpclient\Client;

class YourController extends Controller
{
    public function actionFetchExternalData($barcode)
    {
        // External API endpoint for fetching inventory details
        $apiEndpoint = "https://api.example.com/inventory-details/$barcode";

        try {
            // Use Yii HTTP client to send a GET request to the external API
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($apiEndpoint)
                ->send();

            // Check if the request was successful (HTTP status code 200)
            if ($response->isOk) {
                $data = $response->data;

                // Assuming 'external_data' is a column in your 'post' table
                Yii::$app->db->createCommand()->update('post', ['external_data' => json_encode($data)], ['barcode' => $barcode])->execute();

                Yii::$app->session->setFlash('success', 'External data fetched and stored successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to fetch external data. Please try again.');
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'An error occurred: ' . $e->getMessage());
        }

        return $this->redirect(['index']); // Redirect to your desired page
    }
}
