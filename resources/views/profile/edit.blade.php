@extends('layouts.app')

@section('title', 'Edit Profil - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-2 text-gray-200 hover:text-white transition mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Edit Profil</h1>
            <p class="text-lg text-gray-200">Perbarui informasi pribadi Anda</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <form action="{{ route('profile.update') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Dasar</h2>

            <div class="space-y-6 mb-8">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                        <select name="gender" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Sekolah/Universitas</label>
                        <input type="text" name="school" value="{{ old('school', $user->school) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                        @error('school')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" rows="3"
                              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Password</h2>
                <p class="text-sm text-gray-600 mb-6">Kosongkan jika tidak ingin mengubah password</p>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="new_password"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#3B8773] focus:border-[#3B8773] outline-none transition">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-[#3B8773] text-white px-6 py-4 rounded-xl font-bold hover:bg-[#2E6B5B] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('profile.show') }}" class="px-6 py-4 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
