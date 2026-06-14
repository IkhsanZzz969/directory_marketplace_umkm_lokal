<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kelola Toko — Dapur Bu Sari · PasarLokal</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            /* ═══════════════════════════════════════
       KELOLA TOKO — PAGE STYLES
    ═══════════════════════════════════════ */
            body {
                background: var(--bg);
            }

            /* ── TOP BAR (dark header below navbar) ── */
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

            /* ── SECONDARY NAV (tabs) ── */
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

            /* ── MAIN LAYOUT ── */
            .manage-layout {
                display: grid;
                grid-template-columns: 220px 1fr;
                gap: 24px;
                padding: 28px 0 80px;
                align-items: start;
            }

            /* ── SIDEBAR ── */
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

            /* store health mini widget */
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

            .health-item:last-child {
                margin-bottom: 0;
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

            /* ── PANELS ── */
            .panel {
                display: none;
            }

            .panel.active {
                display: block;
            }

            /* section titles */
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

            /* stat cards row */
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

            /* mini chart bars */
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

            .mc-bar:hover {
                background: var(--primary-dark);
                cursor: pointer;
            }

            /* info cards */
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

            /* ── PRODUCT TABLE ── */
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

            .prod-search .form-control {
                padding: 9px 14px 9px 36px;
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

            .prod-table tbody tr:last-child td {
                border-bottom: none;
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
                line-height: 1.3;
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

            .views-cell {
                color: var(--dark-light);
                font-size: .82rem;
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

            .icon-btn.del:hover {
                border-color: var(--danger);
                color: var(--danger);
                background: #fee2e2;
            }

            /* featured toggle */
            .feat-toggle {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .star-toggle {
                cursor: pointer;
                font-size: 1rem;
                transition: all .18s;
                opacity: .4;
            }

            .star-toggle.on {
                opacity: 1;
                color: #fbbf24;
            }

            .star-toggle:hover {
                opacity: .8;
                transform: scale(1.15);
            }

            /* bulk action bar */
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

            .bulk-bar span {
                font-size: .85rem;
                color: rgba(255, 255, 255, .8);
            }

            .bulk-bar strong {
                color: var(--primary);
            }

            /* ── ADD / EDIT PRODUCT FORM ── */
            .form-section-title {
                font-family: var(--font-display);
                font-size: .92rem;
                font-weight: 700;
                color: var(--dark);
                padding-bottom: 12px;
                border-bottom: 1.5px solid var(--border);
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .form-section-title i {
                color: var(--primary);
                font-size: .88rem;
            }

            .form-grid-2 {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .form-grid-3 {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 16px;
            }

            /* image upload area */
            .img-upload-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 12px;
                margin-bottom: 8px;
            }

            .img-upload-slot {
                aspect-ratio: 1;
                border-radius: var(--radius-md);
                border: 2px dashed var(--border);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all .22s;
                background: var(--bg);
                color: var(--dark-light);
                font-size: .72rem;
                gap: 6px;
                position: relative;
                overflow: hidden;
            }

            .img-upload-slot:hover {
                border-color: var(--primary);
                background: var(--primary-light);
                color: var(--primary);
            }

            .img-upload-slot i {
                font-size: 1.3rem;
            }

            .img-upload-slot.filled {
                border-style: solid;
                border-color: var(--border);
            }

            .img-upload-slot .img-preview {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2.5rem;
            }

            .img-upload-slot .img-remove {
                position: absolute;
                top: 4px;
                right: 4px;
                width: 20px;
                height: 20px;
                background: rgba(239, 68, 68, .9);
                border-radius: 50%;
                display: none;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: .6rem;
                cursor: pointer;
            }

            .img-upload-slot.filled:hover .img-remove {
                display: flex;
            }

            .img-primary-badge {
                position: absolute;
                bottom: 4px;
                left: 4px;
                background: var(--primary);
                color: white;
                font-size: .58rem;
                font-weight: 700;
                padding: 1px 5px;
                border-radius: 3px;
            }

            .img-hint {
                font-size: .74rem;
                color: var(--dark-light);
            }

            /* char counter */
            .field-footer {
                display: flex;
                justify-content: space-between;
                margin-top: 4px;
            }

            .char-count {
                font-size: .72rem;
                color: var(--dark-light);
            }

            /* price input with prefix */
            .input-prefix-wrap {
                position: relative;
            }

            .input-prefix {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                padding: 0 12px;
                background: var(--bg);
                border: 1.5px solid var(--border);
                border-right: none;
                border-radius: var(--radius-sm) 0 0 var(--radius-sm);
                display: flex;
                align-items: center;
                font-size: .85rem;
                font-weight: 600;
                color: var(--dark-mid);
                white-space: nowrap;
            }

            .input-prefix+.form-control {
                border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
                padding-left: 14px;
            }

            .input-prefix-wrap .form-control {
                padding-left: 52px;
                border-radius: var(--radius-sm);
            }

            /* tags input */
            .tags-input-wrap {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
                padding: 8px 12px;
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                background: var(--white);
                min-height: 44px;
                cursor: text;
            }

            .tags-input-wrap:focus-within {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(253, 116, 0, .1);
            }

            .tag-chip {
                background: var(--primary-light);
                color: var(--primary);
                padding: 3px 8px;
                border-radius: var(--radius-full);
                font-size: .76rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .tag-chip span {
                cursor: pointer;
                opacity: .7;
            }

            .tag-chip span:hover {
                opacity: 1;
            }

            .tag-chip-input {
                border: none;
                outline: none;
                font-family: var(--font-body);
                font-size: .85rem;
                flex: 1;
                min-width: 80px;
            }

            /* form save bar (sticky bottom) */
            .form-save-bar {
                position: sticky;
                bottom: 0;
                background: var(--white);
                border-top: 1.5px solid var(--border);
                padding: 14px 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                z-index: 100;
                flex-wrap: wrap;
            }

            .form-save-bar-left {
                font-size: .82rem;
                color: var(--dark-light);
            }

            /* ── STORE INFO FORM ── */
            .logo-editor {
                display: flex;
                align-items: center;
                gap: 20px;
                padding: 20px;
                background: var(--bg);
                border-radius: var(--radius-lg);
                border: 1.5px dashed var(--border);
                margin-bottom: 20px;
                flex-wrap: wrap;
            }

            .logo-preview {
                width: 80px;
                height: 80px;
                border-radius: var(--radius-md);
                background: var(--primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                flex-shrink: 0;
                border: 3px solid white;
                box-shadow: var(--shadow-md);
            }

            .logo-editor-info h4 {
                font-size: .95rem;
                margin-bottom: 4px;
            }

            .logo-editor-info p {
                font-size: .78rem;
                color: var(--dark-light);
                margin-bottom: 10px;
            }

            /* banner editor */
            .banner-editor {
                height: 120px;
                border-radius: var(--radius-lg);
                background: linear-gradient(135deg, #FD7400, #ff9944, #2E353D);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                margin-bottom: 10px;
                border: 1.5px dashed rgba(255, 255, 255, .3);
            }

            .banner-editor-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, .4);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: white;
                gap: 4px;
                font-size: .82rem;
                opacity: 0;
                transition: opacity .2s;
            }

            .banner-editor:hover .banner-editor-overlay {
                opacity: 1;
            }

            .banner-editor-overlay i {
                font-size: 1.4rem;
            }

            /* social links */
            .social-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            /* operating hours grid */
            .hours-edit-grid {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .hours-day-row {
                display: grid;
                grid-template-columns: 110px 1fr 20px 1fr 40px;
                gap: 8px;
                align-items: center;
                font-size: .83rem;
            }

            .hours-day-label {
                font-weight: 600;
                color: var(--dark);
            }

            .hours-toggle {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: .75rem;
                color: var(--dark-light);
            }

            /* ── ANALYTICS PANEL ── */
            .chart-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 22px;
                margin-bottom: 20px;
            }

            .chart-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                margin-bottom: 20px;
                gap: 12px;
                flex-wrap: wrap;
            }

            .chart-title {
                font-family: var(--font-display);
                font-size: .95rem;
                font-weight: 700;
            }

            .chart-subtitle {
                font-size: .75rem;
                color: var(--dark-light);
                margin-top: 2px;
            }

            .chart-period {
                display: flex;
                gap: 4px;
            }

            .period-btn {
                padding: 5px 12px;
                border-radius: var(--radius-full);
                font-size: .75rem;
                font-weight: 600;
                cursor: pointer;
                border: 1.5px solid var(--border);
                background: var(--white);
                color: var(--dark-light);
                font-family: var(--font-body);
                transition: all .18s;
            }

            .period-btn.active {
                background: var(--primary);
                border-color: var(--primary);
                color: white;
            }

            /* SVG bar chart */
            .bar-chart-wrap {
                overflow-x: auto;
            }

            .bar-chart {
                display: flex;
                align-items: flex-end;
                gap: 8px;
                height: 160px;
                padding-bottom: 24px;
                position: relative;
                min-width: 500px;
            }

            .bar-chart::before {
                content: '';
                position: absolute;
                bottom: 24px;
                left: 0;
                right: 0;
                border-bottom: 1.5px dashed var(--border);
            }

            .bar-col {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
                flex: 1;
            }

            .bar-wrap {
                flex: 1;
                display: flex;
                align-items: flex-end;
                width: 100%;
            }

            .bar {
                width: 100%;
                border-radius: 5px 5px 0 0;
                background: var(--primary-light);
                transition: background .18s, height .4s ease;
                cursor: pointer;
                position: relative;
            }

            .bar.highlight {
                background: var(--primary);
            }

            .bar:hover {
                background: var(--primary-dark);
            }

            .bar-tip {
                position: absolute;
                bottom: calc(100% + 6px);
                left: 50%;
                transform: translateX(-50%);
                background: var(--dark);
                color: white;
                padding: 3px 7px;
                border-radius: 5px;
                font-size: .7rem;
                white-space: nowrap;
                opacity: 0;
                pointer-events: none;
                transition: opacity .18s;
            }

            .bar:hover .bar-tip {
                opacity: 1;
            }

            .bar-label {
                font-size: .68rem;
                color: var(--dark-light);
                white-space: nowrap;
            }

            /* Top products list */
            .top-prod-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 0;
                border-bottom: 1px solid var(--border);
            }

            .top-prod-item:last-child {
                border-bottom: none;
            }

            .top-prod-rank {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: var(--bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: .72rem;
                font-weight: 700;
                color: var(--dark-light);
                flex-shrink: 0;
            }

            .top-prod-rank.gold {
                background: #fef3c7;
                color: #92400e;
            }

            .top-prod-rank.silver {
                background: #f1f5f9;
                color: #475569;
            }

            .top-prod-rank.bronze {
                background: #fef0e6;
                color: #b45309;
            }

            .top-prod-thumb {
                width: 38px;
                height: 38px;
                border-radius: var(--radius-sm);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                flex-shrink: 0;
                border: 1px solid var(--border);
            }

            .top-prod-name {
                flex: 1;
                font-size: .85rem;
                font-weight: 600;
                color: var(--dark);
            }

            .top-prod-views {
                font-size: .78rem;
                color: var(--dark-light);
            }

            .top-prod-bar-wrap {
                width: 80px;
                height: 6px;
                background: var(--border);
                border-radius: 3px;
                overflow: hidden;
                margin-top: 3px;
            }

            .top-prod-bar {
                height: 100%;
                background: var(--primary);
                border-radius: 3px;
            }

            /* ── TOAST ── */
            .toast-wrap {
                position: fixed;
                bottom: 24px;
                right: 24px;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .toast {
                background: var(--dark);
                color: white;
                padding: 13px 18px;
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

            .toast.error {
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

            /* ── DELETE CONFIRM MODAL ── */
            .modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(46, 53, 61, .5);
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

            .modal-icon {
                font-size: 2.8rem;
                margin-bottom: 12px;
            }

            .modal-box h3 {
                margin-bottom: 8px;
            }

            .modal-box p {
                font-size: .88rem;
                color: var(--dark-mid);
                margin-bottom: 24px;
            }

            .modal-actions {
                display: flex;
                gap: 10px;
            }

            /* responsive */
            @media (max-width: 1024px) {
                .stat-row {
                    grid-template-columns: repeat(2, 1fr);
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

                .form-grid-2,
                .form-grid-3 {
                    grid-template-columns: 1fr;
                }

                .img-upload-grid {
                    grid-template-columns: repeat(3, 1fr);
                }

                .stat-row {
                    grid-template-columns: 1fr 1fr;
                }

                .hours-day-row {
                    grid-template-columns: 90px 1fr 16px 1fr 36px;
                }
            }
        </style>
    </head>

    <body>

        <!-- ═══ NAVBAR ═══ -->
        @include('layouts.partials.navbar')

        <!-- ═══ STORE TOPBAR HEADER ═══ -->
        <div class="store-topbar-header">
            <div class="container">
                <div class="store-topbar-inner">
                    <div class="store-topbar-id">
                        <div class="store-topbar-logo">🍱</div>
                        <div>
                            <div class="store-topbar-name">Dapur Bu Sari</div>
                            <div class="store-topbar-sub">
                                <span><i class="fa-solid fa-circle" style="color:#22c55e;font-size:.45rem;"></i> Toko
                                    Aktif</span>
                                <span class="dot-sep"></span>
                                <span><i class="fa-solid fa-location-dot fa-xs"></i> Semarang Tengah</span>
                                <span class="dot-sep"></span>
                                <span>48 Produk</span>
                            </div>
                        </div>
                    </div>
                    <div class="store-topbar-actions">
                        <a href="store-profile.html" class="btn btn-ghost btn-sm"
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
            <!-- secondary nav -->
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

        <!-- ═══ MAIN CONTENT ═══ -->
        <div class="container">
            <div class="manage-layout">

                <!-- ── SIDEBAR ── -->
                <aside class="manage-sidebar">
                    <div class="side-card">
                        <div class="side-nav-item active" data-panel="ringkasan" onclick="showPanel('ringkasan',this)">
                            <i class="fa-solid fa-house-chimney"></i> Ringkasan</div>
                        <div class="side-nav-item" data-panel="produk-saya" onclick="showPanel('produk-saya',this)"><i
                                class="fa-solid fa-box"></i> Kelola Produk <span class="badge badge-primary"
                                style="margin-left:auto;font-size:.65rem;padding:1px 6px;">48</span></div>
                        <div class="side-nav-item" data-panel="tambah-produk" onclick="showPanel('tambah-produk',this)">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Produk</div>
                        <div class="side-sep"></div>
                        <div class="side-nav-item" data-panel="analitik" onclick="showPanel('analitik',this)"><i
                                class="fa-solid fa-chart-line"></i> Analitik</div>
                        <div class="side-sep"></div>
                        <div class="side-nav-item" data-panel="info-toko" onclick="showPanel('info-toko',this)"><i
                                class="fa-solid fa-store"></i> Info Toko</div>
                        <div class="side-sep"></div>
                        <div class="side-nav-item danger" onclick="confirmDeactivate()"><i
                                class="fa-solid fa-power-off"></i> Nonaktifkan Toko</div>
                    </div>

                    <!-- Store health widget -->
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

                <!-- ── PANELS ── -->
                <main>

                    <!-- ■ RINGKASAN ■ -->
                    <div class="panel active" id="panel-ringkasan">

                        <!-- Stats -->
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
                                <div style="display:flex;gap:2px;margin-top:8px;">★★★★★</div>
                            </div>
                        </div>

                        <!-- Quick actions -->
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
                                <a href="store-profile.html" class="btn btn-outline w-full">
                                    <i class="fa-solid fa-eye"></i> Preview Publik
                                </a>
                                <button class="btn btn-ghost w-full" style="border:1.5px solid var(--border);"
                                    onclick="copyWALink()">
                                    <i class="fa-solid fa-share-nodes"></i> Bagikan Toko
                                </button>
                            </div>
                        </div>

                        <!-- Recent products -->
                        <div class="info-card">
                            <div class="info-card-title">
                                <span><i class="fa-solid fa-clock-rotate-left"></i> Produk Terbaru</span>
                                <a onclick="showPanel('produk-saya'); setActive(document.querySelector('[data-panel=produk-saya]'))"
                                    style="font-size:.8rem;color:var(--primary);font-weight:600;cursor:pointer;">Lihat
                                    Semua →</a>
                            </div>
                            <div id="recent-prods"></div>
                        </div>

                        <!-- Tips & alerts -->
                        <div class="info-card"
                            style="border-color:rgba(253,116,0,.25);background:var(--primary-light);">
                            <div style="display:flex;gap:12px;align-items:flex-start;">
                                <div style="font-size:1.5rem;flex-shrink:0;">💡</div>
                                <div>
                                    <div
                                        style="font-family:var(--font-display);font-weight:700;font-size:.92rem;color:var(--dark);margin-bottom:4px;">
                                        Tips: Tingkatkan Visibilitas Toko</div>
                                    <p style="font-size:.82rem;line-height:1.7;">Tambahkan foto banner toko untuk
                                        meningkatkan kepercayaan pembeli hingga <strong>40%</strong>. Upload banner
                                        sekarang!</p>
                                    <button class="btn btn-primary btn-sm" style="margin-top:10px;"
                                        onclick="showPanel('info-toko'); setActive(document.querySelector('[data-panel=info-toko]'))">
                                        Upload Banner <i class="fa-solid fa-arrow-right fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ■ PRODUK SAYA ■ -->
                    <div class="panel" id="panel-produk-saya">
                        <div class="sec-title-row">
                            <h3>Kelola Produk <span style="font-size:.8rem;color:var(--dark-light);font-weight:400;">(48
                                    produk)</span></h3>
                            <button class="btn btn-primary btn-sm"
                                onclick="showPanel('tambah-produk'); setActive(document.querySelector('[data-panel=tambah-produk]'))">
                                <i class="fa-solid fa-plus"></i> Tambah Produk
                            </button>
                        </div>

                        <!-- Filters -->
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

                        <!-- Bulk action bar (shown when checkboxes selected) -->
                        <div class="bulk-bar" id="bulk-bar">
                            <span><strong id="bulk-count">0</strong> produk dipilih</span>
                            <button class="btn btn-sm" style="background:rgba(255,255,255,.15);color:white;border:none;"
                                onclick="bulkToggleFeatured()">⭐ Toggle Unggulan</button>
                            <button class="btn btn-sm" style="background:rgba(239,68,68,.8);color:white;border:none;"
                                onclick="openDeleteModal('bulk')">
                                <i class="fa-solid fa-trash fa-xs"></i> Hapus Dipilih
                            </button>
                            <button class="btn btn-sm btn-ghost" style="color:rgba(255,255,255,.6);margin-left:auto;"
                                onclick="clearBulk()">Batal</button>
                        </div>

                        <!-- Product table -->
                        <div class="prod-table-wrap">
                            <table class="prod-table" id="prod-table">
                                <thead>
                                    <tr>
                                        <th style="width:40px;"><input type="checkbox" id="check-all"
                                                onchange="toggleAllCheck(this)" style="accent-color:var(--primary);">
                                        </th>
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
                        <div style="display:flex;justify-content:center;margin-top:20px;">
                            <div class="pagination">
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                            </div>
                        </div>
                    </div>

                    <!-- ■ TAMBAH / EDIT PRODUK ■ -->
                    <div class="panel" id="panel-tambah-produk">
                        <div class="sec-title-row">
                            <h3 id="form-prod-title">Tambah Produk Baru</h3>
                            <div style="display:flex;gap:8px;">
                                <button class="btn btn-ghost btn-sm" onclick="resetProdForm()"><i
                                        class="fa-solid fa-rotate-left fa-xs"></i> Reset</button>
                            </div>
                        </div>

                        <!-- FOTO PRODUK -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-images"></i> Foto Produk</div>
                            <div class="img-upload-grid" id="img-upload-grid">
                                <div class="img-upload-slot" id="slot-0" onclick="triggerUpload(0)">
                                    <i class="fa-solid fa-camera-retro"></i>
                                    <span>Foto Utama</span>
                                    <div class="img-remove" onclick="removeImg(event,0)"><i
                                            class="fa-solid fa-xmark"></i></div>
                                </div>
                                <div class="img-upload-slot" id="slot-1" onclick="triggerUpload(1)">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Foto 2</span>
                                    <div class="img-remove" onclick="removeImg(event,1)"><i
                                            class="fa-solid fa-xmark"></i></div>
                                </div>
                                <div class="img-upload-slot" id="slot-2" onclick="triggerUpload(2)">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Foto 3</span>
                                    <div class="img-remove" onclick="removeImg(event,2)"><i
                                            class="fa-solid fa-xmark"></i></div>
                                </div>
                                <div class="img-upload-slot" id="slot-3" onclick="triggerUpload(3)">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Foto 4</span>
                                    <div class="img-remove" onclick="removeImg(event,3)"><i
                                            class="fa-solid fa-xmark"></i></div>
                                </div>
                            </div>
                            <p class="img-hint"><i class="fa-solid fa-circle-info fa-xs"></i> Foto pertama akan menjadi
                                foto utama. Gunakan foto beresolusi tinggi (min. 800×800px). Maks. 4 foto, 5MB/foto.</p>
                        </div>

                        <!-- INFO DASAR -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-file-lines"></i> Informasi Dasar</div>
                            <div class="form-group">
                                <label class="form-label">Nama Produk <span>*</span></label>
                                <input class="form-control" id="prod-name"
                                    placeholder="Contoh: Nastar Keju Premium 500gr" maxlength="150"
                                    oninput="updateChar(this,'name-count',150)">
                                <div class="field-footer"><span class="form-hint">Sertakan ukuran/varian untuk
                                        memperjelas</span><span class="char-count"><span
                                            id="name-count">0</span>/150</span></div>
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Kategori <span>*</span></label>
                                    <select class="form-control" id="prod-cat">
                                        <option value="">— Pilih Kategori —</option>
                                        <option value="kuliner">🍱 Kuliner & Makanan</option>
                                        <option value="fashion">👗 Fashion & Batik</option>
                                        <option value="kerajinan">🎨 Kerajinan Tangan</option>
                                        <option value="pertanian">🌿 Pertanian & Herbal</option>
                                        <option value="kecantikan">💆 Kecantikan & Perawatan</option>
                                        <option value="dekorasi">🪴 Dekorasi & Tanaman</option>
                                        <option value="lainnya">📦 Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slug URL <span>*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-link input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" id="prod-slug"
                                            placeholder="nastar-keju-premium-500gr">
                                    </div>
                                    <span class="form-hint">Diisi otomatis dari nama produk</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi Produk <span>*</span></label>
                                <textarea class="form-control" id="prod-desc" rows="5" maxlength="2000"
                                    oninput="updateChar(this,'desc-count',2000)"
                                    placeholder="Jelaskan produkmu secara detail: bahan, ukuran, keunggulan, cara penggunaan, dll."></textarea>
                                <div class="field-footer"><span class="form-hint">Min. 50 karakter</span><span
                                        class="char-count"><span id="desc-count">0</span>/2000</span></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tag / Kata Kunci</label>
                                <div class="tags-input-wrap" id="tags-wrap"
                                    onclick="document.getElementById('tag-input').focus()">
                                    <div class="tag-chip">kue kering <span onclick="removeTag(this)">✕</span></div>
                                    <div class="tag-chip">nastar <span onclick="removeTag(this)">✕</span></div>
                                    <div class="tag-chip">lebaran <span onclick="removeTag(this)">✕</span></div>
                                    <input class="tag-chip-input" id="tag-input"
                                        placeholder="Tambah tag, tekan Enter..." onkeydown="addTag(event)">
                                </div>
                                <span class="form-hint">Tekan Enter atau koma untuk menambah tag. Maks. 10 tag.</span>
                            </div>
                        </div>

                        <!-- HARGA & STOK -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-tag"></i> Harga & Stok</div>
                            <div class="form-grid-3">
                                <div class="form-group">
                                    <label class="form-label">Harga Jual <span>*</span></label>
                                    <div class="input-prefix-wrap">
                                        <div class="input-prefix">Rp</div>
                                        <input class="form-control" id="prod-price" type="number" placeholder="65000"
                                            min="0" oninput="formatPrice(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Harga Coret <span
                                            style="color:var(--dark-light);font-weight:400;">(opsional)</span></label>
                                    <div class="input-prefix-wrap">
                                        <div class="input-prefix">Rp</div>
                                        <input class="form-control" id="prod-price-ori" type="number"
                                            placeholder="75000" min="0">
                                    </div>
                                    <span class="form-hint">Harga sebelum diskon</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Satuan</label>
                                    <select class="form-control" id="prod-unit">
                                        <option>pcs / buah</option>
                                        <option>toples</option>
                                        <option>lusin</option>
                                        <option>kg</option>
                                        <option>gram</option>
                                        <option>liter</option>
                                        <option>ml</option>
                                        <option>paket</option>
                                        <option>meter</option>
                                        <option>lembar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-grid-2" style="margin-top:4px;">
                                <div class="form-group">
                                    <label class="form-label">Minimum Pemesanan</label>
                                    <input class="form-control" type="number" id="prod-moq" value="1" min="1">
                                    <span class="form-hint">Contoh: 1 = minimal pesan 1 pcs</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Stok Tersedia</label>
                                    <select class="form-control" id="prod-stock">
                                        <option value="available">✅ Tersedia (Ready Stock)</option>
                                        <option value="preorder">🕐 Pre-Order</option>
                                        <option value="limited">⚠️ Stok Terbatas</option>
                                        <option value="empty">❌ Habis</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- PENGIRIMAN -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-truck"></i> Detail Pengiriman</div>
                            <div class="form-grid-3">
                                <div class="form-group">
                                    <label class="form-label">Berat Produk (gram)</label>
                                    <input class="form-control" type="number" id="prod-weight" placeholder="500"
                                        min="1">
                                    <span class="form-hint">Termasuk kemasan</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Panjang (cm)</label>
                                    <input class="form-control" type="number" placeholder="15" min="1">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lebar × Tinggi (cm)</label>
                                    <div style="display:flex;gap:8px;">
                                        <input class="form-control" type="number" placeholder="15" min="1">
                                        <input class="form-control" type="number" placeholder="10" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Catatan Pengiriman</label>
                                <textarea class="form-control" rows="2"
                                    placeholder="Contoh: Produk dikemas vakum, tahan 3 bulan. COD tersedia area Semarang."></textarea>
                            </div>
                        </div>

                        <!-- VISIBILITAS -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-eye"></i> Visibilitas & Status</div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Status Produk</label>
                                    <select class="form-control" id="prod-status">
                                        <option value="active">✅ Aktif — Tampil di katalog</option>
                                        <option value="draft">📝 Draft — Belum ditampilkan</option>
                                        <option value="archived">📦 Diarsipkan</option>
                                    </select>
                                </div>
                                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                                    <label
                                        style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:.87rem;font-weight:600;color:var(--dark);">
                                        <input type="checkbox" id="prod-featured"
                                            style="accent-color:var(--primary);width:16px;height:16px;">
                                        ⭐ Tandai sebagai Produk Unggulan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- SAVE BAR -->
                        <div class="form-save-bar">
                            <div class="form-save-bar-left"><i class="fa-solid fa-circle-info fa-xs"
                                    style="color:var(--primary);"></i> Pastikan semua kolom wajib (<span
                                    style="color:var(--primary);">*</span>) sudah diisi sebelum menyimpan.</div>
                            <div style="display:flex;gap:10px;">
                                <button class="btn btn-ghost btn-sm" onclick="saveDraft()"><i
                                        class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Draft</button>
                                <button class="btn btn-primary" onclick="publishProduct()"><i
                                        class="fa-solid fa-rocket fa-xs"></i> Simpan & Publikasikan</button>
                            </div>
                        </div>
                    </div>

                    <!-- ■ ANALITIK ■ -->
                    <div class="panel" id="panel-analitik">
                        <div class="sec-title-row">
                            <h3>Analitik Toko</h3>
                            <div style="display:flex;gap:6px;">
                                <select class="form-control" style="width:140px;padding:8px 12px;font-size:.82rem;">
                                    <option>Juni 2026</option>
                                    <option>Mei 2026</option>
                                    <option>April 2026</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mini stats -->
                        <div class="stat-row" style="margin-bottom:20px;">
                            <div class="stat-card" style="border-top:3px solid var(--primary);">
                                <div class="stat-card-label">Chat WA Bulan Ini</div>
                                <div class="stat-card-num" style="font-size:1.5rem;">87</div>
                                <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                    +18% vs Mei</div>
                            </div>
                            <div class="stat-card" style="border-top:3px solid #3b82f6;">
                                <div class="stat-card-label">Total Tayangan</div>
                                <div class="stat-card-num" style="font-size:1.5rem;">412</div>
                                <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                    +32%</div>
                            </div>
                            <div class="stat-card" style="border-top:3px solid #10b981;">
                                <div class="stat-card-label">Konversi WA</div>
                                <div class="stat-card-num" style="font-size:1.5rem;">21%</div>
                                <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                    +4% poin</div>
                            </div>
                            <div class="stat-card" style="border-top:3px solid #fbbf24;">
                                <div class="stat-card-label">Wishlist Ditambah</div>
                                <div class="stat-card-num" style="font-size:1.5rem;">56</div>
                                <div class="stat-card-change change-up"><i class="fa-solid fa-arrow-trend-up fa-xs"></i>
                                    +11</div>
                            </div>
                        </div>

                        <!-- Bar chart: Chat WA per hari -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Chat WhatsApp Masuk</div>
                                    <div class="chart-subtitle">14 hari terakhir</div>
                                </div>
                                <div class="chart-period">
                                    <button class="period-btn active">14 Hari</button>
                                    <button class="period-btn">30 Hari</button>
                                    <button class="period-btn">90 Hari</button>
                                </div>
                            </div>
                            <div class="bar-chart-wrap">
                                <div class="bar-chart" id="wa-chart"></div>
                            </div>
                        </div>

                        <!-- Views chart -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Tayangan Produk</div>
                                    <div class="chart-subtitle">14 hari terakhir</div>
                                </div>
                                <div class="chart-period">
                                    <button class="period-btn active">14 Hari</button>
                                    <button class="period-btn">30 Hari</button>
                                </div>
                            </div>
                            <div class="bar-chart-wrap">
                                <div class="bar-chart" id="views-chart"></div>
                            </div>
                        </div>

                        <!-- Top 5 products -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">Produk Paling Banyak Dilihat</div>
                            </div>
                            <div id="top-prods-list"></div>
                        </div>
                    </div>

                    <!-- ■ INFO TOKO ■ -->
                    <div class="panel" id="panel-info-toko">
                        <div class="sec-title-row">
                            <h3>Pengaturan Info Toko</h3>
                        </div>

                        <!-- Logo & Banner -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-image"></i> Logo & Banner Toko</div>
                            <div class="logo-editor">
                                <div class="logo-preview">🍱</div>
                                <div class="logo-editor-info">
                                    <h4>Logo Toko</h4>
                                    <p>Format JPG/PNG/WebP · Maks. 2MB · Rekomendasi 300×300px</p>
                                    <div style="display:flex;gap:8px;">
                                        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-upload fa-xs"></i>
                                            Upload Logo</button>
                                        <button class="btn btn-ghost btn-sm"
                                            style="border:1.5px solid var(--border);">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            <label
                                style="font-size:.82rem;font-weight:700;color:var(--dark);display:block;margin-bottom:8px;">Banner
                                Toko</label>
                            <div class="banner-editor">
                                <div class="banner-editor-overlay"><i class="fa-solid fa-camera fa-lg"></i><span>Klik
                                        untuk upload banner</span></div>
                            </div>
                            <p class="img-hint"><i class="fa-solid fa-circle-info fa-xs"></i> Rekomendasi banner:
                                1200×300px (rasio 4:1). Format JPG/PNG.</p>
                        </div>

                        <!-- Informasi Toko -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-circle-info"></i> Informasi Utama Toko
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Toko <span>*</span></label>
                                <input class="form-control" value="Dapur Bu Sari" maxlength="100"
                                    oninput="updateChar(this,'shop-name-count',100)">
                                <div class="field-footer"><span></span><span class="char-count"><span
                                            id="shop-name-count">14</span>/100</span></div>
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Slug Toko <span>*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-at input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" value="dapur-bu-sari" placeholder="nama-toko-kamu">
                                    </div>
                                    <span class="form-hint">pasarlokal.id/toko/<strong>dapur-bu-sari</strong></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori Utama <span>*</span></label>
                                    <select class="form-control">
                                        <option selected>🍱 Kuliner & Makanan</option>
                                        <option>👗 Fashion & Batik</option>
                                        <option>🎨 Kerajinan Tangan</option>
                                        <option>🌿 Pertanian & Herbal</option>
                                        <option>💆 Kecantikan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi Toko <span>*</span></label>
                                <textarea class="form-control" rows="4" maxlength="500"
                                    oninput="updateChar(this,'shop-desc-count',500)">Spesialis kue kering premium homemade. Nastar, kastengel, putri salju, dan hampers lebaran terbaik. Dibuat tanpa pengawet, kemasan higienis, bersertifikat PIRT.</textarea>
                                <div class="field-footer"><span class="form-hint">Deskripsi ditampilkan di halaman toko
                                        publik</span><span class="char-count"><span
                                            id="shop-desc-count">170</span>/500</span></div>
                            </div>
                        </div>

                        <!-- Kontak & Lokasi -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-location-dot"></i> Kontak & Lokasi
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label">Nomor WhatsApp Business <span>*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-brands fa-whatsapp input-icon" style="color:#25D366;"></i>
                                        <input class="form-control" value="081234567890" type="tel">
                                    </div>
                                    <span class="form-hint">Nomor ini yang akan dihubungi pembeli</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kabupaten / Kota <span>*</span></label>
                                    <select class="form-control">
                                        <option selected>Kota Semarang</option>
                                        <option>Kab. Semarang</option>
                                        <option>Kota Solo</option>
                                        <option>Kota Yogyakarta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat Lengkap <span>*</span></label>
                                <textarea class="form-control"
                                    rows="2">Jl. Pemuda No. 12, RT 03/RW 05, Semarang Tengah, Kota Semarang, Jawa Tengah 50132</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kecamatan</label>
                                <input class="form-control" value="Semarang Tengah">
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-clock"></i> Jam Operasional</div>
                            <div class="hours-edit-grid" id="hours-grid"></div>
                        </div>

                        <!-- Media Sosial -->
                        <div class="info-card">
                            <div class="form-section-title"><i class="fa-solid fa-share-nodes"></i> Media Sosial &
                                Tautan</div>
                            <div class="social-row">
                                <div class="form-group">
                                    <label class="form-label"><i class="fa-brands fa-instagram"
                                            style="color:#e1306c;"></i> Instagram</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-at input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" placeholder="username_instagram">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><i class="fa-brands fa-facebook"
                                            style="color:#1877f2;"></i> Facebook</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-at input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" placeholder="nama_halaman_facebook">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><i class="fa-brands fa-tiktok"></i> TikTok</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-at input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" placeholder="username_tiktok">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><i class="fa-solid fa-globe"></i> Website</label>
                                    <div class="input-icon-wrap">
                                        <i class="fa-solid fa-link input-icon" style="font-size:.75rem;"></i>
                                        <input class="form-control" placeholder="https://websitesaya.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Save bar -->
                        <div class="form-save-bar">
                            <div class="form-save-bar-left"><i class="fa-solid fa-circle-info fa-xs"
                                    style="color:var(--primary);"></i> Perubahan info toko akan ditinjau admin dalam
                                1×24 jam.</div>
                            <div style="display:flex;gap:10px;">
                                <button class="btn btn-ghost btn-sm">Batal</button>
                                <button class="btn btn-primary" onclick="saveShopInfo()"><i
                                        class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Info Toko</button>
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>

        <!-- ── DELETE CONFIRM MODAL ── -->
        <div class="modal-overlay" id="delete-modal">
            <div class="modal-box">
                <div class="modal-icon">🗑️</div>
                <h3>Hapus Produk?</h3>
                <p id="delete-modal-text">Produk ini akan dihapus permanen dari tokomu dan tidak dapat dikembalikan.</p>
                <div class="modal-actions">
                    <button class="btn btn-ghost w-full" onclick="closeDeleteModal()">Batal</button>
                    <button class="btn w-full" style="background:var(--danger);color:white;"
                        onclick="confirmDelete()">Ya, Hapus</button>
                </div>
            </div>
        </div>

        <!-- ── TOAST WRAP ── -->
        <div class="toast-wrap" id="toast-wrap"></div>

        <script>
            /* ========================================
   STATE & DATA
======================================== */
let currentDeleteTarget = null;
let selectedProds = new Set();

const PRODUCTS = [
  {id:1, e:'🍪', bg:'#fef3c7', name:'Nastar Keju Premium 500gr',       slug:'nastar-keju-premium-500gr',     cat:'Kue Kering', price:65000,  views:1240, featured:true,  status:'active'},
  {id:2, e:'🎁', bg:'#fee2e2', name:'Hampers Lebaran Set 5 Toples',    slug:'hampers-lebaran-set-5-toples',  cat:'Hampers',    price:250000, views:860,  featured:true,  status:'active'},
  {id:3, e:'🧁', bg:'#fce7f3', name:'Putri Salju Kacang 400gr',        slug:'putri-salju-kacang-400gr',      cat:'Kue Kering', price:55000,  views:742,  featured:false, status:'active'},
  {id:4, e:'🍘', bg:'#f0fdf4', name:'Kastengel Keju Edam 400gr',       slug:'kastengel-keju-edam-400gr',     cat:'Kue Kering', price:72000,  views:620,  featured:false, status:'active'},
  {id:5, e:'🍩', bg:'#fffbeb', name:'Kue Semprit Susu Klasik 500gr',   slug:'kue-semprit-susu-klasik-500gr', cat:'Kue Kering', price:58000,  views:508,  featured:false, status:'active'},
  {id:6, e:'🫐', bg:'#ede9fe', name:'Kue Lidah Kucing Lembut 300gr',   slug:'kue-lidah-kucing-lembut-300gr', cat:'Kue Kering', price:48000,  views:490,  featured:false, status:'draft'},
  {id:7, e:'🍰', bg:'#dbeafe', name:'Bolu Kukus Pandan Premium',       slug:'bolu-kukus-pandan-premium',     cat:'Basah',      price:35000,  views:380,  featured:false, status:'active'},
  {id:8, e:'🎀', bg:'#fce7f3', name:'Hampers Ulang Tahun Custom',      slug:'hampers-ulang-tahun-custom',    cat:'Hampers',    price:185000, views:295,  featured:false, status:'active'},
];

/* ========================================
   PANEL SWITCH
======================================== */
function showPanel(id, el) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  document.getElementById('panel-' + id).classList.add('active');
  if (el) setActive(el);
}
function setActive(el) {
  if (!el) return;
  const isSecTab = el.classList.contains('sec-tab');
  const isSideItem = el.classList.contains('side-nav-item');
  if (isSecTab) { document.querySelectorAll('.sec-tab').forEach(t => t.classList.remove('active')); el.classList.add('active'); }
  if (isSideItem) { document.querySelectorAll('.side-nav-item').forEach(t => t.classList.remove('active')); el.classList.add('active'); }
}

/* ========================================
   PRODUCT TABLE
======================================== */
function renderTable(data) {
  const tbody = document.getElementById('prod-tbody');
  tbody.innerHTML = data.map(p => `
    <tr id="row-${p.id}">
      <td><input type="checkbox" class="prod-check" style="accent-color:var(--primary);" onchange="toggleCheck(${p.id},this)"></td>
      <td>
        <div class="prod-name-cell">
          <div class="prod-thumb" style="background:${p.bg};">${p.e}</div>
          <div>
            <div class="prod-name-text">${p.name}</div>
            <div class="prod-slug">${p.slug}</div>
          </div>
        </div>
      </td>
      <td class="price-cell">Rp ${p.price.toLocaleString('id-ID')}</td>
      <td><span class="badge badge-dark" style="font-size:.7rem;">${p.cat}</span></td>
      <td class="views-cell"><i class="fa-regular fa-eye fa-xs"></i> ${p.views.toLocaleString('id-ID')}</td>
      <td>
        <div class="feat-toggle">
          <i class="fa-solid fa-star star-toggle ${p.featured ? 'on':''}" onclick="toggleFeatured(${p.id},this)" title="${p.featured?'Hapus dari unggulan':'Jadikan unggulan'}"></i>
        </div>
      </td>
      <td>
        <span class="badge ${p.status==='active'?'badge-success':p.status==='draft'?'badge-warning':'badge-dark'}" style="font-size:.7rem;">
          ${p.status==='active'?'Aktif':p.status==='draft'?'Draft':'Arsip'}
        </span>
      </td>
      <td>
        <div class="action-btns" style="justify-content:center;">
          <div class="icon-btn" onclick="editProduct(${p.id})" title="Edit"><i class="fa-solid fa-pen fa-xs"></i></div>
          <div class="icon-btn" onclick="location.href='product-detail.html'" title="Preview"><i class="fa-solid fa-eye fa-xs"></i></div>
          <div class="icon-btn del" onclick="openDeleteModal(${p.id})" title="Hapus"><i class="fa-solid fa-trash fa-xs"></i></div>
        </div>
      </td>
    </tr>
  `).join('');
}
renderTable(PRODUCTS);

// Recent products (ringkasan)
document.getElementById('recent-prods').innerHTML = PRODUCTS.slice(0,4).map(p => `
  <div class="top-prod-item">
    <div class="top-prod-thumb" style="background:${p.bg};">${p.e}</div>
    <div style="flex:1;">
      <div class="top-prod-name">${p.name}</div>
      <div style="font-size:.72rem;color:var(--dark-light);">Rp ${p.price.toLocaleString('id-ID')} · ${p.cat}</div>
    </div>
    <span class="badge ${p.status==='active'?'badge-success':'badge-warning'}" style="font-size:.68rem;">${p.status==='active'?'Aktif':'Draft'}</span>
    <div class="icon-btn" onclick="editProduct(${p.id})" title="Edit" style="margin-left:4px;"><i class="fa-solid fa-pen fa-xs"></i></div>
  </div>
`).join('');

function filterProds(q) {
  const filtered = PRODUCTS.filter(p => p.name.toLowerCase().includes(q.toLowerCase()));
  renderTable(filtered);
}
function filterByStatus(s) {
  const filtered = s === 'featured' ? PRODUCTS.filter(p => p.featured) : s === 'active' ? PRODUCTS.filter(p => p.status === 'active') : PRODUCTS;
  renderTable(filtered);
}

/* ========================================
   FEATURED TOGGLE
======================================== */
function toggleFeatured(id, el) {
  const prod = PRODUCTS.find(p => p.id === id);
  if (!prod) return;
  prod.featured = !prod.featured;
  el.classList.toggle('on', prod.featured);
  toast(prod.featured ? `⭐ "${prod.name}" dijadikan produk unggulan` : `"${prod.name}" dihapus dari unggulan`);
}

/* ========================================
   BULK SELECTION
======================================== */
function toggleCheck(id, el) {
  el.checked ? selectedProds.add(id) : selectedProds.delete(id);
  updateBulkBar();
}
function toggleAllCheck(masterEl) {
  document.querySelectorAll('.prod-check').forEach(c => {
    c.checked = masterEl.checked;
    const id = parseInt(c.closest('tr').id.replace('row-',''));
    masterEl.checked ? selectedProds.add(id) : selectedProds.delete(id);
  });
  updateBulkBar();
}
function updateBulkBar() {
  const bar = document.getElementById('bulk-bar');
  bar.classList.toggle('show', selectedProds.size > 0);
  document.getElementById('bulk-count').textContent = selectedProds.size;
}
function clearBulk() {
  selectedProds.clear();
  document.querySelectorAll('.prod-check').forEach(c => c.checked = false);
  document.getElementById('check-all').checked = false;
  updateBulkBar();
}
function bulkToggleFeatured() { toast('⭐ Status unggulan ' + selectedProds.size + ' produk diperbarui'); clearBulk(); }

/* ========================================
   DELETE MODAL
======================================== */
function openDeleteModal(id) {
  currentDeleteTarget = id;
  const text = id === 'bulk'
    ? `${selectedProds.size} produk yang dipilih akan dihapus permanen.`
    : `Produk "${PRODUCTS.find(p=>p.id===id)?.name}" akan dihapus permanen.`;
  document.getElementById('delete-modal-text').textContent = text;
  document.getElementById('delete-modal').classList.add('show');
}
function closeDeleteModal() { document.getElementById('delete-modal').classList.remove('show'); currentDeleteTarget = null; }
function confirmDelete() {
  toast('<i class="fa-solid fa-check"></i> Produk berhasil dihapus', 'success');
  closeDeleteModal(); clearBulk();
}

/* ========================================
   EDIT PRODUCT
======================================== */
function editProduct(id) {
  const prod = PRODUCTS.find(p => p.id === id);
  if (!prod) return;
  document.getElementById('form-prod-title').textContent = 'Edit Produk: ' + prod.name;
  document.getElementById('prod-name').value = prod.name;
  document.getElementById('prod-slug').value = prod.slug;
  document.getElementById('prod-price').value = prod.price;
  document.getElementById('prod-featured').checked = prod.featured;
  showPanel('tambah-produk');
  setActive(document.querySelector('[data-panel=tambah-produk]'));
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ========================================
   PRODUCT FORM
======================================== */
document.getElementById('prod-name').addEventListener('input', function () {
  const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').trim();
  document.getElementById('prod-slug').value = slug;
});

function updateChar(el, countId, max) {
  document.getElementById(countId).textContent = el.value.length;
}

function addTag(e) {
  if (e.key !== 'Enter' && e.key !== ',') return;
  e.preventDefault();
  const input = document.getElementById('tag-input');
  const val = input.value.replace(',','').trim();
  if (!val) return;
  const wrap = document.getElementById('tags-wrap');
  const chips = wrap.querySelectorAll('.tag-chip');
  if (chips.length >= 10) { toast('Maksimal 10 tag', 'error'); return; }
  const chip = document.createElement('div');
  chip.className = 'tag-chip';
  chip.innerHTML = `${val} <span onclick="removeTag(this)">✕</span>`;
  wrap.insertBefore(chip, input);
  input.value = '';
}
function removeTag(el) { el.parentElement.remove(); }

// Emoji image upload simulation
const EMOJIS = ['🍕','🍰','🧁','🍩','🎂','🧆','🍜','🫙','🎁','🧺'];
function triggerUpload(idx) {
  const slot = document.getElementById('slot-' + idx);
  const emoji = EMOJIS[Math.floor(Math.random() * EMOJIS.length)];
  slot.classList.add('filled');
  slot.innerHTML = `
    <div class="img-preview">${emoji}</div>
    ${idx === 0 ? '<div class="img-primary-badge">Utama</div>' : ''}
    <div class="img-remove" onclick="removeImg(event,${idx})"><i class="fa-solid fa-xmark"></i></div>
  `;
}
function removeImg(e, idx) {
  e.stopPropagation();
  const slot = document.getElementById('slot-' + idx);
  slot.classList.remove('filled');
  slot.innerHTML = `<i class="fa-solid fa-${idx===0?'camera-retro':'plus'}"></i><span>${idx===0?'Foto Utama':'Foto '+(idx+1)}</span><div class="img-remove" onclick="removeImg(event,${idx})"><i class="fa-solid fa-xmark"></i></div>`;
}

function saveDraft() { toast('📝 Produk disimpan sebagai draft'); }
function publishProduct() {
  const name = document.getElementById('prod-name').value.trim();
  const cat  = document.getElementById('prod-cat').value;
  const price= document.getElementById('prod-price').value;
  const desc = document.getElementById('prod-desc').value.trim();
  if (!name || !cat || !price || desc.length < 50) {
    toast('⚠️ Lengkapi semua kolom wajib (nama, kategori, harga, deskripsi min. 50 karakter)', 'error'); return;
  }
  toast('🚀 Produk berhasil dipublikasikan!');
  resetProdForm();
  setTimeout(() => showPanel('produk-saya', document.querySelector('[data-panel=produk-saya]')), 1200);
}
function resetProdForm() {
  document.getElementById('prod-name').value = '';
  document.getElementById('prod-slug').value = '';
  document.getElementById('prod-cat').value  = '';
  document.getElementById('prod-price').value = '';
  document.getElementById('prod-desc').value = '';
  document.getElementById('form-prod-title').textContent = 'Tambah Produk Baru';
  document.querySelectorAll('#name-count,#desc-count').forEach(el => el.textContent = '0');
  for (let i = 0; i < 4; i++) removeImg({ stopPropagation: () => {} }, i);
}

/* ========================================
   ANALITIK CHARTS
======================================== */
const WA_DATA    = [4,7,3,9,6,11,8,5,13,9,12,7,10,15];
const VIEWS_DATA = [18,32,24,45,38,52,41,29,60,44,55,38,47,72];
const DAYS = ['3/6','4/6','5/6','6/6','7/6','8/6','9/6','10/6','11/6','12/6','13/6','14/6','15/6','16/6'];

function buildBarChart(containerId, data, color='var(--primary)') {
  const max = Math.max(...data);
  const wrap = document.getElementById(containerId);
  if (!wrap) return;
  wrap.innerHTML = data.map((v, i) => `
    <div class="bar-col">
      <div class="bar-wrap">
        <div class="bar ${i === data.length-1 ? 'highlight' : ''}" style="height:${Math.max(8, (v/max)*100)}%;background:${i===data.length-1?color:'var(--primary-light)'};">
          <div class="bar-tip">${v}</div>
        </div>
      </div>
      <div class="bar-label">${DAYS[i]}</div>
    </div>
  `).join('');
}
buildBarChart('wa-chart', WA_DATA);
buildBarChart('views-chart', VIEWS_DATA);

// Mini sparkline charts
function buildMini(id, data) {
  const el = document.getElementById(id);
  if (!el) return;
  const max = Math.max(...data);
  el.innerHTML = data.map((v, i) => `<div class="mc-bar ${i===data.length-1?'active':''}" style="height:${Math.max(4,(v/max)*100)%;"></div>`).join('');
}
['mc-produk','mc-wa','mc-views'].forEach((id,i) => {
  const el = document.getElementById(id);
  if (!el) return;
  const data = [[4,4,4,4,4,4,4,4,4,8],[9,12,8,14,10,11,13,9,12,15],[18,22,20,28,25,30,27,32,38,47]][i];
  const max = Math.max(...data);
  el.innerHTML = data.map((v,j)=>`<div class="mc-bar ${j===data.length-1?'active':''}" style="height:${Math.max(4,Math.round((v/max)*100))}%;"></div>`).join('');
});

// Top products list
const TOP_PRODS = [
  {e:'🍪',bg:'#fef3c7',name:'Nastar Keju Premium 500gr',views:1240,pct:100},
  {e:'🎁',bg:'#fee2e2',name:'Hampers Lebaran Set 5 Toples',views:860,pct:69},
  {e:'🧁',bg:'#fce7f3',name:'Putri Salju Kacang 400gr',views:742,pct:60},
  {e:'🍘',bg:'#f0fdf4',name:'Kastengel Keju Edam 400gr',views:620,pct:50},
  {e:'🍩',bg:'#fffbeb',name:'Kue Semprit Susu Klasik 500gr',views:508,pct:41},
];
const rankClass = ['gold','silver','bronze','',''];
document.getElementById('top-prods-list').innerHTML = TOP_PRODS.map((p,i) => `
  <div class="top-prod-item">
    <div class="top-prod-rank ${rankClass[i]}">${i+1}</div>
    <div class="top-prod-thumb" style="background:${p.bg};">${p.e}</div>
    <div style="flex:1;">
      <div class="top-prod-name">${p.name}</div>
      <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
        <div class="top-prod-bar-wrap"><div class="top-prod-bar" style="width:${p.pct}%;"></div></div>
      </div>
    </div>
    <div style="text-align:right;">
      <div class="top-prod-views"><i class="fa-regular fa-eye fa-xs"></i> ${p.views.toLocaleString('id-ID')}</div>
      <div style="font-size:.7rem;color:var(--dark-light);">tayangan</div>
    </div>
  </div>
`).join('');

/* ========================================
   STORE INFO FORM
======================================== */
const HOURS_DATA = [
  { day:'Senin',    open:true,  from:'08:00',to:'17:00' },
  { day:'Selasa',   open:true,  from:'08:00',to:'17:00' },
  { day:'Rabu',     open:true,  from:'08:00',to:'17:00' },
  { day:'Kamis',    open:true,  from:'08:00',to:'17:00' },
  { day:'Jumat',    open:true,  from:'08:00',to:'16:00' },
  { day:'Sabtu',    open:true,  from:'09:00',to:'14:00' },
  { day:'Minggu',   open:false, from:'',     to:''      },
];
document.getElementById('hours-grid').innerHTML = HOURS_DATA.map((h,i) => `
  <div class="hours-day-row" id="hours-row-${i}">
    <span class="hours-day-label">${h.day}</span>
    <input type="time" class="form-control" style="padding:7px 10px;font-size:.82rem;" value="${h.from}" id="h-from-${i}" ${h.open?'':'disabled style="opacity:.35;"'}>
    <span style="color:var(--dark-light);text-align:center;">–</span>
    <input type="time" class="form-control" style="padding:7px 10px;font-size:.82rem;" value="${h.to}" id="h-to-${i}" ${h.open?'':'disabled style="opacity:.35;"'}>
    <label class="hours-toggle" title="Buka/Tutup">
      <input type="checkbox" ${h.open?'checked':''} onchange="toggleHoursDay(${i},this)" style="accent-color:var(--primary);">
    </label>
  </div>
`).join('');

function toggleHoursDay(i, el) {
  const row = document.getElementById('hours-row-' + i);
  row.querySelectorAll('input[type=time]').forEach(inp => {
    inp.disabled = !el.checked;
    inp.style.opacity = el.checked ? '1' : '.35';
  });
}

function saveShopInfo() { toast('✅ Info toko berhasil disimpan dan menunggu tinjauan admin'); }

/* ========================================
   MISC
======================================== */
function toast(msg, type='success') {
  const wrap = document.getElementById('toast-wrap');
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.innerHTML = (type==='success'?'<i class="fa-solid fa-circle-check"></i> ':'<i class="fa-solid fa-circle-exclamation"></i> ') + msg;
  wrap.appendChild(el);
  setTimeout(() => el.style.opacity = '0', 2800);
  setTimeout(() => el.remove(), 3200);
}

function copyWALink() {
  navigator.clipboard?.writeText('https://pasarlokal.id/toko/dapur-bu-sari');
  toast('🔗 Link toko berhasil disalin!');
}
function confirmDeactivate() {
  if (confirm('Yakin ingin menonaktifkan toko? Produk kamu tidak akan tampil di katalog.')) toast('Toko dinonaktifkan. Hubungi admin untuk mengaktifkan kembali.', 'error');
}

// Handle URL param: ?tab=tambah-produk
const urlTab = new URLSearchParams(window.location.search).get('tab');
if (urlTab) {
  const el = document.querySelector(`[data-panel="${urlTab}"]`);
  if (el) { showPanel(urlTab, el); }
}
        </script>
    </body>

</html>