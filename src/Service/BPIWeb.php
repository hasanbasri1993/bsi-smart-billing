<?php

namespace Hasanbasri1993\BsiSmartBilling\Service;

use Hasanbasri1993\BsiSmartBilling\Models\InqueryTagihan;
use Illuminate\Http\Client\ConnectionException;
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

    public static function inqueryTagihan($id_tagihan): InqueryTagihan
    {
        $token = self::getToken();
        try {
            // //{"id_institusi":"a706e8d82c09a035fdefaf76ba7b86c1","nomor_pembayaran":"216112","kanal_pembayaran":"FLAGGING"}
            $respond = Http::acceptJson()->withToken($token)->post(config('bsi-smart-billing.web_url').'tools/switching-inquiry', [
                'id_institusi' => config('bsi-smart-billing.institute'),
                'nomor_pembayaran' => $id_tagihan,
                'kanal_pembayaran' => 'FLAGGING',
            ]);
        } catch (ConnectionException $e) {
            Log::error('Error inqueryTagihan: '.$e->getMessage());

            return new InqueryTagihan([]);
        }

        return new InqueryTagihan($respond->json() ?? []);
    }

    public static function switchingPayment($id_tagihan, $total_nominal, $catatan): InqueryTagihan
    {
        $token = self::getToken();
        try {
            // {"id_institusi":"a706e8d82c09a035fdefaf76ba7b86c1","nomor_pembayaran":"216112","total_nominal":326500,"catatan":"asd asd asd ","kanal_pembayaran":"FLAGGING"}
            $respond = Http::acceptJson()->withToken($token)->post(config('bsi-smart-billing.web_url').'tools/switching-payment', [
                'id_institusi' => config('bsi-smart-billing.institute'),
                'nomor_pembayaran' => $id_tagihan,
                'catatan' => $catatan,
                'total_nominal' => $total_nominal,
                'kanal_pembayaran' => 'FLAGGING',
            ]);
        } catch (ConnectionException $e) {
            Log::error('Error switchingPayment: '.$e->getMessage());

            return new InqueryTagihan([]);
        }

        return new InqueryTagihan($respond->json() ?? []);
    }
}
