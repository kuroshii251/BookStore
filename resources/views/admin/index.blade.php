@extends('layouts.navbaradmin')
@section('content')
<div class="container mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, Admin</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center">
            <div class="text-3xl font-bold text-black">{{ number_format($totalOrders) }}</div>
            <div class="text-gray-600 mt-1">Total Orders</div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center">
            <div class="text-3xl font-bold text-black">{{ number_format($totalBuyers) }}</div>
            <div class="text-gray-600 mt-1">Pembeli (Users dengan Order)</div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center">
            <div class="text-3xl font-bold text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="text-gray-600 mt-1">Total Revenue</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Orders</h3>
            @if($recentOrders->count() > 0)
                <div class="space-y-3">
                    @foreach($recentOrders as $order)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold">{{ $order->product_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->name ?? 'Unknown' }} - {{ $order->quantity }} x Rp {{ number_format($order->harga, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-sm text-green-600 font-semibold">Rp {{ number_format($order->quantity * $order->harga, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada orders.</p>
            @endif
            <a href="{{ url('/admindashboard/order') }}" class="mt-4 inline-block text-blue-500 hover:underline font-semibold">Lihat Semua Orders →</a>
        </div>

        <!-- Recent Users -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Users</h3>
            @if($recentUsers->count() > 0)
                <div class="space-y-3">
                    @foreach($recentUsers as $user)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">{{ $user->orders()->count() }} orders</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada users.</p>
            @endif
            <a href="{{ url('/admindashboard/user') }}" class="mt-4 inline-block text-blue-500 hover:underline font-semibold">Lihat Semua Users →</a>
        </div>
    </div>
</div>
@endsection
