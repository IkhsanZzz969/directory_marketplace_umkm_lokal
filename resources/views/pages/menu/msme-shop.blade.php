<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toko UMKM — PasarLokal</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* ── PAGE HERO ── */
    .page-top { padding-top: var(--nav-h); background: var(--dark); }
    .page-hero { padding: 44px 0 52px; }
    .page-hero h1 { color: white; font-size: clamp(1.7rem,3.5vw,2.4rem); margin-bottom: 8px; }
    .page-hero p  { color: rgba(255,255,255,0.55); font-size: .95rem; }
    .breadcrumb   { display: flex; align-items: center; gap: 8px; font-size: .78rem; color: rgba(255,255,255,.4); margin-bottom: 14px; }
    .breadcrumb a { color: rgba(255,255,255,.55); transition: color .18s; }
    .breadcrumb a:hover { color: var(--primary); }
    .breadcrumb span { color: rgba(255,255,255,.2); }

    /* hero search */
    .hero-search-wrap { max-width: 640px; margin-top: 28px; position: relative; z-index: 10; }
    .hero-search-wrap .search-bar {
      border-radius: var(--radius-md);
      box-shadow: 0 8px 32px rgba(0,0,0,.28);
      border-color: transparent;
    }
    .hero-stats-strip {
      display: flex; gap: 32px; margin-top: 28px; flex-wrap: wrap;
    }
    .hero-stat .num  { font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; color: var(--primary); }
    .hero-stat .lbl  { font-size: .75rem; color: rgba(255,255,255,.45); margin-top: 2px; }

    /* ── LAYOUT ── */
    .store-layout {
      display: grid;
      grid-template-columns: 256px 1fr;
      gap: 28px;
      padding: 36px 0 72px;
      align-items: start;
    }

    /* ── FILTER SIDEBAR ── */
    .filter-sidebar { position: sticky; top: calc(var(--nav-h) + 16px); }
    .filter-card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; }
    .filter-head {
      padding: 14px 18px; font-family: var(--font-display); font-weight: 700; font-size: .9rem;
      border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between;
    }
    .filter-reset { font-size: .75rem; color: var(--primary); font-weight: 600; cursor: pointer; font-family: var(--font-body); }
    .filter-sec { padding: 14px 18px; border-bottom: 1px solid var(--border); }
    .filter-sec:last-child { border-bottom: none; }
    .filter-sec-title {
      font-size: .8rem; font-weight: 700; color: var(--dark); margin-bottom: 10px;
      display: flex; align-items: center; justify-content: space-between; cursor: pointer;
    }
    .filter-opts { display: flex; flex-direction: column; gap: 7px; }
    .filter-opt  {
      display: flex; align-items: center; gap: 8px;
      font-size: .83rem; color: var(--dark-mid); cursor: pointer;
      padding: 5px 8px; border-radius: var(--radius-sm); transition: background .15s;
    }
    .filter-opt:hover { background: var(--primary-light); color: var(--primary); }
    .filter-opt input[type=checkbox] { accent-color: var(--primary); flex-shrink: 0; }
    .filter-cnt { margin-left: auto; font-size: .7rem; background: var(--bg); padding: 1px 7px; border-radius: var(--radius-full); color: var(--dark-light); }

    /* district search mini */
    .mini-search { position: relative; margin-bottom: 10px; }
    .mini-search input {
      width: 100%; padding: 7px 10px 7px 30px;
      border: 1.5px solid var(--border); border-radius: var(--radius-sm);
      font-size: .8rem; font-family: var(--font-body); outline: none; color: var(--dark);
    }
    .mini-search input:focus { border-color: var(--primary); }
    .mini-search i { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--dark-light); font-size: .75rem; }

    /* ── MAIN ── */
    .store-topbar {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 18px; gap: 12px; flex-wrap: wrap;
    }
    .result-info { font-size: .87rem; color: var(--dark-mid); }
    .result-info strong { color: var(--dark); }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .sort-sel {
      padding: 8px 12px; border: 1.5px solid var(--border); border-radius: var(--radius-sm);
      font-size: .83rem; font-family: var(--font-body); color: var(--dark); background: var(--white); outline: none; cursor: pointer;
    }
    .view-toggle { display: flex; gap: 4px; }
    .vtbtn {
      width: 34px; height: 34px; border-radius: var(--radius-sm); border: 1.5px solid var(--border);
      background: var(--white); display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--dark-light); transition: all .18s; font-size: .85rem;
    }
    .vtbtn.active, .vtbtn:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }

    /* ── STORE GRID (card view) ── */
    .stores-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }

    .store-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: var(--radius-lg); overflow: hidden;
      transition: all .25s; cursor: pointer;
    }
    .store-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); }

    .sc-banner {
      height: 88px; position: relative;
      display: flex; align-items: flex-end; padding: 0 16px 0;
    }
    .sc-logo {
      width: 60px; height: 60px; border-radius: var(--radius-md);
      border: 3px solid var(--white); background: var(--primary);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.6rem; position: absolute; bottom: -22px; left: 16px;
      box-shadow: var(--shadow-md); flex-shrink: 0;
    }
    .sc-verified {
      position: absolute; top: 10px; right: 10px;
      background: rgba(16,185,129,.9); color: white;
      font-size: .65rem; font-weight: 700; padding: 3px 8px;
      border-radius: var(--radius-full); display: flex; align-items: center; gap: 4px;
    }
    .sc-body { padding: 30px 16px 16px; }
    .sc-name { font-family: var(--font-display); font-weight: 700; font-size: 1rem; color: var(--dark); margin-bottom: 3px; }
    .sc-district { font-size: .75rem; color: var(--dark-light); display: flex; align-items: center; gap: 4px; margin-bottom: 10px; }
    .sc-desc { font-size: .8rem; color: var(--dark-mid); line-height: 1.6; margin-bottom: 12px;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .sc-tags { display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 12px; }
    .sc-tag { padding: 2px 9px; border-radius: var(--radius-full); background: var(--bg); border: 1px solid var(--border); font-size: .68rem; font-weight: 600; color: var(--dark-mid); }
    .sc-divider { height: 1px; background: var(--border); margin-bottom: 12px; }
    .sc-stats { display: flex; gap: 0; }
    .sc-stat { flex: 1; text-align: center; }
    .sc-stat:not(:last-child) { border-right: 1px solid var(--border); }
    .sc-stat-num  { font-family: var(--font-display); font-size: .95rem; font-weight: 700; color: var(--dark); }
    .sc-stat-lbl  { font-size: .68rem; color: var(--dark-light); margin-top: 1px; }
    .sc-footer { padding: 12px 16px; border-top: 1px solid var(--border); display: flex; gap: 8px; }

    /* ── STORE LIST VIEW ── */
    .stores-grid.list-view { grid-template-columns: 1fr; }
    .stores-grid.list-view .store-card { display: flex; flex-direction: row; }
    .stores-grid.list-view .sc-banner { width: 100px; min-width: 100px; height: auto; flex-direction: column; justify-content: center; padding: 16px 0 16px 16px; }
    .stores-grid.list-view .sc-logo { position: static; width: 60px; height: 60px; margin: 0 auto; }
    .stores-grid.list-view .sc-verified { display: none; }
    .stores-grid.list-view .sc-body { flex: 1; padding: 16px; border-left: 1px solid var(--border); display: flex; flex-direction: column; justify-content: center; }
    .stores-grid.list-view .sc-footer { width: 180px; flex-shrink: 0; flex-direction: column; justify-content: center; border-top: none; border-left: 1px solid var(--border); }
    .stores-grid.list-view .sc-divider, .stores-grid.list-view .sc-stats { display: none; }

    /* ── CATEGORY CHIPS STRIP ── */
    .cat-strip { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }

    /* ── PAGINATION ── */
    .pager { display: flex; justify-content: center; margin-top: 40px; }

    /* ── FEATURED BANNER ── */
    .featured-banner {
      background: linear-gradient(120deg, var(--dark) 0%, #3d4b5a 100%);
      border-radius: var(--radius-xl); padding: 28px 32px;
      display: flex; align-items: center; justify-content: space-between; gap: 24px;
      margin-bottom: 28px; position: relative; overflow: hidden;
    }
    .featured-banner::before {
      content: ''; position: absolute; right: -60px; top: -60px;
      width: 220px; height: 220px;
      background: radial-gradient(circle, rgba(253,116,0,.22) 0%, transparent 70%);
    }
    .fb-text h3 { color: white; font-size: 1.05rem; margin-bottom: 5px; }
    .fb-text p  { color: rgba(255,255,255,.55); font-size: .82rem; }
    .fb-actions { display: flex; gap: 10px; flex-shrink: 0; }

    @media (max-width: 1024px) { .stores-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 860px)  { .store-layout { grid-template-columns: 1fr; } .filter-sidebar { position: static; } }
    @media (max-width: 540px)  { .stores-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<!-- ═══ NAVBAR ═══ -->
@include('layouts.partials.navbar')

<!-- ═══ PAGE HERO ═══ -->
<div class="page-top">
  <div class="container">
    <div class="page-hero">
      <div class="breadcrumb">
        <a href="index.html">Beranda</a><span>/</span><span>Toko UMKM</span>
      </div>
      <h1>Direktori Toko UMKM Indonesia</h1>
      <p>Temukan & dukung ribuan pelaku usaha lokal terverifikasi dari seluruh penjuru nusantara.</p>
      <div class="hero-search-wrap">
        <div class="search-bar">
          <i class="fa-solid fa-store" style="padding-left:18px;color:rgba(255,255,255,.5);"></i>
          <input type="text" placeholder="Cari nama toko, kota, atau kategori..." id="search-input">
          <button>Cari Toko</button>
        </div>
      </div>
      <div class="hero-stats-strip">
        <div class="hero-stat"><div class="num">2.480+</div><div class="lbl">Toko Aktif</div></div>
        <div class="hero-stat"><div class="num">38</div><div class="lbl">Kota / Kabupaten</div></div>
        <div class="hero-stat"><div class="num">12K+</div><div class="lbl">Total Produk</div></div>
        <div class="hero-stat"><div class="num">98%</div><div class="lbl">Respon WA &lt; 1 Jam</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ═══ MAIN CONTENT ═══ -->
<div style="background:var(--bg);">
  <div class="container">
    <div class="store-layout">

      <!-- ── FILTER SIDEBAR ── -->
      <aside class="filter-sidebar">
        <div class="filter-card">
          <div class="filter-head">
            <span><i class="fa-solid fa-sliders fa-sm" style="color:var(--primary);margin-right:6px;"></i>Filter</span>
            <span class="filter-reset" onclick="clearFilters()">Reset</span>
          </div>

          <div class="filter-sec">
            <div class="filter-sec-title">Kategori Toko <i class="fa-solid fa-chevron-up fa-xs"></i></div>
            <div class="filter-opts">
              <label class="filter-opt"><input type="checkbox" name="cat_filter" value="semua" onchange="sidebarCatChange(this)" checked> Semua Kategori <span class="filter-cnt">{{ $shops->count() }}</span></label>
              @foreach($categories as $cat)
              <label class="filter-opt"><input type="checkbox" name="cat_filter" value="{{ strtolower(str_replace(' ', '-', $cat)) }}" onchange="sidebarCatChange(this)"> {{ $cat }}</label>
              @endforeach
            </div>
          </div>

          <div class="filter-sec">
            <div class="filter-sec-title">Lokasi <i class="fa-solid fa-chevron-up fa-xs"></i></div>
            <div class="mini-search">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input type="text" placeholder="Cari kota atau kab...">
            </div>
            <div class="filter-opts" style="max-height:180px;overflow-y:auto;">
              @foreach($districts as $d)
              <label class="filter-opt"><input type="checkbox" value="{{ $d['name'] }}" onchange="toggleDistrict(this)"> {{ $d['name'] }}</label>
              @endforeach
            </div>
          </div>

          <div class="filter-sec">
            <div class="filter-sec-title">Status & Verifikasi <i class="fa-solid fa-chevron-up fa-xs"></i></div>
            <div class="filter-opts">
              <label class="filter-opt"><input type="checkbox" checked> ✅ Terverifikasi Admin</label>
              <label class="filter-opt"><input type="checkbox"> ⭐ Toko Unggulan</label>
              <label class="filter-opt"><input type="checkbox"> 🆕 Toko Baru (≤ 3 bln)</label>
              <label class="filter-opt"><input type="checkbox"> 🟢 Online Sekarang</label>
            </div>
          </div>

          <div class="filter-sec">
            <div class="filter-sec-title">Rating Toko <i class="fa-solid fa-chevron-up fa-xs"></i></div>
            <div class="filter-opts">
              <label class="filter-opt"><input type="radio" name="rating"> ⭐⭐⭐⭐⭐ 5.0</label>
              <label class="filter-opt"><input type="radio" name="rating"> ⭐⭐⭐⭐ 4.0 ke atas</label>
              <label class="filter-opt"><input type="radio" name="rating"> ⭐⭐⭐ 3.0 ke atas</label>
            </div>
          </div>

          <div class="filter-sec">
            <div class="filter-sec-title">Jumlah Produk <i class="fa-solid fa-chevron-up fa-xs"></i></div>
            <div class="filter-opts">
              <label class="filter-opt"><input type="radio" name="prod"> Semua</label>
              <label class="filter-opt"><input type="radio" name="prod"> 1 – 20 produk</label>
              <label class="filter-opt"><input type="radio" name="prod"> 21 – 50 produk</label>
              <label class="filter-opt"><input type="radio" name="prod"> 50+ produk</label>
            </div>
          </div>

          <div class="filter-sec" style="border-bottom:none;">
            <button class="btn btn-primary w-full">
              <i class="fa-solid fa-filter"></i> Terapkan Filter
            </button>
          </div>
        </div>
      </aside>

      <!-- ── MAIN STORE AREA ── -->
      <main>
        <!-- Featured join banner -->
        <div class="featured-banner">
          <div class="fb-text">
            <h3>🚀 Punya UMKM? Bergabunglah Sekarang!</h3>
            <p>Daftarkan toko kamu secara gratis dan jangkau ribuan pembeli potensial.</p>
          </div>
          <div class="fb-actions">
            <a href="create-shop.html" class="btn btn-primary btn-sm">Buka Toko Gratis</a>
            <a href="#" class="btn btn-ghost btn-sm" style="color:rgba(255,255,255,.6);">Pelajari →</a>
          </div>
        </div>

        <!-- Category chip strip -->
        <div class="cat-strip">
          <div class="tag active" onclick="filterCat(this, 'semua')">Semua</div>
          @foreach($categories as $cat)
          <div class="tag" onclick="filterCat(this, '{{ strtolower(str_replace(' ', '-', $cat)) }}')">{{ $cat }}</div>
          @endforeach
        </div>

        <!-- Top bar -->
        <div class="store-topbar">
          <div class="result-info">
            Menampilkan <strong><span id="result-count">{{ $shops->count() }}</span></strong> toko
          </div>
          <div class="topbar-right">
            <select class="sort-sel" onchange="sortStores(this.value)">
              <option value="relevance">Paling Relevan</option>
              <option value="rating">Rating Tertinggi</option>
              <option value="products-desc">Produk Terbanyak</option>
              <option value="newest">Terbaru Bergabung</option>
              <option value="transactions">Transaksi Terbanyak</option>
            </select>
            <div class="view-toggle">
              <button class="vtbtn active" id="btn-grid" onclick="setView('grid')"><i class="fa-solid fa-grip"></i></button>
              <button class="vtbtn" id="btn-list" onclick="setView('list')"><i class="fa-solid fa-list"></i></button>
            </div>
          </div>
        </div>

        <!-- Store grid -->
        <div class="stores-grid" id="stores-grid"></div>

        <!-- Pagination -->
        <div class="pager">
          <div class="pagination" id="pagination-container">
            <!-- Pagination rendered by JS -->
          </div>
        </div>
      </main>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer style="background:var(--dark);padding:28px 0;text-align:center;">
  <div class="container">
    <p style="color:rgba(255,255,255,.4);font-size:.82rem;">© 2026 PasarLokal — Platform UMKM Indonesia</p>
  </div>
</footer>

<script>
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
  });

  const SHOPS = [
    @foreach ($shops as $index => $s)
        {
            id: {{ $s->id }},
            slug: '{!! addslashes($s->slug) !!}',
            category_slug: '{!! $s->category ? strtolower(str_replace(' ', '-', $s->category)) : '' !!}',
            category_name: '{!! addslashes($s->category ?? '') !!}',
            image: '{!! $s->logo ?? '' !!}',
            grad: 'linear-gradient(135deg,#fef3c7,#fed7aa)',
            name: '{!! addslashes($s->name) !!}',
            district: '{!! addslashes($s->district ?? '') !!}',
            desc: '{!! addslashes($s->description ?? '') !!}',
            prods: {{ $s->products_count ?? 0 }},
            txn: 0, // Placeholder
            rating: 0, // Placeholder
            verified: true, // Placeholder
            badge: '', // Placeholder
            created_at: '{{ $s->created_at }}',
            wa: '{!! str_replace('+', '', $s->whatsapp_number ?? '') !!}'
        }
        {{ !$loop->last ? ',' : '' }}
    @endforeach
  ];

  let filteredShops = [...SHOPS];
  let currentPage = 1;
  const itemsPerPage = 12;

  function renderStores(view) {
    const grid = document.getElementById('stores-grid');
    if (filteredShops.length === 0) {
        grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--dark-mid);">Pencarian tidak ditemukan. Coba filter lain.</div>';
        document.getElementById('result-count').textContent = '0';
        document.getElementById('pagination-container').innerHTML = '';
        return;
    }

    const startIndex = (currentPage - 1) * itemsPerPage;
    const paginatedShops = filteredShops.slice(startIndex, startIndex + itemsPerPage);

    grid.innerHTML = paginatedShops.map(s => `
      <div class="store-card" onclick="location.href='/toko/${s.slug}'">
        <div class="sc-banner" style="background:${s.grad};">
          <div class="sc-logo">${s.image ? `<img src="/storage/${s.image}" style="width:100%;height:100%;object-fit:cover;border-radius:var(--radius-md);">` : '🛍️'}</div>
          ${s.verified ? '<div class="sc-verified"><i class="fa-solid fa-circle-check fa-xs"></i> Terverifikasi</div>' : ''}
        </div>
        <div class="sc-body">
          <div class="sc-name">${s.name} ${s.badge ? `<span style="font-size:.68rem;color:var(--primary);font-weight:600;margin-left:4px;">${s.badge}</span>` : ''}</div>
          <div class="sc-district"><i class="fa-solid fa-location-dot fa-xs"></i> ${s.district}</div>
          <div class="sc-desc">${s.desc}</div>
          <div class="sc-tags">${s.category_name ? `<span class="sc-tag">${s.category_name}</span>` : ''}</div>
          <div class="sc-divider"></div>
          <div class="sc-stats">
            <div class="sc-stat"><div class="sc-stat-num">${s.prods}</div><div class="sc-stat-lbl">Produk</div></div>
            <div class="sc-stat"><div class="sc-stat-num">${s.txn}+</div><div class="sc-stat-lbl">Transaksi</div></div>
            <div class="sc-stat"><div class="sc-stat-num">${s.rating ? s.rating + '⭐' : '-'}</div><div class="sc-stat-lbl">Rating</div></div>
          </div>
        </div>
        <div class="sc-footer">
          <button class="btn btn-primary w-full btn-sm" onclick="event.stopPropagation();location.href='/toko/${s.slug}'">
            <i class="fa-solid fa-store fa-xs"></i> Lihat Toko
          </button>
          <button class="btn btn-wa w-full btn-sm" onclick="event.stopPropagation();chatWA('${s.name}', '${s.wa}')">
            <i class="fa-brands fa-whatsapp fa-xs"></i> Chat WA
          </button>
        </div>
      </div>
    `).join('');

    document.getElementById('result-count').textContent = filteredShops.length;
    renderPagination();
  }

  function renderPagination() {
      const container = document.getElementById('pagination-container');
      const totalPages = Math.ceil(filteredShops.length / itemsPerPage);
      
      if (totalPages <= 1) {
          container.innerHTML = '';
          return;
      }

      let html = '';
      
      html += `<button class="page-btn" onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : ''}><i class="fa-solid fa-chevron-left fa-xs"></i></button>`;
      
      for (let i = 1; i <= totalPages; i++) {
          if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
              html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
          } else if (i === currentPage - 2 || i === currentPage + 2) {
              html += `<span style="padding:0 4px;color:var(--dark-light);">…</span>`;
          }
      }
      
      html += `<button class="page-btn" onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : ''}><i class="fa-solid fa-chevron-right fa-xs"></i></button>`;

      container.innerHTML = html;
  }

  function goToPage(page) {
      const totalPages = Math.ceil(filteredShops.length / itemsPerPage);
      if (page < 1 || page > totalPages) return;
      currentPage = page;
      renderStores(document.querySelector('.vtbtn.active').id === 'btn-grid' ? 'grid' : 'list');
      window.scrollTo({ top: 300, behavior: 'smooth' });
  }

  renderStores('grid');

  function setView(v) {
    document.getElementById('btn-grid').classList.toggle('active', v==='grid');
    document.getElementById('btn-list').classList.toggle('active', v==='list');
    document.getElementById('stores-grid').classList.toggle('list-view', v==='list');
  }

  // FILTER STATE
  let activeCategory = 'semua';
  let searchQuery = '';
  let selectedDistricts = [];

  function filterCat(el, cat) {
      document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
      if(el) el.classList.add('active');
      
      document.querySelectorAll('input[name="cat_filter"]').forEach(cb => {
          if(cat === 'semua' && cb.value === 'semua') cb.checked = true;
          else if (cat === cb.value) cb.checked = true;
          else cb.checked = false;
      });

      activeCategory = cat;
      applyFilters();
  }

  function sidebarCatChange(cb) {
      if(cb.checked) {
          filterCat(null, cb.value);
          document.querySelectorAll('.tag').forEach(t => {
              t.classList.remove('active');
              if(t.getAttribute('onclick').includes(cb.value)) {
                  t.classList.add('active');
              }
          });
      } else {
          filterCat(null, 'semua');
          document.querySelector('.tag[onclick*="semua"]').classList.add('active');
      }
  }

  function toggleDistrict(cb) {
      if(cb.checked) {
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
      selectedDistricts = [];
      
      document.getElementById('search-input').value = '';
      
      document.querySelectorAll('input[type="checkbox"]').forEach(i => i.checked = false);
      document.querySelector('input[name="cat_filter"][value="semua"]').checked = true;
      
      document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
      document.querySelector('.tag[onclick*="semua"]').classList.add('active');

      applyFilters();
  }

  function applyFilters() {
      currentPage = 1;
      filteredShops = SHOPS.filter(s => {
          let match = true;
          
          if (activeCategory !== 'semua' && s.category_slug !== activeCategory) {
              match = false;
          }
          
          if (searchQuery && !s.name.toLowerCase().includes(searchQuery) && !s.district.toLowerCase().includes(searchQuery)) {
              match = false;
          }
          
          if (selectedDistricts.length > 0 && !selectedDistricts.includes(s.district)) {
              match = false;
          }
          
          return match;
      });
      
      sortStores(document.querySelector('.sort-sel').value);
      renderStores('grid');
  }

  function sortStores(val) {
      if (val === 'relevance') {
          filteredShops.sort((a, b) => a.id - b.id);
      } else if (val === 'newest') {
          filteredShops.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
      } else if (val === 'products-desc') {
          filteredShops.sort((a, b) => b.prods - a.prods);
      }
      // rating and transactions don't have real data yet, leave as default
      
      renderStores('grid');
  }

  function chatWA(name, wa) {
    window.open(`https://wa.me/${wa}?text=${encodeURIComponent('Halo '+name+'! Saya menemukan toko kamu di PasarLokal.')}`, '_blank');
  }
</script>
</body>
</html>
