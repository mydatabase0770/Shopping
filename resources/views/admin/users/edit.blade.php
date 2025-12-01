@component('admin.layout.adminlayout')
<div dir="rtl" class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-l from-yellow-500 to-yellow-400 px-6 py-6 flex justify-between items-center text-white">
            <div>
                <h2 class="text-2xl font-bold">دەستکارییەکانی بەکارهێنەر</h2>
                <p class="text-yellow-100 text-sm mt-1">زانیارییەکانی ئەم بەکارهێنەرە نوێ بکەوە</p>
            </div>
            <div class="bg-white text-yellow-500 w-14 h-14 flex items-center justify-center rounded-full shadow-lg font-bold text-xl">
                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 text-right mb-1">ناو</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                           placeholder="ناوی بەکارهێنەر..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 text-right mb-1">ئیمەیڵ</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                           placeholder="ئیمەیڵ..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 text-right mb-1">ژمارەی مۆبایل</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                           placeholder="ژمارەی مۆبایل..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 text-right mb-1">ناونیشان</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                           placeholder="ناونیشان..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 text-right mb-1">ڕۆڵ</label>
                    <select id="role" name="role"
                            class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>بەکارهێنەر</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>بەڕێوەبەر</option>
                    </select>
                </div>

                {{-- Email Verification --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 text-right mb-1">دڵنیاکراوی ئیمەیڵ</label>
                    @if ($user->email_verified_at)
                        <div class="px-3 py-2 bg-green-50 text-green-700 text-sm font-semibold rounded-lg text-center">
                            دڵنیاکراوە ✅
                        </div>
                    @else
                        <div class="px-3 py-2 bg-red-50 text-red-600 text-sm font-semibold rounded-lg text-center">
                            نەدڵنیاکراوە ❌
                        </div>
                    @endif
                </div>

            </div>

            <!-- Password Section -->
            <div class="border-t border-gray-200 pt-6 mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 text-right mb-1">تێپەڕەوشەی نوێ (ئارەزوومەندانە)</label>
                    <input type="password" id="password" name="password"
                           placeholder="تێپەڕەوشەی نوێ بنوسە..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 text-right mb-1">دووبارە تێپەڕەوشە بنوسە</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="دووبارە تێپەڕەوشە بنوسە..."
                           class="w-full border rounded-lg px-3 py-2 text-right focus:ring-2 focus:ring-yellow-500 focus:outline-none bg-gray-50">
                </div>

            </div>

            {{-- Buttons --}}
            <div class="pt-6 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-100 mt-4">
                <button type="submit"
                        class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition flex items-center gap-1">
                    💾 <span>پاشەکەوتکردن</span>
                </button>

                <a href="{{ route('users.show', $user->id) }}"
                   class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow transition flex items-center gap-1">
                    ↩️ <span>گەڕانەوە بۆ زانیاری بەکارهێنەر</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endcomponent
