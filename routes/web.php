<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\ProfileController;
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
Route::post('/register-edvizo', [RegisterController::class, 'process'])->name('register.process');

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

// Tryout Routes
Route::get('/info-tryout', [TryoutController::class, 'index'])->name('tryout.index');
Route::get('/tryout/{id}', [TryoutController::class, 'show'])->name('tryout.show');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Kalender Akademik Routes
Route::get('/kalender-akademik', [AkademikController::class, 'index'])->name('akademik.kalender');
Route::get('/kalender-akademik/tanggal/{day}', [AkademikController::class, 'detail'])->name('akademik.kalender.detail');
Route::get('/kalender-akademik/event/{id}', [AkademikController::class, 'showEvent'])->name('akademik.event.show');

// Simulasi Karir Routes
Route::get('/simulasi-karir', [KarirController::class, 'index'])->name('simulasi.karir');
Route::get('/simulasi-karir/{slug}', [KarirController::class, 'show'])->name('simulasi.karir.detail');
