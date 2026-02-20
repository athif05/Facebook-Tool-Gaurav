<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function idex(){

        $allConversions = [];
        $page = 1;
        $pageSize = 1; // Fetch 100 records per page

        $from = "2026-02-01 00:00:00";
        $to = "2026-02-20 23:59:59";
        $apiKey = "KbCxXmRZGl0RXjTe9Kw";

        do {
            $api_url = "https://api.eflow.team/v1/affiliates/reporting/onhold?page={$page}&page_size={$pageSize}";
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "from": "' . $from . '",
                "to": "' . $to . '",
                "timezone_id": 31,
                "show_conversions": true,
                "show_events": false,
                "on_hold_status_filter": "on_hold",
                "query":{
                    "filters": []
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'X-Eflow-API-Key: ' . $apiKey,
                'Content-Type: application/json'
            ),
            ));

            
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            
            if ($httpCode != 200) {
                echo "Error: HTTP {$httpCode}\n";
                break;
            }

            $data = json_decode($response, true);
            
            if (!isset($data['conversions'])) {
                echo "No conversions found\n";
                break;
            }
            
            // Add conversions to result
            $allConversions = array_merge($allConversions, $data['conversions']);
            
            // Check if there are more pages
            $paging = $data['paging'];
            $totalPages = ceil($paging['total_count'] / $paging['page_size']);
            
            echo "Fetched page {$page} of {$totalPages} ({$paging['total_count']} total records)\n";
            
            $page++;
            
            // Continue if there are more pages
        } while ($page <= $totalPages);
        
        return $allConversions;
    }
}
