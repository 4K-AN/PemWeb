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
                </div>

                @if($user->interests_talents)
                <div class="mt-8 p-6 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 rounded-xl border-2 border-blue-300">
                    <label class="text-sm font-bold text-blue-900 mb-3 block flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        📚 Minat & Bakat
                    </label>
                    <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $user->interests_talents }}</p>
                </div>
                @else
                <div class="mt-8 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                    <p class="text-gray-500 italic">Belum ada deskripsi minat dan bakat. Isi di halaman edit profil untuk mendapatkan rekomendasi jurusan yang lebih akurat.</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Aktivitas Saya</h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-6 rounded-xl border border-[#3B8773]/10">
                    <div class="text-3xl mb-3">📚</div>
                    <h3 class="font-bold text-gray-900 mb-1">Jurusan Difiksasi</h3>
                    <p class="text-2xl font-bold text-[#3B8773]">
                        {{ $user->latestFixation() ? '1' : '0' }}
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

        <!-- Danger Zone -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-red-200">
            <h2 class="text-2xl font-bold text-red-600 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Zona Bahaya
            </h2>
            <p class="text-gray-600 mb-6">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan.</p>

            <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                <h3 class="font-bold text-gray-900 mb-2">Hapus Akun</h3>
                <p class="text-sm text-gray-600 mb-4">Menghapus akun akan menghapus semua data Anda secara permanen, termasuk riwayat fiksasi jurusan dan data profil.</p>

                <button onclick="openDeleteModal()" class="px-6 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Akun Saya
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Hapus Akun</h3>
            <p class="text-gray-600">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.</p>
        </div>

        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Masukkan password Anda untuk konfirmasi</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition"
                       placeholder="Password Anda">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition">
                    Hapus Akun
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
