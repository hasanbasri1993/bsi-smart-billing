<?php

namespace Hasanbasri1993\BsiSmartBilling\Service;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BPIWeb
{
    public function __construct() {}

    public static function getToken()
    {
        if (Cache::get('bpi_token')) {
            return Cache::get('bpi_token');
        }
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
            Cache::put('bpi_token', $response['data']['access_token'], $response['data']['expires_in'] - 3600);

            // The 'data' is not null and contains 'access_token'
            return $response['data']['access_token'];
            // You can proceed with using the $token
        }

        return null;
    }

    public static function cariTagihan($keyword)
    {
        $token = self::getToken();
        try {
            $respond = Http::acceptJson()->withToken($token)->post(config('bsi-smart-billing.web_url').'tagihan/cari', [
                'id_institusi' => config('bsi-smart-billing.institute'),
                'keyword' => $keyword,
            ]);
        } catch (ConnectionException $e) {
            Log::error('Error cariTagihan: '.$e->getMessage());

            return null;
        }
        $response = $respond->json();  // Assuming this fetches JSON response
        if (! empty($response['data']) && $response['status'] == 'OK') {
            return $response['data'][0]['id_tagihan'];
        }

        return null;
    }

    public static function hapusTagihan($id_tagihan): bool
    {
        $token = self::getToken();
        try {
            $respond = Http::acceptJson()->withToken($token)->post(config('bsi-smart-billing.web_url').'tagihan/hapus', [
                'id_institusi' => config('bsi-smart-billing.institute'),
                'id_tagihan' => [
                    $id_tagihan,
                ],
            ]);
        } catch (ConnectionException $e) {
            Log::error('Error hapusTagihan: '.$e->getMessage());

            return false;
        }
        $response = $respond->json();  // Assuming this fetches JSON response
        if (! empty($response['data']) && $response['status'] == 'OK') {
            return true;
        }

        return false;
    }
}
