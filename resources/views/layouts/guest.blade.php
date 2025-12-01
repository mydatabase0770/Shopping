<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'جل و بەرگ') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 relative">

    <!-- Background Image -->
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('images/shop-bg.jpg') }}" alt="جل و بەرگ" class="w-full h-full object-cover opacity-30 dark:opacity-50">
        <div class="absolute inset-0 bg-black/20 dark:bg-black/40"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-gray-500 dark:text-gray-200" />
            </a>
        </div>

        <!-- Content Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-gray-600 dark:text-gray-400 text-sm">
            © {{ date('Y') }} جل و بەرگ. ھەمە مافەکان پارێزراون.
        </footer>
    </div>
</body>
</html>
