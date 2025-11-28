<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Beasiswa::query();

        // Filter berdasarkan kategori
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
                $q->where('nama_beasiswa', 'like', '%' . $request->q . '%')
                  ->orWhere('universitas', 'like', '%' . $request->q . '%')
                  ->orWhere('jurusan', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $beasiswas = $query->paginate(12);

        // Data untuk filter dropdown
        $kategoris = Beasiswa::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');
        $negaras = Beasiswa::select('negara')->distinct()->pluck('negara');

        return view('beasiswa.index', compact('beasiswas', 'kategoris', 'negaras'));
    }

    public function show($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('beasiswa.show', compact('beasiswa'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
