<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Beasiswa::query();

        // Filter berdasarkan jenis beasiswa
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_beasiswa', $request->jenis);
        }

        // Filter berdasarkan kategori/bidang studi
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan negara
        if ($request->has('negara') && $request->negara != '') {
            $query->where('negara', $request->negara);
        }

        // Search
        if ($request->has('q') && $request->q != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                  ->orWhere('universitas', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'deadline');
        $sortOrder = $request->get('order', 'asc');

        if ($sortBy == 'deadline') {
            $query->orderByRaw('deadline IS NULL, deadline ' . $sortOrder);
        } elseif ($sortBy == 'nama_beasiswa') {
            $query->orderBy('nama', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $beasiswas = $query->paginate(12);

        // Data untuk filter dropdown dengan fallback
        $jenisBeasiswas = Beasiswa::select('jenis_beasiswa')
                                  ->distinct()
                                  ->whereNotNull('jenis_beasiswa')
                                  ->where('jenis_beasiswa', '!=', '')
                                  ->orderBy('jenis_beasiswa')
                                  ->pluck('jenis_beasiswa');

        if ($jenisBeasiswas->isEmpty()) {
            $jenisBeasiswas = collect(['Beasiswa Penuh', 'Beasiswa Parsial', 'Beasiswa Prestasi', 'KIP Kuliah']);
        }

        $kategoris = Beasiswa::select('kategori')
                            ->distinct()
                            ->whereNotNull('kategori')
                            ->where('kategori', '!=', '')
                            ->orderBy('kategori')
                            ->pluck('kategori');

        if ($kategoris->isEmpty()) {
            $kategoris = collect(['Sains & Teknologi', 'Sosial & Humaniora', 'Kesehatan', 'Teknik', 'Ekonomi & Bisnis']);
        }

        $negaras = Beasiswa::select('negara')
                          ->distinct()
                          ->whereNotNull('negara')
                          ->where('negara', '!=', '')
                          ->orderBy('negara')
                          ->pluck('negara');

        if ($negaras->isEmpty()) {
            $negaras = collect(['Indonesia', 'Jepang', 'Korea', 'Belanda', 'Amerika', 'Australia']);
        }

        return view('beasiswa.index', compact('beasiswas', 'jenisBeasiswas', 'kategoris', 'negaras'));
    }

    public function show($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('beasiswa.show', compact('beasiswa'));
    }
}
