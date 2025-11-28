@extends('layouts.app')

@section('title', $job['title'] . ' - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-12 pb-20 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('simulasi.karir') }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Simulasi Karir
            </a>

            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm text-3xl font-bold">
                    {{ strtoupper(substr($job['title'], 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-5xl font-bold mb-4">{{ $job['title'] }}</h1>
                    <p class="text-lg text-gray-200 leading-relaxed max-w-2xl">{{ $job['description'] }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        @if(isset($job['salary']))
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                        <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Kisaran Gaji</h2>
                </div>
                <div class="text-3xl font-bold text-[#3B8773]">{{ $job['salary'] }}</div>
                <p class="text-gray-600 mt-2">Per bulan (berdasarkan pengalaman dan lokasi)</p>
            </div>
        @endif

        @if(isset($job['skills']))
            <section class="mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Skill yang Diperlukan</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($job['skills'] as $skill)
                            <div class="flex items-start gap-4 p-4 bg-gradient-to-br from-[#F0F9F7] to-white rounded-xl border border-[#E8F5F3]">
                                <div class="w-6 h-6 bg-[#3B8773] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">{{ $skill }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(isset($job['career_path']))
            <section class="mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
                            <svg class="w-6 h-6 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Jalur Karir</h2>
                    </div>

                    <div class="relative">
                        <div class="space-y-6">
                            @foreach($job['career_path'] as $index => $path)
                                <div class="flex gap-6">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-12 bg-[#3B8773] text-white rounded-full flex items-center justify-center font-bold text-lg relative z-10">
                                            {{ $index + 1 }}
                                        </div>
                                        @if($index < count($job['career_path']) - 1)
                                            <div class="w-1 h-16 bg-gradient-to-b from-[#3B8773] to-gray-200 mt-2"></div>
                                        @endif
                                    </div>

                                    <div class="pb-6 flex-1">
                                        <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-6 rounded-xl border border-[#E8F5F3] hover:border-[#3B8773]/30 transition">
                                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $path }}</h3>
                                            <p class="text-sm text-gray-600">
                                                Tahap pengembangan karir yang progresif untuk mencapai tujuan profesional Anda
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] text-white rounded-2xl p-10 text-center">
            <h2 class="text-3xl font-bold mb-4">Tertarik dengan Karir Ini?</h2>
            <p class="text-gray-200 mb-8 max-w-2xl mx-auto">Konsultasikan dengan AI Edvizo untuk mengetahui apakah karir ini cocok dengan minat dan kemampuan Anda</p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-2 bg-white text-[#3B8773] px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Konsultasi Sekarang
                </a>
                <a href="{{ route('simulasi.karir') }}" class="inline-flex items-center gap-2 bg-transparent border-2 border-white text-white px-8 py-3 rounded-xl font-bold hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Lihat Karir Lain
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
