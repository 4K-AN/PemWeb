<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeasiswaController;

Route::get('/', function () {
    return redirect()->route('beasiswa.index');
});

Route::get('/info-beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.index');
Route::get('/beasiswa/{id}', [BeasiswaController::class, 'show'])->name('beasiswa.show');
Route::get('/search', [BeasiswaController::class, 'search'])->name('beasiswa.search');