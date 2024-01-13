<?php

return [
    'components' => [
        'googleApi' => [
            'class' => 'yii\httpclient\Client',
            'baseUrl' => 'https://www.googleapis.com/customsearch/v1',
            'requestConfig' => [
                'format' => yii\httpclient\Client::FORMAT_JSON,
            ],
        ],
        'googleApiKey' => 'AIzaSyDp4oPYZ4qOdfUlKpD-7S8hpAYWFTNEBFM', // Replace with your actual API key
    ],
];
