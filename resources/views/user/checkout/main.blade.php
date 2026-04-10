@extends('layouts.navbar')

@section('contents')
<div class="container mx-auto p-6">
    <h1 class="text-3xl text-center font-bold mb-8">Checkout</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($carts->count() > 0)
        <!-- CART LIST -->
        <div class="rounded-lg p-6 mb-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-3 mb-6 bg-white shadow-lg">
                @foreach($carts as $cart)
                    <div class="flex items-center p-3 border rounded-lg">
                        <img src="{{ asset('uploads/image/product_picture/' . $cart->product->product_picture) }}"
                             alt="{{ $cart->product->product_name }}"
                             class="h-12 w-12 object-cover rounded mr-3">
                        <div>
                            <div class="font-medium">{{ $cart->product->product_name }}</div>
                            <div class="text-sm text-gray-500">
                                Rp {{ number_format($cart->price, 0, ',', '.') }} x {{ $cart->quantity }}
                            </div>
                            <div class="font-bold">
                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-right">
                <h3 class="text-xl font-bold">
                    Total: Rp {{ number_format($carts->sum('subtotal'), 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <!-- FORM -->
        <form action="{{ url('/dashboard/checkout') }}" method="POST" enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-lg p-8">
            @csrf

            <h2 class="text-2xl font-bold mb-6">Informasi Pengiriman</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="Alamat" value="{{ old('Alamat') }}" required
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="Jl. Contoh No. 123">
                    @error('Alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">
                        Nomor Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="08xxxxxxxxx">
                    @error('nomor_telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-6 mt-6">
                <label class="block text-gray-700 font-bold mb-2">
                    Nama Penerima <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_penerima" value="{{ old('nama_penerima') }}" required
                       class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                       placeholder="Nama Lengkap Penerima">
                @error('nama_penerima') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

           <div class="mb-8">
    <label class="block text-gray-700 font-bold mb-2">
        Metode Pembayaran <span class="text-red-500">*</span>
    </label>

    <div class="space-y-3">

        <!-- TRANSFER -->
<label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="upload_payment"
                {{ old('payment_method', 'upload_payment') == 'upload_payment' ? 'checked' : '' }}
                required class="mr-3 h-5 w-5 text-blue-600" id="upload_payment">

            <div>
                <div class="font-medium">Transfer Bank</div>
                <div class="text-sm text-gray-500">Upload bukti pembayaran</div>
            </div>
        </label>
        <div id="upload_field" class="mt-3 ml-8 {{ old('payment_method', 'upload_payment') == 'upload_payment' ? '' : 'hidden' }}">
            <label class="block text-gray-700 font-bold mb-2">Bukti Pembayaran <span class="text-red-500">*</span></label>
            <input type="file" name="foto_payment" accept="image/*" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500" >
            @error('foto_payment')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadRadio = document.getElementById('upload_payment');
            const uploadField = document.getElementById('upload_field');
            const codRadio = document.querySelector('input[value="cod"]');

            function toggleUploadField() {
                if (uploadRadio.checked) {
                    uploadField.classList.remove('hidden');
                    uploadField.querySelector('input[type="file"]').required = true;
                } else {
                    uploadField.classList.add('hidden');
                    uploadField.querySelector('input[type="file"]').required = false;
                }
            }

            uploadRadio.addEventListener('change', toggleUploadField);
            codRadio.addEventListener('change', toggleUploadField);
            toggleUploadField(); // Initial state
        });
        </script>

        <!-- COD -->
        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="cod"
                {{ old('payment_method') == 'cod' ? 'checked' : '' }}
                required class="mr-3 h-5 w-5 text-blue-600">

            <div>
                <div class="font-medium">Cash on Delivery (COD)</div>
                <div class="text-sm text-gray-500">Bayar di tempat saat barang diterima</div>
            </div>
        </label>

    </div>
</div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-4 px-8 rounded-lg font-bold text-lg">
                Konfirmasi Pesanan & Bayar Rp {{ number_format($carts->sum('subtotal'), 0, ',', '.') }}
            </button>
        </form>

    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🛒</div>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart.</p>
            <a href="{{ url('/dashboard') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection
