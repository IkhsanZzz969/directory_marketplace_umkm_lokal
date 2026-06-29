<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — PasarLokal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .page-content {
            padding-top: var(--nav-h);
        }

        .breadcrumb-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 12px 0;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: var(--dark-light);
        }

        .breadcrumb a {
            color: var(--dark-mid);
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb span {
            color: var(--border);
        }

        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 440px;
            gap: 40px;
            padding: 40px 0;
            align-items: start;
        }

        /* IMAGE GALLERY */
        .gallery-main {
            aspect-ratio: 1;
            border-radius: var(--radius-xl);
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            border: 1px solid var(--border);
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
        }

        .gallery-thumbnails {
            display: flex;
            gap: 10px;
        }

        .gallery-thumb {
            width: 72px;
            height: 72px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            cursor: pointer;
            border: 2px solid var(--border);
            transition: border-color .2s;
            background: var(--white);
        }

        .gallery-thumb.active {
            border-color: var(--primary);
        }

        .gallery-thumb:hover {
            border-color: var(--primary);
        }

        /* PRODUCT INFO */
        .product-info-panel {
            position: sticky;
            top: calc(var(--nav-h) + 16px);
        }

        .product-badges {
            display: flex;
            gap: 8px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .product-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .product-meta-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .product-views {
            font-size: 0.8rem;
            color: var(--dark-light);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .product-price-box {
            background: var(--primary-light);
            border: 1.5px solid rgba(253, 116, 0, 0.2);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .product-price-note {
            font-size: 0.78rem;
            color: var(--dark-light);
            margin-top: 4px;
        }

        .wa-cta-box {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
        }

        .wa-cta-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .wa-cta-msg {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--dark);
            resize: none;
            outline: none;
            margin-bottom: 12px;
            transition: border-color .2s;
        }

        .wa-cta-msg:focus {
            border-color: var(--success);
        }

        .qty-selector {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .qty-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark);
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .qty-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            color: var(--dark-mid);
            background: var(--bg);
            border: none;
            transition: background .18s;
        }

        .qty-btn:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .qty-num {
            width: 48px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            border-left: 1.5px solid var(--border);
            border-right: 1.5px solid var(--border);
        }

        .btn-wa-cta {
            width: 100%;
            padding: 16px;
            background: #25D366;
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1.05rem;
            font-weight: 700;
            font-family: var(--font-display);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all .22s;
            letter-spacing: .01em;
        }

        .btn-wa-cta:hover {
            background: #1eb857;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, .4);
        }

        .btn-wa-cta .wa-icon {
            font-size: 1.3rem;
        }

        .secondary-actions {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        /* SHOP CARD IN DETAIL */
        .shop-info-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
        }

        .shop-info-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .shop-info-logo {
            width: 52px;
            height: 52px;
            border-radius: var(--radius-md);
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .shop-info-name {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
        }

        .shop-info-district {
            font-size: 0.78rem;
            color: var(--dark-light);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .shop-info-stats {
            display: flex;
            gap: 0;
        }

        .shop-stat {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-right: 1px solid var(--border);
        }

        .shop-stat:last-child {
            border-right: none;
        }

        .shop-stat-num {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
            color: var(--dark);
        }

        .shop-stat-label {
            font-size: 0.7rem;
            color: var(--dark-light);
        }

        /* DESCRIPTION TABS */
        .desc-tabs {
            display: flex;
            border-bottom: 1.5px solid var(--border);
            margin-bottom: 24px;
        }

        .desc-tab {
            padding: 12px 20px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--dark-light);
            cursor: pointer;
            border-bottom: 2.5px solid transparent;
            margin-bottom: -1.5px;
            transition: all .2s;
        }

        .desc-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .desc-panel {
            display: none;
        }

        .desc-panel.active {
            display: block;
        }

        .spec-table {
            width: 100%;
        }

        .spec-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.88rem;
        }

        .spec-key {
            width: 160px;
            font-weight: 600;
            color: var(--dark);
            flex-shrink: 0;
        }

        .spec-val {
            color: var(--dark-mid);
        }

        /* RELATED PRODUCTS */
        .related-section {
            padding: 48px 0;
            background: var(--white);
            border-top: 1px solid var(--border);
        }

        /* SHARE */
        .share-row {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.82rem;
            color: var(--dark-mid);
        }

        .share-btn {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-full);
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s;
            font-size: 0.85rem;
        }

        .share-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        @media (max-width: 900px) {
            .product-detail-grid {
                grid-template-columns: 1fr;
            }

            .product-info-panel {
                position: static;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    @include('layouts.partials.navbar')


    <div class="page-content">
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html">Beranda</a><span>/</span>
                    <a href="catalog.html">Katalog</a><span>/</span>
                    <a
                        href="catalog.html?cat={{ Str::slug($product->category->name ?? 'lainnya') }}">{{ $product->category->name ?? 'Lainnya' }}</a><span>/</span>
                    <span style="color:var(--dark);">{{ $product->name }}</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="product-detail-grid">
                <!-- GALLERY -->
                <div>
                    <div class="gallery-main" id="gallery-main"
                        style="background:var(--bg);position:relative;overflow:hidden;">
                        @php $primaryImg = $product->images->where('is_primary', true)->first(); @endphp
                        @if ($primaryImg)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($primaryImg->image_path) }}"
                                id="main-img"
                                style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                        @else
                            <div id="main-img-emoji"
                                style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8rem;">
                                📦</div>
                        @endif
                    </div>

                    @if ($product->images->count() > 0)
                        <div class="gallery-thumbnails">
                            @foreach ($product->images as $index => $img)
                                <div class="gallery-thumb {{ $index === 0 ? 'active' : '' }}"
                                    onclick="changeMainImg(this,'{{ \Illuminate\Support\Facades\Storage::url($img->image_path) }}')"
                                    style="position:relative;overflow:hidden;">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($img->image_path) }}"
                                        style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- INFO PANEL -->
                <div class="product-info-panel">
                    <!-- Badges -->
                    <div class="product-badges">
                        @if ($product->is_featured)
                            <span class="badge badge-primary">🔥 Unggulan</span>
                        @endif
                        @if ($product->shop->status === 'approved')
                            <span class="badge badge-success">✅ Toko Terverifikasi</span>
                        @endif
                    </div>

                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="product-meta-row">
                        <div class="stars" style="color:#fbbf24;">
                            @php
                                $avgRating = $product->reviews->avg('rating') ?: 0;
                                $totalReviews = $product->reviews->count();
                                $roundedAvg = round($avgRating);
                            @endphp
                            @for($i = 0; $i < $roundedAvg; $i++)★@endfor
                            @for($i = $roundedAvg; $i < 5; $i++)<span style="color:var(--border);">★</span>@endfor
                        </div>
                        <span style="font-size:0.82rem;color:var(--dark-mid);">{{ number_format($avgRating, 1) }} <span
                                style="color:var(--dark-light)">({{ $totalReviews }} ulasan)</span></span>
                        <div class="product-views"><i class="fa-regular fa-eye"></i>
                            {{ number_format($product->views_count, 0, ',', '.') }} dilihat</div>
                    </div>

                    <!-- Price -->
                    <div class="product-price-box">
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="product-price-note">Harga dapat berubah sewaktu-waktu, silakan konfirmasi ke penjual
                        </div>
                    </div>

                    <!-- Shop Info -->
                    <div class="shop-info-card">
                        <div class="shop-info-header">
                            <div class="shop-info-logo">{{ $product->shop->logo ?: '🏪' }}</div>
                            <div style="flex:1;">
                                <div class="shop-info-name">{{ $product->shop->name }}</div>
                                <div class="shop-info-district"><i class="fa-solid fa-location-dot"></i>
                                    {{ $product->shop->district }}</div>
                            </div>
                            <a href="{{ route('shop.show', $product->shop->slug) }}"
                                style="font-size:0.78rem;color:var(--primary);font-weight:600;">Lihat Toko
                                →</a>
                        </div>
                        <div class="shop-info-stats"
                            style="background:var(--bg);border-radius:var(--radius-sm);border:1px solid var(--border);">
                            <div class="shop-stat">
                                <div class="shop-stat-num">{{ $product->shop->products->count() }}</div>
                                <div class="shop-stat-label">Produk</div>
                            </div>
                            <div class="shop-stat">
                                <div class="shop-stat-num">-</div>
                                <div class="shop-stat-label">Transaksi</div>
                            </div>
                            <div class="shop-stat">
                                <div class="shop-stat-num">-</div>
                                <div class="shop-stat-label">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- WA CTA Box -->
                    <div class="wa-cta-box">
                        <div class="wa-cta-title">
                            <i class="fa-brands fa-whatsapp" style="color:#25D366;font-size:1.1rem;"></i>
                            Pesan via WhatsApp Business
                        </div>
                        <p style="font-size:0.8rem;color:var(--dark-light);margin-bottom:12px;">Edit pesan di bawah,
                            lalu klik tombol untuk langsung chat dengan penjual.</p>

                        <div class="qty-selector">
                            <div class="qty-control">
                                <button class="qty-btn" onclick="changeQty(-1)">−</button>
                                <div class="qty-num" id="qty-display">1</div>
                                <button class="qty-btn" onclick="changeQty(1)">+</button>
                            </div>
                            <span style="font-size:0.82rem;color:var(--dark-light);">× Rp
                                {{ number_format($product->price, 0, ',', '.') }} = <strong id="total-price"
                                    style="color:var(--primary)">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</strong></span>
                        </div>

                        <textarea class="wa-cta-msg" rows="3" id="wa-message">Halo {{ $product->shop->name }}! Saya tertarik dengan *{{ $product->name }}* (1 pcs) seharga Rp{{ number_format($product->price, 0, ',', '.') }}. Apakah stok masih tersedia?</textarea>

                        <button class="btn-wa-cta"
                            onclick="sendToWA('{{ preg_replace('/^0/', '62', $product->shop->whatsapp_number) }}')">
                            <span class="wa-icon"><i class="fa-brands fa-whatsapp"></i></span>
                            Chat WhatsApp Sekarang
                        </button>
                    </div>

                    <!-- Secondary actions -->
                    <div class="secondary-actions">
                        @auth
                            @php
                                $isWishlisted = auth()->user()->wishlistedProducts()->where('product_id', $product->id)->exists();
                            @endphp
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" style="width: 100%;">
                                @csrf
                                <button type="submit" class="btn btn-outline w-full" style="{{ $isWishlisted ? 'border-color:#ef4444; color:#ef4444; background:var(--white);' : '' }}">
                                    @if($isWishlisted)
                                        <i class="fa-solid fa-heart"></i> Hapus dari Wishlist
                                    @else
                                        <i class="fa-regular fa-heart"></i> Simpan ke Wishlist
                                    @endif
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline w-full" onclick="location.href='{{ route('login') }}'">
                                <i class="fa-regular fa-heart"></i> Simpan ke Wishlist
                            </button>
                        @endauth
                        <div class="share-row" style="margin:0;">
                            <button class="share-btn"><i class="fa-brands fa-whatsapp"
                                    style="color:#25D366;"></i></button>
                            <button class="share-btn"><i class="fa-brands fa-instagram"
                                    style="color:#e1306c;"></i></button>
                            <button class="share-btn"><i class="fa-solid fa-link"></i></button>
                        </div>
                    </div>

                    <!-- Safety note -->
                    <div
                        style="margin-top:16px;background:var(--bg);border-radius:var(--radius-sm);padding:12px 14px;font-size:0.78rem;color:var(--dark-light);display:flex;gap:8px;align-items:flex-start;">
                        <i class="fa-solid fa-shield-check" style="color:var(--primary);margin-top:1px;"></i>
                        <span>Toko ini telah <strong>terverifikasi</strong> oleh PasarLokal. Pembayaran & pengiriman
                            disepakati langsung dengan penjual.</span>
                    </div>
                </div>
            </div>

            <!-- DESCRIPTION TABS -->
            <div style="padding-bottom:48px;">
                <div class="desc-tabs">
                    <div class="desc-tab active" onclick="switchDesc('deskripsi',this)">Deskripsi Produk</div>
                    <div class="desc-tab" onclick="switchDesc('spesifikasi',this)">Spesifikasi</div>
                    <div class="desc-tab" onclick="switchDesc('ulasan',this)">Ulasan ({{ $totalReviews }})</div>
                </div>

                <div class="desc-panel active" id="desc-deskripsi">
                    <h4 style="margin-bottom:12px;">Tentang Produk Ini</h4>
                    <p style="line-height:1.8;margin-bottom:12px;">{{ $product->description }}</p>
                    <div style="display:flex;gap:24px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:var(--dark-mid);">
                            <i class="fa-solid fa-circle-check" style="color:var(--success);"></i> Tanpa Pengawet
                            Buatan
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:var(--dark-mid);">
                            <i class="fa-solid fa-circle-check" style="color:var(--success);"></i> Sertifikat PIRT
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:var(--dark-mid);">
                            <i class="fa-solid fa-circle-check" style="color:var(--success);"></i> Kemasan Vakum
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:var(--dark-mid);">
                            <i class="fa-solid fa-circle-check" style="color:var(--success);"></i> Bisa Kirim
                            Seluruh Indonesia
                        </div>
                    </div>
                </div>

                <div class="desc-panel" id="desc-spesifikasi">
                    <div class="spec-table">
                        <div class="spec-row">
                            <span class="spec-key">Berat Bersih</span>
                            <span class="spec-val">{{ $product->weight ? $product->weight . ' gram' : '-' }}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-key">Ukuran / Dimensi</span>
                            <span class="spec-val">
                                @if($product->dimension_length && $product->dimension_width && $product->dimension_height)
                                    {{ rtrim(rtrim($product->dimension_length, '0'), '.') }} × {{ rtrim(rtrim($product->dimension_width, '0'), '.') }} × {{ rtrim(rtrim($product->dimension_height, '0'), '.') }} cm
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-key">Minimum Order</span>
                            <span class="spec-val">{{ $product->min_order }} {{ $product->unit ?: 'pcs' }}</span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-key">Status Stok</span>
                            <span class="spec-val">
                                @if($product->stock_status === 'available')
                                    Tersedia
                                @elseif($product->stock_status === 'preorder')
                                    Pre-Order ({{ $product->preorder_days }} {{ $product->preorder_unit ?: 'hari' }})
                                @elseif($product->stock_status === 'limited')
                                    Stok Terbatas
                                @elseif($product->stock_status === 'empty')
                                    Stok Kosong
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="spec-row">
                            <span class="spec-key">Catatan Pengiriman</span>
                            <span class="spec-val">{{ $product->shipping_note ?: '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="desc-panel" id="desc-ulasan">
                    @php
                        $ratingCounts = [
                            5 => $product->reviews->where('rating', 5)->count(),
                            4 => $product->reviews->where('rating', 4)->count(),
                            3 => $product->reviews->where('rating', 3)->count(),
                            2 => $product->reviews->where('rating', 2)->count(),
                            1 => $product->reviews->where('rating', 1)->count(),
                        ];
                    @endphp
                    <div style="display:flex;gap:32px;align-items:center;margin-bottom:32px;flex-wrap:wrap;">
                        <div style="text-align:center;">
                            <div
                                style="font-family:var(--font-display);font-size:3.5rem;font-weight:700;color:var(--dark);line-height:1;">
                                {{ number_format($avgRating, 1) }}</div>
                            <div class="stars" style="justify-content:center;margin:6px 0;color:#fbbf24;">
                                @for($i = 0; $i < $roundedAvg; $i++)★@endfor
                                @for($i = $roundedAvg; $i < 5; $i++)<span style="color:var(--border);">★</span>@endfor
                            </div>
                            <div style="font-size:0.78rem;color:var(--dark-light);">dari {{ $totalReviews }} ulasan</div>
                        </div>
                        <div style="flex:1;min-width:200px;">
                            @foreach([5, 4, 3, 2, 1] as $star)
                            @php
                                $pct = $totalReviews > 0 ? round(($ratingCounts[$star] / $totalReviews) * 100) : 0;
                            @endphp
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;font-size:0.82rem;">
                                <span style="width:16px;text-align:right;color:var(--dark-mid);">{{ $star }}</span><span
                                    style="color:#fbbf24;">★</span>
                                <div
                                    style="flex:1;height:6px;background:var(--border);border-radius:3px;overflow:hidden;">
                                    <div style="width:{{ $pct }}%;height:100%;background:#fbbf24;border-radius:3px;"></div>
                                </div>
                                <span style="width:28px;color:var(--dark-light);">{{ $pct }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Review items -->
                    <div style="display:flex;flex-direction:column;gap:20px;">
                        @auth
                            @if(!$product->reviews->where('user_id', auth()->id())->count())
                            <div style="padding:20px;background:var(--white);border-radius:var(--radius-md);border:1px solid var(--border);">
                                <h4 style="margin-bottom:12px;font-size:1rem;">Tulis Ulasan Anda</h4>
                                <form action="{{ route('product.review.store', $product->id) }}" method="POST">
                                    @csrf
                                    <div style="margin-bottom:12px;">
                                        <label style="display:block;margin-bottom:6px;font-size:0.85rem;color:var(--dark-mid);">Rating (1-5)</label>
                                        <select name="rating" required style="padding:8px;border:1px solid var(--border);border-radius:var(--radius-sm);width:100%;max-width:200px;">
                                            <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                            <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                            <option value="3">⭐⭐⭐ (3/5)</option>
                                            <option value="2">⭐⭐ (2/5)</option>
                                            <option value="1">⭐ (1/5)</option>
                                        </select>
                                    </div>
                                    <div style="margin-bottom:12px;">
                                        <label style="display:block;margin-bottom:6px;font-size:0.85rem;color:var(--dark-mid);">Komentar (Opsional)</label>
                                        <textarea name="review_text" rows="3" style="width:100%;padding:10px;border:1px solid var(--border);border-radius:var(--radius-sm);" placeholder="Tuliskan pengalaman Anda..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Kirim Ulasan</button>
                                </form>
                            </div>
                            @endif
                        @else
                            <div style="padding:16px;background:var(--primary-light);color:var(--primary);border-radius:var(--radius-md);font-size:0.88rem;text-align:center;">
                                Silakan <a href="{{ route('login') }}" style="font-weight:700;text-decoration:underline;">login</a> untuk memberikan ulasan.
                            </div>
                        @endauth
                        
                        @forelse($product->reviews as $review)
                        <div style="padding:20px;background:var(--bg);border-radius:var(--radius-md);border:1px solid var(--border);">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                                <div style="width:36px;height:36px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.85rem;overflow:hidden;">
                                    @if($review->user->avatar_url)
                                        <img src="{{ $review->user->avatar_url }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:0.88rem;">{{ $review->user->name }}</div>
                                    <div style="font-size:0.72rem;color:var(--dark-light);">{{ $review->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="stars" style="margin-left:auto;color:#fbbf24;">
                                    @for($i = 0; $i < $review->rating; $i++)★@endfor
                                    @for($i = $review->rating; $i < 5; $i++)<span style="color:var(--border);">★</span>@endfor
                                </div>
                            </div>
                            @if($review->review_text)
                            <p style="font-size:0.88rem;line-height:1.7;color:var(--dark-mid);">{{ $review->review_text }}</p>
                            @endif
                        </div>
                        @empty
                        <div style="text-align:center;padding:40px 0;color:var(--dark-light);">
                            <i class="fa-regular fa-comment-dots" style="font-size:2rem;margin-bottom:10px;"></i>
                            <p>Belum ada ulasan untuk produk ini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- RELATED PRODUCTS -->
        <div class="related-section">
            <div class="container">
                <div class="flex-between mb-24">
                    <h3>Produk Lain dari Toko Ini</h3>
                    <a href="{{ route('shop.show', $product->shop->slug) }}" class="btn btn-ghost btn-sm">Lihat Semua
                        →</a>
                </div>
                <div class="grid-4">
                    @foreach ($relatedProducts as $rel)
                        @php $relImg = $rel->primaryImage->first(); @endphp
                        <a href="{{ route('product.show', $rel->slug) }}" class="product-card"
                            style="cursor:pointer; text-decoration:none; color:inherit; display:flex; flex-direction:column;">
                            <div class="product-card-img" style="position:relative;overflow:hidden;">
                                <div
                                    style="width:100%;height:100%;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;font-size:3rem;">
                                    @if ($relImg)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($relImg->image_path) }}"
                                            style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                                    @else
                                        📦
                                    @endif
                                </div>
                            </div>
                            <div class="product-card-body">
                                <div class="product-card-shop"><i class="fa-solid fa-store"></i>
                                    {{ $rel->shop->name }}</div>
                                <div class="product-card-name">{{ $rel->name }}</div>
                                <div class="product-card-price">Rp {{ number_format($rel->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="product-card-actions" style="margin-top:auto;">
                                <button class="btn btn-wa w-full btn-sm"
                                    @auth
                                        onclick="event.preventDefault(); event.stopPropagation(); window.open('https://wa.me/{{ preg_replace('/^0/', '62', $rel->shop->whatsapp_number) }}?text={{ urlencode('Halo ' . $rel->shop->name . '! Saya tertarik dengan *' . $rel->name . '* seharga Rp' . number_format($rel->price, 0, ',', '.')) }}', '_blank')"
                                    @else
                                        onclick="event.preventDefault(); event.stopPropagation(); alert('Silakan login terlebih dahulu untuk menghubungi penjual.'); window.location.href='{{ route('login') }}';"
                                    @endauth
                                    ><i class="fa-brands fa-whatsapp"></i> Chat WA</button>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <footer style="background:var(--dark);padding:28px 0;text-align:center;">
        <div class="container">
            <p style="color:rgba(255,255,255,0.4);font-size:0.82rem;">© 2026 PasarLokal — Platform UMKM Indonesia
            </p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
        });

        let qty = 1;
        const unitPrice = {{ $product->price }};

        function changeQty(delta) {
            qty = Math.max(1, qty + delta);
            document.getElementById('qty-display').textContent = qty;
            document.getElementById('total-price').textContent = 'Rp ' + (qty * unitPrice).toLocaleString('id-ID');
            const prodName = '{{ $product->name }}';
            document.getElementById('wa-message').value =
                `Halo {{ $product->shop->name }}! Saya tertarik dengan *${prodName}* (${qty} pcs) seharga Rp${(qty*unitPrice).toLocaleString('id-ID')}. Apakah stok masih tersedia? 🙏`;
        }

        function sendToWA(phone) {
            @auth
                const msg = encodeURIComponent(document.getElementById('wa-message').value);
                const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';
                fetch('{{ route("whatsapp.log") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        shop_id: {{ $product->shop_id }},
                        product_id: {{ $product->id }},
                        message: document.getElementById('wa-message').value
                    })
                }).then(() => {
                    window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
                }).catch(() => {
                    window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
                });
            @else
                alert('Silakan login terlebih dahulu untuk menghubungi penjual.');
                window.location.href = "{{ route('login') }}";
            @endauth
        }

        function wishlist(btn) {
            btn.innerHTML = '<i class="fa-solid fa-heart" style="color:#ef4444;"></i> Tersimpan di Wishlist';
            btn.style.borderColor = '#ef4444';
            btn.style.color = '#ef4444';
        }

        function changeMainImg(el, src) {
            document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
            el.classList.add('active');

            let mainImg = document.getElementById('main-img');
            if (!mainImg) {
                const main = document.getElementById('gallery-main');
                main.innerHTML =
                    `<img src="${src}" id="main-img" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">`;
            } else {
                mainImg.src = src;
            }
        }

        function switchDesc(tab, el) {
            document.querySelectorAll('.desc-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.desc-panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('desc-' + tab).classList.add('active');
        }
    </script>
</body>

</html>
