<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function scanBarcode(Request $request)
    {
        $url = 'https://startuphana.astanahub.com/api/barcode/scanned?text='.$request->text;

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
//            CURLOPT_POSTFIELDS =>http_build_query(['text' => $request->text]),

        ]);

        Log::error(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        Log::error($result);
        Log::error($err);
        curl_close($ch);

        return ['success' => true];
    }

}
