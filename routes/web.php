<?php

use Illuminate\Support\Facades\Route;
// Jangan lupa import Controller
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController;

Route::get('/', function () {
    return view('welcome');
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