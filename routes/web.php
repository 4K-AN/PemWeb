<?php

use Illuminate\Support\Facades\Route;
// Jangan lupa import Controller
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController;

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

// --- FITUR KARIR ---
// Perhatikan bagian ->name('karir.simulasi')
Route::get('/simulasi-karir', [KarirController::class, 'index'])
    ->name('karir.simulasi'); 


// --- FITUR AKADEMIK ---
// Perhatikan bagian ->name('akademik.index') agar cocok dengan Header
Route::get('/kalender-akademik', [AkademikController::class, 'index'])
    ->name('akademik.index'); 

Route::get('/kalender-akademik/day/{day}', [AkademikController::class, 'detail'])
    ->name('akademik.detail');

Route::get('/simulasi-karir/{slug}', [KarirController::class, 'show'])->name('karir.show');


// Route untuk halaman utama (Daftar Profesi)
Route::get('/karir/simulasi', [KarirController::class, 'index'])->name('karir.simulasi');

// Route untuk halaman detail profesi (Dynamic Slug)
Route::get('/karir/{slug}', [KarirController::class, 'show'])->name('karir.show');