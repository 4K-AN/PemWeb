@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">
        Hasil Pencarian: "{{ $query }}"
    </h1>
    <p class="text-gray-600 mb-8">Ditemukan {{ $beasiswas->total() }} beasiswa</p>

    @if($beasiswas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($beasiswas as $beasiswa)
                @include('beasiswa.card', ['beasiswa' => $beasiswa])
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $beasiswas->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Hasil</h3>
            <p class="text-gray-600 mb-6">Coba gunakan kata kunci lain</p>
            <a 
                href="{{ route('beasiswa.index') }}"
                class="inline-block bg-gradient-to-r from-green-600 to-green-500 text-white px-8 py-3 rounded-lg hover:from-green-700 hover:to-green-600 transition"
            >
                Kembali ke Beranda
            </a>
        </div>
    @endif
</div>
@endsection