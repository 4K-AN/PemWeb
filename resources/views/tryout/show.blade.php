@extends('layouts.app')

@section('title', $tryout->nama_tryout . ' - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('tryout.index') }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Tryout
            </a>
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm text-3xl font-bold">
                    {{ strtoupper(substr($tryout->nama_tryout, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="inline-block bg-white/20 px-4 py-1 rounded-full text-sm font-bold">{{ $tryout->kategori }}</span>
                        <span class="inline-block bg-white/20 px-4 py-1 rounded-full text-sm font-bold">{{ $tryout->lokasi }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $tryout->nama_tryout }}</h1>
                    <p class="text-lg text-gray-200">{{ $tryout->penyelenggara }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <div class="text-sm font-bold text-gray-500 mb-2">Tanggal Pelaksanaan</div>
                <div class="text-xl font-bold text-gray-900">{{ $tryout->tanggal_pelaksanaan->translatedFormat('d F Y') }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <div class="text-sm font-bold text-gray-500 mb-2">Waktu</div>
                <div class="text-xl font-bold text-gray-900">
                    @if($tryout->waktu_mulai)
                        {{ \Carbon\Carbon::parse($tryout->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($tryout->waktu_selesai)->format('H:i') }}
                    @else
                        Sesuai jadwal
                    @endif
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <div class="text-sm font-bold text-gray-500 mb-2">Biaya</div>
                <div class="text-xl font-bold text-[#3B8773]">
                    {{ $tryout->biaya > 0 ? 'Rp ' . number_format($tryout->biaya, 0, ',', '.') : 'GRATIS' }}
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi</h2>
            <p class="text-gray-700 leading-relaxed mb-6">{{ $tryout->deskripsi }}</p>

            @if($tryout->deadline_pendaftaran)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                    <p class="text-yellow-800 font-medium">
                        <strong>Deadline Pendaftaran:</strong> {{ $tryout->deadline_pendaftaran->translatedFormat('d F Y') }}
                    </p>
                </div>
            @endif
        </div>

        @if($tryout->link_pendaftaran)
            <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] text-white rounded-2xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4">Siap Mengikuti Tryout?</h3>
                <p class="text-gray-200 mb-6">Daftarkan diri Anda sekarang dan ukur kemampuan Anda!</p>
                <a href="{{ $tryout->link_pendaftaran }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-[#3B8773] px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition">
                    Daftar Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
