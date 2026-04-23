<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAM DAILY NEWS (HAMDANS) — Portal Kegiatan Harian Kemenham</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="Portal agregasi kegiatan harian Kementerian Hak Asasi Manusia dari seluruh Kantor Wilayah di Indonesia.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* 🎨 Navy + Golden Yellow — Unified Palette */
            --primary: #0A2B6B;
            --primary-dark: #071E4A;
            --primary-light: #1a4494;
            --primary-50: #EDF1F8;
            --primary-100: #D4DEEF;
            --accent: #C8A951;
            --accent-dark: #A68B2E;
            --accent-light: #E0C46A;
            --accent-50: #FBF7EA;
            --white: #FFFFFF;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-400: #94A3B8;
            --gray-500: #64748B;
            --gray-700: #334155;
            --gray-800: #1E293B;
            --gray-900: #0F172A;
            --radius: 16px;
            --shadow-sm: 0 1px 3px rgba(10, 43, 107, 0.04), 0 1px 2px rgba(0,0,0,0.02);
            --shadow-md: 0 4px 16px rgba(10, 43, 107, 0.07), 0 2px 4px rgba(0,0,0,0.03);
            --shadow-lg: 0 12px 40px rgba(10, 43, 107, 0.1), 0 4px 12px rgba(0,0,0,0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, public_sans_6a10ae;
            background: #FFFFFF;
            color: var(--gray-900);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        @include("partials.navbar-css")
        /* ════════ HERO ════════ */
        .hero {
            padding: 120px 2rem 80px;
            position: relative;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.2) 0%, rgba(238, 242, 247, 0.15) 100%), url('{{ asset('images/background1.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: auto;
            border-bottom: 1px solid var(--gray-200);
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(10,43,107,0.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            gap: 4rem;
            padding: 2rem 0;
        }

        .hero-content {
            flex: 1;
            max-width: 680px;
            animation: heroFadeIn 0.7s ease both;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4A90D9;
            background: rgba(74, 144, 217, 0.08);
            border: 1px solid rgba(74, 144, 217, 0.15);
            padding: 8px 20px;
            border-radius: 50px;
            margin-bottom: 2rem;
            width: fit-content;
        }
        .hero-eyebrow::before {
            content: '';
            width: 5px; height: 5px;
            background: #4A90D9;
            border-radius: 50%;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.7); }
        }

        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.2rem);
            font-weight: 900;
            color: #071E4A;
            line-height: 1.1;
            letter-spacing: -0.04em;
            margin-bottom: 1.5rem;
        }
        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes heroFadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-tagline {
            font-size: 1.1rem;
            font-weight: 400;
            color: #ffffff;
            max-width: 100%;
            line-height: 1.8;
            margin: 0 0 2.5rem 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.15);
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: #071E4A;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(7, 30, 74, 0.2);
        }
        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(10,43,107,0.35);
        }
        .hero-cta svg { width: 16px; height: 16px; }

        /* Stats */
        .stats-row {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            width: auto;
            flex-shrink: 0;
            animation: heroFadeIn 0.7s ease 0.15s both;
        }

        .stat {
            width: 420px;
            padding: 1.5rem 2rem;
            text-align: left;
            background: var(--white);
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(7, 30, 74, 0.08);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #EDF5FF;
            color: #071E4A;
        }

        .stat:nth-child(2) .stat-icon { background: rgba(200, 169, 81, 0.12); color: #B38F2B; }
        .stat:nth-child(3) .stat-icon { background: rgba(16, 185, 129, 0.1); color: #059669; }

        .stat-icon svg { width: 22px; height: 22px; }

        a.stat-link {
            text-decoration: none;
            color: inherit;
            display: contents;
        }

        .stat-text { display: flex; flex-direction: column; }

        .stat-num {
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a1a;
            line-height: 1;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 0.72rem;
            color: #888;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }


        /* ──── Filters ──── */
        .filter-section {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        .filter-bar {
            background: var(--white);
            border: 0.5px solid rgba(10, 43, 107, 0.08);
            border-radius: var(--radius);
            padding: 1.25rem;
            box-shadow: 0 4px 20px rgba(10, 43, 107, 0.05), 0 1px 4px rgba(0,0,0,0.02);
            transition: box-shadow 0.3s ease;
        }

        .filter-bar:hover {
            box-shadow: 0 8px 30px rgba(10, 43, 107, 0.08), 0 2px 8px rgba(0,0,0,0.03);
        }

        .filter-search-row {
            display: flex;
            gap: 10px;
            align-items: stretch;
        }

        .filter-search-input {
            flex: 1;
            position: relative;
        }

        .filter-search-input input {
            width: 100%;
            height: 46px;
            padding: 0 16px 0 44px;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.88rem;
            font-family: inherit;
            color: var(--gray-900);
            background: var(--gray-50);
            outline: none;
            transition: all 0.25s ease;
        }

        .filter-search-input input:focus {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(10,43,107,0.06);
        }

        .filter-search-input .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            pointer-events: none;
        }

        .btn-toggle-filter {
            height: 46px;
            padding: 0 18px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1px solid var(--gray-200);
            background: var(--white);
            color: var(--gray-700);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .btn-toggle-filter:hover {
            border-color: var(--primary-light);
            color: var(--primary);
            background: var(--primary-50);
        }

        .btn-toggle-filter.active {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-50);
        }

        .btn-toggle-filter .chevron {
            transition: transform 0.3s ease;
        }

        .btn-toggle-filter.active .chevron {
            transform: rotate(180deg);
        }

        .filter-count-badge {
            background: var(--primary);
            color: var(--white);
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
        }

        .btn-search {
            height: 46px;
            padding: 0 22px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .btn-search:hover {
            box-shadow: 0 4px 16px rgba(10, 43, 107, 0.3);
            transform: translateY(-1px);
        }

        .btn-reset {
            height: 46px;
            padding: 0 18px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: inherit;
            border: 1.5px solid var(--gray-200);
            background: var(--white);
            color: var(--gray-600);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-reset:hover {
            border-color: var(--gray-300);
            background: var(--gray-50);
        }

        .btn-export {
            height: 46px;
            padding: 0 18px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 700;
            font-family: inherit;
            background: #1D6F42; /* Excel Green */
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(29, 111, 66, 0.2);
        }

        .btn-export:hover {
            background: #155231;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(29, 111, 66, 0.3);
            color: #fff;
        }

        .btn-export svg { width: 16px; height: 16px; }

        .filter-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease, margin 0.3s ease;
            opacity: 0;
            margin-top: 0;
        }

        .filter-dropdown.open {
            max-height: 300px;
            opacity: 1;
            margin-top: 14px;
        }

        .filter-dropdown-inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            padding: 20px;
            background: var(--gray-50);
            border-radius: 12px;
            border: 1px solid var(--gray-100);
        }

        .filter-dropdown-inner .fd-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-dropdown-inner .fd-group label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .filter-dropdown-inner select,
        .filter-dropdown-inner input[type="date"] {
            height: 40px;
            padding: 0 12px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-size: 0.84rem;
            font-family: inherit;
            color: var(--gray-900);
            background: var(--white);
            outline: none;
            transition: all 0.2s ease;
            width: 100%;
        }

        .filter-dropdown-inner select:focus,
        .filter-dropdown-inner input[type="date"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(10,43,107,0.08);
        }

        .active-filters {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .active-filters .label {
            font-size: 0.72rem;
            color: var(--gray-400);
            font-weight: 600;
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 14px;
            background: var(--primary-50);
            color: var(--primary-dark);
            border: 1px solid var(--primary-100);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ──── Section ──── */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.75rem 2rem 2rem;
        }

        /* ════════ SECTION HEADER ════════ */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.25rem 1.5rem;
            background: var(--white);
            border-radius: 16px;
            border: 0.5px solid rgba(10, 43, 107, 0.06);
            box-shadow: 0 2px 12px rgba(10, 43, 107, 0.04);
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary), var(--accent));
            border-radius: 4px 0 0 4px;
        }

        .section-header h2 {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -0.01em;
            padding-left: 4px;
        }

        .section-header .count-badge {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 5px 14px;
            border-radius: 50px;
            margin-left: 12px;
            box-shadow: 0 2px 8px rgba(10,43,107,0.2);
        }

        .view-modes {
            display: flex;
            align-items: center;
            background: var(--gray-50);
            padding: 4px;
            border-radius: 10px;
            gap: 4px;
            border: 0.5px solid var(--gray-200);
        }

        .view-btn {
            background: transparent;
            border: none;
            color: var(--gray-400);
            padding: 7px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-btn:hover {
            color: var(--gray-700);
            background: rgba(10,43,107,0.04);
        }

        .view-btn.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(10,43,107,0.08);
        }

        /* ──── IG FEED ──── */
        .ig-feed-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            padding-bottom: 2rem;
        }

        .ig-post {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }

        .ig-post-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
        }

        .ig-post-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ig-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.7rem; font-weight: 800;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .ig-avatar.platform-instagram { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
        .ig-avatar.platform-youtube { background: #FF0000; }
        .ig-avatar.platform-tiktok { background: #111; }
        .ig-avatar.platform-twitter { background: #111; }
        .ig-avatar.platform-facebook { background: #1877F2; }

        .ig-username {
            font-size: 0.85rem; font-weight: 600; color: var(--gray-900);
            line-height: 1.2;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;
        }
        .ig-location {
            font-size: 0.7rem; color: var(--gray-500);
            line-height: 1; margin-top: 2px;
        }

        .ig-post-media {
            width: 100%;
            aspect-ratio: 4 / 5;
            background: var(--gray-100);
            position: relative;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            border-top: 0.5px solid rgba(0,0,0,0.05);
            border-bottom: 0.5px solid rgba(0,0,0,0.05);
        }
        
        .ig-post-media img {
            width: 100%; height: 100%; object-fit: cover;
        }

        .ig-post-body {
            padding: 14px;
        }

        .ig-caption {
            font-size: 0.85rem; line-height: 1.5; color: var(--gray-900);
            margin-bottom: 6px;
        }
        .ig-caption span { font-weight: 600; margin-right: 4px; }
        .ig-caption-text { display: inline; }

        .ig-time {
            font-size: 0.65rem; color: var(--gray-400); text-transform: uppercase;
            letter-spacing: 0.05em; font-weight: 600; margin-top: 6px;
        }

        /* ──── Pagination ──── */
        .pagination-wrapper {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav { display: flex; gap: 4px; }

        .pagination-wrapper a,
        .pagination-wrapper span {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination-wrapper a {
            background: var(--white);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .pagination-wrapper a:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .pagination-wrapper span[aria-current="page"] span,
        .pagination-wrapper .active span {
            background: var(--primary);
            color: var(--white);
            border: 1px solid var(--primary);
            border-radius: 8px;
        }

        /* ──── Empty ──── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            border: 2px dashed var(--gray-200);
            border-radius: var(--radius);
            background: var(--white);
        }
        .empty-state .icon { font-size: 3.5rem; margin-bottom: 1rem; }
        .empty-state h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .empty-state p { color: var(--gray-500); font-size: 0.9rem; }

        /* ════════ FOOTER ════════ */
        .footer {
            margin-top: 4rem;
            position: relative;
            background: linear-gradient(160deg, #060E1F 0%, #0A1A3A 50%, #0E2348 100%);
            color: rgba(255,255,255,0.7);
            font-size: 0.84rem;
            overflow: hidden;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-light), var(--primary), var(--primary-light));
        }

        .footer-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3.5rem 2rem 2.5rem;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1.2fr;
            gap: 3rem;
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-brand-logo img {
            height: 48px;
            width: auto;
            filter: brightness(0) invert(1) !important;
        }

        .footer-brand-desc {
            line-height: 1.6;
            margin-top: 0.5rem;
            max-width: 320px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
            margin-top: 0.5rem;
        }

        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.7);
            transition: all 0.25s ease;
        }

        .footer-social a:hover {
            background: rgba(255,255,255,0.15);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-col-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.25rem;
            position: relative;
            display: inline-block;
        }

        .footer-col-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 24px;
            height: 3px;
            background: var(--accent);
            border-radius: 3px;
        }

        .footer-link-list {
            list-style: none;
        }

        .footer-link-list li {
            margin-bottom: 0.85rem;
        }

        .footer-link-list a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .footer-link-list a:hover {
            color: #ffffff;
            transform: translateX(3px);
        }

        .footer-link-list svg {
            width: 14px;
            height: 14px;
            color: var(--gray-400);
        }

        .footer-contact-item {
            display: flex;
            gap: 12px;
            margin-bottom: 1.15rem;
        }

        .footer-contact-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .footer-contact-icon svg {
            width: 15px;
            height: 15px;
        }

        .footer-contact-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .footer-contact-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-400);
        }

        .footer-contact-value {
            color: #ffffff;
            font-weight: 500;
            line-height: 1.4;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 1.25rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: rgba(0,0,0,0.15);
        }

        .footer-bottom p {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.85);
            letter-spacing: 0.04em;
            margin: 0;
        }

        .footer-bottom .footer-accent {
            color: #4A90D9;
            font-weight: 700;
        }



        /* ──── Responsive ──── */
        @media (max-width: 1024px) {
            .card-grid { grid-template-columns: 1fr; }
            .filter-dropdown-inner { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 768px) {

            
            .hero-content {
                padding: 100px 1.5rem 5rem;
            }
            .hero-content h1 { font-size: 2.5rem; }
            .content-wrapper { padding: 0 1rem; }
            .stat-card { min-width: 140px; }
            
            .ig-feed-container { max-width: 100%; gap: 1.5rem; grid-template-columns: 1fr; }
            .ig-post { border-radius: 0; border-left: none; border-right: none; }

            .section-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .view-modes { width: 100%; justify-content: flex-start; }
            
            .filter-panel { padding: 1rem; border-radius: 12px; }
            .filter-main { grid-template-columns: 1fr; gap: 10px; }
            .filter-search-input input { padding: 12px 14px 12px 40px; font-size: 0.95rem; }
            .filter-dropdown-inner {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {    .filter-dropdown-inner { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 1rem; }
            .hero { padding: 90px 1.25rem 60px; }
            .hero-inner { flex-direction: column; gap: 2.5rem; text-align: center; }
            .hero-eyebrow { margin-left: auto; margin-right: auto; }
            .hero-tagline { max-width: 100%; margin-left: auto; margin-right: auto; }
            .hero-cta { margin: 0 auto; }
            .hero-title { font-size: 1.8rem; }
            .stats-row { flex-direction: column; gap: 0.8rem; width: 100%; align-items: center; }
            .stat { width: 100%; max-width: 320px; }
            .card-grid { grid-template-columns: 1fr; }
            .activity-card { flex-direction: column; }
            .main-content { padding: 1.5rem 1rem; }
            .filter-section { padding: 0.75rem; margin-top: 0; }
            .filter-bar { overflow: hidden; padding: 0.85rem; border-width: 1.5px; }
            .filter-search-row { flex-wrap: wrap; gap: 8px; }
            .filter-search-input { min-width: 100%; }
            .btn-toggle-filter { flex: 1; justify-content: center; }
            .btn-search { flex: 1; justify-content: center; }
            .btn-reset { flex: 1; justify-content: center; }
            .filter-dropdown-inner { grid-template-columns: 1fr; }
            .section-header { flex-direction: column; gap: 0.5rem; align-items: flex-start; }
            .navbar-actions { gap: 6px; }
            .btn-login { padding: 8px 14px; font-size: 0.75rem; }
            .footer-main { grid-template-columns: 1fr; text-align: center; }
            .footer-brand { align-items: center; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-contact-item { justify-content: center; }
        }
    </style>
</head>
<body>

    @include("partials.navbar")

    <!-- ═══════ HERO ═══════ -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-content">

                <h1 class="hero-title" data-i18n="hero_title">Portal Kegiatan Harian Kemenham</h1>
                <p class="hero-tagline" data-i18n="hero_desc">Portal agregasi kegiatan harian dari seluruh Kantor Wilayah Kementerian Hak Asasi Manusia di Indonesia. Konten dikurasi langsung dari media sosial resmi.</p>
                <a href="{{ route('public.kegiatan') }}" class="hero-cta">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                    <span data-i18n="hero_cta">Lihat Kegiatan</span>
                </a>
            </div>
            <div class="stats-row">
                <a href="{{ route('public.kegiatan') }}" class="stat-link">
                <div class="stat">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 14l2 2 4-4"/></svg>
                    </div>
                    <div class="stat-text">
                        <div class="stat-num" data-count="{{ $activities->total() }}">0</div>
                        <div class="stat-label" data-i18n="activities">Kegiatan</div>
                    </div>
                </div>
                </a>
                <a href="{{ route('public.offices') }}" class="stat-link">
                <div class="stat">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9h1"/><path d="M9 13h1"/><path d="M9 17h1"/></svg>
                    </div>
                    <div class="stat-text">
                        <div class="stat-num" data-count="{{ \App\Models\Office::count() }}">0</div>
                        <div class="stat-label" data-i18n="regional_offices">Unit Kerja</div>
                    </div>
                </div>
                </a>
                <a href="/?hari_ini=1#activities" class="stat-link">
                <div class="stat">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/><path d="M12 14h.01"/></svg>
                    </div>
                    <div class="stat-text">
                        <div class="stat-num" data-count="{{ \App\Models\Activity::published()->whereDate('approved_at', today())->count() }}">0</div>
                        <div class="stat-label" data-i18n="today">Hari Ini</div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════ FILTERS ═══════ -->
    <div class="filter-section">
        <div class="filter-bar">
            <form method="GET" action="{{ url('/') }}" id="filterForm">
                <div class="filter-search-row">
                    <div class="filter-search-input">
                        <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input type="text" name="cari" placeholder="Cari kegiatan..." value="{{ request('cari') }}">
                    </div>

                    @php
                        $activeFilterCount = collect(['kanwil', 'unit', 'dari', 'sampai', 'hari_ini'])->filter(fn($f) => request()->filled($f))->count();
                    @endphp

                    <button type="button" class="btn-toggle-filter {{ $activeFilterCount > 0 ? 'active' : '' }}" onclick="toggleFilter()" id="btnToggleFilter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        <span data-i18n="filter">Filter</span>
                        @if($activeFilterCount > 0)
                            <span class="filter-count-badge">{{ $activeFilterCount }}</span>
                        @endif
                        <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>

                    <button type="submit" class="btn-search">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span data-i18n="search_btn">Cari</span>
                    </button>

                    @if(request()->hasAny(['cari', 'kanwil', 'dari', 'sampai', 'hari_ini']))
                        <a href="{{ url('/') }}" class="btn-reset" data-i18n="reset">Reset</a>
                    @endif
                </div>

                <div class="filter-dropdown {{ $activeFilterCount > 0 ? 'open' : '' }}" id="filterDropdown">
                    <div class="filter-dropdown-inner">
                        <div class="fd-group">
                            <label for="kanwil" data-i18n="kanwil_label">Unit Kerja</label>
                            <select name="kanwil" id="kanwil">
                                <option value="">Semua Unit</option>
                                @foreach($offices as $office)
                                    <option value="{{ $office->id }}" {{ request('kanwil') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="fd-group">
                            <label for="dari" data-i18n="from_date">Dari Tanggal</label>
                            <input type="date" name="dari" id="dari" value="{{ request('dari') }}">
                        </div>

                        <div class="fd-group">
                            <label for="sampai" data-i18n="to_date">Sampai Tanggal</label>
                            <input type="date" name="sampai" id="sampai" value="{{ request('sampai') }}">
                        </div>
                    </div>
                </div>
            </form>

            @if(request()->hasAny(['cari', 'kanwil', 'dari', 'sampai', 'hari_ini']))
                <div class="active-filters">
                    <span class="label" data-i18n="active_filters">Filter aktif:</span>
                    @if(request('hari_ini'))
                        <span class="filter-chip" style="background: rgba(200,169,81,0.12); color: #A68B2E; font-weight: 700;">📅 <span data-i18n="today">Hari Ini</span></span>
                    @endif
                    @if(request('cari'))
                        <span class="filter-chip">"{{ request('cari') }}"</span>
                    @endif
                    @if(request('kanwil'))
                        <span class="filter-chip">{{ $offices->firstWhere('id', request('kanwil'))?->name }}</span>
                    @endif

                    @if(request('dari'))
                        <span class="filter-chip"><span data-i18n="chip_from">Dari</span>: {{ request('dari') }}</span>
                    @endif
                    @if(request('sampai'))
                        <span class="filter-chip"><span data-i18n="chip_to">Sampai</span>: {{ request('sampai') }}</span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>


        // ──── Filter Dropdown ────
        function toggleFilter() {
            const dropdown = document.getElementById('filterDropdown');
            const btn = document.getElementById('btnToggleFilter');
            dropdown.classList.toggle('open');
            btn.classList.toggle('active');
        }
    </script>

    <!-- ═══════ MAIN ═══════ -->
    <main class="main-content" id="activities">
        <div class="section-header">
            <div>
                <h2 data-i18n="latest_activities">Kegiatan Terbaru</h2>
                <span class="count-badge"><span>{{ $activities->total() }}</span> <span data-i18n="published">dipublikasikan</span></span>
            </div>
        </div>

        {{-- IG FEED --}}
        @if($activities->count())
            <div class="ig-feed-container">
                @foreach($activities as $activity)
                    @php
                        $hasImage = $activity->foto_dokumentasi || $activity->extracted_image;
                        $imgSrc = $activity->foto_dokumentasi
                            ? asset('storage/' . $activity->foto_dokumentasi)
                            : $activity->extracted_image;
                        $pVal = strtolower($activity->platform?->value ?? 'other');
                        $officeName = $activity->office?->name ?? 'Kemenham';
                        $avatarClasses = 'ig-avatar platform-' . $pVal;
                    @endphp
                    <div class="ig-post">
                        
                        {{-- Header --}}
                        <div class="ig-post-header">
                            <div class="ig-post-user">
                                <div class="{{ $avatarClasses }}">
                                    @if($pVal === 'instagram')
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0z"/></svg>
                                    @elseif($pVal === 'youtube')
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @elseif($pVal === 'tiktok')
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                    @elseif($pVal === 'twitter')
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    @elseif($pVal === 'facebook')
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    @else
                                        {{ substr($officeName, 0, 2) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="ig-username">{{ $officeName }}</div>
                                    <div class="ig-location">{{ $activity->platform?->label() ?? 'Portal Berita' }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Media --}}
                        <div class="ig-post-media">
                            @if($hasImage)
                                <img src="{{ $imgSrc }}" alt="Kegiatan" loading="lazy">
                            @else
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; background: linear-gradient(145deg, var(--primary), var(--primary-dark)); font-size: 5rem;">
                                    {{ $activity->platform?->icon() ?? '🔗' }}
                                </div>
                            @endif
                        </div>

                        {{-- Body (Caption) --}}
                        <div class="ig-post-body">
                            <div class="ig-caption">
                                <span>{{ $officeName }}</span>
                                <div class="ig-caption-text">{{ $activity->extracted_title }}</div>
                                <div>
                                    <a href="{{ route('public.show', $activity) }}" data-i18n="read_more" style="color: var(--gray-500); font-size: 0.82rem; font-weight: 500; text-decoration: none; display: inline-block; margin-top: 4px;">Lihat selengkapnya...</a>
                                </div>
                            </div>

                            <div class="ig-time">
                                {{ ($activity->approved_at ?? $activity->created_at)->diffForHumans() }} • {{ ($activity->approved_at ?? $activity->created_at)->translatedFormat('H:i') }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $activities->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="icon">📭</div>
                <h3 data-i18n="no_results">Tidak Ada Kegiatan Ditemukan</h3>
                <p data-i18n="no_results_desc">Coba ubah filter pencarian atau <a href="{{ url('/') }}" style="color: var(--blue); font-weight: 600;">reset semua filter</a>.</p>
            </div>
        @endif
    </main>

    <!-- ═══════ FOOTER ═══════ -->
    <footer class="footer">
        <div class="footer-main">
            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-brand-logo">
                    <img src="{{ asset('images/logo_header.png') }}" alt="Logo">
                </div>
                <p class="footer-brand-desc" data-i18n="footer_desc">
                    Portal Kegiatan Harian Kementerian Hak Asasi Manusia Republik Indonesia. Menampilkan kegiatan dan publikasi resmi dari seluruh Unit Kerja.
                </p>
                <div class="footer-social">
                    <a href="https://www.instagram.com/kemenham/" target="_blank" title="Instagram">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@kementerian_ham" target="_blank" title="YouTube">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://x.com/kemenham" target="_blank" title="X / Twitter">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@kementerianhm" target="_blank" title="TikTok">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="footer-col">
                <h4 class="footer-col-title" data-i18n="footer_links">Tautan</h4>
                <ul class="footer-link-list">
                    <li><a href="{{ url('/') }}"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4"/></svg> <span data-i18n="nav_home">Beranda</span></a></li>
                    <li><a href="https://kemenham.go.id" target="_blank"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg> <span data-i18n="official_website">Website Resmi</span></a></li>

                    <li><a href="{{ url('/admin') }}"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg> <span data-i18n="nav_login">Login Admin</span></a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="footer-col">
                <h4 class="footer-col-title" data-i18n="contact_us">Hubungi Kami</h4>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div class="footer-contact-text">
                        <span class="footer-contact-label" data-i18n="phone">Telepon</span>
                        <span class="footer-contact-value">021 - 2526153</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="footer-contact-text">
                        <span class="footer-contact-label">Email</span>
                        <span class="footer-contact-value"> info@kemenham.go.id</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="footer-contact-text">
                        <span class="footer-contact-label" data-i18n="our_address">Alamat</span>
                        <span class="footer-contact-value">Jl. HR. Rasuna Said Kav 4-5<br>Kuningan, Jakarta Selatan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <span class="footer-accent">HAMDANS</span> — <span data-i18n="footer">Kementerian Hak Asasi Manusia Republik Indonesia</span></p>
        </div>
    </footer>

    <script>
        const heroVideo = document.getElementById('heroBgVideo');
        if (heroVideo) {
            heroVideo.addEventListener('timeupdate', function() {
                // To avoid loop stutter, reset to start slightly before it ends
                if (this.currentTime >= this.duration - 0.15) {
                    this.currentTime = 0;
                    this.play();
                }
            });
        }
    </script>

    @include("partials.navbar-scripts")

    <script>
        // ──── Relative Time in ID/EN ────
        function relativeTime(isoString, lang) {
            const now = new Date();
            const date = new Date(isoString);
            const diffMs = now - date;
            const seconds = Math.floor(diffMs / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);
            const weeks = Math.floor(days / 7);
            const months = Math.floor(days / 30);
            const years = Math.floor(days / 365);

            const labels = {
                id: {
                    just_now: 'baru saja',
                    seconds: s => `${s} detik yang lalu`,
                    minutes: m => `${m} menit yang lalu`,
                    hours: h => `${h} jam yang lalu`,
                    days: d => `${d} hari yang lalu`,
                    weeks: w => `${w} minggu yang lalu`,
                    months: m => `${m} bulan yang lalu`,
                    years: y => `${y} tahun yang lalu`,
                },
                en: {
                    just_now: 'just now',
                    seconds: s => `${s} second${s > 1 ? 's' : ''} ago`,
                    minutes: m => `${m} minute${m > 1 ? 's' : ''} ago`,
                    hours: h => `${h} hour${h > 1 ? 's' : ''} ago`,
                    days: d => `${d} day${d > 1 ? 's' : ''} ago`,
                    weeks: w => `${w} week${w > 1 ? 's' : ''} ago`,
                    months: m => `${m} month${m > 1 ? 's' : ''} ago`,
                    years: y => `${y} year${y > 1 ? 's' : ''} ago`,
                }
            };

            const l = labels[lang] || labels.id;

            if (seconds < 10) return l.just_now;
            if (seconds < 60) return l.seconds(seconds);
            if (minutes < 60) return l.minutes(minutes);
            if (hours < 24) return l.hours(hours);
            if (days < 7) return l.days(days);
            if (weeks < 5) return l.weeks(weeks);
            if (months < 12) return l.months(months);
            return l.years(years);
        }

        function updateRelativeTimes(lang) {
            document.querySelectorAll('.relative-time[data-time]').forEach(el => {
                el.textContent = relativeTime(el.dataset.time, lang);
            });
        }

        // ──── Animated Count-Up ────
        function animateCountUp(el) {
            const target = parseInt(el.getAttribute('data-count')) || 0;
            const duration = 1800;
            const start = performance.now();

            function easeOutExpo(t) {
                return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
            }

            function tick(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = easeOutExpo(progress);
                el.textContent = Math.round(eased * target);
                if (progress < 1) requestAnimationFrame(tick);
            }

            requestAnimationFrame(tick);
        }

        // Trigger count-up when stats are visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.stat-num[data-count]').forEach(el => {
                        animateCountUp(el);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        // Initialize language on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('hamdans_lang') || 'id';
            setLang(savedLang);

            // Start observing the stats row
            const statsRow = document.querySelector('.stats-row');
            if (statsRow) statsObserver.observe(statsRow);
        });
    </script>

</body>
</html>
