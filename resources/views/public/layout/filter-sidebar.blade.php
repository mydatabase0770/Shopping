<!-- FILTER SIDEBAR -->
<aside class="order-last col-span-12 lg:col-span-3 lg:order-first">
    <div class="sticky p-6 space-y-8 bg-white border border-gray-100 shadow-xl top-24 rounded-3xl dark:bg-gray-900 dark:border-gray-800">

        <!-- Title -->
        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
            فلتەر
        </h3>

        <!-- FILTER FORM -->
        <form id="filterForm" action="{{ route('public.index') }}" method="GET" class="space-y-8">

            <!-- Categories -->
            <div>
                <p class="mb-4 text-sm font-semibold text-gray-600 dark:text-gray-400">
                    پۆلەکان
                </p>

                <ul class="space-y-3">
                    @foreach ($categories as $category)
                        <li>
                            <label class="flex items-center gap-3 text-sm text-gray-700 cursor-pointer dark:text-gray-300">
                                <input
                                    type="checkbox"
                                    name="category[]"
                                    value="{{ $category->id }}"
                                    onchange="submitForm()"
                                    @checked(request()->has('category') && in_array($category->id, request('category')))
                                    class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-2 focus:ring-green-500 dark:border-gray-700 dark:bg-gray-800"
                                >
                                <span>{{ $category->name }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-800"></div>

            <!-- Price Range -->
            <div>
                <p class="mb-4 text-sm font-semibold text-gray-600 dark:text-gray-400">
                    نرخی بەکاربهێنە
                </p>

                <div class="grid grid-cols-2 gap-3">
                    <input
                        type="number"
                        name="min_price"
                        value="{{ request('min_price') }}"
                        placeholder="کەمترین"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl bg-gray-50 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500"
                    >

                    <input
                        type="number"
                        name="max_price"
                        value="{{ request('max_price') }}"
                        placeholder="بەرزترین"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl bg-gray-50 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <button
                    type="submit"
                    class="mt-4 w-full rounded-xl bg-green-600 py-2.5 text-sm font-semibold text-white
                           transition hover:bg-green-700 active:scale-[0.98]"
                >
                    نرخ دیاری بکە
                </button>
            </div>

        </form>

        <!-- Divider -->
        <div class="border-t border-gray-200 dark:border-gray-800"></div>

        <!-- 🔥 DISCOUNT FILTER BOX -->
        <div class="p-4 text-center rounded-2xl bg-green-50 dark:bg-green-900/30">
            <h4 class="font-semibold text-green-700 dark:text-green-300">
                داشکاندەکان
            </h4>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                تەنها ئەو بەرهەمانە پیشان بدە کە داشکاندنیان هەیە
            </p>

            <a href="{{ route('public.index', array_merge(request()->except('page'), ['discount' => 1])) }}"
               class="block w-full py-2 mt-3 text-sm font-semibold text-white transition bg-yellow-500 rounded-xl hover:bg-yellow-600">
                بینین
            </a>
        </div>

    </div>
</aside>

<script>
    function submitForm() {
        const form = document.getElementById('filterForm');
        if (!form) return;
        form.submit();
    }
</script>
