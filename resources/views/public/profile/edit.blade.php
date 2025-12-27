@extends('public.layout.publiclayout')

@section('content')
<div class="max-w-2xl px-4 mx-auto mt-10" dir="rtl">
    <div class="p-8 bg-white shadow-lg rounded-2xl">

        <h2 class="mb-6 text-2xl font-bold text-right text-gray-800">
            گۆڕینی زانیارییەکان
        </h2>

        <form action="{{ route('userprofile.update', Auth::id()) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- ناوی تەواو -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">
                    ناوی تەواو
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', auth()->user()->name) }}"
                       class="w-full text-right border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- ئیمەیڵ -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">
                    ئیمەیڵ
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email', auth()->user()->email) }}"
                       class="w-full text-right border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- ناونیشان -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">
                    ناونیشان
                </label>
                <input type="text"
                       name="address"
                       value="{{ old('address', auth()->user()->address) }}"
                       class="w-full text-right border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- وشەی نهێنی -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">
                    وشەی نهێنی نوێ
                </label>
                <input type="password"
                       name="password"
                       placeholder="بەتاڵ بهێڵە ئەگەر ناتەوێت بگۆڕیت"
                       class="w-full text-right border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- پشتڕاستکردنەوەی وشەی نهێنی -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">
                    پشتڕاستکردنەوەی وشەی نهێنی
                </label>
                <input type="password"
                       name="password_confirmation"
                       class="w-full text-right border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- دوگمە -->
            <div class="flex justify-start">
                <button type="submit"
                        class="px-6 py-2 font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                    پاشەکەوتکردن
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

