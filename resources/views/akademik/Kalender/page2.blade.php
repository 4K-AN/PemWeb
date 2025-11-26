<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - Edvizor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .bg-clip-text {
            background-clip: text;
            -webkit-background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen bg-green-50 relative overflow-hidden font-sans">

<!-- NAVIGASI HEADER START -->
<nav class="w-full max-w-7xl mx-auto mt-4 px-4 relative z-50">
    <div class="bg-gray-100 rounded-full shadow-lg flex justify-between items-center pr-2 pl-0 border border-green-800">
        
        <!-- LOGO -->
        <div class="bg-green-800 text-white rounded-l-full px-8 py-3 font-bold text-xl flex items-center h-full">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-white no-underline">
                <!-- Ikon Topi Wisuda (FontAwesome) -->
                <i class="fa-solid fa-graduation-cap"></i> 
                Edvizo.
            </a>
        </div>

        <!-- MENU TENGAH -->
        <div class="flex-1 flex justify-center gap-8 text-green-800 font-semibold">
            
            <!-- Dropdown 1: Konsultasi -->
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none">
                    Konsultasi
                    <!-- Panah Bawah -->
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Isi Dropdown -->
                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-green-700 text-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600 no-underline text-white">Chat dengan Edvizor</a>
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600 no-underline text-white">Rekomendasi Instan</a>
                    <a href="{{ url('/simulasi-karir') }}" class="block px-4 py-3 hover:bg-green-600 no-underline text-white">Hasil Fiksasi</a>
                </div>
            </div>

            <!-- Dropdown 2: Layanan Informasi -->
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none">
                    Layanan Informasi
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Isi Dropdown -->
                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-green-700 text-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600 no-underline text-white">Informasi Tryout</a>
                    <a href="{{ url('/kalender-akademik') }}" class="block px-4 py-3 hover:bg-green-600 border-b border-green-600 no-underline text-white">Kalender Akademik</a>
                    <a href="#" class="block px-4 py-3 hover:bg-green-600 no-underline text-white">Informasi Beasiswa</a>
                </div>
            </div>
        </div>

        <!-- USER PROFILE / LOGOUT -->
        <div class="flex items-center gap-3 pr-4">
            <span class="text-green-800 font-bold text-sm">Kelompok 5</span>
            <!-- Form Logout (Gunakan '#' jika route belum ada) -->
            <form method="POST" action="#"> 
                @csrf
                <button type="submit" class="text-green-800 hover:text-red-600 transition flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>

    </div>
</nav>

<!-- CSS PENDUKUNG AGAR DROPDOWN MUNCUL SAAT DI-HOVER -->
<style>
    .group:hover .group-hover\:visible { visibility: visible; }
    .group:hover .group-hover\:opacity-100 { opacity: 1; }
</style>
<!-- NAVIGASI HEADER END -->

    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full z-0 pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <svg class="absolute bottom-0 w-full text-green-800 opacity-10" viewBox="0 0 1440 320" fill="currentColor">
            <path fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-6">

        <!-- Back Button -->
  <div class="relative z-10 max-w-7xl mx-auto px-4 py-6">
        <div class="absolute top-8 left-4 md:left-20">
            <a href="/kalender-akademik" class="w-10 h-10 rounded-full border border-green-600 flex items-center justify-center text-green-800 hover:bg-green-600 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        </div>
    </div>

        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row items-center justify-center gap-16 mt-8">

            <!-- Calendar Section -->
            <div class="bg-gray-900 text-gray-300 rounded-3xl p-8 shadow-2xl w-full max-w-md border border-gray-700">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-white text-2xl font-bold">March <span class="font-light text-gray-400">2025</span></h2>
                    <div class="flex gap-4">
                        <button class="hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button class="hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-y-4 text-center text-sm font-medium mb-4">
                    <div class="text-gray-600">27</div>
                    <div class="text-gray-600">28</div>
                    <div>1</div>
                    <div class="relative flex items-center justify-center">
                        <span class="w-8 h-8 rounded-full bg-teal-500 text-gray-900 font-bold flex items-center justify-center shadow-[0_0_15px_rgba(20,184,166,0.5)]">2</span>
                    </div>
                    <div>3</div>
                    <div>4</div>
                    <div>5</div>
                    
                    <div>6</div>
                    <div>7</div>
                    <div>8</div>
                    <div>9</div>
                    <div>10</div>
                    <div>11</div>
                    <div>12</div>
                    
                    <div>13</div>
                    <div>14</div>
                    <div>15</div>
                    <div>16</div>
                    <div>17</div>
                    <div>18</div>
                    <div>19</div>
                    
                    <div>20</div>
                    <div>21</div>
                    <div>22</div>
                    <div>23</div>
                    <div>24</div>
                    <div>25</div>
                    <div>26</div>
                    
                    <div>27</div>
                    <div>28</div>
                    <div>29</div>
                    <div>30</div>
                    <div>31</div>
                    <div class="text-gray-600">1</div>
                    <div class="text-gray-600">2</div>
                </div>
            </div>

            <!-- Event Details Section -->
            <div class="relative">
                <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[3rem] p-8 shadow-2xl w-full max-w-sm flex flex-col items-center text-center h-[500px]">
                    
                    <h1 class="text-[10rem] leading-none font-black text-transparent bg-clip-text bg-gradient-to-b from-gray-700 to-transparent opacity-80 -mt-4 mb-4">
                        2
                    </h1>

                    <div class="w-full space-y-4 relative z-10 -mt-16">
                        
                        <div class="bg-[#5a8c76] text-white rounded-2xl p-4 flex items-center gap-4 shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">1</div>
                            <span class="text-left text-sm font-medium">Hari Perempuan Internasional</span>
                        </div>

                        <div class="bg-[#5a8c76] text-white rounded-2xl p-4 flex items-center gap-4 shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">2</div>
                            <span class="text-left text-sm font-medium">Beasiswa Bakti Madiun Selatan</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Set Reminder Button -->
        <div class="flex justify-center mt-12">
            <button class="bg-gradient-to-r from-[#5a8c76] to-[#4a7c66] text-white font-bold py-3 px-12 rounded-full shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 border border-white/20">
                Set Reminder
            </button>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-8 text-green-800 text-xs font-bold opacity-60">
            © - Copyright by Edvizo.
        </div>

    </div>
</body>
</html>