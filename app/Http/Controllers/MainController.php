<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function scanBarcode(Request $request)
    {
        $url = 'https://startuphana.astanahub.com/api/barcode/scanned';

        Log::error($request->all());
        Log::error(http_build_query(['text' => $request->text]));
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => '?'.http_build_query(['text' => $request->text]),

        ]);

//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        if (isset($post)) {
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['text' => $request->text]));

//        }
        $result = curl_exec($ch);
        $err = curl_error($ch);
        Log::error($err);
//        dd($not_decoded);
        Log::error($result);
        curl_close($ch);

        return ['success' => true];
    }

}
