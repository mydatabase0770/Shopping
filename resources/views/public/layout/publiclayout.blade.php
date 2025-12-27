<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرۆشگای جلوه‌مەڕک</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Kurdish Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 font-['Vazirmatn','Noto_Sans_Arabic']
             selection:bg-green-600 selection:text-white">

<!-- ================= HEADER ================= -->
<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/90 backdrop-blur">
    <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">

        <!-- LOGO -->
        <a href="{{ route('public.index') }}"
           class="flex items-center gap-2 px-5 py-2 font-bold text-white transition shadow-md rounded-xl bg-gradient-to-l from-green-600 to-emerald-500 hover:shadow-lg hover:scale-105">
            <span>جلوبەرگ</span>
            <i class="fa-solid fa-store"></i>
        </a>

        <!-- NAV -->
        <nav class="items-center hidden gap-8 text-sm font-medium md:flex">
            <a href="{{ route('public.index') }}" class="transition hover:text-green-600">فرۆشگا</a>

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-green-600">
                        بەڕێوەبەر
                    </a>
                @endif
            @endauth

            <a href="#" class="transition hover:text-green-600">شوێن</a>
            <a href="#" class="transition hover:text-green-600">بلۆگ</a>
        </nav>

        <!-- ACTIONS -->
        <div class="flex items-center gap-3">

            {{-- FAVORITES --}}
            @auth
            <div class="relative" x-data="{ open:false }">
                <button @click="open=!open" @click.outside="open=false"
                        class="relative flex items-center justify-center w-10 h-10 transition rounded-full bg-red-50 hover:bg-red-100">
                    <i class="text-red-500 fa-solid fa-heart"></i>

                    @if($favCount > 0)
                        <span class="absolute flex items-center justify-center w-5 h-5 text-xs text-white bg-red-600 rounded-full -top-1 -right-1">
                            {{ $favCount }}
                        </span>
                    @endif
                </button>

                <div x-show="open" x-transition style="display:none"
                     class="absolute z-50 mt-4 -translate-x-1/2 bg-white border shadow-xl left-1/2 w-80 rounded-2xl">
                    <div class="p-4 font-bold text-center border-b">دڵخوازەکان</div>

                    <ul class="overflow-y-auto divide-y max-h-72">
                        @forelse($favorites as $item)
                            <li>
                                <a href="{{ route('detialpost', $item->post->id) }}"
                                   class="flex gap-3 p-4 transition hover:bg-gray-50">
                                    <img src="{{ asset('storage/'.$item->post->image) }}"
                                         class="object-cover w-12 h-12 border rounded-xl">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold truncate">{{ $item->post->title }}</p>
                                        <p class="text-xs text-gray-500">${{ number_format($item->post->price,2) }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="p-4 text-center text-gray-400">هیچ دڵخوازێک نیە</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @endauth

            {{-- CART --}}
            @auth
            <div class="relative" x-data="{ open:false }">
                <button @click="open=!open" @click.outside="open=false"
                        class="relative flex items-center justify-center w-10 h-10 transition bg-gray-100 rounded-full hover:bg-gray-200">
                    <i class="fa-solid fa-cart-shopping"></i>

                    @if($cartCount > 0)
                        <span class="absolute flex items-center justify-center w-5 h-5 text-xs text-white bg-gray-800 rounded-full -top-1 -right-1">
                            {{ $cartCount }}
                        </span>
                    @endif
                </button>

                <div x-show="open" x-transition style="display:none"
                     class="absolute z-50 mt-4 -translate-x-1/2 bg-white border shadow-xl left-1/2 w-80 rounded-2xl">
                    <div class="p-4 font-bold text-center border-b">سەبەتە</div>

                    <ul class="overflow-y-auto divide-y max-h-72">
                        @forelse($carts as $item)
                            <li>
                                <a href="{{ route('detialpost', $item->post->id) }}"
                                   class="flex gap-3 p-4 transition hover:bg-gray-50">
                                    <img src="{{ asset('storage/'.$item->post->image) }}"
                                         class="object-cover w-12 h-12 border rounded-xl">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold truncate">{{ $item->post->title }}</p>
                                        <p class="text-xs text-gray-500">${{ number_format($item->post->price,2) }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="p-4 text-center text-gray-400">سەبەتە بەتاڵە</li>
                        @endforelse
                    </ul>

                    <div class="p-4 border-t">
                        <a href="{{ route('viewcarts') }}"
                           class="block w-full py-2 font-semibold text-center text-white transition bg-green-600 rounded-xl hover:bg-green-700">
                            🛒 بینینی تەواوی سەبەتە
                        </a>
                    </div>
                </div>
            </div>
            @endauth

            {{-- USER / LOGOUT --}}
            @auth
            <div class="relative" x-data="{ open:false }">
                <button @click="open=!open" @click.outside="open=false"
                        class="flex items-center justify-center w-10 h-10 text-white transition bg-orange-400 rounded-full hover:bg-orange-500">
                    <i class="fa-solid fa-user"></i>
                </button>

                <div x-show="open" x-transition style="display:none"
                     class="absolute z-50 mt-3 -translate-x-1/2 bg-white border shadow-xl left-1/2 w-44 rounded-xl">

                    <a href="{{ route('userprofile.index') }}"
                       class="block px-4 py-2 text-sm transition hover:bg-gray-100">
                        👤 پرۆفایل
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 text-sm text-right text-red-600 transition hover:bg-red-50">
                            🚪 دەرچوون
                        </button>
                    </form>

                </div>
            </div>
            @else
                <a href="{{ route('login') }}"
                   class="flex items-center justify-center w-10 h-10 text-white transition bg-orange-400 rounded-full hover:bg-orange-500">
                    <i class="fa-solid fa-user"></i>
                </a>
            @endauth

        </div>
    </div>
</header>


<!-- ================= HERO ================= -->
@if(request()->routeIs('public.index'))
<section class="py-20 bg-white border-b">
    <div class="max-w-2xl px-4 mx-auto text-center">
        <h1 class="text-4xl font-bold leading-relaxed text-gray-800 md:text-5xl">
            بە گەڕانی خێرا کاڵاکانت بدۆزەوە
        </h1>
        <p class="mt-3 text-gray-600">بازاڕێکی نوێ، خێرا و ئاسان بۆ کڕین</p>

        <form method="GET" action="{{ route('public.index') }}" class="relative max-w-xl mx-auto mt-8">
            <span class="absolute text-gray-400 -translate-y-1/2 left-4 top-1/2">
                <i class="fa fa-search"></i>
            </span>
            <input type="search" name="search"
                   value="{{ request('search') }}"
                   placeholder="ناوی کاڵا بنووسە..."
                   class="w-full py-3 pl-12 pr-4 transition bg-gray-100 border rounded-2xl focus:ring-2 focus:ring-green-500 focus:bg-white">
        </form>
    </div>
</section>
@endif

<!-- ================= MAIN ================= -->
<main class="px-4 py-12 mx-auto max-w-7xl">
    <div class="grid grid-cols-12 gap-6 lg:gap-10">

        <aside class="col-span-12 lg:col-span-3">
            @include('public.layout.filter-sidebar')
        </aside>

        <section class="col-span-12 lg:col-span-6">
            @yield('content')
        </section>

        <aside class="col-span-12 lg:col-span-3">
            @include('public.layout.vendor-sidebar')
        </aside>

    </div>
</main>

</body>
</html>
