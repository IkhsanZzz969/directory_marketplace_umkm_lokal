<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Toko — {{ Auth::user()->shops->name ?? Auth::user()->name }} · Laba</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ═══════════════════════════════════════
           KELOLA TOKO — CORE STYLES
        ═══════════════════════════════════════ */
        body {
            background: var(--bg);
        }

        .store-topbar-header {
            padding-top: var(--nav-h);
            background: var(--dark);
        }

        .store-topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
            gap: 20px;
            flex-wrap: wrap;
        }

        .store-topbar-id {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .store-topbar-logo {
            width: 52px;
            height: 52px;
            border-radius: var(--radius-md);
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(253, 116, 0, .35);
        }

        .store-topbar-name {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
        }

        .store-topbar-sub {
            font-size: .75rem;
            color: rgba(255, 255, 255, .45);
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .store-topbar-sub .dot-sep {
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, .3);
            border-radius: 50%;
        }

        .store-topbar-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .store-sec-nav {
            display: flex;
            gap: 0;
            border-top: 1px solid rgba(255, 255, 255, .08);
            overflow-x: auto;
            background: var(--dark);
        }

        .sec-tab {
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
            gap: 7px;
        }

        .sec-tab:hover {
            color: rgba(255, 255, 255, .8);
        }

        .sec-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .sec-tab .cnt {
            background: var(--primary);
            color: white;
            font-size: .62rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: var(--radius-full);
        }

        .manage-layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 24px;
            padding: 28px 0 80px;
            align-items: start;
        }

        .manage-sidebar {
            position: sticky;
            top: calc(var(--nav-h) + 16px);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .side-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .side-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: .84rem;
            font-weight: 500;
            color: var(--dark-mid);
            cursor: pointer;
            transition: all .18s;
            border-left: 3px solid transparent;
        }

        .side-nav-item i {
            width: 18px;
            text-align: center;
            color: var(--dark-light);
            font-size: .88rem;
        }

        .side-nav-item:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: transparent;
        }

        .side-nav-item:hover i {
            color: var(--primary);
        }

        .side-nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .side-nav-item.active i {
            color: var(--primary);
        }

        .side-sep {
            height: 1px;
            background: var(--border);
        }

        .side-nav-item.danger {
            color: var(--danger);
        }

        .side-nav-item.danger i {
            color: var(--danger);
        }

        .side-nav-item.danger:hover {
            background: #fee2e2;
        }

        .health-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 16px;
        }

        .health-title {
            font-size: .78rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .health-title i {
            color: var(--primary);
        }

        .health-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: .76rem;
        }

        .health-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .health-label {
            color: var(--dark-mid);
            flex: 1;
        }

        .health-val {
            font-weight: 700;
        }

        .h-green {
            background: var(--success);
        }

        .h-orange {
            background: var(--primary);
        }

        .h-red {
            background: var(--danger);
        }

        .panel {
            display: none;
        }

        .panel.active {
            display: block;
            animation: fadeIn .3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sec-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .sec-title-row h3 {
            font-size: 1.05rem;
        }

        /* ═══════════════════════════════════════
           TABEL PRODUK & ANALITIK STYLES
        ═══════════════════════════════════════ */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px 20px;
            transition: box-shadow .2s;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
        }

        .stat-card-label {
            font-size: .74rem;
            font-weight: 600;
            color: var(--dark-light);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 8px;
        }

        .stat-card-num {
            font-family: var(--font-display);
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-card-change {
            font-size: .75rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .change-up {
            color: var(--success);
        }

        .change-down {
            color: var(--danger);
        }

        .stat-card-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .mini-chart {
            display: flex;
            align-items: flex-end;
            gap: 3px;
            height: 36px;
            margin-top: 8px;
        }

        .mc-bar {
            flex: 1;
            border-radius: 3px 3px 0 0;
            min-height: 4px;
            background: var(--primary-light);
            transition: background .2s;
        }

        .mc-bar.active {
            background: var(--primary);
        }

        .info-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            margin-bottom: 20px;
        }

        .info-card-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-card-title i {
            color: var(--primary);
            margin-right: 7px;
        }

        .prod-filter-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .prod-search {
            flex: 1;
            min-width: 200px;
        }

        .prod-search-wrap {
            position: relative;
        }

        .prod-search-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-light);
            font-size: .85rem;
        }

        .prod-table-wrap {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .prod-table {
            width: 100%;
            border-collapse: collapse;
        }

        .prod-table thead th {
            padding: 11px 14px;
            text-align: left;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--dark-light);
            background: var(--bg);
            border-bottom: 1.5px solid var(--border);
            white-space: nowrap;
        }

        .prod-table tbody td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--border);
            font-size: .85rem;
            vertical-align: middle;
        }

        .prod-table tbody tr:hover td {
            background: #f7f9fb;
        }

        .prod-thumb {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 1px solid var(--border);
        }

        .prod-name-cell {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .prod-name-text {
            font-weight: 600;
            color: var(--dark);
            font-size: .88rem;
        }

        .prod-slug {
            font-size: .72rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        .price-cell {
            font-family: var(--font-display);
            font-weight: 700;
            color: var(--primary);
        }

        .action-btns {
            display: flex;
            gap: 6px;
        }

        .icon-btn {
            width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .78rem;
            transition: all .18s;
            color: var(--dark-mid);
        }

        .icon-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .bulk-bar {
            display: none;
            background: var(--dark);
            color: white;
            padding: 12px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 14px;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .bulk-bar.show {
            display: flex;
        }

        /* ═══════════════════════════════════════
           FORM TAMBAH PRODUK STYLES (CREATE-PRODUCT)
        ═══════════════════════════════════════ */
        .tp-layout {
            display: grid;
            grid-template-columns: 1fr 290px;
            gap: 24px;
            align-items: start;
        }

        .fcard {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .fcard-head {
            padding: 15px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .fcard-icon {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .88rem;
            flex-shrink: 0;
        }

        .fcard-icon.green {
            background: #d1fae5;
            color: var(--success);
        }

        .fcard-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .fcard-icon.gold {
            background: #fef3c7;
            color: #d97706;
        }

        .fcard-title {
            font-family: var(--font-display);
            font-size: .93rem;
            font-weight: 700;
            color: var(--dark);
        }

        .fcard-sub {
            font-size: .71rem;
            color: var(--dark-light);
            margin-top: 1px;
        }

        .fcard-sub code {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: 1px 5px;
            color: var(--primary);
            font-family: monospace;
            font-size: .68rem;
        }

        .fcard-body {
            padding: 22px;
        }

        .fg2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .fg3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }

        .ffoot {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .cc {
            font-size: .7rem;
            color: var(--dark-light);
        }

        .cc.warn {
            color: var(--warning);
        }

        .cc.over {
            color: var(--danger);
        }

        .img-upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: all .22s;
            background: var(--bg);
            position: relative;
        }

        .img-upload-area:hover,
        .img-upload-area.dragover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .img-upload-area .upload-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: .5;
        }

        .img-upload-area .upload-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            color: var(--dark);
        }

        .img-upload-area .upload-sub {
            font-size: .78rem;
            color: var(--dark-light);
        }

        .img-upload-area .upload-or {
            font-size: .78rem;
            color: var(--dark-light);
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .img-upload-area .upload-or::before,
        .img-upload-area .upload-or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .img-hidden-input {
            display: none;
        }

        .img-preview-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 16px;
        }

        .img-preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: var(--radius-md);
            border: 2px solid var(--border);
            overflow: hidden;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            cursor: pointer;
        }

        .img-preview-item:first-child {
            border-color: var(--primary);
        }

        .img-preview-item:hover {
            border-color: var(--primary);
        }

        .img-preview-item .item-del {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            background: rgba(239, 68, 68, .9);
            border-radius: 50%;
            border: 2px solid white;
            color: white;
            font-size: .6rem;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }

        .img-preview-item:hover .item-del {
            display: flex;
        }

        .img-primary-lbl {
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: white;
            font-size: .58rem;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 3px;
        }

        .img-add-slot {
            aspect-ratio: 1;
            border-radius: var(--radius-md);
            border: 2px dashed var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            cursor: pointer;
            color: var(--dark-light);
            font-size: .72rem;
            background: var(--bg);
        }

        .img-add-slot:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .emoji-picker-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .ep-label {
            font-size: .72rem;
            color: var(--dark-light);
            width: 100%;
            font-weight: 600;
        }

        .ep-btn {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            background: var(--white);
            cursor: pointer;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .18s;
        }

        .ep-btn:hover {
            border-color: var(--primary);
            transform: scale(1.1);
        }

        .ep-btn.picked {
            border-color: var(--primary);
            background: var(--primary-light);
            transform: scale(1.05);
        }

        .price-row {
            display: flex;
        }

        .price-pfx {
            padding: 0 12px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-right: none;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            display: flex;
            align-items: center;
            font-size: .88rem;
            font-weight: 700;
            color: var(--primary);
        }

        .price-row .form-control {
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        .price-result {
            margin-top: 5px;
            font-size: .78rem;
            color: var(--dark-light);
            display: none;
            gap: 4px;
            align-items: center;
        }

        .price-result strong {
            color: var(--primary);
            font-family: var(--font-display);
            font-size: .88rem;
        }

        .discount-badge {
            background: var(--danger);
            color: white;
            font-size: .65rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: var(--radius-full);
        }

        .slug-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-full);
            padding: 4px 12px;
            font-size: .73rem;
            color: var(--dark-mid);
            font-family: monospace;
        }

        .slug-pill.ok {
            border-color: var(--success);
        }

        .slug-pill.err {
            border-color: var(--danger);
        }

        .slug-val {
            color: var(--primary);
            font-weight: 700;
        }

        .tag-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            padding: 8px 10px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--white);
            min-height: 44px;
            cursor: text;
        }

        .tag-wrap:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(253, 116, 0, .1);
        }

        .tag-chip {
            background: var(--primary-light);
            color: var(--primary);
            padding: 3px 9px;
            border-radius: var(--radius-full);
            font-size: .73rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .tag-x {
            cursor: pointer;
            opacity: .6;
            line-height: 1;
        }

        .tag-input-bare {
            border: none;
            outline: none;
            font-family: var(--font-body);
            font-size: .85rem;
            min-width: 80px;
            flex: 1;
            background: transparent;
        }

        .stock-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .scard {
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 13px 10px;
            text-align: center;
            cursor: pointer;
            background: var(--white);
        }

        .scard:hover,
        .scard.on {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .scard .s-ico {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 5px;
        }

        .scard .s-lbl {
            font-size: .74rem;
            font-weight: 700;
            color: var(--dark);
        }

        .scard .s-sub {
            font-size: .65rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        .scard.on .s-lbl {
            color: var(--primary);
        }

        .feat-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            background: var(--bg);
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            cursor: pointer;
        }

        .feat-row:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .feat-row.on {
            border-color: #fbbf24;
            background: #fefce8;
        }

        .feat-ico {
            font-size: 1.6rem;
        }

        .feat-info {
            flex: 1;
        }

        .feat-lbl {
            font-size: .88rem;
            font-weight: 700;
            color: var(--dark);
        }

        .feat-sub {
            font-size: .74rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        .tsw {
            position: relative;
            width: 44px;
            height: 24px;
            flex-shrink: 0;
        }

        .tsw input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tsw-track {
            position: absolute;
            inset: 0;
            background: var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: background .22s;
        }

        .tsw input:checked+.tsw-track {
            background: #fbbf24;
        }

        .tsw-track::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            transition: transform .22s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        .tsw input:checked+.tsw-track::after {
            transform: translateX(20px);
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .stcard {
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 13px 10px;
            text-align: center;
            cursor: pointer;
            background: var(--white);
        }

        .stcard:hover,
        .stcard.on {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .stcard .st-ico {
            font-size: 1.4rem;
            display: block;
            margin-bottom: 4px;
        }

        .stcard .st-lbl {
            font-size: .75rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* PREVIEW CARD & PROGRESS TRACKER */
        .preview-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .prev-img {
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5.5rem;
            position: relative;
            transition: background .3s;
        }

        .prev-badges {
            position: absolute;
            top: 8px;
            left: 8px;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .prev-badge {
            font-size: .6rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            color: white;
        }

        .pb-new {
            background: var(--dark);
        }

        .pb-feat {
            background: var(--primary);
            display: none;
        }

        .pb-disc {
            background: var(--danger);
            display: none;
        }

        .prev-body {
            padding: 14px;
        }

        .prev-shop-lbl {
            font-size: .7rem;
            color: var(--dark-light);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .prev-name {
            font-family: var(--font-display);
            font-size: .9rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.35;
            margin-bottom: 6px;
            min-height: 2.4em;
        }

        .prev-cat {
            font-size: .7rem;
            color: var(--dark-light);
            margin-bottom: 8px;
        }

        .prev-price {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: baseline;
            gap: 6px;
            flex-wrap: wrap;
        }

        .prev-ori {
            font-size: .75rem;
            color: var(--dark-light);
            text-decoration: line-through;
            display: none;
        }

        .prev-wa-btn {
            width: 100%;
            padding: 10px;
            background: #25D366;
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: .85rem;
            font-family: var(--font-display);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
        }

        .prog-box {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 16px;
            margin-bottom: 18px;
        }

        .prog-title {
            font-size: .78rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .prog-bar-wrap {
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .prog-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), #ff9944);
            border-radius: 3px;
            transition: width .4s ease;
            width: 0%;
        }

        .prog-pct {
            font-size: .72rem;
            color: var(--dark-light);
            display: flex;
            justify-content: space-between;
        }

        .prog-checklist {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .prog-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: .76rem;
            color: var(--dark-light);
        }

        .prog-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .55rem;
        }

        .prog-dot.done {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .prog-item.done {
            color: var(--dark);
        }

        .schema-box {
            background: var(--dark);
            border-radius: var(--radius-lg);
            padding: 16px;
            margin-bottom: 18px;
        }

        .sch-title {
            font-size: .68rem;
            font-weight: 700;
            color: rgba(255, 255, 255, .35);
            text-transform: uppercase;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .sf {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
            font-size: .73rem;
        }

        .sf-c {
            color: var(--primary);
            font-family: monospace;
            flex: 1;
            font-weight: 600;
        }

        .sf-t {
            color: rgba(255, 255, 255, .28);
            font-family: monospace;
            font-size: .66rem;
        }

        .sf-r {
            color: #fbbf24;
            font-size: .58rem;
            font-weight: 700;
        }

        .tips-box {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .tips-head {
            background: var(--primary);
            padding: 12px 16px;
        }

        .tips-head-title {
            font-family: var(--font-display);
            font-size: .85rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tips-body {
            padding: 14px 16px;
        }

        .tip-item {
            display: flex;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: .77rem;
            color: var(--dark-mid);
        }

        .tip-item:last-child {
            border-bottom: none;
        }

        .save-bar {
            position: sticky;
            bottom: 0;
            background: var(--white);
            border-top: 1.5px solid var(--border);
            padding: 12px 0;
            z-index: 100;
            margin-top: 20px;
        }

        .save-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .save-bar-info {
            font-size: .78rem;
            color: var(--dark-light);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .save-bar-acts {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* MODALS & TOAST */
        .toast-wrap {
            position: fixed;
            bottom: 90px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: var(--dark);
            color: white;
            padding: 12px 18px;
            border-radius: var(--radius-md);
            font-size: .85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-xl);
            animation: slideIn .3s ease;
            border-left: 4px solid var(--success);
            min-width: 260px;
        }

        .toast.err {
            border-left-color: var(--danger);
        }

        @keyframes slideIn {
            from {
                transform: translateX(80px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(46, 53, 61, .6);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-box {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 32px;
            max-width: 400px;
            width: 100%;
            box-shadow: var(--shadow-xl);
            text-align: center;
            animation: popIn .22s ease;
        }

        @keyframes popIn {
            from {
                transform: scale(.92);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 1024px) {
            .tp-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 860px) {
            .manage-layout {
                grid-template-columns: 1fr;
            }

            .manage-sidebar {
                position: static;
            }
        }

        @media (max-width: 640px) {

            .fg2,
            .fg3 {
                grid-template-columns: 1fr;
            }

            .stock-grid {
                grid-template-columns: 1fr 1fr;
            }

            .status-grid {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .img-preview-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .cat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .district-card {
            padding: 10px 12px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all .18s;
            background: var(--white);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .district-card:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .district-card.active {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .district-card .dc-icon {
            font-size: .9rem;
            flex-shrink: 0;
        }

        .district-card .dc-name {
            font-size: .78rem;
            font-weight: 600;
            color: var(--dark);
        }

        .district-card.active .dc-name {
            color: var(--primary);
        }

        .district-card .dc-check {
            margin-left: auto;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary);
            display: none;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: .55rem;
            flex-shrink: 0;
        }

        .district-card.active .dc-check {
            display: flex;
        }

        @media (max-width: 640px) {
            .cat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    @include('layouts.partials.navbar')

    <div class="store-topbar-header">
        <div class="container">
            <div class="store-topbar-inner">
                <div class="store-topbar-id">
                    <div class="store-topbar-logo">🍱</div>
                    <div>
                        <div class="store-topbar-name">{{ Auth::user()->shops->name ?? 'Toko Saya' }}</div>
                        <div class="store-topbar-sub">
                            <span><i class="fa-solid fa-circle" style="color:#22c55e;font-size:.45rem;"></i> Toko
                                Aktif</span>
                            <span class="dot-sep"></span>
                            <span><i class="fa-solid fa-location-dot fa-xs"></i>
                                {{ Auth::user()->shops->district ?? 'Lokasi' }}</span>
                            <span class="dot-sep"></span>
                            <span>48 Produk</span>
                        </div>
                    </div>
                </div>
                <div class="store-topbar-actions">
                    <a href="{{ route('shop.show', Auth::user()->shops->slug) }}" class="btn btn-ghost btn-sm"
                        style="color:rgba(255,255,255,.6);border:1.5px solid rgba(255,255,255,.15);">
                        <i class="fa-solid fa-eye fa-xs"></i> Preview Toko
                    </a>
                    <button class="btn btn-primary btn-sm"
                        onclick="showPanel('tambah-produk'); setActive(document.querySelector('[data-panel=tambah-produk]'))">
                        <i class="fa-solid fa-plus fa-xs"></i> Tambah Produk
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="store-sec-nav">
                <div class="sec-tab active" data-panel="ringkasan" onclick="showPanel('ringkasan',this)"><i
                        class="fa-solid fa-house-chimney fa-xs"></i> Ringkasan</div>
                <div class="sec-tab" data-panel="produk-saya" onclick="showPanel('produk-saya',this)"><i
                        class="fa-solid fa-box fa-xs"></i> Produk <span class="cnt">48</span></div>
                <div class="sec-tab" data-panel="tambah-produk" onclick="showPanel('tambah-produk',this)"><i
                        class="fa-solid fa-circle-plus fa-xs"></i> Tambah Produk</div>
                <div class="sec-tab" data-panel="analitik" onclick="showPanel('analitik',this)"><i
                        class="fa-solid fa-chart-line fa-xs"></i> Analitik</div>
                <div class="sec-tab" data-panel="info-toko" onclick="showPanel('info-toko',this)"><i
                        class="fa-solid fa-store fa-xs"></i> Info Toko</div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="manage-layout">

            <aside class="manage-sidebar">
                <div class="side-card">
                    <div class="side-nav-item active" data-panel="ringkasan" onclick="showPanel('ringkasan',this)">
                        <i class="fa-solid fa-house-chimney"></i> Ringkasan
                    </div>
                    <div class="side-nav-item" data-panel="produk-saya" onclick="showPanel('produk-saya',this)">
                        <i class="fa-solid fa-box"></i> Kelola Produk <span class="badge badge-primary"
                            style="margin-left:auto;font-size:.65rem;padding:1px 6px;">48</span>
                    </div>
                    <div class="side-nav-item" data-panel="tambah-produk" onclick="showPanel('tambah-produk',this)">
                        <i class="fa-solid fa-circle-plus"></i> Tambah Produk
                    </div>
                    <div class="side-sep"></div>
                    <div class="side-nav-item" data-panel="analitik" onclick="showPanel('analitik',this)">
                        <i class="fa-solid fa-chart-line"></i> Analitik
                    </div>
                    <div class="side-sep"></div>
                    <div class="side-nav-item" data-panel="info-toko" onclick="showPanel('info-toko',this)">
                        <i class="fa-solid fa-store"></i> Info Toko
                    </div>
                    <div class="side-sep"></div>
                    <div class="side-nav-item danger" onclick="confirmDeactivate()"><i
                            class="fa-solid fa-power-off"></i> Nonaktifkan Toko</div>
                </div>

                <div class="health-card">
                    <div class="health-title"><i class="fa-solid fa-heart-pulse"></i> Kesehatan Toko</div>
                    <div class="health-item">
                        <div class="health-dot h-green"></div><span class="health-label">Foto Logo</span><span
                            class="health-val" style="color:var(--success);">✓</span>
                    </div>
                    <div class="health-item">
                        <div class="health-dot h-green"></div><span class="health-label">Deskripsi Toko</span><span
                            class="health-val" style="color:var(--success);">✓</span>
                    </div>
                    <div class="health-item">
                        <div class="health-dot h-green"></div><span class="health-label">Nomor WA</span><span
                            class="health-val" style="color:var(--success);">✓</span>
                    </div>
                    <div class="health-item">
                        <div class="health-dot h-orange"></div><span class="health-label">Foto Banner</span><span
                            class="health-val" style="color:var(--primary);">! Belum</span>
                    </div>
                    <div class="health-item">
                        <div class="health-dot h-orange"></div><span class="health-label">Link Sosmed</span><span
                            class="health-val" style="color:var(--primary);">! Belum</span>
                    </div>
                    <div style="margin-top:12px;">
                        <div
                            style="display:flex;justify-content:space-between;font-size:.72rem;color:var(--dark-light);margin-bottom:4px;">
                            <span>Kelengkapan</span><span style="font-weight:700;color:var(--primary);">72%</span>
                        </div>
                        <div style="height:6px;background:var(--border);border-radius:3px;overflow:hidden;">
                            <div style="height:100%;width:72%;background:var(--primary);border-radius:3px;"></div>
                        </div>
                    </div>
                </div>
            </aside>

            <main>

                <div class="panel active" id="panel-ringkasan">
                    <div class="stat-row">
                        <div class="stat-card">
                            <div class="stat-card-icon" style="background:#fff3e8;"><i class="fa-solid fa-box"
                                    style="color:var(--primary);"></i></div>
                            <div class="stat-card-label">Total Produk</div>
                            <div class="stat-card-num">48</div>
                            <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                +4 bulan ini</div>
                            <div class="mini-chart" id="mc-produk"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon" style="background:#d1fae5;"><i class="fa-brands fa-whatsapp"
                                    style="color:var(--success);"></i></div>
                            <div class="stat-card-label">Chat WA Masuk</div>
                            <div class="stat-card-num">320</div>
                            <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                +18% vs bln lalu</div>
                            <div class="mini-chart" id="mc-wa"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon" style="background:#dbeafe;"><i class="fa-regular fa-eye"
                                    style="color:#3b82f6;"></i></div>
                            <div class="stat-card-label">Total Dilihat</div>
                            <div class="stat-card-num">1.24K</div>
                            <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                +32% vs bln lalu</div>
                            <div class="mini-chart" id="mc-views"></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon" style="background:#fef3c7;"><i class="fa-solid fa-star"
                                    style="color:#fbbf24;"></i></div>
                            <div class="stat-card-label">Rating Rata-rata</div>
                            <div class="stat-card-num">4.9</div>
                            <div class="stat-card-change" style="color:var(--dark-light);">dari 248 ulasan</div>
                            <div style="display:flex;gap:2px;margin-top:8px;color:#fbbf24;">★★★★★</div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-title"><span><i class="fa-solid fa-bolt"></i>Aksi Cepat</span></div>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
                            <button class="btn btn-primary w-full"
                                onclick="showPanel('tambah-produk'); setActive(document.querySelector('[data-panel=tambah-produk]'))">
                                <i class="fa-solid fa-plus"></i> Tambah Produk
                            </button>
                            <button class="btn btn-dark w-full"
                                onclick="showPanel('info-toko'); setActive(document.querySelector('[data-panel=info-toko]'))">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Info Toko
                            </button>
                            <a href="store-profile.html" class="btn btn-outline w-full"><i
                                    class="fa-solid fa-eye"></i> Preview Publik</a>
                            <button class="btn btn-ghost w-full" style="border:1.5px solid var(--border);"
                                onclick="copyWALink()"><i class="fa-solid fa-share-nodes"></i> Bagikan Toko</button>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-title">
                            <span><i class="fa-solid fa-clock-rotate-left"></i> Produk Terbaru</span>
                            <a onclick="showPanel('produk-saya'); setActive(document.querySelector('[data-panel=produk-saya]'))"
                                style="font-size:.8rem;color:var(--primary);font-weight:600;cursor:pointer;">Lihat
                                Semua →</a>
                        </div>
                        <div id="recent-prods"></div>
                    </div>
                </div>

                <div class="panel" id="panel-produk-saya">
                    <div class="sec-title-row">
                        <h3>Kelola Produk <span
                                style="font-size:.8rem;color:var(--dark-light);font-weight:400;">({{ count($jsProducts ?? []) }}
                                produk)</span></h3>
                        <button class="btn btn-primary btn-sm"
                            onclick="showPanel('tambah-produk'); setActive(document.querySelector('[data-panel=tambah-produk]'))">
                            <i class="fa-solid fa-plus"></i> Tambah Produk
                        </button>
                    </div>

                    <div class="prod-filter-row">
                        <div class="prod-search-wrap" style="flex:1;min-width:180px;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input class="form-control" style="padding-left:36px;" placeholder="Cari nama produk..."
                                oninput="filterProds(this.value)">
                        </div>
                        <select class="form-control" style="width:160px;padding:9px 12px;"
                            onchange="filterByStatus(this.value)">
                            <option value="">Semua Status</option>
                            <option value="featured">⭐ Unggulan</option>
                            <option value="active">Aktif</option>
                        </select>
                        <select class="form-control" style="width:160px;padding:9px 12px;">
                            <option>Semua Kategori</option>
                            <option>Kue Kering</option>
                            <option>Hampers</option>
                            <option>Minuman</option>
                        </select>
                    </div>

                    <div class="bulk-bar" id="bulk-bar">
                        <span><strong id="bulk-count">0</strong> produk dipilih</span>
                        <button class="btn btn-sm" style="background:rgba(255,255,255,.15);color:white;border:none;"
                            onclick="bulkToggleFeatured()">⭐ Toggle Unggulan</button>
                        <button class="btn btn-sm" style="background:rgba(239,68,68,.8);color:white;border:none;"
                            onclick="openDeleteModal('bulk')"><i class="fa-solid fa-trash fa-xs"></i> Hapus
                            Dipilih</button>
                        <button class="btn btn-sm btn-ghost" style="color:rgba(255,255,255,.6);margin-left:auto;"
                            onclick="clearBulk()">Batal</button>
                    </div>

                    <div class="prod-table-wrap">
                        <table class="prod-table" id="prod-table">
                            <thead>
                                <tr>
                                    <th style="width:40px;"><input type="checkbox" id="check-all"
                                            onchange="toggleAllCheck(this)" style="accent-color:var(--primary);"></th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Dilihat</th>
                                    <th>Unggulan</th>
                                    <th>Status</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="prod-tbody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="panel" id="panel-tambah-produk">
                    <div class="sec-title-row">
                        <h3>Tambah Produk Baru</h3>
                        <span class="badge" style="background:var(--primary);color:white;">MODE: TAMBAH</span>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger"
                            style="background:var(--danger);color:white;padding:15px;border-radius:8px;margin-bottom:20px;width:100%;">
                            <div style="font-weight:bold;margin-bottom:8px;"><i
                                    class="fa-solid fa-triangle-exclamation"></i> Terdapat kesalahan pada form:</div>
                            <ul style="margin:0;padding-left:20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="tp-layout">
                        <form id="form-tambah-produk" action="{{ route('product.store') }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return handleFormSubmit(event)">
                            @csrf

                            <div class="fcard">
                                <div class="fcard-head">
                                    <div class="fcard-icon"><i class="fa-solid fa-images"></i></div>
                                    <div>
                                        <div class="fcard-title">Foto Produk</div>
                                        <div class="fcard-sub">Tabel <code>product_images</code> · Maks. 4 foto</div>
                                    </div>
                                    <span class="badge badge-primary" style="margin-left:auto;font-size:.68rem;"
                                        id="img-count-badge">0 / 4</span>
                                </div>
                                <div class="fcard-body">
                                    <input type="file" id="file-input" name="images[]" class="img-hidden-input"
                                        multiple accept="image/*" style="display:none;">

                                    <div class="img-upload-area" id="drop-zone" ondragover="onDragOver(event)"
                                        ondragleave="onDragLeave(event)" ondrop="onDrop(event)"
                                        onclick="document.getElementById('file-input').click()">
                                        <div class="upload-icon">📸</div>
                                        <div class="upload-title">Tarik & Lepas foto di sini</div>
                                        <div class="upload-sub">atau klik untuk memilih dari perangkat kamu</div>
                                        <div class="upload-or">atau gunakan emoji cepat di bawah</div>
                                        <button type="button" class="btn btn-outline btn-sm"
                                            onclick="event.stopPropagation();document.getElementById('file-input').click()"><i
                                                class="fa-solid fa-upload fa-xs"></i> Pilih File</button>

                                        <div class="emoji-picker-row">
                                            <div class="ep-label">⚡ Pilih emoji sebagai placeholder foto:</div>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🍪')">🍪</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🎁')">🎁</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🧁')">🧁</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🍯')">🍯</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'👜')">👜</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🎨')">🎨</button>
                                            <button type="button" class="ep-btn"
                                                onclick="event.stopPropagation();addEmojiSlot(this,'🍱')">🍱</button>
                                        </div>
                                    </div>
                                    <div class="img-preview-grid" id="img-preview-grid"></div>
                                </div>
                            </div>

                            <div class="fcard">
                                <div class="fcard-head">
                                    <div class="fcard-icon"><i class="fa-solid fa-file-lines"></i></div>
                                    <div>
                                        <div class="fcard-title">Informasi Dasar</div>
                                        <div class="fcard-sub">Kolom: <code>name</code> · <code>slug</code> ·
                                            <code>description</code>
                                        </div>
                                    </div>
                                </div>
                                <div class="fcard-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama Produk <span>*</span></label>
                                        <input class="form-control" id="prod-name" name="name"
                                            placeholder="Contoh: Nastar Keju Premium Lebaran 500gr" maxlength="150"
                                            oninput="onName(this.value)">
                                        <div class="ffoot"><span class="form-hint">Sertakan
                                                ukuran/varian.</span><span class="cc" id="cc-name">0/150</span>
                                        </div>
                                    </div>
                                    <div class="fg2">
                                        <div class="form-group">
                                            <label class="form-label">Kategori <span>*</span></label>
                                            <select class="form-control" id="prod-cat" name="category_id"
                                                onchange="updateProgress()">
                                                <option value="">— Pilih Kategori —</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Slug URL <span>*</span></label>
                                            <input class="form-control" id="prod-slug" name="slug"
                                                placeholder="nastar-keju-premium" maxlength="170"
                                                oninput="onSlug(this.value)">
                                            <div class="slug-pill" id="slug-pill"><i class="fa-solid fa-link fa-xs"
                                                    style="color:var(--dark-light);"></i> /produk/<span
                                                    class="slug-val" id="slug-val">nama-produk</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label class="form-label">Deskripsi Produk <span>*</span></label>
                                        <textarea class="form-control" id="prod-desc" name="description" rows="5" maxlength="2000"
                                            oninput="onDesc(this.value)" placeholder="Deskripsikan produkmu secara detail..."></textarea>
                                        <div class="ffoot"><span class="form-hint">Min. 50 karakter untuk
                                                publikasi.</span><span class="cc" id="cc-desc">0/2000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fcard">
                                <div class="fcard-head">
                                    <div class="fcard-icon"><i class="fa-solid fa-tag"></i></div>
                                    <div>
                                        <div class="fcard-title">Harga & Detail Satuan</div>
                                    </div>
                                </div>
                                <div class="fcard-body">
                                    <div class="fg2">
                                        <div class="form-group">
                                            <label class="form-label">Harga Jual <span>*</span></label>
                                            <div class="price-row">
                                                <div class="price-pfx">Rp</div><input class="form-control"
                                                    id="prod-price" name="price" type="number" min="0"
                                                    oninput="onPrice()">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Harga Coret <span
                                                    style="font-weight:400;color:var(--dark-light);">(opsional)</span></label>
                                            <div class="price-row">
                                                <div class="price-pfx" style="color:var(--dark-light);">Rp</div><input
                                                    class="form-control" id="prod-price-ori" type="number"
                                                    min="0" oninput="onPrice()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fcard">
                                <div class="fcard-head">
                                    <div class="fcard-icon green"><i class="fa-solid fa-boxes-stacked"></i></div>
                                    <div>
                                        <div class="fcard-title">Ketersediaan Stok</div>
                                    </div>
                                </div>
                                <div class="fcard-body">
                                    <div class="stock-grid">
                                        <div class="scard on" onclick="setStock(this,'available')"><span
                                                class="s-ico">✅</span>
                                            <div class="s-lbl">Ready Stock</div>
                                        </div>
                                        <div class="scard" onclick="setStock(this,'preorder')"><span
                                                class="s-ico">🕐</span>
                                            <div class="s-lbl">Pre-Order</div>
                                        </div>
                                        <div class="scard" onclick="setStock(this,'limited')"><span
                                                class="s-ico">⚠️</span>
                                            <div class="s-lbl">Terbatas</div>
                                        </div>
                                        <div class="scard" onclick="setStock(this,'empty')"><span
                                                class="s-ico">❌</span>
                                            <div class="s-lbl">Habis</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fcard">
                                <div class="fcard-head">
                                    <div class="fcard-icon gold"><i class="fa-solid fa-eye"></i></div>
                                    <div>
                                        <div class="fcard-title">Visibilitas & Status Produk</div>
                                    </div>
                                </div>
                                <div class="fcard-body">
                                    <div class="feat-row" id="feat-row" onclick="toggleFeat()">
                                        <div class="feat-ico">⭐</div>
                                        <div class="feat-info">
                                            <div class="feat-lbl">Tandai sebagai Produk Unggulan</div>
                                            <div class="feat-sub">Produk unggulan tampil di bagian atas halaman toko.
                                            </div>
                                        </div>
                                        <label class="tsw" onclick="event.stopPropagation()">
                                            <input type="checkbox" id="prod-feat" name="is_featured" value="1"
                                                onchange="document.getElementById('feat-row').classList.toggle('on',this.checked);updatePreview();">
                                            <div class="tsw-track"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="save-bar">
                                <div class="save-bar-inner">
                                    <div class="save-bar-info">
                                        <i class="fa-solid fa-circle-info fa-xs" style="color:var(--primary);"></i>
                                        Kolom <span style="color:var(--primary);font-weight:700;">*</span> wajib diisi.
                                        <span id="sb-progress"
                                            style="margin-left:6px;color:var(--primary);font-weight:600;"></span>
                                    </div>
                                    <div class="save-bar-acts">
                                        <button type="button" class="btn btn-ghost" onclick="saveDraft()"><i
                                                class="fa-solid fa-floppy-disk fa-xs"></i> Draft</button>
                                        <button type="submit" form="form-tambah-produk" class="btn btn-primary"
                                            id="pub-btn">
                                            <i class="fa-solid fa-rocket fa-xs"></i> Simpan & Publikasikan
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <aside
                            style="position:sticky;top:calc(var(--nav-h)+16px);display:flex;flex-direction:column;gap:18px;">
                            <div>
                                <div
                                    style="font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--dark-light);margin-bottom:10px;">
                                    Preview Katalog</div>
                                <div class="preview-card">
                                    <div class="prev-img" id="prev-img"
                                        style="background:linear-gradient(135deg,#fef3c7,#fed7aa);">
                                        <div id="prev-emoji">📦</div>
                                        <div class="prev-badges"><span class="prev-badge pb-new">Baru</span><span
                                                class="prev-badge pb-feat" id="pb-feat">⭐ Unggulan</span></div>
                                    </div>
                                    <div class="prev-body">
                                        <div class="prev-shop-lbl"><i class="fa-solid fa-store fa-xs"></i> Dapur Bu
                                            Sari</div>
                                        <div class="prev-name" id="prev-name">Nama produk akan tampil di sini...</div>
                                        <div class="prev-cat" id="prev-cat">— Pilih kategori —</div>
                                        <div class="prev-price"><span id="prev-price">Rp —</span></div>
                                        <button class="prev-wa-btn"><i class="fa-brands fa-whatsapp"></i> Pesan via
                                            WhatsApp</button>
                                    </div>
                                </div>
                            </div>

                            <div class="prog-box">
                                <div class="prog-title"><i class="fa-solid fa-list-check"></i> Kelengkapan Form</div>
                                <div class="prog-bar-wrap">
                                    <div class="prog-bar" id="prog-bar"></div>
                                </div>
                                <div class="prog-pct"><span id="prog-txt">0% lengkap</span></div>
                                <div class="prog-checklist">
                                    <div class="prog-item" id="pi-photo">
                                        <div class="prog-dot" id="pd-photo">1</div>Foto produk
                                    </div>
                                    <div class="prog-item" id="pi-name">
                                        <div class="prog-dot" id="pd-name">2</div>Nama produk
                                    </div>
                                    <div class="prog-item" id="pi-cat">
                                        <div class="prog-dot" id="pd-cat">3</div>Kategori
                                    </div>
                                    <div class="prog-item" id="pi-price">
                                        <div class="prog-dot" id="pd-price">4</div>Harga jual
                                    </div>
                                    <div class="prog-item" id="pi-desc">
                                        <div class="prog-dot" id="pd-desc">5</div>Deskripsi
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="panel" id="panel-analitik">
                    <div class="sec-title-row">
                        <h3>Analitik Toko</h3>
                        <select class="form-control" style="width:140px;padding:8px 12px;font-size:.82rem;">
                            <option>Juni 2026</option>
                            <option>Mei 2026</option>
                        </select>
                    </div>
                    <div class="stat-row">
                        <div class="stat-card" style="border-top:3px solid var(--primary);">
                            <div class="stat-card-label">Chat WA</div>
                            <div class="stat-card-num" style="font-size:1.5rem;">87</div>
                        </div>
                        <div class="stat-card" style="border-top:3px solid #3b82f6;">
                            <div class="stat-card-label">Total Tayangan</div>
                            <div class="stat-card-num" style="font-size:1.5rem;">412</div>
                        </div>
                        <div class="stat-card" style="border-top:3px solid #10b981;">
                            <div class="stat-card-label">Konversi WA</div>
                            <div class="stat-card-num" style="font-size:1.5rem;">21%</div>
                        </div>
                        <div class="stat-card" style="border-top:3px solid #fbbf24;">
                            <div class="stat-card-label">Wishlist Ditambah</div>
                            <div class="stat-card-num" style="font-size:1.5rem;">56</div>
                        </div>
                    </div>
                </div>

                <div class="panel" id="panel-info-toko">
                    <div class="sec-title-row">
                        <h3>Pengaturan Info Toko</h3>
                    </div>
                    <div class="info-card">
                        <div class="info-card-title"
                            style="display:flex; justify-content:space-between; align-items:center;">
                            <span><i class="fa-solid fa-circle-info"></i> Informasi Utama Toko (Edit Cepat)</span>
                            <a href="{{ route('shop.edit') }}"
                                style="font-size:0.75rem; color:var(--primary); font-weight:600; text-decoration:none;"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit Selengkapnya</a>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Toko</label>
                            <input class="form-control" id="qe-name" value="{{ $shop->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <div class="cat-grid" id="cat-grid">
                                <div class="district-card {{ ($shop->category ?? '') == 'kuliner' ? 'active' : '' }}" onclick="selectCat(this,'kuliner')">
                                    <span class="dc-icon">🍱</span><span class="dc-name">Kuliner</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'fashion' ? 'active' : '' }}" onclick="selectCat(this,'fashion')">
                                    <span class="dc-icon">👗</span><span class="dc-name">Fashion</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'kerajinan' ? 'active' : '' }}" onclick="selectCat(this,'kerajinan')">
                                    <span class="dc-icon">🎨</span><span class="dc-name">Kerajinan</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'pertanian' ? 'active' : '' }}" onclick="selectCat(this,'pertanian')">
                                    <span class="dc-icon">🌿</span><span class="dc-name">Pertanian</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'kecantikan' ? 'active' : '' }}" onclick="selectCat(this,'kecantikan')">
                                    <span class="dc-icon">💆</span><span class="dc-name">Kecantikan</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'dekorasi' ? 'active' : '' }}" onclick="selectCat(this,'dekorasi')">
                                    <span class="dc-icon">🪴</span><span class="dc-name">Dekorasi</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'elektronik' ? 'active' : '' }}" onclick="selectCat(this,'elektronik')">
                                    <span class="dc-icon">🔌</span><span class="dc-name">Elektronik</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                                <div class="district-card {{ ($shop->category ?? '') == 'lainnya' ? 'active' : '' }}" onclick="selectCat(this,'lainnya')">
                                    <span class="dc-icon">📦</span><span class="dc-name">Lainnya</span>
                                    <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                </div>
                            </div>
                            <input type="hidden" id="qe-cat" value="{{ $shop->category }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Whatsapp</label>
                            <div style="position:relative;">
                                <span
                                    style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--dark-mid); font-weight:600;">+62</span>
                                <input class="form-control" id="qe-wa"
                                    value="{{ preg_replace('/^(\+?62|0)/', '', $shop->whatsapp_number) }}"
                                    style="padding-left: 42px;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Toko</label>
                            <textarea class="form-control" id="qe-desc" rows="4">{{ $shop->description }}</textarea>
                        </div>
                        <button class="btn btn-primary" id="btn-quick-edit" onclick="saveQuickEdit()"><i
                                class="fa-solid fa-floppy-disk"></i> Simpan
                            Perubahan</button>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div class="toast-wrap" id="tw"></div>
    <div class="modal-overlay" id="delete-modal">
        <div class="modal-box">
            <div class="modal-icon">🗑️</div>
            <h3>Hapus Produk?</h3>
            <p>Produk ini akan dihapus permanen dari tokomu dan tidak dapat dikembalikan.</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <button class="btn btn-ghost" onclick="closeDeleteModal()">Batal</button>
                <button class="btn" style="background:var(--danger);color:white;" onclick="confirmDelete()">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script>
        /* ═══════════════════════════════════════
                           TAB & PANEL MANAGEMENT
                        ═══════════════════════════════════════ */
        function showPanel(id, el) {
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.getElementById('panel-' + id).classList.add('active');
            if (el) setActive(el);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function setActive(el) {
            if (!el) return;
            if (el.classList.contains('sec-tab')) {
                document.querySelectorAll('.sec-tab').forEach(t => t.classList.remove('active'));
                el.classList.add('active');
            }
            if (el.classList.contains('side-nav-item')) {
                document.querySelectorAll('.side-nav-item').forEach(t => t.classList.remove('active'));
                el.classList.add('active');
            }
        }

        function toast(msg, type = 'success') {
            const wrap = document.getElementById('tw');
            const el = document.createElement('div');
            el.className = 'toast' + (type === 'err' ? ' err' : '');
            el.innerHTML = (type !== 'err' ? '<i class="fa-solid fa-circle-check"></i> ' :
                '<i class="fa-solid fa-triangle-exclamation"></i> ') + msg;
            wrap.appendChild(el);
            setTimeout(() => el.style.opacity = '0', 3000);
            setTimeout(() => el.remove(), 3400);
        }

        /* ═══════════════════════════════════════
           KELOLA PRODUK (TABEL) LOGIC
        ═══════════════════════════════════════ */
        const PRODUCTS = {!! json_encode($jsProducts ?? []) !!};

        function renderTable(data) {
            const tbody = document.getElementById('prod-tbody');
            if (!tbody) return;
            tbody.innerHTML = data.map(p => `
            <tr id="row-${p.id}">
                <td><input type="checkbox" class="prod-check" style="accent-color:var(--primary);" onchange="toggleCheck(${p.id},this)"></td>
                <td>
                    <div class="prod-name-cell">
                        <div class="prod-thumb" style="background:${p.bg};position:relative;overflow:hidden;">
                            ${p.img_url ? `<img src="${p.img_url}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">` : p.e}
                        </div>
                        <div><div class="prod-name-text">${p.name}</div><div class="prod-slug">${p.slug}</div></div>
                    </div>
                </td>
                <td class="price-cell">Rp ${p.price.toLocaleString('id-ID')}</td>
                <td><span class="badge badge-dark" style="font-size:.7rem;">${p.cat}</span></td>
                <td><i class="fa-regular fa-eye fa-xs"></i> ${p.views.toLocaleString('id-ID')}</td>
                <td>${p.featured ? '⭐ Ya' : 'Tidak'}</td>
                <td>Aktif</td>
                <td>
                    <div class="action-btns" style="justify-content:center;">
                        <div class="icon-btn" onclick="showPanel('tambah-produk')"><i class="fa-solid fa-pen fa-xs"></i></div>
                        <div class="icon-btn" onclick="openDeleteModal()"><i class="fa-solid fa-trash fa-xs"></i></div>
                    </div>
                </td>
            </tr>
            `).join('');
        }
        renderTable(PRODUCTS);

        let selectedProds = new Set();

        function toggleCheck(id, el) {
            el.checked ? selectedProds.add(id) : selectedProds.delete(id);
            updateBulkBar();
        }

        function toggleAllCheck(masterEl) {
            document.querySelectorAll('.prod-check').forEach(c => {
                c.checked = masterEl.checked;
                const id = parseInt(c.closest('tr').id.replace('row-', ''));
                masterEl.checked ? selectedProds.add(id) : selectedProds.delete(id);
            });
            updateBulkBar();
        }

        function updateBulkBar() {
            document.getElementById('bulk-bar').classList.toggle('show', selectedProds.size > 0);
            document.getElementById('bulk-count').textContent = selectedProds.size;
        }

        function clearBulk() {
            selectedProds.clear();
            document.querySelectorAll('.prod-check,#check-all').forEach(c => c.checked = false);
            updateBulkBar();
        }

        function bulkToggleFeatured() {
            toast('⭐ Status diperbarui');
            clearBulk();
        }

        function openDeleteModal() {
            document.getElementById('delete-modal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.remove('show');
        }

        function confirmDelete() {
            toast('Produk dihapus');
            closeDeleteModal();
            clearBulk();
        }

        /* ═══════════════════════════════════════
           TAMBAH PRODUK FORM LOGIC
        ═══════════════════════════════════════ */
        let images = [];
        let _syncing = false;
        const fileInput = document.getElementById('file-input');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (_syncing) return;
                if (this.files && this.files.length) {
                    handleFiles(this.files);
                }
            });
        }

        const IMG_BG = ['linear-gradient(135deg,#fef3c7,#fed7aa)', 'linear-gradient(135deg,#dbeafe,#bfdbfe)',
            'linear-gradient(135deg,#d1fae5,#a7f3d0)'
        ];

        /* ═══ IMAGE UPLOAD ═══ */
        function onDragOver(e) {
            e.preventDefault();
            const dropZone = document.getElementById('drop-zone');
            if (dropZone) dropZone.classList.add('dragover');
        }

        function onDragLeave(e) {
            const dropZone = document.getElementById('drop-zone');
            if (dropZone) dropZone.classList.remove('dragover');
        }

        function onDrop(e) {
            e.preventDefault();
            onDragLeave(e);
            if (e.dataTransfer.files.length) {
                handleFiles(e.dataTransfer.files);
            }
        }

        function handleFiles(fileList) {
            const filesToProcess = [...fileList].filter(f => f.type.startsWith('image/'));
            if (!filesToProcess.length) return;

            filesToProcess.forEach(f => {
                if (images.length >= 4) {
                    toast('Maksimal 4 foto produk', 'err');
                    return;
                }

                const isPrimary = images.length === 0;
                const idx = images.length;
                images.push({
                    file: f,
                    url: null,
                    emoji: null,
                    isPrimary,
                    loading: true
                });
                renderImageGrid();

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (images[idx]) {
                        images[idx].url = e.target.result;
                        images[idx].loading = false;
                        renderImageGrid();
                        if (images[idx].isPrimary) {
                            updatePreviewImage(e.target.result);
                        }
                        toast(
                            `📸 Foto ${idx + 1} berhasil dimuat${images[idx].isPrimary ? ' sebagai foto utama' : ''}`);
                    }
                    syncFileInput();
                    updateProgress();
                };
                reader.readAsDataURL(f);
            });
            updateProgress();
        }

        function addEmojiSlot(btn, emoji) {
            if (images.length >= 4) return toast('Maksimal 4 foto produk', 'err');
            const isPrimary = images.length === 0;
            images.push({
                file: null,
                url: null,
                emoji,
                isPrimary,
                loading: false
            });
            renderImageGrid();
            updateProgress();
            if (isPrimary) {
                const pe = document.getElementById('prev-emoji');
                if (pe) {
                    pe.textContent = emoji;
                    pe.style.display = '';
                }
                const pi = document.getElementById('prev-img');
                if (pi) {
                    pi.style.background = IMG_BG[Math.floor(Math.random() * IMG_BG.length)];
                    const existingImg = pi.querySelector('img');
                    if (existingImg) existingImg.remove();
                }
            }
            toast(`📸 Foto ditambahkan`);
        }

        function updatePreviewImage(url) {
            const prevImgEl = document.getElementById('prev-img');
            const prevEmoji = document.getElementById('prev-emoji');
            if (prevEmoji) prevEmoji.style.display = 'none';
            if (prevImgEl) {
                let img = prevImgEl.querySelector('img');
                if (!img) {
                    img = document.createElement('img');
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover;position:absolute;inset:0;';
                    prevImgEl.appendChild(img);
                }
                img.src = url;
            }
        }

        function removeImg(idx) {
            images.splice(idx, 1);
            images.forEach((img, i) => img.isPrimary = i === 0);
            syncFileInput();
            renderImageGrid();
            updateProgress();

            if (images.length === 0) {
                const pe = document.getElementById('prev-emoji');
                if (pe) {
                    pe.textContent = '📦';
                    pe.style.display = '';
                }
                const pi = document.getElementById('prev-img');
                if (pi) {
                    pi.style.background = 'linear-gradient(135deg,#fef3c7,#fed7aa)';
                    const existingImg = pi.querySelector('img');
                    if (existingImg) existingImg.remove();
                }
            } else if (images[0].url) {
                updatePreviewImage(images[0].url);
            } else if (images[0].emoji) {
                const pe = document.getElementById('prev-emoji');
                if (pe) {
                    pe.textContent = images[0].emoji;
                    pe.style.display = '';
                }
                const pi = document.getElementById('prev-img');
                if (pi) {
                    const existingImg = pi.querySelector('img');
                    if (existingImg) existingImg.remove();
                }
            }
        }

        function setMainImg(idx) {
            if (images[idx].loading) return;
            images.forEach((img, i) => img.isPrimary = i === idx);
            renderImageGrid();
            if (images[idx].url) {
                updatePreviewImage(images[idx].url);
            } else if (images[idx].emoji) {
                const pe = document.getElementById('prev-emoji');
                if (pe) {
                    pe.textContent = images[idx].emoji;
                    pe.style.display = '';
                }
                const pi = document.getElementById('prev-img');
                if (pi) {
                    const existingImg = pi.querySelector('img');
                    if (existingImg) existingImg.remove();
                }
            }
            toast('✅ Foto utama diperbarui');
        }

        function syncFileInput() {
            _syncing = true;
            const dt = new DataTransfer();
            images.forEach(img => {
                if (img.file) dt.items.add(img.file);
            });
            if (fileInput) fileInput.files = dt.files;
            setTimeout(() => {
                _syncing = false;
            }, 50);
        }

        function renderImageGrid() {
            const grid = document.getElementById('img-preview-grid');
            if (!grid) return;

            const badge = document.getElementById('img-count-badge');
            if (badge) badge.textContent = images.length + ' / 4';

            let html = images.map((img, i) => {
                if (img.loading) {
                    return `
    <div class="img-preview-item" style="${img.isPrimary?'border-color:var(--primary);':''}cursor:default;">
      <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
        <div class="img-loading-spinner"></div>
        <span style="font-size:.65rem;color:var(--dark-light);">Memuat...</span>
      </div>
      ${img.isPrimary ? '<div class="img-primary-lbl">Utama</div>' : ''}
    </div>`;
                }
                return `
    <div class="img-preview-item" onclick="setMainImg(${i})" title="${img.isPrimary?'Foto Utama':'Klik untuk jadikan foto utama'}" style="${img.isPrimary?'border-color:var(--primary);':''}${img.url ? 'font-size:0;' : ''}">
      ${img.url ? `<img src="${img.url}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;border-radius:inherit;">` : (img.emoji || '')}
      <div class="item-del" onclick="event.stopPropagation();removeImg(${i})"><i class="fa-solid fa-xmark"></i></div>
      ${img.isPrimary ? '<div class="img-primary-lbl">Utama</div>' : ''}
    </div>`;
            }).join('');
            if (images.length < 4) html +=
                `<div class="img-add-slot" onclick="document.getElementById('file-input').click()"><i class="fa-solid fa-plus"></i><span>Tambah</span></div>`;
            grid.innerHTML = html;
        }

        function onName(val) {
            document.getElementById('cc-name').textContent = val.length + '/150';
            const slug = val.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').replace(
                /^-|-$/g, '');
            document.getElementById('prod-slug').value = slug;
            onSlug(slug);
            document.getElementById('prev-name').textContent = val || 'Nama produk akan tampil di sini...';
            updateProgress();
        }

        function onSlug(val) {
            document.getElementById('slug-val').textContent = val || 'nama-produk';
        }

        function onDesc(val) {
            document.getElementById('cc-desc').textContent = val.length + '/2000';
            updateProgress();
        }

        function onPrice() {
            const p = parseInt(document.getElementById('prod-price').value) || 0;
            document.getElementById('prev-price').textContent = p > 0 ? 'Rp ' + p.toLocaleString('id-ID') : 'Rp —';
            updateProgress();
        }

        function setStock(el, val) {
            document.querySelectorAll('.scard').forEach(c => c.classList.remove('on'));
            el.classList.add('on');
        }

        function toggleFeat() {
            const cb = document.getElementById('prod-feat');
            cb.checked = !cb.checked;
            document.getElementById('feat-row').classList.toggle('on', cb.checked);
            document.getElementById('pb-feat').style.display = cb.checked ? 'inline' : 'none';
        }

        function updateProgress() {
            const checks = {
                photo: images.length > 0,
                name: document.getElementById('prod-name').value.trim().length >= 10,
                cat: document.getElementById('prod-cat').value !== '',
                price: parseInt(document.getElementById('prod-price').value) > 0,
                desc: document.getElementById('prod-desc').value.trim().length >= 50,
            };
            const keys = Object.keys(checks);
            const done = keys.filter(k => checks[k]).length;
            const pct = Math.round((done / keys.length) * 100);
            document.getElementById('prog-bar').style.width = pct + '%';
            document.getElementById('prog-txt').textContent = pct + '% lengkap';
            document.getElementById('sb-progress').textContent = done + '/' + keys.length + ' wajib terisi';

            keys.forEach(k => {
                if (checks[k]) {
                    document.getElementById('pd-' + k).classList.add('done');
                    document.getElementById('pi-' + k).classList.add('done');
                } else {
                    document.getElementById('pd-' + k).classList.remove('done');
                    document.getElementById('pi-' + k).classList.remove('done');
                }
            });
        }

        function validate() {
            const name = document.getElementById('prod-name').value.trim();
            const price = parseFloat(document.getElementById('prod-price').value) || 0;
            if (name.length < 10) return 'Nama produk wajib diisi (min. 10 karakter).';
            if (price <= 0) return 'Harga jual wajib diisi dan harus lebih dari Rp 0.';
            return null;
        }

        function handleFormSubmit(e) {
            const err = validate();
            if (err) {
                e.preventDefault();
                toast(err, 'err');
                return false;
            }

            if (images.some(img => img.loading)) {
                e.preventDefault();
                toast('⚠️ Harap tunggu, sedang memproses foto...', 'err');
                return false;
            }

            const btn = document.getElementById('pub-btn');
            if (btn) {
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fa-xs"></i> Mempublikasikan...';
                btn.disabled = true;
            }
            return true;
        }

        function saveDraft() {
            toast('📝 Draft berhasil disimpan');
        }

        function selectCat(el, val) {
            document.querySelectorAll('#cat-grid .district-card').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('qe-cat').value = val;
        }

        function saveQuickEdit() {
            const btn = document.getElementById('btn-quick-edit');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyimpan...';
            btn.style.pointerEvents = 'none';

            let wa = document.getElementById('qe-wa').value.trim();
            if (wa.startsWith('0')) {
                wa = wa.substring(1);
            }
            wa = '+62' + wa;

            const payload = {
                name: document.getElementById('qe-name').value,
                description: document.getElementById('qe-desc').value,
                whatsapp_number: wa,
                category: document.getElementById('qe-cat').value,
                slug: {!! json_encode($shop->slug) !!},
                logo: {!! json_encode($shop->logo) !!},
                address: {!! json_encode($shop->address) !!},
                district_name: {!! json_encode($shop->district) !!},
                operational_hours: {!! json_encode($shop->operational_hours) !!}
            };

            const csrfToken = "{{ csrf_token() }}";

            fetch("{{ route('shop.update') }}", {
                    method: 'PUT',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';
                    if (data.success) {
                        toast('Info toko berhasil diperbarui!');
                    } else {
                        toast(data.message || 'Gagal menyimpan', 'err');
                    }
                })
                .catch(err => {
                    btn.innerHTML = originalText;
                    btn.style.pointerEvents = 'auto';
                    toast('Terjadi kesalahan koneksi', 'err');
                });
        }

        // Init preview
        updateProgress();
    </script>
</body>

</html>
