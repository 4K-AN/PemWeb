<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkademikController extends Controller
{
    // halaman index kalender
    public function index()
    {
        $year  = now()->year;
        $month = now()->month;
        return view('akademik.Kalender.index', compact('year','month'));
    }

    // method yang dipanggil route /kalender-akademik/day/{day}
    public function detail($day)
    {
        // coba tampilkan view khusus 'page{day}', contoh: akademik.Kalender.page15
        $specificView = 'akademik.Kalender.page' . (int)$day;

        if (view()->exists($specificView)) {
            return view($specificView);
        }

        // fallback: view detail umum jika page{day} tidak ada
        return view('akademik.Kalender.detail', ['day' => (int)$day]);
    }
}
