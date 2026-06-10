<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Product Marketplace - Browse our collection">
    <meta name="author" content="Antigravity Developer">
    <title>Products Marketplace | Laravel CRUD Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --border-hover: #cbd5e1;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --accent: #f97316;
            --star: #f59e0b;
            --text-main: #0f172a;
            --text-muted: #475569;
            --text-light: #94a3b8;
            --border-radius-lg: 12px;
            --border-radius-md: 8px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition-smooth: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ---- HEADER ---- */
        .header {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .header-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: white;
            stroke-width: 2.5;
        }

        .logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .search-box {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 9999px;
            font-size: 0.9rem;
            font-family: inherit;
            background: #f8fafc;
            transition: var(--transition-smooth);
            color: var(--text-main);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .search-box .search-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            pointer-events: none;
        }

        .search-box .search-icon svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-shrink: 0;
        }

        .btn-cart {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: var(--transition-smooth);
            color: var(--text-main);
        }

        .btn-cart:hover {
            background: #f1f5f9;
        }

        .btn-cart svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .cart-badge {
            position: absolute;
            top: 0;
            right: -2px;
            background: var(--accent);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.85rem;
            background: #fff5f5;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            font-family: inherit;
        }

        .btn-logout:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .btn-logout svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        /* ---- CATEGORY PILLS ---- */
        .category-bar {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            gap: 0.6rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .category-bar::-webkit-scrollbar {
            display: none;
        }

        .category-pill {
            padding: 0.45rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 9999px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap;
            cursor: pointer;
            transition: var(--transition-smooth);
            background: var(--bg-card);
            flex-shrink: 0;
        }

        .category-pill:hover,
        .category-pill.active {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        /* ---- MAIN ---- */
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 1.5rem;
            flex-grow: 1;
            width: 100%;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .section-count {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* ---- PRODUCT GRID ---- */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.25rem;
            padding-bottom: 2rem;
        }

        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            box-shadow: var(--shadow-xl);
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .product-image {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image svg {
            width: 60px;
            height: 60px;
            stroke: #cbd5e1;
            stroke-width: 1.5;
            fill: none;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 0.65rem;
            left: 0.65rem;
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-discount {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-new {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-bestseller {
            background: #fff7ed;
            color: #ea580c;
        }

        .product-wishlist {
            position: absolute;
            top: 0.65rem;
            right: 0.65rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .product-wishlist svg {
            width: 16px;
            height: 16px;
            stroke: #94a3b8;
            stroke-width: 2;
            fill: none;
        }

        .product-wishlist:hover {
            background: #fef2f2;
        }

        .product-wishlist:hover svg {
            stroke: #dc2626;
        }

        .product-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .product-store {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .product-store svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .product-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.5rem;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .stars {
            display: flex;
            gap: 1px;
        }

        .stars svg {
            width: 14px;
            height: 14px;
        }

        .star-filled {
            fill: var(--star);
            stroke: var(--star);
            stroke-width: 1;
        }

        .star-empty {
            fill: none;
            stroke: #d1d5db;
            stroke-width: 1;
        }

        .rating-count {
            color: var(--text-light);
        }

        .product-footer {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 0.5rem;
        }

        .product-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--accent);
        }

        .product-price-original {
            font-size: 0.75rem;
            color: var(--text-light);
            text-decoration: line-through;
            font-weight: 400;
            margin-left: 0.4rem;
        }

        .btn-buy {
            padding: 0.45rem 0.9rem;
            background: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: var(--border-radius-md);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-buy:hover {
            background: var(--primary-hover);
        }

        .btn-buy svg {
            width: 15px;
            height: 15px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        /* ---- FOOTER ---- */
        footer {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            border-top: 1px solid var(--border-color);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-inner">
            <div class="logo-area">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                <span class="logo-text">MarketHub</span>
            </div>

            <div class="search-box">
                <span class="search-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </span>
                <input type="text" placeholder="Cari produk...">
            </div>

            <div class="header-actions">
                <button class="btn-cart">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                    </svg>
                    <span class="cart-badge">3</span>
                </button>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Category Pills -->
    <div class="category-bar">
        <span class="category-pill active">Semua</span>
        <span class="category-pill">Elektronik</span>
        <span class="category-pill">Fashion</span>
        <span class="category-pill">Makanan & Minuman</span>
        <span class="category-pill">Olahraga</span>
        <span class="category-pill">Otomotif</span>
        <span class="category-pill">Hobi & Koleksi</span>
        <span class="category-pill">Kecantikan</span>
        <span class="category-pill">Buku</span>
    </div>

    <!-- Product Grid -->
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Produk Terlaris</h2>
            <span class="section-count">32 produk</span>
        </div>

        <div class="product-grid">
            {{-- Card Template -- repeated for demo --}}

            <!-- 1 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-discount">-25%</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2" /><line x1="8" y1="21" x2="16" y2="21" /><line x1="12" y1="17" x2="12" y2="21" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        TechMart Official
                    </div>
                    <h3 class="product-name">Laptop Gaming Pro X15 - Intel i7 Gen 13, RTX 4060, 16GB RAM, 512GB SSD</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.9</span>
                        <span class="rating-count">| 2.1rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <div>
                            <span class="product-price">Rp 15.999.000</span>
                            <span class="product-price-original">Rp 21.499.000</span>
                        </div>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 2 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-new">Baru</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2" /><line x1="12" y1="18" x2="12.01" y2="18" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        GadgetZone
                    </div>
                    <h3 class="product-name">Samsung Galaxy S24 Ultra 5G - 256GB, Titanium Black, Garansi Resmi</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-empty" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.7</span>
                        <span class="rating-count">| 856 terjual</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">Rp 21.999.000</span>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 3 -->
            <article class="product-card">
                <div class="product-image">
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        FashionHub
                    </div>
                    <h3 class="product-name">Sepatu Running UltraBoost X - Breathable Mesh, Cushioning Technology</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>5.0</span>
                        <span class="rating-count">| 3.4rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <div>
                            <span class="product-price">Rp 1.299.000</span>
                            <span class="product-price-original">Rp 1.899.000</span>
                        </div>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 4 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-bestseller">Best Seller</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" /><polyline points="3.27 6.96 12 12.01 20.73 6.96" /><line x1="12" y1="22.08" x2="12" y2="12" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        HealthyChoice
                    </div>
                    <h3 class="product-name">Premium Whey Protein Isolate 2kg - Vanilla, 28g Protein per Serving</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-empty" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.6</span>
                        <span class="rating-count">| 12.5rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">Rp 699.000</span>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 5 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-discount">-50%</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2" /><line x1="8" y1="21" x2="16" y2="21" /><line x1="12" y1="17" x2="12" y2="21" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        TechMart Official
                    </div>
                    <h3 class="product-name">Monitor Gaming 27" Curved 165Hz - QHD, 1ms Response, FreeSync</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.9</span>
                        <span class="rating-count">| 648 terjual</span>
                    </div>
                    <div class="product-footer">
                        <div>
                            <span class="product-price">Rp 2.599.000</span>
                            <span class="product-price-original">Rp 5.199.000</span>
                        </div>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 6 -->
            <article class="product-card">
                <div class="product-image">
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        FashionHub
                    </div>
                    <h3 class="product-name">Jaket Hoodie Premium Oversized - Cotton Fleece, Unisex, 6 Warna</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-empty" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.5</span>
                        <span class="rating-count">| 7.8rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">Rp 279.000</span>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 7 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-new">Baru</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" /><polyline points="3.27 6.96 12 12.01 20.73 6.96" /><line x1="12" y1="22.08" x2="12" y2="12" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        HealthyChoice
                    </div>
                    <h3 class="product-name">Air Fryer Digital 6.5L - Low Fat Fryer, 8 Menu Programs, Non-Stick</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-empty" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.5</span>
                        <span class="rating-count">| 1.2rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <div>
                            <span class="product-price">Rp 899.000</span>
                            <span class="product-price-original">Rp 1.499.000</span>
                        </div>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

            <!-- 8 -->
            <article class="product-card">
                <div class="product-image">
                    <span class="product-badge badge-bestseller">Best Seller</span>
                    <button class="product-wishlist">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>
                    </button>
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2" /><line x1="8" y1="21" x2="16" y2="21" /><line x1="12" y1="17" x2="12" y2="21" /></svg>
                </div>
                <div class="product-body">
                    <div class="product-store">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
                        GadgetZone
                    </div>
                    <h3 class="product-name">Wireless Earbuds ANC Pro - Active Noise Cancelling, 36H Battery, IPX5</h3>
                    <div class="product-rating">
                        <div class="stars">
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            <svg class="star-filled" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                        </div>
                        <span>4.9</span>
                        <span class="rating-count">| 18.2rb terjual</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">Rp 499.000</span>
                        <button class="btn-buy">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Beli
                        </button>
                    </div>
                </div>
            </article>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 MarketHub. All rights reserved.</p>
    </footer>
</body>

</html>
