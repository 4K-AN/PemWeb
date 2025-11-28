<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController;
use Illuminate\Support\Facades\Http;

// Home Route
Route::get('/', function () {
    return view('home_edvizo');
})->name('home');

// Home Route alternatif
Route::get('/home', function () {
    return view('home_edvizo');
});

// Auth Routes
Route::get('/login-edvizo', function () {
    return view('login_edvizo');
})->name('login');

Route::post('/login-edvizo/action', [LoginController::class, 'authenticate'])->name('login.action');

// Auth Routes
Route::get('/register-edvizo', [RegisterController::class, 'show'])->name('register');

Route::post('/register-edvizo/action', [RegisterController::class, 'process'])->name('register.action');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Chatbot Routes
Route::get('/konsultasi-jurusan', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/konsultasi-jurusan/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');

// Debug Route
Route::get('/debug-gemini', function () {
    $apiKey = env('GEMINI_API_KEY');
    $response = Http::withoutVerifying()->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

    return $response->json();
});

// Beasiswa Routes
Route::get('/info-beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.index');
Route::get('/beasiswa/{id}', [BeasiswaController::class, 'show'])->name('beasiswa.show');
Route::get('/beasiswa-search', [BeasiswaController::class, 'search'])->name('beasiswa.search');

// Kalender Akademik Routes
Route::get('/kalender-akademik', [AkademikController::class, 'index'])->name('akademik.kalender');
Route::get('/kalender-akademik/{day}', [AkademikController::class, 'detail'])->name('akademik.kalender.detail');

// Simulasi Karir Routes
Route::get('/simulasi-karir', [KarirController::class, 'index'])->name('simulasi.karir');
Route::get('/simulasi-karir/{slug}', [KarirController::class, 'show'])->name('simulasi.karir.detail');
