<?php

namespace App\Http\Controllers;

use App\Models\Fixation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userMessage = $request->input('message');
        $history = $request->input('history', []);
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return response()->json(['type' => 'text', 'reply' => 'CRITICAL ERROR: API Key kosong.']);
        }

        // --- 1. ANALISIS RIWAYAT UNTUK REROLL ---
        $suggestedMajors = [];
        foreach ($history as $chat) {
            if ($chat['role'] === 'model') {
                if (preg_match('/"jurusan":\s*"([^"]+)"/', $chat['text'], $matches)) {
                    $suggestedMajors[] = $matches[1];
                }
            }
        }
        $blacklistStr = !empty($suggestedMajors) ? implode(", ", array_unique($suggestedMajors)) : "Belum ada";

        // --- 2. DETEKSI NIAT ---
        $msg = strtolower($userMessage);
        $isAskingRecommendation = false;
        $isReroll = false;

        // Deteksi Reroll (Eksplisit)
        if (preg_match('/(lain|beda|alternatif|lagi|reroll|selain itu)/i', $msg)) {
            $isAskingRecommendation = true;
            $isReroll = true;
        }
        // Deteksi Minta Rekomendasi (Umum)
        elseif (preg_match('/(berikan|minta|cari|rekomendasi|saran|pilihkan|bantu|bingung|mohon|tolong).*(jurusan|prodi|kuliah|studi)/i', $msg) ||
                preg_match('/(jurusan|prodi|kuliah).*(cocok|bagus|sesuai|apa|mana)/i', $msg)) {
            $isAskingRecommendation = true;
        }

        // --- 3. KONFIGURASI GEMINI ---
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

        $contents = [];
        foreach ($history as $chat) {
            $contents[] = ["role" => ($chat['role'] === 'user' ? 'user' : 'model'), "parts" => [["text" => $chat['text']]]];
        }

        if ($isAskingRecommendation) {

            // INSTRUKSI REROLL YANG LEBIH TEGAS
            $rerollPrompt = "";
            if ($isReroll || !empty($suggestedMajors)) {
                $rerollPrompt = "
                [ATURAN KHUSUS REROLL]:
                User meminta alternatif. Kamu SUDAH pernah menyarankan: [ $blacklistStr ].
                JANGAN PERNAH menyarankan jurusan yang ada di dalam daftar itu lagi!
                Cari jurusan yang BENAR-BENAR BERBEDA dari sebelumnya namun tetap relevan dengan minat user.
                ";
            }

            $systemPrompt = "
            PERAN: Konselor Pendidikan Profesional.
            TUGAS: Berikan 1 rekomendasi jurusan kuliah. $rerollPrompt

            ATURAN JSON:
            1. 'jurusan': Nama Jurusan Saja (Tanpa Kampus).
            2. 'deskripsi': Definisi singkat jurusan (apa yang dipelajari).
            3. 'alasan_cocok': Analisis naratif MENGAPA user cocok (hubungkan sifat user dengan jurusan).

            FORMAT OUTPUT: JSON MURNI.
            SCHEMA:
            {
                \"jurusan\": \"Nama Jurusan\",
                \"deskripsi\": \"Definisi jurusan.\",
                \"alasan_cocok\": \"Analisis kecocokan personal.\",
                \"swot\": {
                    \"strengths\": [\"Poin 1\", \"Poin 2\"],
                    \"weaknesses\": [\"Poin 1\", \"Poin 2\"],
                    \"opportunities\": [\"Peluang 1\", \"Peluang 2\"],
                    \"threats\": [\"Tantangan 1\", \"Tantangan 2\"]
                }
            }";

            $contents[] = ["role" => "user", "parts" => [["text" => $userMessage . "\n\n" . $systemPrompt]]];

            $payload = [
                "contents" => $contents,
                "generationConfig" => [
                    "response_mime_type" => "application/json",
                    "temperature" => 2.0
                ]
            ];
            $responseType = 'recommendation';

        } else {
            $systemPrompt = "Anda adalah Advizo. Jawab santai, singkat, dan suportif. Jangan kasih JSON kecuali diminta.";
            $contents[] = ["role" => "user", "parts" => [["text" => $userMessage . "\n\n(Instruksi: $systemPrompt)"]]];
            $payload = ["contents" => $contents];
            $responseType = 'text';
        }

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->withoutVerifying()
                ->timeout(60)
                ->post($url, $payload);

            if ($response->failed()) {
                return response()->json(['type' => 'text', 'reply' => "Error API: " . $response->body()]);
            }

            $responseBody = $response->json();
            $rawReply = $responseBody['candidates'][0]['content']['parts'][0]['text'] ?? '';

            if ($responseType === 'recommendation') {
                $data = json_decode($rawReply, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Simpan ke database jika user sudah login
                    if (Auth::check()) {
                        Fixation::create([
                            'user_id' => Auth::id(),
                            'jurusan' => $data['jurusan'],
                            'deskripsi' => $data['deskripsi'],
                            'alasan_cocok' => $data['alasan_cocok'],
                            'swot' => [
                                'strengths' => $data['swot']['strengths'] ?? [],
                                'weaknesses' => $data['swot']['weaknesses'] ?? [],
                                'opportunities' => $data['swot']['opportunities'] ?? [],
                                'threats' => $data['swot']['threats'] ?? [],
                            ],
                        ]);
                    }

                    return response()->json(['type' => 'recommendation', 'data' => $data]);
                } else {
                    $cleanJson = str_replace(['```json', '```'], '', $rawReply);
                    $dataRetry = json_decode($cleanJson, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                         return response()->json(['type' => 'recommendation', 'data' => $dataRetry]);
                    }
                    return response()->json(['type' => 'text', 'reply' => "DEBUG JSON ERROR:\n" . $rawReply]);
                }
            } else {
                return response()->json(['type' => 'text', 'reply' => $rawReply]);
            }

        } catch (\Exception $e) {
            return response()->json(['type' => 'text', 'reply' => "System Error: " . $e->getMessage()]);
        }
    }}
