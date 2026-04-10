@extends('layouts.navbar')

@section('contents')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-6">

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($data)
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-10">
            <form action="{{ url('/dashboard/product/' . $data->id) }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-10 items-start">

                    <div class="flex justify-center">
                        <img
                            src="{{ asset('uploads/image/product_picture/' . $data->product_picture) }}"
                            alt="{{ $data->product_name }}"
                            class="w-full max-w-sm rounded-xl shadow-lg object-cover hover:scale-105 transition duration-300"
                        >
                    </div>

                    <div class="space-y-5">

                        <h1 class="text-3xl font-bold text-gray-800">
                            {{ $data->product_name }}
                        </h1>

                        <div class="space-y-2 text-gray-600">
                            <p><span class="font-semibold text-gray-700">Category:</span> {{ $data->category }}</p>
                            <p><span class="font-semibold text-gray-700">Author:</span> {{ $data->author }}</p>
                            <p><span class="font-semibold text-gray-700">Stock:</span> {{ $data->stock }}</p>
                            <p><span class="font-semibold text-gray-700">Added by:</span> {{ $data->user->name }}</p>
                        </div>

                        <p class="text-gray-600 leading-relaxed">
                            <span class="font-semibold text-gray-700">Description:</span><br>
                            {{ $data->description }}
                        </p>

                        <div class="text-3xl font-bold text-green-600">
                            ${{ $data->price }}
                        </div>

                        <div class="border-t pt-5"></div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                            <div class="flex items-center gap-2">
                                <label class="text-gray-700 font-medium">Quantity:</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $data->stock }}"
                                    class="border border-gray-300 p-2 w-20 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    required
                                >
                            </div>

                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-3 rounded-xl font-semibold shadow-md"
                            >
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>
            </form>
        </div>
        @endif

    </div>
</div>
@endsection
