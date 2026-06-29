<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shop->name }} — {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .page-content {
            padding-top: var(--nav-h);
        }

        /* ── STORE HEADER ── */
        .store-header {
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .store-header::before {
            content: '';
            position: absolute;
            right: -100px;
            top: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(253, 116, 0, .18) 0%, transparent 70%);
        }

        .store-banner {
            height: 220px;
            background: linear-gradient(135deg, #FD7400 0%, #ff9944 60%, #2E353D 100%);
            position: relative;
        }

        .store-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(46, 53, 61, .6) 100%);
        }

        .store-header-body {
            padding: 0 0 32px;
        }

        .store-identity {
            display: flex;
            align-items: flex-end;
            gap: 24px;
            margin-top: -40px;
            position: relative;
            z-index: 2;
            padding: 0 0 24px;
        }

        .store-logo-big {
            width: 88px;
            height: 88px;
            border-radius: var(--radius-lg);
            border: 4px solid var(--white);
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            box-shadow: var(--shadow-lg);
            flex-shrink: 0;
        }

        .store-identity-info {
            flex: 1;
        }

        .store-identity-name {
            font-family: var(--font-display);
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .store-identity-sub {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        .store-identity-sub span {
            font-size: .8rem;
            color: rgba(255, 255, 255, .6);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .store-identity-sub .badge-verified {
            background: rgba(16, 185, 129, .85);
            color: white;
            font-size: .68rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .store-header-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .store-nav {
            display: flex;
            gap: 0;
            border-top: 1px solid rgba(255, 255, 255, .1);
            margin-top: 0;
            overflow-x: auto;
        }

        .store-nav-link {
            padding: 14px 20px;
            font-size: .85rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .5);
            cursor: pointer;
            transition: all .18s;
            white-space: nowrap;
            border-bottom: 2.5px solid transparent;
        }

        .store-nav-link:hover {
            color: rgba(255, 255, 255, .85);
        }

        .store-nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* ── LAYOUT ── */
        .store-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 28px;
            padding: 32px 0 72px;
            align-items: start;
        }

        /* ── ABOUT CARD ── */
        .info-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 24px;
        }

        .info-card-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-title i {
            color: var(--primary);
        }

        /* stat strip */
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .stat-strip-item {
            background: var(--white);
            padding: 16px 12px;
            text-align: center;
        }

        .stat-strip-num {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-strip-lbl {
            font-size: .72rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        /* Products section */
        .section-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title-row h3 {
            font-size: 1.1rem;
        }

        .store-products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        /* Review card */
        .review-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px;
            margin-bottom: 14px;
        }

        .rev-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .rev-avatar {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .rev-name {
            font-weight: 600;
            font-size: .88rem;
            color: var(--dark);
        }

        .rev-date {
            font-size: .72rem;
            color: var(--dark-light);
        }

        .rev-stars {
            margin-left: auto;
        }

        .rev-text {
            font-size: .85rem;
            color: var(--dark-mid);
            line-height: 1.7;
        }

        .rev-product {
            font-size: .72rem;
            color: var(--primary);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Sidebar sticky card */
        .sidebar-sticky {
            position: sticky;
            top: calc(var(--nav-h)+16px);
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .wa-contact-card {
            background: linear-gradient(135deg, #25D366, #1eb857);
            border-radius: var(--radius-lg);
            padding: 24px;
            text-align: center;
            box-shadow: 0 6px 24px rgba(37, 211, 102, .3);
        }

        .wa-contact-card .icon {
            font-size: 2.8rem;
            margin-bottom: 10px;
        }

        .wa-contact-card h4 {
            color: white;
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .wa-contact-card p {
            color: rgba(255, 255, 255, .75);
            font-size: .8rem;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .btn-wa-full {
            width: 100%;
            padding: 13px;
            background: white;
            color: #25D366;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: .95rem;
            font-family: var(--font-display);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .2s;
        }

        .btn-wa-full:hover {
            background: #f0fdf4;
            transform: translateY(-1px);
        }

        /* Store info list */
        .store-info-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .store-info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: .85rem;
        }

        .store-info-icon {
            width: 30px;
            height: 30px;
            background: var(--primary-light);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: .8rem;
            flex-shrink: 0;
        }

        .store-info-key {
            font-weight: 600;
            color: var(--dark);
            font-size: .78rem;
        }

        .store-info-value {
            color: var(--dark-mid);
            font-size: .82rem;
        }

        /* Rating breakdown */
        .rating-big {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 16px;
        }

        .rating-num {
            font-family: var(--font-display);
            font-size: 3rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }

        .rating-bars {
            flex: 1;
        }

        .r-row {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
            font-size: .75rem;
        }

        .r-bar-wrap {
            flex: 1;
            height: 5px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
        }

        .r-bar {
            height: 100%;
            background: #fbbf24;
            border-radius: 3px;
        }

        .r-pct {
            width: 28px;
            color: var(--dark-light);
            text-align: right;
        }

        /* Tab panels */
        .tab-nav {
            display: flex;
            border-bottom: 1.5px solid var(--border);
            margin-bottom: 20px;
        }

        .tab-link {
            padding: 11px 18px;
            font-size: .85rem;
            font-weight: 600;
            color: var(--dark-light);
            cursor: pointer;
            border-bottom: 2.5px solid transparent;
            margin-bottom: -1.5px;
            transition: all .18s;
        }

        .tab-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /* Operational hours */
        .hours-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            font-size: .82rem;
            padding: 6px 0;
            border-bottom: 1px solid var(--border);
        }

        .hours-row:last-child {
            border-bottom: none;
        }

        .hours-day {
            color: var(--dark);
            font-weight: 500;
        }

        .hours-time {
            color: var(--dark-mid);
        }

        .hours-closed {
            color: var(--danger);
        }

        @media (max-width: 900px) {
            .store-layout {
                grid-template-columns: 1fr;
            }

            .sidebar-sticky {
                position: static;
            }

            .store-products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-strip {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 540px) {
            .store-products-grid {
                grid-template-columns: 1fr;
            }

            .store-identity {
                flex-direction: column;
                align-items: flex-start;
                margin-top: -20px;
            }
        }
    </style>
</head>

<body>

    <!-- ═══ NAVBAR ═══ -->
    @include('layouts.partials.navbar')

    <div class="page-content">

        <!-- ══ STORE HEADER ══ -->
        <div class="store-header">
            <div class="store-banner">
                <div class="store-banner-overlay"></div>
            </div>

            <div class="container">
                <div class="store-header-body">
                    <div class="store-identity">
                        <div class="store-logo-big">{{ $shop->logo ?: '🏪' }}</div>
                        <div class="store-identity-info">
                            <div class="store-identity-name">{{ $shop->name }}</div>
                            <div class="store-identity-sub">
                                @if ($shop->status === 'approved')
                                    <span class="badge-verified"><i class="fa-solid fa-circle-check fa-xs"></i>
                                        Terverifikasi</span>
                                @endif
                                <span><i class="fa-solid fa-location-dot fa-xs"></i> {{ $shop->district }}</span>
                                <span><i class="fa-solid fa-store fa-xs"></i> Bergabung
                                    {{ $shop->created_at ? $shop->created_at->format('M Y') : 'Baru saja' }}</span>
                                <span><i class="fa-solid fa-star fa-xs" style="color:#fbbf24;"></i> {{ $averageRating }}
                                    · {{ $totalReviews }}
                                    ulasan</span>
                            </div>
                        </div>
                        <div class="store-header-actions" style="flex-shrink:0;">
                            <button class="btn btn-wa btn-sm" onclick="chatWA()">
                                <i class="fa-brands fa-whatsapp"></i> Chat WA
                            </button>
                            <button class="btn btn-ghost btn-sm" id="follow-btn" onclick="toggleFollow(this)"
                                style="color:rgba(255,255,255,.7);border:1.5px solid rgba(255,255,255,.2);">
                                <i class="fa-regular fa-heart"></i> Ikuti
                            </button>
                            <button class="btn btn-ghost btn-sm"
                                style="color:rgba(255,255,255,.7);border:1.5px solid rgba(255,255,255,.2);">
                                <i class="fa-solid fa-share-nodes"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Store sub-navigation -->
                    <div class="store-nav">
                        <div class="store-nav-link active" onclick="switchStoreTab('produk',this)">Semua Produk</div>
                        <div class="store-nav-link" onclick="switchStoreTab('tentang',this)">Tentang Toko</div>
                        <div class="store-nav-link" onclick="switchStoreTab('ulasan',this)">Ulasan ({{ $totalReviews }})
                        </div>
                        <div class="store-nav-link" onclick="switchStoreTab('galeri',this)">Galeri</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ MAIN LAYOUT ══ -->
        <div class="container">
            <div class="store-layout">

                <!-- ── LEFT: TAB PANELS ── -->
                <main>
                    <!-- Stat strip (always visible) -->
                    <div class="stat-strip">
                        <div class="stat-strip-item">
                            <div class="stat-strip-num">{{ $products->count() }}</div>
                            <div class="stat-strip-lbl">Total Produk</div>
                        </div>
                        <div class="stat-strip-item">
                            <div class="stat-strip-num">320+</div>
                            <div class="stat-strip-lbl">Transaksi</div>
                        </div>
                        <div class="stat-strip-item">
                            <div class="stat-strip-num">{{ $averageRating }}⭐</div>
                            <div class="stat-strip-lbl">Rating</div>
                        </div>
                        <div class="stat-strip-item">
                            <div class="stat-strip-num">&lt; 1 Jam</div>
                            <div class="stat-strip-lbl">Respon WA</div>
                        </div>
                    </div>

                    <!-- ── PRODUK TAB ── -->
                    <div class="tab-panel active" id="tab-produk">
                        <div class="section-title-row">
                            <h3>Produk Toko</h3>
                            <div style="display:flex;gap:8px;align-items:center;">
                                <select class="sort-sel"
                                    style="padding:7px 10px;font-size:.8rem;border:1.5px solid var(--border);border-radius:var(--radius-sm);outline:none;font-family:var(--font-body);background:var(--white);">
                                    <option>Terbaru</option>
                                    <option>Terlaris</option>
                                    <option>Harga ↑</option>
                                    <option>Harga ↓</option>
                                </select>
                            </div>
                        </div>

                        <!-- Category filter mini -->
                        <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:16px;">
                            <div class="tag active" style="font-size:.75rem;padding:4px 10px;"
                                onclick="setProdCat(this)">Semua</div>
                            <div class="tag" style="font-size:.75rem;padding:4px 10px;" onclick="setProdCat(this)">
                                Kue Kering</div>
                            <div class="tag" style="font-size:.75rem;padding:4px 10px;" onclick="setProdCat(this)">
                                Hampers</div>
                            <div class="tag" style="font-size:.75rem;padding:4px 10px;" onclick="setProdCat(this)">
                                Minuman</div>
                        </div>

                        <div class="store-products-grid" id="store-prod-grid"></div>

                        <div style="display:flex;justify-content:center;margin-top:24px;">
                            <div class="pagination">
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                            </div>
                        </div>
                    </div>

                    <!-- ── TENTANG TAB ── -->
                    <div class="tab-panel" id="tab-tentang">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fa-solid fa-circle-info"></i> Tentang
                                {{ $shop->name }}</div>
                            <p style="line-height:1.8;margin-bottom:16px;">
                                {{ $shop->description ?: 'Toko ini belum menambahkan deskripsi.' }}
                            </p>
                            <div style="display:flex;gap:16px;flex-wrap:wrap;">
                                <div class="badge badge-success"><i class="fa-solid fa-certificate fa-xs"></i>
                                    Sertifikat PIRT</div>
                                <div class="badge badge-primary"><i class="fa-solid fa-leaf fa-xs"></i> Tanpa Pengawet
                                </div>
                                <div class="badge badge-dark"><i class="fa-solid fa-medal fa-xs"></i> Juara 2 UMKM
                                    Jateng 2024</div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-card-title"><i class="fa-solid fa-clock"></i> Jam Operasional</div>
                            <div class="hours-grid">
                                @if (is_array($shop->operational_hours) && count($shop->operational_hours) > 0)
                                    @php
                                        // Bagi hari menjadi 2 kolom (misal: 4 hari pertama, sisanya di kolom kedua)
                                        $firstCol = array_slice($shop->operational_hours, 0, 4);
                                        $secondCol = array_slice($shop->operational_hours, 4);
                                    @endphp

                                    <div>
                                        @foreach ($firstCol as $hour)
                                            <div class="hours-row">
                                                <span class="hours-day">{{ $hour['day'] }}</span>
                                                @if (isset($hour['is_open']) && $hour['is_open'])
                                                    <span
                                                        class="hours-time">{{ str_replace(':', '.', $hour['open']) }}
                                                        – {{ str_replace(':', '.', $hour['close']) }}</span>
                                                @else
                                                    <span class="hours-closed">Tutup</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        @foreach ($secondCol as $hour)
                                            <div class="hours-row">
                                                <span class="hours-day">{{ $hour['day'] }}</span>
                                                @if (isset($hour['is_open']) && $hour['is_open'])
                                                    <span
                                                        class="hours-time">{{ str_replace(':', '.', $hour['open']) }}
                                                        – {{ str_replace(':', '.', $hour['close']) }}</span>
                                                @else
                                                    <span class="hours-closed">Tutup</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div style="grid-column: span 2; color: var(--dark-light); font-size: 0.9rem;">
                                        <em>Toko ini belum mengatur jam operasional.</em>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-card-title"><i class="fa-solid fa-truck"></i> Info Pengiriman</div>
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                <div style="display:flex;align-items:center;gap:10px;font-size:.85rem;">
                                    <div
                                        style="width:32px;height:32px;background:var(--primary-light);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
                                        🚗</div>
                                    <div><strong style="display:block;font-size:.82rem;">COD (Semarang &
                                            sekitarnya)</strong><span style="color:var(--dark-light);">Gratis ongkos
                                            kirim dalam kota</span></div>
                                </div>
                                <div style="display:flex;align-items:center;gap:10px;font-size:.85rem;">
                                    <div
                                        style="width:32px;height:32px;background:var(--primary-light);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
                                        📦</div>
                                    <div><strong style="display:block;font-size:.82rem;">Ekspedisi
                                            Nasional</strong><span style="color:var(--dark-light);">JNE, J&T, SiCepat,
                                            AnterAja</span></div>
                                </div>
                                <div style="display:flex;align-items:center;gap:10px;font-size:.85rem;">
                                    <div
                                        style="width:32px;height:32px;background:var(--primary-light);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
                                        🧊</div>
                                    <div><strong style="display:block;font-size:.82rem;">Kemasan Khusus</strong><span
                                            style="color:var(--dark-light);">Bubble wrap + kardus double untuk keamanan
                                            produk</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── ULASAN TAB ── -->
                    <div class="tab-panel" id="tab-ulasan">
                        <!-- Rating summary -->
                        <div class="info-card">
                            <div class="rating-big">
                                <div style="text-align:center;">
                                    <div class="rating-num">{{ $averageRating }}</div>
                                    <div class="stars" style="justify-content:center;margin:6px 0;">
                                        @for ($i = 0; $i < round($averageRating); $i++)
                                            ★
                                        @endfor
                                        @for ($i = round($averageRating); $i < 5; $i++)
                                            <span style="color:var(--border)">★</span>
                                        @endfor
                                    </div>
                                    <div style="font-size:.72rem;color:var(--dark-light);">{{ $totalReviews }} ulasan
                                    </div>
                                </div>
                                <div class="rating-bars">
                                    @for ($star = 5; $star >= 1; $star--)
                                        <div class="r-row"><span
                                                style="width:12px;color:var(--dark-mid);">{{ $star }}</span><span
                                                style="color:#fbbf24;font-size:.8rem;">★</span>
                                            <div class="r-bar-wrap">
                                                <div class="r-bar" style="width:{{ $ratingPercentages[$star] }}%;">
                                                </div>
                                            </div><span class="r-pct">{{ $ratingPercentages[$star] }}%</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div id="reviews-list"></div>
                        <button class="btn btn-outline w-full mt-16">Lihat Semua Ulasan</button>
                    </div>

                    <!-- ── GALERI TAB ── -->
                    <div class="tab-panel" id="tab-galeri">
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#fef3c7,#fed7aa);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">🍪</div>
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#fee2e2,#fecaca);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">🎁</div>
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#fce7f3,#fbcfe8);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">🧁</div>
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">🍰</div>
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#fffbeb,#fef3c7);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">🍩</div>
                            <div style="aspect-ratio:1;border-radius:var(--radius-md);background:linear-gradient(135deg,#ede9fe,#ddd6fe);display:flex;align-items:center;justify-content:center;font-size:3rem;border:1px solid var(--border);cursor:pointer;"
                                onclick="openGallery(this)">📦</div>
                        </div>
                    </div>
                </main>

                <!-- ── RIGHT: STICKY SIDEBAR ── -->
                <aside class="sidebar-sticky">
                    <!-- WA Contact -->
                    <div class="wa-contact-card">
                        <div class="icon">📲</div>
                        <h4>Chat Langsung dengan Penjual</h4>
                        <p>Tanyakan ketersediaan stok, harga grosir, atau detail produk langsung via WhatsApp.</p>
                        <button class="btn-wa-full" onclick="chatWA()">
                            <i class="fa-brands fa-whatsapp" style="font-size:1.2rem;"></i>
                            Chat WhatsApp Sekarang
                        </button>
                        <div style="margin-top:10px;font-size:.72rem;color:rgba(255,255,255,.6);">
                            <i class="fa-solid fa-clock fa-xs"></i> Biasanya membalas dalam &lt; 1 jam
                        </div>
                    </div>

                    <!-- Store info -->
                    <div class="info-card" style="margin-bottom:0;">
                        <div class="info-card-title"><i class="fa-solid fa-circle-info"></i> Info Toko</div>
                        <ul class="store-info-list">
                            <li class="store-info-item">
                                <div class="store-info-icon"><i class="fa-solid fa-location-dot fa-xs"></i></div>
                                <div>
                                    <div class="store-info-key">Alamat</div>
                                    <div class="store-info-value">{{ $shop->address }}</div>
                                </div>
                            </li>
                            <li class="store-info-item">
                                <div class="store-info-icon"><i class="fa-brands fa-whatsapp fa-xs"></i></div>
                                <div>
                                    <div class="store-info-key">WhatsApp</div>
                                    <div class="store-info-value">{{ $shop->whatsapp_number }}</div>
                                </div>
                            </li>
                            <li class="store-info-item">
                                <div class="store-info-icon"><i class="fa-solid fa-tag fa-xs"></i></div>
                                <div>
                                    <div class="store-info-key">Kategori Utama</div>
                                    <div class="store-info-value">{{ $shop->category }}</div>
                                </div>
                            </li>
                            <li class="store-info-item">
                                <div class="store-info-icon"><i class="fa-solid fa-calendar fa-xs"></i></div>
                                <div>
                                    <div class="store-info-key">Bergabung</div>
                                    <div class="store-info-value">
                                        {{ $shop->created_at ? $shop->created_at->format('M Y') : 'Baru Saja' }}</div>
                                </div>
                            </li>
                            <li class="store-info-item">
                                <div class="store-info-icon"><i class="fa-solid fa-truck fa-xs"></i></div>
                                <div>
                                    <div class="store-info-key">Jangkauan Kirim</div>
                                    <div class="store-info-value">Seluruh Indonesia</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Share card -->
                    <div class="info-card" style="margin-bottom:0;">
                        <div class="info-card-title" style="margin-bottom:12px;"><i
                                class="fa-solid fa-share-nodes"></i> Bagikan Toko</div>
                        <div style="display:flex;gap:8px;">
                            <button class="btn btn-outline btn-sm" style="flex:1;" onclick="copyLink()"><i
                                    class="fa-solid fa-link"></i> Salin Link</button>
                            <button class="share-btn"
                                style="width:36px;height:36px;border-radius:var(--radius-sm);border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.9rem;"
                                title="WhatsApp"><i class="fa-brands fa-whatsapp"
                                    style="color:#25D366;"></i></button>
                            <button class="share-btn"
                                style="width:36px;height:36px;border-radius:var(--radius-sm);border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.9rem;"
                                title="Instagram"><i class="fa-brands fa-instagram"
                                    style="color:#e1306c;"></i></button>
                        </div>
                        <div id="copy-msg"
                            style="display:none;font-size:.75rem;color:var(--success);margin-top:8px;text-align:center;">
                            <i class="fa-solid fa-check"></i> Link berhasil disalin!
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <footer style="background:var(--dark);padding:28px 0;text-align:center;">
        <div class="container">
            <p style="color:rgba(255,255,255,.4);font-size:.82rem;">© 2026 PasarLokal — Platform UMKM Indonesia</p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window
            .scrollY > 10));

        // ── Products ──
        const STORE_PRODS = {!! json_encode(
            $products->map(function ($p) {
                $img = $p->primaryImage->first();
                $primaryImg = $img ? \Illuminate\Support\Facades\Storage::url($img->image_path) : null;
                return [
                    'id' => $p->id,
                    'e' => '📦',
                    'bg' => 'linear-gradient(135deg,#f0fdf4,#dcfce7)',
                    'img_url' => $primaryImg,
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'price' => number_format($p->price, 0, ',', '.'),
                    'badge' => $p->is_featured ? 'Unggulan' : null,
                ];
            }),
        ) !!};

        document.getElementById('store-prod-grid').innerHTML = STORE_PRODS.map(p => `
    <a href="/produk/${p.slug}" class="product-card" style="cursor:pointer; text-decoration:none; color:inherit; display:flex; flex-direction:column;">
      <div class="product-card-img" style="position:relative;overflow:hidden;">
        <div style="width:100%;height:100%;background:${p.bg};display:flex;align-items:center;justify-content:center;font-size:2.8rem;">
            ${p.img_url ? `<img src="${p.img_url}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">` : p.e}
        </div>
        ${p.badge?`<div class="product-card-badge" style="background:var(--primary);">${p.badge}</div>`:''}
      </div>
      <div class="product-card-body">
        <div class="product-card-name">${p.name}</div>
        <div class="product-card-price">Rp ${p.price}</div>
      </div>
      <div class="product-card-actions" style="margin-top:auto;">
        <button class="btn btn-wa w-full btn-sm" onclick="event.preventDefault(); event.stopPropagation(); chatWA()"><i class="fa-brands fa-whatsapp"></i> Chat WA</button>
      </div>
    </a>
  `).join('');

        // ── Reviews ──
        const REVIEWS = [
            @foreach ($reviews as $r)
                {
                    initial: '{{ strtoupper(substr($r->user->name ?? 'U', 0, 1)) }}',
                    bg: '{{ ['var(--primary)', 'var(--dark)', '#8b5cf6', '#ef4444', '#10b981'][$loop->index % 5] }}',
                    name: '{!! addslashes($r->user->name ?? 'User') !!}',
                    date: '{{ $r->created_at->format('d M Y') }}',
                    stars: {{ $r->rating }},
                    text: '{!! addslashes(str_replace("\n", "\\n", $r->review_text)) !!}',
                    prod: '{!! addslashes($r->product->name ?? '') !!}'
                }
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ];
        document.getElementById('reviews-list').innerHTML = REVIEWS.map(r => `
    <div class="review-card">
      <div class="rev-header">
        <div class="rev-avatar" style="background:${r.bg};">${r.initial}</div>
        <div><div class="rev-name">${r.name}</div><div class="rev-date">${r.date}</div></div>
        <div class="rev-stars stars">${'★'.repeat(r.stars)}${'★'.repeat(5-r.stars).split('').map(()=>'<span style="color:var(--border)">★</span>').join('')}</div>
      </div>
      <p class="rev-text">${r.text}</p>
      <div class="rev-product"><i class="fa-solid fa-box fa-xs"></i> ${r.prod}</div>
    </div>
  `).join('');

        function switchStoreTab(tab, el) {
            document.querySelectorAll('.store-nav-link').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('tab-' + tab).classList.add('active');
        }

        function setProdCat(el) {
            document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }

        function chatWA() {
            @auth
            const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';
            const msg = 'Halo {{ $shop->name }}! Saya menemukan toko kamu di Laba UMKM dan ingin bertanya tentang produk kamu.';
            fetch('{{ route("whatsapp.log") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    shop_id: {{ $shop->id }},
                    message: msg
                })
            }).then(() => {
                window.open(`https://wa.me/{{ preg_replace('/^0/', '62', $shop->whatsapp_number) }}?text=${encodeURIComponent(msg)}`, '_blank');
            }).catch(() => {
                window.open(`https://wa.me/{{ preg_replace('/^0/', '62', $shop->whatsapp_number) }}?text=${encodeURIComponent(msg)}`, '_blank');
            });
        @else
            alert('Silakan login terlebih dahulu untuk menghubungi penjual.');
            window.location.href = "{{ route('login') }}";
        @endauth
        }

        function toggleFollow(btn) {
            const following = btn.dataset.following === '1';
            btn.dataset.following = following ? '' : '1';
            btn.innerHTML = following ? '<i class="fa-regular fa-heart"></i> Ikuti' :
                '<i class="fa-solid fa-heart" style="color:#ef4444;"></i> Mengikuti';
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href);
            const msg = document.getElementById('copy-msg');
            msg.style.display = 'block';
            setTimeout(() => msg.style.display = 'none', 2500);
        }

        function openGallery(el) {
            /* Lightbox placeholder */
        }
    </script>
</body>

</html>
