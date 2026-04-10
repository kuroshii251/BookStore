@extends('layouts.navbaradmin')
@section('content')

<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Category</h1>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl shadow-md mb-6">
        <form action="{{ route('tambah') }}" method="POST" class="flex gap-3">
            @csrf

            <input
                type="text"
                name="category_name"
                placeholder="Masukkan kategori..."
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                required
            >

            <button
                type="submit"
                class="px-4 py-2 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition">
                Tambah
            </button>
        </form>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($data as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $item->id }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $item->category_name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $item->product_count }}
                        </td>

                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ url('/admindashboard/category/' . $item->id . '/edit') }}" class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition">Edit</a>
                            @if(($item->product_count) > 0)
                                <button class="px-3 py-1 bg-gray-400 text-white text-sm rounded-lg cursor-not-allowed" disabled>Delete (Used)</button>
                            @else
                                <form action="{{ url('/admindashboard/category/' . $item->id ) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">
                            Belum ada kategori
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection

