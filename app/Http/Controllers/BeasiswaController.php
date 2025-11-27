<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        // Beasiswa terbaru
        $beasiswaTerbaru = Beasiswa::query()
            ->byJurusan($request->jurusan)
            ->byStatus($request->status)
            ->byJenjang($request->jenjang)
            ->latest()
            ->take(3)
            ->get();

        // Beasiswa populer
        $beasiswaPopuler = Beasiswa::where('is_popular', true)
            ->byJurusan($request->jurusan)
            ->byStatus($request->status)
            ->byJenjang($request->jenjang)
            ->take(3)
            ->get();

        return view('beasiswa.index', compact('beasiswaTerbaru', 'beasiswaPopuler'));
    }

    public function show($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('beasiswa.show', compact('beasiswa'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        // Jika query kosong, redirect
        if (empty($query)) {
            return redirect()->route('beasiswa.index');
        }
        
        // Search dan ambil unique berdasarkan nama
        $beasiswas = Beasiswa::where('nama', 'like', '%' . $query . '%')
            ->orWhere('universitas', 'like', '%' . $query . '%')
            ->orWhere('jurusan', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('nama') // Hapus duplikat
            ->values();

        // Manual pagination
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        
        $paginatedItems = $beasiswas->slice($offset, $perPage)->values();
        
        $beasiswas = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedItems,
            $beasiswas->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('beasiswa.search', compact('beasiswas', 'query'));
    }
}
