<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('chatbot');
});

use App\Http\Controllers\ChatbotController;

Route::get('/konsultasi-jurusan', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/konsultasi-jurusan/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');

use Illuminate\Support\Facades\Http;


Route::get('/debug-gemini', function () {
    $apiKey = env('GEMINI_API_KEY');
    // Kita minta daftar model yang tersedia
    $response = Http::withoutVerifying()->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

    return $response->json();
});
