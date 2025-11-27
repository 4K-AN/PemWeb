<a href="{{ route('beasiswa.show', $beasiswa->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100 h-full flex flex-col">
    <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 160"><path d="M0,80 Q100,20 200,80 T400,80 L400,160 L0,160 Z" fill="white"/></svg>
        </div>
    </div>

    <div class="p-6 flex-1 flex flex-col">
        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-[#3B8773] transition">
            {{ $beasiswa->nama_beasiswa ?? 'Beasiswa' }}
        </h3>

        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
            {{ $beasiswa->deskripsi ?? 'Deskripsi tidak tersedia' }}
        </p>

        <div class="space-y-3 text-sm mb-4 flex-1">
            @if($beasiswa->universitas ?? null)
                <div class="flex items-center gap-2 text-gray-700">
                    <svg class="w-4 h-4 text-[#3B8773]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>
                    <span class="font-medium">{{ $beasiswa->universitas }}</span>
                </div>
            @endif

            @if($beasiswa->jurusan ?? null)
                <div class="flex items-center gap-2 text-gray-700">
                    <svg class="w-4 h-4 text-[#3B8773]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l1.59 3.83 4.13.59-3 2.93.71 4.13L12 11.07l-3.43 1.79.71-4.13-3-2.93 4.13-.59L12 2z"/></svg>
                    <span class="font-medium">{{ $beasiswa->jurusan }}</span>
                </div>
            @endif

            @if($beasiswa->jenjang ?? null)
                <div class="flex items-center gap-2 text-gray-700">
                    <svg class="w-4 h-4 text-[#3B8773]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/></svg>
                    <span class="font-medium">{{ $beasiswa->jenjang }}</span>
                </div>
            @endif
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">
                Lihat Detail →
            </span>
            @if($beasiswa->tenggat ?? null)
                <span class="text-xs text-gray-500 font-medium">
                    {{ \Carbon\Carbon::parse($beasiswa->tenggat)->diffForHumans() }}
                </span>
            @endif
        </div>
    </div>
</a>
