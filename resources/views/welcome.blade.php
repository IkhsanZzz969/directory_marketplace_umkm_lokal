<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* ---- HERO ---- */
    .hero {
      padding-top: calc(var(--nav-h) + 72px);
      padding-bottom: 80px;
      background: var(--bg);
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: -120px; right: -200px;
      width: 700px; height: 700px;
      background: radial-gradient(circle, rgba(253,116,0,0.08) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
    }
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--primary-light);
      color: var(--primary);
      padding: 6px 14px;
      border-radius: var(--radius-full);
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: .06em;
      text-transform: uppercase;
      margin-bottom: 20px;
    }
    .hero h1 { margin-bottom: 20px; }
    .hero h1 em { font-style: normal; color: var(--primary); }
    .hero p.lead {
      font-size: 1.05rem;
      color: var(--dark-mid);
      margin-bottom: 36px;
      line-height: 1.7;
    }
    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .hero-stats {
      display: flex;
      gap: 32px;
      margin-top: 44px;
      padding-top: 32px;
      border-top: 1px solid var(--border);
    }
    .hero-stat-num {
      font-family: var(--font-display);
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--dark);
    }
    .hero-stat-label { font-size: 0.8rem; color: var(--dark-light); margin-top: 2px; }
    .hero-visual {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero-visual-main {
      width: 100%;
      max-width: 460px;
      background: var(--white);
      border-radius: var(--radius-xl);
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      border: 1px solid var(--border);
    }
    .hero-visual-header {
      background: var(--dark);
      padding: 14px 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .dot { width: 10px; height: 10px; border-radius: 50%; }
    .dot-r { background: #ff5f57; }
    .dot-y { background: #febc2e; }
    .dot-g { background: #28c840; }
    .hero-products-grid {
      padding: 20px;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 12px;
    }
    .hp-card {
      background: var(--bg);
      border-radius: var(--radius-md);
      overflow: hidden;
      border: 1px solid var(--border);
    }
    .hp-card-img {
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.2rem;
    }
    .hp-card-body { padding: 8px 10px; }
    .hp-card-name { font-size: 0.7rem; font-weight: 600; color: var(--dark); }
    .hp-card-price { font-size: 0.68rem; color: var(--primary); font-weight: 700; }

    /* floating badges */
    .float-badge {
      position: absolute;
      background: var(--white);
      border-radius: var(--radius-md);
      padding: 10px 14px;
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--dark);
      animation: float 4s ease-in-out infinite;
    }
    .float-badge-1 { bottom: 24px; left: -24px; animation-delay: 0s; }
    .float-badge-2 { top: 24px; right: -24px; animation-delay: 2s; }
    @keyframes float {
      0%,100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }

    /* ---- HOW IT WORKS ---- */
    .how-section { background: var(--dark); padding: 80px 0; }
    .how-section .section-header .eyebrow { color: var(--primary); }
    .how-section h2 { color: white; }
    .how-section .section-header p { color: rgba(255,255,255,0.6); }
    .how-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: var(--radius-lg);
      padding: 32px;
      position: relative;
    }
    .how-step-num {
      font-family: var(--font-display);
      font-size: 3rem;
      font-weight: 700;
      color: rgba(253,116,0,0.15);
      line-height: 1;
      margin-bottom: 16px;
    }
    .how-icon {
      width: 48px; height: 48px;
      background: rgba(253,116,0,0.15);
      border-radius: var(--radius-sm);
      display: flex; align-items: center; justify-content: center;
      color: var(--primary);
      font-size: 1.3rem;
      margin-bottom: 16px;
    }
    .how-card h3 { color: white; font-size: 1.05rem; margin-bottom: 8px; }
    .how-card p { color: rgba(255,255,255,0.55); font-size: 0.88rem; }

    /* ---- CATEGORIES SECTION ---- */
    .cat-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }
    .cat-card {
      background: var(--white);
      border: 1.5px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 24px 16px;
      text-align: center;
      cursor: pointer;
      transition: all .25s;
    }
    .cat-card:hover { border-color: var(--primary); background: var(--primary-light); transform: translateY(-3px); box-shadow: var(--shadow-md); }
    .cat-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
    .cat-name { font-family: var(--font-display); font-size: 0.88rem; font-weight: 600; color: var(--dark); }
    .cat-count { font-size: 0.72rem; color: var(--dark-light); margin-top: 3px; }
    .cat-card:hover .cat-name { color: var(--primary); }

    /* ---- FEATURED SHOPS ---- */
    .shop-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      transition: all .25s;
    }
    .shop-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); }
    .shop-card-banner {
      height: 80px;
      background: linear-gradient(135deg, var(--dark) 0%, #4a5568 100%);
      position: relative;
    }
    .shop-card-logo {
      width: 56px; height: 56px;
      border-radius: var(--radius-md);
      border: 3px solid white;
      background: var(--primary);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.5rem;
      position: absolute;
      bottom: -24px; left: 20px;
      box-shadow: var(--shadow-md);
    }
    .shop-card-body { padding: 36px 20px 20px; }
    .shop-card-name { font-family: var(--font-display); font-weight: 600; font-size: 1rem; margin-bottom: 4px; }
    .shop-card-district { font-size: 0.78rem; color: var(--dark-light); display: flex; align-items: center; gap: 4px; }
    .shop-card-stats { display: flex; gap: 16px; margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border); }
    .shop-card-stat { font-size: 0.78rem; color: var(--dark-light); }
    .shop-card-stat strong { display: block; font-size: 0.92rem; color: var(--dark); font-weight: 700; }

    /* ---- TESTIMONIALS ---- */
    .testimonials-section { background: var(--primary-light); }
    .testi-card {
      background: var(--white);
      border-radius: var(--radius-lg);
      padding: 28px;
      border: 1px solid rgba(253,116,0,0.15);
      transition: all .25s;
    }
    .testi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
    .testi-quote { font-size: 2rem; color: var(--primary); line-height: 1; margin-bottom: 12px; }
    .testi-text { font-size: 0.92rem; color: var(--dark-mid); line-height: 1.7; margin-bottom: 20px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .testi-avatar { width: 42px; height: 42px; border-radius: var(--radius-full); background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; }
    .testi-name { font-weight: 700; font-size: 0.9rem; color: var(--dark); }
    .testi-role { font-size: 0.75rem; color: var(--dark-light); }

    /* ---- PROMO BANNER ---- */
    .promo-banner {
      background: linear-gradient(135deg, var(--dark) 0%, #3d4b5a 100%);
      border-radius: var(--radius-xl);
      padding: 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 32px;
      position: relative;
      overflow: hidden;
    }
    .promo-banner::before {
      content: '';
      position: absolute;
      top: -80px; right: -80px;
      width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(253,116,0,0.2) 0%, transparent 70%);
    }
    .promo-banner h2 { color: white; font-size: clamp(1.4rem, 3vw, 2rem); }
    .promo-banner p { color: rgba(255,255,255,0.7); margin-top: 8px; max-width: 420px; }
    .promo-actions { display: flex; gap: 12px; align-items: center; flex-shrink: 0; }

    /* ---- BLOG/TIPS ---- */
    .tip-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      transition: all .25s;
    }
    .tip-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
    .tip-card-img {
      height: 160px;
      background: linear-gradient(135deg, var(--primary) 0%, #ff9e44 100%);
      display: flex; align-items: center; justify-content: center;
      font-size: 3rem;
    }
    .tip-card-body { padding: 20px; }
    .tip-tag { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--primary); margin-bottom: 8px; }
    .tip-title { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; line-height: 1.4; }
    .tip-meta { font-size: 0.75rem; color: var(--dark-light); }

    /* ---- PARTNER LOGOS ---- */
    .partners-section { background: var(--white); padding: 40px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .partners-label { font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--dark-light); margin-right: 32px; white-space: nowrap; }
    .partners-row { display: flex; align-items: center; gap: 0; overflow: hidden; }
    .partner-logos { display: flex; align-items: center; gap: 40px; animation: marquee 18s linear infinite; }
    .partner-logo { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--border); white-space: nowrap; }
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
  </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
@include('layouts.partials.navbar')

<!-- ===== HERO ===== -->
<section class="hero">
  <div class="container">
    <div class="hero-inner">
      <div class="hero-content reveal">
        <div class="hero-eyebrow">
          <i class="fa-solid fa-star"></i>
          Platform #1 UMKM Banyumas
        </div>
        <h1>Temukan Produk <em>Banyumas Terbaik</em> dari UMKM Pilihan</h1>
        <p class="lead">Laba menghubungkan kamu langsung dengan ribuan pelaku UMKM terpercaya. Pesan lewat WhatsApp — mudah, cepat, tanpa perantara.</p>
        <div class="hero-actions">
          <a href="/catalog" class="btn btn-primary btn-xl">
            <i class="fa-solid fa-shopping-bag"></i> Mulai Belanja
          </a>
          <a href="create-shop.html" class="btn btn-dark btn-xl">
            <i class="fa-solid fa-store"></i> Buka Toko
          </a>
        </div>
        <div class="hero-stats">
          <div>
            <div class="hero-stat-num">12K+</div>
            <div class="hero-stat-label">Produk Terdaftar</div>
          </div>
          <div>
            <div class="hero-stat-num">2.4K+</div>
            <div class="hero-stat-label">UMKM Aktif</div>
          </div>
          <div>
            <div class="hero-stat-num">38</div>
            <div class="hero-stat-label">Kota Terlayani</div>
          </div>
        </div>
      </div>
      <div class="hero-visual reveal" style="transition-delay:.2s">
        <div class="hero-visual-main">
          <div class="hero-visual-header">
            <div class="dot dot-r"></div>
            <div class="dot dot-y"></div>
            <div class="dot dot-g"></div>
            <span style="color:rgba(255,255,255,0.5);font-size:0.75rem;margin-left:8px;">pasarBanyumas.id/catalog</span>
          </div>
          <div class="hero-products-grid">
            <div class="hp-card">
              <div class="hp-card-img" style="background:#fff3e8;">🧃</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Jus Mangga</div>
                <div class="hp-card-price">Rp 15.000</div>
              </div>
            </div>
            <div class="hp-card">
              <div class="hp-card-img" style="background:#fef3c7;">🍪</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Nastar Premium</div>
                <div class="hp-card-price">Rp 65.000</div>
              </div>
            </div>
            <div class="hp-card">
              <div class="hp-card-img" style="background:#d1fae5;">🎨</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Batik Tulis</div>
                <div class="hp-card-price">Rp 185.000</div>
              </div>
            </div>
            <div class="hp-card">
              <div class="hp-card-img" style="background:#ede9fe;">👜</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Tas Anyam</div>
                <div class="hp-card-price">Rp 95.000</div>
              </div>
            </div>
            <div class="hp-card">
              <div class="hp-card-img" style="background:#fee2e2;">🍯</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Madu Asli</div>
                <div class="hp-card-price">Rp 75.000</div>
              </div>
            </div>
            <div class="hp-card">
              <div class="hp-card-img" style="background:#dbeafe;">🪴</div>
              <div class="hp-card-body">
                <div class="hp-card-name">Tanaman Hias</div>
                <div class="hp-card-price">Rp 45.000</div>
              </div>
            </div>
          </div>
        </div>
        <div class="float-badge float-badge-1">
          <span style="color:#25D366;font-size:1.1rem;">📲</span>
          <div>
            <div>Chat WhatsApp</div>
            <div style="font-weight:400;color:var(--dark-light);font-size:0.7rem;">Langsung ke penjual</div>
          </div>
        </div>
        <div class="float-badge float-badge-2">
          <span style="color:var(--primary);font-size:1.1rem;">✅</span>
          <div>
            <div>Terverifikasi</div>
            <div style="font-weight:400;color:var(--dark-light);font-size:0.7rem;">UMKM Terpercaya</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== PARTNER STRIP ===== -->
<div class="partners-section">
  <div class="container">
    <div class="flex gap-16" style="overflow:hidden;">
      <span class="partners-label">Didukung Oleh</span>
      <div class="partners-row" style="flex:1;overflow:hidden;">
        <div class="partner-logos">
          <span class="partner-logo">Kemenkop UKM</span>
          <span class="partner-logo">Bank BRI</span>
          <span class="partner-logo">BPUM 2025</span>
          <span class="partner-logo">Dinas Perdagangan</span>
          <span class="partner-logo">Go-UKM</span>
          <span class="partner-logo">Kemenkop UKM</span>
          <span class="partner-logo">Bank BRI</span>
          <span class="partner-logo">BPUM 2025</span>
          <span class="partner-logo">Dinas Perdagangan</span>
          <span class="partner-logo">Go-UKM</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ===== CATEGORIES ===== -->
<section class="section" id="categories">
  <div class="container">
    <div class="section-header reveal">
      <div class="eyebrow">Kategori</div>
      <h2>Temukan Berdasarkan Kategori</h2>
      <p>Dari kuliner hingga kerajinan tangan, semua ada di PasarBanyumas.</p>
    </div>
    <div class="cat-grid reveal">
      <div class="cat-card" onclick="location.href='/catalog?cat=kuliner'">
        <span class="cat-icon">🍱</span>
        <div class="cat-name">Kuliner & Makanan</div>
        <div class="cat-count">3.240 produk</div>
      </div>
      <div class="cat-card" onclick="location.href='/catalog?cat=fashion'">
        <span class="cat-icon">👗</span>
        <div class="cat-name">Fashion & Batik</div>
        <div class="cat-count">2.180 produk</div>
      </div>
      <div class="cat-card" onclick="location.href='/catalog?cat=kerajinan'">
        <span class="cat-icon">🎨</span>
        <div class="cat-name">Kerajinan Tangan</div>
        <div class="cat-count">1.650 produk</div>
      </div>
      <div class="cat-card" onclick="location.href='/catalog?cat=pertanian'">
        <span class="cat-icon">🌿</span>
        <div class="cat-name">Pertanian & Herbal</div>
        <div class="cat-count">980 produk</div>
      </div>
      <div class="cat-card" onclick="location.href='/catalog?cat=kecantikan'">
        <span class="cat-icon">💆</span>
        <div class="cat-name">Kecantikan & Perawatan</div>
        <div class="cat-count">1.230 produk</div>
      </div>
    </div>
  </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="how-section">
  <div class="container">
    <div class="section-header center reveal">
      <div class="eyebrow">Cara Kerja</div>
      <h2>Belanja Semudah Chat WhatsApp</h2>
      <p style="color:rgba(255,255,255,0.6);">Tidak perlu daftar untuk berbelanja. Pilih produk, hubungi penjual, dan deal!</p>
    </div>
    <div class="grid-3 reveal" style="transition-delay:.15s">
      <div class="how-card">
        <div class="how-step-num">01</div>
        <div class="how-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        <h3>Temukan Produk</h3>
        <p>Jelajahi ribuan produk UMKM Banyumas. Filter berdasarkan kategori, kota, atau harga sesuai kebutuhan kamu.</p>
      </div>
      <div class="how-card">
        <div class="how-step-num">02</div>
        <div class="how-icon"><i class="fa-brands fa-whatsapp"></i></div>
        <h3>Chat Langsung</h3>
        <p>Klik tombol WhatsApp untuk langsung ngobrol dengan pemilik toko. Tanya-tanya, nego harga, atau konfirmasi stok.</p>
      </div>
      <div class="how-card">
        <div class="how-step-num">03</div>
        <div class="how-icon"><i class="fa-solid fa-handshake"></i></div>
        <h3>Deal & Nikmati</h3>
        <p>Sepakati pengiriman dan pembayaran langsung dengan penjual. Dukung UMKM Banyumas dengan setiap pembelian kamu!</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FEATURED PRODUCTS ===== -->
<section class="section">
  <div class="container">
    <div class="flex-between mb-24 reveal">
      <div class="section-header" style="margin-bottom:0">
        <div class="eyebrow">Pilihan Editor</div>
        <h2>Produk Unggulan</h2>
      </div>
      <a href="/catalog" class="btn btn-outline">Lihat Semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="grid-4 reveal" style="transition-delay:.1s">
      <!-- Product cards demo -->
      <div class="product-card" onclick="location.href='/product-detail'">
        <div class="product-card-img">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#fef3c7,#fed7aa);display:flex;align-items:center;justify-content:center;font-size:3rem;">🍪</div>
          <div class="product-card-badge">Terlaris</div>
        </div>
        <div class="product-card-body">
          <div class="product-card-shop"><i class="fa-solid fa-store"></i> Dapur Bu Sari</div>
          <div class="product-card-name">Nastar Keju Premium Lebaran 500gr</div>
          <div class="product-card-price">Rp 65.000</div>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i> Pesan WA</button>
        </div>
      </div>
      <div class="product-card" onclick="location.href='/product-detail'">
        <div class="product-card-img">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#dbeafe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:3rem;">🎨</div>
          <div class="product-card-badge" style="background:#2E353D">Baru</div>
        </div>
        <div class="product-card-body">
          <div class="product-card-shop"><i class="fa-solid fa-store"></i> Batik Nusantara</div>
          <div class="product-card-name">Batik Tulis Motif Kawung Premium</div>
          <div class="product-card-price">Rp 185.000</div>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i> Pesan WA</button>
        </div>
      </div>
      <div class="product-card" onclick="location.href='/product-detail'">
        <div class="product-card-img">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#d1fae5,#a7f3d0);display:flex;align-items:center;justify-content:center;font-size:3rem;">🍯</div>
        </div>
        <div class="product-card-body">
          <div class="product-card-shop"><i class="fa-solid fa-store"></i> Lebah Madu Asli</div>
          <div class="product-card-name">Madu Hutan Murni 500ml Tanpa Pengawet</div>
          <div class="product-card-price">Rp 85.000</div>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i> Pesan WA</button>
        </div>
      </div>
      <div class="product-card" onclick="location.href='/product-detail'">
        <div class="product-card-img">
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#ede9fe,#ddd6fe);display:flex;align-items:center;justify-content:center;font-size:3rem;">👜</div>
          <div class="product-card-badge">Promo</div>
        </div>
        <div class="product-card-body">
          <div class="product-card-shop"><i class="fa-solid fa-store"></i> Anyaman Jogja</div>
          <div class="product-card-name">Tas Anyam Rotan Handmade Ukuran L</div>
          <div class="product-card-price">Rp 95.000</div>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i> Pesan WA</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FEATURED SHOPS ===== -->
<section class="section" style="background: var(--white);" id="toko">
  <div class="container">
    <div class="flex-between mb-24 reveal">
      <div class="section-header" style="margin-bottom:0">
        <div class="eyebrow">UMKM Unggulan</div>
        <h2>Toko Terpercaya</h2>
      </div>
      <button class="btn btn-outline">Lihat Semua Toko <i class="fa-solid fa-arrow-right"></i></button>
    </div>
    <div class="grid-4 reveal" style="transition-delay:.1s">
      <div class="shop-card">
        <div class="shop-card-banner" style="background:linear-gradient(135deg,#FD7400,#ff9944);">
          <div class="shop-card-logo">🍱</div>
        </div>
        <div class="shop-card-body">
          <div class="shop-card-name">Dapur Bu Sari</div>
          <div class="shop-card-district"><i class="fa-solid fa-location-dot"></i> Semarang Tengah</div>
          <div class="shop-card-stats">
            <div class="shop-card-stat"><strong>48</strong>Produk</div>
            <div class="shop-card-stat"><strong>⭐ 4.9</strong>Rating</div>
            <div class="shop-card-stat"><strong>320+</strong>Transaksi</div>
          </div>
        </div>
      </div>
      <div class="shop-card">
        <div class="shop-card-banner" style="background:linear-gradient(135deg,#2E353D,#4a5568);">
          <div class="shop-card-logo">🎨</div>
        </div>
        <div class="shop-card-body">
          <div class="shop-card-name">Batik Nusantara</div>
          <div class="shop-card-district"><i class="fa-solid fa-location-dot"></i> Laweyan, Solo</div>
          <div class="shop-card-stats">
            <div class="shop-card-stat"><strong>62</strong>Produk</div>
            <div class="shop-card-stat"><strong>⭐ 4.8</strong>Rating</div>
            <div class="shop-card-stat"><strong>185+</strong>Transaksi</div>
          </div>
        </div>
      </div>
      <div class="shop-card">
        <div class="shop-card-banner" style="background:linear-gradient(135deg,#10b981,#34d399);">
          <div class="shop-card-logo">🌿</div>
        </div>
        <div class="shop-card-body">
          <div class="shop-card-name">Herbal Segar</div>
          <div class="shop-card-district"><i class="fa-solid fa-location-dot"></i> Malang</div>
          <div class="shop-card-stats">
            <div class="shop-card-stat"><strong>29</strong>Produk</div>
            <div class="shop-card-stat"><strong>⭐ 4.7</strong>Rating</div>
            <div class="shop-card-stat"><strong>210+</strong>Transaksi</div>
          </div>
        </div>
      </div>
      <div class="shop-card">
        <div class="shop-card-banner" style="background:linear-gradient(135deg,#8b5cf6,#a78bfa);">
          <div class="shop-card-logo">👜</div>
        </div>
        <div class="shop-card-body">
          <div class="shop-card-name">Anyaman Jogja</div>
          <div class="shop-card-district"><i class="fa-solid fa-location-dot"></i> Kotagede, Yogyakarta</div>
          <div class="shop-card-stats">
            <div class="shop-card-stat"><strong>35</strong>Produk</div>
            <div class="shop-card-stat"><strong>⭐ 4.9</strong>Rating</div>
            <div class="shop-card-stat"><strong>150+</strong>Transaksi</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA PROMO BANNER ===== -->
<section class="section-sm">
  <div class="container reveal">
    <div class="promo-banner">
      <div>
        <h2>Punya UMKM? Daftarkan Toko Kamu <em style="font-style:normal;color:var(--primary);">Gratis!</em></h2>
        <p>Jangkau lebih banyak pelanggan tanpa biaya. Daftar sekarang dan mulai berjualan dalam 5 menit.</p>
      </div>
      <div class="promo-actions">
        <a href="create-shop.html" class="btn btn-primary btn-lg">
          <i class="fa-solid fa-store"></i> Buka Toko Gratis
        </a>
        <a href="/auth" class="btn btn-ghost btn-lg" style="color:rgba(255,255,255,0.7);">Pelajari Lebih Lanjut</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="section testimonials-section">
  <div class="container">
    <div class="section-header center reveal">
      <div class="eyebrow">Testimoni</div>
      <h2>Cerita Sukses dari Komunitas Kami</h2>
      <p>Ribuan UMKM dan pembeli telah merasakan manfaat PasarBanyumas.</p>
    </div>
    <div class="grid-3 reveal" style="transition-delay:.1s">
      <div class="testi-card">
        <div class="testi-quote">"</div>
        <p class="testi-text">Sejak daftar di PasarBanyumas, omzet nastar saya naik 3x lipat di musim Lebaran. Pembelinya dari mana-mana, bukan cuma tetangga!</p>
        <div class="testi-author">
          <div class="testi-avatar">S</div>
          <div>
            <div class="testi-name">Sari Wulandari</div>
            <div class="testi-role">Pemilik Dapur Bu Sari, Semarang</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-quote">"</div>
        <p class="testi-text">Saya suka banget ada tombol WhatsApp langsung. Nggak perlu repot buat akun, tinggal chat dan deal. Simpel dan nggak ribet!</p>
        <div class="testi-author">
          <div class="testi-avatar" style="background:var(--dark)">R</div>
          <div>
            <div class="testi-name">Rizky Pratama</div>
            <div class="testi-role">Pembeli Rutin dari Jakarta</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-quote">"</div>
        <p class="testi-text">Platform ini membantu saya ekspansi penjualan batik ke luar Jawa. Tampilannya keren, dan tim support-nya super responsif!</p>
        <div class="testi-author">
          <div class="testi-avatar" style="background:#10b981">B</div>
          <div>
            <div class="testi-name">Budi Santoso</div>
            <div class="testi-role">Pemilik Batik Nusantara, Solo</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== TIPS & ARTIKEL ===== -->
{{-- <section class="section" id="tips">
  <div class="container">
    <div class="section-header reveal">
      <div class="eyebrow">Tips & Inspirasi</div>
      <h2>Artikel untuk UMKM Maju</h2>
      <p>Kumpulan panduan dan inspirasi untuk mengembangkan bisnis Banyumas kamu.</p>
    </div>
    <div class="grid-3 reveal" style="transition-delay:.1s">
      <div class="tip-card">
        <div class="tip-card-img">📸</div>
        <div class="tip-card-body">
          <div class="tip-tag">Fotografi Produk</div>
          <div class="tip-title">5 Tips Foto Produk dengan HP yang Bikin Pembeli Tergiur</div>
          <div class="tip-meta"><i class="fa-regular fa-calendar"></i> 3 Jun 2026 · 5 menit baca</div>
        </div>
      </div>
      <div class="tip-card">
        <div class="tip-card-img" style="background:linear-gradient(135deg,#2E353D,#4a5568)">📱</div>
        <div class="tip-card-body">
          <div class="tip-tag">WhatsApp Business</div>
          <div class="tip-title">Cara Setting Katalog WhatsApp Business untuk Berjualan Lebih Efisien</div>
          <div class="tip-meta"><i class="fa-regular fa-calendar"></i> 28 Mei 2026 · 7 menit baca</div>
        </div>
      </div>
      <div class="tip-card">
        <div class="tip-card-img" style="background:linear-gradient(135deg,#10b981,#34d399)">💰</div>
        <div class="tip-card-body">
          <div class="tip-tag">Keuangan UMKM</div>
          <div class="tip-title">Cara Menghitung HPP dan Menentukan Harga Jual yang Kompetitif</div>
          <div class="tip-meta"><i class="fa-regular fa-calendar"></i> 20 Mei 2026 · 6 menit baca</div>
        </div>
      </div>
    </div>
  </div>
</section> --}}

<!-- ===== FOOTER ===== -->
<footer class="footer">
  <div class="container">
    <div class="grid-4" style="gap:40px;align-items:start;">
      <div style="grid-column:span 1">
        <div class="footer-brand">Pasar<span>Banyumas</span></div>
        <p style="margin-bottom:20px;line-height:1.8;">Platform digital yang menghubungkan UMKM Banyumas dengan pembeli di seluruh Banyumas.</p>
        <div class="social-links">
          <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
          <a href="#" class="social-link"><i class="fa-brands fa-tiktok"></i></a>
          <a href="#" class="social-link"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
      </div>
      <div>
        <h4>Platform</h4>
        <ul class="footer-links">
          <li><a href="/catalog">Katalog Produk</a></li>
          <li><a href="create-shop.html">Daftarkan Toko</a></li>
          <li><a href="/auth">Masuk / Daftar</a></li>
          <li><a href="#">Tentang Kami</a></li>
        </ul>
      </div>
      <div>
        <h4>Dukungan</h4>
        <ul class="footer-links">
          <li><a href="#">Pusat Bantuan</a></li>
          <li><a href="#">Cara Berjualan</a></li>
          <li><a href="#">Syarat & Ketentuan</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
        </ul>
      </div>
      <div>
        <h4>Newsletter</h4>
        <p style="margin-bottom:16px;">Dapatkan update produk baru & tips UMKM tiap minggu.</p>
        <div class="search-bar" style="border-radius:var(--radius-sm);">
          <input type="email" placeholder="Email kamu...">
          <button>Daftar</button>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 PasarBanyumas. Dibuat dengan ❤️ untuk UMKM Banyumas.</span>
      <span>🇮🇩 Bangga Produk Banyumas</span>
    </div>
  </div>
</footer>

<script>
  // Navbar scroll
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  });

  // Scroll reveal
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>