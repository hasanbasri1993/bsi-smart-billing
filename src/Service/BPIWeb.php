<?php

namespace Hasanbasri1993\BsiSmartBilling\Service;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BPIWeb
{
    public function __construct() {}

    public static function getToken()
    {
        try {
            $respond = Http::acceptJson()->post(config('bsi-smart-billing.web_url').'otentikasi/login-user-password', [
                'username' => config('bsi-smart-billing.username'),
                'password' => config('bsi-smart-billing.password'),
            ]);
        } catch (ConnectionException $e) {
            Log::error('Error getToken: '.$e->getMessage());

            return null;
        }
        $response = $respond->json();  // Assuming this fetches JSON response

        if (! empty($response['data']) && isset($response['data']['access_token'])) {
            // The 'data' is not null and contains 'access_token'
            return $response['data']['access_token'];
            // You can proceed with using the $token
        }

        return null;
    }
}
