@extends('layouts.navbaradmin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Product List</h1>

    <a href="/admindashboard/product/tambah"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        + Tambah Produk
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
@foreach ($data as $items)

 <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">

    <div class="h-48 overflow-hidden">
        <img src="{{ asset('uploads/image/product_picture/' . $items->product_picture) }}"
             alt="{{ $items->product_name }}"
             class="w-full h-full object-cover hover:scale-105 transition duration-300">
    </div>

    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-800 line-clamp-1">
            {{ $items->product_name }}
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            {{ $items->author }} • {{ $items->category }}
        </p>

        <p class="text-sm text-gray-600 mt-2 line-clamp-2">
            {{ $items->description }}
        </p>

        <div class="mt-3 flex justify-between items-center">
            <p class="font-bold text-green-600 text-lg">
                Rp {{ number_format($items->price, 0, ',', '.') }}
            </p>

            <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                Stock: {{ $items->stock }}
            </span>
        </div>

        <p class="text-xs text-gray-400 mt-2">
            Added by: {{ optional($items->user)->name }}
        </p>

        <div class="flex gap-2 mt-4">
            <a href="{{ url('/admindashboard/product/' . $items->id . '/edit') }}"
               class="flex-1 text-center bg-blue-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-600 transition">
                Edit
            </a>

            <form action="{{ url('/admindashboard/product/' . $items->id) }}" method="POST" class="flex-1"
                  onsubmit="return confirm('Hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full bg-red-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

</div>

@endforeach
</div>

@endsection
