@extends('layouts.navbar')

@section('contents')
<div class="container mx-auto p-6">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($carts->count() > 0)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($carts as $cart)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ asset('uploads/image/product_picture/' . $cart->product->product_picture) }}" alt="{{ $cart->product->product_name }}" class="h-16 w-16 object-cover rounded-lg mr-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $cart->product->product_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $cart->product->category }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($cart->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $cart->quantity }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${{ number_format($cart->subtotal, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ URL('/dashboard/cart/' . $cart->id) }}" method="DELETE" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove this item?')">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 font-bold">Total: ${{ number_format($carts->sum('subtotal'), 2) }}</td>
                        <td class="px-6 py-4 font-bold text-2xl text-green-600"></td>
                        <td class="px-6 py-4">
                            <a href="{{ url('/dashboard/checkout') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-2 rounded-lg font-semibold">
                              Checkout
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🛒</div>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart.</p>
            <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection

