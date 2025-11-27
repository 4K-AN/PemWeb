<header class="h-20 bg-white px-6 md:px-12 flex items-center justify-between shadow-sm border-b border-gray-100 sticky top-0 z-50">

    <div class="flex items-center gap-8">
        <a href="/" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition">
            <img src="{{ asset('images/Vectoredvizo.svg') }}" alt="Logo" class="w-8 h-8">
            <span class="text-xl font-bold text-[#3B8773] tracking-wide">Edvizo.</span>
        </a>
        <div class="hidden md:flex h-6 w-px bg-gray-200"></div>
        <a href="/" class="hidden md:block text-gray-500 hover:text-[#3B8773] text-sm font-medium transition">Home</a>
    </div>

    <div class="hidden md:flex items-center gap-8 text-gray-600 font-medium">
        <!-- Konsultasi Dropdown -->
        <div class="group relative inline-block">
            <button class="flex items-center gap-2 hover:text-[#3B8773] transition py-2">
                Konsultasi
                <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50 top-full">
                <a href="{{ route('chatbot.index') }}" class="block px-6 py-3 hover:bg-[#F0F9F7] text-gray-700 hover:text-[#3B8773] border-b border-gray-50 transition font-medium text-sm">
                    <span class="flex items-center gap-2">Konsultasi Jurusan</span>
                </a>
                <a href="{{ route('simulasi.karir') }}" class="block px-6 py-3 hover:bg-[#F0F9F7] text-gray-700 hover:text-[#3B8773] transition font-medium text-sm">
                    <span class="flex items-center gap-2">Simulasi Karir</span>
                </a>
            </div>
        </div>

        <!-- Informasi Dropdown -->
        <div class="group relative inline-block">
            <button class="flex items-center gap-2 hover:text-[#3B8773] transition py-2">
                Informasi
                <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50 top-full">
                <a href="{{ route('akademik.kalender') }}" class="block px-6 py-3 hover:bg-[#F0F9F7] text-gray-700 hover:text-[#3B8773] border-b border-gray-50 transition font-medium text-sm">
                    <span class="flex items-center gap-2">Kalender Akademik</span>
                </a>
                <a href="{{ route('beasiswa.index') }}" class="block px-6 py-3 hover:bg-[#F0F9F7] text-gray-700 hover:text-[#3B8773] transition font-medium text-sm">
                    <span class="flex items-center gap-2">Info Beasiswa</span>
                </a>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        @auth
            <div class="hidden sm:block text-right">
                <p class="text-sm font-bold text-[#3B8773]">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">Siswa</p>
            </div>
        @else
            <div class="hidden sm:block text-right">
                <p class="text-sm font-bold text-[#3B8773]">Kelompok 5</p>
                <p class="text-xs text-gray-500">Pengembang</p>
            </div>
        @endauth

        <div class="relative group cursor-pointer">
            <div class="w-10 h-10 bg-[#E8F5F3] rounded-full flex items-center justify-center border border-white shadow-sm ring-2 ring-transparent hover:ring-[#3B8773]/20 transition">
                <span class="text-[#3B8773] font-bold text-sm">
                    @auth
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @else
                        K5
                    @endauth
                </span>
            </div>
            <div class="absolute right-0 top-full mt-2 w-40 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                @auth
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-t-xl transition font-medium border-b border-gray-100">
                        Pengaturan
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-b-xl transition font-medium flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-sm text-[#3B8773] hover:bg-[#F0F9F7] rounded-t-xl transition font-medium border-b border-gray-100">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-b-xl transition font-medium">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
