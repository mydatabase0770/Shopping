<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))
    )
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans flex flex-col min-h-screen">

    <!-- Header Navigation -->
    <header class="w-full max-w-5xl mx-auto p-6 lg:px-8 flex justify-end items-center gap-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-5 py-2 bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md font-medium transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-md font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-5 py-2 bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md font-medium transition">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col justify-center items-center text-center px-6 lg:px-0">
        <h1 class="text-4xl lg:text-6xl font-bold mb-4">
            Welcome to {{ config('app.name', 'Laravel') }}
        </h1>
        <p class="text-lg lg:text-xl mb-6 text-gray-600 dark:text-gray-400 max-w-xl">
            Build modern web applications with Laravel, powered by Blade, TailwindCSS, and Vite.
        </p>
        <div class="flex gap-4 flex-wrap justify-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold transition">
                        Log In
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-md font-semibold transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full text-center py-6 mt-auto text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
    </footer>

</body>
</html>
