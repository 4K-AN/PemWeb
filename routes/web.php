<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORT Controller di bagian paling atas
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController; 



Route::get('/', function () {
    return view('welcome');
});

// Fitur Simulasi Karir
Route::get('/simulasi-karir', [KarirController::class, 'index'])->name('karir.simulasi');

// Fitur Kalender Akademik (Baru)
Route::get('/kalender-akademik', [AkademikController::class, 'index'])->name('akademik.kalender');