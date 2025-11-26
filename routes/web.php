<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORT Controller di bagian paling atas
use App\Http\Controllers\KarirController;
use App\Http\Controllers\AkademikController; 



Route::get('/', function () {
    return view('welcome');
});

Route::get('/kalender-akademik', [AkademikController::class, 'index'])->name('akademik.index');
Route::get('/kalender-akademik/day/{day}', [AkademikController::class, 'detail'])->name('akademik.detail');
