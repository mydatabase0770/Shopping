@component('admin.layout.adminlayout')
<div dir="rtl" class="max-w-3xl mx-auto mt-10 bg-white/95 backdrop-blur-md shadow-xl rounded-2xl overflow-hidden border border-gray-100">

    <!-- Header -->
    <div class="bg-gradient-to-l from-indigo-600 to-blue-500 px-6 py-5 text-right">
        <h2 class="text-2xl font-bold text-white">دروستکردنی بەشێکی نوێ</h2>
        <p class="text-indigo-100 text-sm mt-1">زانیارییەکانی بەش بنووسە بۆ دروستکردنی بەشێکی نوێ</p>
    </div>

    <!-- Form -->
    <form action="{{ route('categories.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

        <!-- Name Input -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 text-right mb-1">بەش</label>

            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 transition">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-tag"></i>
                </span>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="بەش بنوسە..."
                    value="{{ old('name') }}"
                    class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700"
                    required
                >
            </div>

            @error('name')
                <p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit"
                class="w-full flex justify-center items-center gap-2 py-3 text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                <i class="fas fa-plus-circle"></i>
                دروستکردن
            </button>
        </div>

    </form>

</div>

<!-- Icons -->
<script src="https://kit.fontawesome.com/a2b3c7b42f.js" crossorigin="anonymous"></script>
@endcomponent
