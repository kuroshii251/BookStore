@extends('layouts.navbar')

@section('contents')

<style>
    *{
        box-sizing: border-box;
    }

    body{
        overflow-x: hidden;
    }
</style>

<div class="min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">

        {{-- BREADCRUMB --}}
        <div class="flex items-center gap-2 text-sm text-[#8b7e72] mb-8">

            <a href="{{ url('/dashboard') }}"
               class="hover:text-black transition">
                Beranda
            </a>

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"/>
            </svg>

            <span class="font-semibold text-[#1a1714]">
                Keranjang
            </span>
        </div>

        {{-- TITLE --}}
        <div class="mb-8">

            <h1 class="text-3xl lg:text-5xl font-bold text-[#1a1714]"
                style="font-family:'Lora', serif;">

                Keranjang Belanja
            </h1>

            @if($carts->count() > 0)
                <p class="text-[#7d7062] mt-2 text-sm lg:text-base">
                    {{ $carts->count() }} item dalam keranjang
                </p>
            @endif

        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200
                        text-green-700 px-5 py-4 rounded-2xl mb-8">

                {{ session('success') }}
            </div>
        @endif

        @if($carts->count() > 0)

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            {{-- LEFT SIDE --}}
            <div class="flex-1 w-full">

                <div class="space-y-5">

                    @foreach($carts as $cart)

                    <div class="bg-white rounded-3xl border border-[#ece6df]
                                p-5 lg:p-6 shadow-sm hover:shadow-md
                                transition duration-300">

                        <div class="flex flex-col sm:flex-row gap-5">

                            {{-- IMAGE --}}
                            <div class="w-full sm:w-28 shrink-0">

                                <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-[#f4efe9]">

                                    <img
                                        src="{{ asset('uploads/image/product_picture/' . $cart->product->product_picture) }}"
                                        alt="{{ $cart->product->product_name }}"
                                        class="w-full h-full object-cover"
                                    >

                                </div>

                            </div>

                            {{-- CONTENT --}}
                            <div class="flex-1 min-w-0">

                                {{-- CATEGORY --}}
                                <span class="inline-flex items-center
                                             px-3 py-1 rounded-full
                                             bg-[#f5f0ea]
                                             text-[#8b7e72]
                                             text-[11px]
                                             font-semibold
                                             uppercase tracking-wider">

                                    {{ $cart->product->category }}
                                </span>

                                {{-- PRODUCT NAME --}}
                                <h2 class="text-xl font-bold text-[#1a1714]
                                           mt-3 leading-snug"
                                    style="font-family:'Lora', serif;">

                                    {{ $cart->product->product_name }}
                                </h2>

                                {{-- PRICE --}}
                                <div class="flex flex-wrap items-center gap-2
                                            mt-3 text-sm text-[#7c6f61]">

                                    <span>
                                        Rp {{ number_format($cart->price, 0, ',', '.') }}
                                    </span>

                                    <span>•</span>

                                    <span class="font-medium">
                                        Qty {{ $cart->quantity }}
                                    </span>

                                </div>

                                {{-- BOTTOM --}}
                                <div class="flex items-end justify-between
                                            mt-6 gap-4 flex-wrap">

                                    {{-- DELETE --}}
                                    <form action="{{ URL('/dashboard/cart/' . $cart->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Hapus item ini?')"
                                            class="text-sm text-[#8b7e72]
                                                   hover:text-red-500
                                                   transition">

                                            Hapus
                                        </button>

                                    </form>

                                    {{-- SUBTOTAL --}}
                                    <div class="text-right">

                                        <p class="text-xs text-[#9b8f82] mb-1">
                                            Subtotal
                                        </p>

                                        <p class="text-xl lg:text-2xl
                                                  font-bold text-[#1a1714]"
                                           style="font-family:'Lora', serif;">

                                            Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                {{-- CONTINUE SHOPPING --}}
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center gap-2
                          mt-6 text-[#6f6255]
                          hover:text-black transition font-medium">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                    Lanjut Belanja

                </a>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="w-full lg:w-[380px] shrink-0">

                <div class="bg-white rounded-3xl
                            border border-[#ece6df]
                            shadow-sm overflow-hidden">

                    {{-- HEADER --}}
                    <div class="px-6 py-5 border-b border-[#f1ece6]">

                        <h2 class="text-xl font-bold text-[#1a1714]"
                            style="font-family:'Lora', serif;">

                            Ringkasan Pesanan
                        </h2>

                    </div>

                    {{-- BODY --}}
                    <div class="p-6">

                        <div class="space-y-4">

                            <div class="flex justify-between text-sm text-[#7d7062]">

                                <span>Total Item</span>

                                <span class="font-medium">
                                    {{ $carts->count() }}
                                </span>

                            </div>

                            <div class="flex justify-between text-sm text-[#7d7062]">

                                <span>Subtotal</span>

                                <span class="font-medium">
                                    Rp {{ number_format($carts->sum('subtotal'), 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="flex justify-between text-sm text-[#7d7062]">

                                <span>Pengiriman</span>

                                <span class="font-semibold text-green-600">
                                    Gratis
                                </span>

                            </div>

                        </div>

                        {{-- TOTAL --}}
                        <div class="border-t border-dashed border-[#e7dfd6]
                                    mt-6 pt-6">

                            <div class="flex items-end justify-between gap-4">

                                <div>

                                    <p class="text-sm text-[#8c7f72]">
                                        Total Pembayaran
                                    </p>

                                    <h3 class="text-3xl font-bold
                                               text-[#1a1714]
                                               break-words"
                                        style="font-family:'Lora', serif;">

                                        Rp {{ number_format($carts->sum('subtotal'), 0, ',', '.') }}
                                    </h3>

                                </div>

                            </div>

                        </div>

                        {{-- CHECKOUT --}}
                        <a href="{{ url('/dashboard/checkout') }}"
                           class="w-full flex items-center justify-center
                                  mt-6 bg-[#1a1714]
                                  hover:bg-[#2d2721]
                                  text-white font-semibold
                                  rounded-2xl py-4
                                  min-h-[56px]
                                  transition duration-300">

                            Checkout Sekarang

                        </a>

                        {{-- SECURITY --}}
                        <div class="mt-5 bg-[#faf7f3]
                                    rounded-2xl p-4 text-center">

                            <p class="text-xs text-[#8a7d70]
                                      leading-relaxed">

                                🔒 Transaksi aman dan terenkripsi

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @else

        {{-- EMPTY --}}
        <div class="flex flex-col items-center
                    justify-center py-24 text-center">

            <div class="w-28 h-28 rounded-full
                        bg-white border border-[#ece6df]
                        shadow-sm flex items-center
                        justify-center mb-8">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-[#aa9b8b]"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                </svg>

            </div>

            <h2 class="text-3xl font-bold text-[#1a1714]
                       mb-3"
                style="font-family:'Lora', serif;">

                Keranjang Masih Kosong

            </h2>

            <p class="text-[#7d7062] max-w-md leading-relaxed mb-8">

                Belum ada produk di keranjang kamu.
                Yuk mulai belanja sekarang.

            </p>

            <a href="{{ url('/dashboard') }}"
               class="bg-[#1a1714]
                      hover:bg-[#2d2721]
                      text-white font-semibold
                      px-8 py-4 rounded-2xl
                      transition duration-300">

                Jelajahi Produk

            </a>

        </div>

        @endif

    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

@endsection
