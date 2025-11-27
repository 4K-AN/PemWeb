<nav class="w-full max-w-7xl mx-auto mt-4 px-4 relative z-50">
    <div class="bg-gray-100 rounded-full shadow-lg flex justify-between items-center pr-2 pl-0 border border-green-800">
        
        <div class="bg-green-800 text-white rounded-l-full px-8 py-3 font-bold text-xl flex items-center h-full">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <i class="fa-solid fa-graduation-cap"></i> Edvizo.
            </a>
        </div>

        <div class="flex-1 flex justify-center gap-8 text-green-800 font-semibold">
            
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none">
                    Konsultasi
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-green-700 text-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600">Chat dengan Edvizor</a>
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600">Rekomendasi Instan</a>
                    <a href="{{ url('/simulasi-karir') }}" class="block px-4 py-3 hover:bg-green-600">Hasil Fiksasi</a>
                </div>
            </div>

            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none">
                    Layanan Informasi
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-green-700 text-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600">Informasi Tryout</a>
                    <a href="{{ url('/kalender-akademik') }}" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600">Kalender Akademik</a>
                    <a href="#" class="block px-4 py-3 hover:bg-green-600">Informasi Beasiswa</a>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pr-4">
            <span class="text-green-800 font-bold text-sm">Kelompok 5</span>
            <form method="POST" action="#"> @csrf
                <button type="submit" class="text-green-800 hover:text-red-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>

    </div>
</nav>

<style>
    /* Memastikan dropdown muncul saat di-hover pada parent (.group) */
    .group:hover .group-hover\:visible {
        visibility: visible;
    }
    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }
</style>