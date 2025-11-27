<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Http;

// Home Route - Mengarah ke halaman home baru
Route::get('/', function () {
    return view('home_edvizo');
})->name('home');

// Auth Routes - Login tetap tidak berubah
Route::get('/login-edvizo', function () {
    return view('login_edvizo');
})->name('login');

Route::post('/login-edvizo/action', [LoginController::class, 'authenticate'])->name('login.action');

// Auth Routes - Register tetap tidak berubah
Route::get('/register-edvizo', [RegisterController::class, 'show'])->name('register');

Route::post('/register-edvizo/action', [RegisterController::class, 'process'])->name('register.action');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Chatbot Routes - Tidak berubah
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
Route::get('/kalender-akademik', function () {
    return view('akademik.Kalender.index');
})->name('akademik.kalender');

// Simulasi Karir Routes
Route::get('/simulasi-karir', function () {
    return view('karir.Fiksasi.simulasi.index');
})->name('simulasi.karir');
