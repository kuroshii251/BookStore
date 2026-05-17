<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookPedia – Toko Buku Online Terpercaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        :root {
            --cream: #faf7f2;
            --warm-white: #fffefb;
            --charcoal: #1c1c1e;
            --navy: #0f2240;
            --gold: #c9973a;
            --gold-light: #e8b95a;
            --muted: #6b6b6b;
            --border: #e8e0d4;
            --red-promo: #d63031;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
font-family:Arial, sans-serif;
            background-color: var(--warm-white);
            color: var(--charcoal);
        }

        .top-bar {
            background-color: var(--navy);
            color: #cbd5e1;
            font-size: 0.78rem;
            padding: 0.45rem 0;
            text-align: center;
            letter-spacing: 0.03em;
        }
        .top-bar a { color: var(--gold-light); text-decoration: none; font-weight: 600; }

       header {
            background: var(--warm-white);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 12px rgba(0,0,0,0.06);
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            height: 68px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            flex-shrink: 0;
        }
        .logo img { width: 36px; height: 36px; object-fit: contain; }
        .logo-text {
            font-family: 'Arial', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -0.02em;
        }

        .guest-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .guest-nav a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            transition: all 0.18s;
        }
        .guest-nav a:hover { color: var(--navy); background: var(--cream); }

        .search-form {
            flex: 1;
            max-width: 440px;
            display: flex;
            align-items: center;
            background: var(--cream);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        .search-form:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,151,58,0.12);
        }
        .search-form input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            font-family: Arial, sans-serif;
            color: var(--charcoal);
            outline: none;
        }
        .search-form input::placeholder { color: #b0a99e; }
        .search-form button {
            background: var(--navy);
            border: none;
            color: white;
            padding: 0 1.1rem;
            height: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.18s;
        }
        .search-form button:hover { background: var(--gold); }

        .auth-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: auto;
            flex-shrink: 0;
        }
        .auth-nav a {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--charcoal);
            text-decoration: none;
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            transition: background 0.15s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .auth-nav a:hover { background: var(--cream); }
        .auth-nav a.icon-link {
            position: relative;
            padding: 0.5rem;
        }
        .auth-nav .badge {
            position: absolute;
            top: 2px; right: 2px;
            background: var(--red-promo);
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
            width: 16px; height: 16px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-logout {
            background: var(--charcoal);
            color: white !important;
            padding: 0.5rem 1.1rem !important;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            transition: background 0.18s;
        }
        .btn-logout:hover { background: #333 !important; }
        .btn-login {
            background: var(--navy);
            color: white !important;
            padding: 0.5rem 1.3rem !important;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: background 0.18s;
        }
        .btn-login:hover { background: var(--gold) !important; }

        /* ── CATEGORY NAV ── */
        .cat-nav {
            background: var(--cream);
            border-bottom: 1px solid var(--border);
        }
        .cat-nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .cat-nav-inner::-webkit-scrollbar { display: none; }
        .cat-nav a {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 0.65rem 1rem;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
            transition: all 0.15s;
            flex-shrink: 0;
        }
        .cat-nav a:hover, .cat-nav a.active {
            color: var(--navy);
            border-bottom-color: var(--gold);
        }

        /* ── MAIN CONTENT ── */
        main {
            min-height: 60vh;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: #94a3b8;
            padding: 3.5rem 0 1.5rem;
            margin-top: 5rem;
        }
        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem;
        }
        .footer-brand .logo-text { font-size: 1.6rem; }
        .footer-brand p {
            font-size: 0.85rem;
            line-height: 1.7;
            margin-top: 0.8rem;
            color: #7a8ea3;
        }
        .footer-col h4 {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            letter-spacing: 0.03em;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.55rem; }
        .footer-col ul li a {
            color: #7a8ea3;
            text-decoration: none;
            font-size: 0.84rem;
            transition: color 0.15s;
        }
        .footer-col ul li a:hover { color: var(--gold-light); }
        .footer-bottom {
            max-width: 1280px;
            margin: 2.5rem auto 0;
            padding: 1.5rem 1.5rem 0;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: #4a5568;
        }

        @media (max-width: 768px) {
            .guest-nav { display: none; }
            .footer-inner { grid-template-columns: 1fr 1fr; }
            .header-inner { gap: 0.75rem; }
        }
        @media (max-width: 480px) {
            .footer-inner { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        Gratis ongkir untuk pembelian di atas Rp 150.000 &nbsp;·&nbsp; <a href="#">Lihat Promo</a>
    </div>

    <header>
        <div class="header-inner">
            <a href="/" class="logo">
                <img src="{{ asset('logo.png') }}" alt="BookPedia Logo">
                <h1 class="text-md font-bold">Bookpedia</span></h1>
            </a>

            @auth
                <form action="/dashboard" method="GET" class="search-form">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, atau ISBN…">
                    <button type="submit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        Cari
                    </button>
                </form>

                <div class="auth-nav">
                    <a href="/dashboard/chat" title="Chat">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </a>
                    <a href="/dashboard/order" title="Pesanan">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 11V7a4 4 0 0 0-8 0v4"/><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/></svg>
                    </a>
                    <a href="/dashboard/cart" class="icon-link" title="Keranjang">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <span class="badge">3</span>
                    </a>
                    <form action="/logout" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn-logout">Keluar</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="guest-nav">
                    <a href="#about">About</a>
                    <a href="#products">Product</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="auth-nav">
                    <a href="/login" class="btn-login">Sign In</a>
                </div>
            @endguest
        </div>
    </header>

    @guest
    <nav class="cat-nav">
        <div class="cat-nav-inner">
            <a href="#" class="active">Semua Kategori</a>
            <a href="#">Novel</a>
            <a href="#">Non-Fiksi</a>
            <a href="#">Bisnis & Ekonomi</a>
            <a href="#">Pengembangan Diri</a>
            <a href="#">Sains & Teknologi</a>
            <a href="#">Anak & Remaja</a>
            <a href="#">Komik & Manga</a>
            <a href="#">Agama & Spiritual</a>
            <a href="#">Pendidikan</a>
        </div>
    </nav>
    @endguest

    <main>
        @yield('contents')
    </main>

    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="logo-text" style="color:white;">Book<span class="text-blue-500">Pedia</span></span>
                <p>Temukan ribuan judul buku pilihan dengan harga terbaik. Kami menghadirkan pengalaman berbelanja buku yang mudah, cepat, dan menyenangkan.</p>
                <div style="display:flex;gap:0.75rem;margin-top:1.2rem;">
                    <a href="#" style="color:#7a8ea3;transition:color 0.15s;" onmouseover="this.style.color='#e8b95a'" onmouseout="this.style.color='#7a8ea3'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" style="color:#7a8ea3;transition:color 0.15s;" onmouseover="this.style.color='#e8b95a'" onmouseout="this.style.color='#7a8ea3'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Press</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Cara Belanja</a></li>
                    <li><a href="#">Pengiriman</a></li>
                    <li><a href="#">Pengembalian</a></li>
                    <li><a href="#">Lacak Pesanan</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2025 BookPedia. Hak cipta dilindungi.</span>
            <div style="display:flex;gap:1rem;align-items:center;">
                <img src="https://via.placeholder.com/40x24/ffffff/0f2240?text=VISA" alt="Visa" style="border-radius:4px;opacity:0.6;height:20px;">
                <img src="https://via.placeholder.com/40x24/ffffff/0f2240?text=BCA" alt="BCA" style="border-radius:4px;opacity:0.6;height:20px;">
                <img src="https://via.placeholder.com/40x24/ffffff/0f2240?text=OVO" alt="OVO" style="border-radius:4px;opacity:0.6;height:20px;">
            </div>
        </div>
    </footer>

</body>
</html>
