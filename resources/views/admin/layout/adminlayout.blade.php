<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>جل و بەرگ | پەڕەی بەڕێوەبەر</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=noto-naskh-arabic:400,600&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-noto bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 text-gray-900 min-h-screen">

<!-- 📱 Mobile Menu Button -->
<button id="mobileMenuBtn"
        class="lg:hidden fixed top-4 right-4 z-50 bg-white/90 backdrop-blur-md p-3 rounded-xl shadow-lg hover:shadow-xl transition-transform duration-200 active:scale-95">
    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- 🌑 Overlay -->
<div id="mobileOverlay"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

<!-- 🌙 Sidebar -->
<aside id="sidebar"
       class="w-72 bg-white/90 backdrop-blur-md shadow-2xl border-l border-gray-200/50
              fixed right-0 top-0 h-full flex flex-col justify-between z-50
              translate-x-full lg:translate-x-0 transition-transform duration-300">

    <!-- Sidebar Top -->
    <div class="relative">
        <!-- Close Button (Mobile) -->
        <button id="closeSidebarBtn"
                class="lg:hidden absolute top-4 left-4 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200 active:scale-95">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="p-6 flex flex-col items-center">
            <!-- Logo -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full blur opacity-25 group-hover:opacity-40 transition"></div>
                <div class="relative bg-gradient-to-br from-blue-600 to-indigo-600 text-white w-20 h-20 flex items-center justify-center rounded-full shadow-lg">
                    <span class="text-4xl font-bold">ج</span>
                </div>
            </div>

            <h1 class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mt-4 mb-8 tracking-wide text-center">
                جل و بەرگ
            </h1>

            <!-- Navigation -->
            <nav class="w-full space-y-2">

                @php
                    $menu = [
                        ['route' => 'admin.dashboard', 'icon' => '🏠', 'label' => 'سەرەکی'],
                        ['route' => 'users.index', 'icon' => '👥', 'label' => 'بەکارهێنەران'],
                        ['route' => 'categories.index', 'icon' => '📂', 'label' => 'بەشەکان'],
                        ['route' => 'posts.index', 'icon' => '📦', 'label' => 'کالاکان'],
                        ['route' => null, 'icon' => '💰', 'label' => 'فرۆشتن'],
                    ];
                @endphp

                @foreach ($menu as $item)
                    @php
                    $href = $item['route'] && Route::has($item['route']) ? route($item['route']) : '#';
                    $isActive = $item['route'] && Route::has($item['route']) && request()->routeIs($item['route']);

                    @endphp

                    <a href="{{ $href }}"
                       class="flex flex-col items-center justify-center py-3 px-4 rounded-xl gap-1
                              text-sm font-medium transition-all duration-200
                              {{ $isActive ? 'bg-gradient-to-l from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-blue-50' }}">
                        <span class="text-2xl">{{ $item['icon'] }}</span>
                        <span class="text-center">{{ $item['label'] }}</span>
                    </a>
                @endforeach

            </nav>
        </div>
    </div>

    <!-- Logout -->
    <div class="p-6 border-t border-gray-200/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex flex-col items-center justify-center w-full py-3 px-4 gap-1
                           text-red-600 hover:text-white font-semibold text-sm
                           hover:bg-gradient-to-l hover:from-red-500 hover:to-red-600
                           rounded-xl hover:shadow-lg hover:shadow-red-500/30 transition duration-200 active:scale-95">
                <span class="text-xl">🚪</span>
                <span>چوونەدەرەوە</span>
            </button>
        </form>
    </div>
</aside>

<!-- 🌐 Main Content -->
<main class="lg:mr-72 p-6 min-h-screen pt-20 lg:pt-6">
    {{ $slot }}
</main>

<!-- Scripts -->
<script>
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const mobileOverlay = document.getElementById('mobileOverlay');

    function openSidebar() {
        sidebar.classList.remove('translate-x-full');
        mobileOverlay.classList.remove('hidden');
        setTimeout(() => mobileOverlay.classList.add('opacity-100'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.add('translate-x-full');
        mobileOverlay.classList.remove('opacity-100');
        setTimeout(() => {
            mobileOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    mobileMenuBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);
    mobileOverlay.addEventListener('click', closeSidebar);

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) closeSidebar();
    });
</script>

</body>
</html>
