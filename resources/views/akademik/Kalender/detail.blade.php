@extends('layouts.app')

@section('title', 'Detail Kegiatan - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('akademik.kalender', ['year' => $year ?? now()->year, 'month' => $month ?? now()->month]) }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Kalender
            </a>
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                    <div class="text-3xl font-bold">{{ $day }}</div>
                </div>
                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2">
                        {{ isset($date) ? $date->translatedFormat('l, d F Y') : 'Kegiatan Tanggal ' . $day }}
                    </h1>
                    <p class="text-lg text-gray-200">
                        @if(isset($events) && $events->count() > 0)
                            {{ $events->count() }} kegiatan dijadwalkan
                        @else
                            Tidak ada kegiatan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        @if(isset($events) && $events->count() > 0)
            <div class="space-y-4">
                @foreach($events as $event)
                    <a href="{{ route('akademik.event.show', ['id' => $event->id, 'year' => $year ?? now()->year, 'month' => $month ?? now()->month]) }}"
                       class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-2xl shrink-0 group-hover:bg-[#3B8773] group-hover:text-white transition">
                                @php
                                    $categoryIcons = [
                                        'Pendaftaran' => '📝',
                                        'Akademik' => '🎓',
                                        'Pembelajaran' => '📚',
                                        'Ujian' => '✏️',
                                        'Liburan' => '🌴',
                                        'Pengumuman' => '📢',
                                    ];
                                @endphp
                                {{ $categoryIcons[$event->category] ?? '📅' }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#3B8773] transition">
                                        {{ $event->title }}
                                    </h3>
                                    <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full shrink-0 ml-3">
                                        {{ $event->category }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $event->description }}</p>
                                <div class="flex items-center gap-4 text-sm text-gray-700">
                                    @if($event->start_time)
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    @if($event->location)
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="font-medium">{{ Str::limit($event->location, 30) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-[#3B8773] transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium text-lg">Tidak ada kegiatan yang dijadwalkan untuk tanggal ini</p>
            </div>
        @endif
    </div>
</div>
@endsection
