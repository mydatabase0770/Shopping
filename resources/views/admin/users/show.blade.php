@component('admin.layout.adminlayout')
<div dir="rtl" class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-l from-indigo-600 to-blue-500 px-6 py-6 flex justify-between items-center text-white">
            <div>
                <h2 class="text-2xl font-bold">زانیاری بەکارهێنەر</h2>
                <p class="text-indigo-100 text-sm mt-1">وردەکارییەکانی ئەم بەکارهێنەرە ببینە</p>
            </div>
            <div class="bg-white text-indigo-600 w-14 h-14 flex items-center justify-center rounded-full shadow-lg font-bold text-xl">
                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
        </div>

        <!-- User Info -->
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">ناو</span>
                    <span class="font-semibold text-gray-800 text-lg">{{ $user->name }}</span>
                </div>

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">ئیمەیڵ</span>
                    <span class="font-semibold text-gray-800 text-lg">{{ $user->email }}</span>
                </div>

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">ژمارەی مۆبایل</span>
                    <span class="font-semibold text-gray-800 text-lg">{{ $user->phone ?? 'نییە' }}</span>
                </div>

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">ناونیشان</span>
                    <span class="font-semibold text-gray-800 text-lg">{{ $user->address ?? 'نییە' }}</span>
                </div>

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">ڕۆڵ</span>
                    @if ($user->role === 'admin')
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full w-fit self-end">بەڕێوەبەر</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-semibold rounded-full w-fit self-end">بەکارهێنەر</span>
                    @endif
                </div>

                <div class="flex flex-col text-right">
                    <span class="text-gray-500 text-sm mb-1">دڵنیاکراوی ئیمەیڵ</span>
                    @if ($user->email_verified_at)
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-sm font-semibold rounded-full w-fit self-end">دڵنیاکراوە ✅</span>
                    @else
                        <span class="px-3 py-1 bg-red-50 text-red-600 text-sm font-semibold rounded-full w-fit self-end">نەدڵنیاکراوە ❌</span>
                    @endif
                </div>

            </div>
        </div>

        <!-- Actions -->
        <div class="border-t border-gray-200 bg-gray-50 px-8 py-5 flex flex-col sm:flex-row justify-between items-center gap-4">

            <!-- Left side -->
            <div class="flex gap-3">
                <a href="{{ route('users.edit', $user->id) }}"
                   class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow transition flex items-center gap-1">
                    ✏️ <span>دەستکاری</span>
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('دڵنیای لە سڕینەوەی ئەم بەکارهێنەرە؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition flex items-center gap-1">
                        🗑️ <span>سڕینەوە</span>
                    </button>
                </form>
            </div>

            <!-- Back -->
            <a href="{{ route('users.index') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition flex items-center gap-1">
                ↩️ <span>گەڕانەوە بۆ لیستی بەکارهێنەران</span>
            </a>
        </div>
    </div>
</div>
@endcomponent
