<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ICU AgroProducts')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-[#F5FBF2]">
    <header class="bg-white border-b border-[#1B4D3E]/10">
        <div class="container-icu flex flex-wrap items-center justify-between gap-4 py-4">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-[#1B4D3E] font-bold" aria-label="ICU AgroProducts home">
                <img src="{{ asset('images/logo.png') }}" alt="" class="h-12 w-auto object-contain">
                <span>ICU AgroProducts</span>
            </a>

            <nav aria-label="Main navigation" class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm font-semibold text-[#1B4D3E]">
                <a href="{{ route('home') }}" class="hover:text-[#6DBE45] transition">Home</a>
                <a href="{{ route('shop') }}" class="hover:text-[#6DBE45] transition">Products</a>
                <a href="{{ route('about') }}" class="hover:text-[#6DBE45] transition">About</a>
                <a href="{{ route('contact') }}" class="hover:text-[#6DBE45] transition">Contact</a>
            </nav>
        </div>
    </header>

    @hasSection('hero')
        @yield('hero')
    @endif

    <main class="flex-1">
        <div class="container-icu py-10">
            @yield('content')
        </div>
    </main>

    <footer class="bg-[#1B4D3E] text-white">
        <div class="container-icu flex flex-col sm:flex-row items-center justify-between gap-3 py-6 text-sm">
            <p>&copy; {{ date('Y') }} ICU AgroProducts. All rights reserved.</p>
            <a href="{{ route('legal.show', 'disclaimer') }}" class="hover:text-[#C8E6A0] transition">Disclaimer</a>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
