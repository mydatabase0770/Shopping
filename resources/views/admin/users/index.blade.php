@component('admin.layout.adminlayout')
<div dir="rtl" class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- سەرپەڕ -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">👥 بەکارهێنەران</h1>
            <a href="{{ route('users.create') }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>زیادکردنی بەکارهێنەر</span>
            </a>
        </div>

        <!-- گەڕان -->
        <div class="mb-6">
            <form method="GET" action="{{ route('users.index') }}" class="flex items-center">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="گەڕان بەناوی بەکارهێنەر، ئیمەیڵ، یان ژمارە..."
                    class="flex-1 rounded-l-none rounded-r-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-right px-4 py-2"
                />
                <button
                    type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white rounded-l-lg hover:bg-indigo-700 transition">
                    گەڕان
                </button>
            </form>
        </div>

        <!-- خشتەی بەکارهێنەران -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">#</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">ناو</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">ئیمەیڵ</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">ڕۆڵ</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">ژمارەی مۆبایل</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">ناونیشان</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold uppercase">دڵنیاکراوە</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">کردارەکان</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->role === 'admin')
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">بەڕێوەبەر</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">بەکارهێنەر</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $user->phone_number ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $user->address ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($user->email_verified_at)
                                <span class="px-2 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full">دڵنیاکراوە</span>
                            @else
                                <span class="px-2 py-1 bg-red-50 text-red-600 text-xs font-semibold rounded-full">نەدڵنیاکراوە</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-left flex justify-end gap-3">

                            <!-- View -->
                            <a href="{{ route('users.show', $user->id) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center gap-1">
                                👁 <span>بینین</span>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="text-yellow-600 hover:text-yellow-800 font-medium text-sm flex items-center gap-1">
                                ✏️ <span>دەستکاری</span>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="button"
                                    onclick="delete-btn"
                                    class="text-red-600 hover:text-red-800 font-medium text-sm flex items-center gap-1 delete-btn">
                                    🗑️ <span>سڕینەوە</span>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-lg">
                            هیچ بەکارهێنەرێک نەدۆزرایەوە 😕
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $users->links('pagination::tailwind') }}
        </div>

    </div>
</div>

@endcomponent


<script>
window.addEventListener('load', function() {
    // Initialize delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            e.preventDefault();
            const button = e.target.closest('.delete-btn');
            const form = button.closest('form');

            window.Swal.fire({
                title: 'دڵنیای لە سڕینەوەی ئەم بەکارهێنەرە؟',
                text: "ناتوانیت ئەم کارە بگەڕێنیتەوە!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'بەڵێ، بسڕەوە!',
                cancelButtonText: 'نەخێر، هەڵیبەرە سەرەوە',
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



