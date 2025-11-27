@extends('layouts.app')

@section('title', 'Simulasi Karir - Edvizo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#3B8773] to-[#2E6B5B] text-white pt-16 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Simulasi Karir</h1>
            <p class="text-lg text-gray-200 max-w-2xl">Jelajahi berbagai jalur karir yang tersedia di bidang teknologi dan temukan yang cocok untuk Anda.</p>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Pesan jika belum fiksasi jurusan -->
        @if (!$fixation)
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-8 rounded-lg mb-12">
                <div class="flex items-start gap-4">
                    <div class="text-4xl">⚠️</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Maaf, Anda Belum Fiksasi Jurusan</h2>
                        <p class="text-gray-700 mb-4">Untuk melihat simulasi karir berdasarkan jurusan yang cocok untuk Anda, silakan lakukan konsultasi dan fiksasi jurusan terlebih dahulu.</p>
                        <a href="{{ route('chatbot.index') }}" class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-bold transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Mulai Konsultasi & Fiksasi Jurusan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Semua Karir -->
            <section>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Semua Pilihan Karir</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Career Card 1 - Software Engineer -->
                    <a href="{{ route('simulasi.karir.detail', 'software-engineer') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">💻</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Software Engineer</h3>
                            <p class="text-sm text-gray-600 mb-4">Merancang dan mengembangkan perangkat lunak yang inovatif dan berkualitas tinggi</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Junior - Senior</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 2 - Data Scientist -->
                    <a href="{{ route('simulasi.karir.detail', 'data-scientist') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">📊</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Data Scientist</h3>
                            <p class="text-sm text-gray-600 mb-4">Menganalisis data untuk menghasilkan insight bisnis yang berharga</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Analyst - Lead</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 3 - Cloud Engineer -->
                    <a href="{{ route('simulasi.karir.detail', 'cloud-engineer') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">☁️</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Cloud Engineer</h3>
                            <p class="text-sm text-gray-600 mb-4">Mengelola infrastruktur cloud dan deployment aplikasi modern</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">DevOps - Architect</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 4 - Cybersecurity -->
                    <a href="{{ route('simulasi.karir.detail', 'cybersecurity') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">🔒</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Cybersecurity Specialist</h3>
                            <p class="text-sm text-gray-600 mb-4">Melindungi sistem dan data dari ancaman keamanan cyber</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Analyst - Architect</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 5 - AI Engineer -->
                    <a href="{{ route('simulasi.karir.detail', 'ai-engineer') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">🤖</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">AI Engineer</h3>
                            <p class="text-sm text-gray-600 mb-4">Mengembangkan sistem AI dan machine learning yang canggih</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Junior - Research</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 6 - UI/UX Designer -->
                    <a href="{{ route('simulasi.karir.detail', 'uiux-designer') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">🎨</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">UI/UX Designer</h3>
                            <p class="text-sm text-gray-600 mb-4">Merancang pengalaman pengguna yang intuitif dan menarik</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Junior - Lead</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 7 - Product Manager -->
                    <a href="{{ route('simulasi.karir.detail', 'product-manager') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">📱</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Product Manager</h3>
                            <p class="text-sm text-gray-600 mb-4">Memimpin pengembangan produk dari konsep hingga peluncuran</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">APM - Director</span>
                            </div>
                        </div>
                    </a>

                    <!-- Career Card 8 - Full Stack Developer -->
                    <a href="{{ route('simulasi.karir.detail', 'fullstack-developer') }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                        <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                            <div class="text-6xl">🌐</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">Full Stack Developer</h3>
                            <p class="text-sm text-gray-600 mb-4">Menguasai frontend dan backend untuk membangun aplikasi lengkap</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                <span class="text-xs text-gray-500 font-medium">Junior - Tech Lead</span>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        @else
            <!-- Jika sudah fiksasi jurusan -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-8 rounded-lg mb-12">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="text-4xl">✅</div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Jurusan yang Difiksasi</h2>
                            <p class="text-gray-700 mb-2"><strong>{{ $fixation->jurusan }}</strong></p>
                            <p class="text-gray-600 text-sm">{{ $fixation->deskripsi }}</p>
                        </div>
                    </div>
                    <a href="{{ route('chatbot.index') }}" class="text-sm font-bold text-[#3B8773] hover:text-[#2E6B5B] transition">
                        Fiksasi Ulang →
                    </a>
                </div>
            </div>

            <!-- Karir Rekomendasi berdasarkan jurusan -->
            <section>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-2 h-8 bg-gradient-to-b from-[#3B8773] to-[#7FD4C4] rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Karir yang Sesuai untuk Jurusan {{ $fixation->jurusan }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tampilkan karir berdasarkan jurusan -->
                    @php
                        $jurusanKarirMap = [
                            'Software Engineering' => ['software-engineer', 'fullstack-developer', 'ai-engineer'],
                            'Data Science' => ['data-scientist', 'ai-engineer', 'software-engineer'],
                            'Information Technology' => ['cloud-engineer', 'cybersecurity', 'devops'],
                            'Graphic Design' => ['uiux-designer', 'product-manager'],
                            // Tambahkan mapping sesuai dengan jurusan yang ada
                        ];

                        $karirs = $jurusanKarirMap[$fixation->jurusan] ?? ['software-engineer', 'data-scientist', 'cloud-engineer'];
                    @endphp

                    @foreach ($karirs as $karir)
                        <a href="{{ route('simulasi.karir.detail', $karir) }}" class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:border-[#3B8773]/20 transition-all duration-300 overflow-hidden group border border-gray-100">
                            <div class="bg-gradient-to-r from-[#3B8773] to-[#2E6B5B] h-32 relative overflow-hidden flex items-center justify-center">
                                <div class="text-6xl">
                                    @switch($karir)
                                        @case('software-engineer') 💻 @break
                                        @case('data-scientist') 📊 @break
                                        @case('cloud-engineer') ☁️ @break
                                        @case('cybersecurity') 🔒 @break
                                        @case('ai-engineer') 🤖 @break
                                        @case('uiux-designer') 🎨 @break
                                        @case('product-manager') 📱 @break
                                        @case('fullstack-developer') 🌐 @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#3B8773] transition">
                                    @switch($karir)
                                        @case('software-engineer') Software Engineer @break
                                        @case('data-scientist') Data Scientist @break
                                        @case('cloud-engineer') Cloud Engineer @break
                                        @case('cybersecurity') Cybersecurity Specialist @break
                                        @case('ai-engineer') AI Engineer @break
                                        @case('uiux-designer') UI/UX Designer @break
                                        @case('product-manager') Product Manager @break
                                        @case('fullstack-developer') Full Stack Developer @break
                                    @endswitch
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">Karir yang sesuai dengan jurusan Anda</p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="text-xs font-bold text-[#3B8773] bg-[#E8F5F3] px-3 py-1 rounded-full">Lihat Detail →</span>
                                    <span class="text-xs text-gray-500 font-medium">Recommended</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Detail Analisis Fiksasi -->
            <section class="mt-16">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Analisis Fiksasi Anda</h3>

                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-3">Alasan Cocok</h4>
                        <p class="text-gray-700 leading-relaxed">{{ $fixation->alasan_cocok }}</p>
                    </div>

                    @if ($fixation->swot)
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Strengths -->
                            <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-xl border border-green-100">
                                <h5 class="text-lg font-bold text-green-700 mb-3">✅ Kekuatan</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['strengths'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-green-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Weaknesses -->
                            <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl border border-red-100">
                                <h5 class="text-lg font-bold text-red-700 mb-3">⚠️ Kelemahan</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['weaknesses'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-red-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Opportunities -->
                            <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-xl border border-blue-100">
                                <h5 class="text-lg font-bold text-blue-700 mb-3">🎯 Peluang</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['opportunities'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-blue-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Threats -->
                            <div class="bg-gradient-to-br from-orange-50 to-white p-6 rounded-xl border border-orange-100">
                                <h5 class="text-lg font-bold text-orange-700 mb-3">⚡ Ancaman</h5>
                                <ul class="space-y-2">
                                    @foreach ($fixation->swot['threats'] ?? [] as $item)
                                        <li class="text-gray-700 flex items-start gap-2">
                                            <span class="text-orange-600 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    </div>
</div>

<script>
    document.getElementById('searchCareer')?.addEventListener('keyup', function() {
        // Search functionality dapat diimplementasikan di sini
    });
</script>
@endsection
