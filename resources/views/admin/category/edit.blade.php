@component('admin.layout.adminlayout')
<div dir="rtl" class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-l from-yellow-500 to-yellow-400 px-6 py-6 flex justify-between items-center text-white">
            <div>
                <h2 class="text-2xl font-bold">دەستکارییەکانی بەش</h2>
                <p class="text-yellow-100 text-sm mt-1">زانیارییەکانی ئەم بەشە نوێ بکەوە</p>
            </div>

            <div class="bg-white text-yellow-500 w-14 h-14 flex items-center justify-center rounded-full shadow-lg font-bold text-xl">
                {{ strtoupper(mb_substr($category->name, 0, 1)) }}
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('categories.update', $category->id) }}"
              method="POST"
              class="p-8 space-y-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Name --}}
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 text-right mb-1">
                        بەش
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $category->name) }}"
                           placeholder="بەش بنوسە..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

            </div>

            {{-- Buttons --}}
            <div class="pt-6 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-100">

                <a href="{{ route('categories.index') }}"
                   class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg shadow transition">
                    🔙 گەڕانەوە
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition flex items-center gap-1">
                    💾 <span>پاشەکەوتکردن</span>
                </button>

            </div>

        </form>

    </div>
</div>
@endcomponent
