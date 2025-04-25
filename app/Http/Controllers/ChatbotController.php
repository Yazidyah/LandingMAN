<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function query(Request $request)
    {
        $request->validate([
            'query_text' => 'required|string',
        ]);

        // 1. Ambil session_id dari Laravel session (atau fallback ke header/body)
        $sessionId = $request->session()->get('chat_session_id')
            ?? $request->header('X-Session-ID')
            ?? $request->input('session_id');

        if (!$sessionId) {
            // kalau benar-benar ga ada, bisa generate & simpan
            $sessionId = (string) \Str::uuid();
            $request->session()->put('chat_session_id', $sessionId);
        }

        // 2. Kirim ke Flask API, sertakan session_id
        $api = Http::post(env('CHATBOT_QUERY_URL'), [
            'session_id' => $sessionId,
            'query_text' => $request->input('query_text'),
        ]);

        $body = $api->ok()
            ? $api->json()['response'] ?? 'Tidak ada balasan'
            : "Maaf saya sedang offline, coba lagi nanti.";

        return response()->json(['response' => $body])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
    }

    public function endSession(Request $request)
    {
        $sessionId = $request->session()->pull('chat_session_id');
        if ($sessionId) {
            Http::post(env('CHATBOT_QUERY_URL') . '/end-session', [
                'session_id' => $sessionId,
            ]);
        }
        return response()->json(['status' => 'ended']);
    }
}