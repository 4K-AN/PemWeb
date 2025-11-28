@extends('layouts.app')

@section('title', 'Informasi Tryout - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Informasi Tryout</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Persiapkan diri Anda dengan mengikuti berbagai tryout dan simulasi ujian</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border border-gray-100">
            <form action="{{ route('tryout.index') }}" method="GET" class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Cari Tryout</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama tryout atau penyelenggara..."
                           class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition font-medium">
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Kategori</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-4">
                            <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="radio" name="kategori" value="" {{ request('kategori') == '' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                <span class="text-gray-700 font-medium">Semua Kategori</span>
                            </label>
                            @foreach($kategoris as $kat)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                    <input type="radio" name="kategori" value="{{ $kat }}" {{ request('kategori') == $kat ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                    <span class="text-gray-700 font-medium">{{ $kat }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Lokasi</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-4">
                            <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="radio" name="lokasi" value="" {{ request('lokasi') == '' ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                <span class="text-gray-700 font-medium">Semua Lokasi</span>
                            </label>
                            @foreach($lokasis as $lok)
                                <label class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                    <input type="radio" name="lokasi" value="{{ $lok }}" {{ request('lokasi') == $lok ? 'checked' : '' }} class="w-4 h-4 text-[#3B8773]">
                                    <span class="text-gray-700 font-medium">{{ $lok }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-[#3B8773] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2E6B5B] transition">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('tryout.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Results -->
        <section>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $tryouts->total() }} Tryout Tersedia</h2>
                </div>
            </div>

            @if($tryouts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($tryouts as $tryout)
                        <a href="{{ route('tryout.show', $tryout->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                            <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center text-white text-4xl font-bold">
                                {{ strtoupper(substr($tryout->nama_tryout, 0, 1)) }}
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs font-bold text-white bg-[#3B8773] px-3 py-1 rounded-full">
                                        {{ $tryout->kategori }}
                                    </span>
                                    <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                        {{ $tryout->lokasi }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition line-clamp-2">
                                    {{ $tryout->nama_tryout }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">{{ $tryout->penyelenggara }}</p>
                                <div class="flex items-center gap-2 text-sm text-gray-700 mb-3">
                                    <svg class="w-4 h-4 text-[#3B8773]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $tryout->tanggal_pelaksanaan->format('d M Y') }}
                                </div>
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail</span>
                                    <span class="text-sm font-bold text-gray-900">
                                        {{ $tryout->biaya > 0 ? 'Rp ' . number_format($tryout->biaya, 0, ',', '.') : 'Gratis' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    {{ $tryouts->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md p-12 border border-gray-100 text-center">
                    <p class="text-gray-600 font-medium mb-4">Tidak ada tryout yang ditemukan</p>
                    <a href="{{ route('tryout.index') }}" class="text-[#3B8773] font-bold hover:text-[#2E6B5B] transition">Reset Filter</a>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
