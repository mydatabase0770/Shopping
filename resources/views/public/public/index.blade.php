@extends('public.layout.publiclayout')

@section('content')

<section class="col-span-12 lg:col-span-6">

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

        @foreach ($posts as $post)

            @php
                $hasDiscount = $post->discount && $post->discount > 0;
                $finalPrice = $hasDiscount
                    ? $post->price - ($post->price * $post->discount / 100)
                    : $post->price;
            @endphp

            <div class="relative overflow-hidden transition bg-white shadow-md group rounded-2xl hover:shadow-2xl">

                {{-- DISCOUNT BADGE --}}
                @if($hasDiscount)
                    <span class="absolute z-20 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full top-3 left-3">
                        -{{ $post->discount }}%
                    </span>
                @endif

                {{-- IMAGE --}}
                <a href="{{ route('detialpost', $post->id) }}">
                    <img
                        src="{{ asset('storage/' . $post->image) }}"
                        class="object-cover w-full transition h-72 group-hover:scale-105"
                        alt="{{ $post->title }}"
                    >
                </a>

                {{-- ACTION BUTTONS --}}
                @auth
                <div class="absolute z-20 flex gap-2 top-3 right-3">

                    {{-- FAVORITE --}}
                    <form action="{{ route('addToFavCart', $post->id) }}" method="POST">
                        @csrf
                        <button
                            class="flex items-center justify-center w-10 h-10 transition rounded-full shadow bg-white/80 hover:bg-red-100">
                            <i class="text-xl
                                {{ ($favorites ?? collect())->pluck('post_id')->contains($post->id)
                                    ? 'fa-solid fa-heart text-red-600'
                                    : 'fa-regular fa-heart text-gray-400' }}">
                            </i>
                        </button>
                    </form>

                    {{-- CART --}}
                    @if(($cartItems ?? collect())->pluck('post_id')->contains($post->id))
                        <button
                            disabled
                            class="flex items-center justify-center w-10 h-10 text-green-600 bg-green-100 rounded-full shadow cursor-not-allowed">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    @else
                        <form action="{{ route('addToCart', $post->id) }}" method="POST">
                            @csrf
                            <button
                                class="flex items-center justify-center w-10 h-10 transition rounded-full shadow bg-white/80 hover:bg-green-100">
                                <i class="text-green-600 fa-solid fa-cart-plus"></i>
                            </button>
                        </form>
                    @endif

                </div>
                @endauth

                {{-- INFO --}}
                <div class="absolute bottom-0 w-full p-4 text-white bg-gradient-to-t from-black/80">

                    <a href="{{ route('detialpost', $post->id) }}">
                        <h3 class="mb-2 text-lg font-bold truncate">
                            {{ $post->title }}
                        </h3>
                    </a>

                    <div class="flex items-center gap-3">

                        {{-- FINAL PRICE --}}
                        <span class="px-4 py-1 text-sm font-bold bg-green-600 rounded-lg">
                            د.ع {{ number_format($finalPrice) }}
                        </span>

                        {{-- OLD PRICE --}}
                        @if($hasDiscount)
                            <span class="text-sm text-gray-300 line-through">
                                د.ع {{ number_format($post->price) }}
                            </span>
                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>

@endsection
