<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Edvizo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --edvizo-green: #3B8773;
            --edvizo-dark: #2E6B5B;
            --edvizo-light: #E8F5F3;
        }
        body { font-family: 'Poppins', sans-serif; }
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
