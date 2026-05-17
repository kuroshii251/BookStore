@extends('layouts.navbaradmin')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500&display=swap');

    body, .dash-wrap { font-family: 'DM Sans', sans-serif; background-color: #f5efe6; }
    .font-serif-display { font-family: 'Playfair Display', Georgia, serif; }

    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-4deg); }
    .stat-icon { transition: transform 0.25s ease; }

    .row-order:hover { background-color: #fdf7ef; }
    .row-user:hover  { background-color: #fdf7ef; }
</style>

<div class="dash-wrap min-h-screen px-6 py-8 max-w-6xl mx-auto">

    {{-- ── Header ── --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4">
        <div>
            <p class="text-xs tracking-widest uppercase text-amber-700 font-medium mb-1">Admin Dashboard</p>
            <h1 class="font-serif-display text-4xl font-bold text-stone-800 leading-tight">
                The Bookshelf
            </h1>
            <p class="text-stone-500 text-sm mt-1">Selamat datang kembali, Admin 👋</p>
        </div>

        <div class="flex items-center gap-2 bg-white border border-stone-200 rounded-full px-4 py-2 shadow-sm self-start sm:self-auto">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-medium text-stone-600 tracking-wide">Toko Buka</span>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">

        <div class="stat-card bg-white rounded-2xl border border-stone-100 shadow-sm p-6 flex items-start gap-4">
            <div class="stat-icon w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-2xl flex-shrink-0">
                📦
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-widest text-stone-400 mb-1">Total Orders</p>
                <p class="font-serif-display text-3xl font-bold text-stone-800 leading-none">
                    {{ number_format($totalOrders) }}
                </p>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl border border-stone-100 shadow-sm p-6 flex items-start gap-4">
            <div class="stat-icon w-12 h-12 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-2xl flex-shrink-0">
                🧑‍🤝‍🧑
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-widest text-stone-400 mb-1">Pembeli</p>
                <p class="font-serif-display text-3xl font-bold text-stone-800 leading-none">
                    {{ number_format($totalBuyers) }}
                </p>
            </div>
        </div>

        <div class="stat-card bg-amber-700 rounded-2xl shadow-sm p-6 flex items-start gap-4">
            <div class="stat-icon w-12 h-12 rounded-xl bg-amber-600 border border-amber-500 flex items-center justify-center text-2xl flex-shrink-0">
                💰
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-widest text-amber-200 mb-1">Total Revenue</p>
                <p class="font-serif-display text-2xl font-bold text-white leading-none">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
            </div>
        </div>

    </div>

    {{-- ── Panels ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Orders --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
                <h2 class="font-serif-display text-lg font-semibold text-stone-800">Recent Orders</h2>
                <span class="text-xs bg-amber-50 text-amber-700 border border-amber-100 rounded-full px-3 py-0.5 font-medium">
                    {{ $recentOrders->count() }} transaksi
                </span>
            </div>

            <div class="divide-y divide-stone-50">
                @if($recentOrders->count() > 0)
                    @foreach($recentOrders as $order)
                    <div class="row-order flex items-center justify-between px-6 py-4 transition-colors duration-150">
                        <div class="flex items-center gap-4">
                            <div class="w-1 h-10 rounded-full bg-amber-300 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm font-medium text-stone-800 leading-tight">
                                    {{ $order->product_name }}
                                </p>
                                <p class="text-xs text-stone-400 mt-0.5">
                                    {{ $order->user->name ?? 'Unknown' }}
                                    &middot; {{ $order->quantity }} buku
                                    &middot; Rp {{ number_format($order->harga, 0, ',', '.') }}/buku
                                </p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-emerald-700 bg-emerald-50 rounded-lg px-3 py-1 flex-shrink-0 ml-4">
                            Rp {{ number_format($order->quantity * $order->harga, 0, ',', '.') }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <div class="px-6 py-10 text-center">
                        <p class="text-4xl mb-3">📭</p>
                        <p class="text-sm text-stone-400">Belum ada pesanan masuk.</p>
                    </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100">
                <a href="{{ url('/admindashboard/order') }}"
                   class="text-xs font-medium text-amber-700 hover:text-amber-900 tracking-wide uppercase transition-colors duration-150 flex items-center gap-1">
                    Lihat semua pesanan
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Recent Users --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
                <h2 class="font-serif-display text-lg font-semibold text-stone-800">Recent Users</h2>
                <span class="text-xs bg-rose-50 text-rose-600 border border-rose-100 rounded-full px-3 py-0.5 font-medium">
                    {{ $recentUsers->count() }} pembeli
                </span>
            </div>

            <div class="divide-y divide-stone-50">
                @if($recentUsers->count() > 0)
                    @foreach($recentUsers as $user)
                    @php
                        $initials = collect(explode(' ', $user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->join('');
                        $colors   = ['bg-amber-100 text-amber-800','bg-rose-100 text-rose-800','bg-teal-100 text-teal-800','bg-violet-100 text-violet-800','bg-sky-100 text-sky-800'];
                        $color    = $colors[$loop->index % count($colors)];
                    @endphp
                    <div class="row-user flex items-center justify-between px-6 py-4 transition-colors duration-150">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0 {{ $color }}">
                                {{ $initials }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-stone-800 leading-tight">{{ $user->name }}</p>
                                <p class="text-xs text-stone-400 mt-0.5">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-stone-500 bg-stone-100 rounded-full px-3 py-1 flex-shrink-0 ml-4">
                            {{ $user->orders()->count() }} order
                        </span>
                    </div>
                    @endforeach
                @else
                    <div class="px-6 py-10 text-center">
                        <p class="text-4xl mb-3">📚</p>
                        <p class="text-sm text-stone-400">Belum ada pembeli terdaftar.</p>
                    </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100">
                <a href="{{ url('/admindashboard/user') }}"
                   class="text-xs font-medium text-amber-700 hover:text-amber-900 tracking-wide uppercase transition-colors duration-150 flex items-center gap-1">
                    Lihat semua pengguna
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>

    <p class="text-center text-xs text-stone-300 mt-10 tracking-widest uppercase">
        &mdash; The Bookshelf Admin Panel &mdash;
    </p>

</div>

@endsection
