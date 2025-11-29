@extends('layouts.app')

@section('title', 'Info Tryout - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Info Tryout</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Temukan tryout dan simulasi ujian untuk persiapan maksimal Anda</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
            <form action="{{ route('tryout.index') }}" method="GET" id="filter-form">
                <!-- Main Search Bar -->
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Cari tryout berdasarkan nama atau penyelenggara..."
                           class="flex-1 px-5 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium text-gray-700">

                    <button type="button" onclick="toggleFilters()"
                            class="px-6 py-3.5 bg-gray-100 border-2 border-gray-200 text-gray-700 rounded-xl font-bold hover:bg-[#E8F5F3] hover:border-[#3B8773] hover:text-[#3B8773] transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        <span class="hidden md:inline">Filter & Urutkan</span>
                        <span class="md:hidden">Filter</span>
                    </button>

                    <button type="submit"
                            class="px-8 py-3.5 bg-[#3B8773] text-white rounded-xl font-bold hover:bg-[#2E6B5B] transition shadow-md">
                        Cari
                    </button>
                </div>

                <!-- Collapsible Filters -->
                <div id="filter-section" class="hidden mt-6 pt-6 border-t border-gray-200">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <!-- Jenis Ujian -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Jenis Ujian</label>
                            <select name="kategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium">
                                <option value="">Semua Jenis</option>
                                @if($kategoris && $kategoris->count() > 0)
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Lokasi</label>
                            <select name="lokasi" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium">
                                <option value="">Semua Lokasi</option>
                                @if($lokasis && $lokasis->count() > 0)
                                    @foreach($lokasis as $lok)
                                        <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Waktu Pelaksanaan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Waktu Pelaksanaan</label>
                            <select name="waktu" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium">
                                <option value="">Semua Waktu</option>
                                <option value="minggu_ini" {{ request('waktu') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan_ini" {{ request('waktu') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="bulan_depan" {{ request('waktu') == 'bulan_depan' ? 'selected' : '' }}>Bulan Depan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fitur Filter (Checkbox) -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Fitur Tambahan</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('gratis') ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                <input type="checkbox" name="gratis" value="1" {{ request('gratis') ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] rounded">
                                <span class="text-sm font-medium text-gray-700">Gratis</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('pembahasan') ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                <input type="checkbox" name="pembahasan" value="1" {{ request('pembahasan') ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] rounded">
                                <span class="text-sm font-medium text-gray-700">Dengan Pembahasan</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('sertifikat') ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                <input type="checkbox" name="sertifikat" value="1" {{ request('sertifikat') ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] rounded">
                                <span class="text-sm font-medium text-gray-700">Dengan Sertifikat</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('ranking') ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                <input type="checkbox" name="ranking" value="1" {{ request('ranking') ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773] rounded">
                                <span class="text-sm font-medium text-gray-700">Ranking Nasional</span>
                            </label>
                        </div>
                    </div>

                    <!-- Sorting -->
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Urutkan Berdasarkan</label>
                            <select name="sort" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium">
                                <option value="tanggal_pelaksanaan" {{ request('sort') == 'tanggal_pelaksanaan' ? 'selected' : '' }}>Tanggal Pelaksanaan</option>
                                <option value="deadline_pendaftaran" {{ request('sort') == 'deadline_pendaftaran' ? 'selected' : '' }}>Deadline Pendaftaran</option>
                                <option value="biaya" {{ request('sort') == 'biaya' ? 'selected' : '' }}>Biaya</option>
                                <option value="nama_tryout" {{ request('sort') == 'nama_tryout' ? 'selected' : '' }}>Nama Tryout</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Urutan</label>
                            <div class="flex gap-3">
                                <label class="flex-1 flex items-center justify-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('order', 'asc') == 'asc' ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                    <input type="radio" name="order" value="asc" {{ request('order', 'asc') == 'asc' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                    <span class="text-sm font-medium text-gray-700">Naik</span>
                                </label>
                                <label class="flex-1 flex items-center justify-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-[#3B8773] transition cursor-pointer {{ request('order') == 'desc' ? 'bg-[#E8F5F3] border-[#3B8773]' : '' }}">
                                    <input type="radio" name="order" value="desc" {{ request('order') == 'desc' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                    <span class="text-sm font-medium text-gray-700">Turun</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-[#3B8773] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2E6B5B] transition">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('tryout.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">
                            Reset
                        </a>
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
                        {{ $tryouts->total() }} Tryout Ditemukan
                    </h2>
                </div>
            </div>

            @if($tryouts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($tryouts as $tryout)
                        <a href="{{ route('tryout.show', $tryout->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-2xl">
                                    📝
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full">
                                        {{ $tryout->kategori ?? 'Umum' }}
                                    </span>
                                    @if($tryout->biaya == 0)
                                        <span class="text-xs font-bold text-white bg-green-500 px-3 py-1 rounded-full">
                                            GRATIS
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition line-clamp-2">
                                {{ $tryout->nama_tryout }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $tryout->penyelenggara }}</p>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $tryout->tanggal_pelaksanaan ? $tryout->tanggal_pelaksanaan->format('d M Y') : '-' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $tryout->lokasi }}</span>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                @if($tryout->biaya > 0)
                                    <span class="text-sm font-bold text-[#3B8773]">Rp {{ number_format($tryout->biaya, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-sm font-bold text-green-600">Gratis</span>
                                @endif
                                <span class="text-xs text-gray-500 group-hover:text-[#3B8773] transition">Lihat Detail →</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $tryouts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium mb-4">Tidak ada tryout yang ditemukan</p>
                    <a href="{{ route('tryout.index') }}" class="text-[#3B8773] font-bold hover:text-[#2E6B5B] transition">Reset Filter</a>
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
    @if(request()->has('kategori') || request()->has('lokasi') || request()->has('waktu') || request()->has('gratis') || request()->has('pembahasan') || request()->has('sertifikat') || request()->has('ranking') || request()->has('sort'))
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
