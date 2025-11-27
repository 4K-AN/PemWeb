@extends('layouts.app')

@section('title', 'Info Beasiswa - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Informasi Beasiswa</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Temukan dan akses ribuan peluang beasiswa dari berbagai universitas terkemuka.</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border border-gray-100">
            <form action="{{ route('beasiswa.search') }}" method="GET">
                <div class="flex gap-4 mb-6">
                    <div class="flex-1">
                        <input
                            type="text"
                            name="q"
                            placeholder="Cari berdasarkan nama Beasiswa, Jurusan, atau Universitas"
                            class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium"
                        >
                    </div>
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] text-white px-10 py-3 rounded-xl hover:shadow-lg transition font-bold shadow-md"
                    >
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                </div>
            </form>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    📚 Jurusan
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    💰 Biaya
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    👥 Status
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    📖 Jenjang
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    ⏰ Tenggat
                </button>
                <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-full hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                    🎁 Bentuk
                </button>
            </div>
        </div>

        <!-- Beasiswa Terbaru -->
        <section class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-900">Beasiswa Terbaru</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($beasiswaTerbaru ?? [] as $beasiswa)
                    @include('beasiswa.card', ['beasiswa' => $beasiswa])
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500 font-medium">Belum ada data beasiswa</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Beasiswa Terpopuler -->
        <section>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-8 bg-gradient-to-b from-[#2E6B5B] to-[#3B8773] rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-900">Beasiswa Terpopuler</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($beasiswaPopuler ?? [] as $beasiswa)
                    @include('beasiswa.card', ['beasiswa' => $beasiswa])
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500 font-medium">Belum ada data beasiswa</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
