<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KarirController extends Controller
{
    public function index()
    {
        // Anda bisa mengambil data jurusan fiksasi dari database di sini nanti
        // $jurusan = auth()->user()->jurusanFiksasi;

        // Tampilkan UI yang ada di resources/views/karir/simulasi.blade.php
        return view('karir.Fiksasi.simulasi.index');
    }
}