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
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y') }}
                </h2>
                <div class="flex gap-4">
                    @php
                        $prevMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->subMonth();
                        $nextMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->addMonth();
                    @endphp
                    <a href="{{ route('akademik.kalender', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                       class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-[#E8F5F3] hover:text-[#3B8773] transition font-medium">
                        Bulan Sebelumnya
                    </a>
                    <a href="{{ route('akademik.kalender', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                       class="px-6 py-2.5 bg-[#3B8773] text-white rounded-lg hover:bg-[#2E6B5B] transition font-medium">
                        Bulan Berikutnya
                    </a>
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
                            $firstDay = \Carbon\Carbon::createFromDate($year, $month, 1);
                            $lastDay = $firstDay->copy()->endOfMonth();
                            $startWeek = $firstDay->copy()->startOfWeek();
                            $endWeek = $lastDay->copy()->endOfWeek();

                            $eventsByDate = $events->groupBy(function($event) {
                                return $event->event_date->format('Y-m-d');
                            });
                        @endphp

                        @for ($date = $startWeek->copy(); $date <= $endWeek; $date->addDay())
                            @if ($date->isMonday())
                                <tr>
                            @endif

                            @php
                                $hasEvent = isset($eventsByDate[$date->format('Y-m-d')]);
                                $isCurrentMonth = $date->month == $month;
                            @endphp

                            <td class="px-4 py-6 border border-gray-100 {{ $hasEvent && $isCurrentMonth ? 'bg-[#F0F9F7]' : '' }} hover:bg-[#E8F5F3] transition relative">
                                @if ($isCurrentMonth)
                                    <a href="{{ route('akademik.kalender.detail', ['day' => $date->day, 'year' => $year, 'month' => $month]) }}" class="block">
                                        <div class="text-sm font-bold mb-2 {{ $date->isToday() ? 'text-[#3B8773]' : 'text-gray-700' }}">
                                            {{ $date->day }}
                                        </div>
                                        @if ($hasEvent)
                                            <div class="flex items-center justify-center gap-1">
                                                <div class="w-2 h-2 bg-[#3B8773] rounded-full"></div>
                                                <span class="text-xs text-[#3B8773] font-medium">
                                                    {{ count($eventsByDate[$date->format('Y-m-d')]) }} acara
                                                </span>
                                            </div>
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
                <h2 class="text-3xl font-bold text-gray-900">Acara Bulan Ini</h2>
            </div>

            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <a href="{{ route('akademik.event.show', $event->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 border border-gray-100 group">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 bg-[#E8F5F3] rounded-xl flex items-center justify-center text-xl">
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
                                <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full">
                                    {{ $event->category }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                            <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $event->event_date->translatedFormat('d F Y') }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 font-medium">Tidak ada acara akademik bulan ini</p>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
