@extends('public.layout.publiclayout')

@section('content')

<main id="products" class="max-w-7xl mx-auto grid grid-cols-12 gap-6 p-6 mt-10">

    <!-- Filters Sidebar -->
    <aside class="col-span-12 lg:col-span-3 order-last lg:order-first">

        <div class="bg-white dark:bg-gray-900 p-5 rounded-xl shadow-md sticky top-24">

            <h4 class="font-semibold mb-4 text-sm text-gray-800 dark:text-gray-200">فلتەر</h4>

            <!-- Categories -->
            <div class="mb-6">
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2">پۆلەکان</p>
                <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    @foreach (['گەورەکان','نۆنه‌کان','منداڵان','زستانە','هاوینە','پیایەوان'] as $item)
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox"
                                       class="rounded border-gray-300 dark:border-gray-600 text-green-600 focus:ring-green-500">
                                {{ $item }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Price Range -->
            <div class="mb-8">
                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2 block">
                    نرخی بەکاربهێنە
                </label>

                <div class="flex items-center gap-2">
                    <input type="number"
                           placeholder="کەمترین"
                           class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700
                                  bg-gray-100 dark:bg-gray-800 text-sm focus:ring-2 focus:ring-green-500">

                    <span class="text-gray-500 dark:text-gray-400">-</span>

                    <input type="number"
                           placeholder="بەرزترین"
                           class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700
                                  bg-gray-100 dark:bg-gray-800 text-sm focus:ring-2 focus:ring-green-500">
                </div>

                <button
                    class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md text-sm transition">
                    نرخ دیاری بکە
                </button>
            </div>

            <!-- Discounts -->
            <div class="p-4 bg-green-100 dark:bg-green-900/40 rounded-xl text-center shadow-sm">
                <h5 class="font-semibold text-green-800 dark:text-green-300">دانشکاندەکان</h5>
                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                    ٣٠% داخوازی بۆ ئەم هەفتە
                </p>
                <button
                    class="mt-3 w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-md text-sm transition">
                    بینین
                </button>
            </div>

        </div>
    </aside>



    <!-- Products Grid -->
    <section class="col-span-12 lg:col-span-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            @foreach ($posts as $post)

            <div
                class="relative bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 group">

                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-300">

                <!-- gradient layer -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 to-transparent"></div>

                <!-- heart -->
                <button
                    class="absolute top-3 right-3 w-9 h-9 bg-white/80 dark:bg-gray-700/70 backdrop-blur-sm text-red-500 rounded-full flex items-center justify-center shadow-md hover:bg-white dark:hover:bg-gray-600 transition">
                    <i class="fas fa-heart text-lg"></i>
                </button>

                <div class="absolute bottom-0 w-full p-4 text-white">
                    <p class="text-lg font-bold truncate">{{ $post->title }}</p>
                    <p class="mt-2 inline-block bg-green-700/80 backdrop-blur-sm text-sm px-3 py-1 rounded-md border border-green-700">
                        د.ع {{ number_format($post->price) }}
                    </p>
                </div>

            </div>

            @endforeach

        </div>
    </section>



    <!-- Vendor Sidebar -->
    <aside class="col-span-12 lg:col-span-3">

        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md sticky top-24">

            <div class="flex items-center gap-4">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&q=80"
                     alt="profile"
                     class="w-16 h-16 rounded-xl object-cover">
                <div>
                    <h3 class="font-semibold text-sm text-gray-800 dark:text-gray-200">فاتح بەیان</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        فروشکار / مەودا و پوشاک
                    </p>
                </div>
            </div>

            <p class="mt-4 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                کورتە دەربارە: ئەم خودە فروشکەی تایبەتی منە، بە شیوازێکی سەردەمی کار دەکەم و خزمەتت دەکەم.
            </p>

            <div class="mt-5 flex gap-2">
                <button
                    class="flex-1 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 px-3 py-2 rounded-md text-sm">
                    پەیام
                </button>
                <button
                    class="flex-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 px-3 py-2 rounded-md text-sm">
                    زیاتر
                </button>
            </div>

            <ul class="mt-6 space-y-2 text-sm">

                <li class="flex justify-between bg-green-50 dark:bg-green-900/40 p-3 rounded-md">
                    <span class="text-gray-700 dark:text-gray-300">سەردانی ماڵپەڕ</span>
                    <span class="font-semibold text-gray-900 dark:text-white">٤٥</span>
                </li>

                <li class="flex justify-between bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-3 rounded-md">
                    <span class="text-gray-700 dark:text-gray-300">فرۆشتنەکان</span>
                    <span class="font-semibold text-gray-900 dark:text-white">١٢</span>
                </li>

            </ul>

        </div>

    </aside>

</main>

@endsection
