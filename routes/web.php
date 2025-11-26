<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
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