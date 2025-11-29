@extends('layouts.app')

@section('title', 'Informasi Beasiswa - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Informasi Beasiswa</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Temukan berbagai peluang beasiswa untuk mendukung pendidikan Anda</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8 border border-gray-100">
            <form action="{{ route('beasiswa.index') }}" method="GET" id="filter-form">
                <!-- Main Search Bar -->
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Cari beasiswa berdasarkan nama, universitas, atau jurusan..."
                           class="flex-1 px-5 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700 placeholder-gray-400">

                    <button type="button" onclick="toggleFilters()"
                            class="px-6 py-3.5 bg-gray-100 border-2 border-gray-200 text-gray-700 rounded-xl font-bold hover:bg-[#E8F5F3] hover:border-[#3B8773] hover:text-[#3B8773] transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        <span class="hidden md:inline">Filter & Urutkan</span>
                        <span class="md:hidden">Filter</span>
                    </button>

                    <button type="submit"
                            class="px-8 py-3.5 bg-[#3B8773] text-white rounded-xl font-bold hover:bg-[#2E6B5B] transition shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="hidden md:inline">Cari</span>
                    </button>
                </div>

                <!-- Collapsible Filters -->
                <div id="filter-section" class="hidden">
                    <div class="border-t border-gray-200 pt-6 space-y-6">
                        <!-- Filter Grid -->
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Jenis Beasiswa -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Jenis Beasiswa
                                </label>
                                <select name="jenis" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700 bg-white">
                                    <option value="">Semua Jenis</option>
                                    @foreach($jenisBeasiswas as $jenis)
                                        <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori/Bidang Studi -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Bidang Studi
                                </label>
                                <select name="kategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700 bg-white">
                                    <option value="">Semua Bidang</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Negara -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Negara
                                </label>
                                <select name="negara" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700 bg-white">
                                    <option value="">Semua Negara</option>
                                    @foreach($negaras as $neg)
                                        <option value="{{ $neg }}" {{ request('negara') == $neg ? 'selected' : '' }}>{{ $neg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Sorting -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                    </svg>
                                    Urutkan Berdasarkan
                                </label>
                                <select name="sort" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700 bg-white">
                                    <option value="deadline" {{ request('sort', 'deadline') == 'deadline' ? 'selected' : '' }}>Deadline Terdekat</option>
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3">Urutan</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="flex items-center justify-center gap-2 p-3 border-2 {{ request('order', 'asc') == 'asc' ? 'border-[#3B8773] bg-[#E8F5F3]' : 'border-gray-200' }} rounded-xl hover:border-[#3B8773] transition cursor-pointer">
                                        <input type="radio" name="order" value="asc" {{ request('order', 'asc') == 'asc' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] border-gray-300 focus:ring-[#3B8773]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">Naik</span>
                                    </label>
                                    <label class="flex items-center justify-center gap-2 p-3 border-2 {{ request('order') == 'desc' ? 'border-[#3B8773] bg-[#E8F5F3]' : 'border-gray-200' }} rounded-xl hover:border-[#3B8773] transition cursor-pointer">
                                        <input type="radio" name="order" value="desc" {{ request('order') == 'desc' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] border-gray-300 focus:ring-[#3B8773]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">Turun</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 bg-[#3B8773] text-white px-6 py-3.5 rounded-xl font-bold hover:bg-[#2E6B5B] transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Terapkan Filter
                            </button>
                            <a href="{{ route('beasiswa.index') }}" class="px-6 py-3.5 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results -->
        <section>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $beasiswas->total() }} Beasiswa Ditemukan
                    </h2>
                </div>
            </div>

            @if($beasiswas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($beasiswas as $beasiswa)
                        <a href="{{ route('beasiswa.show', $beasiswa->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-2xl">
                                    🎓
                                </div>
                                <div class="flex flex-col gap-2">
                                    @if($beasiswa->jenis_beasiswa)
                                        <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full">
                                            {{ $beasiswa->jenis_beasiswa }}
                                        </span>
                                    @endif
                                    @if($beasiswa->jenjang)
                                        <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                            {{ $beasiswa->jenjang }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition line-clamp-2">
                                {{ $beasiswa->nama }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $beasiswa->universitas }}</p>
                            <div class="space-y-2 mb-4">
                                @if($beasiswa->negara)
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $beasiswa->negara }}</span>
                                    </div>
                                @endif
                                @if($beasiswa->deadline)
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $beasiswa->deadline->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                @if($beasiswa->kategori)
                                    <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">{{ $beasiswa->kategori }}</span>
                                @endif
                                <span class="text-xs text-gray-500 group-hover:text-[#3B8773] transition">Lihat Detail →</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $beasiswas->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium mb-4">Tidak ada beasiswa yang ditemukan</p>
                    <a href="{{ route('beasiswa.index') }}" class="text-[#3B8773] font-bold hover:text-[#2E6B5B] transition">Reset Filter</a>
                </div>
            @endif
        </section>
    </div>
</div>

<script>
    function toggleFilters() {
        const filterSection = document.getElementById('filter-section');
        if (filterSection.classList.contains('hidden')) {
            filterSection.classList.remove('hidden');
            filterSection.classList.add('animate-fadeIn');
        } else {
            filterSection.classList.add('hidden');
        }
    }

    // Auto-open filters if any filter is active
    @if(request()->has('jenis') || request()->has('kategori') || request()->has('negara') || request()->has('sort'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('filter-section').classList.remove('hidden');
        });
    @endif
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endsection
