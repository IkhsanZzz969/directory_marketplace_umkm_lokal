<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Saya — PasarLokal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <style>
        .page-content {
            padding-top: var(--nav-h);
            min-height: 100vh;
            background: var(--bg);
        }

        /* ── PROFILE HEADER ── */
        .profile-header {
            background: var(--dark);
            padding: 36px 0 0;
        }

        .profile-header-inner {
            display: flex;
            align-items: flex-end;
            gap: 24px;
            padding-bottom: 0;
        }

        .profile-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .profile-avatar {
            width: 96px;
            height: 96px;
            border-radius: var(--radius-full);
            border: 4px solid var(--white);
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            font-weight: 700;
            color: white;
            font-family: var(--font-display);
            box-shadow: var(--shadow-lg);
        }

        .avatar-edit-btn {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 26px;
            height: 26px;
            background: var(--primary);
            border-radius: var(--radius-full);
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            font-size: .65rem;
            transition: background .18s;
        }

        .avatar-edit-btn:hover {
            background: var(--primary-dark);
        }

        .profile-info {
            flex: 1;
            padding-bottom: 4px;
        }

        .profile-name {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .profile-email {
            font-size: .82rem;
            color: rgba(255, 255, 255, .55);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .profile-badges {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .profile-badge {
            padding: 3px 10px;
            border-radius: var(--radius-full);
            font-size: .68rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pb-buyer {
            background: rgba(253, 116, 0, .2);
            color: var(--primary);
        }

        .pb-umkm {
            background: rgba(16, 185, 129, .2);
            color: #34d399;
        }

        .pb-verify {
            background: rgba(16, 185, 129, .85);
            color: white;
        }

        .profile-header-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
            padding-bottom: 4px;
        }

        /* ── PROFILE TABS NAV ── */
        .profile-tabs {
            display: flex;
            gap: 0;
            border-top: 1px solid rgba(255, 255, 255, .1);
            margin-top: 20px;
            overflow-x: auto;
        }

        .ptab {
            padding: 13px 18px;
            font-size: .83rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .45);
            cursor: pointer;
            transition: all .18s;
            border-bottom: 2.5px solid transparent;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ptab:hover {
            color: rgba(255, 255, 255, .8);
        }

        .ptab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .ptab .badge-dot {
            width: 18px;
            height: 18px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .65rem;
            color: white;
            font-weight: 700;
        }

        /* ── MAIN LAYOUT ── */
        .profile-layout {
            display: grid;
            grid-template-columns: 256px 1fr;
            gap: 28px;
            padding: 32px 0 72px;
            align-items: start;
        }

        /* ── LEFT SIDEBAR ── */
        .profile-sidebar {
            position: sticky;
            top: calc(var(--nav-h)+16px);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .ps-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .ps-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: .85rem;
            font-weight: 500;
            color: var(--dark-mid);
            cursor: pointer;
            transition: all .18s;
            border-left: 3px solid transparent;
        }

        .ps-nav-item:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary-light);
        }

        .ps-nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .ps-nav-item .icon {
            width: 20px;
            text-align: center;
            font-size: .9rem;
        }

        .ps-nav-sep {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        .ps-logout {
            color: var(--danger) !important;
        }

        .ps-logout:hover {
            background: #fee2e2 !important;
            border-left-color: var(--danger) !important;
        }

        /* completion card */
        .completion-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px;
        }

        .completion-title {
            font-size: .82rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .completion-bar-wrap {
            height: 8px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .completion-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), #ff9944);
            border-radius: 4px;
            transition: width .4s ease;
        }

        .completion-pct {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .completion-tips {
            list-style: none;
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .completion-tip {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .75rem;
            color: var(--dark-light);
        }

        .completion-tip.done {
            color: var(--success);
        }

        .completion-tip .dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .55rem;
            flex-shrink: 0;
        }

        .completion-tip.done .dot {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        /* ── MAIN PANELS ── */
        .panel {
            display: none;
        }

        .panel.active {
            display: block;
        }

        .panel-header {
            margin-bottom: 24px;
        }

        .panel-header h3 {
            font-size: 1.15rem;
            margin-bottom: 4px;
        }

        .panel-header p {
            font-size: .83rem;
            color: var(--dark-light);
        }

        /* info card */
        .info-panel-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 20px;
        }

        /* edit form grid */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* activity timeline */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .tl-item {
            display: flex;
            gap: 14px;
            padding-bottom: 20px;
            position: relative;
        }

        .tl-item:last-child {
            padding-bottom: 0;
        }

        .tl-item::before {
            content: '';
            position: absolute;
            left: 14px;
            top: 28px;
            bottom: 0;
            width: 2px;
            background: var(--border);
        }

        .tl-item:last-child::before {
            display: none;
        }

        .tl-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            position: relative;
            z-index: 1;
        }

        .tl-content {
            flex: 1;
            padding-top: 4px;
        }

        .tl-title {
            font-size: .88rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 2px;
        }

        .tl-sub {
            font-size: .78rem;
            color: var(--dark-light);
        }

        .tl-time {
            font-size: .72rem;
            color: var(--dark-light);
            margin-top: 3px;
        }

        /* wishlist grid */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        /* setting row */
        .setting-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .setting-row:last-child {
            border-bottom: none;
        }

        .setting-info .setting-label {
            font-size: .88rem;
            font-weight: 600;
            color: var(--dark);
        }

        .setting-info .setting-desc {
            font-size: .78rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        /* toggle switch */
        .toggle {
            position: relative;
            width: 44px;
            height: 24px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .toggle-track {
            position: absolute;
            inset: 0;
            background: var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: background .2s;
        }

        .toggle input:checked+.toggle-track {
            background: var(--primary);
        }

        .toggle-track::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            transition: transform .2s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        .toggle input:checked+.toggle-track::after {
            transform: translateX(20px);
        }

        /* store CTA panel */
        .store-cta-card {
            background: linear-gradient(135deg, var(--dark) 0%, #3d4b5a 100%);
            border-radius: var(--radius-xl);
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .store-cta-card::before {
            content: '';
            position: absolute;
            right: -60px;
            top: -60px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(253, 116, 0, .22) 0%, transparent 70%);
        }

        .store-cta-card .icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .store-cta-card h3 {
            color: white;
            margin-bottom: 8px;
        }

        .store-cta-card p {
            color: rgba(255, 255, 255, .6);
            margin-bottom: 24px;
            font-size: .9rem;
            max-width: 380px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 900px) {
            .profile-layout {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                position: static;
            }

            .wishlist-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 540px) {
            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
            }

            .profile-header-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* ── MODAL OVERLAY ── */
        .success-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(46, 53, 61, .6);
            backdrop-filter: blur(6px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .success-box {
            background: white;
            border-radius: var(--radius-xl);
            padding: 32px;
            max-width: 480px;
            width: 90%;
            box-shadow: var(--shadow-xl);
            animation: modalPopIn .25s ease;
        }

        @keyframes modalPopIn {
            from {
                transform: scale(.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <!-- ═══ NAVBAR ═══ -->
    @include('layouts.partials.navbar')

    <div class="page-content">

        <!-- ══ PROFILE HEADER ══ -->
        <div class="profile-header">
            <div class="container">
                <div class="profile-header-inner">
                    <div class="profile-avatar-wrap">
                        <div class="profile-avatar">
                            <img id="avatarImagePreview" src="{{ auth()->user()->avatar_url }}" alt="Profile Avatar"
                                style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <input type="file" id="avatarFileInput" accept="image/*" style="display: none;">
                        <div class="avatar-edit-btn" title="Ganti foto" id="editProfileAvatar"><i
                                class="fa-solid fa-camera"></i></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-email">
                            <i class="fa-regular fa-envelope fa-xs"></i> {{ auth()->user()->email }}
                            <span
                                style="background:rgba(16,185,129,.2);color:#34d399;padding:1px 7px;border-radius:var(--radius-full);font-size:.65rem;font-weight:700;margin-left:4px;">Email
                                Terverifikasi</span>
                        </div>
                        <div class="profile-badges">
                            @if (Auth::user()->role === 'user')
                                <span class="profile-badge pb-buyer"><i class="fa-solid fa-user fa-xs"></i>
                                    Pembeli</span>
                            @endif
                            @if (Auth::user()->role === 'umkm')
                                <span class="profile-badge pb-umkm"><i class="fa-solid fa-store fa-xs"></i> Pemilik
                                    UMKM</span>
                            @endif
                            <span class="profile-badge pb-verify"><i class="fa-solid fa-circle-check fa-xs"></i>
                                Terverifikasi</span>
                        </div>
                    </div>
                    <div class="profile-header-actions">
                        @if (Auth::user()->role === 'umkm')
                            @if (!auth()->user()->shops)
                                <a href="{{ route('shop.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fa-solid fa-store"></i> Buat Toko</a>
                            @elseif(auth()->user()->shops->status === 'pending')
                                <button class="btn btn-secondary btn-sm" disabled><i class="fa-solid fa-store"></i> Toko
                                    sedang ditinjau</button>
                            @else
                                <a href="{{ route('shop.manage') }}" class="btn btn-primary btn-sm"><i
                                        class="fa-solid fa-store"></i> Kelola Toko</a>
                            @endif
                        @endif
                        <button class="btn btn-ghost btn-sm"
                            style="color:rgba(255,255,255,.6);border:1.5px solid rgba(255,255,255,.2);">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                    </div>
                </div>
                <!-- Tabs -->
                <div class="profile-tabs">
                    <div class="ptab active" onclick="showPanel('dashboard',this)"><i
                            class="fa-solid fa-house fa-xs"></i> Dashboard</div>
                    <div class="ptab" onclick="showPanel('edit-profil',this)"><i
                            class="fa-solid fa-user-pen fa-xs"></i> Edit Profil</div>
                    @if (Auth::user()->role === 'user')
                        <div class="ptab" onclick="showPanel('wishlist',this)"><i
                                class="fa-regular fa-heart fa-xs"></i> Wishlist <span class="badge-dot">6</span></div>
                    @endif
                    <div class="ptab" onclick="showPanel('riwayat',this)"><i
                            class="fa-solid fa-clock-rotate-left fa-xs"></i> Riwayat Chat</div>
                    @if (Auth::user()->role === 'umkm')
                        <div class="ptab" onclick="showPanel('toko-saya',this)"><i
                                class="fa-solid fa-store fa-xs"></i> Toko Saya</div>
                    @endif
                    <div class="ptab" onclick="showPanel('pengaturan',this)"><i class="fa-solid fa-gear fa-xs"></i>
                        Pengaturan</div>
                </div>
            </div>
        </div>

        <!-- ══ MAIN LAYOUT ══ -->
        <div class="container">
            <div class="profile-layout">

                <!-- ── SIDEBAR ── -->
                <aside class="profile-sidebar">
                    <!-- Completion card -->
                    <div class="completion-card">
                        <div class="completion-title">Kelengkapan Profil</div>
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                            <span style="font-size:.75rem;color:var(--dark-light);">Lengkapi untuk kepercayaan
                                lebih</span>
                            <span class="completion-pct">75%</span>
                        </div>
                        <div class="completion-bar-wrap">
                            <div class="completion-bar" style="width:75%;"></div>
                        </div>
                        <ul class="completion-tips">
                            <li class="completion-tip done">
                                <div class="dot"><i class="fa-solid fa-check fa-xs"></i></div>Foto profil diunggah
                            </li>
                            <li class="completion-tip done">
                                <div class="dot"><i class="fa-solid fa-check fa-xs"></i></div>Email terverifikasi
                            </li>
                            <li class="completion-tip done">
                                <div class="dot"><i class="fa-solid fa-check fa-xs"></i></div>Nomor WA terdaftar
                            </li>
                            <li class="completion-tip">
                                <div class="dot"></div>Lengkapi bio singkat
                            </li>
                        </ul>
                    </div>

                    <!-- Quick nav -->
                    <div class="ps-card">
                        <div class="ps-nav-item active" onclick="showPanel('dashboard',null); setActive(this)"><span
                                class="icon"><i class="fa-solid fa-house"></i></span> Dashboard</div>
                        <div class="ps-nav-item" onclick="showPanel('edit-profil',null); setActive(this)"><span
                                class="icon"><i class="fa-solid fa-user-pen"></i></span> Edit Profil</div>
                        @if (Auth::user()->role === 'user')
                            <div class="ps-nav-item" onclick="showPanel('wishlist',null); setActive(this)"><span
                                    class="icon"><i class="fa-regular fa-heart"></i></span> Wishlist <span
                                    class="badge badge-primary"
                                    style="margin-left:auto;font-size:.65rem;padding:1px 7px;">6</span></div>
                        @endif
                        <div class="ps-nav-item" onclick="showPanel('riwayat',null); setActive(this)"><span
                                class="icon"><i class="fa-solid fa-clock-rotate-left"></i></span> Riwayat Chat</div>
                        <div class="ps-nav-sep"></div>
                        @if (Auth::user()->role === 'umkm')
                            <div class="ps-nav-item" onclick="showPanel('toko-saya',null); setActive(this)"><span
                                    class="icon"><i class="fa-solid fa-store"></i></span> Toko Saya</div>
                        @endif
                        <div class="ps-nav-item" onclick="showPanel('pengaturan',null); setActive(this)"><span
                                class="icon"><i class="fa-solid fa-gear"></i></span> Pengaturan</div>
                        <div class="ps-nav-sep"></div>
                        <div class="ps-nav-item ps-logout" onclick="confirmLogout()"><span class="icon"><i
                                    class="fa-solid fa-right-from-bracket"></i></span> Keluar</div>
                    </div>
                </aside>

                <!-- ── MAIN PANELS ── -->
                <main>

                    <!-- ■ DASHBOARD ■ -->
                    <div class="panel active" id="panel-dashboard">
                        <div class="panel-header">
                            <h3>Selamat Datang, {{ Auth::user()->name }} 👋</h3>
                            <p>Pantau aktivitas dan ringkasan akun kamu di sini.</p>
                        </div>

                        <!-- Quick stat cards -->
                        <div class="grid-4" style="margin-bottom:24px;">
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid var(--primary);">
                                <div style="font-size:1.8rem;margin-bottom:6px;">❤️</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    6</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Produk Wishlist</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #25D366;">
                                <div style="font-size:1.8rem;margin-bottom:6px;">💬</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    14</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Chat via WA</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #8b5cf6;">
                                <div style="font-size:1.8rem;margin-bottom:6px;">🏪</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    1</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Toko Dimiliki</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #fbbf24;">
                                <div style="font-size:1.8rem;margin-bottom:6px;">⭐</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    4.9</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Rating Toko</div>
                            </div>
                        </div>

                        <!-- Activity timeline -->
                        <div class="info-panel-card">
                            <div class="info-card-title"
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                                <i class="fa-solid fa-bolt" style="color:var(--primary);"></i> Aktivitas Terakhir
                            </div>
                            <div class="timeline">
                                <div class="tl-item">
                                    <div class="tl-dot" style="background:var(--primary-light);color:var(--primary);">
                                        <i class="fa-regular fa-heart fa-xs"></i>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Menyimpan produk ke wishlist</div>
                                        <div class="tl-sub">Batik Tulis Motif Kawung — Batik Nusantara</div>
                                        <div class="tl-time">2 jam yang lalu</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-dot" style="background:#d1fae5;color:var(--success);"><i
                                            class="fa-brands fa-whatsapp fa-xs"></i></div>
                                    <div class="tl-content">
                                        <div class="tl-title">Chat WA dikirim ke Dapur Bu Sari</div>
                                        <div class="tl-sub">Produk: Nastar Keju Premium 500gr</div>
                                        <div class="tl-time">Kemarin, 14.30</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-dot" style="background:#dbeafe;color:#3b82f6;"><i
                                            class="fa-solid fa-eye fa-xs"></i></div>
                                    <div class="tl-content">
                                        <div class="tl-title">Melihat halaman toko</div>
                                        <div class="tl-sub">Anyaman Jogja — Kotagede, Yogyakarta</div>
                                        <div class="tl-time">2 hari yang lalu</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-dot" style="background:#f3e8ff;color:#8b5cf6;"><i
                                            class="fa-solid fa-store fa-xs"></i></div>
                                    <div class="tl-content">
                                        <div class="tl-title">Menambahkan produk baru ke toko</div>
                                        <div class="tl-sub">Hampers Lebaran Premium Set — Dapur Bu Sari</div>
                                        <div class="tl-time">3 hari yang lalu</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-dot" style="background:var(--primary-light);color:var(--primary);">
                                        <i class="fa-solid fa-user-plus fa-xs"></i>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Akun berhasil dibuat & diverifikasi</div>
                                        <div class="tl-sub">Selamat bergabung di PasarLokal!</div>
                                        <div class="tl-time">5 hari yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Suggested products -->
                        <div class="info-panel-card">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
                                <span><i class="fa-solid fa-wand-magic-sparkles"
                                        style="color:var(--primary);margin-right:8px;"></i>Rekomendasi Untukmu</span>
                                <a href="catalog.html"
                                    style="font-size:.78rem;color:var(--primary);font-weight:600;font-family:var(--font-body);">Lihat
                                    semua →</a>
                            </div>
                            <div class="grid-3" style="gap:14px;">
                                <div class="product-card" onclick="location.href='product-detail.html'"
                                    style="cursor:pointer;">
                                    <div class="product-card-img">
                                        <div
                                            style="width:100%;height:100%;background:linear-gradient(135deg,#dbeafe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
                                            🎨</div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-card-shop"><i class="fa-solid fa-store fa-xs"></i> Batik
                                            Nusantara</div>
                                        <div class="product-card-name">Batik Tulis Motif Kawung</div>
                                        <div class="product-card-price">Rp 185.000</div>
                                    </div>
                                    <div class="product-card-actions">
                                        <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                            Chat WA</button>
                                    </div>
                                </div>
                                <div class="product-card" onclick="location.href='product-detail.html'"
                                    style="cursor:pointer;">
                                    <div class="product-card-img">
                                        <div
                                            style="width:100%;height:100%;background:linear-gradient(135deg,#d1fae5,#a7f3d0);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
                                            🍯</div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-card-shop"><i class="fa-solid fa-store fa-xs"></i> Lebah
                                            Madu Asli</div>
                                        <div class="product-card-name">Madu Hutan Murni 500ml</div>
                                        <div class="product-card-price">Rp 85.000</div>
                                    </div>
                                    <div class="product-card-actions">
                                        <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                            Chat WA</button>
                                    </div>
                                </div>
                                <div class="product-card" onclick="location.href='product-detail.html'"
                                    style="cursor:pointer;">
                                    <div class="product-card-img">
                                        <div
                                            style="width:100%;height:100%;background:linear-gradient(135deg,#ede9fe,#ddd6fe);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
                                            👜</div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-card-shop"><i class="fa-solid fa-store fa-xs"></i> Anyaman
                                            Jogja</div>
                                        <div class="product-card-name">Tas Anyam Rotan Handmade</div>
                                        <div class="product-card-price">Rp 95.000</div>
                                    </div>
                                    <div class="product-card-actions">
                                        <button class="btn btn-wa w-full btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                            Chat WA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ■ EDIT PROFIL ■ -->
                    <div class="panel" id="panel-edit-profil">
                        <div class="panel-header">
                            <h3>Edit Profil</h3>
                            <p>Perbarui informasi pribadi kamu di sini.</p>
                        </div>
                        <div class="info-panel-card">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:20px;">
                                Informasi Dasar</div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span>*</span></label>
                                    <input class="form-control" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-at input-icon"></i>
                                        <input class="form-control" value="{{ Auth::user()->username }}"
                                            placeholder="username_kamu">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email <span>*</span></label>
                                    <input class="form-control" value="{{ Auth::user()->email }}" type="email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nomor WhatsApp <span>*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-brands fa-whatsapp input-icon" style="color:#25D366;"></i>
                                        <input class="form-control" value="{{ Auth::user()->phone }}"
                                            type="tel">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="Contoh: Jl. Pemuda No. 12, RT 03/RW 05, Semarang Tengah, Kota Semarang, Jawa Tengah 50132.">{{ Auth::user()->address }}</textarea>
                            </div>
                            <div style="display:flex;gap:12px;justify-content:flex-end;">
                                <button class="btn btn-ghost">Batal</button>
                                <button class="btn btn-primary" onclick="saveProfile()"><i
                                        class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                            </div>
                        </div>

                        <div class="info-panel-card">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:20px;">
                                Ganti Password</div>
                            <div class="form-group">
                                <label class="form-label">Password Lama <span>*</span></label>
                                <div class="input-icon-wrap" style="position:relative;">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-control" placeholder="Password saat ini">
                                </div>
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Password Baru <span>*</span></label>
                                    <input type="password" class="form-control" placeholder="Password baru">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password <span>*</span></label>
                                    <input type="password" class="form-control" placeholder="Ulangi password baru">
                                </div>
                            </div>
                            <div style="display:flex;justify-content:flex-end;">
                                <button class="btn btn-dark"><i class="fa-solid fa-key"></i> Update Password</button>
                            </div>
                        </div>
                    </div>

                    <!-- ■ WISHLIST ■ -->
                    <div class="panel" id="panel-wishlist">
                        <div class="panel-header">
                            <h3>Wishlist Saya</h3>
                            <p>Produk yang kamu simpan untuk dibeli nanti.</p>
                        </div>
                        <div class="wishlist-grid" id="wishlist-grid"></div>
                    </div>

                    <!-- ■ RIWAYAT ■ -->
                    <div class="panel" id="panel-riwayat">
                        <div class="panel-header">
                            <h3>Riwayat Chat WhatsApp</h3>
                            <p>Produk yang pernah kamu hubungi via WhatsApp.</p>
                        </div>
                        <div class="info-panel-card" style="padding:0;overflow:hidden;">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Toko</th>
                                        <th>Waktu Chat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;font-size:.88rem;color:var(--dark);">🍪 Nastar
                                                Keju Premium 500gr</div>
                                            <div style="font-size:.75rem;color:var(--dark-light);">Rp 65.000</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.85rem;color:var(--dark);">Dapur Bu Sari</div>
                                            <div style="font-size:.72rem;color:var(--dark-light);">Semarang</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.82rem;">Kemarin, 14.30</div>
                                        </td>
                                        <td><button class="btn btn-wa btn-sm" onclick="chatAgain('Dapur Bu Sari')"><i
                                                    class="fa-brands fa-whatsapp"></i> Chat Lagi</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;font-size:.88rem;color:var(--dark);">👜 Tas
                                                Anyam Rotan Handmade L</div>
                                            <div style="font-size:.75rem;color:var(--dark-light);">Rp 95.000</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.85rem;color:var(--dark);">Anyaman Jogja</div>
                                            <div style="font-size:.72rem;color:var(--dark-light);">Yogyakarta</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.82rem;">3 hari lalu</div>
                                        </td>
                                        <td><button class="btn btn-wa btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                                Chat Lagi</button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;font-size:.88rem;color:var(--dark);">🍯 Madu
                                                Hutan Murni 500ml</div>
                                            <div style="font-size:.75rem;color:var(--dark-light);">Rp 85.000</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.85rem;color:var(--dark);">Lebah Madu Asli</div>
                                            <div style="font-size:.72rem;color:var(--dark-light);">Pekalongan</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.82rem;">5 hari lalu</div>
                                        </td>
                                        <td><button class="btn btn-wa btn-sm"><i class="fa-brands fa-whatsapp"></i>
                                                Chat Lagi</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ■ TOKO SAYA ■ -->
                    <div class="panel" id="panel-toko-saya">
                        <div class="panel-header">
                            <h3>Toko Saya</h3>
                            <p>Kelola toko dan produk UMKM kamu.</p>
                        </div>

                        @if (auth()->user()->shops)
                            <!-- Toko summary card -->
                            <div class="info-panel-card"
                                style="display:flex;gap:20px;align-items:center;flex-wrap:wrap;">
                                <div
                                    style="width:64px;height:64px;background:var(--primary);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;">
                                    🍱</div>
                                <div style="flex:1;">
                                    <div
                                        style="font-family:var(--font-display);font-weight:700;font-size:1.1rem;color:var(--dark);">
                                        {{ auth()->user()->shops->name }}</div>
                                    <div style="font-size:.78rem;color:var(--dark-light);margin-top:4px;"><i
                                            class="fa-solid fa-location-dot fa-xs"></i>
                                        {{ auth()->user()->shops->district }}</div>
                                    <div style="display:flex;gap:8px;margin-top:8px;">
                                        @if (Auth::user()->shops->status === 'approved')
                                            <span class="badge badge-success"><i
                                                    class="fa-solid fa-circle-check fa-xs"></i> Disetujui</span>
                                        @elseif(Auth::user()->shops->status === 'pending')
                                            <span class="badge badge-secondary"><i
                                                    class="fa-solid fa-clock fa-xs"></i> Menunggu</span>
                                        @elseif(Auth::user()->shops->status === 'rejected')
                                            <span class="badge badge-danger"><i class="fa-solid fa-xmark fa-xs"></i>
                                                Ditolak</span>
                                        @endif
                                        @if (Auth::user()->shops->status === 'approved')
                                            <span class="badge badge-primary">⭐ 4.9 Rating</span>
                                        @endif
                                    </div>
                                </div>
                                <div style="display:flex;gap:10px;flex-shrink:0;flex-wrap:wrap;">
                                    @if (Auth::user()->shops->status === 'approved')
                                        <a href="store-profile.html" class="btn btn-outline btn-sm"><i
                                                class="fa-solid fa-eye"></i> Lihat Publik</a>
                                        <a href="{{ route('shop.edit') }}" class="btn btn-primary btn-sm"><i
                                                class="fa-solid fa-pen"></i> Edit Toko</a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled><i
                                                class="fa-solid fa-store"></i> Toko sedang ditinjau</button>
                                    @endif
                                </div>
                            </div>

                            @if (Auth::user()->shops->status === 'approved')
                                <!-- Toko stats -->
                                <div class="grid-4" style="margin-bottom:20px;">
                                    <div class="info-panel-card"
                                        style="padding:16px;margin-bottom:0;text-align:center;">
                                        <div
                                            style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--primary);">
                                            48</div>
                                        <div style="font-size:.75rem;color:var(--dark-light);">Total Produk</div>
                                    </div>
                                    <div class="info-panel-card"
                                        style="padding:16px;margin-bottom:0;text-align:center;">
                                        <div
                                            style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--success);">
                                            320</div>
                                        <div style="font-size:.75rem;color:var(--dark-light);">Kontak WA Masuk</div>
                                    </div>
                                    <div class="info-panel-card"
                                        style="padding:16px;margin-bottom:0;text-align:center;">
                                        <div
                                            style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:#8b5cf6;">
                                            1.2K</div>
                                        <div style="font-size:.75rem;color:var(--dark-light);">Total Dilihat</div>
                                    </div>
                                    <div class="info-panel-card"
                                        style="padding:16px;margin-bottom:0;text-align:center;">
                                        <div
                                            style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:#fbbf24;">
                                            4.9⭐</div>
                                        <div style="font-size:.75rem;color:var(--dark-light);">Avg Rating</div>
                                    </div>
                                </div>

                                <!-- Quick actions -->
                                <div class="info-panel-card">
                                    <div
                                        style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:16px;">
                                        Aksi Cepat</div>
                                    <div style="display:flex;gap:12px;flex-wrap:wrap;">
                                        <a href="{{ route('product.create') }}" class="btn btn-primary"><i
                                                class="fa-solid fa-plus"></i> Tambah Produk</a>
                                        <a href="{{ route('shop.edit') }}" class="btn btn-dark"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit Info Toko</a>
                                        <a href="store-profile.html" class="btn btn-outline"><i
                                                class="fa-solid fa-eye"></i> Preview Toko</a>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="info-panel-card" style="text-align:center;">
                                <div style="font-size:2.5rem;margin-bottom:12px;">�</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--dark);margin-bottom:6px;">
                                    Kamu belum memiliki toko</div>
                                <div style="font-size:.82rem;color:var(--dark-light);margin-bottom:16px;">Jadilah
                                    penjual dan mulai jualan produkmu di PasarLokal!</div>
                                <a href="{{ route('shop.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-store"></i> Buat Toko Pertama</a>
                            </div>
                        @endif
                    </div>

                    <!-- ■ PENGATURAN ■ -->
                    <div class="panel" id="panel-pengaturan">
                        <div class="panel-header">
                            <h3>Pengaturan Akun</h3>
                            <p>Kelola preferensi notifikasi dan privasi akun kamu.</p>
                        </div>
                        <div class="info-panel-card">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:4px;">
                                Notifikasi</div>
                            <div class="setting-row">
                                <div class="setting-info">
                                    <div class="setting-label">Notifikasi Email</div>
                                    <div class="setting-desc">Terima email untuk produk baru & promo</div>
                                </div>
                                <label class="toggle"><input type="checkbox" checked>
                                    <div class="toggle-track"></div>
                                </label>
                            </div>
                            <div class="setting-row">
                                <div class="setting-info">
                                    <div class="setting-label">Update Toko Favorit</div>
                                    <div class="setting-desc">Notifikasi saat toko yang kamu ikuti menambah produk
                                    </div>
                                </div>
                                <label class="toggle"><input type="checkbox" checked>
                                    <div class="toggle-track"></div>
                                </label>
                            </div>
                            <div class="setting-row">
                                <div class="setting-info">
                                    <div class="setting-label">Newsletter Mingguan</div>
                                    <div class="setting-desc">Tips UMKM dan inspirasi bisnis tiap Senin</div>
                                </div>
                                <label class="toggle"><input type="checkbox">
                                    <div class="toggle-track"></div>
                                </label>
                            </div>
                        </div>
                        <div class="info-panel-card">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:4px;">
                                Privasi</div>
                            <div class="setting-row">
                                <div class="setting-info">
                                    <div class="setting-label">Tampilkan Profil Publik</div>
                                    <div class="setting-desc">Orang lain dapat melihat profil dan wishlist kamu</div>
                                </div>
                                <label class="toggle"><input type="checkbox" checked>
                                    <div class="toggle-track"></div>
                                </label>
                            </div>
                            <div class="setting-row">
                                <div class="setting-info">
                                    <div class="setting-label">Munculkan di Pencarian</div>
                                    <div class="setting-desc">Profil kamu bisa ditemukan melalui pencarian</div>
                                </div>
                                <label class="toggle"><input type="checkbox">
                                    <div class="toggle-track"></div>
                                </label>
                            </div>
                        </div>
                        <div class="info-panel-card" style="border-color:#fee2e2;">
                            <div
                                style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--danger);margin-bottom:16px;">
                                Zona Berbahaya</div>
                            <div class="setting-row" style="border-bottom:none;">
                                <div class="setting-info">
                                    <div class="setting-label">Hapus Akun</div>
                                    <div class="setting-desc">Tindakan ini permanen dan tidak dapat dibatalkan.</div>
                                </div>
                                <button class="btn btn-sm"
                                    style="background:#fee2e2;color:var(--danger);border:1.5px solid #fecaca;">Hapus
                                    Akun</button>
                            </div>
                        </div>
                    </div>

                </main>
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

        // Wishlist data
        const WISHLIST = [{
                e: '🎨',
                bg: 'linear-gradient(135deg,#dbeafe,#bfdbfe)',
                name: 'Batik Tulis Motif Kawung',
                shop: 'Batik Nusantara',
                price: '185.000'
            },
            {
                e: '🍯',
                bg: 'linear-gradient(135deg,#d1fae5,#a7f3d0)',
                name: 'Madu Hutan Murni 500ml',
                shop: 'Lebah Madu Asli',
                price: '85.000'
            },
            {
                e: '👜',
                bg: 'linear-gradient(135deg,#ede9fe,#ddd6fe)',
                name: 'Tas Anyam Rotan Handmade L',
                shop: 'Anyaman Jogja',
                price: '95.000'
            },
            {
                e: '🌿',
                bg: 'linear-gradient(135deg,#dcfce7,#bbf7d0)',
                name: 'Teh Herbal Daun Kelor',
                shop: 'Herbal Segar',
                price: '45.000'
            },
            {
                e: '🕯️',
                bg: 'linear-gradient(135deg,#dbeafe,#e0f2fe)',
                name: 'Lilin Aromaterapi 200g',
                shop: 'Aroma Nusantara',
                price: '55.000'
            },
            {
                e: '🪴',
                bg: 'linear-gradient(135deg,#f0fdf4,#dcfce7)',
                name: 'Monstera Mini Pot Keramik',
                shop: 'Green Corner',
                price: '75.000'
            },
        ];
        document.getElementById('wishlist-grid').innerHTML = WISHLIST.map(p => `
    <div class="product-card" onclick="location.href='product-detail.html'" style="cursor:pointer;">
      <div class="product-card-img">
        <div style="width:100%;height:100%;background:${p.bg};display:flex;align-items:center;justify-content:center;font-size:2.8rem;">${p.e}</div>
        <div class="product-card-badge" style="background:#ef4444;cursor:pointer;" onclick="event.stopPropagation();removeWishlist(this)" title="Hapus dari wishlist"><i class="fa-solid fa-heart-crack fa-xs"></i></div>
      </div>
      <div class="product-card-body">
        <div class="product-card-shop"><i class="fa-solid fa-store fa-xs"></i> ${p.shop}</div>
        <div class="product-card-name">${p.name}</div>
        <div class="product-card-price">Rp ${p.price}</div>
      </div>
      <div class="product-card-actions">
        <button class="btn btn-wa w-full btn-sm" onclick="event.stopPropagation();"><i class="fa-brands fa-whatsapp"></i> Chat WA</button>
      </div>
    </div>
  `).join('');

        function showPanel(id, tabEl) {
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.getElementById('panel-' + id).classList.add('active');
            if (tabEl) {
                document.querySelectorAll('.ptab').forEach(t => t.classList.remove('active'));
                tabEl.classList.add('active');
            }
        }

        function setActive(el) {
            document.querySelectorAll('.ps-nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
        }

        function saveProfile() {
            const t = document.createElement('div');
            t.className = 'toast success';
            t.innerHTML = '<i class="fa-solid fa-circle-check"></i> Profil berhasil diperbarui!';
            let wrap = document.querySelector('.toast-wrap');
            if (!wrap) {
                wrap = document.createElement('div');
                wrap.className = 'toast-wrap';
                document.body.appendChild(wrap);
            }
            wrap.appendChild(t);
            setTimeout(() => t.remove(), 3000);
        }

        function removeWishlist(el) {
            el.closest('.product-card').style.opacity = '0.4';
        }

        function chatAgain(name) {
            window.open(
                `https://wa.me/6281234567890?text=${encodeURIComponent('Halo '+name+'! Saya ingin melanjutkan percakapan tentang produk kamu di PasarLokal.')}`,
                '_blank');
        }
        async function confirmLogout() {
            const confirmed = await showConfirm({
                type: 'danger',
                title: 'Keluar dari Akun?',
                message: 'Yakin ingin keluar dari akun kamu? Kamu harus login kembali untuk mengakses profil.',
                confirmText: 'Ya, Keluar',
                cancelText: 'Batal',
            });
            if (confirmed) doLogout();
        }

        function doLogout() {
            // Ambil CSRF Token dari meta tag head yang sudah dibuat sebelumnya
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Lakukan POST request via Fetch API
            fetch("{{ route('logout') }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Setelah server merespon sukses, arahkan browser ke halaman login/awal
                        window.location.href = "{{ route('login') }}";
                    }
                })
                .catch(error => {
                    console.error('Error Logout:', error);
                    showModal({
                        type: 'error',
                        title: 'Gagal Logout',
                        message: 'Terjadi kesalahan saat logout. Silakan coba lagi.'
                    });
                });
        }
    </script>

    <!-- Cropper Modal -->
    <div class="success-overlay" id="cropperModal" style="z-index:9999; display: none;">
        <div class="success-box" style="text-align:left; max-width: 600px; width: 90%;">
            <h2 style="margin-bottom:20px;">Sesuaikan Foto Profil</h2>
            <div style="max-height: 400px; overflow: hidden; margin-bottom: 20px;">
                <img id="cropperImage" src="" style="max-width: 100%; display: block;">
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" class="btn btn-outline" id="btnCancelCrop">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSaveCrop">Simpan Foto</button>
            </div>
        </div>
    </div>

    <!-- Cropper.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarEditBtn = document.getElementById('editProfileAvatar');
            const avatarFileInput = document.getElementById('avatarFileInput');
            const cropperModal = document.getElementById('cropperModal');
            const cropperImage = document.getElementById('cropperImage');
            const btnCancelCrop = document.getElementById('btnCancelCrop');
            const btnSaveCrop = document.getElementById('btnSaveCrop');

            let cropper = null;

            if (avatarEditBtn && avatarFileInput) {
                avatarEditBtn.addEventListener('click', () => {
                    avatarFileInput.click();
                });

                avatarFileInput.addEventListener('change', (e) => {
                    const files = e.target.files;
                    if (files && files.length > 0) {
                        const file = files[0];
                        const url = URL.createObjectURL(file);
                        cropperImage.src = url;
                        cropperModal.style.display = 'flex';

                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(cropperImage, {
                            aspectRatio: 1,
                            viewMode: 1,
                            autoCropArea: 1,
                        });

                        avatarFileInput.value = ''; // Reset input
                    }
                });
            }

            if (btnCancelCrop) {
                btnCancelCrop.addEventListener('click', () => {
                    cropperModal.style.display = 'none';
                    if (cropper) {
                        cropper.destroy();
                        cropper = null;
                    }
                });
            }

            if (btnSaveCrop) {
                btnSaveCrop.addEventListener('click', () => {
                    if (!cropper) return;

                    const btn = btnSaveCrop;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
                    btn.disabled = true;

                    const canvas = cropper.getCroppedCanvas({
                        width: 256,
                        height: 256
                    });

                    if (canvas) {
                        const base64Image = canvas.toDataURL('image/jpeg');
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        fetch('{{ route('profile.avatar.update') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    avatar: base64Image
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                                cropperModal.style.display = 'none';

                                if (cropper) {
                                    cropper.destroy();
                                    cropper = null;
                                }

                                if (data.success) {
                                    document.getElementById('avatarImagePreview').src = data.avatar_url;
                                    // Also update small avatar in navbar if it exists
                                    document.querySelectorAll('.nav-avatar img').forEach(img => {
                                        img.src = data.avatar_url;
                                    });

                                    showModal({
                                        type: 'success',
                                        title: 'Berhasil',
                                        message: data.message
                                    });
                                } else {
                                    showModal({
                                        type: 'error',
                                        title: 'Gagal',
                                        message: data.message || 'Terjadi kesalahan'
                                    });
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                                showModal({
                                    type: 'error',
                                    title: 'Kesalahan',
                                    message: 'Tidak dapat mengunggah foto.'
                                });
                            });
                    }
                });
            }
        });
    </script>

    @include('layouts.partials.custom-modal')
</body>

</html>
