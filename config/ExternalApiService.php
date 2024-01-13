<?php
// components/ExternalApiService.php

namespace app\components;

use yii\httpclient\Client;

class ExternalApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchInventoryDetails($itemId)
    {
        $response = $this->client->get('inventory/details', ['item_id' => $itemId])->send();

        if ($response->isOk) {
            $data = $response->data;
            // Process and store data in the local database
            // ...

            return $data;
        } else {
            // Handle error
            return null;
        }
    }
}
