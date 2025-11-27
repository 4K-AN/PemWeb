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
<body>
@extends('layouts.app')

@section('title', 'Home - Edvizo')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] via-[#2E6B5B] to-[#1F4D3F] text-white pt-20 pb-32 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div class="space-y-3">
                        <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                            <span class="block">Kompas Anda</span>
                            <span class="block">untuk <span class="text-[#7FD4C4]">Jurusan</span></span>
                            <span class="block">yang Tepat.</span>
                        </h1>
                    </div>
                    <p class="text-lg text-gray-200 leading-relaxed max-w-lg">
                        Temukan jurusan impian Anda dengan konsultasi AI terpadu. Edvizo membantu Anda membuat keputusan pendidikan yang tepat.
                    </p>
                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-2 bg-white text-[#3B8773] px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Mulai Konsultasi
                        </a>
                        <a href="{{ route('beasiswa.index') }}" class="inline-flex items-center gap-2 bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jelajahi Beasiswa
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex items-center justify-center">
                    <div class="relative w-80 h-80">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#7FD4C4]/20 to-transparent rounded-3xl"></div>
                        <div class="absolute inset-8 bg-white/10 backdrop-blur-xl rounded-3xl border border-white/20 flex items-center justify-center">
                            <div class="text-center space-y-4">
                                <img src="{{ asset('images/Vectoredvizo.svg') }}" alt="Edvizo" class="w-24 h-24 mx-auto opacity-80">
                                <p class="text-white/80 font-medium">Edvizo AI Assistant</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16 px-6 border-b border-gray-100">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-2xl hover:bg-[#F0F9F7] transition">
                <div class="text-4xl font-bold text-[#3B8773] mb-2">500+</div>
                <p class="text-gray-600 font-medium">Jurusan Terdata</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:bg-[#F0F9F7] transition">
                <div class="text-4xl font-bold text-[#3B8773] mb-2">1000+</div>
                <p class="text-gray-600 font-medium">Beasiswa Aktif</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:bg-[#F0F9F7] transition">
                <div class="text-4xl font-bold text-[#3B8773] mb-2">5000+</div>
                <p class="text-gray-600 font-medium">Siswa Terbimbing</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 space-y-3">
                <h2 class="text-4xl font-bold text-gray-900">Fitur Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Semua yang Anda butuhkan untuk memilih jurusan yang tepat</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg hover:border-[#3B8773]/20 transition group">
                    <div class="w-14 h-14 bg-[#E8F5F3] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#3B8773] transition">
                        <svg class="w-7 h-7 text-[#3B8773] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Konsultasi AI Cerdas</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan rekomendasi jurusan personal berdasarkan minat dan kemampuan Anda dengan AI terdepan.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg hover:border-[#3B8773]/20 transition group">
                    <div class="w-14 h-14 bg-[#E8F5F3] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#3B8773] transition">
                        <svg class="w-7 h-7 text-[#3B8773] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fiksasi Jurusan</h3>
                    <p class="text-gray-600 leading-relaxed">Analisis mendalam dengan hasil SWOT komprehensif untuk memastikan pilihan terbaik Anda.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg hover:border-[#3B8773]/20 transition group">
                    <div class="w-14 h-14 bg-[#E8F5F3] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[#3B8773] transition">
                        <svg class="w-7 h-7 text-[#3B8773] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Info Beasiswa</h3>
                    <p class="text-gray-600 leading-relaxed">Akses database lengkap beasiswa dari berbagai universitas dan lembaga pendidikan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6 bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] text-white">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <div>
                <h2 class="text-4xl font-bold mb-4">Siap Menemukan Jurusan Impian?</h2>
                <p class="text-lg text-gray-200">Mulai konsultasi sekarang dan dapatkan rekomendasi jurusan yang tepat untuk masa depan Anda.</p>
            </div>
            <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-2 bg-white text-[#3B8773] px-10 py-4 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Mulai Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 pb-12 border-b border-gray-800">
                <div>
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <img src="{{ asset('images/Vectoredvizo.svg') }}" alt="Logo" class="w-6 h-6">
                        Edvizo
                    </h3>
                    <p class="text-sm text-gray-400">Platform konsultasi jurusan berbasis AI untuk membantu Anda membuat keputusan pendidikan yang tepat.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('chatbot.index') }}" class="hover:text-[#7FD4C4] transition">Konsultasi Jurusan</a></li>
                        <li><a href="{{ route('beasiswa.index') }}" class="hover:text-[#7FD4C4] transition">Info Beasiswa</a></li>
                        <li><a href="{{ route('akademik.kalender') }}" class="hover:text-[#7FD4C4] transition">Kalender Akademik</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-[#7FD4C4] transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#7FD4C4] transition">Blog</a></li>
                        <li><a href="#" class="hover:text-[#7FD4C4] transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-[#7FD4C4] transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-[#7FD4C4] transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 flex justify-between items-center text-sm">
                <p>&copy; 2025 Edvizo. All rights reserved. | Kelompok 5</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-[#7FD4C4] transition">Twitter</a>
                    <a href="#" class="hover:text-[#7FD4C4] transition">Facebook</a>
                    <a href="#" class="hover:text-[#7FD4C4] transition">Instagram</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
</body>
</html>
