@extends('public.layout.publiclayout')

@section('content')

<div class="relative flex justify-center items-center min-h-screen py-4">

    <!-- Register Card -->
    <div class="relative z-10 w-full max-w-md bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl
                rounded-2xl shadow-xl p-8 space-y-6">

        <!-- Logo / Title -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">جل و بەرگ 🛒</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-1">تۆمارکردن بۆ کڕین و فرۆشتن</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" class="mb-4" />

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf


            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('ناو')" />
                <x-text-input id="name" name="name" type="text"
                    :value="old('name')" required autofocus class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('ئیمەیل')" />
                <x-text-input id="email" name="email" type="email"
                    :value="old('email')" required autocomplete="username"
                    class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-input-label for="phone_number" :value="__('ژمارەی مۆبایل')" />
                <x-text-input id="phone_number" name="phone_number" type="text"
                    :value="old('phone_number')" class="block w-full mt-1"
                    placeholder="07xx xxx xxx" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('ناونیشان')" />
                <x-text-input id="address" name="address" type="text"
                    :value="old('address')" class="block w-full mt-1"
                    placeholder="سلێمانی - زانکۆی پەروەردە" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Role (optional: hidden or selectable) -->
            {{-- <div>
                <x-input-label for="role" :value="__('جۆری بەکارهێنەر')" />
                <select id="role" name="role"
                        class="block w-full mt-1 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                               bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-green-500">
                    <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>بەکارهێنەر</option>
                    <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>ڵێکۆڵەر / ئادمین</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div> --}}

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('وشەی نهێنی')" />
                <x-text-input id="password" name="password" type="password"
                    required autocomplete="new-password" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('دووبارە وشەی نهێنی')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                    required autocomplete="new-password" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 underline">
                    ئەژمار هەیە؟
                </a>

                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                    تۆمارکردن
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
