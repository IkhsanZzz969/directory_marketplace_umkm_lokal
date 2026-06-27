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

        /* ── CATEGORY MODAL OVERLAY ── */
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
                            <i class="fa-solid fa-bell"></i>
                            @if ($pendingUmkm === 0)
                                Belum ada pengajuan toko
                            @else
                                {{ $pendingUmkm }} Pengajuan Baru
                            @endif
                        </button>
                    </div>
                </div>
                <div class="profile-tabs">
                    <div class="ptab active" id="tab-dashboard" onclick="showPanel('dashboard',this)"><i
                            class="fa-solid fa-chart-line fa-xs"></i> Ikhtisar</div>
                    <div class="ptab" id="tab-pengajuan" onclick="showPanel('pengajuan',this)"><i
                            class="fa-solid fa-store-slash fa-xs"></i>
                        Persetujuan Toko
                        @if ($pendingUmkm)
                            <span class="badge-dot">{{ $pendingUmkm }}</span>
                        @endif
                    </div>
                    <div class="ptab" id="tab-toko" onclick="showPanel('toko',this)"><i
                            class="fa-solid fa-shop fa-xs"></i> Daftar Toko</div>
                    <div class="ptab" id="tab-pengguna" onclick="showPanel('pengguna',this)"><i
                            class="fa-solid fa-users fa-xs"></i> Kelola Pengguna</div>
                    <div class="ptab" id="tab-kategori" onclick="showPanel('kategori',this)"><i
                            class="fa-solid fa-tags fa-xs"></i> Kelola Kategori</div>
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
                            <li class="admin-summary-item">Pengajuan Menunggu <span
                                    class="val alert">{{ $pendingUmkm }} Toko</span>
                            </li>
                            <li class="admin-summary-item">Total UMKM Aktif <span class="val">{{ $activeUmkm }}
                                    Toko</span></li>
                            <li class="admin-summary-item">Total Produk <span class="val">{{ $totalProduct }}
                                    Item</span></li>
                            <li class="admin-summary-item">Pengguna Terdaftar <span
                                    class="val">{{ $listUser->count() }} User</span>
                            </li>
                        </ul>
                    </div>

                    <div class="ps-card">
                        <div class="ps-nav-item active"
                            onclick="showPanel('dashboard', document.getElementById('tab-dashboard')); setActive(this)">
                            <span class="icon"><i class="fa-solid fa-chart-line"></i></span> Ikhtisar Sistem
                        </div>
                        <div class="ps-nav-item"
                            onclick="showPanel('pengajuan', document.getElementById('tab-pengajuan')); setActive(this)">
                            <span class="icon"><i class="fa-solid fa-file-signature"></i></span> Persetujuan Toko
                            @if ($pendingUmkm)
                                <span class="badge"
                                    style="background:#ef4444;color:white;margin-left:auto;font-size:.65rem;padding:2px 7px;border-radius:10px;">{{ $pendingUmkm }}</span>
                            @endif
                        </div>
                        <div class="ps-nav-item"
                            onclick="showPanel('toko', document.getElementById('tab-toko')); setActive(this)"><span
                                class="icon"><i class="fa-solid fa-shop"></i></span> Daftar Toko UMKM</div>
                        <div class="ps-nav-item"
                            onclick="showPanel('pengguna', document.getElementById('tab-pengguna')); setActive(this)">
                            <span class="icon"><i class="fa-solid fa-users"></i></span> Kelola Pengguna
                        </div>
                        <div class="ps-nav-item"
                            onclick="showPanel('kategori', document.getElementById('tab-kategori')); setActive(this)">
                            <span class="icon"><i class="fa-solid fa-tags"></i></span> Kelola Kategori
                        </div>
                        <div class="ps-nav-sep"></div>
                        <div class="ps-nav-item"
                            onclick="showPanel('pengaturan', document.getElementById('tab-pengaturan')); setActive(this)">
                            <span class="icon"><i class="fa-solid fa-sliders"></i></span> Pengaturan Sistem
                        </div>
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
                                    {{ $pendingUmkm }}</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Menunggu Persetujuan</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid var(--primary);">
                                <div style="font-size:1.8rem;margin-bottom:6px;">🏪</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    {{ $activeUmkm }}</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Toko UMKM Aktif</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #25D366;">
                                <div style="font-size:1.8rem;margin-bottom:6px;">👥</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    {{ $listUser->count() }}</div>
                                <div style="font-size:.75rem;color:var(--dark-light);">Total Pengguna</div>
                            </div>
                            <div class="info-panel-card"
                                style="padding:18px;margin-bottom:0;text-align:center;border-top:3px solid #8b5cf6;">
                                <div style="font-size:1.8rem;margin-bottom:6px;">📦</div>
                                <div
                                    style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--dark);">
                                    {{ $totalProduct }}</div>
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
                                                    <i class="fa-solid fa-user-plus fa-xs"></i>
                                                </div>
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
                                                    <i class="fa-solid fa-store fa-xs"></i>
                                                </div>
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
                                                    <i class="fa-solid fa-check fa-xs"></i>
                                                </div>
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
                                <tbody id="pengajuan-tbody">
                                    @forelse ($umkm->where('status', 'pending') as $u)
                                        <tr id="row-toko-{{ $u->id }}">
                                            <td>
                                                <div style="display:flex;align-items:center;gap:12px;">
                                                    <div
                                                        style="width:40px;height:40px;background:#f3f4f6;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                                                        {{ $u->logo }}</div>
                                                    <div>
                                                        <div
                                                            style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                            {{ $u->name }}</div>
                                                        <div style="font-size:.72rem;color:var(--dark-light);">NIB:
                                                            129301923012</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.85rem;color:var(--dark);">{{ $u->user->name }}
                                                </div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">
                                                    {{ $u->user->email }}</div>
                                            </td>
                                            <td>
                                                <span
                                                    style="display:inline-block;padding:2px 8px;background:#e0e7ff;color:#4f46e5;border-radius:10px;font-size:.7rem;font-weight:600;margin-bottom:4px;">{{ ucfirst($u->category) }}</span>
                                                <div style="font-size:.72rem;color:var(--dark-light);"><i
                                                        class="fa-solid fa-location-dot"></i> {{ $u->address }}
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $dateSubmit = \Carbon\Carbon::parse($u->created_at)
                                                        ->timezone('Asia/Jakarta')
                                                        ->locale('id');
                                                @endphp
                                                <div style="font-size:.82rem;">{{ $dateSubmit->diffForHumans() }}
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div style="display:flex;gap:6px;justify-content:center;">
                                                    <button class="btn btn-sm"
                                                        style="background:#16a34a;color:white;border:none;"
                                                        onclick="handleShopAction({{ $u->id }}, 'approve')"
                                                        title="Setujui"><i class="fa-solid fa-check"></i></button>
                                                    <button class="btn btn-sm"
                                                        style="background:#ef4444;color:white;border:none;"
                                                        onclick="handleShopAction({{ $u->id }}, 'reject')"
                                                        title="Tolak"><i class="fa-solid fa-xmark"></i></button>
                                                    <button class="btn btn-ghost btn-sm" title="Lihat Detail"><i
                                                            class="fa-solid fa-file-lines"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty-pengajuan-row">
                                            <td colspan="5"
                                                style="text-align:center;padding:40px 0;color:var(--dark-light);">
                                                <i class="fa-solid fa-inbox fa-2xl" style="margin-bottom:12px;"></i>
                                                <div style="font-size:.9rem;">Tidak ada pengajuan toko baru saat ini.
                                                </div>
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
                                        <th>Status Persetujuan</th>
                                        <th>Status Aktif</th>
                                        <th>Total Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($umkm as $u)
                                        <tr>
                                            <td>
                                                <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                    {{ $u->name }}</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">Pemilik:
                                                    {{ $u->user->name }}</div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">{{ ucfirst($u->category) }}</div>
                                            </td>
                                            <td>
                                                @if ($u->status === 'approved')
                                                    <span
                                                        style="padding:3px 8px;background:rgba(16,185,129,.2);color:#10b981;border-radius:10px;font-size:.7rem;font-weight:600;">{{ strtoupper($u->status) }}</span>
                                                @elseif($u->status === 'pending')
                                                    <span
                                                        style="padding:3px 8px;background:var(--primary-light);color:var(--primary);border-radius:10px;font-size:.7rem;font-weight:600;">{{ strtoupper($u->status) }}</span>
                                                @else
                                                    <span
                                                        style="padding:3px 8px;background:rgba(228, 37, 24, 0.84);color:#ffffff;border-radius:10px;font-size:.7rem;font-weight:600;">{{ strtoupper($u->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($u->is_active === 'active')
                                                    <span
                                                        style="padding:3px 8px;background:rgba(16,185,129,.2);color:#10b981;border-radius:10px;font-size:.7rem;font-weight:600;">Aktif</span>
                                                @else
                                                    <span
                                                        style="padding:3px 8px;background:rgba(228, 37, 24, 0.84);color:#ffffff;border-radius:10px;font-size:.7rem;font-weight:600;">Non-Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">0 Item</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline btn-sm">Detail</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                style="text-align:center;padding:40px 0;color:var(--dark-light);">
                                                <i class="fa-solid fa-inbox fa-2xl" style="margin-bottom:12px;"></i>
                                                <div style="font-size:.9rem;">Tidak ada UMKM terdaftar saat ini.</div>
                                            </td>
                                        </tr>
                                    @endforelse
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
                                    @forelse ($listUser as $user)
                                        <tr>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <img src="{{ $user->avatar_url }}"
                                                        style="width:32px;border-radius:50%;" alt="Avatar">
                                                    <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                        {{ ucfirst($user->name) }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">{{ $user->email }}</div>
                                                <div style="font-size:.72rem;color:var(--dark-light);">
                                                    {{ $user->phone }}</div>
                                            </td>
                                            <td>
                                                @if ($user->role === 'umkm')
                                                    <span
                                                        style="padding:3px 8px;background:var(--primary-light);color:var(--primary);border-radius:10px;font-size:.7rem;font-weight:600;">{{ strtoupper($user->role) }}</span>
                                                @else
                                                    <span
                                                        style="padding:3px 8px;background:rgba(16,185,129,.2);color:#10b981;border-radius:10px;font-size:.7rem;font-weight:600;">{{ ucfirst($user->role) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">12 Jan 2026</div>
                                            </td>
                                            <td>
                                                <button class="btn btn-ghost btn-sm" title="Edit/Suspend"><i
                                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;">Tidak ada data</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel" id="panel-kategori">
                        <div class="panel-header"
                            style="display:flex; justify-content:space-between; align-items:center;">
                            <div>
                                <h3>Kelola Kategori</h3>
                                <p>Manajemen kategori produk yang tersedia di PasarLokal.</p>
                            </div>
                            <button class="btn btn-primary btn-sm" onclick="showCategoryModal()">
                                <i class="fa-solid fa-plus"></i> Tambah Kategori
                            </button>
                        </div>

                        <div class="info-panel-card" style="padding: 0;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Slug</th>
                                        <th>Total Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $cat)
                                        <tr>
                                            <td>
                                                <div style="font-weight:600;font-size:.88rem;color:var(--dark);">
                                                    {{ $cat->name }}</div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">{{ $cat->slug }}</div>
                                            </td>
                                            <td>
                                                <div style="font-size:.82rem;">{{ $cat->products()->count() ?? 0 }}
                                                    Item</div>
                                            </td>
                                            <td>
                                                <div style="display:flex;gap:6px;">
                                                    <button class="btn btn-ghost btn-sm" title="Edit Kategori"
                                                        onclick="editCategory({{ $cat->id }}, '{{ $cat->name }}', '{{ $cat->slug }}')"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                    <form action="{{ route('admin.category.destroy', $cat->id) }}"
                                                        method="POST"
                                                        onsubmit="event.preventDefault(); confirmDeleteCategory(this, '{{ addslashes($cat->name) }}');"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-ghost btn-sm"
                                                            style="color:var(--danger);" title="Hapus Kategori"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                style="text-align:center;padding:40px 0;color:var(--dark-light);">
                                                <i class="fa-solid fa-tags fa-2xl" style="margin-bottom:12px;"></i>
                                                <div style="font-size:.9rem;">Belum ada kategori yang ditambahkan.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
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
        window.addEventListener('scroll', () => document.getElementById('navbar')?.classList.toggle('scrolled', window
            .scrollY > 10));

        // Tab & Panel Management
        function showPanel(id, tabEl) {
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.getElementById('panel-' + id).classList.add('active');
            localStorage.setItem('activeAdminPanel', id);

            // update horizontal tabs
            if (tabEl) {
                document.querySelectorAll('.ptab').forEach(t => t.classList.remove('active'));
                tabEl.classList.add('active');
            }

            // sync sidebar if exists
            document.querySelectorAll('.ps-nav-item').forEach(i => i.classList.remove('active'));
            // Find sidebar item that corresponds to the panel
            const sidebarItems = document.querySelectorAll('.ps-nav-item');
            for (let item of sidebarItems) {
                if (item.getAttribute('onclick') && item.getAttribute('onclick').includes(id)) {
                    item.classList.add('active');
                }
            }
        }

        // Sidebar active state click helper
        function setActive(el) {
            document.querySelectorAll('.ps-nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
        }

        // Approve / Reject Shop via AJAX
        async function handleShopAction(shopId, action) {
            const actionLabel = action === 'approve' ? 'menyetujui' : 'menolak';
            const confirmType = action === 'approve' ? 'confirm' : 'danger';
            const confirmIcon = action === 'approve' ? 'Setujui' : 'Tolak';

            const confirmed = await showConfirm({
                type: confirmType,
                title: `${action === 'approve' ? 'Setujui' : 'Tolak'} Pengajuan Toko?`,
                message: `Yakin ingin ${actionLabel} pengajuan toko ini? Tindakan ini akan mengubah status toko.`,
                confirmText: `Ya, ${confirmIcon}`,
                cancelText: 'Batal',
            });
            if (!confirmed) return;

            const row = document.getElementById('row-toko-' + shopId);
            if (!row) return;

            // Disable buttons to prevent double clicks
            const buttons = row.querySelectorAll('button');
            buttons.forEach(btn => {
                btn.disabled = true;
                btn.style.opacity = '0.5';
            });

            const url = `/admin/shop/${shopId}/${action}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Gagal memproses permintaan.');
                const data = await response.json();

                if (data.success) {
                    // Animate row out
                    row.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        row.remove();
                        updatePendingCount();
                    }, 400);
                    await showModal({
                        type: action === 'approve' ? 'success' : 'warning',
                        title: action === 'approve' ? 'Toko Disetujui!' : 'Toko Ditolak',
                        message: data.message,
                    });
                } else {
                    await showModal({
                        type: 'error',
                        title: 'Gagal!',
                        message: data.message || 'Terjadi kesalahan.'
                    });
                    buttons.forEach(btn => {
                        btn.disabled = false;
                        btn.style.opacity = '1';
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                await showModal({
                    type: 'error',
                    title: 'Kesalahan Jaringan',
                    message: 'Terjadi kesalahan jaringan. Silakan coba lagi.'
                });
                buttons.forEach(btn => {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                });
            }
        }

        // Update pending count badges after approve/reject
        function updatePendingCount() {
            const tbody = document.getElementById('pengajuan-tbody');
            const remainingRows = tbody.querySelectorAll('tr:not(#empty-pengajuan-row)');
            const count = remainingRows.length;

            // Update all badge-dot elements
            document.querySelectorAll('.badge-dot').forEach(dot => {
                dot.textContent = count;
            });

            // Update sidebar badge
            const sidebarBadge = document.querySelector('.ps-nav-item .badge');
            if (sidebarBadge) sidebarBadge.textContent = count;

            // Show empty state if no pending shops remain
            if (count === 0) {
                tbody.innerHTML = `
        <tr id="empty-pengajuan-row">
          <td colspan="5" style="text-align:center;padding:40px 0;color:var(--dark-light);">
            <i class="fa-solid fa-circle-check fa-2xl" style="margin-bottom:12px;color:#16a34a;"></i>
            <div style="font-size:.9rem;">Semua pengajuan telah diproses. 🎉</div>
          </td>
        </tr>`;
            }
        }

        async function confirmLogout() {
            const confirmed = await showConfirm({
                type: 'danger',
                title: 'Keluar dari Admin?',
                message: 'Yakin ingin keluar dari portal Admin? Kamu harus login kembali untuk mengakses dashboard.',
                confirmText: 'Ya, Keluar',
                cancelText: 'Batal',
            });
            if (confirmed) doLogout();
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
                    window.location.href = "{{ route('login') }}";
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

    <script>
        // JS Category handling
        let isSlugEdited = false;

        function showCategoryModal() {
            const form = document.getElementById('category-form');
            form.action = "{{ route('admin.category.store') }}";
            document.getElementById('cat-method').innerHTML = ''; // POST
            document.getElementById('cat-name').value = '';
            document.getElementById('cat-slug').value = '';
            isSlugEdited = false;
            document.getElementById('cat-modal-title').innerText = 'Tambah Kategori';
            document.getElementById('category-modal').style.display = 'flex';
        }

        function editCategory(id, name, slug) {
            const form = document.getElementById('category-form');
            form.action = `/administrator/kategori/${id}`;
            document.getElementById('cat-method').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('cat-name').value = name;
            document.getElementById('cat-slug').value = slug;
            isSlugEdited = false;
            document.getElementById('cat-modal-title').innerText = 'Edit Kategori';
            document.getElementById('category-modal').style.display = 'flex';
        }

        function closeCategoryModal() {
            document.getElementById('category-modal').style.display = 'none';
        }

        async function confirmDeleteCategory(formElement, categoryName) {
            const confirmed = await showConfirm({
                type: 'danger',
                title: 'Hapus Kategori?',
                message: `Yakin ingin menghapus kategori "${categoryName}"? Tindakan ini tidak dapat dibatalkan.`,
                confirmText: 'Ya, Hapus',
                cancelText: 'Batal',
            });
            if (confirmed) formElement.submit();
        }

        // Auto-generate slug for category
        document.addEventListener('DOMContentLoaded', function() {
            // Restore active panel from localStorage
            const activePanel = localStorage.getItem('activeAdminPanel');
            if (activePanel) {
                const tabEl = document.getElementById('tab-' + activePanel);
                if (tabEl) {
                    showPanel(activePanel, tabEl);
                } else {
                    showPanel(activePanel, null);
                }
            }

            // Show success/error modal from session
            @if(session('success'))
                showModal({
                    type: 'success',
                    title: 'Berhasil!',
                    message: "{!! addslashes(session('success')) !!}"
                });
            @endif

            @if(session('error'))
                showModal({
                    type: 'error',
                    title: 'Gagal!',
                    message: "{!! addslashes(session('error')) !!}"
                });
            @endif

            @if($errors->any())
                showModal({
                    type: 'error',
                    title: 'Kesalahan Validasi!',
                    message: "{!! addslashes(implode('<br>', $errors->all())) !!}"
                });
            @endif
            document.getElementById('cat-name')?.addEventListener('input', function(e) {
                if (!isSlugEdited) {
                    const slug = e.target.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g,
                        '-').replace(
                        /-+/g, '-').replace(/^-|-$/g, '');
                    document.getElementById('cat-slug').value = slug;
                }
            });

            // Track if slug is manually edited
            document.getElementById('cat-slug')?.addEventListener('input', function(e) {
                isSlugEdited = true;
            });
        });
    </script>

    <!-- Category Modal -->
    <div class="success-overlay" id="category-modal" style="z-index:9999;">
        <div class="success-box" style="text-align:left;">
            <h2 id="cat-modal-title" style="margin-bottom:20px;">Tambah Kategori</h2>
            <form id="category-form" method="POST" action="">
                @csrf
                <div id="cat-method"></div>
                <div class="form-group" style="margin-bottom:16px;">
                    <label class="form-label"
                        style="font-size:.85rem;font-weight:600;display:block;margin-bottom:6px;">Nama Kategori</label>
                    <input type="text" id="cat-name" name="name" class="form-control"
                        style="width:100%;padding:10px;border:1px solid var(--border);border-radius:var(--radius-md);"
                        required>
                </div>
                <div class="form-group" style="margin-bottom:24px;">
                    <label class="form-label"
                        style="font-size:.85rem;font-weight:600;display:block;margin-bottom:6px;">Slug</label>
                    <input type="text" id="cat-slug" name="slug" class="form-control"
                        style="width:100%;padding:10px;border:1px solid var(--border);border-radius:var(--radius-md);"
                        required>
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" class="btn btn-outline" onclick="closeCategoryModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.partials.custom-modal')
</body>

</html>
