@extends('public.layout.publiclayout')

@section('content')
<div class="max-w-3xl px-4 mx-auto mt-10" dir="rtl">
    <div class="p-8 bg-white shadow-lg rounded-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-800">
                پرۆفایلی من
            </h2>

            <a href="{{ route('userprofile.edit', Auth::id()) }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                گۆڕینی پرۆفایل
            </a>
        </div>

        <!-- Profile Info -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <div>
                <p class="text-sm text-gray-500">ناوی تەواو</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">ئیمەیڵ</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ auth()->user()->email }}
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">ناونیشان</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ auth()->user()->address ?? '—' }}
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
