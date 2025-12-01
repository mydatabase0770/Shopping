@component('admin.layout.adminlayout')
<div dir="rtl" class="max-w-3xl mx-auto bg-white/95 backdrop-blur-md shadow-xl rounded-2xl overflow-hidden border border-gray-100">

    <!-- Header -->
    <div class="bg-gradient-to-l from-indigo-600 to-blue-500 px-6 py-5 text-right">
        <h2 class="text-2xl font-bold text-white">دروستکردنی بەکارهێنەرێکی نوێ</h2>
        <p class="text-indigo-100 text-sm mt-1">زانیاری بەکارهێنەر بنووسە بۆ دروستکردنی ئەکاونتی نوێ</p>
    </div>

    <!-- Form -->
    <form action="{{ route('users.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 text-right mb-1">ناو</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text" id="name" name="name" placeholder="ناوی بەکارهێنەر بنوسە..."
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700" required>
            </div>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 text-right mb-1">ئیمەیڵ</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" id="email" name="email" placeholder="ئیمەیڵ بنوسە..."
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700" required>
            </div>
        </div>

        <!-- Phone -->
        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700 text-right mb-1">ژمارەی مۆبایل</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-phone"></i>
                </span>
                <input type="tel" id="phone_number" name="phone_number" placeholder="...ژمارەی مۆبایل بنوسە"
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700">
            </div>
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 text-right mb-1">ناونیشان</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-map-marker-alt"></i>
                </span>
                <input type="text" id="address" name="address" placeholder="ناونیشان بنوسە..."
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700">
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 text-right mb-1">تێپەڕەوشە</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" placeholder="تێپەڕەوشە بنوسە..."
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700" required>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 text-right mb-1">دووبارە تێپەڕەوشە بنوسە</label>
            <div class="flex items-center border rounded-lg bg-gray-50 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500">
                <span class="px-3 text-indigo-500">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="دووبارە تێپەڕەوشە بنوسە..."
                       class="w-full bg-transparent border-none focus:outline-none px-2 py-2 text-right text-gray-700" required>
            </div>
        </div>

        <!-- Submit -->
        <div class="pt-6 text-right">
            <button type="submit"
                    class="w-full flex justify-center items-center gap-2 py-3 px-4 text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                <i class="fas fa-plus-circle text-white"></i>
                دروستکردن
            </button>
        </div>
    </form>
</div>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a2b3c7b42f.js" crossorigin="anonymous"></script>
@endcomponent
