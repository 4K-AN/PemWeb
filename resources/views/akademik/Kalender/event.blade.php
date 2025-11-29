@extends('layouts.app')

@section('title', $event->title . ' - Kalender Akademik')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('akademik.kalender', ['year' => $year, 'month' => $month]) }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Kalender
            </a>
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <span class="inline-block bg-white/20 px-4 py-1 rounded-full text-sm font-bold mb-3">
                        {{ $event->category }}
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $event->title }}</h1>
                    <p class="text-lg text-gray-200">{{ $event->event_date->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Event Details -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail Acara</h2>

            <div class="space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 mb-3">Tanggal & Waktu</h3>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium">{{ $event->event_date->translatedFormat('d F Y') }}</span>
                            </div>
                            @if($event->start_time)
                                <div class="flex items-center gap-3 text-gray-700">
                                    <svg class="w-5 h-5 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                        @if($event->end_time)
                                            - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                        @endif
                                        WIB
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($event->location)
                        <div>
                            <h3 class="text-sm font-bold text-gray-500 mb-3">Lokasi</h3>
                            <div class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $event->location }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
