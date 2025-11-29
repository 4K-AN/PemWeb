@extends('layouts.app')

@section('title', $beasiswa->nama . ' - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('beasiswa.index') }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Beasiswa
            </a>
            <div class="flex items-start gap-6">
                <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm text-4xl flex-shrink-0">
                    🎓
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @if($beasiswa->status)
                            <span class="bg-green-400 text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $beasiswa->status }}
                            </span>
                        @endif
                        @if($beasiswa->jenis_beasiswa)
                            <span class="bg-white/20 px-4 py-1 rounded-full text-sm font-bold">
                                {{ $beasiswa->jenis_beasiswa }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-3">{{ $beasiswa->nama }}</h1>
                    <p class="text-lg text-gray-200">{{ $beasiswa->universitas }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Main Info Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                Tentang Beasiswa
            </h2>
            <p class="text-gray-700 leading-relaxed text-lg">{{ $beasiswa->deskripsi }}</p>
        </div>

        <!-- Details Grid - Simetris 2x2 -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Negara -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Negara</h3>
                </div>
                <p class="text-gray-700 text-lg font-medium">{{ $beasiswa->negara }}</p>
            </div>

            <!-- Bidang Studi -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Bidang Studi</h3>
                </div>
                <p class="text-gray-700 text-lg font-medium">{{ $beasiswa->kategori ?? 'Semua Bidang' }}</p>
            </div>

            <!-- Deadline -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Deadline</h3>
                </div>
                @if($beasiswa->deadline)
                    <p class="text-red-600 text-lg font-bold">{{ $beasiswa->deadline->translatedFormat('d F Y') }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        @php
                            $daysLeft = (int) now()->diffInDays($beasiswa->deadline, false);
                        @endphp
                        @if($daysLeft > 0)
                            {{ $daysLeft }} hari lagi
                        @elseif($daysLeft == 0)
                            Hari ini!
                        @else
                            Sudah ditutup
                        @endif
                    </p>
                @else
                    <p class="text-gray-500 text-lg">Belum ditentukan</p>
                @endif
            </div>

            <!-- Jenis Beasiswa -->
            @if($beasiswa->jenis_beasiswa)
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Jenis Beasiswa</h3>
                </div>
                <p class="text-[#3B8773] text-xl font-bold">{{ $beasiswa->jenis_beasiswa }}</p>
            </div>
            @endif

            <!-- Jurusan - Full Width -->
            @if($beasiswa->jurusan)
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Jurusan yang Tersedia</h3>
                </div>
                <p class="text-gray-700 text-lg font-medium">{{ $beasiswa->jurusan }}</p>
            </div>
            @endif
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] rounded-2xl p-8 text-white text-center">
            <h3 class="text-2xl font-bold mb-3">Tertarik dengan Beasiswa Ini?</h3>
            <p class="text-gray-200 mb-6 max-w-2xl mx-auto">Segera daftarkan diri Anda dan raih kesempatan emas untuk melanjutkan pendidikan dengan beasiswa ini!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('beasiswa.index') }}" class="px-8 py-4 bg-white text-[#3B8773] rounded-xl font-bold hover:bg-gray-100 transition shadow-lg inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Lihat Beasiswa Lain
                </a>
                @if($beasiswa->link_pendaftaran)
                    <a href="{{ $beasiswa->link_pendaftaran }}" target="_blank" rel="noopener noreferrer" class="px-8 py-4 bg-white text-[#3B8773] rounded-xl font-bold hover:bg-gray-100 transition shadow-lg inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Daftar Sekarang
                    </a>
                @else
                    <button onclick="alert('Link pendaftaran belum tersedia. Silakan cek kembali nanti atau hubungi universitas terkait.')" class="px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white rounded-xl font-bold hover:bg-white/20 transition inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Link Belum Tersedia
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
