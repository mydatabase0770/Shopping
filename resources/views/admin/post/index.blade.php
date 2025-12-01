@component('admin.layout.adminlayout')

<div dir="rtl" class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">لیستی پۆستەکان</h1>
                    <p class="text-gray-600">بەڕێوەبردن و دەستکاریکردنی هەموو پۆستەکان</p>
                </div>

                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-indigo-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    زیادکردنی پۆست
                </a>
            </div>
        </div>

        <!-- Search and Filter Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
            <form method="GET" action="{{ route('posts.index') }}">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="گەڕان بەپێی ناونیشان، نرخ، ڕەنگ یان قەبارە..."
                            class="w-full pr-10 pl-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-right"
                        >
                    </div>

                    <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                        گەڕان
                    </button>

                    @if(request('search'))
                    <a href="{{ route('posts.index') }}"
                       class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200">
                        پاککردنەوە
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Posts Grid/Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">#</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">وێنە</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">ناونیشان</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">نرخ</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">ڕەنگ</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">قەبارە</th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">چالاکی</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-4 px-6 text-sm text-gray-900 font-medium">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-4 px-6">
                                @if($post->image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $post->image) }}"
                                             class="h-16 w-16 rounded-xl object-cover border-2 border-gray-200 shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-xl transition-all duration-200"></div>
                                    </div>
                                @else
                                    <div class="h-16 w-16 rounded-xl bg-gray-100 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <div class="text-sm font-semibold text-gray-900">{{ $post->title }}</div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-green-50 text-green-700 text-sm font-semibold">
                                    {{ $post->price }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-sm">
                                    {{ $post->color }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-purple-50 text-purple-700 text-sm">
                                    {{ $post->size }}
                                </span>
                            </td>

                             <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-purple-50 text-purple-700 text-sm">
                                    {{ $post->categories_count }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200"
                                       title="دەستکاری">
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        دەستکاری
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                          onsubmit="return confirm('دڵنیای لە سڕینەوەی ئەم پۆستە؟');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="delete-btn inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200"
                                                title="سڕینەوە">
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            سڕینەوە
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-900 mb-1">هیچ پۆستێک نەدۆزرایەوە</p>
                                    <p class="text-gray-500">تکایە پۆستی نوێ زیاد بکە یان گەڕانەکەت بگۆڕە</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden divide-y divide-gray-200">
                @forelse ($posts as $post)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex gap-4">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="h-24 w-24 rounded-xl object-cover border-2 border-gray-200 shadow-sm flex-shrink-0">
                        @else
                            <div class="h-24 w-24 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 truncate">{{ $post->title }}</h3>

                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-semibold">
                                    {{ $post->price }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs">
                                    {{ $post->color }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs">
                                    {{ $post->size }}
                                </span>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition-colors">
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    دەستکاری
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                      onsubmit="return confirm('دڵنیای لە سڕینەوە؟');"
                                      class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full delete-btn inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        سڕینەوە
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-900 mb-1">هیچ پۆستێک نەدۆزرایەوە</p>
                        <p class="text-gray-500 text-sm">تکایە پۆستی نوێ زیاد بکە یان گەڕانەکەت بگۆڕە</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links('pagination::tailwind') }}
        </div>
        @endif

    </div>
</div>

@endcomponent

<script>
window.addEventListener('load', function() {
    document.addEventListener('click', function(e) {
        const deleteButton = e.target.closest('.delete-btn');

        if (deleteButton) {
            e.preventDefault();
            const form = deleteButton.closest('form');

            Swal.fire({
                title: 'دڵنیای لە سڕینەوەی ئەم بەشە؟',
                text: "دووبارە ناتوانرێت بگەڕێنرێتەوە!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'بەڵێ، بسڕەوە!',
                cancelButtonText: 'نەخێر',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
