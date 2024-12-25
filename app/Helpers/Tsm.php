<?php

namespace App\Helpers;

use App\Jobs\PushElastic;
use App\Jobs\PushLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Tsm
{

    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function header($body)
    {
        $header['alg']    = "HS256";
        $header['typ']    = "JWT";

        $jsonHeader    = json_encode($header, JSON_UNESCAPED_SLASHES);

        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);

        // $headerPart = base64_encode($jsonHeader);
        // $bodyPart = rtrim(base64_encode($jsonBody),'=');
        $headerPart = $this->base64url_encode($jsonHeader);
        $bodyPart = $this->base64url_encode($jsonBody);
        $headerBodyPart = $headerPart . '.' . $bodyPart;
        $key = $body['app_code'] == 'BALICASH' ? env('TSM_KEY_BALICASH') : env('TSM_KEY_YESPOS');
        $barerPart = hash_hmac('sha256', utf8_encode($headerBodyPart), $key, true);

        $signature = $this->base64url_encode($barerPart);
        $headerToken = $headerPart . '.' . $bodyPart . '.' . $signature;
        //End Generate Signature
        //dd($headerToken);
        return [
            'signature' => $headerToken,
            'body' => $jsonBody
        ];
    }

    public function GenerateAPPLink($data)
    {
        if ($data['trx_id']) {
            # code...
        }
        //Request Body//
        $body['app_code']    = $data['app_code'];
        $body['amount']    =  $data['amount'];
        $body['partner_trx_id']    =    $data['trx_id'];
        $body['terminal_code']    = $data['terminal_code'];
        $body['merchant_code']    = $data['merchant_code'];
        $body['payment_method']    = "CARD";
        $body['timestamp']    = round(microtime(true) * 1000);


        //dd($body);
        $header = $this->header($body);

        $curl = curl_init();

        $baseUrl = env('TSM_BASE', 'https://tph-sandbox.tsmdev.id');

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/tph/v1/applink',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);

        $res = json_decode($response, true);

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'), date_default_timezone_get() ?: 'UTC');

        dispatch(new PushLog(
            'tsm',
            [
                'datetime' => $date,
                'request' => json_encode($body),
                'response' => json_encode([
                    'message' => $res
                ])
            ],
            'tsm'
        ));

        return $res;
    }

    public function Status($data)
    {
        //Request Body//
        $body['app_code']    = $data['app_code'];
        $body['partner_trx_id']    =    $data['trx_id'];
        $body['terminal_code']    = $data['terminal_code'];
        $body['merchant_code']    = $data['merchant_code'];
        $body['timestamp']    = round(microtime(true) * 1000);


        //dd($body);
        $header = $this->header($body);

        $curl = curl_init();

        $baseUrl = "https://tph-sandbox.tsmdev.id";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/tph/v1/check-status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);

        $res = json_decode($response, true);

        return $res;
    }

    public function testAuthorize($data)
    {
        //Request Body//
        $body['app_code']    = $data['app_code'];
        $body['amount']    =  $data['amount'];
        $body['partner_trx_id']    =    $data['trx_id'];
        $body['terminal_code']    = $data['terminal_code'];
        $body['merchant_code']    = $data['merchant_code'];
        $body['payment_method']    = "CARD";
        $body['timestamp']    = round(microtime(true) * 1000);


        //dd($body);
        $header = $this->header($body);

        $body['partner_trx_id']    =  '923lcakj';
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);

        $curl = curl_init();

        $baseUrl = "https://tph-sandbox.tsmdev.id";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . '/tph/v1/applink',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonBody,
            // CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);

        $res = json_decode($response, true);

        return $res;
    }

    public function adminFee($price, $handlingFee, $mdrType)
    {
        $totalPrice = $price + $handlingFee;

        if ($mdrType == 'DEBIT') {
            $mdr = env('TSM_PRESENTASE_FEE_DEBIT', 0.02);
        } else {
            $mdr = env('TSM_PRESENTASE_FEE_CREDIT', 0.025);
        }

        $total = ceil($totalPrice / (1 - (float) $mdr));
        return [
            'total' => $total,
            'admin_fee' => $total - $totalPrice,
            'mdr' => $mdr
        ];
    }

    public function send($method, $endpoint, $body, $logName = null, $baseUrl = null)
    {
        $header = $this->header($body);

        $curl = curl_init();

        if (!$baseUrl) {
            $baseUrl = env('TSM_BASE', 'https://tph-sandbox.tsmdev.id');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response, true);

        if ($logName) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'), date_default_timezone_get() ?: 'UTC');

            dispatch(new PushLog(
                'tsm-soundbox',
                [
                    'datetime' => $date,
                    'endpoint' => $baseUrl . $endpoint,
                    'request' => json_encode($body),
                    'response' => json_encode([
                        'message' => $res
                    ])
                ],
                $logName
            ));
        }

        return $res;
    }

    public function registerSoundbox($sn, $imei, $mid, $qrCode, $nmid)
    {
        $body = [
            'app_code' => 'YESPOS',
            'serial_number' => $sn,
            'imei' => $imei,
            'mid' => $mid,
            'qr_code' => $qrCode,
            'nmid' => $nmid,
            'tid' => env('TSM_SOUNDBOX_TERMINAL_ID', 1),
            'merchant_code' => env('TSM_SOUNDBOX_MERCHANT_CODE', 'MDB510403000'),
            'qr_type' => env('TSM_SOUNDBOX_QR_TYPE', 1)
        ];

        return $this->send('POST', '/tph/v2/soundbox', $body, 'tsm-soundbox-device');
    }

    public function deregisterSoundbox($mid)
    {
        $data = [
            'app_code' => 'YESPOS',
            'mid' => $mid,
            'tid' => env('TSM_SOUNDBOX_TERMINAL_ID', 1),
            'merchant_code' => env('TSM_SOUNDBOX_MERCHANT_CODE', 'MDB510403000')
        ];

        return $this->send('POST', '/tph/v2/soundbox/delete', $data, 'tsm-soundbox-device');
    }

    public function notify($mid, $amount, $billNumber, $issuerCode, $paymentStatus, $nmid)
    {
        $now = date("Y-m-d\TH:i", now()->timestamp);
        $body = [
            'app_code' => 'YESPOS',
            'transaction_datetime' => $now,
            'mid' => $mid,
            'tid' => env('TSM_SOUNDBOX_TERMINAL_ID', 1),
            'merchant_code' => env('TSM_SOUNDBOX_MERCHANT_CODE', 'MDB510403000'),
            'amount' => $amount,
            'bill_number' => $billNumber,
            'issuer_code' => $issuerCode,
            'payment_status' => $paymentStatus,
            'nmid' => $nmid
        ];

        $baseUrl = env('TSM_NOTIF_BASE', 'https://notification-dev.tsmdev.id');
        $endpoint = '/api/v2/static-qr-notification/partner/YESPOS';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'), date_default_timezone_get() ?: 'UTC');

        dispatch(new PushLog(
            'tsm-notif-soundbox',
            [
                'datetime' => $date,
                'endpoint' => $baseUrl . $endpoint,
                'request' => json_encode($body),
                'response' => json_encode([
                    'message' => $response
                ])
            ],
            'tsm-notif-soundbox'
        ));

        return $response;
    }

    public function SoundboxWiseasy($data)
    {
        //Request Body//
        $body['app_code']    = $data['app_code'];
        $body['serial_number']    =  $data['serial_number'];
        $body['mid']    =    $data['mid'];
        $body['tid']    = $data['tid'];
        $body['merchant_code']    = $data['merchant_code'];
        $body['qr_code']    = $data['qr_code'];
        $body['nmid']    = $data['nmid'];
        $body['imei']    = $data['imei'];
        $body['qr_type']    = $data['qr_type'];
        $body['timestamp']    = round(microtime(true) * 1000);
        $header = $this->header($body);

        $curl = curl_init();

        $baseUrl = env('TSM_BASE', 'https://tph-sandbox.tsmdev.id');

        $urls = $data['method'] === "DELETE" ? '/tph/v2/soundbox/delete' : '/tph/v2/soundbox';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . $urls,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $data['method'] === "DELETE" ? "POST" : $data['method'],
            CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response, true);

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'), date_default_timezone_get() ?: 'UTC');

        dispatch(new PushLog(
            'tsm-soundbox',
            [
                'datetime' => $date,
                'endpoint' => $baseUrl . $urls,
                'request' => json_encode($body),
                'response' => json_encode([
                    'message' => $res
                ])
            ],
            'tsm-soundbox'
        ));

        return $res;
    }

    public function NotifSoundbox($data)
    {
        //Request Body//
        $body['app_code']    = $data['app_code'];
        $body['transaction_datetime']    =  $data['transaction_datetime'];
        $body['mid']    =    $data['mid'];
        $body['tid']    = $data['tid'];
        $body['merchant_code']    = $data['merchant_code'];
        $body['amount']    = $data['amount'];
        $body['bill_number']    = $data['bill_number'];
        $body['issuer_code']    = $data['issuer_code'];
        $body['payment_status']    = $data['payment_status'];
        $body['nmid']    = $data['nmid'];

        $header = $this->header($body);

        $curl = curl_init();

        $baseUrl = env('TSM_NOTIF_BASE', 'https://notification-dev.tsmdev.id');
        $urls = '/api/v2/static-qr-notification/partner/' . $body['app_code'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl . $urls,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $header['body'],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Token: ' . $header['signature']
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response, true);

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  date('Y-m-d H:i:s'), date_default_timezone_get() ?: 'UTC');

        dispatch(new PushLog(
            'tsm-notif-soundbox',
            [
                'datetime' => $date,
                'endpoint' => $baseUrl . $urls,
                'request' => json_encode($body),
                'response' => json_encode([
                    'message' => $res
                ])
            ],
            'tsm-notif-soundbox'
        ));

        return $res;
    }
}
