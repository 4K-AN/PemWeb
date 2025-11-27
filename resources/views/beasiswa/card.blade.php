<div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-green-100">
    <div class="flex items-start gap-4 mb-4">
        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-2xl">🎓</span>
        </div>
        <div class="flex-1 min-w-0">
            <h3 class="font-bold text-gray-800 mb-2 text-lg">{{ $beasiswa->nama }}</h3>
            <div class="flex gap-3 text-sm text-gray-600 mb-3 flex-wrap">
                <span class="bg-green-50 px-2 py-1 rounded">{{ $beasiswa->jurusan }}</span>
                <span class="bg-blue-50 px-2 py-1 rounded">{{ $beasiswa->status }}</span>
            </div>
            <p class="text-sm text-gray-600 mb-3">
                {{ Str::limit($beasiswa->deskripsi, 100) }}
            </p>
        </div>
        @if($beasiswa->gambar)
        @if($beasiswa->gambar && file_exists(public_path('storage/' . $beasiswa->gambar)))
    <!-- Jika gambar ada, tampilkan gambar -->
    <img 
        src="{{ asset('storage/' . $beasiswa->gambar) }}" 
        alt="{{ $beasiswa->nama }}"
        class="w-24 h-32 object-cover rounded-lg shadow-md flex-shrink-0"
    >
@else
    <!-- Jika gambar tidak ada, tampilkan placeholder -->
    <div class="w-24 h-32 rounded-lg shadow-md flex-shrink-0 flex items-center justify-center text-5xl
        {{ $beasiswa->is_popular ? 'bg-gradient-to-br from-purple-400 to-pink-500' : 'bg-gradient-to-br from-green-400 to-teal-500' }}">
        @if(str_contains(strtolower($beasiswa->nama), 'gojek'))
            
        @elseif(str_contains(strtolower($beasiswa->nama), 'lpdp'))
            
        @else
            
        @endif
    </div>
@endif
        @else
        <div class="w-20 h-28 bg-gradient-to-br from-green-400 to-teal-500 rounded-lg flex items-center justify-center text-4xl flex-shrink-0">
            🎓
        </div>
        @endif
    </div>
    <a 
        href="{{ route('beasiswa.show', $beasiswa->id) }}"
        class="block w-full bg-gradient-to-r from-green-600 to-green-500 text-white text-center py-3 rounded-lg hover:from-green-700 hover:to-green-600 transition font-medium"
    >
        Lihat Detail
    </a>
</div>