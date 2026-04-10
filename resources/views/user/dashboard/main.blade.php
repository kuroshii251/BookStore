@extends('layouts.navbar')
@section('contents')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Filter Produk</h3>
        <form action="{{ url('/dashboard') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
            @if (request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-2 rounded-lg font-semibold transition">Filter</button>
            @if(request('q') || request('category'))
                <a href="{{ url('/dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-2 rounded-lg font-semibold transition">Clear All</a>
            @endif
        </form>
        @if(request('category'))
            <p class="text-sm text-green-600 mt-2">Menampilkan produk kategori: <strong>{{ request('category') }}</strong></p>
        @endif
    </div>

    @if(isset($products) && $products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10">
            @foreach ($products as $item)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
                    <div class="w-full h-64 overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('uploads/image/product_picture/' . $item->product_picture) }}" class="h-full object-contain p-1 mt-" alt="Book Cover">
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500">{{ $item->author }}</p>
                        <h2 class="text-lg font-semibold text-gray-800 line-clamp-2">{{ $item->product_name }}</h2>
                        <p class="text-xl mt-2 text-green-600 font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <div class="mt-4">
                            <a href="{{ url('/dashboard/product/' . $item->id) }}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <h3 class="text-2xl font-bold text-gray-600 mb-4">No products found{{ request('q') ? ' for "' . e(request('q')) . '"' : '' }}{{ request('category') ? ' in category "' . e(request('category')) . '"' : '' }}.</h3>
            <p class="text-gray-500 mb-6">Try a different search term or <a href="/dashboard" class="text-blue-500 hover:underline font-semibold">view all products</a>.</p>
        </div>
    @endif
</div>
@endsection
