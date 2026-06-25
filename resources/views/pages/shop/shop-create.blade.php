<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buat Toko — PasarLokal</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            /* ═══════════════════════════════════════════
       BUAT TOKO — FULL PAGE STYLES (TIDAK ADA YANG DIUBAH)
    ═══════════════════════════════════════════ */
            body {
                background: var(--bg);
            }

            .page-top {
                padding-top: var(--nav-h);
                background: var(--dark);
            }

            .page-hero-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 32px 0 36px;
                gap: 24px;
                flex-wrap: wrap;
            }

            .ph-left h1 {
                color: white;
                font-size: clamp(1.5rem, 3vw, 2rem);
                margin-bottom: 6px;
            }

            .ph-left p {
                color: rgba(255, 255, 255, .5);
                font-size: .88rem;
            }

            .ph-right {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-shrink: 0;
            }

            .wizard-stepper {
                background: var(--dark);
                border-top: 1px solid rgba(255, 255, 255, .08);
                padding: 0;
            }

            .stepper-inner {
                display: flex;
                align-items: stretch;
                overflow-x: auto;
            }

            .step-item {
                flex: 1;
                min-width: 140px;
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 16px 20px;
                position: relative;
                cursor: default;
                border-bottom: 3px solid transparent;
                transition: all .25s;
            }

            .step-item.done {
                border-bottom-color: var(--success);
            }

            .step-item.active {
                border-bottom-color: var(--primary);
            }

            .step-item:not(:last-child)::after {
                content: '';
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 1px;
                height: 32px;
                background: rgba(255, 255, 255, .1);
            }

            .step-num {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: .78rem;
                font-weight: 700;
                border: 2px solid rgba(255, 255, 255, .2);
                color: rgba(255, 255, 255, .4);
                transition: all .25s;
            }

            .step-item.done .step-num {
                background: var(--success);
                border-color: var(--success);
                color: white;
            }

            .step-item.active .step-num {
                background: var(--primary);
                border-color: var(--primary);
                color: white;
            }

            .step-text {
                flex: 1;
            }

            .step-label {
                font-size: .78rem;
                font-weight: 700;
                color: rgba(255, 255, 255, .35);
                transition: color .25s;
            }

            .step-sub {
                font-size: .68rem;
                color: rgba(255, 255, 255, .25);
                margin-top: 2px;
            }

            .step-item.done .step-label {
                color: var(--success);
            }

            .step-item.active .step-label {
                color: var(--primary);
            }

            .step-item.active .step-sub {
                color: rgba(255, 255, 255, .5);
            }

            .wizard-layout {
                display: grid;
                grid-template-columns: 1fr 320px;
                gap: 28px;
                padding: 36px 0 80px;
                align-items: start;
            }

            .wizard-step {
                display: none;
            }

            .wizard-step.active {
                display: block;
            }

            .form-block {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                margin-bottom: 20px;
                overflow: hidden;
            }

            .form-block-header {
                padding: 18px 24px;
                border-bottom: 1px solid var(--border);
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .form-block-icon {
                width: 36px;
                height: 36px;
                border-radius: var(--radius-sm);
                background: var(--primary-light);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary);
                font-size: .9rem;
                flex-shrink: 0;
            }

            .form-block-title {
                font-family: var(--font-display);
                font-size: .95rem;
                font-weight: 700;
                color: var(--dark);
            }

            .form-block-sub {
                font-size: .75rem;
                color: var(--dark-light);
                margin-top: 1px;
            }

            .form-block-body {
                padding: 24px;
            }

            .form-block-body .form-group:last-child {
                margin-bottom: 0;
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

            .field-footer {
                display: flex;
                justify-content: space-between;
                margin-top: 5px;
            }

            .char-count {
                font-size: .72rem;
                color: var(--dark-light);
            }

            .char-count.warn {
                color: var(--warning);
            }

            .char-count.over {
                color: var(--danger);
            }

            .input-pre-wrap {
                position: relative;
                display: flex;
            }

            .input-pre {
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
                flex-shrink: 0;
            }

            .input-pre+.form-control {
                border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            }

            .slug-preview {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: var(--bg);
                border: 1.5px solid var(--border);
                border-radius: var(--radius-full);
                padding: 5px 12px;
                font-size: .78rem;
                color: var(--dark-mid);
                margin-top: 6px;
                font-family: monospace;
                transition: all .2s;
            }

            .slug-preview .slug-val {
                color: var(--primary);
                font-weight: 700;
            }

            .slug-preview.ok {
                border-color: var(--success);
            }

            .slug-preview.err {
                border-color: var(--danger);
            }

            .logo-upload-area {
                width: 120px;
                height: 120px;
                border-radius: var(--radius-lg);
                border: 2.5px dashed var(--border);
                cursor: pointer;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 6px;
                color: var(--dark-light);
                font-size: .72rem;
                transition: all .22s;
                background: var(--bg);
                position: relative;
                overflow: hidden;
                flex-shrink: 0;
            }

            .logo-upload-area:hover {
                border-color: var(--primary);
                background: var(--primary-light);
                color: var(--primary);
            }

            .logo-upload-area i {
                font-size: 1.6rem;
            }

            .logo-upload-area .logo-preview-emoji {
                font-size: 3rem;
                display: none;
            }

            .logo-upload-area.has-logo .logo-preview-emoji {
                display: block;
            }

            .logo-upload-area.has-logo i.fa-camera-retro {
                display: none;
            }

            .logo-upload-area.has-logo span {
                display: none;
            }

            .logo-remove-btn {
                position: absolute;
                top: 5px;
                right: 5px;
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: rgba(239, 68, 68, .85);
                color: white;
                border: 2px solid white;
                display: none;
                align-items: center;
                justify-content: center;
                font-size: .58rem;
                cursor: pointer;
                z-index: 2;
            }

            .logo-upload-area.has-logo .logo-remove-btn {
                display: flex;
            }

            .logo-upload-area.has-logo:hover {
                border-color: var(--border);
                background: var(--bg);
            }

            .logo-upload-row {
                display: flex;
                align-items: flex-start;
                gap: 20px;
            }

            .logo-upload-info h4 {
                font-size: .92rem;
                margin-bottom: 4px;
            }

            .logo-upload-info p {
                font-size: .78rem;
                color: var(--dark-light);
                line-height: 1.6;
                margin-bottom: 10px;
            }

            .logo-emoji-picker {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-top: 10px;
            }

            .emoji-opt {
                width: 38px;
                height: 38px;
                border-radius: var(--radius-sm);
                border: 1.5px solid var(--border);
                background: var(--bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                cursor: pointer;
                transition: all .18s;
            }

            .emoji-opt:hover {
                border-color: var(--primary);
                transform: scale(1.1);
            }

            .emoji-opt.active {
                border-color: var(--primary);
                background: var(--primary-light);
                transform: scale(1.05);
            }

            .district-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
                margin-top: 4px;
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

            .hours-grid {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .hours-row {
                display: grid;
                grid-template-columns: 100px 1fr 16px 1fr 36px;
                gap: 8px;
                align-items: center;
            }

            .hours-day {
                font-size: .83rem;
                font-weight: 600;
                color: var(--dark);
            }

            .hours-input {
                padding: 8px 10px;
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                font-size: .82rem;
                font-family: var(--font-body);
                color: var(--dark);
                outline: none;
                transition: border-color .18s;
                width: 100%;
            }

            .hours-input:focus {
                border-color: var(--primary);
            }

            .hours-input:disabled {
                opacity: .35;
                cursor: not-allowed;
            }

            .hours-sep {
                text-align: center;
                color: var(--dark-light);
                font-size: .82rem;
            }

            .hours-toggle input[type=checkbox] {
                accent-color: var(--primary);
                width: 16px;
                height: 16px;
                cursor: pointer;
            }

            .wa-preview-card {
                background: #e5ddd5;
                border-radius: var(--radius-lg);
                padding: 16px;
                position: relative;
                overflow: hidden;
            }

            .wa-preview-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .wa-bubble {
                background: white;
                border-radius: 8px 8px 8px 2px;
                padding: 10px 12px;
                max-width: 280px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
                position: relative;
                font-size: .82rem;
                line-height: 1.6;
                color: #111;
            }

            .wa-bubble strong {
                color: var(--dark);
            }

            .wa-time {
                font-size: .65rem;
                color: rgba(0, 0, 0, .4);
                text-align: right;
                margin-top: 4px;
            }

            .review-section {
                margin-bottom: 20px;
            }

            .review-section-title {
                font-size: .72rem;
                font-weight: 700;
                letter-spacing: .08em;
                text-transform: uppercase;
                color: var(--dark-light);
                margin-bottom: 10px;
                padding-bottom: 8px;
                border-bottom: 1px solid var(--border);
            }

            .review-row {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                padding: 10px 0;
                border-bottom: 1px solid var(--border);
                font-size: .86rem;
            }

            .review-row:last-child {
                border-bottom: none;
            }

            .review-key {
                width: 140px;
                flex-shrink: 0;
                color: var(--dark-light);
                font-weight: 500;
            }

            .review-val {
                flex: 1;
                color: var(--dark);
                font-weight: 600;
            }

            .review-edit {
                color: var(--primary);
                font-size: .75rem;
                font-weight: 600;
                cursor: pointer;
                flex-shrink: 0;
            }

            .review-edit:hover {
                text-decoration: underline;
            }

            .review-logo-preview {
                width: 64px;
                height: 64px;
                border-radius: var(--radius-md);
                background: var(--primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.8rem;
                border: 2px solid var(--border);
            }

            .success-screen {
                display: none;
                text-align: center;
                padding: 60px 24px;
            }

            .success-screen.show {
                display: block;
            }

            .success-confetti {
                font-size: 4rem;
                margin-bottom: 20px;
                animation: bounce 1s ease infinite alternate;
            }

            @keyframes bounce {
                from {
                    transform: translateY(0);
                }

                to {
                    transform: translateY(-12px);
                }
            }

            .success-screen h2 {
                margin-bottom: 12px;
            }

            .success-screen p {
                color: var(--dark-mid);
                max-width: 420px;
                margin: 0 auto 32px;
                line-height: 1.7;
            }

            .success-actions {
                display: flex;
                gap: 12px;
                justify-content: center;
                flex-wrap: wrap;
            }

            .sidebar-sticky {
                position: sticky;
                top: calc(var(--nav-h)+16px);
                display: flex;
                flex-direction: column;
                gap: 18px;
            }

            .tip-widget {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                overflow: hidden;
            }

            .tip-widget-header {
                background: var(--primary);
                padding: 14px 18px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .tip-widget-header span {
                font-family: var(--font-display);
                font-size: .88rem;
                font-weight: 700;
                color: white;
            }

            .tip-widget-body {
                padding: 16px 18px;
            }

            .tip-item {
                display: flex;
                gap: 10px;
                padding: 10px 0;
                border-bottom: 1px solid var(--border);
                font-size: .82rem;
            }

            .tip-item:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .tip-num {
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: var(--primary-light);
                color: var(--primary);
                font-weight: 700;
                font-size: .68rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                margin-top: 1px;
            }

            .tip-text {
                color: var(--dark-mid);
                line-height: 1.5;
            }

            .schema-widget {
                background: var(--dark);
                border-radius: var(--radius-lg);
                padding: 18px;
            }

            .schema-title {
                font-size: .75rem;
                font-weight: 700;
                color: rgba(255, 255, 255, .5);
                text-transform: uppercase;
                letter-spacing: .08em;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .schema-title i {
                color: var(--primary);
            }

            .schema-field {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 7px 0;
                border-bottom: 1px solid rgba(255, 255, 255, .07);
                font-size: .78rem;
            }

            .schema-field:last-child {
                border-bottom: none;
            }

            .sf-name {
                color: var(--primary);
                font-family: monospace;
                font-weight: 600;
                flex: 1;
            }

            .sf-type {
                color: rgba(255, 255, 255, .3);
                font-size: .7rem;
                font-family: monospace;
            }

            .sf-req {
                color: #fbbf24;
                font-size: .65rem;
                font-weight: 700;
                margin-left: 4px;
            }

            .progress-widget {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 18px;
            }

            .pw-title {
                font-size: .82rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 14px;
            }

            .pw-step {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 8px 0;
                font-size: .82rem;
            }

            .pw-dot {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                border: 2px solid var(--border);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: .65rem;
                font-weight: 700;
                color: var(--dark-light);
                transition: all .25s;
                flex-shrink: 0;
            }

            .pw-dot.done {
                background: var(--success);
                border-color: var(--success);
                color: white;
            }

            .pw-dot.active {
                background: var(--primary);
                border-color: var(--primary);
                color: white;
            }

            .pw-label {
                color: var(--dark-mid);
            }

            .pw-label.done {
                color: var(--success);
            }

            .pw-label.active {
                color: var(--primary);
                font-weight: 600;
            }

            .wizard-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-top: 4px;
                padding-top: 20px;
                flex-wrap: wrap;
            }

            .wizard-nav-left {
                display: flex;
                gap: 10px;
            }

            .wizard-nav-right {
                display: flex;
                gap: 10px;
            }

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

            @media (max-width: 960px) {
                .wizard-layout {
                    grid-template-columns: 1fr;
                }

                .sidebar-sticky {
                    position: static;
                }
            }

            @media (max-width: 640px) {

                .form-grid-2,
                .form-grid-3 {
                    grid-template-columns: 1fr;
                }

                .district-grid {
                    grid-template-columns: 1fr 1fr;
                }

                .step-item {
                    min-width: 110px;
                }

                .step-text {
                    display: none;
                }

                .hours-row {
                    grid-template-columns: 80px 1fr 12px 1fr 28px;
                }
            }
        </style>
    </head>

    <body>

        @include('layouts.partials.navbar')

        <div class="page-top">
            <div class="container">
                <div class="page-hero-inner">
                    <div class="ph-left">
                        <h1><i class="fa-solid fa-store" style="color:var(--primary);margin-right:10px;"></i>Buat Toko
                            UMKM</h1>
                        <p>Daftarkan toko kamu secara gratis dan mulai jual produk ke seluruh Indonesia.</p>
                    </div>
                    <div class="ph-right">
                        <span style="font-size:.8rem;color:rgba(255,255,255,.4);">Langkah <strong id="step-indicator"
                                style="color:var(--primary);">1</strong> dari 4</span>
                    </div>
                </div>
            </div>

            <div class="wizard-stepper">
                <div class="container">
                    <div class="stepper-inner">
                        <div class="step-item active" id="si-0">
                            <div class="step-num">1</div>
                            <div class="step-text">
                                <div class="step-label">Info Toko</div>
                                <div class="step-sub">Nama · Slug · Deskripsi</div>
                            </div>
                        </div>
                        <div class="step-item" id="si-1">
                            <div class="step-num">2</div>
                            <div class="step-text">
                                <div class="step-label">Logo & Kontak</div>
                                <div class="step-sub">Logo · Nomor Whatsapp</div>
                            </div>
                        </div>
                        <div class="step-item" id="si-2">
                            <div class="step-num">3</div>
                            <div class="step-text">
                                <div class="step-label">Alamat</div>
                                <div class="step-sub">Alamat · Kecamatan</div>
                            </div>
                        </div>
                        <div class="step-item" id="si-3">
                            <div class="step-num">4</div>
                            <div class="step-text">
                                <div class="step-label">Review & Submit</div>
                                <div class="step-sub">Tinjau & kirim</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="wizard-layout" id="wizard-layout">

                <div id="wizard-form">

                    <div class="wizard-step active" id="step-0">

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-id-card"></i></div>
                                <div>
                                    <div class="form-block-title">Nama & Identitas Toko</div>
                                    <div class="form-block-sub">Kolom <code>name</code> dan <code>slug</code> pada tabel
                                        profiles_umkm</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="form-group">
                                    <label class="form-label">Nama Toko <span>*</span></label>
                                    <input class="form-control" id="shop-name"
                                        placeholder="Contoh: Dapur Bu Sari, Batik Nusantara..." maxlength="100"
                                        oninput="onNameInput(this.value)">
                                    <div class="field-footer">
                                        <span class="form-hint">Gunakan nama yang mudah diingat dan mencerminkan produk
                                            kamu.</span>
                                        <span class="char-count" id="name-cnt">0/100</span>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Slug URL Toko <span>*</span></label>
                                    <div class="input-pre-wrap">
                                        <div class="input-pre">pasarlokal.id/toko/</div>
                                        <input class="form-control" id="shop-slug" placeholder="dapur-bu-sari"
                                            maxlength="120" oninput="onSlugInput(this.value)">
                                    </div>
                                    <div class="field-footer">
                                        <span class="form-hint">Hanya huruf kecil, angka, dan tanda hubung (-).</span>
                                        <span class="char-count" id="slug-cnt">0/120</span>
                                    </div>
                                    <div class="slug-preview" id="slug-preview">
                                        <i class="fa-solid fa-link fa-xs" style="color:var(--dark-light);"></i>
                                        pasarlokal.id/toko/<span class="slug-val"
                                            id="slug-display">nama-toko-kamu</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-align-left"></i></div>
                                <div>
                                    <div class="form-block-title">Deskripsi Toko</div>
                                    <div class="form-block-sub">Kolom <code>description</code> — nullable, tapi sangat
                                        disarankan</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Deskripsi Singkat Toko <span
                                            style="color:var(--dark-light);font-weight:400;">(opsional)</span></label>
                                    <textarea class="form-control" id="shop-desc" rows="5" maxlength="500"
                                        placeholder="Ceritakan tentang tokomu: produk andalan, keunggulan, cara pemesanan, dll."
                                        oninput="countChars(this,'desc-cnt',500)"></textarea>
                                    <div class="field-footer">
                                        <span class="form-hint">Deskripsi yang baik meningkatkan kepercayaan pembeli
                                            hingga 40%.</span>
                                        <span class="char-count" id="desc-cnt">0/500</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-tag"></i></div>
                                <div>
                                    <div class="form-block-title">Kategori Utama Toko</div>
                                    <div class="form-block-sub">Membantu pembeli menemukan tokomu lebih mudah</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;" id="cat-grid">
                                    <div class="district-card" onclick="selectCat(this,'kuliner')">
                                        <span class="dc-icon">🍱</span><span class="dc-name">Kuliner</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'fashion')">
                                        <span class="dc-icon">👗</span><span class="dc-name">Fashion</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'kerajinan')">
                                        <span class="dc-icon">🎨</span><span class="dc-name">Kerajinan</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'pertanian')">
                                        <span class="dc-icon">🌿</span><span class="dc-name">Pertanian</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'kecantikan')">
                                        <span class="dc-icon">💆</span><span class="dc-name">Kecantikan</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'dekorasi')">
                                        <span class="dc-icon">🪴</span><span class="dc-name">Dekorasi</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'elektronik')">
                                        <span class="dc-icon">🔌</span><span class="dc-name">Elektronik</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                    <div class="district-card" onclick="selectCat(this,'lainnya')">
                                        <span class="dc-icon">📦</span><span class="dc-name">Lainnya</span>
                                        <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                                    </div>
                                </div>
                                <input type="hidden" id="shop-cat" value="">
                            </div>
                        </div>

                        <div class="wizard-nav">
                            <div class="wizard-nav-left">
                                <a href="{{ route('profile') }}" class="btn btn-ghost"><i
                                        class="fa-solid fa-arrow-left fa-xs"></i> Kembali</a>
                            </div>
                            <div class="wizard-nav-right">
                                <button class="btn btn-ghost btn-sm" onclick="saveDraft()"><i
                                        class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Draft</button>
                                <button class="btn btn-primary" onclick="goStep(1)">Lanjut: Logo & Kontak <i
                                        class="fa-solid fa-arrow-right fa-xs"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-step" id="step-1">

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-image"></i></div>
                                <div>
                                    <div class="form-block-title">Logo Toko</div>
                                    <div class="form-block-sub">Kolom <code>logo</code> — nullable, sangat disarankan
                                        untuk kepercayaan</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="logo-upload-row">
                                    <div class="logo-upload-area" id="logo-area" onclick="pickLogoEmoji()">
                                        <i class="fa-solid fa-camera-retro" style="font-size:1.8rem;"></i>
                                        <span>Pilih Logo</span>
                                        <div class="logo-preview-emoji" id="logo-emoji"></div>
                                        <div class="logo-remove-btn" onclick="removeLogo(event)"><i
                                                class="fa-solid fa-xmark"></i></div>
                                    </div>
                                    <div class="logo-upload-info">
                                        <h4>Upload Logo atau Pilih Emoji</h4>
                                        <p>Format: JPG, PNG, WebP · Maks. 2MB<br>Rekomendasi ukuran: 300×300px<br>Atau
                                            pilih emoji di bawah sebagai logo toko kamu.</p>
                                        <button class="btn btn-outline btn-sm"
                                            onclick="toast('Fitur upload file akan tersedia di versi final')">
                                            <i class="fa-solid fa-upload fa-xs"></i> Upload Gambar
                                        </button>
                                        <div class="logo-emoji-picker">
                                            <div class="emoji-opt" onclick="setLogoEmoji('🍱')">🍱</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🎨')">🎨</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('👗')">👗</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🌿')">🌿</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('💆')">💆</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🪴')">🪴</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🍯')">🍯</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🛍️')">🛍️</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🎁')">🎁</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🧁')">🧁</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🪡')">🪡</div>
                                            <div class="emoji-opt" onclick="setLogoEmoji('🔨')">🔨</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="shop-logo" value="">
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon" style="background:#d1fae5;color:#10b981;"><i
                                        class="fa-brands fa-whatsapp"></i></div>
                                <div>
                                    <div class="form-block-title">Nomor WhatsApp Business</div>
                                    <div class="form-block-sub">Kolom <code>whatsapp_number</code> — WAJIB, digunakan
                                        pembeli untuk menghubungi</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="form-group">
                                    <label class="form-label">Nomor WhatsApp <span>*</span></label>
                                    <div class="input-pre-wrap">
                                        <div class="input-pre" style="gap:6px;">
                                            <i class="fa-brands fa-whatsapp" style="color:#25D366;"></i> +62
                                        </div>
                                        <input class="form-control" id="shop-wa" type="tel" placeholder="812-3456-7890"
                                            maxlength="15" oninput="onWAInput(this.value)">
                                    </div>
                                    <div class="field-footer">
                                        <span class="form-hint">Nomor aktif yang bisa dihubungi pembeli. Tanpa spasi
                                            atau tanda hubung.</span>
                                        <span class="form-hint" id="wa-valid-msg"
                                            style="color:var(--dark-light);"></span>
                                    </div>
                                </div>

                                <div id="wa-preview-wrap" style="margin-top:4px; display:none;">
                                    <label class="form-label" style="margin-bottom:8px;">Preview Pesan Pembeli</label>
                                    <div class="wa-preview-card">
                                        <div class="wa-bubble">
                                            Halo <strong id="wa-preview-name">Nama Toko</strong>! 👋<br>
                                            Saya tertarik dengan produk kamu di PasarLokal.<br>
                                            Boleh minta info lebih lanjut? 🙏
                                            <div class="wa-time">14:32 ✓✓</div>
                                        </div>
                                    </div>
                                    <p style="font-size:.75rem;color:var(--dark-light);margin-top:8px;">
                                        <i class="fa-solid fa-circle-info fa-xs"></i> Inilah tampilan pesan yang akan
                                        dikirim pembeli ke WA kamu.
                                    </p>
                                </div>

                                <div
                                    style="margin-top:16px;background:var(--bg);border-radius:var(--radius-md);padding:14px 16px;border:1.5px dashed var(--border);">
                                    <div
                                        style="font-size:.78rem;font-weight:700;color:var(--dark);margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                        <i class="fa-brands fa-whatsapp" style="color:#25D366;"></i> Tips WhatsApp
                                        Business
                                    </div>
                                    <div style="display:flex;flex-direction:column;gap:5px;">
                                        <div
                                            style="font-size:.75rem;color:var(--dark-mid);display:flex;align-items:center;gap:6px;">
                                            <i class="fa-solid fa-check fa-xs" style="color:var(--success);"></i>
                                            Gunakan akun WhatsApp Business, bukan personal
                                        </div>
                                        <div
                                            style="font-size:.75rem;color:var(--dark-mid);display:flex;align-items:center;gap:6px;">
                                            <i class="fa-solid fa-check fa-xs" style="color:var(--success);"></i>
                                            Aktifkan "Pesan Sambutan" untuk respons otomatis
                                        </div>
                                        <div
                                            style="font-size:.75rem;color:var(--dark-mid);display:flex;align-items:center;gap:6px;">
                                            <i class="fa-solid fa-check fa-xs" style="color:var(--success);"></i> Pasang
                                            foto profil dan deskripsi bisnis di WA
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-clock"></i></div>
                                <div>
                                    <div class="form-block-title">Jam Operasional</div>
                                    <div class="form-block-sub">Informasi opsional yang ditampilkan di halaman toko
                                    </div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="hours-grid" id="hours-grid"></div>
                            </div>
                        </div>

                        <div class="wizard-nav">
                            <div class="wizard-nav-left">
                                <button class="btn btn-ghost" onclick="goStep(0)"><i
                                        class="fa-solid fa-arrow-left fa-xs"></i> Kembali</button>
                            </div>
                            <div class="wizard-nav-right">
                                <button class="btn btn-ghost btn-sm" onclick="saveDraft()"><i
                                        class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Draft</button>
                                <button class="btn btn-primary" onclick="goStep(2)">Lanjut: Alamat <i
                                        class="fa-solid fa-arrow-right fa-xs"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-step" id="step-2">

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                                <div>
                                    <div class="form-block-title">Alamat Lengkap</div>
                                    <div class="form-block-sub">Kolom <code>address</code> — teks bebas, ditampilkan ke
                                        pembeli</div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="form-group" style="margin-bottom:0;">
                                    <label class="form-label">Alamat Toko / Produksi <span>*</span></label>
                                    <textarea class="form-control" id="shop-address" rows="3"
                                        placeholder="Contoh: Jl. Pemuda No. 12, RT 03/RW 05, Kel. Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50132"
                                        oninput="countChars(this,'addr-cnt',300)" maxlength="300"></textarea>
                                    <div class="field-footer">
                                        <span class="form-hint">Sertakan nama jalan, nomor, kelurahan, dan kecamatan
                                            agar pembeli mudah menemukan.</span>
                                        <span class="char-count" id="addr-cnt">0/300</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <div class="form-block-title">Kecamatan / Distrik</div>
                                    <div class="form-block-sub">Kolom <code>district_id</code> (FK ke tabel
                                        <code>districts</code>) — WAJIB
                                    </div>
                                </div>
                            </div>
                            <div class="form-block-body">
                                <div class="form-group">
                                    <label class="form-label">Cari Kecamatan</label>
                                    <div style="position:relative;">
                                        <i class="fa-solid fa-magnifying-glass"
                                            style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--dark-light);font-size:.82rem;"></i>
                                        <input class="form-control" style="padding-left:36px;"
                                            placeholder="Ketik nama kecamatan..." oninput="searchDistrict(this.value)"
                                            id="district-search">
                                    </div>
                                </div>

                                <label class="form-label">Pilih Kecamatan <span>*</span></label>
                                <div class="district-grid" id="district-grid"></div>
                                <input type="hidden" id="shop-district" value="">

                                <div style="margin-top:14px;padding:12px 14px;background:var(--primary-light);border-radius:var(--radius-sm);border:1px solid rgba(253,116,0,.2);font-size:.8rem;display:none;"
                                    id="district-selected-info">
                                    <i class="fa-solid fa-location-dot" style="color:var(--primary);"></i>
                                    Kecamatan dipilih: <strong id="district-name-display"
                                        style="color:var(--primary);">—</strong>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-nav">
                            <div class="wizard-nav-left">
                                <button class="btn btn-ghost" onclick="goStep(1)"><i
                                        class="fa-solid fa-arrow-left fa-xs"></i> Kembali</button>
                            </div>
                            <div class="wizard-nav-right">
                                <button class="btn btn-ghost btn-sm" onclick="saveDraft()"><i
                                        class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Draft</button>
                                <button class="btn btn-primary" onclick="goStep(3)">Lanjut: Review <i
                                        class="fa-solid fa-arrow-right fa-xs"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-step" id="step-3">

                        <div class="form-block">
                            <div class="form-block-header">
                                <div class="form-block-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                                <div>
                                    <div class="form-block-title">Tinjau Data Toko</div>
                                    <div class="form-block-sub">Pastikan semua informasi sudah benar sebelum mengirimkan
                                    </div>
                                </div>
                            </div>
                            <div class="form-block-body" id="review-body">
                            </div>
                        </div>

                        <div class="form-block">
                            <div class="form-block-body">
                                <label
                                    style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;font-size:.85rem;color:var(--dark-mid);line-height:1.6;">
                                    <input type="checkbox" id="tos-check"
                                        style="accent-color:var(--primary);width:16px;height:16px;margin-top:2px;flex-shrink:0;">
                                    <span>Saya menyatakan bahwa informasi yang saya berikan adalah benar dan saya
                                        menyetujui
                                        <a href="#" style="color:var(--primary);font-weight:600;">Syarat & Ketentuan</a>
                                        serta
                                        <a href="#" style="color:var(--primary);font-weight:600;">Kebijakan Privasi</a>
                                        PasarLokal.
                                        Toko saya tidak menjual produk yang melanggar hukum.</span>
                                </label>
                            </div>
                        </div>

                        <div class="wizard-nav">
                            <div class="wizard-nav-left">
                                <button class="btn btn-ghost" onclick="goStep(2)"><i
                                        class="fa-solid fa-arrow-left fa-xs"></i> Kembali</button>
                            </div>
                            <div class="wizard-nav-right">
                                <button id="btn-submit" class="btn btn-primary btn-lg" onclick="submitShop(event)">
                                    <i class="fa-solid fa-rocket fa-xs"></i> Daftarkan Toko Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <aside class="sidebar-sticky" id="wizard-sidebar">

                    <div class="progress-widget">
                        <div class="pw-title">📋 Progress Pendaftaran</div>
                        <div class="pw-step">
                            <div class="pw-dot active" id="pw0">1</div><span class="pw-label active" id="pwl0">Info
                                Toko</span>
                        </div>
                        <div class="pw-step">
                            <div class="pw-dot" id="pw1">2</div><span class="pw-label" id="pwl1">Logo & Kontak</span>
                        </div>
                        <div class="pw-step">
                            <div class="pw-dot" id="pw2">3</div><span class="pw-label" id="pwl2">Alamat</span>
                        </div>
                        <div class="pw-step">
                            <div class="pw-dot" id="pw3">4</div><span class="pw-label" id="pwl3">Review & Submit</span>
                        </div>
                    </div>

                    <div class="tip-widget">
                        <div class="tip-widget-header"><i class="fa-solid fa-lightbulb"
                                style="color:white;"></i><span>Tips Toko Sukses</span></div>
                        <div class="tip-widget-body">
                            <div class="tip-item">
                                <div class="tip-num">1</div>
                                <div class="tip-text">Gunakan nama toko yang mudah diingat dan berkaitan dengan
                                    produkmu.</div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-num">2</div>
                                <div class="tip-text">Logo yang menarik meningkatkan kepercayaan pembeli hingga 3x
                                    lipat.</div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-num">3</div>
                                <div class="tip-text">Isi deskripsi lengkap agar tokomu muncul di hasil pencarian.</div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-num">4</div>
                                <div class="tip-text">Pastikan nomor WA aktif dan direspons cepat untuk konversi tinggi.
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>

            <div class="success-screen" id="success-screen">
                <div class="success-confetti">🎉</div>
                <h2>Toko Berhasil Didaftarkan!</h2>
                <p>
                    Selamat! Toko <strong id="success-name" style="color:var(--primary);"></strong> kamu sudah terdaftar
                    dan sedang
                    dalam proses tinjauan admin. Biasanya memerlukan waktu <strong>1×24 jam</strong>.
                    Kamu akan mendapat notifikasi via WhatsApp setelah toko disetujui.
                </p>
                <div class="success-actions">
                    <a href="{{ route('shop.manage') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-store"></i> Kelola
                        Toko</a>
                    <a href="{{ route('profile') }}" class="btn btn-ghost btn-lg" style="border:1.5px solid var(--border);">Ke
                        Profil</a>
                </div>
            </div>
        </div>

        <div class="toast-wrap" id="toast-wrap"></div>

        <script>
            let currentStep = 0;
            const TOTAL_STEPS = 4;
            const formData = { name:'', slug:'', description:'', logo:'', whatsapp_number:'', address:'', district_name:'', category:'' };

            function goStep(target) {
              if (target > currentStep) {
                const err = validateStep(currentStep);
                if (err) { toast(err, 'error'); return; }
              }
              document.getElementById('step-' + currentStep).classList.remove('active');
              const prev = currentStep;
              currentStep = target;
              document.getElementById('step-' + currentStep).classList.add('active');
              updateStepperUI(prev, target);
              if (target === 3) buildReview();
              window.scrollTo({ top: 0, behavior: 'smooth' });
              document.getElementById('step-indicator').textContent = currentStep + 1;
            }

            function updateStepperUI(prev, next) {
              for (let i = 0; i < TOTAL_STEPS; i++) {
                const si  = document.getElementById('si-' + i);
                const pw  = document.getElementById('pw' + i);
                const pwl = document.getElementById('pwl' + i);
                si.classList.remove('active','done');
                pw.classList.remove('active','done');
                pwl.classList.remove('active','done');
                if (i < next)      { si.classList.add('done');   pw.classList.add('done');   pwl.classList.add('done');   pw.innerHTML = '✓'; }
                else if (i === next){ si.classList.add('active'); pw.classList.add('active'); pwl.classList.add('active'); pw.textContent = i+1; }
                else               { pw.textContent = i+1; }
              }
            }

            function validateStep(step) {
              if (step === 0) {
                collectStep0();
                if (!formData.name.trim())  return '⚠️ Nama toko wajib diisi.';
                if (!formData.slug.trim())  return '⚠️ Slug URL toko wajib diisi.';
                if (!/^[a-z0-9-]+$/.test(formData.slug)) return '⚠️ Slug hanya boleh huruf kecil, angka, dan tanda hubung.';
                if (!formData.category)     return '⚠️ Pilih setidaknya 1 kategori toko.';
              }
              if (step === 1) {
                collectStep1();
                if (!formData.whatsapp_number) return '⚠️ Nomor WhatsApp wajib diisi.';
                if (formData.whatsapp_number.length < 9) return '⚠️ Nomor WhatsApp terlalu pendek.';
              }
              if (step === 2) {
                collectStep2();
                if (!formData.address.trim())  return '⚠️ Alamat toko wajib diisi.';
                if (!formData.district_id)     return '⚠️ Pilih kecamatan toko kamu.';
              }
              return null;
            }

            function collectStep0() {
              formData.name = document.getElementById('shop-name').value.trim();
              formData.slug = document.getElementById('shop-slug').value.trim();
              formData.description = document.getElementById('shop-desc').value.trim();
              formData.category = document.getElementById('shop-cat').value;
            }
            function collectStep1() {
              formData.logo = document.getElementById('shop-logo').value;
              const raw = document.getElementById('shop-wa').value.replace(/\D/g,'');
              formData.whatsapp_number = raw ? '0' + raw : '';
            }
            function collectStep2() {
              formData.address     = document.getElementById('shop-address').value.trim();
              formData.district_id = document.getElementById('shop-district').value || null;
              formData.district_name = document.getElementById('district-name-display').textContent;
            }

            function onNameInput(val) {
              document.getElementById('name-cnt').textContent = val.length + '/100';
              const slug = val.toLowerCase()
                .replace(/[àáâãäå]/g,'a').replace(/[èéêë]/g,'e').replace(/[ìíîï]/g,'i')
                .replace(/[òóôõö]/g,'o').replace(/[ùúûü]/g,'u').replace(/[ñ]/g,'n')
                .replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').replace(/^-|-$/g,'');
              document.getElementById('shop-slug').value = slug;
              onSlugInput(slug);
              document.getElementById('wa-preview-name').textContent = val || 'Nama Toko';
            }
            function onSlugInput(val) {
              const cnt  = document.getElementById('slug-cnt');
              const prev = document.getElementById('slug-preview');
              const disp = document.getElementById('slug-display');
              cnt.textContent  = val.length + '/120';
              disp.textContent = val || 'nama-toko-kamu';
              const ok = /^[a-z0-9-]+$/.test(val) && val.length > 0;
              prev.classList.toggle('ok', ok);
              prev.classList.toggle('err', !ok && val.length > 0);
            }
            function selectCat(el, val) {
              document.querySelectorAll('#cat-grid .district-card').forEach(c => c.classList.remove('active'));
              el.classList.add('active');
              document.getElementById('shop-cat').value = val;
            }
            function countChars(el, countId, max) {
              const cnt = document.getElementById(countId);
              cnt.textContent = el.value.length + '/' + max;
              cnt.className = 'char-count' + (el.value.length > max*0.9 ? ' warn' : '') + (el.value.length >= max ? ' over' : '');
            }

            function setLogoEmoji(emoji) {
              document.querySelectorAll('.emoji-opt').forEach(e => e.classList.remove('active'));
              event.target.classList.add('active');
              const area = document.getElementById('logo-area');
              const emojiEl = document.getElementById('logo-emoji');
              emojiEl.textContent = emoji;
              area.classList.add('has-logo');
              document.getElementById('shop-logo').value = emoji;
              toast('Logo toko diperbarui!');
            }
            function pickLogoEmoji() {
              if (document.getElementById('logo-area').classList.contains('has-logo')) return;
            }
            function removeLogo(e) {
              e.stopPropagation();
              const area = document.getElementById('logo-area');
              document.getElementById('logo-emoji').textContent = '';
              area.classList.remove('has-logo');
              document.getElementById('shop-logo').value = '';
              document.querySelectorAll('.emoji-opt').forEach(e => e.classList.remove('active'));
            }

            function onWAInput(val) {
              const clean = val.replace(/\D/g,'');
              const msg   = document.getElementById('wa-valid-msg');
              const wrap  = document.getElementById('wa-preview-wrap');
              if (clean.length >= 9) {
                msg.innerHTML = '<i class="fa-solid fa-circle-check" style="color:var(--success);"></i> Nomor valid';
                msg.style.color = 'var(--success)';
                wrap.style.display = 'block';
              } else if (clean.length > 0) {
                msg.textContent = 'Nomor terlalu pendek';
                msg.style.color = 'var(--danger)';
                wrap.style.display = 'none';
              } else {
                msg.textContent = '';
                wrap.style.display = 'none';
              }
            }

            const DAYS_DATA = [
              { d:'Senin',   o:true,  f:'08:00', t:'17:00' },
              { d:'Selasa',  o:true,  f:'08:00', t:'17:00' },
              { d:'Rabu',    o:true,  f:'08:00', t:'17:00' },
              { d:'Kamis',   o:true,  f:'08:00', t:'17:00' },
              { d:'Jumat',   o:true,  f:'08:00', t:'16:00' },
              { d:'Sabtu',   o:true,  f:'09:00', t:'14:00' },
              { d:'Minggu',  o:false, f:'',      t:''      },
            ];
            document.getElementById('hours-grid').innerHTML = DAYS_DATA.map((h,i) => `
              <div class="hours-row" id="hrow-${i}">
                <span class="hours-day">${h.d}</span>
                <input type="time" class="hours-input" value="${h.f}" id="hf-${i}" ${h.o?'':'disabled'}>
                <span class="hours-sep">–</span>
                <input type="time" class="hours-input" value="${h.t}" id="ht-${i}" ${h.o?'':'disabled'}>
                <label class="hours-toggle" title="${h.o?'Tutup hari ini':'Buka hari ini'}">
                  <input type="checkbox" ${h.o?'checked':''} onchange="toggleDay(${i},this)">
                </label>
              </div>
            `).join('');

            function toggleDay(i, el) {
              ['hf-','ht-'].forEach(p => {
                const inp = document.getElementById(p+i);
                inp.disabled = !el.checked;
                inp.style.opacity = el.checked ? '1' : '.35';
              });
            }

            const DISTRICTS = [
                {id:1,name:'Purwokerto Utara',city:'purwokerto',icon:'⛰️'},
                {id:2,name:'Purwokerto Selatan',city:'purwokerto',icon:'🏙️'},
                {id:3,name:'Purwokerto Barat',city:'purwokerto',icon:'🏙️'},
                {id:4,name:'Purwokerto Timur',city:'purwokerto',icon:'🏙️'},
                {id:5,name:'Baturraden',city:'banyumas',icon:'🌲'},
                {id:6,name:'Sokaraja',city:'banyumas',icon:'🏢'},
                {id:7,name:'Banyumas',city:'banyumas',icon:'🏛️'},
                {id:8,name:'Kembaran',city:'banyumas',icon:'🌳'},
                {id:9,name:'Sumbang',city:'banyumas',icon:'⛰️'},
                {id:10,name:'Kedungbanteng',city:'banyumas',icon:'⛰️'},
                {id:11,name:'Karanglewas',city:'banyumas',icon:'🌳'},
                {id:12,name:'Cilongok',city:'banyumas',icon:'🌲'},
                {id:13,name:'Ajibarang',city:'banyumas',icon:'🏭'},
                {id:14,name:'Pekuncen',city:'banyumas',icon:'⛰️'},
                {id:15,name:'Gumelar',city:'banyumas',icon:'⛰️'},
                {id:16,name:'Lumbir',city:'banyumas',icon:'🌲'},
                {id:17,name:'Wangon',city:'banyumas',icon:'🛣️'},
                {id:18,name:'Jatilawang',city:'banyumas',icon:'🌳'},
                {id:19,name:'Purwojati',city:'banyumas',icon:'🌳'},
                {id:20,name:'Rawalo',city:'banyumas',icon:'🌊'},
                {id:21,name:'Kebasen',city:'banyumas',icon:'🌊'},
                {id:22,name:'Patikraja',city:'banyumas',icon:'🛣️'},
                {id:23,name:'Kalibagor',city:'banyumas',icon:'🌳'},
                {id:24,name:'Somagede',city:'banyumas',icon:'🌳'},
                {id:25,name:'Kemranjen',city:'banyumas',icon:'🍈'},
                {id:26,name:'Sumpiuh',city:'banyumas',icon:'🏙️'},
                {id:27,name:'Tambak',city:'banyumas',icon:'🦆'}
            ];

            function renderDistricts(data) {
              const grid = document.getElementById('district-grid');
              if (data.length === 0) {
                grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:20px;color:var(--dark-light);font-size:.82rem;"><i class="fa-solid fa-magnifying-glass"></i> Pilih Kecamatan</div>';
                return;
              }
              grid.innerHTML = data.map(d => `
                <div class="district-card" data-id="${d.id}" data-name="${d.name}" onclick="selectDistrict(this)">
                  <span class="dc-icon">${d.icon}</span>
                  <span class="dc-name">${d.name}</span>
                  <div class="dc-check"><i class="fa-solid fa-check fa-xs"></i></div>
                </div>
              `).join('');
            }
            renderDistricts(DISTRICTS.filter(d => d.city === 'semarang'));

            function filterDistricts(prov) {
              document.getElementById('city-select').value = '';
              renderDistricts(DISTRICTS);
            }
            function filterByCity(city) {
              if (!city) { renderDistricts(DISTRICTS); return; }
              renderDistricts(DISTRICTS.filter(d => d.city === city));
            }
            function searchDistrict(q) {
              if (!q.trim()) { filterByCity(document.getElementById('city-select').value); return; }
              renderDistricts(DISTRICTS.filter(d => d.name.toLowerCase().includes(q.toLowerCase())));
            }
            function selectDistrict(el) {
              document.querySelectorAll('#district-grid .district-card').forEach(c => c.classList.remove('active'));
              el.classList.add('active');
              const id   = el.dataset.id;
              const name = el.dataset.name;
              document.getElementById('shop-district').value = name;
              document.getElementById('district-name-display').textContent = name;
              document.getElementById('district-selected-info').style.display = 'block';
            }

            function buildReview() {
              collectStep0(); collectStep1(); collectStep2();
              const logo = formData.logo || '🏪';
              document.getElementById('review-body').innerHTML = `
                <div style="display:flex;align-items:center;gap:16px;padding:16px;background:var(--bg);border-radius:var(--radius-md);border:1.5px solid var(--border);margin-bottom:20px;">
                  <div class="review-logo-preview">${logo}</div>
                  <div>
                    <div style="font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--dark);">${formData.name || '—'}</div>
                    <div style="font-size:.78rem;color:var(--dark-light);margin-top:4px;font-family:monospace;">pasarlokal.id/toko/${formData.slug}</div>
                    <div style="display:flex;gap:6px;margin-top:8px;">
                      <span class="badge badge-warning" style="font-size:.7rem;"><i class="fa-solid fa-clock fa-xs"></i> Menunggu Review Admin</span>
                      ${formData.category ? `<span class="badge badge-primary" style="font-size:.7rem;">${formData.category}</span>` : ''}
                    </div>
                  </div>
                </div>

                <div class="review-section">
                  <div class="review-section-title">Step 1 — Info Toko</div>
                  <div class="review-row">
                    <span class="review-key">Nama Toko</span>
                    <span class="review-val">${formData.name || '<em style="color:var(--danger)">Belum diisi</em>'}</span>
                    <span class="review-edit" onclick="goStep(0)">Edit</span>
                  </div>
                  <div class="review-row">
                    <span class="review-key">Slug URL</span>
                    <span class="review-val" style="font-family:monospace;font-size:.82rem;">${formData.slug || '—'}</span>
                    <span class="review-edit" onclick="goStep(0)">Edit</span>
                  </div>
                  <div class="review-row">
                    <span class="review-key">Deskripsi</span>
                    <span class="review-val" style="font-weight:400;color:var(--dark-mid);">${formData.description || '<em style="color:var(--dark-light);">Tidak diisi (opsional)</em>'}</span>
                    <span class="review-edit" onclick="goStep(0)">Edit</span>
                  </div>
                  <div class="review-row">
                    <span class="review-key">Kategori</span>
                    <span class="review-val">${formData.category || '<em style="color:var(--danger)">Belum dipilih</em>'}</span>
                    <span class="review-edit" onclick="goStep(0)">Edit</span>
                  </div>
                </div>

                <div class="review-section">
                  <div class="review-section-title">Step 2 — Logo & Kontak</div>
                  <div class="review-row">
                    <span class="review-key">Logo</span>
                    <span class="review-val">${formData.logo ? `<span style="font-size:1.4rem;">${formData.logo}</span>` : '<em style="color:var(--dark-light);">Tidak dipasang</em>'}</span>
                    <span class="review-edit" onclick="goStep(1)">Edit</span>
                  </div>
                  <div class="review-row">
                    <span class="review-key">WhatsApp</span>
                    <span class="review-val" style="color:var(--success);display:flex;align-items:center;gap:6px;">
                      <i class="fa-brands fa-whatsapp"></i>
                      ${formData.whatsapp_number || '<em style="color:var(--danger)">Belum diisi</em>'}
                    </span>
                    <span class="review-edit" onclick="goStep(1)">Edit</span>
                  </div>
                </div>

                <div class="review-section">
                  <div class="review-section-title">Step 3 — Alamat & Lokasi</div>
                  <div class="review-row">
                    <span class="review-key">Alamat</span>
                    <span class="review-val" style="font-weight:400;">${formData.address || '<em style="color:var(--danger)">Belum diisi</em>'}</span>
                    <span class="review-edit" onclick="goStep(2)">Edit</span>
                  </div>
                  <div class="review-row">
                    <span class="review-key">Kecamatan</span>
                    <span class="review-val" style="display:flex;align-items:center;gap:6px;">
                      <i class="fa-solid fa-location-dot" style="color:var(--primary);"></i>
                      ${formData.district_name || '<em style="color:var(--danger)">Belum dipilih</em>'}
                    </span>
                    <span class="review-edit" onclick="goStep(2)">Edit</span>
                  </div>
                </div>
              `;
            }

            // FUNGSI INI SUDAH DIUBAH UNTUK MELAKUKAN POST MENGGUNAKAN FETCH API
            function submitShop(event) {
              if (!document.getElementById('tos-check').checked) {
                toast('⚠️ Centang persetujuan syarat & ketentuan terlebih dahulu.', 'error'); return;
              }
              
              collectStep0(); 
              collectStep1(); 
              collectStep2();
              
              // Final check
              if (!formData.name || !formData.slug || !formData.whatsapp_number || !formData.address || !formData.district_name) {
                toast('⚠️ Ada data wajib yang belum diisi. Periksa kembali.', 'error'); return;
              }

              // Ambil elemen yang dibutuhkan
              const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              const btn = document.getElementById('btn-submit');
              const originalText = btn.innerHTML;
              
              // Set tombol menjadi loading
              btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Mendaftarkan...';
              btn.style.pointerEvents = 'none';

              // Ganti route dibawah sesuai dengan Route Post Pembuatan Toko, misal: route('shop.store')
              fetch("{{ route('shop.store') }}", { 
                  method: 'POST',
                  headers: {
                      "Content-Type": "application/json",
                      "X-CSRF-TOKEN": csrfToken,
                      "Accept": "application/json"
                  },
                  body: JSON.stringify(formData)
              })
              .then(response => response.json())
              .then(data => {
                  // Kembalikan tombol seperti semula
                  btn.innerHTML = originalText;
                  btn.style.pointerEvents = 'auto';

                  if (data.success) {
                      // Tampilkan panel sukses jika berhasil
                      document.getElementById('wizard-layout').style.display = 'none';
                      document.getElementById('success-screen').classList.add('show');
                      document.getElementById('success-name').textContent = formData.name;
                      window.scrollTo({ top: 0, behavior: 'smooth' });
                  } else {
                      // Tampilkan pesan error jika validasi di sisi server gagal
                      toast(data.message || 'Gagal mendaftarkan toko. Silakan periksa kembali data Anda.', 'error');
                  }
              })
              .catch(error => {
                  console.error('Fetch Error:', error);
                  btn.innerHTML = originalText;
                  btn.style.pointerEvents = 'auto';
                  toast('Terjadi kesalahan saat menghubungi server.', 'error');
              });
            }

            function saveDraft() {
              toast('📝 Draft tersimpan. Kamu bisa melanjutkan kapan saja.');
            }

            function toast(msg, type='success') {
              const wrap = document.getElementById('toast-wrap');
              const el   = document.createElement('div');
              el.className = `toast ${type}`;
              el.innerHTML = (type==='success'?'<i class="fa-solid fa-circle-check"></i> ':'<i class="fa-solid fa-triangle-exclamation"></i> ') + msg;
              wrap.appendChild(el);
              setTimeout(() => el.style.opacity = '0', 3000);
              setTimeout(() => el.remove(), 3400);
            }
        </script>
    </body>

</html>