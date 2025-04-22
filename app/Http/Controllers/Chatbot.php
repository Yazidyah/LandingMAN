<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Chatbot extends Controller
{
    //
    public function query(Request $request)
    {
        $queryText = $request->input('query_text');
        $response = "You said: " . $queryText;

        return response()->json(['response' => $response])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
    }
}
