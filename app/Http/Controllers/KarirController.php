<?php

namespace App\Http\Controllers;

use App\Models\Fixation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

/**
 * Controller untuk mengelola simulasi karir berdasarkan fiksasi jurusan user
 * Menggunakan Google Gemini AI untuk rekomendasi karir
 */
class KarirController extends Controller
{
    /**
     * Menampilkan halaman simulasi karir dengan daftar rekomendasi
     */
    public function index()
    {
        if (!Auth::check()) {
            return view('karir.Fiksasi.simulasi.index', ['fixation' => null, 'careers' => [], 'error' => null]);
        }

        $fixation = Auth::user()->latestFixation();
        $careers = [];
        $error = null;

        if ($fixation) {
            \Log::info('Karir Controller - User ID: ' . Auth::id() . ', Fixation ID: ' . $fixation->id . ', Jurusan: ' . $fixation->jurusan);

            $result = $this->getAICareers($fixation);

            if (isset($result['error'])) {
                $error = $result['error'];
                \Log::error('Error dari getAICareers: ' . $error);
            } else {
                $careers = $result['careers'] ?? [];
                \Log::info('Total careers returned: ' . count($careers));
            }
        } else {
            \Log::warning('No fixation found for user: ' . Auth::id());
        }

        return view('karir.Fiksasi.simulasi.index', [
            'fixation' => $fixation,
            'careers' => $careers,
            'error' => $error
        ]);
    }

    /**
     * Mengambil rekomendasi karir dari Gemini AI berdasarkan fiksasi jurusan
     * Menggunakan cache untuk menghindari pemanggilan API berulang
     */
    private function getAICareers($fixation)
    {
        try {
            $cacheKey = 'ai_careers_' . $fixation->id;

            if (Cache::has($cacheKey)) {
                \Log::info('Returning careers from cache');
                return ['careers' => Cache::get($cacheKey)];
            }

            \Log::info('Cache not found, calling AI...');

            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                \Log::error('GEMINI_API_KEY tidak ditemukan di .env');
                return ['error' => 'API Key tidak ditemukan. Silakan hubungi administrator.'];
            }

            \Log::info('API Key found (first 10 chars): ' . substr($apiKey, 0, 10) . '...');

            $prompt = "Kamu adalah konsultan karir profesional. Berdasarkan jurusan '{$fixation->jurusan}' dengan deskripsi '{$fixation->deskripsi}', berikan rekomendasi 6 karir yang paling sesuai.

ATURAN KETAT:
1. Return HANYA JSON array yang valid
2. TIDAK ada teks, markdown, atau penjelasan tambahan
3. Format PERSIS seperti contoh

CONTOH FORMAT YANG BENAR:
[
  {
    \"id\": \"software-engineer\",
    \"title\": \"Software Engineer\",
    \"description\": \"Profesional yang merancang, mengembangkan, dan memelihara perangkat lunak untuk berbagai platform dan kebutuhan bisnis.\",
    \"skills\": [\"Programming (Java/Python/JavaScript)\", \"Database Management\", \"Version Control (Git)\", \"Problem Solving\"],
    \"salary\": \"Rp 8.000.000 - Rp 25.000.000\",
    \"career_path\": [\"Junior Developer (0-2 tahun)\", \"Mid Developer (3-5 tahun)\", \"Senior Developer (5-8 tahun)\", \"Tech Lead (8+ tahun)\"],
    \"relevance\": \"Sangat cocok untuk lulusan {$fixation->jurusan} karena membutuhkan pemahaman teknis dan kemampuan problem solving yang kuat.\"
  }
]

PENTING:
- Berikan 6 karir BERBEDA yang relevan dengan {$fixation->jurusan}
- ID harus lowercase, pisahkan dengan dash (-)
- Skills maksimal 4 item
- Career path maksimal 4 level
- Salary dalam format Rupiah Indonesia
- Description 1-2 kalimat saja
- Relevance jelaskan mengapa cocok untuk jurusan ini

Return HANYA JSON array:";

            \Log::info('Calling Gemini API...');
            \Log::info('Prompt length: ' . strlen($prompt) . ' characters');

            $response = Http::withoutVerifying()->timeout(60)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 4096,
                    ]
                ]
            );

            \Log::info('API Response Status: ' . $response->status());

            if (!$response->successful()) {
                $errorBody = $response->body();
                \Log::error('Gemini API Error: ' . $response->status());
                \Log::error('Error Body: ' . $errorBody);
                return ['error' => 'API Error: ' . $response->status() . '. Cek log untuk detail.'];
            }

            $result = $response->json();
            \Log::info('Response structure: ' . json_encode(array_keys($result)));

            if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                \Log::error('AI response structure invalid');
                \Log::error('Full response: ' . json_encode($result));
                return ['error' => 'Format response AI tidak valid. Cek log untuk detail.'];
            }

            $text = $result['candidates'][0]['content']['parts'][0]['text'];
            \Log::info('Raw AI response length: ' . strlen($text) . ' characters');
            \Log::info('First 200 chars: ' . substr($text, 0, 200));

            // Cleaning process: hapus markdown code blocks
            $text = trim($text);
            $text = preg_replace('/^```json\s*/i', '', $text);
            $text = preg_replace('/^```\s*/i', '', $text);
            $text = preg_replace('/\s*```\s*$/i', '', $text);
            $text = trim($text);

            \Log::info('After cleaning, first 200 chars: ' . substr($text, 0, 200));

            // Extract JSON array
            if (preg_match('/\[[\s\S]*\]/m', $text, $matches)) {
                $text = $matches[0];
                \Log::info('JSON extracted successfully');
            } else {
                \Log::error('Could not extract JSON array from text');
                \Log::error('Full text: ' . $text);
                return ['error' => 'Tidak dapat mengekstrak JSON dari response AI.'];
            }

            $careers = json_decode($text, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                \Log::error('JSON Parse Error: ' . json_last_error_msg());
                \Log::error('JSON Error Code: ' . json_last_error());
                \Log::error('Problematic JSON (first 500 chars): ' . substr($text, 0, 500));
                return ['error' => 'Error parsing JSON: ' . json_last_error_msg()];
            }

            \Log::info('JSON decoded successfully. Career count: ' . count($careers));

            if (!is_array($careers) || count($careers) < 3) {
                \Log::warning('AI returned less than 3 careers: ' . count($careers));
                return ['error' => 'AI hanya mengembalikan ' . count($careers) . ' karir (minimal 3 diperlukan).'];
            }

            // Validate and clean data
            $validCareers = [];
            foreach ($careers as $index => $career) {
                \Log::info("Validating career #{$index}: " . ($career['title'] ?? 'no title'));

                if (isset($career['id'], $career['title'], $career['description'],
                          $career['skills'], $career['salary'], $career['career_path'])) {

                    $career['id'] = strtolower(trim(preg_replace('/[^a-z0-9-]/', '-', $career['id'])));
                    $validCareers[] = $career;
                    \Log::info("Career #{$index} is valid");
                } else {
                    \Log::warning("Career #{$index} is invalid. Missing fields.");
                }
            }

            \Log::info('Valid careers count: ' . count($validCareers));

            if (count($validCareers) >= 3) {
                Cache::put($cacheKey, $validCareers, 86400);
                \Log::info('Careers cached successfully');
                return ['careers' => $validCareers];
            }

            return ['error' => 'Hanya ' . count($validCareers) . ' karir valid dari total ' . count($careers) . ' karir.'];

        } catch (\Exception $e) {
            \Log::error('Exception in getAICareers: ' . $e->getMessage());
            \Log::error('File: ' . $e->getFile() . ':' . $e->getLine());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return ['error' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Menampilkan detail karir berdasarkan slug
     */
    public function show($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $fixation = Auth::user()->latestFixation();

        if (!$fixation) {
            return redirect()->route('simulasi.karir');
        }

        try {
            $result = $this->getAICareers($fixation);

            if (isset($result['error'])) {
                abort(404, 'Error loading careers: ' . $result['error']);
            }

            $careers = $result['careers'] ?? [];
            $job = collect($careers)->firstWhere('id', $slug);

            if (!$job) {
                $job = $this->getAICareerDetail($fixation, $slug);
            }

            return view('karir.Fiksasi.simulasi.detail', ['job' => $job]);

        } catch (\Exception $e) {
            \Log::error('Error in show: ' . $e->getMessage());
            abort(404);
        }
    }

    /**
     * Mengambil detail karir spesifik dari Gemini AI
     */
    private function getAICareerDetail($fixation, $slug)
    {
        try {
            $apiKey = env('GEMINI_API_KEY');
            $careerName = ucwords(str_replace('-', ' ', $slug));

            $prompt = "Kamu adalah konsultan karir. Berikan detail lengkap untuk karir '{$careerName}' yang sesuai dengan jurusan '{$fixation->jurusan}'.

ATURAN:
1. Return HANYA JSON object
2. TIDAK ada markdown atau teks tambahan

FORMAT:
{
  \"title\": \"Nama Karir Profesional\",
  \"description\": \"Deskripsi lengkap karir ini dalam 3-4 paragraf. Paragraf 1: Penjelasan umum karir. Paragraf 2: Tanggung jawab dan aktivitas harian. Paragraf 3: Prospek dan perkembangan karir. Paragraf 4: Mengapa cocok untuk lulusan {$fixation->jurusan}.\",
  \"skills\": [\"Skill spesifik 1\", \"Skill spesifik 2\", \"Skill spesifik 3\", \"Skill spesifik 4\", \"Skill spesifik 5\"],
  \"salary\": \"Rp 8.000.000 - Rp 25.000.000\",
  \"career_path\": [\"Entry Level (0-2 tahun)\", \"Mid Level (2-5 tahun)\", \"Senior Level (5-8 tahun)\", \"Expert Level (8+ tahun)\"]
}

Return HANYA JSON object:";

            $response = Http::withoutVerifying()->timeout(30)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 2048,
                    ]
                ]
            );

            if ($response->successful()) {
                $result = $response->json();

                if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                    $text = $result['candidates'][0]['content']['parts'][0]['text'];

                    $text = trim($text);
                    $text = preg_replace('/^```json\s*/i', '', $text);
                    $text = preg_replace('/^```\s*/i', '', $text);
                    $text = preg_replace('/\s*```\s*$/i', '', $text);
                    $text = trim($text);

                    if (substr($text, 0, 1) !== '{') {
                        if (preg_match('/(\{[\s\S]*\})/m', $text, $matches)) {
                            $text = $matches[1];
                        }
                    }

                    $job = json_decode($text, true);

                    if (json_last_error() === JSON_ERROR_NONE &&
                        isset($job['title'], $job['description'], $job['skills'],
                              $job['salary'], $job['career_path'])) {
                        return $job;
                    }
                }
            }

        } catch (\Exception $e) {
            \Log::error('AI Detail Error: ' . $e->getMessage());
        }

        throw new \Exception('Career detail not found');
    }
}
