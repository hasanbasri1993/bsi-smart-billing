<?php

// config for Hasanbasri1993/BsiSmartBilling
return [
    'url' => env('BSI_SMARTBILLING_URL', 'https://sandbox.smartbilling.co.id/api/v1/'),
    'client_id' => env('BSI_SMARTBILLING_CLIENT_ID'),
    'client_secret' => env('BSI_SMARTBILLING_CLIENT_SECRET'),
    'web_url' => env('BPI_WEB_URL', 'https://sandbox.api.bpi.co.id/api/smartbilling/'),
    'username' => env('BPI_USERNAME', ''),
    'password' => env('BPI_PASSWORD', ''),
];
