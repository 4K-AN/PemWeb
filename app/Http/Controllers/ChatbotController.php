<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'array' // Opsional: untuk konteks percakapan
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        // Ambil API Key dari .env
        $apiKey = env('GEMINI_API_KEY');

// GANTI BARIS URL MENJADI INI:
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";


        // Konstruksi Prompt Default (System Instruction)
        $systemInstruction = [
            "role" => "user",
            "parts" => [[
                "text" => "Anda adalah 'Advizo', asisten AI cerdas untuk aplikasi Edvizo.
                Tugas Anda adalah membantu siswa SMA/SMK memilih jurusan kuliah yang tepat.
                Gaya bicara: Ramah, suportif, edukatif, dan kekinian (tapi tetap sopan).
                Gunakan emoji sesekali agar tidak kaku.
                Jika ditanya diluar topik pendidikan/jurusan, arahkan kembali ke topik konsultasi jurusan secara halus.
                Jangan memberikan jawaban yang terlalu panjang, berikan poin-poin jika menjelaskan opsi jurusan."
            ]]
        ];

        $modelResponse = [
            "role" => "model",
            "parts" => [["text" => "Halo! Saya Advizo. Siap membantu kamu menemukan jurusan impian. Ada yang bisa saya bantu?"]]
        ];

        // Format pesan untuk dikirim ke API (History + Pesan Baru)
        $contents = [];
        $contents[] = $systemInstruction;
        $contents[] = $modelResponse;

        // Masukkan history chat sebelumnya (jika ada) agar bot ingat konteks
        foreach ($history as $chat) {
            $contents[] = [
                "role" => $chat['role'] === 'user' ? 'user' : 'model',
                "parts" => [["text" => $chat['text']]]
            ];
        }

        // Masukkan pesan user saat ini
        $contents[] = [
            "role" => "user",
            "parts" => [["text" => $userMessage]]
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                "contents" => $contents
            ]);

            if ($response->successful()) {
                $data = $response->json();
                // Ambil teks balasan dari struktur JSON Gemini
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak mengerti.';

                // Format teks (Bold formatting dari markdown ke HTML sederhana)
                $reply = str_replace("**", "", $reply);

                return response()->json(['reply' => $reply]);
            } else {
                Log::error('Gemini Error: ' . $response->body());
                return response()->json(['reply' => 'Maaf, server sedang sibuk. Coba lagi nanti ya!'], 500);
            }

        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan koneksi.'], 500);
        }
    }
}
