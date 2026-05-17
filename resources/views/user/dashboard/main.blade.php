@extends('layouts.navbar')

@section('contents')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=DM+Sans:wght@300;400;500;600&display=swap');

    .dash-wrap {
        display: flex;
        gap: 0;
        min-height: calc(100vh - 64px);
        background: #f7f5f2;
        font-family: 'DM Sans', sans-serif;
    }

    /* ── SIDEBAR ── */
    .dash-sidebar {
        width: 280px;
        flex-shrink: 0;
        background: #ffffff;
        border-right: 1px solid #e8e4de;
        padding: 2rem 1.5rem;
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
    }

    .sidebar-heading {
        font-family: 'Lora', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1714;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: -0.01em;
    }

    .sidebar-heading svg {
        width: 18px;
        height: 18px;
        stroke: #7c6f5b;
    }

    .filter-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #a09484;
        margin-bottom: 0.6rem;
        display: block;
    }

    .filter-section {
        margin-bottom: 1.75rem;
    }

    /* Search input in sidebar */
    .sidebar-search {
        position: relative;
        margin-bottom: 1.75rem;
    }

    .sidebar-search input {
        width: 100%;
        padding: 0.6rem 0.9rem 0.6rem 2.4rem;
        border: 1px solid #e0dbd4;
        border-radius: 10px;
        font-size: 0.875rem;
        font-family: 'DM Sans', sans-serif;
        background: #faf9f7;
        color: #1a1714;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        box-sizing: border-box;
    }

    .sidebar-search input:focus {
        border-color: #c4a882;
        box-shadow: 0 0 0 3px rgba(196, 168, 130, 0.15);
    }

    .sidebar-search svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        stroke: #a09484;
        pointer-events: none;
    }

    /* Category pills */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .category-list li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-size: 0.875rem;
        color: #4a4035;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
        font-weight: 400;
    }

    .category-list li a:hover {
        background: #f5f0ea;
        color: #1a1714;
    }

    .category-list li a.active {
        background: #1a1714;
        color: #f7f5f2;
        font-weight: 500;
    }

    .category-list li a .cat-count {
        font-size: 0.75rem;
        background: rgba(160, 148, 132, 0.2);
        color: inherit;
        padding: 1px 7px;
        border-radius: 999px;
        opacity: 0.7;
    }

    .category-list li a.active .cat-count {
        background: rgba(255,255,255,0.2);
        opacity: 1;
    }

    .divider {
        height: 1px;
        background: #e8e4de;
        margin: 1.5rem 0;
    }

    .btn-clear {
        display: block;
        width: 100%;
        padding: 0.55rem;
        text-align: center;
        border: 1px solid #e0dbd4;
        border-radius: 8px;
        font-size: 0.8rem;
        font-family: 'DM Sans', sans-serif;
        color: #7c6f5b;
        background: transparent;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
    }

    .btn-clear:hover {
        background: #f5f0ea;
        color: #1a1714;
    }

    /* ── MAIN CONTENT ── */
    .dash-main {
        flex: 1;
        padding: 2rem 2.5rem;
        min-width: 0;
    }

    .main-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .results-info {
        font-size: 0.875rem;
        color: #7c6f5b;
    }

    .results-info strong {
        color: #1a1714;
        font-weight: 500;
    }

    .active-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #1a1714;
        color: #f7f5f2;
        font-size: 0.78rem;
        padding: 4px 10px 4px 12px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 500;
        transition: opacity 0.15s;
    }

    .filter-pill:hover { opacity: 0.8; }

    .filter-pill svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    /* ── PRODUCT GRID ── */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.25rem;
    }

    .product-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #ede8e1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(26, 23, 20, 0.1);
    }

    .card-image-wrap {
        background: #f9f7f4;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-bottom: 1px solid #ede8e1;
        position: relative;
    }

    .card-image-wrap img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .card-image-wrap img {
        transform: scale(1.04);
    }

    .card-body {
        padding: 1rem 1.1rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .card-author {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #a09484;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .card-title {
        font-family: 'Lora', serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a1714;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 8px;
        letter-spacing: -0.01em;
    }

    .card-price {
        font-size: 1.05rem;
        font-weight: 600;
        color: #2d7a4f;
        margin-top: auto;
        padding-top: 8px;
    }

    .btn-detail {
        display: block;
        margin-top: 10px;
        padding: 0.55rem;
        text-align: center;
        background: #1a1714;
        color: #f7f5f2;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        letter-spacing: 0.01em;
        transition: background 0.15s, opacity 0.15s;
    }

    .btn-detail:hover {
        background: #3d352e;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
    }

    .empty-icon {
        width: 56px;
        height: 56px;
        background: #ede8e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }

    .empty-icon svg {
        width: 26px;
        height: 26px;
        stroke: #a09484;
    }

    .empty-state h3 {
        font-family: 'Lora', serif;
        font-size: 1.3rem;
        color: #1a1714;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.9rem;
        color: #7c6f5b;
    }

    .empty-state a {
        color: #c4a882;
        text-decoration: underline;
    }

    /* Pagination */
    .pagination-wrap {
        margin-top: 2.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination-wrap nav {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    /* Mobile sidebar toggle */
    .sidebar-toggle {
        display: none;
        align-items: center;
        gap: 6px;
        padding: 0.5rem 1rem;
        background: #1a1714;
        color: #f7f5f2;
        border: none;
        border-radius: 10px;
        font-size: 0.85rem;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        margin-bottom: 1rem;
    }

    .sidebar-toggle svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
    }

    @media (max-width: 768px) {
        .dash-wrap {
            flex-direction: column;
        }
        .dash-sidebar {
            width: 100%;
            height: auto;
            position: static;
            border-right: none;
            border-bottom: 1px solid #e8e4de;
            padding: 1.25rem 1rem;
            display: none;
        }
        .dash-sidebar.open {
            display: block;
        }
        .sidebar-toggle {
            display: flex;
        }
        .dash-main {
            padding: 1.25rem 1rem;
        }
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }
        .card-image-wrap {
            height: 180px;
        }
    }
</style>

<div class="dash-wrap">

    {{-- ── SIDEBAR ── --}}
    <aside class="dash-sidebar" id="filterSidebar">

        <div class="sidebar-heading">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591L15.75 12.5v7.25a.75.75 0 0 1-.35.636l-3 1.875a.75.75 0 0 1-1.15-.636V12.5L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
            Filter Produk
        </div>

        {{-- Search --}}
        <div class="sidebar-search">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803a7.5 7.5 0 0 0 10.607 0Z" />
            </svg>
            <form action="{{ url('/dashboard') }}" method="GET">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari buku, penulis…">
            </form>
        </div>

        <div class="divider"></div>

        {{-- Categories --}}
        <div class="filter-section">
            <span class="filter-label">Kategori</span>
            <ul class="category-list">
                <li>
                    <a href="{{ url('/dashboard') }}{{ request('q') ? '?q=' . request('q') : '' }}"
                       class="{{ !request('category') ? 'active' : '' }}">
                        Semua Kategori
                        <span class="cat-count">{{ $products->total() }}</span>
                    </a>
                </li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ url('/dashboard') }}?category={{ urlencode($category) }}{{ request('q') ? '&q=' . request('q') : '' }}"
                           class="{{ request('category') == $category ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Clear filters --}}
        @if(request('q') || request('category'))
            <div class="divider"></div>
            <a href="{{ url('/dashboard') }}" class="btn-clear">
                × Hapus semua filter
            </a>
        @endif

    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <main class="dash-main">

        {{-- Mobile sidebar toggle --}}
        <button class="sidebar-toggle" onclick="document.getElementById('filterSidebar').classList.toggle('open')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
            Filter
        </button>

        {{-- Topbar: info + active filter pills --}}
        <div class="main-topbar">
            <span class="results-info">
                @if(isset($products) && $products->total() > 0)
                    Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
                @else
                    Tidak ada produk ditemukan
                @endif
            </span>
            <div class="active-filters">
                @if(request('q'))
                    <a href="{{ url('/dashboard') }}{{ request('category') ? '?category=' . request('category') : '' }}" class="filter-pill">
                        "{{ request('q') }}"
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </a>
                @endif
                @if(request('category'))
                    <a href="{{ url('/dashboard') }}{{ request('q') ? '?q=' . request('q') : '' }}" class="filter-pill">
                        {{ request('category') }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- Product Grid --}}
        @if(isset($products) && $products->count() > 0)
            <div class="product-grid">
                @foreach ($products as $item)
                    <div class="product-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('uploads/image/product_picture/' . $item->product_picture) }}"
                                 alt="{{ $item->product_name }}">
                        </div>
                        <div class="card-body">
                            <span class="card-author">{{ $item->author }}</span>
                            <h2 class="card-title">{{ $item->product_name }}</h2>
                            <p class="card-price">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <a href="{{ url('/dashboard/product/' . $item->id) }}" class="btn-detail">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrap">
                {{ $products->appends(request()->query())->links() }}
            </div>

        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803a7.5 7.5 0 0 0 10.607 0Z" />
                    </svg>
                </div>
                <h3>Produk tidak ditemukan</h3>
                <p>
                    Tidak ada hasil
                    @if(request('q')) untuk "<strong>{{ e(request('q')) }}</strong>"@endif
                    @if(request('category')) di kategori "<strong>{{ e(request('category')) }}</strong>"@endif.
                    <br>Coba ubah filter atau <a href="{{ url('/dashboard') }}">lihat semua produk</a>.
                </p>
            </div>
        @endif

    </main>

</div>

@endsection
