<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis - Teknologi Informasi</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom Text Stroke untuk tulisan "Teknologi" */
        .text-outline {
            color: transparent;
            -webkit-text-stroke: 2px #4a7c66;
            font-weight: 800;
        }

        /* Background smooth */
        .bg-sage-gradient {
            background: linear-gradient(180deg, #ffffff 0%, #e8f5e9 40%, #cce3de 100%);
        }

        /* Card Hover Effect */
        .glass-card {
            background: #ffffff;
            box-shadow: 0 10px 30px -10px rgba(74, 124, 102, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: block;
        }
        
        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(74, 124, 102, 0.4);
        }

        /* Animation */
        @keyframes pulse-custom {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse-custom {
            animation: pulse-custom 3s ease-in-out infinite;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: block;
        }
    </style>
</head>
<body>

<nav class="w-full max-w-7xl mx-auto mt-4 px-4 relative z-50">
    <div class="bg-gray-100 rounded-full shadow-lg flex justify-between items-center pr-2 pl-0 border-2 border-green-800">
        
        <div class="bg-gradient-to-r from-green-800 to-green-700 text-white rounded-l-full px-6 md:px-8 py-3 font-bold text-lg md:text-xl flex items-center h-full hover:from-green-700 hover:to-green-600 transition-all">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-white no-underline">
                <img src="{{ asset('images/logo.png') }}" alt="Edvizo Logo" class="h-8 md:h-10 w-auto object-contain">
                <span class="hidden sm:inline">Edvizo.</span>
            </a>
        </div>

        <div class="hidden lg:flex flex-1 justify-center gap-8 text-green-800 font-semibold">
            
            <div class="group relative inline-block text-left">
                <button class="flex items-center gap-1 hover:text-green-600 focus:outline-none transition-colors">
                    <i class="fa-solid fa-comments"></i>
                    <span class="hidden xl:inline">Konsultasi</span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-52 bg-gradient-to-b from-green-800 to-green-700 text-white rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50">
                    
                    <a href="{{ route('chatbot.index') }}" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-robot mr-2"></i>Chat dengan Edvizor
                    </a>
                    
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-lightbulb mr-2"></i>Rekomendasi Instan
                    </a>
                    <a href="{{ route('karir.simulasi') }}" class="block px-5 py-3 hover:bg-green-600 no-underline text-white transition-colors">
                        <i class="fa-solid fa-chart-line mr-2"></i>Hasil Fiksasi
                    </a>
                </div>
            </div>

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
                    <a href="{{ route('akademik.index') }}" class="block px-5 py-3 hover:bg-green-600 border-b border-green-600/50 no-underline text-white transition-colors">
                        <i class="fa-solid fa-calendar-days mr-2"></i>Kalender Akademik
                    </a>
                    <a href="#" class="block px-5 py-3 hover:bg-green-600 no-underline text-white transition-colors">
                        <i class="fa-solid fa-graduation-cap mr-2"></i>Informasi Beasiswa
                    </a>
                </div>
            </div>
        </div>

        <button id="mobile-menu-btn" class="lg:hidden text-green-800 px-4">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

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

    <div id="mobile-menu" class="mobile-menu lg:hidden mt-4 bg-white rounded-2xl shadow-xl border-2 border-green-800 overflow-hidden">
        <div class="p-4 space-y-2">
            <div class="border-b border-gray-200 pb-2">
                <p class="font-bold text-green-800 mb-2">Konsultasi</p>
                
                <a href="{{ route('chatbot.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Chat dengan Edvizor</a>
                
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Rekomendasi Instan</a>
                <a href="{{ route('karir.simulasi') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Hasil Fiksasi</a>
            </div>
            <div class="border-b border-gray-200 pb-2">
                <p class="font-bold text-green-800 mb-2">Layanan Informasi</p>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Informasi Tryout</a>
                <a href="{{ route('akademik.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded no-underline">Kalender Akademik</a>
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


    <div class="bg-sage-gradient min-h-screen relative overflow-hidden pb-20">

        <!-- Background Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-[300px] z-0 pointer-events-none">
            <div class="w-[120%] h-[400px] bg-[#558b72] absolute -top-[250px] left-[-10%] rounded-[50%] opacity-20 blur-3xl"></div>
            <svg class="absolute top-0 w-full h-full text-[#558b72] opacity-80" viewBox="0 0 1440 320" fill="currentColor" preserveAspectRatio="none">
                <path fill-opacity="1" d="M0,0L1440,0L1440,100C1100,200 400,-100 0,100Z"></path>
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 pt-10">

            <!-- Hero Title -->
            <div class="text-center mb-12 md:mb-16 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 md:w-64 h-48 md:h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse-custom"></div>

                <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl tracking-wider text-outline uppercase mb-[-8px] md:mb-[-10px] lg:mb-[-20px] animate-float">
                    Teknologi
                </h1>
                <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-[#2f5d48] tracking-wide uppercase drop-shadow-sm">
                    INFORMASI
                </h1>
            </div>
            <!-- Profesi Section -->
<div class="mb-16 md:mb-20">
    <h2 class="text-center text-2xl md:text-3xl font-bold text-[#4a7c66] mb-8 md:mb-10 tracking-wide">Profesi</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 px-2 md:px-4 lg:px-20">
        
        <a href="{{ route('karir.show', ['slug' => 'software-engineer']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                💻<br>Software Engineer / Developer
            </span>
        </a>

        <a href="{{ route('karir.show', ['slug' => 'data-scientist']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                📊<br>Data Scientist / Data Analyst
            </span>
        </a>

        <a href="{{ route('karir.show', ['slug' => 'cloud-engineer']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                ☁️<br>Cloud Engineer / DevOps
            </span>
        </a>

        <a href="{{ route('karir.show', ['slug' => 'cybersecurity']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                🔒<br>Cybersecurity Specialist
            </span>
        </a>
        
        <a href="{{ route('karir.show', ['slug' => 'ai-engineer']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                🤖<br>AI Engineer / ML
            </span>
        </a>
        
        <a href="{{ route('karir.show', ['slug' => 'uiux-designer']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                🎨<br>UI/UX Designer (Tech)
            </span>
        </a>

        <a href="{{ route('karir.show', ['slug' => 'product-manager']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                📱<br>Product Manager (Tech)
            </span>
        </a>

        <a href="{{ route('karir.show', ['slug' => 'fullstack-developer']) }}" class="glass-card rounded-[2rem] h-36 md:h-40 flex items-center justify-center p-4 text-center cursor-pointer">
            <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                🌐<br>Full Stack Developer
            </span>
        </a>
    </div>
</div>

            <!-- Jenjang Karir Section -->
            <div class="mb-16 md:mb-20">
                <h2 class="text-center text-2xl md:text-3xl font-bold text-[#4a7c66] mb-8 md:mb-10 tracking-wide">Jenjang Karir</h2>

                <div class="flex flex-col md:flex-row justify-center gap-6 md:gap-8 px-4">
                    <!-- Card Entry Level -->
                    <div class="glass-card w-full md:w-56 h-56 md:h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-500/20 cursor-pointer">
                        <div class="text-4xl mb-4 animate-float">🌱</div>
                        <h3 class="text-[#2f5d48] font-bold text-base">Entry Level<br><span class="font-normal text-sm">(Junior)</span></h3>
                        <p class="text-xs text-gray-500 mt-2">0-2 tahun pengalaman</p>
                    </div>

                    <!-- Card Mid Level -->
                    <div class="glass-card w-full md:w-56 h-56 md:h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-600/40 md:relative md:-top-4 shadow-xl cursor-pointer">
                        <div class="text-4xl mb-4 animate-float" style="animation-delay: 0.5s;">🚀</div>
                        <h3 class="text-[#2f5d48] font-bold text-base">Mid Level<br><span class="font-normal text-sm">(Intermediate / Professional)</span></h3>
                        <p class="text-xs text-gray-500 mt-2">3-5 tahun pengalaman</p>
                    </div>

                    <!-- Card Senior Level -->
                    <div class="glass-card w-full md:w-56 h-56 md:h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-700/60 cursor-pointer">
                        <div class="text-4xl mb-4 animate-float" style="animation-delay: 1s;">🏆</div>
                        <h3 class="text-[#2f5d48] font-bold text-base">Senior Level<br><span class="font-normal text-sm">(Lead / Expert / Managerial)</span></h3>
                        <p class="text-xs text-gray-500 mt-2">5+ tahun pengalaman</p>
                    </div>
                </div>
            </div>

            <!-- Kebutuhan Skill Section -->
            <div class="mb-16 md:mb-20">
                <h2 class="text-center text-2xl md:text-3xl font-bold text-[#4a7c66] mb-8 md:mb-10 tracking-wide">Kebutuhan Skill</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 px-4 md:px-10 max-w-5xl mx-auto">
                    <!-- Skill 1 -->
                    <div class="glass-card rounded-[2rem] p-6 md:p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-base md:text-lg mb-2">💡 Problem Solving & Computational Thinking</h4>
                        <p class="text-gray-500 text-xs md:text-sm text-justify mb-4 leading-relaxed">
                            Kemampuan memecahkan masalah secara logis, sistematis, dan efisien adalah pondasi utama. Kamu harus terbiasa menganalisis masalah, memecah jadi bagian kecil.
                        </p>
                        <div class="flex text-[#4a7c66] text-base gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>

                    <!-- Skill 2 -->
                    <div class="glass-card rounded-[2rem] p-6 md:p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-base md:text-lg mb-2">⚙️ Programming & Software Engineering</h4>
                        <p class="text-gray-500 text-xs md:text-sm text-justify mb-4 leading-relaxed">
                            Kemampuan menerjemahkan ide ke dalam kode yang rapi, efisien, dan bisa dikembangkan. Tidak hanya bisa "ngoding", tapi juga mengerti struktur proyek.
                        </p>
                        <div class="flex text-[#4a7c66] text-base gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>

                    <!-- Skill 3 -->
                    <div class="glass-card rounded-[2rem] p-6 md:p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-base md:text-lg mb-2">☁️ Cloud, Deployment, dan DevOps Mindset</h4>
                        <p class="text-gray-500 text-xs md:text-sm text-justify mb-4 leading-relaxed">
                            Dunia kerja sekarang butuh engineer yang paham bagaimana aplikasi dijalankan di dunia nyata. Mulai dari membuat server, menyimpan data, hingga skala besar.
                        </p>
                        <div class="flex text-[#4a7c66] text-base gap-1">
                            ⭐⭐⭐⭐☆
                        </div>
                    </div>

                    <!-- Skill 4 -->
                    <div class="glass-card rounded-[2rem] p-6 md:p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-base md:text-lg mb-2">🤝 Soft Skills & Adaptability</h4>
                        <p class="text-gray-500 text-xs md:text-sm text-justify mb-4 leading-relaxed">
                            Kemampuan teknis itu penting, tapi kemampuan beradaptasi dan bekerja dalam tim juga krusial. Industri teknologi berubah cepat.
                        </p>
                        <div class="flex text-[#4a7c66] text-base gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
            </div>




            <!-- Kesimpulan Section -->
            <div class="text-center mb-20 md:mb-32 px-4 max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-[#4a7c66] mb-6 tracking-wide">Kesimpulan</h2>
                <p class="text-gray-700 text-sm md:text-base leading-loose text-justify bg-white/50 p-6 md:p-8 rounded-3xl backdrop-blur-sm border border-white shadow-lg">
                    Berdasarkan hasil analisis, jurusan <span class="font-bold text-[#2f5d48]">Teknologi Informasi</span> paling sesuai dengan minat dan potensi kamu. 
                    Bidang ini membuka peluang karier luas di dunia digital — mulai dari pengembangan aplikasi, analisis data, hingga keamanan siber. 
                    Kuasai skill dasar seperti pemrograman, cloud, dan analisis data, serta asah kemampuan berpikir kritis dan komunikasi, agar siap bersaing di masa depan.
                </p>
            </div>

        </div>

        <!-- Footer Wave -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg class="w-full h-[150px] md:h-[200px] text-[#7da893]" viewBox="0 0 1440 320" fill="currentColor" preserveAspectRatio="none">
                <path fill-opacity="1" d="M0,192L60,197.3C120,203,240,213,360,218.7C480,224,600,224,720,202.7C840,181,960,139,1080,138.7C1200,139,1320,181,1380,202.7L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
            
            <div class="absolute bottom-4 w-full flex flex-col md:flex-row justify-between items-center px-4 md:px-8 lg:px-20 text-[#2f5d48] text-xs font-medium gap-3 md:gap-4">
                <div class="flex gap-3 md:gap-4">
                    <span><i class="fas fa-comment"></i> Let's chat</span>
                </div>
                <div class="flex gap-3 md:gap-4 uppercase tracking-wider opacity-70 flex-wrap justify-center">
                    <a href="#" class="hover:text-white transition no-underline">Home</a>
                    <a href="#" class="hover:text-white transition no-underline">Konsultasi</a>
                    <a href="#" class="hover:text-white transition no-underline">Info</a>
                    <a href="#" class="hover:text-white transition no-underline">Profile</a>
                </div>
                <div class="flex gap-2">
                    <span class="text-xs md:text-sm">✉️ Edvizo@gmail.com</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('active');
        });

        // Optional: Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuBtn = document.getElementById('mobile-menu-btn');
            
            if (!mobileMenu.contains(event.target) && !menuBtn.contains(event.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>