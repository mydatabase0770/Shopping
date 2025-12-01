@component('admin.layout.adminlayout')
<main class="flex-1 mr-50 p-10">

    <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
        <h2 class="text-3xl font-bold mb-8 text-blue-700 text-right border-b pb-3">پەڕەی سەرەکی</h2>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

            <!-- Users -->
            <div class="bg-blue-50 p-6 rounded-lg shadow hover:shadow-lg transition text-right border-r-4 border-blue-500">
                <h3 class="text-lg font-semibold text-blue-700 mb-2">بەكارهێنەرەكان</h3>
                <p class="text-gray-700">{{ $usersCount }} بەکارهێنەر تۆمارکراوە.</p>
            </div>

            <!-- Posts -->
            <div class="bg-green-50 p-6 rounded-lg shadow hover:shadow-lg transition text-right border-r-4 border-green-500">
                <h3 class="text-lg font-semibold text-green-700 mb-2">پۆستەکان</h3>
                <p class="text-gray-700">کۆی گشتی پۆستەکان: {{ $postsCount }}</p>
            </div>

            <!-- Categories -->
            <div class="bg-yellow-50 p-6 rounded-lg shadow hover:shadow-lg transition text-right border-r-4 border-yellow-500">
                <h3 class="text-lg font-semibold text-yellow-700 mb-2">جۆرەکان</h3>
                <p class="text-gray-700">کۆی جۆرەکان: {{ $categoriesCount }}</p>
            </div>

        </div>
    </main>
@endcomponent
