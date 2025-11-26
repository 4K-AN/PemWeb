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
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(74, 124, 102, 0.3);
        }

        /* Animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse-custom {
            animation: pulse 3s ease-in-out infinite;
        }
    </style>
</head>
<body>

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
            <div class="text-center mb-16 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse-custom"></div>

                <h1 class="text-6xl md:text-8xl tracking-wider text-outline uppercase mb-[-10px] md:mb-[-20px]">
                    Teknologi
                </h1>
                <h1 class="text-6xl md:text-8xl font-black text-[#2f5d48] tracking-wide uppercase drop-shadow-sm">
                    INFORMASI
                </h1>
            </div>

            <!-- Profesi Section -->
            <div class="mb-20">
                <h2 class="text-center text-3xl font-bold text-[#4a7c66] mb-10 tracking-wide">Profesi</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 px-4 md:px-20">
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            Software Engineer / Developer
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            Data Scientist / Data Analyst
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            Cloud Engineer / DevOps Engineer
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            Cybersecurity Specialist
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            AI Engineer / Machine Learning
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            UI/UX Designer (Tech-Oriented)
                        </span>
                    </div>
                    
                    <div class="glass-card rounded-[2rem] h-40 flex items-center justify-center p-4 text-center">
                        <span class="text-[#2f5d48] font-bold text-sm md:text-base leading-tight">
                            Product Manager (Tech Product)
                        </span>
                    </div>
                    
                   
            </div>

            <!-- Jenjang Karir Section -->
            <div class="mb-20">
                <h2 class="text-center text-3xl font-bold text-[#4a7c66] mb-10 tracking-wide">Jenjang Karir</h2>

                <div class="flex flex-col md:flex-row justify-center gap-8 px-4">
                    <div class="glass-card w-full md:w-56 h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-500/20">
                        <div class="text-3xl mb-4">🌱</div>
                        <h3 class="text-[#2f5d48] font-bold text-sm">Entry Level<br><span class="font-normal text-xs">(Junior)</span></h3>
                    </div>

                    <div class="glass-card w-full md:w-56 h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-600/40 md:-top-4 shadow-xl">
                        <div class="text-3xl mb-4">🚀</div>
                        <h3 class="text-[#2f5d48] font-bold text-sm">Mid Level<br><span class="font-normal text-xs">(Intermediate / Professional)</span></h3>
                    </div>

                    <div class="glass-card w-full md:w-56 h-64 rounded-[2rem] flex flex-col items-center justify-center p-6 text-center border-b-4 border-green-700/60">
                        <div class="text-3xl mb-4">🏆</div>
                        <h3 class="text-[#2f5d48] font-bold text-sm">Senior Level<br><span class="font-normal text-xs">(Lead / Expert / Managerial)</span></h3>
                    </div>
                </div>
            </div>

            <!-- Kebutuhan Skill Section -->
            <div class="mb-20">
                <h2 class="text-center text-3xl font-bold text-[#4a7c66] mb-10 tracking-wide">Kebutuhan Skill</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 md:px-10 max-w-5xl mx-auto">
                    <div class="glass-card rounded-[2rem] p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-lg mb-2">Problem Solving & Computational Thinking</h4>
                        <p class="text-gray-500 text-xs text-justify mb-4 leading-relaxed">
                            Kemampuan memecahkan masalah secara logis, sistematis, dan efisien adalah pondasi utama. Kamu harus terbiasa menganalisis masalah, memecah jadi bagian kecil.
                        </p>
                        <div class="flex text-[#4a7c66] text-sm gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>

                    <div class="glass-card rounded-[2rem] p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-lg mb-2">Programming & Software Engineering</h4>
                        <p class="text-gray-500 text-xs text-justify mb-4 leading-relaxed">
                            Kemampuan menerjemahkan ide ke dalam kode yang rapi, efisien, dan bisa dikembangkan. Tidak hanya bisa "ngoding", tapi juga mengerti struktur proyek.
                        </p>
                        <div class="flex text-[#4a7c66] text-sm gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>

                    <div class="glass-card rounded-[2rem] p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-lg mb-2">Cloud, Deployment, dan DevOps Mindset</h4>
                        <p class="text-gray-500 text-xs text-justify mb-4 leading-relaxed">
                            Dunia kerja sekarang butuh engineer yang paham bagaimana aplikasi dijalankan di dunia nyata. Mulai dari membuat server, menyimpan data, hingga skala besar.
                        </p>
                        <div class="flex text-[#4a7c66] text-sm gap-1">
                            ⭐⭐⭐⭐☆
                        </div>
                    </div>

                    <div class="glass-card rounded-[2rem] p-8 text-left border border-green-50">
                        <h4 class="text-[#2f5d48] font-bold text-lg mb-2">Soft Skills & Adaptability</h4>
                        <p class="text-gray-500 text-xs text-justify mb-4 leading-relaxed">
                            Kemampuan teknis itu penting, tapi kemampuan beradaptasi dan bekerja dalam tim juga krusial. Industri teknologi berubah cepat.
                        </p>
                        <div class="flex text-[#4a7c66] text-sm gap-1">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kesimpulan Section -->
            <div class="text-center mb-32 px-4 max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-[#4a7c66] mb-6 tracking-wide">Kesimpulan</h2>
                <p class="text-gray-700 text-sm md:text-base leading-loose text-justify bg-white/50 p-8 rounded-3xl backdrop-blur-sm border border-white">
                    Berdasarkan hasil analisis, jurusan <span class="font-bold text-[#2f5d48]">Teknologi Informasi</span> paling sesuai dengan minat dan potensi kamu. 
                    Bidang ini membuka peluang karier luas di dunia digital — mulai dari pengembangan aplikasi, analisis data, hingga keamanan siber. 
                    Kuasai skill dasar seperti pemrograman, cloud, dan analisis data, serta asah kemampuan berpikir kritis dan komunikasi, agar siap bersaing di masa depan.
                </p>
            </div>

        </div>

        <!-- Footer Wave -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg class="w-full h-[200px] text-[#7da893]" viewBox="0 0 1440 320" fill="currentColor" preserveAspectRatio="none">
                <path fill-opacity="1" d="M0,192L60,197.3C120,203,240,213,360,218.7C480,224,600,224,720,202.7C840,181,960,139,1080,138.7C1200,139,1320,181,1380,202.7L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
            
            <div class="absolute bottom-4 w-full flex flex-col md:flex-row justify-between items-center px-8 md:px-20 text-[#2f5d48] text-xs font-medium gap-4">
                <div class="flex gap-4">
                    <span><i class="fas fa-comment"></i> Let's chat</span>
                </div>
                <div class="flex gap-4 uppercase tracking-wider opacity-70">
                    <a href="#" class="hover:text-white transition">Home</a>
                    <a href="#" class="hover:text-white transition">Konsultasi</a>
                    <a href="#" class="hover:text-white transition">Info</a>
                    <a href="#" class="hover:text-white transition">Profile</a>
                </div>
                <div class="flex gap-2">
                    <span>✉️ Edvizo@gmail.com</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>