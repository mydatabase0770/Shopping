@component('admin.layout.adminlayout')
<div dir="rtl" class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Title Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">💕 بەشەکان</h1>
            <a href="{{ route('categories.create') }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>زیادکردنی بەش</span>
            </a>
        </div>

        <!-- Search -->
        <div class="mb-6">
            <form method="GET" action="{{ route('categories.index') }}" class="flex items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="گەڕان بەناوی بەش..."
                    class="flex-1 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-right px-4 py-2"
                />
                <button
                    type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    گەڕان
                </button>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">#</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">بەش</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold uppercase">کردارەکان</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-sm text-gray-600">{{ $category->id }}</td>

                        <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>

                        <td class="px-6 py-4 text-center">

                            <!-- Edit Button -->
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="text-yellow-600 hover:text-yellow-800 font-medium text-sm mx-2">
                                ✏️ دەستکاری
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="text-red-600 hover:text-red-800 font-medium text-sm delete-btn mx-2">
                                    🗑️ سڕینەوە
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 text-lg">
                            هیچ بەشێک نەدۆزرایەوە 😕
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $categories->links('pagination::tailwind') }}
        </div>

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
