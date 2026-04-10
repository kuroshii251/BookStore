@extends('layouts.navbaradmin')

@section('content')


<div class="">
<h1 class="text-3xl font-bold text-gray-800 text-center">Tambah Produk</h1>

<div class="">
<form action="{{ url('/admindashboard/product/tambah') }}" method="POST" enctype="multipart/form-data">
    @csrf
<input type="text" name="product_name" class="w-full p-3 border rounded-lg mb-4" placeholder="Nama Produk" required>
<select name="category" class="w-full p-3 border rounded-lg mb-4" required>
    <option value="">Pilih Kategori</option>
    @foreach ($categorydata as $item )
            <option value="{{ $item->category_name }}"> {{ $item->category_name }} </option>

    @endforeach
</select>
<textarea name="description" class="w-full p-3 border rounded-lg mb-4" placeholder="Deskripsi" rows="4" required></textarea>
<input type="number" name="price" class="w-full p-3 border rounded-lg mb-4" step="0.01" placeholder="Harga" required>
<input type="text" name="author" class="w-full p-3 border rounded-lg mb-4" placeholder="Penulis" required>
<input type="number" name="stock" class="w-full p-3 border rounded-lg mb-4" placeholder="Stok" min="0" required>
<input type="file" name="product_picture" class="w-full p-3 border rounded-lg mb-4" accept="image/*">

<button type="submit" class="w-full rounded-xl p-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold">Tambah Produk</button>
</form>
</div>
</div>

@endsection
