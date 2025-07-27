<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Menggunakan helper config standar Laravel untuk nama aplikasi --}}
    <title>{{ config('Para Petani', 'Para Petani') }}</title>

    {{-- Path asset yang lebih bersih --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('./img/ZeroHungerFavi.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('./img/ZeroHungerFavi.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased transition-colors duration-300">
    <div class="min-h-screen bg-background flex flex-col">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-card border-b">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Main Content - Tambahkan flex-grow agar footer menempel di bawah --}}
        <main class="py-12 flex-grow">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (isset($header))
                    <div class="bg-card overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-foreground">
                            {{ $slot }}
                        </div>
                    </div>
                @else
                    {{ $slot }}
                @endif
            </div>
        </main>

        {{-- ✅ PANGGIL FOOTER DI SINI --}}
        @include('layouts.partials.footer')

    </div>
    @stack('scripts')
</body>

</html>
