@component('admin.layout.adminlayout')

<div dir="rtl" class="min-h-screen px-4 py-8">
    <div class="mx-auto max-w-7xl">

        <!-- Header -->
        <div class="flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold">📊 لیستی فرۆشتن</h1>
                <p class="text-gray-600">بەڕێوەبردنی داواکاری و فرۆشتنەکان</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden bg-white shadow rounded-2xl">
            <table class="w-full text-right">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">کڕیار</th>
                        <th class="p-4">موبایل</th>
                        <th class="p-4">ناونیشان</th>
                        <th class="p-4">کاڵا</th>
                        <th class="p-4">دۆخ</th>
                        <th class="p-4 text-center">بەروار</th>
                        <th class="p-4 text-center">کردار</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($transactions as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">{{ $loop->iteration }}</td>

                            <td class="p-4 font-semibold">{{ $row->user->name }}</td>

                            <td class="p-4 text-green-600">{{ $row->user->phone_number }}</td>

                            <td class="p-4">{{ $row->user->address }}</td>

                            <td class="p-4">
                                <a href="{{ route('posts.edit',$row->post_id) }}"
                                   class="text-indigo-600 hover:underline">
                                    بینینی کاڵا
                                </a>
                            </td>

                            <!-- Status -->
                            <td class="p-4">
                                <form method="POST"
                                      action="{{ route('transaction.update',$row->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <button
                                        class="px-3 py-1 rounded-lg text-sm font-semibold
                                        {{ $row->state
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700' }}">
                                        {{ $row->state ? 'تەواوبوو' : 'چاوەڕوان' }}
                                    </button>
                                </form>
                            </td>

                            <td class="p-4 text-sm text-center text-gray-500">
                                {{ $row->created_at->diffForHumans() }}
                            </td>

                            <!-- Delete -->
                            <td class="p-4 text-center">
                                <form method="POST"
                                      action="{{ route('transaction.destroy',$row->id) }}"
                                      class="inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 delete-btn hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-10 text-center text-gray-400">
                                هیچ فرۆشتنێک نیە
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $transactions->links('pagination::tailwind') }}
        </div>

    </div>
</div>

@endcomponent

<script>
document.addEventListener('click', function (e) {
    if (e.target.closest('.delete-btn')) {
        e.preventDefault();
        const form = e.target.closest('form');

        Swal.fire({
            title: 'دڵنیایت؟',
            text: 'ئەم فرۆشتنە سڕدەکرێتەوە',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بەڵێ',
            cancelButtonText: 'نەخێر',
            confirmButtonColor: '#dc2626'
        }).then(result => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
});
</script>
