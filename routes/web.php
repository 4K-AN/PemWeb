<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('register_edvizo');
});

Route::get('/login-edvizo', function () {
    return view('login_edvizo');
})->name('login');

Route::post('/login-edvizo/action', [LoginController::class, 'authenticate'])->name('login.action');

Route::get('/home', function () {
    return view('home_edvizo');
});

Route::get('/register-edvizo', [RegisterController::class, 'show'])->name('register');

// Proses Data Register (Disiapkan untuk nanti)
Route::post('/register-edvizo/action', [RegisterController::class, 'process'])->name('register.action');

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
