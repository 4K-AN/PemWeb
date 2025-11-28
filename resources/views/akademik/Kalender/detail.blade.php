<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan - Edvizor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        sage: {
                            50: '#f3f9f6',
                            100: '#e2f0e9',
                            200: '#cde0d3',
                            300: '#b1c9b5',
                            400: '#92b296',
                            500: '#7da893',
                            600: '#558b72',
                            700: '#4a7c66',
                            800: '#3a5f4e',
                            900: '#2f5d48'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .wave-bottom {
            clip-path: path('M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z');
        }
    </style>
</head>
<body class="min-h-screen bg-green-50 font-sans relative overflow-hidden">

    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full z-0 pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <svg class="absolute bottom-0 w-full text-green-800 opacity-10 wave-bottom" viewBox="0 0 1440 320" fill="currentColor">
            <path fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </div>

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
    <div class="relative z-10 max-w-3xl mx-auto px-4 py-20">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-green-100 p-8 md:p-12 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-2xl font-bold text-green-800">{{ $day ?? 15 }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Detail Kegiatan Tanggal {{ $day ?? 15 }}</h1>
            <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8">
                <p class="text-gray-700 text-lg">Belum ada kegiatan khusus yang diatur untuk tanggal ini.</p>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/kalender-akademik" class="bg-gradient-to-r from-sage-600 to-sage-700 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300 inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Kalender
                    </a>
                    <button class="bg-white border-2 border-sage-600 text-sage-700 font-bold py-3 px-8 rounded-xl hover:bg-sage-50 transition duration-300 inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Setel Pengingat
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-8 text-center">
        <div class="text-green-800 text-xs font-bold opacity-60">
            © - Copyright by Edvizo.
        </div>
    </div>

</body>
</html>
