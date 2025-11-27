@extends('layouts.app')

@section('title', 'Kalender Akademik - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Kalender Akademik</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Lihat jadwal lengkap kegiatan akademik untuk tahun ini dan rencanakan waktu Anda dengan baik.</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Calendar Navigation -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h2>
                <div class="flex gap-4">
                    <button class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                        ← Bulan Sebelumnya
                    </button>
                    <button class="px-6 py-2.5 bg-[#3B8773] text-white rounded-lg hover:bg-[#2E6B5B] transition font-medium">
                        Bulan Berikutnya →
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="overflow-x-auto">
                <table class="w-full text-center">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Senin</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Selasa</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Rabu</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Kamis</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Jumat</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Sabtu</th>
                            <th class="px-4 py-4 text-sm font-bold text-gray-700">Minggu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $now = \Carbon\Carbon::now();
                            $firstDay = $now->copy()->startOfMonth();
                            $lastDay = $now->copy()->endOfMonth();
                            $startWeek = $firstDay->copy()->startOfWeek();
                            $endWeek = $lastDay->copy()->endOfWeek();
                        @endphp

                        @for ($date = $startWeek; $date <= $endWeek; $date->addDay())
                            @if ($date->isMonday())
                                <tr>
                            @endif

                            <td class="px-4 py-6 border border-gray-100 hover:bg-[#F0F9F7] transition">
                                @if ($date->month == $now->month)
                                    <a href="{{ route('akademik.kalender.detail', $date->day) }}" class="block">
                                        <div class="text-sm font-bold mb-2 {{ $date->isToday() ? 'text-[#3B8773]' : 'text-gray-700' }}">
                                            {{ $date->day }}
                                        </div>
                                        @if ($date->isToday())
                                            <div class="inline-block w-2 h-2 bg-[#3B8773] rounded-full"></div>
                                        @endif
                                    </a>
                                @else
                                    <div class="text-sm font-bold text-gray-400">{{ $date->day }}</div>
                                @endif
                            </td>

                            @if ($date->isSunday())
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Events List -->
        <section>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-900">Acara Akademik</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event Card 1 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            📚
                        </div>
                        <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full">
                            Penting
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Pendaftaran Siswa Baru</h3>
                    <p class="text-sm text-gray-600 mb-4">Periode pendaftaran siswa baru untuk tahun akademik berikutnya</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        1 - 15 Januari 2025
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            🎓
                        </div>
                        <span class="text-xs font-bold text-white bg-blue-500 px-3 py-1 rounded-full">
                            Akademik
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Orientasi Siswa</h3>
                    <p class="text-sm text-gray-600 mb-4">Program pengenalan sekolah dan lingkungan akademik untuk siswa baru</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        18 - 20 Januari 2025
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            📖
                        </div>
                        <span class="text-xs font-bold text-white bg-green-500 px-3 py-1 rounded-full">
                            Pembelajaran
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Dimulai Tahun Ajaran Baru</h3>
                    <p class="text-sm text-gray-600 mb-4">Hari pertama kegiatan belajar mengajar tahun ajaran 2024/2025</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        21 Januari 2025
                    </div>
                </div>

                <!-- Event Card 4 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            ✏️
                        </div>
                        <span class="text-xs font-bold text-white bg-yellow-500 px-3 py-1 rounded-full">
                            Ujian
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Ujian Semester Gasal</h3>
                    <p class="text-sm text-gray-600 mb-4">Pelaksanaan ujian akhir semester untuk semua mata pelajaran</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        1 - 15 Desember 2024
                    </div>
                </div>

                <!-- Event Card 5 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            🎉
                        </div>
                        <span class="text-xs font-bold text-white bg-purple-500 px-3 py-1 rounded-full">
                            Liburan
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Liburan Semester</h3>
                    <p class="text-sm text-gray-600 mb-4">Masa istirahat untuk siswa setelah selesai mengikuti ujian semester</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        16 Desember 2024 - 5 Januari 2025
                    </div>
                </div>

                <!-- Event Card 6 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            📊
                        </div>
                        <span class="text-xs font-bold text-white bg-red-500 px-3 py-1 rounded-full">
                            Pengumuman
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Pengumuman Nilai Semester</h3>
                    <p class="text-sm text-gray-600 mb-4">Pengumuman hasil nilai akhir untuk semua siswa tahun akademik ini</p>
                    <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                        <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        20 Desember 2024
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
