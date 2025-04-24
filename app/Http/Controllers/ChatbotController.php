<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatbotController extends Controller
{
    //
    public function query(Request $request)
    {
        $queryText = $request->input('query_text');
        $apiResponse = $this->hitApi($queryText);

        if ($apiResponse['status'] === 200) {
            $response = $apiResponse['data'];
        } else {
            $response = "Maaf saya sedang offline, Coba lagi lain kali ya";
        }

        return response()->json(['response' => $response])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
    }

    private function hitApi($queryText)
    {
        // Simulated API response for demonstration purposes
        return [
            'status' => 200, // Change this to simulate different statuses
            'data' => $queryText
        ];
    }
}
