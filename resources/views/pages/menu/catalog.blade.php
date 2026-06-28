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
            min-width: 0;
            width: 100%;
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
    @include('layouts.partials.navbar')

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
                @foreach ($categories as $cat)
                    <div class="tag" onclick="filterCat(this,'{{ $cat->slug }}')">
                        {{ $cat->name }}</div>
                @endforeach
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
                                <label class="filter-option"><input type="checkbox" name="cat_filter" value="semua"
                                        onchange="sidebarCatChange(this)" checked> Semua Kategori <span
                                        class="filter-count">{{ $products->count() }}</span></label>
                                @foreach ($categories as $cat)
                                    <label class="filter-option"><input type="checkbox" name="cat_filter"
                                            value="{{ $cat->slug }}" onchange="sidebarCatChange(this)">
                                        {{ $cat->name }}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="filter-section">
                            <div class="filter-section-title">
                                Rentang Harga <i class="fa-solid fa-chevron-up fa-xs"></i>
                            </div>
                            <div class="price-range">
                                <input type="number" id="min-price" placeholder="Min" value="0">
                                <span>—</span>
                                <input type="number" id="max-price" placeholder="Max" value="500000">
                            </div>
                            <button class="btn btn-outline btn-sm w-full mt-8" style="margin-top:12px;"
                                onclick="applyPriceFilter()">Terapkan</button>
                        </div>

                        <div class="filter-section">
                            <div class="filter-section-title">
                                Kota / Kabupaten / Kecamatan <i class="fa-solid fa-chevron-up fa-xs"></i>
                            </div>
                            <div class="input-icon-wrap" style="margin-bottom:10px;">
                                <i class="fa-solid fa-magnifying-glass input-icon" style="font-size:0.8rem;"></i>
                                <input class="form-control" style="padding-left:34px;font-size:0.82rem;"
                                    placeholder="Cari kecamatan...">
                            </div>
                            <div class="filter-options" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($districts as $d)
                                    <label class="filter-option"><input type="checkbox" value="{{ $d['name'] }}"
                                            onchange="toggleDistrict(this)"> {{ $d['name'] }}</label>
                                @endforeach
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
                    <div class="active-filters" id="active-filters" style="display:none;">
                    </div>

                    <div class="catalog-topbar">
                        <div class="catalog-result-info">
                            Menampilkan <strong><span id="result-count">{{ $products->count() }}</span></strong> produk
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
                        <div class="pagination" id="pagination-container">
                            <!-- Pagination rendered by JS -->
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

        @php
            $userWishlists = auth()->check() ? auth()->user()->wishlistedProducts()->pluck('products.id')->toArray() : [];
        @endphp
        const PRODUCTS = [
            @foreach ($products as $index => $p)
                {
                    id: {{ $p->id }},
                    slug: '{!! addslashes($p->slug) !!}',
                    category_slug: '{!! $p->category ? addslashes($p->category->slug) : '' !!}',
                    image: '{!! $p->primaryImage->first()->image_path ?? '' !!}',
                    bg: 'linear-gradient(135deg,#fef3c7,#fed7aa)',
                    badge: '{!! $p->is_featured ? 'Terlaris' : ($p->original_price > $p->price ? 'Promo' : '') !!}',
                    name: '{!! addslashes($p->name) !!}',
                    shop: '{!! addslashes($p->shop->name ?? '') !!}',
                    district: '{!! addslashes($p->shop->district ?? '') !!}',
                    price: '{{ number_format($p->price, 0, ',', '.') }}',
                    raw_price: {{ $p->price }},
                    views: {{ $p->views_count ?? 0 }},
                    created_at: '{{ $p->created_at }}',
                    wa: '{!! str_replace('+', '', $p->shop->whatsapp_number ?? '') !!}',
                    is_wishlisted: {{ in_array($p->id, $userWishlists) ? 'true' : 'false' }}
                }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ];

        let filteredProducts = [...PRODUCTS];
        let currentPage = 1;
        const itemsPerPage = 12;

        function renderProducts(view) {
            const grid = document.getElementById('products-grid');
            if (filteredProducts.length === 0) {
                grid.innerHTML =
                    '<div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--dark-mid);">Pencarian tidak ditemukan. Coba filter lain.</div>';
                document.getElementById('result-count').textContent = '0';
                document.getElementById('pagination-container').innerHTML = '';
                return;
            }

            const startIndex = (currentPage - 1) * itemsPerPage;
            const paginatedProducts = filteredProducts.slice(startIndex, startIndex + itemsPerPage);

            grid.innerHTML = paginatedProducts.map(p => `
      <div class="product-card" onclick="location.href='/produk/${p.slug}'" style="cursor:pointer;">
        <div class="product-card-img">
          ${p.image ? `<img src="/storage/${p.image}" style="width:100%;height:100%;object-fit:cover;">` : `<div style="width:100%;height:100%;background:${p.bg};display:flex;align-items:center;justify-content:center;font-size:3rem;">🛍️</div>`}
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
          <button class="btn btn-wa w-full btn-sm" onclick="event.stopPropagation();chatWA('${p.shop}', '${p.wa}')">
            <i class="fa-brands fa-whatsapp"></i> Chat WA
          </button>
          <form id="wishlist-form-${p.id}" action="/produk/${p.id}/wishlist" method="POST" style="display:none;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
          <button class="btn btn-ghost btn-sm" onclick="event.stopPropagation(); document.getElementById('wishlist-form-${p.id}').submit();" style="border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:7px 10px; ${p.is_wishlisted ? 'border-color:#ef4444; color:#ef4444; background:var(--white);' : ''}">
            <i class="${p.is_wishlisted ? 'fa-solid' : 'fa-regular'} fa-heart"></i>
          </button>
        </div>
      </div>
    `).join('');

            document.getElementById('result-count').textContent = filteredProducts.length;
            renderPagination();
        }

        function renderPagination() {
            const container = document.getElementById('pagination-container');
            const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '';

            // Prev Button
            html +=
                `<button class="page-btn" onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : ''}><i class="fa-solid fa-chevron-left fa-xs"></i></button>`;

            // Pages
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    html +=
                        `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    html += `<span style="padding:0 4px;color:var(--dark-light);">…</span>`;
                }
            }

            // Next Button
            html +=
                `<button class="page-btn" onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : ''}><i class="fa-solid fa-chevron-right fa-xs"></i></button>`;

            container.innerHTML = html;
        }

        function goToPage(page) {
            const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderProducts(document.querySelector('.view-btn.active').id === 'btn-grid' ? 'grid' : 'list');
            window.scrollTo({
                top: 300,
                behavior: 'smooth'
            }); // Scroll back up to products
        }

        renderProducts('grid');

        function setView(v) {
            const grid = document.getElementById('products-grid');
            document.getElementById('btn-grid').classList.toggle('active', v === 'grid');
            document.getElementById('btn-list').classList.toggle('active', v === 'list');
            grid.classList.toggle('list-view', v === 'list');
        }

        // FILTER STATE
        let activeCategory = 'semua';
        let searchQuery = '';
        let minPrice = 0;
        let maxPrice = 0;
        let selectedDistricts = [];

        function filterCat(el, cat) {
            document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
            if (el) el.classList.add('active');

            // Sync with sidebar category checkboxes
            document.querySelectorAll('input[name="cat_filter"]').forEach(cb => {
                if (cat === 'semua' && cb.value === 'semua') cb.checked = true;
                else if (cat === cb.value) cb.checked = true;
                else cb.checked = false;
            });

            activeCategory = cat;
            applyFilters();
        }

        function sidebarCatChange(cb) {
            if (cb.checked) {
                filterCat(null, cb.value);
                // Also update chips
                document.querySelectorAll('.tag').forEach(t => {
                    t.classList.remove('active');
                    if (t.getAttribute('onclick').includes(cb.value)) {
                        t.classList.add('active');
                    }
                });
            } else {
                filterCat(null, 'semua');
                document.querySelector('.tag[onclick*="semua"]').classList.add('active');
            }
        }

        function applyPriceFilter() {
            minPrice = parseInt(document.getElementById('min-price').value) || 0;
            maxPrice = parseInt(document.getElementById('max-price').value) || 0;
            applyFilters();
        }

        function toggleDistrict(cb) {
            if (cb.checked) {
                selectedDistricts.push(cb.value);
            } else {
                selectedDistricts = selectedDistricts.filter(d => d !== cb.value);
            }
            applyFilters();
        }

        document.getElementById('search-input').addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase();
            applyFilters();
        });

        function clearFilters() {
            activeCategory = 'semua';
            searchQuery = '';
            minPrice = 0;
            maxPrice = 0;
            selectedDistricts = [];

            document.getElementById('search-input').value = '';
            document.getElementById('min-price').value = '0';
            document.getElementById('max-price').value = '500000';

            document.querySelectorAll('input[type="checkbox"]').forEach(i => i.checked = false);
            document.querySelector('input[name="cat_filter"][value="semua"]').checked = true;

            document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
            document.querySelector('.tag[onclick*="semua"]').classList.add('active');

            applyFilters();
        }

        function applyFilters() {
            currentPage = 1;
            filteredProducts = PRODUCTS.filter(p => {
                let match = true;

                // Category
                if (activeCategory !== 'semua' && p.category_slug !== activeCategory) {
                    match = false;
                }

                // Search
                if (searchQuery && !p.name.toLowerCase().includes(searchQuery) && !p.shop.toLowerCase().includes(
                        searchQuery)) {
                    match = false;
                }

                // Price
                if (minPrice > 0 && p.raw_price < minPrice) match = false;
                if (maxPrice > 0 && p.raw_price > maxPrice) match = false;

                // District
                if (selectedDistricts.length > 0 && !selectedDistricts.includes(p.district)) {
                    match = false;
                }

                return match;
            });

            sortProducts(document.querySelector('.sort-select').value);
            renderProducts('grid');
        }

        function sortProducts(val) {
            if (val === 'relevance') {
                filteredProducts.sort((a, b) => a.id - b.id);
            } else if (val === 'newest') {
                filteredProducts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (val === 'price-asc') {
                filteredProducts.sort((a, b) => a.raw_price - b.raw_price);
            } else if (val === 'price-desc') {
                filteredProducts.sort((a, b) => b.raw_price - a.raw_price);
            } else if (val === 'views') {
                filteredProducts.sort((a, b) => b.views - a.views);
            }
            // For 'rating', we don't have rating in DB yet, leave as default

            renderProducts('grid');
        }

        function chatWA(shop, wa) {
            @auth
                const msg = encodeURIComponent(`Halo, saya tertarik dengan produk dari ${shop} di PasarLokal.`);
                window.open(`https://wa.me/${wa}?text=${msg}`, '_blank');
            @else
                alert('Silakan login terlebih dahulu untuk menghubungi penjual.');
                window.location.href = "{{ route('login') }}";
            @endauth
        }
    </script>
</body>

</html>
