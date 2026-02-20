<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function idex(){
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.eflow.team/v1/affiliates/reporting/onhold?page_size=1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "from": "2026-02-01 00:00:00",
    "to": "2026-02-20 23:59:59",
    "timezone_id": 31,
    "show_conversions": true,
    "show_events": false,
    "on_hold_status_filter": "on_hold",
    "query":{
        "filters": []
    }
}',
  CURLOPT_HTTPHEADER => array(
    'X-Eflow-API-Key: KbCxXmRZGl0RXjTe9Kw',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
    }
}
