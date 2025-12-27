@component('admin.layout.adminlayout')
<div dir="rtl" class="max-w-3xl mx-auto mt-10 overflow-hidden border border-gray-100 shadow-xl bg-white/95 backdrop-blur-md rounded-2xl">

    <!-- Header -->
    <div class="px-6 py-5 text-right bg-gradient-to-l from-indigo-600 to-blue-500">
        <h2 class="text-2xl font-bold text-white">دروستکردنی پۆستەکی نوێ</h2>
        <p class="mt-1 text-sm text-indigo-100">
            زانیارییەکانی پۆست بنووسە بۆ دروستکردنی پۆستێکی نوێ
        </p>
    </div>

    <!-- Form -->
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">ناونیشانی پۆست</label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('title')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">نرخ</label>
            <input
                type="number"
                name="price"
                value="{{ old('price') }}"
                step="0.01"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('price')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">دەربارە</label>
            <textarea
                name="description"
                rows="4"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">وێنە</label>
            <input
                type="file"
                name="image"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('image')
                <p class="mt-1 text-sm text-right text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">ڕەنگ</label>
            <input
                type="text"
                name="color"
                value="{{ old('color') }}"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('color')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Size -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">قەبارە</label>
            <input
                type="text"
                name="size"
                value="{{ old('size') }}"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('size')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <!-- Discount -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">داشكاندن</label>
            <input
                type="number"
                name="discount"
                value="{{ old('discount') }}"
                class="w-full px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
            >
            @error('discount')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Categories -->
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">هاوپۆلەکان</label>

            <select
                name="category_id[]"
                multiple
                class="w-full h-40 px-3 py-2 text-right border rounded-lg shadow-sm bg-gray-50 focus:ring-2 focus:ring-indigo-500"
            >
                @foreach ($categories as $category)
                    <option {{ in_array($category->id, old('category_id', [])) ? 'selected' : '' }}
                        value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
            @error('category_id.*')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button
                type="submit"
                class="flex items-center justify-center w-full gap-2 py-3 text-sm font-semibold text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                <i class="fas fa-plus-circle"></i>
                دروستکردن
            </button>
        </div>

    </form>

</div>

<script src="https://kit.fontawesome.com/a2b3c7b42f.js" crossorigin="anonymous"></script>
@endcomponent
