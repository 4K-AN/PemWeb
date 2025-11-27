```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edvizo - Platform Asisten Pendidikan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f9f5;
        }
       
        .header-bg {
            background: linear-gradient(135deg, #4a7c66 0%, #3b8773 100%);
        }
       
        .edvizo-pattern {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.1) 25%, transparent 25%),
                linear-gradient(225deg, rgba(255,255,255,0.1) 25%, transparent 25%),
                linear-gradient(135deg, transparent 75%, rgba(255,255,255,0.1) 75%),
                linear-gradient(225deg, transparent 75%, rgba(255,255,255,0.1) 75%);
            background-size: 20px 20px;
        }
       
        .text-gradient {
            background: linear-gradient(90deg, #166534 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
       
        .card-hover {
            transition: all 0.3s ease;
        }
       
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
       
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(74, 124, 102, 0.1);
        }
       
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
       
        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
       
        .bg-leaf {
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0c-13.3 0-25.9 3.4-36.9 9.4-10.9 6-19.9 15-25.9 25.9-6 11-9.4 23.6-9.4 36.9s3.4 25.9 9.4 36.9c6 10.9 15 19.9 25.9 25.9 11 6 23.6 9.4 36.9 9.4s25.9-3.4 36.9-9.4c10.9-6 19.9-15 25.9-25.9 6-11 9.4-23.6 9.4-36.9s-3.4-25.9-9.4-36.9c-6-10.9-15-19.9-25.9-25.9-11-6-23.6-9.4-36.9-9.4zm0 10c10.6 0 20.7 2.7 29.5 7.5 8.7 4.8 16.1 11.8 21 20 4.8 8.8 7.5 18.9 7.5 29.5s-2.7 20.7-7.5 29.5c-4.8 8.7-11.8 16.1-21 21-8.8 4.8-18.9 7.5-29.5 7.5s-20.7-2.7-29.5-7.5c-8.7-4.8-16.1-11.8-21-21-4.8-8.8-7.5-18.9-7.5-29.5s2.7-20.7 7.5-29.5c4.8-8.7 11.8-16.1 21-21 8.8-4.8 18.9-7.5 29.5-7.5z' fill='%234a7c66' fill-opacity='0.1'/%3E%3C/svg%3E");
        }
       
        .card-leaf {
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0c-13.3 0-25.9 3.4-36.9 9.4-10.9 6-19.9 15-25.9 25.9-6 11-9.4 23.6-9.4 36.9s3.4 25.9 9.4 36.9c6 10.9 15 19.9 25.9 25.9 11 6 23.6 9.4 36.9 9.4s25.9-3.4 36.9-9.4c10.9-6 19.9-15 25.9-25.9 6-11 9.4-23.6 9.4-36.9s-3.4-25.9-9.4-36.9c-6-10.9-15-19.9-25.9-25.9-11-6-23.6-9.4-36.9-9.4zm0 10c10.6 0 20.7 2.7 29.5 7.5 8.7 4.8 16.1 11.8 21 20 4.8 8.8 7.5 18.9 7.5 29.5s-2.7 20.7-7.5 29.5c-4.8 8.7-11.8 16.1-21 21-8.8 4.8-18.9 7.5-29.5 7.5s-20.7-2.7-29.5-7.5c-8.7-4.8-16.1-11.8-21-21-4.8-8.8-7.5-18.9-7.5-29.5s2.7-20.7 7.5-29.5c4.8-8.7 11.8-16.1 21-21 8.8-4.8 18.9-7.5 29.5-7.5z' fill='%234a7c66' fill-opacity='0.1'/%3E%3C/svg%3E") no-repeat;
            background-size: 100%;
        }
       
        .card-leaf::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.6) 100%);
        }
       
        .logo-pattern {
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 20px,
                rgba(74, 124, 102, 0.05) 20px,
                rgba(74, 124, 102, 0.05) 40px
            );
        }
    </style>
</head>
<body class="bg-[#f0f9f5]">
    <!-- Header -->
    <header class="relative z-50">
        <div class="absolute inset-0 z-0 logo-pattern"></div>
        <div class="max-w-7xl mx-auto px-4 py-2 relative z-10">
            <nav class="bg-white/80 backdrop-blur-sm rounded-full shadow-lg flex justify-between items-center px-3 py-2 border border-green-100">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h1 class="text-green-700 font-bold text-xl">Edvizo.</h1>
                </div>
                <!-- Menu -->
                <div class="flex-1 flex justify-center gap-12">
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-green-700 font-semibold hover:text-green-800">
                            Konsultasi
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50 border border-green-100">
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 border-b border-green-100 text-green-800">Chat dengan Edvizor</a>
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 border-b border-green-100 text-green-800">Rekomendasi Instan</a>
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 text-green-800">Hasil Fiksasi</a>
                        </div>
                    </div>
                   
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-green-700 font-semibold hover:text-green-800">
                            Layanan Informasi
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden z-50 border border-green-100">
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 border-b border-green-100 text-green-800">Informasi Tryout</a>
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 border-b border-green-100 text-green-800">Kalender Akademik</a>
                            <a href="#" class="block px-4 py-3 hover:bg-green-50 text-green-800">Informasi Beasiswa</a>
                        </div>
                    </div>
                </div>
                <!-- User Profile -->
                <div class="flex items-center gap-3">
                    <span class="text-green-800 font-medium">Kelompok 5</span>
                    <button class="text-green-800 hover:text-red-600 transition flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <!-- Hero Section -->
    <section class="relative py-20 bg-[#f0f9f5]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
                    <div class="relative">
                        <div class="w-64 h-64 bg-green-100 rounded-full flex items-center justify-center mb-8">
                            <div class="w-48 h-48 bg-white rounded-full flex items-center justify-center">
                                <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center">
                                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-green-700" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2m-4.5 11a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5m9 0a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-4 -left-4 w-16 h-16 bg-green-50 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-700" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2m-4.5 11a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5m9 0a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
               
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-green-800 mb-6">welcome to <span class="text-gradient">Edvizo</span></h2>
                    <p class="text-green-700 leading-relaxed mb-8">
                        Edvizo adalah platform asisten pendidikan digital berbasis Artificial Intelligence (AI) yang dirancang khusus untuk membantu siswa SMA/SMK dalam merencanakan masa depan akademik dan karier mereka. Nama Edvizo merupakan akronim filosofis dari "Education" (Pendidikan) dan "Advisor/Vision" (Penasihat/Visi), yang merepresentasikan peran sistem sebagai mitra cerdas dalam memberikan arahan yang jelas dan terukur.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Content Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
                    <p class="text-green-700 leading-relaxed mb-8">
                        Melalui fitur utamanya berupa chatbot konsultasi interaktif, Edvizo menganalisis minat, bakat, serta data nilai rapor pengguna untuk memberikan rekomendasi jurusan yang personal dan akurat. Lebih dari sekadar alat rekomendasi, Edvizo menyediakan ekosistem persiapan kuliah yang holistik, mencakup simulasi peta jalan karier, latihan soal ujian masuk, hingga kurasi informasi beasiswa, memastikan setiap siswa dapat melangkah ke jenjang perguruan tinggi dengan penuh keyakinan dan strategi yang matang.
                    </p>
                    <div class="flex justify-center">
                        <button class="bg-white border-2 border-green-700 text-green-700 font-medium py-3 px-8 rounded-full hover:bg-green-50 transition-colors">
                            Learn More
                        </button>
                    </div>
                </div>
               
                <div class="w-full lg:w-1/2 flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-48 bg-white rounded-3xl shadow-2xl p-4 border border-green-100 card-leaf">
                            <div class="w-full h-full bg-white rounded-2xl flex items-center justify-center p-6">
                                <div class="text-center">
                                    <h3 class="text-green-800 font-bold text-2xl mb-2">Cari Jurusan Impianmu</h3>
                                    <p class="text-green-600 text-sm mb-4">Temukan jurusan yang sesuai dengan minat dan potensimu</p>
                                    <button class="bg-green-100 text-green-800 font-medium py-2 px-6 rounded-full border border-green-200">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                       
                        <div class="absolute -top-10 -right-10 w-64 h-48 bg-white rounded-3xl shadow-2xl p-4 border border-green-100 card-leaf" style="transform: rotate(-10deg);">
                            <div class="w-full h-full bg-white rounded-2xl flex items-center justify-center p-6">
                                <div class="text-center">
                                    <h3 class="text-green-800 font-bold text-2xl mb-2">Cari Jurusan Impianmu</h3>
                                    <p class="text-green-600 text-sm mb-4">Temukan jurusan yang sesuai dengan minat dan potensimu</p>
                                    <button class="bg-green-100 text-green-800 font-medium py-2 px-6 rounded-full border border-green-200">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                       
                        <div class="absolute top-20 -left-10 w-64 h-48 bg-white rounded-3xl shadow-2xl p-4 border border-green-100 card-leaf" style="transform: rotate(10deg);">
                            <div class="w-full h-full bg-white rounded-2xl flex items-center justify-center p-6">
                                <div class="text-center">
                                    <h3 class="text-green-800 font-bold text-2xl mb-2">Cari Jurusan Impianmu</h3>
                                    <p class="text-green-600 text-sm mb-4">Temukan jurusan yang sesuai dengan minat dan potensimu</p>
                                    <button class="bg-green-100 text-green-800 font-medium py-2 px-6 rounded-full border border-green-200">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section -->
    <section class="py-16 bg-[#f0f9f5]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-6 border border-green-100 card-hover">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-robot text-green-600"></i>
                    </div>
                    <h3 class="text-green-800 font-bold text-xl mb-2">AI-Powered Recommendations</h3>
                    <p class="text-green-700 text-sm">
                        Sistem rekomendasi berbasis AI yang menganalisis minat, bakat, dan data akademik untuk memberikan rekomendasi jurusan yang akurat dan personal.
                    </p>
                </div>
               
                <div class="glass-card rounded-2xl p-6 border border-green-100 card-hover">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-green-600"></i>
                    </div>
                    <h3 class="text-green-800 font-bold text-xl mb-2">Career Path Simulation</h3>
                    <p class="text-green-700 text-sm">
                        Simulasi peta karier yang menunjukkan langkah-langkah konkret untuk mencapai tujuan akademik dan karier Anda.
                    </p>
                </div>
               
                <div class="glass-card rounded-2xl p-6 border border-green-100 card-hover">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-graduation-cap text-green-600"></i>
                    </div>
                    <h3 class="text-green-800 font-bold text-xl mb-2">Holistic Preparation</h3>
                    <p class="text-green-700 text-sm">
                        Persiapan holistik yang mencakup latihan soal ujian masuk, informasi beasiswa, dan konseling karier.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-green-100 to-green-50 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center gap-2">
                        <div class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="text-green-700 font-bold">Edvizo</span>
                    </div>
                </div>
               
                <div class="flex flex-wrap justify-center gap-6 mb-4 md:mb-0">
                    <a href="#" class="text-green-700 hover:text-green-800">Courses</a>
                    <a href="#" class="text-green-700 hover:text-green-800">Experts</a>
                    <a href="#" class="text-green-700 hover:text-green-800">About us</a>
                    <a href="#" class="text-green-700 hover:text-green-800">Contact us</a>
                </div>
            </div>
            <div class="text-center text-green-700 text-sm mt-8">
                &copy; 2025 Edvizo. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
```