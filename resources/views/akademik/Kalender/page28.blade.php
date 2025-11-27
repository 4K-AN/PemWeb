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
    <div class="bg-gray-100 rounded-full shadow-lg flex justify-between items-center pr-2 pl-0 border-2 border-green-800">
        
        <!-- LOGO -->
        <div class="bg-gradient-to-r from-green-600 to-green-600 text-white rounded-l-full px-6 md:px-8 py-3 font-bold text-lg md:text-xl flex items-center h-full hover:from-green-700 hover:to-green-600 transition-all">
    <a href="{{ url('/') }}" class="flex items-center gap-2 text-white no-underline">
        
        <img src="{{ asset('images/logo.png') }}" alt="Edvizo Logo" class="h-8 md:h-10 w-auto object-contain">
        
        <span class="hidden sm:inline">Edvizo.</span>
    </a>
</div>

        <!-- MENU TENGAH - Desktop -->
        <div class="hidden lg:flex flex-1 justify-center gap-8 text-green-800 font-semibold">
            
            <!-- Dropdown 1: Konsultasi -->
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none transition-colors">
                    <i class="fa-solid fa-comments"></i>
                    <span class="hidden xl:inline">Konsultasi</span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-gradient-to-b from-green-800 to-green-700 text-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-robot mr-2"></i>Chat dengan Edvizor
                    </a>
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-lightbulb mr-2"></i>Rekomendasi Instan
                    </a>
                    <a href="/simulasi-karir" class="block px-5 py-3 hover:bg-green-600 no-underline text-white transition-colors">
                        <i class="fa-solid fa-chart-line mr-2"></i>Hasil Fiksasi
                    </a>
                </div>
            </div>

            <!-- Dropdown 2: Layanan Informasi -->
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none transition-colors">
                    <i class="fa-solid fa-info-circle"></i>
                    <span class="hidden xl:inline">Layanan Informasi</span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-gradient-to-b from-green-800 to-green-700 text-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-file-alt mr-2"></i>Informasi Tryout
                    </a>
                    <a href="/kalender-akademik" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-calendar-days mr-2"></i>Kalender Akademik
                    </a>
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 no-underline text-white transition-colors">
                        <i class="fa-solid fa-graduation-cap mr-2"></i>Informasi Beasiswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden text-green-800 px-4">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- USER PROFILE / LOGOUT -->
        <div class="hidden lg:flex items-center gap-3 pr-4">
            <span class="text-green-800 font-bold text-sm flex items-center gap-2">
                <i class="fa-solid fa-users"></i>
                Kelompok 5
            </span>
            <button type="button" class="text-green-800 hover:text-red-600 transition-all hover:scale-110 transform" title="Logout">
                <i class="fa-solid fa-right-from-bracket text-xl"></i>
            </button>
        </div>

    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="mobile-menu lg:hidden mt-4 bg-white rounded-2xl shadow-xl border-2 border-green-800 overflow-hidden">
        <div class="p-4 space-y-2">
            <div class="border-b border-gray-200 pb-2">
                <p class="font-bold text-green-800 mb-2">Konsultasi</p>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Chat dengan Edvizor</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Rekomendasi Instan</a>
                <a href="/simulasi-karir" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Hasil Fiksasi</a>
            </div>
            <div class="border-b border-gray-200 pb-2">
                <p class="font-bold text-green-800 mb-2">Layanan Informasi</p>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Informasi Tryout</a>
                <a href="/kalender-akademik" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Kalender Akademik</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Informasi Beasiswa</a>
            </div>
            <div class="flex items-center justify-between pt-2">
                <span class="text-green-800 font-bold text-sm">Kelompok 5</span>
                <button class="text-green-800 hover:text-red-600">
                    <i class="fa-solid fa-right-from-bracket text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 19l-7-7 7-7"></path>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 19l-7-7 7-7"></path>
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
                    <div>2</div>
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
                     <div class="relative flex items-center justify-center">
                        <span class="w-8 h-8 rounded-full bg-teal-500 text-gray-900 font-bold flex items-center justify-center shadow-[0_0_15px_rgba(20,184,166,0.5)]">28</span>
                    </div>
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
                        28
                    </h1>

                    <div class="w-full space-y-4 relative z-10 -mt-16">
                        
                        <div class="bg-[#5a8c76] text-white rounded-2xl p-4 flex items-center gap-4 shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">1</div>
                            <span class="text-left text-sm font-medium">Hari Perawat Nasional</span>
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