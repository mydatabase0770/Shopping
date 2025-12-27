@extends('public.layout.publiclayout')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-10" dir="rtl">

    {{-- PROFILE --}}
    <div class="p-8 bg-white shadow-xl rounded-2xl">
        <h2 class="mb-6 text-2xl font-bold">پرۆفایلی من</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm text-gray-500">ناوی تەواو</p>
                <p class="text-lg font-semibold">{{ auth()->user()->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">ئیمەیڵ</p>
                <p class="text-lg font-semibold">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

    {{-- CART --}}
    <div class="p-8 bg-white shadow-xl rounded-2xl">
        <h3 class="mb-6 text-xl font-bold">سەبەتەی کڕین</h3>

        @php $total = 0; @endphp

        @if($cartsList->count())
            <div class="overflow-x-auto">
                <table class="w-full border rounded-xl">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">وێنە</th>
                            <th class="p-3">کاڵا</th>
                            <th class="p-3">نرخ</th>
                            <th class="p-3 text-center">سڕینەوە</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($cartsList as $item)
                            @php $total += $item->post->price; @endphp
                            <tr>
                                <td class="p-3">
                                    <img src="{{ asset('storage/'.$item->post->image) }}"
                                         class="w-16 h-16 rounded-xl">
                                </td>

                                <td class="p-3">{{ $item->post->title }}</td>

                                <td class="p-3 font-bold text-green-600">
                                    ${{ number_format($item->post->price, 2) }}
                                </td>

                                <td class="p-3 text-center">
                                    {{-- REMOVE FORM (جیاواز) --}}
                                    <form action="{{ route('cart.remove', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('دڵنیایت؟')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="px-3 py-2 text-red-600 bg-red-100 rounded-lg">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- BUY FORM --}}
            <form action="{{ route('transactionStore') }}" method="POST" class="mt-6">
                @csrf

                <div class="flex items-center justify-between">
                    <div class="text-lg font-bold">
                        کۆی گشتی:
                        <span class="text-green-600">
                            ${{ number_format($total, 2) }}
                        </span>
                    </div>

                    <button type="submit"
                            class="px-8 py-3 text-white bg-green-600 rounded-xl">
                        کڕین
                    </button>
                </div>
            </form>

        @else
            <div class="py-12 text-center text-gray-500">
                سەبەتەکەت بەتاڵە
            </div>
        @endif
    </div>
</div>
@endsection
