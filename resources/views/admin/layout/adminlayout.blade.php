<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>جل و بەرگ | بەڕێوەبەر</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Vazirmatn'] bg-slate-100 text-gray-900 min-h-screen">

<!-- 📱 Mobile Button -->
<button id="openSidebar"
        class="fixed z-50 p-3 bg-white shadow-md lg:hidden top-4 right-4 rounded-xl">
    <i class="text-xl fa-solid fa-bars"></i>
</button>

<!-- 🌑 Overlay -->
<div id="overlay"
     class="fixed inset-0 z-40 hidden bg-black/40 lg:hidden"></div>

<!-- 📌 Sidebar -->
<aside id="sidebar"
       class="fixed top-0 right-0 z-50 flex flex-col h-full transition-transform duration-300 translate-x-full bg-white shadow-xl w-72 lg:translate-x-0">

    <!-- Logo -->
    <div class="p-6 text-center border-b">
        <div class="flex items-center justify-center w-16 h-16 mx-auto text-3xl font-bold text-white bg-indigo-600 rounded-full">
            ج
        </div>
        <h1 class="mt-3 text-xl font-bold text-indigo-600">جل و بەرگ</h1>
        <p class="text-xs text-gray-500">Admin Panel</p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('admin.dashboard')
                ? 'bg-indigo-600 text-white shadow'
                : 'hover:bg-indigo-50' }}">
            <i class="fa-solid fa-house"></i>
            <span>سەرەکی</span>
        </a>

        <!-- Users -->
        <a href="{{ route('users.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('users.*')
                ? 'bg-indigo-600 text-white shadow'
                : 'hover:bg-indigo-50' }}">
            <i class="fa-solid fa-users"></i>
            <span>بەکارهێنەران</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('categories.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('categories.*')
                ? 'bg-indigo-600 text-white shadow'
                : 'hover:bg-indigo-50' }}">
            <i class="fa-solid fa-folder"></i>
            <span>بەشەکان</span>
        </a>

        <!-- Products -->
        <a href="{{ route('posts.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('posts.*')
                ? 'bg-indigo-600 text-white shadow'
                : 'hover:bg-indigo-50' }}">
            <i class="fa-solid fa-box"></i>
            <span>کالاکان</span>
        </a>

                <!-- Sales -->
        <a href="{{ route('transaction.index') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('admin.sales.*')
                ? 'bg-indigo-600 text-white shadow'
                : 'hover:bg-indigo-50' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>فرۆشتن</span>
        </a>

    </nav>

    <!-- Logout -->
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex items-center justify-center w-full gap-3 px-4 py-3 text-red-600 transition rounded-xl hover:bg-red-600 hover:text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>چوونەدەرەوە</span>
            </button>
        </form>
    </div>

</aside>

<!-- 🌐 Content -->
<main class="min-h-screen p-6 pt-20 lg:mr-72 lg:pt-6">
    {{ $slot }}
</main>

<!-- Scripts -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const openBtn = document.getElementById('openSidebar');

    openBtn.onclick = () => {
        sidebar.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
    };

    overlay.onclick = () => {
        sidebar.classList.add('translate-x-full');
        overlay.classList.add('hidden');
    };
</script>

</body>
</html>
