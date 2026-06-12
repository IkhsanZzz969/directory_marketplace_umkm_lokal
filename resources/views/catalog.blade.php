<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Katalog Produk — {{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            .page-top {
                padding-top: var(--nav-h);
                background: var(--dark);
            }

            .page-hero {
                padding: 40px 0;
            }

            .page-hero h1 {
                color: white;
                font-size: clamp(1.6rem, 3vw, 2.2rem);
                margin-bottom: 8px;
            }

            .page-hero p {
                color: rgba(255, 255, 255, 0.6);
            }

            .breadcrumb {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.45);
                margin-bottom: 16px;
            }

            .breadcrumb a {
                color: rgba(255, 255, 255, 0.55);
            }

            .breadcrumb a:hover {
                color: var(--primary);
            }

            .breadcrumb span {
                color: rgba(255, 255, 255, 0.3);
            }

            .catalog-layout {
                display: grid;
                grid-template-columns: 264px 1fr;
                gap: 28px;
                padding: 32px 0 64px;
                align-items: start;
            }

            /* FILTER SIDEBAR */
            .filter-sidebar {
                position: sticky;
                top: calc(var(--nav-h) + 16px);
            }

            .filter-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                overflow: hidden;
            }

            .filter-header {
                padding: 16px 20px;
                font-family: var(--font-display);
                font-weight: 700;
                font-size: 0.95rem;
                border-bottom: 1px solid var(--border);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .filter-clear {
                font-size: 0.78rem;
                color: var(--primary);
                font-weight: 600;
                cursor: pointer;
                font-family: var(--font-body);
            }

            .filter-section {
                padding: 16px 20px;
                border-bottom: 1px solid var(--border);
            }

            .filter-section:last-child {
                border-bottom: none;
            }

            .filter-section-title {
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                cursor: pointer;
            }

            .filter-options {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .filter-option {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 0.85rem;
                color: var(--dark-mid);
                cursor: pointer;
            }

            .filter-option input[type=checkbox] {
                accent-color: var(--primary);
            }

            .filter-option:hover {
                color: var(--primary);
            }

            .filter-count {
                margin-left: auto;
                font-size: 0.72rem;
                background: var(--bg);
                padding: 1px 7px;
                border-radius: var(--radius-full);
                color: var(--dark-light);
            }

            .price-range {
                display: flex;
                gap: 8px;
                align-items: center;
                margin-top: 4px;
            }

            .price-range input {
                flex: 1;
                padding: 7px 10px;
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                font-size: 0.8rem;
                font-family: var(--font-body);
                outline: none;
            }

            .price-range input:focus {
                border-color: var(--primary);
            }

            .price-range span {
                font-size: 0.8rem;
                color: var(--dark-light);
                flex-shrink: 0;
            }

            /* MAIN AREA */
            .catalog-main {}

            .catalog-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                gap: 16px;
                flex-wrap: wrap;
            }

            .catalog-result-info {
                font-size: 0.88rem;
                color: var(--dark-mid);
            }

            .catalog-result-info strong {
                color: var(--dark);
            }

            .catalog-controls {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sort-select {
                padding: 8px 12px;
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                font-size: 0.85rem;
                font-family: var(--font-body);
                color: var(--dark);
                background: var(--white);
                outline: none;
                cursor: pointer;
            }

            .view-btn {
                width: 36px;
                height: 36px;
                border-radius: var(--radius-sm);
                border: 1.5px solid var(--border);
                background: var(--white);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--dark-mid);
                transition: all .18s;
            }

            .view-btn.active,
            .view-btn:hover {
                border-color: var(--primary);
                color: var(--primary);
                background: var(--primary-light);
            }

            .active-filters {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
                margin-bottom: 16px;
            }

            .active-filter {
                display: flex;
                align-items: center;
                gap: 6px;
                padding: 4px 10px;
                background: var(--primary-light);
                border-radius: var(--radius-full);
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--primary);
            }

            .active-filter-x {
                cursor: pointer;
                opacity: 0.7;
            }

            .active-filter-x:hover {
                opacity: 1;
            }

            .products-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
            }

            .products-grid.list-view {
                grid-template-columns: 1fr;
            }

            .products-grid.list-view .product-card {
                display: flex;
                flex-direction: row;
            }

            .products-grid.list-view .product-card-img {
                width: 160px;
                min-width: 160px;
                aspect-ratio: auto;
                height: auto;
            }

            .products-grid.list-view .product-card-img div {
                height: 100%;
                min-height: 120px;
            }

            .products-grid.list-view .product-card-body {
                flex: 1;
            }

            .products-grid.list-view .product-card-actions {
                width: 160px;
                flex-shrink: 0;
                flex-direction: column;
                justify-content: center;
                padding: 16px;
            }

            .catalog-pagination {
                display: flex;
                justify-content: center;
                margin-top: 40px;
            }

            @media (max-width: 900px) {
                .catalog-layout {
                    grid-template-columns: 1fr;
                }

                .filter-sidebar {
                    position: static;
                }

                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 480px) {
                .products-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>

    <body>

        <!-- NAVBAR -->
        <nav class="navbar" id="navbar">
            <div class="nav-inner">
                <a href="index.html" class="nav-logo">
                    <div class="nav-logo-icon">
                        <img src="{{ asset('assets/img/laba-transparent.png') }}" alt="" srcset="">
                    </div>
                    Laba
                </a>
                <div class="nav-links">
                    <a href="index.html" class="nav-link">Beranda</a>
                    <a href="catalog.html" class="nav-link active">Produk</a>
                    <a href="index.html#toko" class="nav-link">Toko UMKM</a>
                    {{-- <a href="index.html#tips" class="nav-link">Tips & Artikel</a> --}}
                </div>
                <div class="nav-actions">
                    <a href="auth.html" class="btn btn-ghost btn-sm">Masuk</a>
                    <a href="auth.html?mode=register" class="btn btn-primary btn-sm">Daftar Gratis</a>
                </div>
            </div>
        </nav>

        <!-- PAGE HERO -->
        <div class="page-top">
            <div class="container">
                <div class="page-hero">
                    <div class="breadcrumb">
                        <a href="index.html">Beranda</a>
                        <span>/</span>
                        <span>Katalog Produk</span>
                    </div>
                    <h1>Katalog Produk UMKM</h1>
                    <p>Temukan ribuan produk lokal pilihan dari UMKM terpercaya se-Indonesia.</p>
                </div>
                <!-- Search bar in hero -->
                <div style="max-width:620px;margin-bottom:-20px;position:relative;z-index:10;">
                    <div class="search-bar" style="border-radius:var(--radius-md);box-shadow:var(--shadow-lg);">
                        <i class="fa-solid fa-magnifying-glass" style="padding-left:18px;color:var(--dark-light);"></i>
                        <input type="text" placeholder="Cari produk, toko, atau kategori..." id="search-input">
                        <button>Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <div style="background:var(--bg);padding-top:32px;">
            <div class="container">

                <!-- CATEGORY CHIPS -->
                <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:8px;padding-top:8px;">
                    <div class="tag active" onclick="filterCat(this,'semua')">Semua</div>
                    <div class="tag" onclick="filterCat(this,'kuliner')">🍱 Kuliner</div>
                    <div class="tag" onclick="filterCat(this,'fashion')">👗 Fashion & Batik</div>
                    <div class="tag" onclick="filterCat(this,'kerajinan')">🎨 Kerajinan</div>
                    <div class="tag" onclick="filterCat(this,'pertanian')">🌿 Pertanian</div>
                    <div class="tag" onclick="filterCat(this,'kecantikan')">💆 Kecantikan</div>
                    <div class="tag" onclick="filterCat(this,'elektronik')">🔌 Elektronik Lokal</div>
                </div>

                <div class="catalog-layout">
                    <!-- FILTER SIDEBAR -->
                    <aside class="filter-sidebar">
                        <div class="filter-card">
                            <div class="filter-header">
                                <span>Filter</span>
                                <span class="filter-clear" onclick="clearFilters()">Reset Semua</span>
                            </div>

                            <div class="filter-section">
                                <div class="filter-section-title">
                                    Kategori <i class="fa-solid fa-chevron-up fa-xs"></i>
                                </div>
                                <div class="filter-options">
                                    <label class="filter-option"><input type="checkbox" checked> Semua Kategori <span
                                            class="filter-count">12.4k</span></label>
                                    <label class="filter-option"><input type="checkbox"> Kuliner & Makanan <span
                                            class="filter-count">3.2k</span></label>
                                    <label class="filter-option"><input type="checkbox"> Fashion & Batik <span
                                            class="filter-count">2.1k</span></label>
                                    <label class="filter-option"><input type="checkbox"> Kerajinan Tangan <span
                                            class="filter-count">1.6k</span></label>
                                    <label class="filter-option"><input type="checkbox"> Pertanian & Herbal <span
                                            class="filter-count">980</span></label>
                                    <label class="filter-option"><input type="checkbox"> Kecantikan <span
                                            class="filter-count">1.2k</span></label>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-section-title">
                                    Rentang Harga <i class="fa-solid fa-chevron-up fa-xs"></i>
                                </div>
                                <div class="price-range">
                                    <input type="number" placeholder="Min" value="0">
                                    <span>—</span>
                                    <input type="number" placeholder="Max" value="500000">
                                </div>
                                <button class="btn btn-outline btn-sm w-full mt-8"
                                    style="margin-top:12px;">Terapkan</button>
                            </div>

                            <div class="filter-section">
                                <div class="filter-section-title">
                                    Kota / Kabupaten <i class="fa-solid fa-chevron-up fa-xs"></i>
                                </div>
                                <div class="input-icon-wrap" style="margin-bottom:10px;">
                                    <i class="fa-solid fa-magnifying-glass input-icon" style="font-size:0.8rem;"></i>
                                    <input class="form-control" style="padding-left:34px;font-size:0.82rem;"
                                        placeholder="Cari kota...">
                                </div>
                                <div class="filter-options">
                                    <label class="filter-option"><input type="checkbox"> Semarang <span
                                            class="filter-count">420</span></label>
                                    <label class="filter-option"><input type="checkbox"> Solo <span
                                            class="filter-count">380</span></label>
                                    <label class="filter-option"><input type="checkbox"> Yogyakarta <span
                                            class="filter-count">510</span></label>
                                    <label class="filter-option"><input type="checkbox"> Malang <span
                                            class="filter-count">290</span></label>
                                    <label class="filter-option"><input type="checkbox"> Surabaya <span
                                            class="filter-count">640</span></label>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-section-title">
                                    Status Toko <i class="fa-solid fa-chevron-up fa-xs"></i>
                                </div>
                                <div class="filter-options">
                                    <label class="filter-option"><input type="checkbox" checked> Terverifikasi ✅ <span
                                            class="filter-count">8.9k</span></label>
                                    <label class="filter-option"><input type="checkbox"> Produk Unggulan ⭐</label>
                                    <label class="filter-option"><input type="checkbox"> Baru Bergabung 🆕</label>
                                </div>
                            </div>

                            <div class="filter-section">
                                <div class="filter-section-title">
                                    Rating <i class="fa-solid fa-chevron-up fa-xs"></i>
                                </div>
                                <div class="filter-options">
                                    <label class="filter-option"><input type="checkbox"> ⭐⭐⭐⭐⭐ 5.0</label>
                                    <label class="filter-option"><input type="checkbox"> ⭐⭐⭐⭐ 4.0+</label>
                                    <label class="filter-option"><input type="checkbox"> ⭐⭐⭐ 3.0+</label>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <!-- MAIN CONTENT -->
                    <main class="catalog-main">
                        <!-- Active filters -->
                        <div class="active-filters" id="active-filters">
                            <span style="font-size:0.78rem;color:var(--dark-light);font-weight:600;">Filter
                                aktif:</span>
                            <div class="active-filter">Terverifikasi <span class="active-filter-x"
                                    onclick="this.parentElement.remove()">✕</span></div>
                            <div class="active-filter">Yogyakarta <span class="active-filter-x"
                                    onclick="this.parentElement.remove()">✕</span></div>
                        </div>

                        <div class="catalog-topbar">
                            <div class="catalog-result-info">
                                Menampilkan <strong>1–12</strong> dari <strong>12.480</strong> produk
                            </div>
                            <div class="catalog-controls">
                                <select class="sort-select" onchange="sortProducts(this.value)">
                                    <option value="relevance">Relevansi</option>
                                    <option value="newest">Terbaru</option>
                                    <option value="price-asc">Harga: Terendah</option>
                                    <option value="price-desc">Harga: Tertinggi</option>
                                    <option value="rating">Rating Tertinggi</option>
                                    <option value="views">Paling Dilihat</option>
                                </select>
                                <button class="view-btn active" id="btn-grid" onclick="setView('grid')"><i
                                        class="fa-solid fa-grip"></i></button>
                                <button class="view-btn" id="btn-list" onclick="setView('list')"><i
                                        class="fa-solid fa-list"></i></button>
                            </div>
                        </div>

                        <!-- PRODUCT GRID -->
                        <div class="products-grid" id="products-grid">
                            <!-- Cards are generated by JS below; shown as static HTML for 12 items -->
                        </div>

                        <!-- PAGINATION -->
                        <div class="catalog-pagination">
                            <div class="pagination">
                                <button class="page-btn"><i class="fa-solid fa-chevron-left fa-xs"></i></button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <span style="padding:0 4px;color:var(--dark-light);">…</span>
                                <button class="page-btn">42</button>
                                <button class="page-btn"><i class="fa-solid fa-chevron-right fa-xs"></i></button>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- FOOTER (minimal) -->
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

  // Demo product data
  const PRODUCTS = [
    { emoji:'🍪', bg:'linear-gradient(135deg,#fef3c7,#fed7aa)', badge:'Terlaris', name:'Nastar Keju Premium 500gr', shop:'Dapur Bu Sari', district:'Semarang', price:'65.000', views:1240 },
    { emoji:'🎨', bg:'linear-gradient(135deg,#dbeafe,#bfdbfe)', badge:'Baru', name:'Batik Tulis Motif Kawung', shop:'Batik Nusantara', district:'Solo', price:'185.000', views:860 },
    { emoji:'🍯', bg:'linear-gradient(135deg,#d1fae5,#a7f3d0)', badge:null, name:'Madu Hutan Murni 500ml', shop:'Lebah Madu Asli', district:'Malang', price:'85.000', views:742 },
    { emoji:'👜', bg:'linear-gradient(135deg,#ede9fe,#ddd6fe)', badge:'Promo', name:'Tas Anyam Rotan Handmade L', shop:'Anyaman Jogja', district:'Yogyakarta', price:'95.000', views:620 },
    { emoji:'🧃', bg:'linear-gradient(135deg,#fff3e8,#ffedd5)', badge:null, name:'Minuman Jahe Merah Sachet 10pcs', shop:'Herbal Segar', district:'Malang', price:'28.000', views:508 },
    { emoji:'🌿', bg:'linear-gradient(135deg,#dcfce7,#bbf7d0)', badge:'Unggulan', name:'Teh Herbal Daun Kelor Organik', shop:'Kebun Organik', district:'Batu', price:'45.000', views:490 },
    { emoji:'🪴', bg:'linear-gradient(135deg,#dbeafe,#e0f2fe)', badge:null, name:'Tanaman Hias Monstera Mini', shop:'Green Corner', district:'Bandung', price:'75.000', views:410 },
    { emoji:'🫙', bg:'linear-gradient(135deg,#fef9c3,#fef3c7)', badge:null, name:'Sambal Bawang Homemade Pedas', shop:'Dapur Lezat', district:'Surabaya', price:'25.000', views:380 },
    { emoji:'🧶', bg:'linear-gradient(135deg,#fce7f3,#fbcfe8)', badge:'Baru', name:'Rajutan Tas Jinjing Handmade', shop:'Rajutan Manis', district:'Bandung', price:'120.000', views:295 },
    { emoji:'🕯️', bg:'linear-gradient(135deg,#fef3c7,#fef9c3)', badge:null, name:'Lilin Aromaterapi Lavender 200g', shop:'Aroma Nusantara', district:'Yogyakarta', price:'55.000', views:260 },
    { emoji:'🎁', bg:'linear-gradient(135deg,#fee2e2,#fecaca)', badge:'Promo', name:'Hampers Lebaran Premium Set', shop:'Dapur Bu Sari', district:'Semarang', price:'250.000', views:240 },
    { emoji:'🫐', bg:'linear-gradient(135deg,#ede9fe,#e0e7ff)', badge:null, name:'Selai Blueberry Homemade 250gr', shop:'Selai Nusantara', district:'Malang', price:'38.000', views:210 },
  ];

  function renderProducts(view) {
    const grid = document.getElementById('products-grid');
    grid.innerHTML = PRODUCTS.map(p => `
      <div class="product-card" onclick="location.href='product-detail.html'" style="cursor:pointer;">
        <div class="product-card-img">
          <div style="width:100%;height:100%;background:${p.bg};display:flex;align-items:center;justify-content:center;font-size:3rem;">${p.emoji}</div>
          ${p.badge ? `<div class="product-card-badge" style="${p.badge==='Baru'?'background:var(--dark)':p.badge==='Promo'?'background:#ef4444':''}">${p.badge}</div>` : ''}
        </div>
        <div class="product-card-body">
          <div class="product-card-shop"><i class="fa-solid fa-store"></i> ${p.shop} · ${p.district}</div>
          <div class="product-card-name">${p.name}</div>
          <div class="flex gap-8 mt-4">
            <div class="product-card-price">Rp ${p.price}</div>
            <span style="font-size:0.72rem;color:var(--dark-light);margin-left:auto;"><i class="fa-regular fa-eye"></i> ${p.views}</span>
          </div>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-wa w-full btn-sm" onclick="event.stopPropagation();chatWA('${p.shop}')">
            <i class="fa-brands fa-whatsapp"></i> Chat WA
          </button>
          <button class="btn btn-ghost btn-sm" onclick="event.stopPropagation();" style="border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:7px 10px;">
            <i class="fa-regular fa-heart"></i>
          </button>
        </div>
      </div>
    `).join('');
  }

  renderProducts('grid');

  function setView(v) {
    const grid = document.getElementById('products-grid');
    document.getElementById('btn-grid').classList.toggle('active', v === 'grid');
    document.getElementById('btn-list').classList.toggle('active', v === 'list');
    grid.classList.toggle('list-view', v === 'list');
  }

  function filterCat(el, cat) {
    document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
  }

  function clearFilters() {
    document.querySelectorAll('.filter-option input').forEach(i => i.checked = false);
  }

  function sortProducts(val) { /* Would re-sort products array */ }

  function chatWA(shop) {
    const msg = encodeURIComponent(`Halo, saya tertarik dengan produk dari ${shop} di PasarLokal.`);
    window.open(`https://wa.me/6281234567890?text=${msg}`, '_blank');
  }
        </script>
    </body>

</html>