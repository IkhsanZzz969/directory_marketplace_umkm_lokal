<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Superadmin Dashboard — PasarLokal</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            /* CSS bawaan dari template sebelumnya dipertahankan */
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

            .pb-admin {
                background: rgba(220, 38, 38, 0.2);
                color: #ef4444;
                border: 1px solid rgba(239, 68, 68, 0.4);
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
                background: #ef4444;
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

            /* Admin Summary Card */
            .admin-summary-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 18px;
            }

            .admin-summary-title {
                font-size: .82rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 12px;
            }

            .admin-summary-list {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .admin-summary-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: .78rem;
                color: var(--dark-light);
            }

            .admin-summary-item span.val {
                font-weight: 700;
                color: var(--dark);
            }

            .admin-summary-item span.val.alert {
                color: var(--danger);
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
                overflow: hidden;
            }

            /* table styling */
            .admin-table {
                width: 100%;
                border-collapse: collapse;
            }

            .admin-table th {
                text-align: left;
                padding: 12px;
                font-size: .78rem;
                color: var(--dark-light);
                border-bottom: 2px solid var(--border);
                background: #f8fafc;
                white-space: nowrap;
            }

            .admin-table td {
                padding: 16px 12px;
                border-bottom: 1px solid var(--border);
                vertical-align: middle;
            }

            .admin-table tr:last-child td {
                border-bottom: none;
            }

            /* grid helpers */
            .grid-4 {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 16px;
            }

            /* toggle switch */
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

            @media (max-width: 900px) {
                .profile-layout {
                    grid-template-columns: 1fr;
                }

                .profile-sidebar {
                    position: static;
                }

                .grid-4 {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 540px) {
                .profile-header-inner {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .grid-4 {
                    grid-template-columns: 1fr;
                }

                .admin-table {
                    display: block;
                    overflow-x: auto;
                }
            }
        </style>
    </head>

    <body>

        @include('layouts.partials.navbar')

        <div class="page-content">

            <div class="profile-header">
                <div class="container">
                    <div class="profile-header-inner">
                        <div class="profile-avatar-wrap">
                            <div class="profile-avatar" style="background: #1e293b;">
                                <i class="fa-solid fa-user-shield" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-name">{{ auth()->user()->name ?? 'Administrator Utama' }}</div>
                            <div class="profile-email">
                                <i class="fa-regular fa-envelope fa-xs"></i>
                                {{ auth()->user()->email ?? 'admin@pasarlokal.com' }}
                                <span
                                    style="background:rgba(16,185,129,.2);color:#34d399;padding:1px 7px;border-radius:var(--radius-full);font-size:.65rem;font-weight:700;margin-left:4px;">Secure
                                    Login</span>
                            </div>
                            <div class="profile-badges">
                                <span class="profile-badge pb-admin"><i class="fa-solid fa-shield-halved fa-xs"></i>
                                    Superadmin</span>
                            </div>
                        </div>
                        <div class="profile-header-actions">
                            <button class="btn btn-primary btn-sm"
                                onclick="showPanel('pengajuan', document.getElementById('tab-pengajuan'))">
                                <i class="fa-solid fa-bell"></i> 3 Pengajuan Baru
                            </button>
                        </div>
                    </div>
                    <div class="profile-tabs">
                        <div class="ptab active" id="tab-dashboard" onclick="showPanel('dashboard',this)"><i
                                class="fa-solid fa-chart-line fa-xs"></i> Ikhtisar</div>
                        <div class="ptab" id="tab-pengajuan" onclick="showPanel('pengajuan',this)"><i
                                class="fa-solid fa-store-slash fa-xs"></i> Persetujuan Toko <span
                                class="badge-dot">3</span></div>
                        <div class="ptab" id="tab-toko" onclick="showPanel('toko',this)"><i
                                class="fa-solid fa-shop fa-xs"></i> Daftar Toko</div>
                        <div class="ptab" id="tab-pengguna" onclick="showPanel('pengguna',this)"><i
                                class="fa-solid fa-users fa-xs"></i> Kelola Pengguna</div>
                        <div class="ptab" id="tab-pengaturan" onclick="showPanel('pengaturan',this)"><i
                                class="fa-solid fa-gear fa-xs"></i> Pengaturan Sistem</div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="profile-layout">

                    <aside class="profile-sidebar">
                        <div class="admin-summary-card">
                            <div class="admin-summary-title"><i class="fa-solid fa-server"
                                    style="color:var(--primary);margin-right:6px;"></i> Status Sistem</div>
                            <ul class="admin-summary-list">
                                <li class="admin-summary-item">Pengajuan Menunggu <span class="val alert">3 Toko</span>
                                </li>
                                <li class="admin-summary-item">Total UMKM Aktif <span class="val">142 Toko</span></li>
                                <li class="admin-summary-item">Total Produk <span class="val">1,240 Item</span></li>
                                <li class="admin-summary-item">Pengguna Terdaftar <span class="val">8,432 User</span>
                                </li>
                            </ul>
                        </div>

                        <div class="ps-card">
                            <div class="ps-nav-item active"
                                onclick="showPanel('dashboard', document.getElementById('tab-dashboard')); setActive(this)">
                                <span class="icon"><i class="fa-solid fa-chart-line"></i></span> Ikhtisar Sistem</div>
                            <div class="ps-nav-item"
                                onclick="showPanel('pengajuan', document.getElementById('tab-pengajuan')); setActive(this)">
                                <span class="icon"><i class="fa-solid fa-file-signature"></i></span> Persetujuan Toko
                                <span class="badge"
                                    style="background:#ef4444;color:white;margin-left:auto;font-size:.65rem;padding:2px 7px;border-radius:10px;">3</span>
                            </div>
                            <div class="ps-nav-item"
                                onclick="showPanel('toko', document.getElementById('tab-toko')); setActive(this)"><span
                                    class="icon"><i class="fa-solid fa-shop"></i></span> Daftar Toko UMKM</div>
                            <div class="ps-nav-item"
                                onclick="showPanel('pengguna', document.getElementById('tab-pengguna')); setActive(this)">
                                <span class="icon"><i class="fa-solid fa-users"></i></span> Kelola Pengguna</div>
                            <div class="ps-nav-sep"></div>
                            <div class="ps-nav-item"
                                onclick="showPanel('pengaturan', document.getElementById('tab-pengaturan')); setActive(this)">
                                <span class="icon"><i class="fa-solid fa-sliders"></i></span> Pengaturan Sistem</div>
                            <div class="ps-nav-sep"></div>
                            <div class="ps-nav-item ps-logout" onclick="confirmLogout()"><span class="icon"><i
                                        class="fa-solid fa-right-from-bracket"></i></span> Keluar Admin</div>
                        </div>
                    </aside>

                    <main>

                        <div class="panel active" id="panel-dashboard">
                            <div class="panel-header">
                                <h3>Ikhtisar Platform 👋</h3>
                                <p>Pantau perkembangan utama PasarLokal secara real-time.</p>
                            </div>

                            <div class="grid-4" style="margin-bottom:24px;">
                                <div class="info-panel-card"
                                    style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #ef4444;">
                                    <div style="font-size:1.8rem;margin-bottom:6px;">⚠️</div>
                                    <div
                                        style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                        3</div>
                                    <div style="font-size:.75rem;color:var(--dark-light);">Menunggu Persetujuan</div>
                                </div>
                                <div class="info-panel-card"
                                    style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid var(--primary);">
                                    <div style="font-size:1.8rem;margin-bottom:6px;">🏪</div>
                                    <div
                                        style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                        142</div>
                                    <div style="font-size:.75rem;color:var(--dark-light);">Toko UMKM Aktif</div>
                                </div>
                                <div class="info-panel-card"
                                    style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #25D366;">
                                    <div style="font-size:1.8rem;margin-bottom:6px;">👥</div>
                                    <div
                                        style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                        8.4K</div>
                                    <div style="font-size:.75rem;color:var(--dark-light);">Total Pengguna</div>
                                </div>
                                <div class="info-panel-card"
                                    style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #8b5cf6;">
                                    <div style="font-size:1.8rem;margin-bottom:6px;">📦</div>
                                    <div
                                        style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                        1,240</div>
                                    <div style="font-size:.75rem;color:var(--dark-light);">Produk Tersedia</div>
                                </div>
                            </div>

                            <div class="info-panel-card">
                                <div
                                    style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                                    <i class="fa-solid fa-bolt" style="color:var(--primary);"></i> Log Sistem Terakhir
                                </div>
                                <div class="admin-table-wrap">
                                    <table class="admin-table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 40px;">
                                                    <div
                                                        style="width:32px;height:32px;border-radius:50%;background:#dbeafe;color:#3b82f6;display:flex;align-items:center;justify-content:center;">
                                                        <i class="fa-solid fa-user-plus fa-xs"></i></div>
                                                </td>
                                                <td>
                                                    <div style="font-size:.85rem;font-weight:600;color:var(--dark);">
                                                        Pengguna Baru Mendaftar</div>
                                                    <div style="font-size:.75rem;color:var(--dark-light);">Budi Santoso
                                                        (budi@example.com)</div>
                                                </td>
                                                <td style="text-align:right;font-size:.75rem;color:var(--dark-light);">
                                                    10 menit lalu</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        style="width:32px;height:32px;border-radius:50%;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;">
                                                        <i class="fa-solid fa-store fa-xs"></i></div>
                                                </td>
                                                <td>
                                                    <div style="font-size:.85rem;font-weight:600;color:var(--dark);">
                                                        Pengajuan Toko Baru</div>
                                                    <div style="font-size:.75rem;color:var(--dark-light);">Kopi Senja —
                                                        Menunggu tinjauan</div>
                                                </td>
                                                <td style="text-align:right;font-size:.75rem;color:var(--dark-light);">1
                                                    jam lalu</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div
                                                        style="width:32px;height:32px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;">
                                                        <i class="fa-solid fa-check fa-xs"></i></div>
                                                </td>
                                                <td>
                                                    <div style="font-size:.85rem;font-weight:600;color:var(--dark);">
                                                        Toko Disetujui (oleh Admin)</div>
                                                    <div style="font-size:.75rem;color:var(--dark-light);">Kerajinan
                                                        Bambu Lestari telah aktif</div>
                                                </td>
                                                <td style="text-align:right;font-size:.75rem;color:var(--dark-light);">
                                                    Kemarin, 14:20</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="panel" id="panel-pengajuan">
                            <div class="panel-header">
                                <h3>Persetujuan Toko Baru</h3>
                                <p>Tinjau pengajuan toko UMKM yang mendaftar di platform.</p>
                            </div>

                            <div class="info-panel-card" style="padding: 0;">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Informasi Toko</th>
                                            <th>Pemilik (User)</th>
                                            <th>Kategori & Lokasi</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($umkm->where('status', 'pending') as $u)
                                            <tr id="row-toko-1">
                                                <td>
                                                    <div style="display:flex;align-items:center;gap:12px;">
                                                        <div
                                                            style="width:40px;height:40px;background:#f3f4f6;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                                                            ☕</div>
                                                        <div>
                                                            <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                                {{ $u->name }}</div>
                                                            <div style="font-size:.72rem;color:var(--dark-light);">NIB:
                                                                129301923012</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="font-size:.85rem;color:var(--dark);">{{ $u->user->name }}</div>
                                                    <div style="font-size:.72rem;color:var(--dark-light);">{{ $u->user->email }}</div>
                                                </td>
                                                <td>
                                                    <span
                                                        style="display:inline-block;padding:2px 8px;background:#e0e7ff;color:#4f46e5;border-radius:10px;font-size:.7rem;font-weight:600;margin-bottom:4px;">{{ $u->category }}</span>
                                                    <div style="font-size:.72rem;color:var(--dark-light);"><i class="fa-solid fa-location-dot"></i> {{ $u->address }}</div>
                                                </td>
                                                <td>
                                                    <div style="font-size:.82rem;">Hari ini, 09:15</div>
                                                </td>
                                                <td style="text-align:center; display:flex; gap:6px; justify-content:center;">
                                                    <button class="btn btn-sm" style="background:#16a34a;color:white;border:none;"
                                                        onclick="processAction('row-toko-1', 'disetujui')" title="Setujui"><i
                                                            class="fa-solid fa-check"></i></button>
                                                    <button class="btn btn-sm" style="background:#ef4444;color:white;border:none;"
                                                        onclick="processAction('row-toko-1', 'ditolak')" title="Tolak"><i class="fa-solid fa-xmark"></i></button>
                                                    <button class="btn btn-ghost btn-sm" title="Lihat Detail"><i class="fa-solid fa-file-lines"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" style="text-align:center;padding:40px 0;color:var(--dark-light);">
                                                    <i class="fa-solid fa-inbox fa-2xl" style="margin-bottom:12px;"></i>
                                                    <div style="font-size:.9rem;">Tidak ada pengajuan toko baru saat ini.</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel" id="panel-toko">
                            <div class="panel-header">
                                <div style="display:flex;justify-content:space-between;align-items:center;">
                                    <div>
                                        <h3>Daftar Toko UMKM</h3>
                                        <p>Seluruh UMKM yang telah disetujui dan beroperasi.</p>
                                    </div>
                                    <div class="input-icon-wrap" style="width:250px;">
                                        <i class="fa-solid fa-magnifying-glass input-icon"></i>
                                        <input type="text" class="form-control" placeholder="Cari nama toko...">
                                    </div>
                                </div>
                            </div>

                            <div class="info-panel-card" style="padding: 0;">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Toko</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Total Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="font-weight:600;font-size:.88rem;color:var(--dark);">Batik
                                                    Nusantara</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">Pemilik: Rina
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">Fashion</div>
                                            </td>
                                            <td><span
                                                    style="padding:3px 8px;background:#dcfce7;color:#16a34a;border-radius:10px;font-size:.7rem;font-weight:600;"><i
                                                        class="fa-solid fa-circle-check fa-xs"></i> Aktif</span></td>
                                            <td>
                                                <div style="font-size:.82rem;">48 Item</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline btn-sm">Detail</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="font-weight:600;font-size:.88rem;color:var(--dark);">Dapur
                                                    Bu Sari</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">Pemilik: Sariwati
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">Makanan</div>
                                            </td>
                                            <td><span
                                                    style="padding:3px 8px;background:#dcfce7;color:#16a34a;border-radius:10px;font-size:.7rem;font-weight:600;"><i
                                                        class="fa-solid fa-circle-check fa-xs"></i> Aktif</span></td>
                                            <td>
                                                <div style="font-size:.82rem;">12 Item</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline btn-sm">Detail</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel" id="panel-pengguna">
                            <div class="panel-header">
                                <h3>Kelola Pengguna</h3>
                                <p>Manajemen akun user pembeli dan pemilik UMKM.</p>
                            </div>

                            <div class="info-panel-card" style="padding: 0;">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Pengguna</th>
                                            <th>Email & Telepon</th>
                                            <th>Peran (Role)</th>
                                            <th>Bergabung</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Agus+P&background=random"
                                                        style="width:32px;border-radius:50%;" alt="Avatar">
                                                    <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                        Agus Pratama</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">agus@email.com</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">08123456789</div>
                                            </td>
                                            <td><span
                                                    style="padding:3px 8px;background:var(--primary-light);color:var(--primary);border-radius:10px;font-size:.7rem;font-weight:600;">Pembeli</span>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">12 Jan 2026</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-sm" title="Edit/Suspend"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <img src="https://ui-avatars.com/api/?name=Sari+W&background=random"
                                                        style="width:32px;border-radius:50%;" alt="Avatar">
                                                    <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                        Sariwati</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">sari@email.com</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">08987654321</div>
                                            </td>
                                            <td><span
                                                    style="padding:3px 8px;background:rgba(16,185,129,.2);color:#10b981;border-radius:10px;font-size:.7rem;font-weight:600;">UMKM</span>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">05 Feb 2026</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-sm"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel" id="panel-pengaturan">
                            <div class="panel-header">
                                <h3>Pengaturan Sistem</h3>
                                <p>Konfigurasi global platform PasarLokal.</p>
                            </div>

                            <div class="info-panel-card">
                                <div
                                    style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:4px;">
                                    Pendaftaran & Autentikasi</div>
                                <div class="setting-row">
                                    <div class="setting-info">
                                        <div class="setting-label">Izinkan Pendaftaran User Baru</div>
                                        <div class="setting-desc">Buka atau tutup pendaftaran untuk pengunjung baru
                                        </div>
                                    </div>
                                    <label class="toggle"><input type="checkbox" checked>
                                        <div class="toggle-track"></div>
                                    </label>
                                </div>
                                <div class="setting-row">
                                    <div class="setting-info">
                                        <div class="setting-label">Auto-Approve Toko UMKM</div>
                                        <div class="setting-desc">Pengajuan toko akan langsung aktif tanpa perlu
                                            persetujuan admin</div>
                                    </div>
                                    <label class="toggle"><input type="checkbox">
                                        <div class="toggle-track"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="info-panel-card" style="border-color:#fee2e2;">
                                <div
                                    style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--danger);margin-bottom:16px;">
                                    Tindakan Berbahaya</div>
                                <div class="setting-row" style="border-bottom:none;">
                                    <div class="setting-info">
                                        <div class="setting-label">Mode Pemeliharaan (Maintenance)</div>
                                        <div class="setting-desc">Menutup akses ke seluruh user untuk keperluan
                                            perbaikan server.</div>
                                    </div>
                                    <button class="btn btn-sm"
                                        style="background:#fee2e2;color:var(--danger);border:1.5px solid #fecaca;">Aktifkan
                                        Mode</button>
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
            </div>
        </div>

        <footer style="background:var(--dark);padding:28px 0;text-align:center;">
            <div class="container">
                <p style="color:rgba(255,255,255,.4);font-size:.82rem;">© 2026 PasarLokal — Platform UMKM Indonesia
                    (Superadmin Portal)</p>
            </div>
        </footer>

        <script>
            // Navbar scroll effect
  window.addEventListener('scroll',()=> document.getElementById('navbar')?.classList.toggle('scrolled',window.scrollY>10));

  // Tab & Panel Management
  function showPanel(id, tabEl) {
    document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
    document.getElementById('panel-'+id).classList.add('active');
    
    // update horizontal tabs
    if(tabEl){
      document.querySelectorAll('.ptab').forEach(t=>t.classList.remove('active'));
      tabEl.classList.add('active');
    }
    
    // sync sidebar if exists
    document.querySelectorAll('.ps-nav-item').forEach(i=>i.classList.remove('active'));
    // Find sidebar item that corresponds to the panel
    const sidebarItems = document.querySelectorAll('.ps-nav-item');
    for(let item of sidebarItems) {
      if(item.getAttribute('onclick') && item.getAttribute('onclick').includes(id)) {
        item.classList.add('active');
      }
    }
  }

  // Sidebar active state click helper
  function setActive(el){
    document.querySelectorAll('.ps-nav-item').forEach(i=>i.classList.remove('active'));
    el.classList.add('active');
  }

  // Dummy action for approval/reject
  function processAction(rowId, action) {
    if(confirm(`Yakin ingin memberikan status: ${action} untuk pengajuan ini?`)) {
      const row = document.getElementById(rowId);
      row.style.opacity = '0.5';
      setTimeout(() => {
        row.remove();
        alert(`Toko berhasil ${action}!`);
      }, 500);
    }
  }

  function confirmLogout(){ 
    if(confirm('Yakin ingin keluar dari portal Admin?')) doLogout(); 
  }
  
  function doLogout() {
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = metaToken ? metaToken.getAttribute('content') : '';
    
    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json"
        }
    })
    .then(response => {
      // Dummy redirect for template testing
      window.location.href = '/admin/login';
    })
    .catch(error => {
        console.error('Error Logout:', error);
        alert('Terjadi kesalahan saat logout.');
    });
  }
        </script>
    </body>

</html>