@extends('layouts.navbar')
@section('contents')

<style>
    body {
        font-family:"Arial", sans-serif;
    }
    .section-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--navy);
        letter-spacing: -0.02em;
    }
    .section-subtitle {
        font-size: 0.88rem;
        color: var(--muted);
        margin-top: 0.3rem;
    }
    .see-all {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--gold);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: gap 0.2s;
    }
    .see-all:hover { gap: 0.6rem; }

    /* ─── HERO SLIDER ─── */
    .hero-section {
        background: var(--cream);
        padding: 2rem 0;
    }
    .hero-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.25rem;
    }

    .main-slider {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        aspect-ratio: 16/7;
        box-shadow: 0 8px 32px rgba(15,34,64,0.12);
    }
    .slides-track {
        display: flex;
        height: 100%;
        transition: transform 0.55s cubic-bezier(0.77, 0, 0.175, 1);
    }
    .slide {
        min-width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: center;
        padding: 2.5rem 3rem;
    }
    .slide-1 { background: linear-gradient(120deg, #0f2240 55%, #1a3a6b); }
    .slide-2 { background: linear-gradient(120deg, #2d1b0e 55%, #5c3a1e); }
    .slide-3 { background: linear-gradient(120deg, #1a2a1a 55%, #2d4a2d); }

    .slide-content { z-index: 2; max-width: 55%; }
    .slide-badge {
        display: inline-block;
        background: var(--gold);
        color: white;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        margin-bottom: 1rem;
    }
    .slide-content h2 {
        font-size: 2.2rem;
        color: white;
        line-height: 1.2;
        margin-bottom: 0.7rem;
    }
    .slide-content p {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    .slide-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--gold);
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
    }
    .slide-cta:hover { background: var(--gold-light); transform: translateY(-1px); }

    .slide-image {
        position: absolute;
        right: 3rem;
        bottom: 0;
        height: 90%;
        object-fit: contain;
        filter: drop-shadow(0 8px 24px rgba(0,0,0,0.4));
        z-index: 1;
    }

    /* Slider controls */
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        width: 40px; height: 40px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s;
    }
    .slider-btn:hover { background: rgba(255,255,255,0.3); }
    .slider-btn.prev { left: 1rem; }
    .slider-btn.next { right: 1rem; }

    .slider-dots {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
        z-index: 10;
    }
    .dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.25s;
        border: none;
        padding: 0;
    }
    .dot.active { background: white; width: 24px; border-radius: 4px; }

    /* Side banners */
    .side-banners {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }
    .side-banner {
        border-radius: 16px;
        padding: 1.4rem 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .side-banner:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
    .side-banner-1 { background: linear-gradient(135deg, #fff3cd, #ffe5a0); }
    .side-banner-2 { background: linear-gradient(135deg, #d4edff, #b8d9f7); }
    .side-banner span {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.4rem;
    }
    .side-banner h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
    }
    .side-banner p {
        font-size: 0.8rem;
        color: var(--muted);
        margin-top: 0.3rem;
    }
    .side-banner-icon {
        position: absolute;
        right: 1rem;
        bottom: 0.5rem;
        font-size: 2.8rem;
        opacity: 0.25;
    }

    /* ─── FEATURES BAR ─── */
    .features-bar {
        background: white;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 1.25rem 0;
    }
    .features-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.5rem 0;
    }
    .feature-icon {
        width: 44px; height: 44px;
        background: var(--cream);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        color: var(--navy);
    }
    .feature-item h4 {
        font-size: 0.87rem;
        font-weight: 600;
        color: var(--charcoal);
    }
    .feature-item p {
        font-size: 0.76rem;
        color: var(--muted);
        margin-top: 0.1rem;
    }

    /* ─── BOOK CARDS ─── */
    .container-xl {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .books-section {
        padding: 3rem 0 0;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 1rem;
    }
    .book-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1rem;
    }
    .book-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        cursor: pointer;
        text-decoration: none;
        display: block;
        color: inherit;
    }
    .book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(15,34,64,0.1);
        border-color: transparent;
    }
    .book-card:hover .card-overlay { opacity: 1; }

    .card-img-wrap {
        background: var(--cream);
        padding: 1.2rem 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        aspect-ratio: 3/4;
    }
    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
    }
    .card-overlay {
        position: absolute;
        top: 0.6rem; right: 0.6rem;
        background: var(--navy);
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .card-badge-discount {
        position: absolute;
        top: 0.6rem; left: 0.6rem;
        background: var(--red-promo);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
    }
    .card-body { padding: 0.75rem 0.85rem 1rem; }
    .card-author {
        font-size: 0.72rem;
        color: var(--muted);
        margin-bottom: 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-title {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--charcoal);
        line-height: 1.35;
        height: 2.3em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .card-price-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.6rem;
    }
    .card-price {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--navy);
    }
    .card-price-old {
        font-size: 0.75rem;
        color: #b0b0b0;
        text-decoration: line-through;
    }

    /* ─── BESTSELLER BADGE ─── */
    .badge-best {
        position: absolute;
        top: 0.6rem; left: 0.6rem;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: white;
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 0.25rem 0.55rem;
        border-radius: 6px;
    }

    .about-section {
        padding: 5rem 0;
        background: var(--cream);
        margin-top: 3rem;
    }
    .about-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }
    .about-text .eyebrow {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.8rem;
    }
    .about-text h2 {
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }
    .about-text p {
        font-size: 0.92rem;
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    .about-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
    }
    .stat-item h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--navy);
    }
    .stat-item h3 span { color: var(--gold); }
    .stat-item p { font-size: 0.78rem; color: var(--muted); margin-top: 0.2rem; }

    .about-img-wrap {
        position: relative;
    }
    .about-img-wrap img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(15,34,64,0.12);
        aspect-ratio: 4/5;
        object-fit: cover;
    }
    .about-img-accent {
        position: absolute;
        bottom: -1.5rem;
        left: -1.5rem;
        background: var(--gold);
        color: white;
        padding: 1.2rem 1.5rem;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(201,151,58,0.3);
    }
    .about-img-accent strong {
        display: block;
        font-size: 1.6rem;
        font-weight: 700;
    }
    .about-img-accent span { font-size: 0.8rem; opacity: 0.85; }

    /* ─── PROMO BANNER ─── */
    .promo-banner {
        max-width: 1280px;
        margin: 3rem auto 0;
        padding: 0 1.5rem;
    }
    .promo-inner {
        background: linear-gradient(120deg, var(--navy), #1e3a6e);
        border-radius: 20px;
        padding: 2.5rem 3.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        position: relative;
        overflow: hidden;
    }
    .promo-inner::before {
        content: '';
        position: absolute;
        right: -60px; top: -60px;
        width: 280px; height: 280px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    .promo-inner::after {
        content: '';
        position: absolute;
        right: 100px; bottom: -80px;
        width: 200px; height: 200px;
        background: rgba(201,151,58,0.08);
        border-radius: 50%;
    }
    .promo-text h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }
    .promo-text p { font-size: 0.88rem; color: #94a3b8; }
    .promo-form {
        display: flex;
        gap: 0;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .promo-form input {
        background: transparent;
        border: none;
        color: white;
        padding: 0.8rem 1.2rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        outline: none;
        width: 240px;
    }
    .promo-form input::placeholder { color: rgba(255,255,255,0.4); }
    .promo-form button {
        background: var(--gold);
        border: none;
        color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.8rem 1.5rem;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .promo-form button:hover { background: var(--gold-light); }

    /* ─── CONTACT ─── */
    #contact {
        padding: 4rem 0 2rem;
    }
    .contact-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        text-align: center;
    }
    .contact-inner .section-title { font-size: 2.2rem; }
    .contact-inner .section-subtitle {
        font-size: 1rem;
        max-width: 500px;
        margin: 0.5rem auto 0;
    }
    .contact-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .contact-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 2rem 1.5rem;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .contact-card:hover {
        box-shadow: 0 8px 24px rgba(15,34,64,0.08);
        transform: translateY(-3px);
    }
    .contact-card-icon {
        width: 52px; height: 52px;
        background: var(--cream);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.2rem;
        color: var(--navy);
    }
    .contact-card h4 {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--charcoal);
        margin-bottom: 0.4rem;
    }
    .contact-card p { font-size: 0.84rem; color: var(--muted); }
    .contact-card a {
        display: inline-block;
        margin-top: 1rem;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--gold);
        text-decoration: none;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1100px) {
        .book-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px) {
        .hero-inner { grid-template-columns: 1fr; }
        .side-banners { flex-direction: row; }
        .about-inner { grid-template-columns: 1fr; gap: 2.5rem; }
        .about-img-wrap { max-width: 480px; margin: 0 auto; }
        .contact-cards { grid-template-columns: 1fr; }
        .features-inner { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .book-grid { grid-template-columns: repeat(2, 1fr); }
        .promo-inner { flex-direction: column; text-align: center; }
        .promo-form { width: 100%; }
        .promo-form input { width: 100%; }
        .slide-content h2 { font-size: 1.4rem; }
    }
</style>


<section class="hero-section" id="hero" x-data="{
    active: 0, total: 3,
    timer: null,
    init() { this.timer = setInterval(() => this.next(), 4500); },
    next() { this.active = (this.active + 1) % this.total; },
    prev() { this.active = (this.active - 1 + this.total) % this.total; },
    goTo(i) { this.active = i; clearInterval(this.timer); }
}">
    <div class="hero-inner">

        <div class="main-slider">
            <div class="slides-track" :style="`transform: translateX(-${active * 100}%)`">

                <!-- Slide 1 -->
                <div class="slide slide-1">
                    <div class="slide-content">
                        <h2>Temukan Buku Impianmu di Sini</h2>
                        <p>Ribuan judul buku pilihan dari penulis lokal & internasional terbaik dengan harga terjangkau.</p>
                        <a href="#products" class="slide-cta">
Explore                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div style="position:absolute;right:2.5rem;bottom:0;height:88%;display:flex;align-items:flex-end;gap:0.8rem;z-index:1;">
                        <img src="{{ asset('komet.jpg') }}" alt="Komet" style="height:88%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.5);transform:rotate(-3deg);">
                        <img src="{{ asset('hujan.jpg') }}" alt="Hujan" style="height:74%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.4);">
                    </div>
                </div>

                <div class="slide slide-2">
                    <div class="slide-content">
                        <div class="slide-badge">🔥 Promo Akhir Bulan</div>
                        <h2>Diskon Hingga 30% untuk Novel Pilihan</h2>
                        <p>Dapatkan novel best-seller favoritmu dengan harga spesial. Penawaran terbatas!</p>
                        <a href="#products" class="slide-cta">Lihat Promo</a>
                    </div>
                    <div style="position:absolute;right:2.5rem;bottom:0;height:85%;z-index:1;">
                        <img src="{{ asset('bintang.jpg') }}" alt="Bintang" style="height:100%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.5);">
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide slide-3">
                    <div class="slide-content">
                        <div class="slide-badge">📚 Kategori Baru</div>
                        <h2>Koleksi Buku Pengembangan Diri</h2>
                        <p>Investasi terbaik adalah investasi pada diri sendiri. Mulai perjalananmu bersama kami.</p>
                        <a href="#products" class="slide-cta">Mulai Membaca</a>
                    </div>
                    <div style="position:absolute;right:2.5rem;bottom:0;height:85%;z-index:1;display:flex;align-items:flex-end;gap:0.8rem;">
                        <img src="{{ asset('sendiri.jpg') }}" alt="Sendiri" style="height:85%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.5);">
                        <img src="{{ asset('pergi.png') }}" alt="Pergi" style="height:70%;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.4);transform:rotate(2deg);">
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="slider-btn prev" @click="prev()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="slider-btn next" @click="next()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
            </button>

            <div class="slider-dots">
                <template x-for="i in total" :key="i">
                    <button class="dot" :class="active === i-1 ? 'active' : ''" @click="goTo(i-1)"></button>
                </template>
            </div>
        </div>

        <!-- Side Banners -->
        <div class="side-banners">
            <a href="#products" class="side-banner side-banner-1">
                <span>Spesial</span>
                <h3>Flash Sale Setiap Rabu</h3>
                <p>Diskon s/d 40% untuk buku pilihan</p>
                <div class="side-banner-icon">⚡</div>
            </a>
            <a href="#products" class="side-banner side-banner-2">
                <span>Rekomendasi</span>
                <h3>Buku Terlaris Minggu Ini</h3>
                <p>Lihat apa yang dibaca orang-orang</p>
                <div class="side-banner-icon">📖</div>
            </a>
        </div>
    </div>
</section>


<div class="features-bar">
    <div class="features-inner">
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </div>
            <div>
                <h4>Pengiriman Cepat</h4>
                <p>Sampai dalam 1–3 hari kerja</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
            </div>
            <div>
                <h4>100% Original</h4>
                <p>Garansi buku asli & berlisensi</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <h4>Gratis Ongkir</h4>
                <p>Pembelian di atas Rp 150.000</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div>
                <h4>Dukungan 24/7</h4>
                <p>Tim siap membantu kapan saja</p>
            </div>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════
     FEATURED BOOKS
════════════════════════════════════════ -->
<section class="books-section" id="products">
    <div class="container-xl">
        <div class="section-header">
            <div>
                <h2 class="section-title">Buku Pilihan Kami</h2>
                <p class="section-subtitle">Koleksi best-seller yang wajib ada di rak bukumu</p>
            </div>
            <a href="/dashboard" class="see-all">
                Lihat Semua
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="book-grid">

            <a href="#" class="book-card">
                <span class="badge-best">Best Seller</span>
                <div class="card-img-wrap">
                    <img src="{{ asset('komet.jpg') }}" alt="Komet">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Tere Liye</p>
                    <h3 class="card-title">Komet</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 98.100</span>
                        <span class="card-price-old">Rp 120.000</span>
                    </div>
                </div>
            </a>

            <a href="#" class="book-card">
                <div class="card-img-wrap">
                    <img src="{{ asset('sendiri.jpg') }}" alt="Sendiri">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Tere Liye</p>
                    <h3 class="card-title">Sendiri</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 98.100</span>
                    </div>
                </div>
            </a>

            <a href="#" class="book-card">
                <span class="badge-best">Best Seller</span>
                <div class="card-img-wrap">
                    <img src="{{ asset('bintang.jpg') }}" alt="Bintang">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Tere Liye</p>
                    <h3 class="card-title">Bintang</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 98.100</span>
                    </div>
                </div>
            </a>

            <a href="#" class="book-card">
                <span class="card-badge-discount">-18%</span>
                <div class="card-img-wrap">
                    <img src="{{ asset('pergi.png') }}" alt="Pergi">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Tere Liye</p>
                    <h3 class="card-title">Pergi</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 98.100</span>
                        <span class="card-price-old">Rp 120.000</span>
                    </div>
                </div>
            </a>

            <a href="#" class="book-card">
                <div class="card-img-wrap">
                    <img src="{{ asset('cantikituluka.jpg') }}" alt="Cantik itu Luka">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Eka Kurniawan</p>
                    <h3 class="card-title">Cantik itu Luka</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 75.200</span>
                    </div>
                </div>
            </a>

            <a href="#" class="book-card">
                <span class="badge-best">Best Seller</span>
                <div class="card-img-wrap">
                    <img src="{{ asset('hujan.jpg') }}" alt="Hujan">
                </div>
                <div class="card-overlay">+ Keranjang</div>
                <div class="card-body">
                    <p class="card-author">Tere Liye</p>
                    <h3 class="card-title">Hujan</h3>
                    <div class="card-price-row">
                        <span class="card-price">Rp 92.000</span>
                    </div>
                </div>
            </a>

        </div>
    </div>
</section>

<div class="promo-banner">
    <div class="promo-inner">
        <div class="promo-text">
            <h2>Dapatkan Penawaran Eksklusif</h2>
            <p>Daftar newsletter kami dan nikmati diskon 10% untuk pembelian pertamamu.</p>
        </div>
        <div class="promo-form">
            <input type="email" placeholder="Masukkan email kamu…">
            <button type="button">Daftar Sekarang</button>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════
     ABOUT SECTION
════════════════════════════════════════ -->


@endsection
