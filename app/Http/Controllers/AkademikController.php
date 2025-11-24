<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkademikController extends Controller
{
    // Menampilkan kalender
    public function index() {
        return view('akademik.kalender');
    }
}
