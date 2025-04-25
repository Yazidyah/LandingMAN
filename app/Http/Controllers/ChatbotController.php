<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    protected function apiUrl() {
        return env('CHATBOT_QUERY_URL', 'http://127.0.0.1:5000');
    }

    public function query(Request $request)
    {
        $request->validate([
            'query_text' => 'required|string',
            'session_id' => 'required|string',
        ]);

        $sessionId = $request->input('session_id');
        $payload = [
            'query_text' => $request->input('query_text'),
            'session_id' => $sessionId,
        ];

        \Log::info('>> Sending chat query', $payload);
        $resp = Http::post($this->apiUrl() . '/query', $payload);

        if ($resp->ok()) {
            $body = $resp->json();
            return response()->json($body);
        }

        return response()->json(['response' => 'Maaf, server chat offline'], 500);
    }

    public function history(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return response()->json(['error' => 'Missing session_id'], 400);
        }

        $resp = Http::get($this->apiUrl() . '/history', ['session_id' => $sessionId]);
        return response()->json($resp->json(), $resp->status());
    }

    public function endSession(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
        ]);

        $sessionId = $request->input('session_id');
        $resp = Http::post($this->apiUrl() . '/end-session', ['session_id' => $sessionId]);

        return response()->json($resp->json(), $resp->status());
    }
}
