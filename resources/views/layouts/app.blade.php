<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edvizo - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-teal-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-700 to-green-600 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-green-700 text-xl">🎓</span>
                    </div>
                    <span class="text-white text-2xl font-bold">Edvizo.</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-white hover:text-green-100 transition">Konsultasi</a>
                    <a href="#" class="text-white hover:text-green-100 transition">Layanan Informasi</a>
                    <a href="#" class="text-white hover:text-green-100 transition">Ghani Baskara Syah</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-teal-100 to-green-100 py-10 mt-16 border-t border-green-200">
        <div class="container mx-auto px-6">
            <div class="flex justify-center space-x-12 mb-6">
                <a href="#" class="text-gray-600 hover:text-green-600 transition">Courses</a>
                <a href="#" class="text-gray-600 hover:text-green-600 transition">Experts</a>
                <a href="#" class="text-gray-600 hover:text-green-600 transition">About us</a>
            </div>
            <div class="flex justify-between items-center pt-6 border-t border-green-200">
                <button class="text-green-600 hover:text-green-700 transition">💬 Let's chat</button>
                <a href="mailto:info@logoipsum.com" class="text-gray-600 hover:text-green-600 transition">
                    ✉️ info@logoipsum.com
                </a>
            </div>
        </div>
    </footer>
    <title>@yield('title', 'Edvizor')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-50">
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @yield('scripts')
</body>
</html>