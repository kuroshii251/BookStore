@extends('layouts.navbar')

@section('contents')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    .detail-page {
        min-height: calc(100vh - 64px);
        background: #f7f5f2;
        font-family: 'DM Sans', sans-serif;
        padding: 2.5rem 1.5rem;
    }

    .detail-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: #a09484;
        margin-bottom: 2rem;
    }

    .breadcrumb a {
        color: #a09484;
        text-decoration: none;
        transition: color 0.15s;
    }

    .breadcrumb a:hover { color: #1a1714; }

    .breadcrumb svg {
        width: 12px;
        height: 12px;
        stroke: #c8bfb3;
        flex-shrink: 0;
    }

    /* Alert */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #eaf3de;
        border: 1px solid #c0dd97;
        color: #3b6d11;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .alert-success svg {
        width: 18px;
        height: 18px;
        stroke: #3b6d11;
        flex-shrink: 0;
    }

    /* Main card */
    .detail-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #ede8e1;
        overflow: hidden;
        display: grid;
        grid-template-columns: 420px 1fr;
    }

    /* Left: image panel */
    .image-panel {
        background: #f5f0ea;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem;
        min-height: 520px;
        position: relative;
        overflow: hidden;
    }

    .image-panel::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 30% 30%, #ede8de 0%, #f5f0ea 70%);
    }

    .image-panel img {
        position: relative;
        width: 100%;
        max-width: 280px;
        border-radius: 10px;
        box-shadow: 0 24px 56px rgba(26, 23, 20, 0.22), 0 8px 20px rgba(26, 23, 20, 0.1);
        transition: transform 0.35s ease;
    }

    .image-panel img:hover {
        transform: translateY(-6px) scale(1.02);
    }

    /* Right: info panel */
    .info-panel {
        padding: 2.5rem 2.75rem;
        display: flex;
        flex-direction: column;
    }

    /* Category badge */
    .category-badge {
        display: inline-flex;
        align-items: center;
        background: #1a1714;
        color: #f7f5f2;
        font-size: 0.68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 4px 12px;
        border-radius: 999px;
        margin-bottom: 1rem;
        width: fit-content;
    }

    .product-title {
        font-family: 'Lora', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1a1714;
        line-height: 1.25;
        letter-spacing: -0.02em;
        margin-bottom: 0.5rem;
    }

    .product-author {
        font-size: 0.9rem;
        color: #a09484;
        font-weight: 400;
        margin-bottom: 1.5rem;
    }

    .product-author span {
        color: #7c6f5b;
        font-weight: 500;
    }

    /* Meta grid */
    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .meta-item {
        background: #faf9f7;
        border: 1px solid #e8e4de;
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
    }

    .meta-item .meta-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #a09484;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .meta-item .meta-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: #1a1714;
    }

    .meta-item.stock-ok .meta-value { color: #2d7a4f; }
    .meta-item.stock-low .meta-value { color: #ba7517; }

    /* Description */
    .description-block {
        margin-bottom: 1.75rem;
        flex: 1;
    }

    .description-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #a09484;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .description-text {
        font-size: 0.9rem;
        color: #5a4f44;
        line-height: 1.75;
    }

    /* Divider */
    .divider {
        height: 1px;
        background: #e8e4de;
        margin: 1.5rem 0;
    }

    /* Price */
    .price-row {
        display: flex;
        align-items: baseline;
        gap: 6px;
        margin-bottom: 1.5rem;
    }

    .price-main {
        font-family: 'Lora', serif;
        font-size: 2.1rem;
        font-weight: 700;
        color: #1a1714;
        letter-spacing: -0.02em;
    }

    .price-sub {
        font-size: 0.8rem;
        color: #a09484;
    }

    /* Action row */
    .action-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .qty-wrap {
        display: flex;
        align-items: center;
        border: 1px solid #e0dbd4;
        border-radius: 12px;
        overflow: hidden;
        background: #faf9f7;
    }

    .qty-btn {
        width: 36px;
        height: 44px;
        background: transparent;
        border: none;
        font-size: 1.1rem;
        color: #4a4035;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s;
        font-family: 'DM Sans', sans-serif;
    }

    .qty-btn:hover { background: #f0ece5; }

    .qty-input {
        width: 44px;
        height: 44px;
        border: none;
        border-left: 1px solid #e0dbd4;
        border-right: 1px solid #e0dbd4;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        color: #1a1714;
        background: #fff;
        outline: none;
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-inner-spin-button,
    .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

    .btn-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #1a1714;
        color: #f7f5f2;
        padding: 0 1.75rem;
        height: 44px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
        border: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        letter-spacing: 0.01em;
    }

    .btn-cart svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    .btn-cart:hover { background: #3d352e; }
    .btn-cart:active { transform: scale(0.98); }

    /* Sold by tag */
    .sold-by {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 0.78rem;
        color: #a09484;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e8e4de;
    }

    .sold-by svg {
        width: 14px;
        height: 14px;
        stroke: #a09484;
    }

    .sold-by strong {
        color: #5a4f44;
        font-weight: 500;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .detail-card {
            grid-template-columns: 1fr;
        }
        .image-panel {
            min-height: 300px;
            padding: 2rem;
        }
        .image-panel img {
            max-width: 200px;
        }
        .info-panel {
            padding: 1.75rem 1.5rem;
        }
        .product-title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 480px) {
        .detail-page { padding: 1.25rem 1rem; }
        .meta-grid { grid-template-columns: 1fr; }
        .action-row { flex-direction: column; align-items: stretch; }
        .qty-wrap { justify-content: center; }
        .btn-cart { height: 48px; }
    }
</style>

<div class="detail-page">
    <div class="detail-container">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ url('/dashboard') }}">Beranda</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            @if($data)
                <a href="{{ url('/dashboard') }}?category={{ urlencode($data->category) }}">{{ $data->category }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span style="color:#5a4f44;">{{ Str::limit($data->product_name, 40) }}</span>
            @endif
        </nav>

        {{-- Success alert --}}
        @if (session('success'))
            <div class="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Product card --}}
        @if ($data)
        <div class="detail-card">

            {{-- Image panel --}}
            <div class="image-panel">
                <img
                    src="{{ asset('uploads/image/product_picture/' . $data->product_picture) }}"
                    alt="{{ $data->product_name }}"
                >
            </div>

            {{-- Info panel --}}
            <div class="info-panel">

                <span class="category-badge">{{ $data->category }}</span>

                <h1 class="product-title">{{ $data->product_name }}</h1>
                <p class="product-author">oleh <span>{{ $data->author }}</span></p>

                {{-- Meta info --}}
                <div class="meta-grid">
                    <div class="meta-item {{ $data->stock > 5 ? 'stock-ok' : 'stock-low' }}">
                        <div class="meta-label">Stok</div>
                        <div class="meta-value">
                            {{ $data->stock > 0 ? $data->stock . ' tersedia' : 'Habis' }}
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Penjual</div>
                        <div class="meta-value">{{ $data->user->name }}</div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="description-block">
                    <span class="description-label">Deskripsi</span>
                    <p class="description-text">{{ $data->description }}</p>
                </div>

                <div class="divider"></div>

                {{-- Price --}}
                <div class="price-row">
                    <span class="price-main">Rp {{ number_format($data->price, 0, ',', '.') }}</span>
                    <span class="price-sub">/ eksemplar</span>
                </div>

                {{-- Add to cart --}}
                <form action="{{ url('/dashboard/product/' . $data->id) }}" method="POST">
                    @csrf
                    <div class="action-row">
                        {{-- Qty stepper --}}
                        <div class="qty-wrap">
                            <button type="button" class="qty-btn" onclick="stepQty(-1)">−</button>
                            <input
                                type="number"
                                name="quantity"
                                id="qtyInput"
                                value="1"
                                min="1"
                                max="{{ $data->stock }}"
                                class="qty-input"
                                required
                            >
                            <button type="button" class="qty-btn" onclick="stepQty(1)">+</button>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn-cart">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </form>

                {{-- Sold by --}}
                <div class="sold-by">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016 2.993 2.993 0 0 0 2.25-1.016 3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    Dijual oleh <strong>{{ $data->user->name }}</strong>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>

<script>
    function stepQty(delta) {
        const input = document.getElementById('qtyInput');
        const min = parseInt(input.min) || 1;
        const max = parseInt(input.max) || 9999;
        let val = parseInt(input.value) || 1;
        val = Math.min(max, Math.max(min, val + delta));
        input.value = val;
    }
</script>

@endsection
