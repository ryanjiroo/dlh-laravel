<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Meta CSRF untuk operasi AJAX di Dashboard --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dinas Lingkungan Hidup')</title>

    {{-- Link Fonts dan Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- Vite CSS/JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    {{-- Script untuk Toggle Menu Mobile --}}
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-background font-sans antialiased flex flex-col min-h-screen">

    {{-- HEADER: Hanya tampil jika BUKAN di Dashboard --}}
    @if (!request()->is('dashboard'))
        @include('partials.header')
    @endif

    {{-- MAIN CONTENT --}}
    {{-- pt-[70px] mengimbangi header fixed di non-dashboard pages --}}
    <main class="flex-grow @if(!request()->is('dashboard')) pt-[70px] @endif">
        @yield('content')
    </main>

    {{-- FOOTER: Hanya tampil jika BUKAN di Dashboard --}}
    @if (!request()->is('dashboard'))
        @include('partials.footer')
    @endif
    @stack('scripts')

</body>

</html>