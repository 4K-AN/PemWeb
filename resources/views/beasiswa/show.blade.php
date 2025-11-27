@extends('layouts.app')

@section('title', $beasiswa->nama)

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl shadow-xl p-10 border border-green-100">
        <div class="flex items-start gap-6 mb-8">
            @if($beasiswa->gambar)
            <img 
                src="{{ asset('storage/' . $beasiswa->gambar) }}" 
                alt="{{ $beasiswa->nama }}"
                class="w-32 h-40 object-cover rounded-xl"
            >
            @else
            <div class="w-32 h-40 bg-gradient-to-br from-green-400 to-teal-500 rounded-xl flex items-center justify-center text-6xl">
                🎓
            </div>
            @endif
            
            <div class="flex-1">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $beasiswa->nama }}</h1>
                <div class="flex flex-wrap gap-3 mb-4">
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-medium">
                        {{ $beasiswa->jurusan }}
                    </span>
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-medium">
                        {{ $beasiswa->status }}
                    </span>
                    <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-lg font-medium">
                        {{ $beasiswa->jenjang }}
                    </span>
                </div>
                <p class="text-gray-600 text-lg mb-4">{{ $beasiswa->universitas }}</p>
                <p class="text-red-600 font-semibold">
                    Deadline: {{ $beasiswa->deadline->format('d F Y') }}
                </p>
                <p class="text-green-600 font-semibold mt-2">
                    IPK Minimal: {{ $beasiswa->ipk_minimal }}
                </p>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi</h3>
            <p class="text-gray-600 leading-relaxed">{{ $beasiswa->deskripsi }}</p>
        </div>

        <div class="flex gap-4">
            <a 
                href="{{ route('beasiswa.index') }}"
                class="flex-1 bg-gray-200 text-gray-700 py-4 rounded-xl hover:bg-gray-300 transition text-center font-bold"
            >
                ← Kembali
            </a>
            <button class="flex-1 bg-gradient-to-r from-green-600 to-green-500 text-white py-4 rounded-xl hover:from-green-700 hover:to-green-600 transition font-bold shadow-lg">
                Daftar Sekarang
            </button>
        </div>
    </div>
</div>
@endsection