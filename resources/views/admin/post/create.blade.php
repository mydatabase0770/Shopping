@component('admin.layout.adminlayout')
<div dir="rtl" class="max-w-3xl mx-auto mt-10 bg-white/95 backdrop-blur-md shadow-xl rounded-2xl overflow-hidden border border-gray-100">

    <!-- Header -->
    <div class="bg-gradient-to-l from-indigo-600 to-blue-500 px-6 py-5 text-right">
        <h2 class="text-2xl font-bold text-white">دروستکردنی پۆستەکی نوێ</h2>
        <p class="text-indigo-100 text-sm mt-1">
            زانیارییەکانی پۆست بنووسە بۆ دروستکردنی پۆستێکی نوێ
        </p>
    </div>

    <!-- Form -->
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">ناونیشانی پۆست</label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">نرخ</label>
            <input
                type="number"
                name="price"
                value="{{ old('price') }}"
                step="0.01"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">دەربارە</label>
            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">وێنە</label>
            <input
                type="file"
                name="image"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('image')
                <p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">ڕەنگ</label>
            <input
                type="text"
                name="color"
                value="{{ old('color') }}"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('color')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Size -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">قەبارە</label>
            <input
                type="text"
                name="size"
                value="{{ old('size') }}"
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500"
                required
            >
            @error('size')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Categories -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">هاوپۆلەکان</label>

            <select
                name="category_id[]"
                multiple
                class="w-full border rounded-lg bg-gray-50 px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-500 h-40"
            >
                @foreach ($categories as $category)
                    <option {{ in_array($category->id, old('category_id', [])) ? 'selected' : '' }}
                        value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('category_id.*')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button
                type="submit"
                class="w-full flex justify-center items-center gap-2 py-3 text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
            >
                <i class="fas fa-plus-circle"></i>
                دروستکردن
            </button>
        </div>

    </form>

</div>

<script src="https://kit.fontawesome.com/a2b3c7b42f.js" crossorigin="anonymous"></script>
@endcomponent
