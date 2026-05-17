<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookPedia Admin</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .serif { font-family: 'Playfair Display', Georgia, serif; }

        /* Sidebar active link */
        .nav-link { position: relative; }
        .nav-link.active {
            background-color: #fef3c7;
            color: #92400e;
            font-weight: 500;
        }
        .nav-link.active .nav-icon { color: #b45309; }
        .nav-link:not(.active):hover { background-color: #f5f5f4; }

        /* Thin book-spine accent on active */
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: #b45309;
        }

        /* Scrollbar */
        .main-content::-webkit-scrollbar { width: 5px; }
        .main-content::-webkit-scrollbar-thumb { background: #e7e5e4; border-radius: 4px; }
    </style>
</head>
<body class="bg-stone-100 text-stone-800">

<div class="flex min-h-screen">

    {{-- ── Sidebar ── --}}
    <aside class="w-64 shrink-0 bg-white border-r border-stone-200 flex flex-col">

        {{-- Brand --}}
        <div class="px-6 py-6 border-b border-stone-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-700 flex items-center justify-center text-white text-base">
                    📚
                </div>
                <div>
                    <p class="serif text-lg font-bold text-stone-800 leading-none">BookPedia</p>
                    <p class="text-xs text-stone-400 mt-0.5">Admin Panel</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5">

            <p class="text-xs font-medium text-stone-400 uppercase tracking-widest px-3 mb-2">Menu</p>

            <a href="/admindashboard"
               class="nav-link {{ request()->is('admindashboard') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">🏠</span>
                Dashboard
            </a>

            <a href="/admindashboard/product"
               class="nav-link {{ request()->is('admindashboard/product*') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">📖</span>
                Product
            </a>

            <a href="/admindashboard/category"
               class="nav-link {{ request()->is('admindashboard/category*') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">🗂</span>
                Category
            </a>

            <a href="/admindashboard/order"
               class="nav-link {{ request()->is('admindashboard/order*') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">📦</span>
                Order
            </a>

            <a href="/admindashboard/chat"
               class="nav-link {{ request()->is('admindashboard/chat*') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">💬</span>
                Chat
            </a>

            <a href="/admindashboard/user"
               class="nav-link {{ request()->is('admindashboard/user*') ? 'active' : 'text-stone-600' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors duration-150">
                <span class="nav-icon text-stone-400 text-base">👤</span>
                User
            </a>

        </nav>

        {{-- Admin info + Logout --}}
        <div class="px-4 py-4 border-t border-stone-100">
            <div class="flex items-center gap-3 mb-3 px-1">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-xs font-semibold text-amber-800 flex-shrink-0">
                    AD
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-stone-700 truncate">Administrator</p>
                    <p class="text-xs text-stone-400 truncate">admin@bookpedia.id</p>
                </div>
            </div>
            <form action="{{ URL('/logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 text-sm text-stone-500 hover:text-red-600 hover:bg-red-50 border border-stone-200 hover:border-red-200 py-2 rounded-xl transition-colors duration-150 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- ── Main Content ── --}}
    <div class="flex-1 flex flex-col min-h-screen overflow-hidden">

        {{-- Top bar --}}
        <header class="bg-white border-b border-stone-200 px-8 py-4 flex items-center justify-between shrink-0">
            <div>
                {{-- Page title injected by child views via @section('page-title') --}}
                <h2 class="serif text-xl font-bold text-stone-800 leading-none">
                    @yield('page-title', 'Dashboard')
                </h2>
                <p class="text-xs text-stone-400 mt-0.5">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                {{-- Live badge --}}
                <div class="flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 rounded-full px-3 py-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-medium text-emerald-700">Live</span>
                </div>
                {{-- Bell --}}
                <button class="w-9 h-9 rounded-xl border border-stone-200 hover:bg-stone-50 flex items-center justify-center text-stone-500 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
            </div>
        </header>

        {{-- Page content --}}
        <main class="main-content flex-1 overflow-y-auto bg-stone-100">
            <div class="p-8">
                @yield('content')
            </div>
        </main>

    </div>
</div>

</body>
</html>
