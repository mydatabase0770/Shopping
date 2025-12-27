@extends('public.layout.publiclayout')

@section('content')

<div class="px-4 py-16 mx-auto max-w-7xl">

    <!-- PRODUCT SECTION -->
    <div class="grid gap-16 lg:grid-cols-2">

        <!-- IMAGE -->
        <div class="lg:sticky lg:top-24">
            <div class="overflow-hidden bg-white border shadow-2xl rounded-3xl">
                <img
                    src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->title }}"
                    class="object-cover w-full h-[520px] transition-transform duration-500 hover:scale-105"
                >
            </div>
        </div>

        <!-- INFO -->
        <div class="space-y-10">

            <!-- TITLE -->
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
                    {{ $post->title }}
                </h1>
                <p class="mt-4 text-lg leading-relaxed text-gray-600">
                    {{ $post->description }}
                </p>
            </div>

            <!-- PRICE -->
            <div class="flex items-center gap-4">
                <span class="text-4xl font-bold text-green-600">
                    ${{ number_format($post->price, 2) }}
                </span>
                <span class="px-4 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                    بەردەستە
                </span>
            </div>

            <!-- ATTRIBUTES -->
            <div class="flex flex-wrap gap-4">
                <span class="px-5 py-2 text-sm font-semibold bg-gray-100 rounded-xl">
                    🎨 ڕەنگ: {{ $post->color }}
                </span>
                <span class="px-5 py-2 text-sm font-semibold bg-gray-100 rounded-xl">
                    📏 قەبارە: {{ $post->size }}
                </span>
            </div>

            <!-- CATEGORIES -->
            @if($post->categories->count())
                <div class="flex flex-wrap gap-3">
                    @foreach ($post->categories as $category)
                        <span class="px-4 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- ACTIONS -->
@auth
<div class="flex gap-4 pt-6">

    <!-- FAVORITE -->
    <form action="{{ route('addToFavCart', ['post' => $post->id]) }}" method="POST">
        @csrf
        <button
            class="flex items-center gap-2 px-6 py-3 font-semibold text-white transition bg-red-500 rounded-xl hover:bg-red-600"
        >
            <i class="fa-solid fa-heart"></i>
            زیادکردن بۆ دڵخوازەکان
        </button>
    </form>

    <!-- CART -->
    <form action="{{ route('addToCart', ['post' => $post->id]) }}" method="POST">
        @csrf
        <button
            class="flex items-center gap-2 px-6 py-3 font-semibold text-white transition bg-black rounded-xl hover:bg-gray-800"
        >
            <i class="fa-solid fa-cart-shopping"></i>
            زیادکردن بۆ سەبەتە
        </button>
    </form>

</div>
@endauth

        </div>
    </div>

    <!-- DIVIDER -->
    <div class="my-20 border-t"></div>

    <!-- COMMENTS -->
    <div class="max-w-4xl mx-auto">

        <h2 class="mb-10 text-3xl font-extrabold text-gray-900">
            هەڵسەنگاندنەکانی کڕیاران
        </h2>

        <!-- ADD COMMENT -->
        @auth
        <form
            action="{{ route('comments.store', $post->id) }}"
            method="POST"
            class="p-6 mb-12 bg-white border shadow-xl rounded-2xl"
        >
            @csrf

            <textarea
                name="comment"
                rows="4"
                required
                class="w-full p-4 text-sm border rounded-xl focus:ring-2 focus:ring-black/20"
                placeholder="سەرنج و بۆچوونی خۆت لەسەر ئەم کاڵایە بنووسە..."
            ></textarea>

            <div class="flex justify-end">
                <button
                    class="px-6 py-3 mt-4 font-semibold text-white transition bg-black rounded-xl hover:bg-gray-800"
                >
                    ناردنی هەڵسەنگاندن
                </button>
            </div>
        </form>
        @endauth

        <!-- COMMENTS LIST -->
        <div class="space-y-6">

            @forelse ($post->comments as $comment)
                <div class="p-6 bg-white border shadow rounded-2xl">

                    <div class="flex items-center gap-4 mb-3">

                        <!-- AVATAR -->
                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-black rounded-full">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $comment->user->name }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>
                        </div>

                    </div>

                    <p class="leading-relaxed text-gray-700">
                        {{ $comment->comment }}
                    </p>

                </div>
            @empty
                <p class="py-10 text-center text-gray-500">
                    هێشتا هیچ هەڵسەنگاندنێک نیە. تۆ یەکەم کەس بە 😊
                </p>
            @endforelse

        </div>
    </div>

</div>

@endsection
