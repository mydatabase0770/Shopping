@extends('public.layout.publiclayout')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 shadow-md rounded-lg">

    <h1 class="text-2xl font-bold text-center text-gray-900 mb-3">
        جل و بەرگ 🛒
    </h1>
    <p class="text-center text-gray-600 mb-6">
        تۆمارکردن بۆ کڕین و فرۆشتن
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('ئیمەیل')" />
            <x-text-input id="email"
                          type="email"
                          name="email"
                          class="mt-1 block w-full"
                          :value="old('email')"
                          required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('وشەی نهێنی')" />
            <x-text-input id="password"
                          type="password"
                          name="password"
                          class="mt-1 block w-full"
                          required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember -->
        <label class="flex items-center gap-2 cursor-pointer">
            <input id="remember_me" type="checkbox"
                   class="rounded border-gray-300 text-green-600 focus:ring-green-600"
                   name="remember">
            <span class="text-sm text-gray-700">بیر لە بیرم ببە</span>
        </label>

        <div class="flex justify-between items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-gray-600 hover:text-gray-900 underline">
                    وشەت لەبیرچووە؟
                </a>
            @endif

            <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md">
                بچوونەژوورەوە
            </button>
        </div>

    </form>

    <!-- Register -->
    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-gray-600">
            ئەژمار نییە؟
            <a href="{{ route('register') }}" class="text-green-600 hover:underline font-semibold">
                تۆمارکردن
            </a>
        </p>
    @endif

</div>

@endsection
