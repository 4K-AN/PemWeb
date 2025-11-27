@extends('layouts.app')

@section('title', 'Info Beasiswa')

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Header -->
    <h1 class="text-6xl font-bold bg-gradient-to-r from-green-800 to-teal-700 bg-clip-text text-transparent mb-10">
        Info Beasiswa
    </h1>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border border-green-100">
        <form action="{{ route('beasiswa.search') }}" method="GET">
            <div class="flex gap-4 mb-6">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="q"
                        placeholder="Cari berdasarkan nama Beasiswa, Jurusan, atau Universitas"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    >
                </div>
                <button 
                    type="submit"
                    class="bg-gradient-to-r from-green-600 to-green-500 text-white px-10 py-3 rounded-xl hover:from-green-700 hover:to-green-600 transition font-medium shadow-md"
                >
                    Cari
                </button>
            </div>
        </form>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap gap-3">
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Jurusan
            </button>
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Biaya pendaftaran
            </button>
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Status Pendaftar
            </button>
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Jenjang Pendidikan
            </button>
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Tenggat
            </button>
            <button class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                Bentuk Bantuan
            </button>
        </div>
    </div>

    <!-- Beasiswa Terbaru -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
            <div class="w-2 h-8 bg-gradient-to-b from-green-600 to-green-400 rounded-full"></div>
            Beasiswa Terbaru
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($beasiswaTerbaru as $beasiswa)
                @include('beasiswa.card', ['beasiswa' => $beasiswa])
            @endforeach
        </div>
    </section>

    <!-- Beasiswa Terpopuler -->
    <section>
        <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
            <div class="w-2 h-8 bg-gradient-to-b from-teal-600 to-teal-400 rounded-full"></div>
            Beasiswa Terpopuler
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($beasiswaPopuler as $beasiswa)
                @include('beasiswa.card', ['beasiswa' => $beasiswa])
            @endforeach
        </div>
    </section>
</div>
@endsection