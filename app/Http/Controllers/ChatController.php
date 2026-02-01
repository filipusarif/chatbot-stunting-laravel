<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class ChatController extends Controller
{
public function index()
    {
        // Ambil semua sesi chat milik user yang sedang login
        $sessions = auth()->user()->chatSessions()->latest()->get();
        return view('layouts.chat', compact('sessions'));
    }

    public function show(ChatSession $session)
    {
        // Pastikan user hanya bisa melihat chat miliknya sendiri
        if ($session->user_id !== auth()->id()) abort(403);

        $sessions = auth()->user()->chatSessions()->latest()->get();
        $messages = $session->messages()->oldest()->get();

        return view('layouts.chat', compact('sessions', 'session', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'nullable|exists:chat_sessions,id'
        ]);

        // 1. Cari atau buat sesi chat baru
        $session = $request->session_id 
            ? ChatSession::find($request->session_id)
            : auth()->user()->chatSessions()->create(['title' => substr($request->message, 0, 30) . '...']);

        // 2. Simpan pesan User
        $session->messages()->create([
            'sender' => 'user',
            'message' => $request->message
        ]);

        // 3. Panggil FastAPI
        $nvidiaToken = Setting::where('key', 'nvidia_token')->first()?->value;
        $fastApiUrl = config('services.fastapi.url', 'http://localhost:8000');

        try {
            $response = Http::post("{$fastApiUrl}/api/chat", [
                'message' => $request->message,
                'token' => $nvidiaToken,
            ]);

            $botReply = $response->successful() ? $response->json()['reply'] : 'Gagal mendapatkan respon AI.';

            // 4. Simpan pesan Bot
            $session->messages()->create([
                'sender' => 'bot',
                'message' => $botReply
            ]);

            return response()->json([
                'reply' => $botReply,
                'session_id' => $session->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Koneksi ke server AI terputus.'], 500);
        }
    }
}