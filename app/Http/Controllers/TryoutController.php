<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use Illuminate\Http\Request;

class TryoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Tryout::where('is_active', true);

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
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

        // Data untuk filter dropdown
        $kategoris = Tryout::select('kategori')->distinct()->pluck('kategori');
        $lokasis = Tryout::select('lokasi')->distinct()->pluck('lokasi');

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
