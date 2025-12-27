@component('admin.layout.adminlayout')

<main dir="rtl" class="flex-1 min-h-screen p-10 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

    <!-- Page Title -->
    <div class="mb-10">
        <h2 class="mb-2 text-4xl font-extrabold text-gray-800">
            👋 بەخێربێیت بۆ بەڕێوەبەر
        </h2>
        <p class="text-gray-600">
            کورتەیەک لە دۆخی سیستەمەکەت
        </p>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 xl:grid-cols-5">

        <!-- Users -->
        <div class="relative p-6 overflow-hidden transition bg-white border border-blue-100 shadow-lg rounded-2xl hover:shadow-xl">
            <div class="absolute w-24 h-24 bg-blue-100 rounded-full -top-6 -left-6"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-3xl text-blue-600">
                        <i class="fa-solid fa-users"></i>
                    </span>
                </div>
                <h3 class="mb-1 text-sm font-semibold text-gray-500">بەکارهێنەران</h3>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $usersCount }}
                </p>
            </div>
        </div>

        <!-- Posts -->
        <div class="relative p-6 overflow-hidden transition bg-white border border-green-100 shadow-lg rounded-2xl hover:shadow-xl">
            <div class="absolute w-24 h-24 bg-green-100 rounded-full -top-6 -left-6"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-3xl text-green-600">
                        <i class="fa-solid fa-box"></i>
                    </span>
                </div>
                <h3 class="mb-1 text-sm font-semibold text-gray-500">کاڵاکان</h3>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $postsCount }}
                </p>
            </div>
        </div>

        <!-- Categories -->
        <div class="relative p-6 overflow-hidden transition bg-white border border-yellow-100 shadow-lg rounded-2xl hover:shadow-xl">
            <div class="absolute w-24 h-24 bg-yellow-100 rounded-full -top-6 -left-6"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-3xl text-yellow-600">
                        <i class="fa-solid fa-folder-open"></i>
                    </span>
                </div>
                <h3 class="mb-1 text-sm font-semibold text-gray-500">جۆرەکان</h3>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $categoriesCount }}
                </p>
            </div>
        </div>

        <!-- Transactions -->
        <div class="relative p-6 overflow-hidden transition bg-white border border-purple-100 shadow-lg rounded-2xl hover:shadow-xl">
            <div class="absolute w-24 h-24 bg-purple-100 rounded-full -top-6 -left-6"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-3xl text-purple-600">
                        <i class="fa-solid fa-receipt"></i>
                    </span>
                </div>
                <h3 class="mb-1 text-sm font-semibold text-gray-500">فرۆشتن</h3>
                <p class="text-3xl font-bold text-gray-800">
                    {{ $transactionsCount }}
                </p>
            </div>
        </div>

        <!-- Revenue -->
        <div class="relative p-6 overflow-hidden transition bg-white border shadow-lg rounded-2xl border-emerald-100 hover:shadow-xl">
            <div class="absolute w-24 h-24 rounded-full -top-6 -left-6 bg-emerald-100"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-3xl text-emerald-600">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </span>
                </div>
                <h3 class="mb-1 text-sm font-semibold text-gray-500">کۆی پارە</h3>
                <p class="text-3xl font-bold text-gray-800">
                    ${{ number_format($totalRevenue, 2) }}
                </p>
            </div>
        </div>

    </div>

</main>

@endcomponent
