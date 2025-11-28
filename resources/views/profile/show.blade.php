@extends('layouts.app')

@section('title', 'Profil Saya - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil Saya</h1>
            <p class="text-lg text-gray-200">Kelola informasi pribadi Anda</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8 rounded-lg">
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Informasi Pribadi</h2>
                <a href="{{ route('profile.edit') }}" class="px-6 py-3 bg-[#3B8773] text-white rounded-xl font-bold hover:bg-[#2E6B5B] transition">
                    Edit Profil
                </a>
            </div>

            <div class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Nama Lengkap</label>
                        <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Email</label>
                        <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Nomor Telepon</label>
                        <p class="text-gray-900 font-medium">{{ $user->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Tanggal Lahir</label>
                        <p class="text-gray-900 font-medium">
                            {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Jenis Kelamin</label>
                        <p class="text-gray-900 font-medium">
                            {{ $user->gender == 'male' ? 'Laki-laki' : ($user->gender == 'female' ? 'Perempuan' : '-') }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-500 mb-2 block">Sekolah/Universitas</label>
                        <p class="text-gray-900 font-medium">{{ $user->school ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-500 mb-2 block">Alamat</label>
                    <p class="text-gray-900 font-medium">{{ $user->address ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Aktivitas Saya</h2>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-6 rounded-xl border border-[#3B8773]/10">
                    <div class="text-3xl mb-3">📚</div>
                    <h3 class="font-bold text-gray-900 mb-1">Jurusan Difiksasi</h3>
                    <p class="text-2xl font-bold text-[#3B8773]">
                        {{ $user->latestFixation() ? '1' : '0' }}
                    </p>
                </div>

                <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-6 rounded-xl border border-[#3B8773]/10">
                    <div class="text-3xl mb-3">🔔</div>
                    <h3 class="font-bold text-gray-900 mb-1">Reminder Aktif</h3>
                    <p class="text-2xl font-bold text-[#3B8773]">
                        {{ $user->eventReminders()->count() }}
                    </p>
                </div>

                <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-6 rounded-xl border border-[#3B8773]/10">
                    <div class="text-3xl mb-3">💼</div>
                    <h3 class="font-bold text-gray-900 mb-1">Karir Tersimulasi</h3>
                    <p class="text-2xl font-bold text-[#3B8773]">
                        {{ $user->latestFixation() ? '5+' : '0' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
