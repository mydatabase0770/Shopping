<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگای جلوه‌مەرک</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet"/>
</head>

<body class="font-['Noto_Naskh_Arabic'] bg-gray-100 text-gray-800 min-h-screen selection:bg-green-600 selection:text-white">

    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('public.index') }}"
               class="flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700 transition">
                <span>جلوبەرگ</span>
                <span class="text-xl">🏠</span>
            </a>

            <!-- Menu -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('public.index') }}"
                   class="text-gray-700 font-medium hover:text-green-600 pb-1 border-b-2 border-green-600">
                    فرۆشگا
                </a>
                <a href="#" class="text-gray-600 hover:text-green-600">دابەزرن</a>
                <a href="#" class="text-gray-600 hover:text-green-600">شوێن</a>
                <a href="#" class="text-gray-600 hover:text-green-600">بلۆگ</a>
                <a href="#" class="text-gray-600 hover:text-green-600">پارمەندی</a>
            </nav>

            <!-- Icons -->
            <div class="flex items-center gap-3 text-xl">

                {{-- IF user is logged in --}}
                @auth

                    {{-- Admin Dashboard Link --}}
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-green-600 hover:text-green-800 font-bold text-sm bg-green-100 px-3 py-1 rounded-lg">
                            پەڕەی یۆنەری 👑
                        </a>
                    @endif

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-10 h-10 bg-red-500/20 text-red-600 rounded-full flex justify-center items-center hover:bg-red-600 hover:text-white transition">
                            🚪
                        </button>
                    </form>

                    {{-- Profile Icon --}}
                    <a href="#" class="w-10 h-10 bg-orange-400 rounded-full flex justify-center items-center">
                        👤
                    </a>

                @endauth

                {{-- IF guest --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="w-10 h-10 bg-orange-400 rounded-full flex justify-center items-center hover:bg-orange-500 transition">
                        👤
                    </a>
                @endguest

                <button class="hover:text-gray-900">🛒</button>
                <button class="hover:text-gray-900">❤️</button>
            </div>

        </div>
    </header>

    <!-- Hero Section (Only for homepage) -->
    @if(request()->routeIs('public.index'))
    <section class="relative h-[50vh] bg-cover bg-center flex items-center justify-center"
             style="background-image:url('https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=1200&q=80');">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 text-center max-w-xl px-4">
            <h1 class="text-white text-3xl md:text-4xl font-bold mb-4">
                گەڕانی بازرگانی بە ئاسانترین شێوە
            </h1>

            <!-- Search -->
            <form action="{{ route('public.index') }}" method="get" class="relative">
                <input type="search"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="گەڕان…"
                       class="w-full py-3 pr-12 pl-4 rounded-md border border-gray-300 focus:ring-2 focus:ring-green-600 text-sm">
                <button class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <button onclick="document.getElementById('products')?.scrollIntoView({behavior:'smooth'})"
                    class="mt-6 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm">
                بەردەوام بە
            </button>
        </div>
    </section>
    @endif

    <!-- Main Content -->
    <main class="mx-auto px-4 py-10">
        @yield('content')
    </main>

</body>
</html>
