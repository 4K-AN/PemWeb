@extends('layouts.app')

@section('title', 'Simulasi Karir - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Simulasi Karir</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Jelajahi berbagai jalur karir yang tersedia dan temukan yang cocok untuk Anda</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Pesan jika belum fiksasi jurusan -->
        @if (!$fixation)
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-8 rounded-lg mb-12">
                <div class="flex items-start gap-4">
                    <div class="text-4xl">!</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Maaf, Anda Belum Fiksasi Jurusan</h2>
                        <p class="text-gray-700 mb-4">Untuk melihat simulasi karir berdasarkan jurusan yang cocok untuk Anda, silakan lakukan konsultasi dan fiksasi jurusan terlebih dahulu.</p>
                        <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-bold transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Mulai Konsultasi & Fiksasi Jurusan
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Jika sudah fiksasi jurusan -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-8 rounded-lg mb-12">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="text-4xl">✓</div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Jurusan yang Difiksasi</h2>
                            <p class="text-gray-700 mb-2"><strong>{{ $fixation->jurusan }}</strong></p>
                            <p class="text-gray-600 text-sm">{{ $fixation->deskripsi }}</p>
                        </div>
                    </div>
                    <a href="{{ route('chatbot.index') }}" class="text-sm font-bold text-[#3B8773] hover:text-[#2E6B5B] transition">
                        Fiksasi Ulang
                    </a>
                </div>
            </div>

            <!-- Karir Rekomendasi berdasarkan jurusan -->
            <section>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Karir yang Sesuai untuk {{ $fixation->jurusan }}</h2>
                </div>

                @if($error)
                    <div class="bg-red-50 border-l-4 border-red-400 p-8 rounded-lg mb-8">
                        <div class="flex items-start gap-4">
                            <div class="text-4xl">⚠️</div>
                            <div>
                                <h3 class="text-xl font-bold text-red-900 mb-2">Terjadi Kesalahan</h3>
                                <p class="text-red-700 mb-4">{{ $error }}</p>
                                <p class="text-sm text-red-600">Silakan cek file log di <code class="bg-red-100 px-2 py-1 rounded">storage/logs/laravel.log</code> untuk detail error.</p>
                                <a href="{{ route('simulasi.karir') }}" class="inline-block mt-4 bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">
                                    Coba Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif(count($careers) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($careers as $career)
                            <a href="{{ route('simulasi.karir.detail', $career['id']) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100 h-full flex flex-col">
                                <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center text-white text-4xl font-bold">
                                    {{ strtoupper(substr($career['title'], 0, 1)) }}
                                </div>
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">{{ $career['title'] }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $career['description'] }}</p>

                                    @if (isset($career['relevance']))
                                        <div class="mb-4 p-3 bg-[#F0F9F7] rounded-lg border border-[#3B8773]/10">
                                            <p class="text-xs font-semibold text-[#3B8773] mb-1">Relevansi</p>
                                            <p class="text-sm text-gray-700 line-clamp-2">{{ $career['relevance'] }}</p>
                                        </div>
                                    @endif

                                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                        <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Rekomendasi AI</span>
                                        <span class="text-xs text-gray-500 font-medium">{{ $career['salary'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-md p-12 border border-gray-100 text-center">
                        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-[#3B8773] mx-auto mb-4"></div>
                        <p class="text-gray-600 font-medium mb-4">Sedang memuat rekomendasi karir dari AI...</p>
                        <p class="text-sm text-gray-500 mb-4">Ini mungkin memakan waktu hingga 60 detik</p>
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg text-left">
                            <p class="text-xs text-gray-600 font-mono mb-2">Debug Info:</p>
                            <p class="text-xs text-gray-500">User ID: {{ Auth::id() }}</p>
                            <p class="text-xs text-gray-500">Fixation ID: {{ $fixation->id }}</p>
                            <p class="text-xs text-gray-500">Jurusan: {{ $fixation->jurusan }}</p>
                            <p class="text-xs text-gray-500 mt-2">Cek log: <code>storage/logs/laravel.log</code></p>
                        </div>
                        <a href="{{ route('simulasi.karir') }}" class="inline-block mt-4 text-[#3B8773] font-bold hover:text-[#2E6B5B] transition">
                            Refresh Halaman
                        </a>
                    </div>
                @endif
            </section>

            <!-- Detail Analisis Fiksasi -->
            @if($fixation->swot)
                <section class="mt-16">
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Analisis Fiksasi Anda</h3>

                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-900 mb-3">Alasan Cocok</h4>
                            <p class="text-gray-700 leading-relaxed">{{ $fixation->alasan_cocok }}</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-xl border border-green-100">
                                <h5 class="text-lg font-bold text-green-700 mb-3">Kekuatan</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['strengths'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-green-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl border border-red-100">
                                <h5 class="text-lg font-bold text-red-700 mb-3">Kelemahan</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['weaknesses'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-red-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-xl border border-blue-100">
                                <h5 class="text-lg font-bold text-blue-700 mb-3">Peluang</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['opportunities'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-blue-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="bg-gradient-to-br from-orange-50 to-white p-6 rounded-xl border border-orange-100">
                                <h5 class="text-lg font-bold text-orange-700 mb-3">Ancaman</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['threats'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-orange-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endif
    </div>
</div>
@endsection
