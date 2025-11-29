<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use Illuminate\Http\Request;

class TryoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Tryout::where('is_active', true);

        // Filter berdasarkan kategori (jenis ujian)
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $query->where('lokasi', $request->lokasi);
        }

        // Filter berdasarkan waktu pelaksanaan
        if ($request->has('waktu') && $request->waktu != '') {
            $now = now();
            switch ($request->waktu) {
                case 'minggu_ini':
                    $query->whereBetween('tanggal_pelaksanaan', [$now->startOfWeek(), $now->copy()->endOfWeek()]);
                    break;
                case 'bulan_ini':
                    $query->whereMonth('tanggal_pelaksanaan', $now->month)
                          ->whereYear('tanggal_pelaksanaan', $now->year);
                    break;
                case 'bulan_depan':
                    $nextMonth = $now->copy()->addMonth();
                    $query->whereMonth('tanggal_pelaksanaan', $nextMonth->month)
                          ->whereYear('tanggal_pelaksanaan', $nextMonth->year);
                    break;
            }
        }

        // Filter gratis
        if ($request->has('gratis') && $request->gratis == '1') {
            $query->where('biaya', 0);
        }

        // Filter fitur (pembahasan, sertifikat, ranking)
        if ($request->has('pembahasan') && $request->pembahasan == '1') {
            $query->where('dengan_pembahasan', true);
        }
        if ($request->has('sertifikat') && $request->sertifikat == '1') {
            $query->where('dengan_sertifikat', true);
        }
        if ($request->has('ranking') && $request->ranking == '1') {
            $query->where('dengan_ranking', true);
        }

        // Search
        if ($request->has('q') && $request->q != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_tryout', 'like', '%' . $request->q . '%')
                  ->orWhere('penyelenggara', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'tanggal_pelaksanaan');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $tryouts = $query->paginate(12);

        // Data untuk filter dropdown dengan fallback
        $kategoris = Tryout::where('is_active', true)
                          ->select('kategori')
                          ->distinct()
                          ->whereNotNull('kategori')
                          ->where('kategori', '!=', '')
                          ->orderBy('kategori')
                          ->pluck('kategori');

        // Jika kosong, berikan data default
        if ($kategoris->isEmpty()) {
            $kategoris = collect(['UTBK', 'SNBT', 'Ujian Mandiri', 'Kedinasan']);
        }

        $lokasis = Tryout::where('is_active', true)
                        ->select('lokasi')
                        ->distinct()
                        ->whereNotNull('lokasi')
                        ->where('lokasi', '!=', '')
                        ->orderBy('lokasi')
                        ->pluck('lokasi');

        // Jika kosong, berikan data default
        if ($lokasis->isEmpty()) {
            $lokasis = collect(['Online', 'Offline', 'Jakarta', 'Bandung', 'Surabaya']);
        }

        // Debug log (hapus setelah selesai debugging)
        \Log::info('Kategoris: ' . $kategoris->toJson());
        \Log::info('Lokasis: ' . $lokasis->toJson());
        \Log::info('Total Tryouts: ' . $tryouts->total());

        return view('tryout.index', compact('tryouts', 'kategoris', 'lokasis'));
    }

    public function show($id)
    {
        $tryout = Tryout::findOrFail($id);
        return view('tryout.show', compact('tryout'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
