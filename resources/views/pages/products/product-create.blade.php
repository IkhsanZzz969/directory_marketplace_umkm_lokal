<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru — {{ env('APP_NAME', 'Laba') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: var(--bg);
        }

        /* PAGE HEADER */
        .page-top {
            padding-top: var(--nav-h);
            background: var(--dark);
        }

        .page-top-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 0;
            gap: 16px;
            flex-wrap: wrap;
        }

        .pt-breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: .75rem;
            color: rgba(255, 255, 255, .35);
            margin-bottom: 6px;
        }

        .pt-breadcrumb a {
            color: rgba(255, 255, 255, .5);
            transition: color .18s;
        }

        .pt-breadcrumb a:hover {
            color: var(--primary);
        }

        .pt-breadcrumb i {
            font-size: .6rem;
        }

        .pt-title {
            color: white;
            font-size: clamp(1.3rem, 2.5vw, 1.75rem);
            font-family: var(--font-display);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pt-title .mode-badge {
            font-size: .65rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: var(--radius-full);
            background: var(--primary);
            color: white;
            letter-spacing: .04em;
        }

        .pt-sub {
            color: rgba(255, 255, 255, .4);
            font-size: .8rem;
            margin-top: 5px;
        }

        .pt-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        /* LAYOUT */
        .prod-layout {
            display: grid;
            grid-template-columns: 1fr 290px;
            gap: 24px;
            padding: 28px 0 100px;
            align-items: start;
        }

        /* FORM CARD */
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

        .fcard-icon.purple {
            background: #f3e8ff;
            color: #8b5cf6;
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

        .fcard-body .form-group:last-child {
            margin-bottom: 0;
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

        /* CHAR COUNT */
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

        /* IMAGE UPLOAD */
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

        .img-upload-area:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .img-upload-area.dragover {
            border-color: var(--primary);
            background: var(--primary-light);
            transform: scale(1.01);
        }

        .img-upload-area .upload-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: .5;
            transition: opacity .2s;
        }

        .img-upload-area:hover .upload-icon {
            opacity: 1;
        }

        .img-upload-area .upload-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
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

        /* IMAGE LOADING SPINNER */
        .img-loading-spinner {
            width: 28px;
            height: 28px;
            border: 3px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: imgSpin .7s linear infinite;
        }

        @keyframes imgSpin {
            to {
                transform: rotate(360deg);
            }
        }

        /* IMAGE GRID (preview after adding) */
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
            transition: border-color .18s;
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
            cursor: pointer;
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
            white-space: nowrap;
            pointer-events: none;
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
            transition: all .2s;
            color: var(--dark-light);
            font-size: .72rem;
            background: var(--bg);
        }

        .img-add-slot:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .img-add-slot i {
            font-size: 1.1rem;
        }

        /* EMOJI QUICK-PICK */
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

        /* PRICE */
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
            white-space: nowrap;
            flex-shrink: 0;
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

        /* SLUG PILL */
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
            transition: border-color .2s;
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

        /* TAG INPUT */
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
            transition: border-color .2s;
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

        .tag-x:hover {
            opacity: 1;
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

        /* STOCK CARDS */
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
            transition: all .2s;
            background: var(--white);
        }

        .scard:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .scard.on {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .scard .s-ico {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 5px;
            transition: transform .18s;
        }

        .scard.on .s-ico {
            transform: scale(1.12);
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

        /* FEATURED ROW */
        .feat-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            background: var(--bg);
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all .22s;
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

        .feat-row.on .feat-lbl {
            color: #92400e;
        }

        /* TOGGLE */
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

        /* STATUS CARDS */
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
            transition: all .2s;
            background: var(--white);
        }

        .stcard:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

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

        .stcard .st-sub {
            font-size: .64rem;
            color: var(--dark-light);
            margin-top: 2px;
        }

        .stcard.on .st-lbl {
            color: var(--primary);
        }

        /* SIDEBAR PREVIEW CARD */
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
            transition: background .18s;
        }

        .prev-wa-btn:hover {
            background: #1eb857;
        }

        .prev-stock-badge {
            display: inline-block;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            margin-bottom: 4px;
        }

        /* SCHEMA BOX */
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
            letter-spacing: .09em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .sch-title i {
            color: var(--primary);
        }

        .sf {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 0;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
            font-size: .73rem;
        }

        .sf:last-child {
            border-bottom: none;
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

        .sf-n {
            color: rgba(255, 255, 255, .22);
            font-size: .58rem;
        }

        /* PROGRESS TRACKER */
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

        .prog-title i {
            color: var(--primary);
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
            flex-shrink: 0;
            transition: all .22s;
        }

        .prog-dot.done {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .prog-dot.active {
            border-color: var(--primary);
        }

        .prog-item.done {
            color: var(--dark);
        }

        /* TIPS */
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
            line-height: 1.5;
        }

        .tip-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .tip-item .tip-ico {
            flex-shrink: 0;
        }

        /* STICKY SAVE BAR */
        .save-bar {
            position: sticky;
            bottom: 0;
            background: var(--white);
            border-top: 1.5px solid var(--border);
            padding: 12px 0;
            z-index: 100;
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

        /* TOAST */
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

        /* SUCCESS OVERLAY */
        .success-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(46, 53, 61, .6);
            backdrop-filter: blur(6px);
            z-index: 3000;
            align-items: center;
            justify-content: center;
        }

        .success-overlay.show {
            display: flex;
        }

        .success-box {
            background: white;
            border-radius: var(--radius-xl);
            padding: 40px;
            max-width: 460px;
            width: 90%;
            text-align: center;
            animation: popUp .3s ease;
            box-shadow: var(--shadow-xl);
        }

        @keyframes popUp {
            from {
                transform: scale(.88);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-emoji {
            font-size: 3.5rem;
            margin-bottom: 16px;
            animation: bounce .8s ease infinite alternate;
        }

        @keyframes bounce {
            to {
                transform: translateY(-8px);
            }
        }

        .success-box h2 {
            margin-bottom: 8px;
        }

        .success-box p {
            color: var(--dark-mid);
            font-size: .9rem;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .success-acts {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */
        @media (max-width:960px) {
            .prod-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:640px) {

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
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar scrolled" id="navbar">
        <div class="nav-inner">
            <a href="index.html" class="nav-logo">
                <div class="nav-logo-icon">🏪</div>Pasar<span>Lokal</span>
            </a>
            <div class="nav-links">
                <a href="index.html" class="nav-link">Beranda</a>
                <a href="catalog.html" class="nav-link">Produk</a>
                <a href="toko-umkm.html" class="nav-link">Toko UMKM</a>
            </div>
            <div class="nav-actions">
                <a href="{{ route('shop.manage') }}" class="btn btn-ghost btn-sm"><i
                        class="fa-solid fa-arrow-left fa-xs"></i>
                    Kelola Toko</a>
                <div class="nav-avatar">S</div>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-top">
        <div class="container">
            <div class="page-top-inner">
                <div>
                    <div class="pt-breadcrumb">
                        <a href="profile.html">Profil</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <a href="{{ route('shop.manage') }}">Kelola Toko</a>
                        <i class="fa-solid fa-chevron-right"></i>
                        <span>Tambah Produk</span>
                    </div>
                    <div class="pt-title">
                        <i class="fa-solid fa-circle-plus" style="color:var(--primary);"></i>
                        Tambah Produk Baru
                        <span class="mode-badge">MODE: TAMBAH</span>
                    </div>
                    <div class="pt-sub">Toko: <strong style="color:rgba(255,255,255,.65);">Dapur Bu Sari</strong>
                        &nbsp;·&nbsp; Semua kolom bertanda <span style="color:var(--primary);font-weight:700;">*</span>
                        wajib diisi</div>
                </div>
                <div class="pt-actions">
                    <button class="btn btn-ghost btn-sm"
                        style="color:rgba(255,255,255,.55);border:1.5px solid rgba(255,255,255,.15);" type="button"
                        onclick="saveDraft()">
                        <i class="fa-solid fa-floppy-disk fa-xs"></i> Simpan Draft
                    </button>
                    <button type="submit" form="form-create-product" class="btn btn-primary btn-sm" id="top-pub-btn">
                        <i class="fa-solid fa-rocket fa-xs"></i> Publikasikan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger"
                style="background:var(--danger);color:white;padding:15px;border-radius:8px;margin-bottom:20px;">
                <div style="font-weight:bold;margin-bottom:8px;"><i class="fa-solid fa-triangle-exclamation"></i>
                    Terdapat kesalahan pada form:</div>
                <ul style="margin:0;padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="prod-layout"
            id="form-create-product" onsubmit="return handleFormSubmit(event)">
            @csrf
            <!-- LEFT: FORM -->
            <div>

                <!-- ██ 1. FOTO PRODUK ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon"><i class="fa-solid fa-images"></i></div>
                        <div>
                            <div class="fcard-title">Foto Produk</div>
                            <div class="fcard-sub">Tabel <code>product_images</code> · <code>image_path</code> ·
                                <code>is_primary</code> · Maks. 4 foto
                            </div>
                        </div>
                        <span class="badge badge-primary" style="margin-left:auto;font-size:.68rem;"
                            id="img-count-badge">0 / 4</span>
                    </div>
                    <div class="fcard-body">

                        <!-- Hidden file input (outside drop zone to prevent click conflicts) -->
                        <input type="file" id="file-input" name="images[]" class="img-hidden-input" multiple
                            accept="image/*">

                        <!-- Upload drop zone -->
                        <div class="img-upload-area" id="drop-zone" ondragover="onDragOver(event)"
                            ondragleave="onDragLeave(event)" ondrop="onDrop(event)"
                            onclick="document.getElementById('file-input').click()">
                            <div class="upload-icon">📸</div>
                            <div class="upload-title">Tarik & Lepas foto di sini</div>
                            <div class="upload-sub">atau klik untuk memilih dari perangkat kamu</div>
                            <div class="upload-or">atau gunakan emoji cepat di bawah</div>
                            <button class="btn btn-outline btn-sm"
                                onclick="event.stopPropagation();document.getElementById('file-input').click()">
                                <i class="fa-solid fa-upload fa-xs"></i> Pilih File
                            </button>
                            <div style="font-size:.72rem;color:var(--dark-light);margin-top:8px;">JPG · PNG · WebP ·
                                Maks. 5MB · Min. 800×800px</div>

                            <!-- Emoji quick-pick -->
                            <div class="emoji-picker-row">
                                <div class="ep-label">⚡ Pilih emoji sebagai placeholder foto:</div>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🍪')">🍪</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🎁')">🎁</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🧁')">🧁</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🍯')">🍯</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'👜')">👜</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🎨')">🎨</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🌿')">🌿</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🛍️')">🛍️</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🧶')">🧶</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🪴')">🪴</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🍱')">🍱</button>
                                <button class="ep-btn"
                                    onclick="event.stopPropagation();addEmojiSlot(this,'🕯️')">🕯️</button>
                            </div>
                        </div>

                        <!-- Image preview grid -->
                        <div class="img-preview-grid" id="img-preview-grid">
                            <!-- added dynamically -->
                        </div>
                        <div id="img-hint-text"
                            style="font-size:.74rem;color:var(--dark-light);margin-top:8px;display:flex;align-items:center;gap:5px;">
                            <i class="fa-solid fa-circle-info fa-xs" style="color:var(--primary);"></i>
                            Foto pertama secara otomatis menjadi <strong>foto utama (is_primary = true)</strong>. Klik
                            foto untuk atur ulang urutan.
                        </div>
                    </div>
                </div>

                <!-- ██ 2. INFO DASAR ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon"><i class="fa-solid fa-file-lines"></i></div>
                        <div>
                            <div class="fcard-title">Informasi Dasar</div>
                            <div class="fcard-sub">Kolom: <code>name</code> · <code>slug</code> ·
                                <code>description</code> · <code>category_id</code>
                            </div>
                        </div>
                    </div>
                    <div class="fcard-body">

                        <!-- name -->
                        <div class="form-group">
                            <label class="form-label">Nama Produk <span>*</span>
                                <span
                                    style="font-size:.72rem;font-weight:400;color:var(--dark-light);margin-left:6px;">→
                                    kolom <code
                                        style="font-size:.68rem;background:var(--bg);border:1px solid var(--border);padding:0 4px;border-radius:3px;color:var(--primary);">name
                                        VARCHAR(150)</code></span>
                            </label>
                            <input class="form-control" id="prod-name" name="name"
                                placeholder="Contoh: Nastar Keju Premium Lebaran 500gr" maxlength="150"
                                oninput="onName(this.value)" autofocus>
                            <div class="ffoot">
                                <span class="form-hint">Sertakan ukuran/varian. Min. 10 karakter.</span>
                                <span class="cc" id="cc-name">0/150</span>
                            </div>
                        </div>

                        <!-- category_id + slug -->
                        <div class="fg2">
                            <div class="form-group">
                                <label class="form-label">Kategori <span>*</span>
                                    <span
                                        style="font-size:.72rem;font-weight:400;color:var(--dark-light);margin-left:4px;">→
                                        <code
                                            style="font-size:.68rem;background:var(--bg);border:1px solid var(--border);padding:0 4px;border-radius:3px;color:var(--primary);">category_id
                                            INT FK</code></span>
                                </label>
                                <select class="form-control" id="prod-cat" name="category_id"
                                    onchange="updatePreview()">
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slug URL <span>*</span>
                                    <span
                                        style="font-size:.72rem;font-weight:400;color:var(--dark-light);margin-left:4px;">→
                                        <code
                                            style="font-size:.68rem;background:var(--bg);border:1px solid var(--border);padding:0 4px;border-radius:3px;color:var(--primary);">slug
                                            VARCHAR(170) UNIQUE</code></span>
                                </label>
                                <input class="form-control" id="prod-slug" name="slug"
                                    placeholder="nastar-keju-premium-500gr" maxlength="170"
                                    oninput="onSlug(this.value)">
                                <div class="slug-pill" id="slug-pill">
                                    <i class="fa-solid fa-link fa-xs" style="color:var(--dark-light);"></i>
                                    /produk/<span class="slug-val" id="slug-val">nama-produk</span>
                                </div>
                            </div>
                        </div>

                        <!-- description -->
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">Deskripsi Produk <span>*</span>
                                <span
                                    style="font-size:.72rem;font-weight:400;color:var(--dark-light);margin-left:4px;">→
                                    <code
                                        style="font-size:.68rem;background:var(--bg);border:1px solid var(--border);padding:0 4px;border-radius:3px;color:var(--primary);">description
                                        TEXT</code></span>
                            </label>
                            <textarea class="form-control" id="prod-desc" name="description" rows="7" maxlength="2000"
                                oninput="onDesc(this.value)"
                                placeholder="Deskripsikan produkmu secara detail:&#10;&#10;• Bahan baku dan komposisi&#10;• Ukuran / berat / volume&#10;• Keunggulan produk (tanpa pengawet, bersertifikat, dll)&#10;• Masa simpan / kedaluwarsa&#10;• Cara pemesanan dan pengiriman&#10;&#10;Deskripsi yang lengkap mengurangi tanya-jawab via WA dan meningkatkan konversi."></textarea>
                            <div class="ffoot">
                                <span class="form-hint">Min. 50 karakter untuk publikasi.</span>
                                <span class="cc" id="cc-desc">0/2000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ██ 3. HARGA ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon"><i class="fa-solid fa-tag"></i></div>
                        <div>
                            <div class="fcard-title">Harga & Detail Satuan</div>
                            <div class="fcard-sub">Kolom: <code>price DECIMAL(12,2)</code> — harga yang tampil ke
                                pembeli</div>
                        </div>
                    </div>
                    <div class="fcard-body">
                        <div class="fg2">
                            <!-- price (required) -->
                            <div class="form-group">
                                <label class="form-label">Harga Jual <span>*</span></label>
                                <div class="price-row">
                                    <div class="price-pfx">Rp</div>
                                    <input class="form-control" id="prod-price" name="price" type="number"
                                        min="0" step="500" placeholder="65000" oninput="onPrice()">
                                </div>
                                <div class="price-result" id="price-result">
                                    <i class="fa-solid fa-tag fa-xs" style="color:var(--primary);"></i>
                                    Tampil sebagai <strong id="price-fmt"></strong>
                                </div>
                                <span class="form-hint">Kolom <code
                                        style="font-size:.68rem;background:var(--bg);border:1px solid var(--border);padding:0 4px;border-radius:3px;color:var(--primary);">price
                                        DECIMAL(12,2)</code></span>
                            </div>

                            <!-- harga coret (display only) -->
                            <div class="form-group">
                                <label class="form-label">Harga Coret <span
                                        style="font-weight:400;color:var(--dark-light);">(opsional)</span></label>
                                <div class="price-row">
                                    <div class="price-pfx" style="color:var(--dark-light);">Rp</div>
                                    <input class="form-control" id="prod-price-ori" type="number" min="0"
                                        placeholder="80000" oninput="onPrice()">
                                </div>
                                <div class="price-result" id="disc-result">
                                    <i class="fa-solid fa-fire fa-xs" style="color:var(--danger);"></i>
                                    Diskon <strong id="disc-pct"></strong>
                                    <span class="discount-badge" id="disc-badge"></span>
                                </div>
                                <span class="form-hint">Harga asli sebelum diskon, ditampilkan dicoret.</span>
                            </div>
                        </div>

                        <div class="fg3">
                            <div class="form-group">
                                <label class="form-label">Satuan</label>
                                <select class="form-control" id="prod-unit">
                                    <option>pcs / buah</option>
                                    <option>toples</option>
                                    <option>lusin (12 pcs)</option>
                                    <option>kg</option>
                                    <option>gram</option>
                                    <option>liter</option>
                                    <option>ml</option>
                                    <option>paket / set</option>
                                    <option>meter</option>
                                    <option>lembar</option>
                                    <option>porsi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Min. Pemesanan</label>
                                <input class="form-control" type="number" id="prod-moq" value="1"
                                    min="1">
                                <span class="form-hint">1 = min. 1 pcs per pesan</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Berat Produk (gram)</label>
                                <input class="form-control" type="number" id="prod-weight" placeholder="500"
                                    min="1">
                                <span class="form-hint">Termasuk kemasan, untuk ongkir</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ██ 4. STOK ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon green"><i class="fa-solid fa-boxes-stacked"></i></div>
                        <div>
                            <div class="fcard-title">Ketersediaan Stok</div>
                            <div class="fcard-sub">Ditampilkan di halaman produk agar pembeli tahu kondisi stok</div>
                        </div>
                    </div>
                    <div class="fcard-body">
                        <div class="stock-grid">
                            <div class="scard on" id="s-available" onclick="setStock(this,'available')">
                                <span class="s-ico">✅</span>
                                <div class="s-lbl">Ready Stock</div>
                                <div class="s-sub">Tersedia sekarang</div>
                            </div>
                            <div class="scard" id="s-preorder" onclick="setStock(this,'preorder')">
                                <span class="s-ico">🕐</span>
                                <div class="s-lbl">Pre-Order</div>
                                <div class="s-sub">Pesan dulu</div>
                            </div>
                            <div class="scard" id="s-limited" onclick="setStock(this,'limited')">
                                <span class="s-ico">⚠️</span>
                                <div class="s-lbl">Stok Terbatas</div>
                                <div class="s-sub">Hampir habis</div>
                            </div>
                            <div class="scard" id="s-empty" onclick="setStock(this,'empty')">
                                <span class="s-ico">❌</span>
                                <div class="s-lbl">Habis</div>
                                <div class="s-sub">Tidak tersedia</div>
                            </div>
                        </div>
                        <input type="hidden" id="prod-stock" value="available">

                        <!-- Pre-order fields -->
                        <div id="po-fields"
                            style="display:none;margin-top:16px;padding:14px;background:var(--bg);border-radius:var(--radius-md);border:1.5px dashed var(--border);">
                            <label class="form-label" style="margin-bottom:8px;">⏱ Estimasi Waktu Pre-Order</label>
                            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                <input class="form-control" type="number" id="po-days" value="3"
                                    min="1" style="max-width:80px;">
                                <select class="form-control" id="po-unit" style="max-width:130px;">
                                    <option>Hari Kerja</option>
                                    <option>Hari</option>
                                    <option>Minggu</option>
                                </select>
                                <span style="font-size:.82rem;color:var(--dark-mid);">setelah pembayaran
                                    dikonfirmasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ██ 5. INFO TAMBAHAN ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon blue"><i class="fa-solid fa-layer-group"></i></div>
                        <div>
                            <div class="fcard-title">Informasi Tambahan</div>
                            <div class="fcard-sub">Tag pencarian, catatan pengiriman, dan dimensi produk</div>
                        </div>
                    </div>
                    <div class="fcard-body">
                        <!-- Tags -->
                        <div class="form-group">
                            <label class="form-label">Tag / Kata Kunci</label>
                            <div class="tag-wrap" id="tag-wrap"
                                onclick="document.getElementById('tag-input').focus()">
                                <div class="tag-chip">kue kering <span class="tag-x"
                                        onclick="this.parentElement.remove()">✕</span></div>
                                <div class="tag-chip">lebaran <span class="tag-x"
                                        onclick="this.parentElement.remove()">✕</span></div>
                                <input class="tag-input-bare" id="tag-input" placeholder="Tambah tag, tekan Enter..."
                                    onkeydown="addTag(event)">
                            </div>
                            <span class="form-hint">Tekan Enter atau koma untuk tambah. Maks. 10 tag. Membantu pembeli
                                menemukan produk ini.</span>
                        </div>

                        <!-- Shipping note -->
                        <div class="form-group">
                            <label class="form-label">Catatan Pengiriman</label>
                            <textarea class="form-control" id="prod-ship" rows="2"
                                placeholder="Contoh: Dikemas vakum. COD area Semarang. Ekspedisi: JNE, J&T, SiCepat."></textarea>
                        </div>

                        <!-- Dimensions -->
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">Dimensi Kemasan <span
                                    style="font-weight:400;color:var(--dark-light);">(cm, opsional)</span></label>
                            <div class="fg3">
                                <div>
                                    <input class="form-control" type="number" placeholder="Panjang" min="0">
                                    <span class="form-hint" style="text-align:center;display:block;">Panjang</span>
                                </div>
                                <div>
                                    <input class="form-control" type="number" placeholder="Lebar" min="0">
                                    <span class="form-hint" style="text-align:center;display:block;">Lebar</span>
                                </div>
                                <div>
                                    <input class="form-control" type="number" placeholder="Tinggi" min="0">
                                    <span class="form-hint" style="text-align:center;display:block;">Tinggi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ██ 6. VISIBILITAS ██ -->
                <div class="fcard">
                    <div class="fcard-head">
                        <div class="fcard-icon gold"><i class="fa-solid fa-eye"></i></div>
                        <div>
                            <div class="fcard-title">Visibilitas & Status Produk</div>
                            <div class="fcard-sub">Kolom: <code>is_featured BOOLEAN</code> · Status penayangan di
                                katalog</div>
                        </div>
                    </div>
                    <div class="fcard-body">

                        <!-- is_featured -->
                        <div class="feat-row" id="feat-row" onclick="toggleFeat()">
                            <div class="feat-ico">⭐</div>
                            <div class="feat-info">
                                <div class="feat-lbl">Tandai sebagai Produk Unggulan
                                    <code
                                        style="font-size:.68rem;background:rgba(0,0,0,.05);border:1px solid var(--border);padding:1px 5px;border-radius:3px;color:var(--primary);font-family:monospace;margin-left:6px;">is_featured
                                        = true</code>
                                </div>
                                <div class="feat-sub">Produk unggulan tampil di bagian atas halaman toko dan mendapat
                                    3× tayangan lebih banyak</div>
                            </div>
                            <label class="tsw" onclick="event.stopPropagation()">
                                <input type="checkbox" id="prod-feat" name="is_featured" value="1"
                                    onchange="document.getElementById('feat-row').classList.toggle('on',this.checked);updatePreview();">
                                <div class="tsw-track"></div>
                            </label>
                        </div>

                        <!-- Status -->
                        <div style="margin-top:16px;">
                            <label class="form-label">Status Penayangan</label>
                            <div class="status-grid">
                                <div class="stcard on" onclick="setStat(this,'active')">
                                    <span class="st-ico">✅</span>
                                    <div class="st-lbl">Aktif</div>
                                    <div class="st-sub">Tampil di katalog</div>
                                </div>
                                <div class="stcard" onclick="setStat(this,'draft')">
                                    <span class="st-ico">📝</span>
                                    <div class="st-lbl">Draft</div>
                                    <div class="st-sub">Belum tampil</div>
                                </div>
                                <div class="stcard" onclick="setStat(this,'archived')">
                                    <span class="st-ico">📦</span>
                                    <div class="st-lbl">Arsip</div>
                                    <div class="st-sub">Sembunyikan</div>
                                </div>
                            </div>
                            <input type="hidden" id="prod-status" value="active">
                        </div>
                    </div>
                </div>

            </div><!-- end left col -->

            <!-- RIGHT: SIDEBAR -->
            <aside style="position:sticky;top:calc(var(--nav-h)+16px);display:flex;flex-direction:column;gap:18px;">

                <!-- Live Preview -->
                <div>
                    <div
                        style="font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--dark-light);margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
                        <span>Preview Katalog</span>
                        <span id="prev-status-lbl" style="color:var(--success);">● Aktif</span>
                    </div>
                    <div class="preview-card">
                        <div class="prev-img" id="prev-img"
                            style="background:linear-gradient(135deg,#fef3c7,#fed7aa);">
                            <div id="prev-emoji">📦</div>
                            <div class="prev-badges">
                                <span class="prev-badge pb-new">Baru</span>
                                <span class="prev-badge pb-feat" id="pb-feat">⭐ Unggulan</span>
                                <span class="prev-badge pb-disc" id="pb-disc">DISKON</span>
                            </div>
                        </div>
                        <div class="prev-body">
                            <div class="prev-shop-lbl"><i class="fa-solid fa-store fa-xs"></i> Dapur Bu Sari</div>
                            <div class="prev-name" id="prev-name">Nama produk akan tampil di sini...</div>
                            <div class="prev-cat" id="prev-cat">— Pilih kategori —</div>
                            <div class="prev-stock-badge" id="prev-stock" style="background:#d1fae5;color:#065f46;">✅
                                Ready Stock</div>
                            <div class="prev-price">
                                <span id="prev-price">Rp —</span>
                                <span class="prev-ori" id="prev-ori"></span>
                            </div>
                            <button class="prev-wa-btn">
                                <i class="fa-brands fa-whatsapp"></i> Pesan via WhatsApp
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Progress tracker -->
                <div class="prog-box">
                    <div class="prog-title"><i class="fa-solid fa-list-check"></i> Kelengkapan Form</div>
                    <div class="prog-bar-wrap">
                        <div class="prog-bar" id="prog-bar"></div>
                    </div>
                    <div class="prog-pct"><span id="prog-txt">0% lengkap</span><span id="prog-missing"
                            style="color:var(--primary);"></span></div>
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
                            <div class="prog-dot" id="pd-desc">5</div>Deskripsi (min. 50 kar)
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="tips-box">
                    <div class="tips-head">
                        <div class="tips-head-title"><i class="fa-solid fa-lightbulb"></i> Tips Produk Laris</div>
                    </div>
                    <div class="tips-body">
                        <div class="tip-item"><span class="tip-ico">📸</span>Foto latar putih atau bersih meningkatkan
                            klik hingga 40%.</div>
                        <div class="tip-item"><span class="tip-ico">📝</span>Sebutkan berat/ukuran di nama produk agar
                            pembeli tidak bingung.</div>
                        <div class="tip-item"><span class="tip-ico">💰</span>Gunakan harga coret untuk memberi kesan
                            promo meski selisih kecil.</div>
                        <div class="tip-item"><span class="tip-ico">⭐</span>Produk unggulan mendapat posisi teratas di
                            pencarian toko.</div>
                        <div class="tip-item"><span class="tip-ico">🔖</span>Tag yang tepat membantu produk muncul di
                            pencarian kata kunci.</div>
                    </div>
                </div>
            </aside>

        </form><!-- end prod-layout -->
    </div>

    <!-- STICKY SAVE BAR -->
    <div class="save-bar">
        <div class="container">
            <div class="save-bar-inner">
                <div class="save-bar-info">
                    <i class="fa-solid fa-circle-info fa-xs" style="color:var(--primary);"></i>
                    Kolom <span style="color:var(--primary);font-weight:700;">*</span> wajib diisi.
                    <span id="sb-progress" style="margin-left:6px;color:var(--primary);font-weight:600;"></span>
                </div>
                <div class="save-bar-acts">
                    <button class="btn btn-ghost" onclick="saveDraft()">
                        <i class="fa-solid fa-floppy-disk fa-xs"></i> Draft
                    </button>
                    <button class="btn btn-dark" onclick="previewProd()">
                        <i class="fa-solid fa-eye fa-xs"></i> Preview
                    </button>
                    <button type="submit" form="form-create-product" class="btn btn-primary" id="pub-btn">
                        <i class="fa-solid fa-rocket fa-xs"></i> Simpan & Publikasikan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- SUCCESS OVERLAY -->
    <div class="success-overlay" id="success-overlay">
        <div class="success-box">
            <div class="success-emoji">🚀</div>
            <h2>Produk Berhasil Ditambahkan!</h2>
            <p>
                <strong id="suc-name" style="color:var(--primary);"></strong> sudah tampil di katalog tokomu.
                Pembeli bisa langsung chat WhatsApp untuk memesan!
            </p>
            <div class="success-acts">
                <button class="btn btn-primary" onclick="addAnother()">
                    <i class="fa-solid fa-plus"></i> Tambah Produk Lain
                </button>
                <a href="{{ route('shop.manage') }}" class="btn btn-dark">
                    <i class="fa-solid fa-store"></i> Ke Kelola Toko
                </a>
                <a href="product-detail.html" class="btn btn-outline" target="_blank">
                    <i class="fa-solid fa-eye"></i> Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="tw"></div>

    <script>
        /* ═══ STATE ═══ */
        const CATS = {
            1: '🍱 Kuliner & Makanan',
            2: '👗 Fashion & Batik',
            3: '🎨 Kerajinan Tangan',
            4: '🌿 Pertanian & Herbal',
            5: '💆 Kecantikan',
            6: '🪴 Dekorasi',
            7: '📦 Lainnya'
        };
        const IMG_BG = ['linear-gradient(135deg,#fef3c7,#fed7aa)', 'linear-gradient(135deg,#dbeafe,#bfdbfe)',
            'linear-gradient(135deg,#d1fae5,#a7f3d0)', 'linear-gradient(135deg,#ede9fe,#ddd6fe)',
            'linear-gradient(135deg,#fce7f3,#fbcfe8)', 'linear-gradient(135deg,#fee2e2,#fecaca)'
        ];
        let images = []; // [{file, url, emoji, isPrimary, loading}]
        let stockVal = 'available';
        let statusVal = 'active';
        let _syncing = false; // guard to prevent onchange re-trigger from syncFileInput
        const fileInput = document.getElementById('file-input');

        // Attach change listener with re-entry guard
        fileInput.addEventListener('change', function() {
            if (_syncing) return;
            if (this.files && this.files.length) {
                handleFiles(this.files);
            }
        });

        /* ═══ IMAGE UPLOAD ═══ */
        function onDragOver(e) {
            e.preventDefault();
            document.getElementById('drop-zone').classList.add('dragover');
        }

        function onDragLeave(e) {
            document.getElementById('drop-zone').classList.remove('dragover');
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
                // Add a loading placeholder immediately
                images.push({
                    file: f,
                    url: null,
                    emoji: null,
                    isPrimary,
                    loading: true
                });
                renderImageGrid();

                // Read the file asynchronously
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
                            `📸 Foto ${idx + 1} berhasil dimuat${images[idx].isPrimary ? ' sebagai foto utama' : ''}`
                            );
                    }
                    syncFileInput();
                    updateProgress();
                };
                reader.readAsDataURL(f);
            });
            updateProgress();
        }

        function addEmojiSlot(btn, emoji) {
            if (images.length >= 4) {
                toast('Maksimal 4 foto produk', 'err');
                return;
            }
            if (btn) {
                document.querySelectorAll('.ep-btn').forEach(b => b.classList.remove('picked'));
                btn.classList.add('picked');
            }
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
                document.getElementById('prev-emoji').textContent = emoji;
                document.getElementById('prev-emoji').style.display = '';
                const prevImgEl = document.getElementById('prev-img');
                prevImgEl.style.background = IMG_BG[Math.floor(Math.random() * IMG_BG.length)];
                const existingImg = prevImgEl.querySelector('img');
                if (existingImg) existingImg.remove();
            }
            toast(`📸 Foto ${images.length} ditambahkan${isPrimary ? ' sebagai foto utama' : ''}`);
        }

        function updatePreviewImage(url) {
            const prevImgEl = document.getElementById('prev-img');
            const prevEmoji = document.getElementById('prev-emoji');
            prevEmoji.style.display = 'none';
            let img = prevImgEl.querySelector('img');
            if (!img) {
                img = document.createElement('img');
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;position:absolute;inset:0;';
                prevImgEl.appendChild(img);
            }
            img.src = url;
        }

        function removeImg(idx) {
            images.splice(idx, 1);
            images.forEach((img, i) => img.isPrimary = i === 0);
            syncFileInput();
            renderImageGrid();
            updateProgress();
            if (images.length === 0) {
                document.getElementById('prev-emoji').textContent = '📦';
                document.getElementById('prev-emoji').style.display = '';
                document.getElementById('prev-img').style.background = 'linear-gradient(135deg,#fef3c7,#fed7aa)';
                const existingImg = document.getElementById('prev-img').querySelector('img');
                if (existingImg) existingImg.remove();
            } else if (images[0].url) {
                updatePreviewImage(images[0].url);
            } else if (images[0].emoji) {
                document.getElementById('prev-emoji').textContent = images[0].emoji;
                document.getElementById('prev-emoji').style.display = '';
                const existingImg = document.getElementById('prev-img').querySelector('img');
                if (existingImg) existingImg.remove();
            }
        }

        function setMainImg(idx) {
            if (images[idx].loading) return;
            images.forEach((img, i) => img.isPrimary = i === idx);
            renderImageGrid();
            if (images[idx].url) {
                updatePreviewImage(images[idx].url);
            } else if (images[idx].emoji) {
                document.getElementById('prev-emoji').textContent = images[idx].emoji;
                document.getElementById('prev-emoji').style.display = '';
                const existingImg = document.getElementById('prev-img').querySelector('img');
                if (existingImg) existingImg.remove();
            }
            toast('✅ Foto utama diperbarui');
        }

        function syncFileInput() {
            _syncing = true;
            const dt = new DataTransfer();
            images.forEach(img => {
                if (img.file) dt.items.add(img.file);
            });
            fileInput.files = dt.files;
            // Reset flag after a tick to allow future real user changes
            setTimeout(() => {
                _syncing = false;
            }, 50);
        }

        function renderImageGrid() {
            const grid = document.getElementById('img-preview-grid');
            const badge = document.getElementById('img-count-badge');
            badge.textContent = images.length + ' / 4';
            badge.style.background = images.length > 0 ? 'var(--primary)' : '#e2e8f0';
            badge.style.color = images.length > 0 ? 'white' : 'var(--dark-light)';
            let html = images.map((img, i) => {
                if (img.loading) {
                    return `
    <div class="img-preview-item" style="${img.isPrimary?'border-color:var(--primary);box-shadow:0 0 0 2px rgba(253,116,0,.2);':''}cursor:default;">
      <div style="display:flex;flex-direction:column;align-items:center;gap:6px;">
        <div class="img-loading-spinner"></div>
        <span style="font-size:.65rem;color:var(--dark-light);">Memuat...</span>
      </div>
      ${img.isPrimary ? '<div class="img-primary-lbl">Utama</div>' : ''}
    </div>`;
                }
                return `
    <div class="img-preview-item" onclick="setMainImg(${i})" title="${img.isPrimary?'Foto Utama':'Klik untuk jadikan foto utama'}" style="${img.isPrimary?'border-color:var(--primary);box-shadow:0 0 0 2px rgba(253,116,0,.2);':''}${img.url ? 'font-size:0;' : ''}">
      ${img.url ? `<img src="${img.url}" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;border-radius:inherit;">` : (img.emoji || '')}
      <div class="item-del" onclick="event.stopPropagation();removeImg(${i})"><i class="fa-solid fa-xmark"></i></div>
      ${img.isPrimary ? '<div class="img-primary-lbl">Utama</div>' : ''}
    </div>`;
            }).join('');
            if (images.length < 4) html +=
                `<div class="img-add-slot" onclick="document.getElementById('file-input').click()"><i class="fa-solid fa-plus"></i><span>Tambah</span></div>`;
            grid.innerHTML = html;
        }

        /* ═══ NAME / SLUG / DESC ═══ */
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
            const pill = document.getElementById('slug-pill');
            pill.classList.toggle('ok', /^[a-z0-9-]+$/.test(val) && val.length > 0);
            pill.classList.toggle('err', val.length > 0 && !/^[a-z0-9-]+$/.test(val));
        }

        function onDesc(val) {
            const cnt = document.getElementById('cc-desc');
            cnt.textContent = val.length + '/2000';
            cnt.className = 'cc' + (val.length > 1800 ? ' warn' : '') + (val.length >= 2000 ? ' over' : '');
            updateProgress();
        }

        /* ═══ CATEGORY ═══ */
        document.getElementById('prod-cat').addEventListener('change', function() {
            const label = CATS[this.value] || '— Pilih kategori —';
            document.getElementById('prev-cat').textContent = label;
            updateProgress();
        });

        /* ═══ PRICE ═══ */
        function onPrice() {
            const p = parseInt(document.getElementById('prod-price').value) || 0;
            const ori = parseInt(document.getElementById('prod-price-ori').value) || 0;
            // primary price
            const res = document.getElementById('price-result');
            if (p > 0) {
                res.style.display = 'flex';
                document.getElementById('price-fmt').textContent = 'Rp ' + p.toLocaleString('id-ID');
            } else res.style.display = 'none';
            // sidebar
            document.getElementById('prev-price').textContent = p > 0 ? 'Rp ' + p.toLocaleString('id-ID') : 'Rp —';
            // discount
            const oriEl = document.getElementById('prev-ori');
            const dRes = document.getElementById('disc-result');
            const discBadge = document.getElementById('pb-disc');
            if (ori > 0 && ori > p && p > 0) {
                const pct = Math.round((1 - (p / ori)) * 100);
                dRes.style.display = 'flex';
                document.getElementById('disc-pct').textContent = pct + '% lebih hemat';
                document.getElementById('disc-badge').textContent = '-' + pct + '%';
                oriEl.textContent = 'Rp ' + ori.toLocaleString('id-ID');
                oriEl.style.display = 'inline';
                discBadge.style.display = 'inline';
                discBadge.textContent = '-' + pct + '%';
            } else {
                dRes.style.display = 'none';
                oriEl.style.display = 'none';
                discBadge.style.display = 'none';
            }
            updateProgress();
        }

        /* ═══ STOCK ═══ */
        function setStock(el, val) {
            document.querySelectorAll('.scard').forEach(c => c.classList.remove('on'));
            el.classList.add('on');
            stockVal = val;
            document.getElementById('prod-stock').value = val;
            document.getElementById('po-fields').style.display = val === 'preorder' ? 'block' : 'none';
            const labels = {
                available: '✅ Ready Stock',
                preorder: '🕐 Pre-Order',
                limited: '⚠️ Stok Terbatas',
                empty: '❌ Habis'
            };
            const colors = {
                available: 'background:#d1fae5;color:#065f46',
                preorder: 'background:#fef3c7;color:#92400e',
                limited: 'background:#fef3c7;color:#92400e',
                empty: 'background:#fee2e2;color:#991b1b'
            };
            const badge = document.getElementById('prev-stock');
            badge.textContent = labels[val];
            badge.style.cssText = colors[val] +
                ';display:inline-block;font-size:.68rem;font-weight:700;padding:2px 8px;border-radius:var(--radius-full);margin-bottom:4px;';
        }

        /* ═══ FEATURED ═══ */
        function toggleFeat() {
            const cb = document.getElementById('prod-feat');
            cb.checked = !cb.checked;
            document.getElementById('feat-row').classList.toggle('on', cb.checked);
            document.getElementById('pb-feat').style.display = cb.checked ? 'inline' : 'none';
        }

        /* ═══ STATUS ═══ */
        function setStat(el, val) {
            document.querySelectorAll('.stcard').forEach(c => c.classList.remove('on'));
            el.classList.add('on');
            statusVal = val;
            document.getElementById('prod-status').value = val;
            const lbl = document.getElementById('prev-status-lbl');
            const map = {
                active: '● Aktif',
                draft: '○ Draft',
                archived: '◌ Arsip'
            };
            const col = {
                active: 'var(--success)',
                draft: 'var(--warning)',
                archived: 'var(--dark-light)'
            };
            lbl.textContent = map[val];
            lbl.style.color = col[val];
        }

        /* ═══ TAGS ═══ */
        function addTag(e) {
            if (e.key !== 'Enter' && e.key !== ',') return;
            e.preventDefault();
            const inp = document.getElementById('tag-input');
            const val = inp.value.replace(',', '').trim();
            if (!val) return;
            const wrap = document.getElementById('tag-wrap');
            if (wrap.querySelectorAll('.tag-chip').length >= 10) {
                toast('Maks. 10 tag', 'err');
                return;
            }
            const chip = document.createElement('div');
            chip.className = 'tag-chip';
            chip.innerHTML = `${val} <span class="tag-x" onclick="this.parentElement.remove()">✕</span>`;
            wrap.insertBefore(chip, inp);
            inp.value = '';
        }

        /* ═══ PROGRESS TRACKER ═══ */
        function updateProgress() {
            const checks = {
                photo: images.length > 0,
                name: document.getElementById('prod-name').value.trim().length >= 10,
                cat: document.getElementById('prod-cat').value !== '',
                price: parseInt(document.getElementById('prod-price').value) || 0 > 0,
                desc: document.getElementById('prod-desc').value.trim().length >= 50,
            };
            const keys = Object.keys(checks);
            const done = keys.filter(k => checks[k]).length;
            const pct = Math.round((done / keys.length) * 100);
            document.getElementById('prog-bar').style.width = pct + '%';
            document.getElementById('prog-txt').textContent = pct + '% lengkap';
            document.getElementById('sb-progress').textContent = done + '/' + keys.length + ' wajib terisi';
            document.getElementById('prog-missing').textContent = done < keys.length ? (keys.length - done) + ' tersisa' :
                '✅ Siap publikasi';
            keys.forEach(k => {
                const dot = document.getElementById('pd-' + k);
                const item = document.getElementById('pi-' + k);
                if (checks[k]) {
                    dot.classList.add('done');
                    dot.innerHTML = '✓';
                    item.classList.add('done');
                } else {
                    dot.classList.remove('done');
                    dot.innerHTML = {
                        'photo': '1',
                        'name': '2',
                        'cat': '3',
                        'price': '4',
                        'desc': '5'
                    } [k];
                    item.classList.remove('done');
                }
            });
        }
        updateProgress();

        /* ═══ PREVIEW ═══ */
        function updatePreview() {
            const feat = document.getElementById('prod-feat').checked;
            document.getElementById('pb-feat').style.display = feat ? 'inline' : 'none';
        }

        /* ═══ VALIDATE ═══ */
        function validate() {
            const name = document.getElementById('prod-name').value.trim();
            const cat = document.getElementById('prod-cat').value;
            const slug = document.getElementById('prod-slug').value.trim();
            const price = parseFloat(document.getElementById('prod-price').value) || 0;
            const desc = document.getElementById('prod-desc').value.trim();
            const ori = parseFloat(document.getElementById('prod-price-ori').value) || 0;
            if (name.length < 10) return '⚠️ Nama produk wajib diisi (min. 10 karakter).';
            if (!cat) return '⚠️ Pilih kategori produk.';
            if (!/^[a-z0-9-]+$/.test(slug)) return '⚠️ Slug tidak valid. Hanya huruf kecil, angka, dan tanda hubung (-).';
            if (price <= 0) return '⚠️ Harga jual wajib diisi dan harus lebih dari Rp 0.';
            if (desc.length < 50) return '⚠️ Deskripsi wajib diisi (min. 50 karakter).';
            if (ori > 0 && ori <= price) return '⚠️ Harga coret harus lebih besar dari harga jual.';
            return null;
        }

        /* ═══ SUBMIT ═══ */
        function handleFormSubmit(e) {
            const err = validate();
            if (err) {
                e.preventDefault();
                toast(err, 'err');
                return false;
            }

            // Check if still loading images
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
            const topBtn = document.getElementById('top-pub-btn');
            if (topBtn) {
                topBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fa-xs"></i> Mempublikasikan...';
                topBtn.disabled = true;
            }
            // Allow native form submission to proceed
            return true;
        }

        function saveDraft() {
            const name = document.getElementById('prod-name').value.trim();
            if (!name) {
                toast('Isi nama produk untuk menyimpan draft', 'err');
                return;
            }
            toast('📝 Draft "' + name + '" berhasil disimpan');
        }

        function previewProd() {
            const err = validate();
            if (err) {
                toast(err, 'err');
                return;
            }
            window.open('product-detail.html', '_blank');
        }

        function addAnother() {
            document.getElementById('success-overlay').classList.remove('show');
            // reset form
            ['prod-name', 'prod-slug', 'prod-desc', 'prod-price', 'prod-price-ori', 'prod-weight', 'prod-ship'].forEach(
                id => {
                    const el = document.getElementById(id);
                    if (el) el.value = '';
                });
            document.getElementById('prod-cat').value = '';
            images = [];
            renderImageGrid();
            updateProgress();
            document.getElementById('prod-feat').checked = false;
            document.getElementById('feat-row').classList.remove('on');
            document.getElementById('prev-name').textContent = 'Nama produk akan tampil di sini...';
            document.getElementById('prev-price').textContent = 'Rp —';
            document.getElementById('prev-emoji').textContent = '📦';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ═══ TOAST ═══ */
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
    </script>
</body>

</html>
