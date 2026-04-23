<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan — HAMDANS | Kementerian Hak Asasi Manusia RI</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="Daftar seluruh kegiatan harian dari Kantor Wilayah Kementerian Hak Asasi Manusia Republik Indonesia.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Playfair+Display:wght@700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #0A2B6B;
            --primary-dark: #071E4A;
            --primary-light: #1a4494;
            --accent: #C8A951;
            --accent-dark: #A68B2E;
            --accent-light: #E0C46A;
            --white: #FFFFFF;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-400: #94A3B8;
            --gray-500: #64748B;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1E293B;
            --gray-900: #0F172A;
            --radius: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #F0F4F9;
            color: var(--gray-900);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        @include("partials.navbar-css")

        /* ──── HERO HEADER ──── */
        .page-hero {
            margin-top: 64px;
            background: linear-gradient(135deg, rgba(7, 30, 74, 0.4) 0%, rgba(10, 43, 107, 0.3) 100%), url('{{ asset('images/background1.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 120px 2rem 100px;
            position: relative; overflow: hidden;
            border-bottom: 1px solid var(--gray-200);
        }
        .page-hero::before {
            content: '';
            position: absolute; top: -40%; right: -10%;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(10,43,107,0.03) 0%, transparent 70%);
            pointer-events: none;
        }
        .page-hero-inner {
            max-width: 1100px; margin: 0 auto;
            position: relative; z-index: 2;
            display: grid; grid-template-columns: 1fr auto; gap: 3rem; align-items: center;
        }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.7rem; font-weight: 800; letter-spacing: 0.12em;
            text-transform: uppercase; color: #fff;
            background: var(--primary);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 7px 18px; border-radius: 50px; margin-bottom: 1.5rem;
            width: fit-content;
            box-shadow: 0 4px 12px rgba(10,43,107,0.2);
        }
        .hero-eyebrow::before { content: ''; width: 6px; height: 6px; background: var(--primary); border-radius: 50%; }
        .page-hero h1 {
            font-size: 2.8rem; font-weight: 900; line-height: 1.15;
            color: #fff; letter-spacing: -0.03em; margin-bottom: 0.75rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .page-hero h1 em {
            font-style: normal;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .page-hero p {
            color: rgba(255,255,255,0.9); font-size: 1.1rem; max-width: 520px;
            line-height: 1.75; margin-bottom: 2rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        /* ──── SUMMARY STATS ──── */
        .summary-stats {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            position: relative;
            z-index: 2;
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(10, 43, 107, 0.08);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: transform 0.3s ease;
        }
        .summary-card:hover { transform: translateY(-5px); }

        .summary-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
        }

        .summary-icon.blue { background: var(--primary-50); color: var(--primary); }
        .summary-icon.gold { background: var(--accent-50); color: var(--accent-dark); }
        .summary-icon.green { background: #ECFDF5; color: #059669; }

        .summary-content { display: flex; flex-direction: column; }
        .summary-num {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .summary-label {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 600;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ──── PLATFORM TABS (Pill Style) ──── */
        .platform-tabs-wrap {
            position: sticky; top: 64px; z-index: 150;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(10,43,107,0.06);
            box-shadow: 0 2px 16px rgba(10,43,107,0.04);
        }
        .platform-tabs {
            max-width: 1100px; margin: 0 auto; padding: 10px 2rem;
            display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none;
        }
        .platform-tabs::-webkit-scrollbar { display: none; }
        .platform-tab {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px;
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
            text-decoration: none; color: var(--gray-500);
            border-radius: 50px; white-space: nowrap;
            transition: all 0.25s ease; position: relative;
            background: var(--gray-50); border: 1px solid var(--gray-200);
        }
        .platform-tab svg { width: 14px; height: 14px; flex-shrink: 0; }
        .platform-tab:hover { color: var(--gray-800); background: var(--gray-100); border-color: var(--gray-300); }
        .platform-tab.is-active { color: #fff; background: var(--primary); border-color: var(--primary); }
        .platform-tab.is-active-ig { color: #fff; background: #e1306c; border-color: #e1306c; }
        .platform-tab.is-active-yt { color: #fff; background: #FF0000; border-color: #FF0000; }
        .platform-tab.is-active-tt { color: #fff; background: #333; border-color: #333; }
        .platform-tab.is-active-fb { color: #fff; background: #1877F2; border-color: #1877F2; }
        .platform-tab.is-active-tw { color: #fff; background: #333; border-color: #333; }
        .tab-pill {
            font-size: 0.58rem; font-weight: 800;
            padding: 1px 7px; border-radius: 20px;
            background: rgba(255,255,255,0.25); color: inherit; min-width: 22px; text-align: center;
        }
        .platform-tab:not([class*='is-active']) .tab-pill { background: var(--gray-200); color: var(--gray-500); }

        /* ──── BODY ──── */
        .page-body { max-width: 1100px; margin: 0 auto; padding: 2.5rem 2rem 5rem; }
        
        /* ──── FILTER SECTION ──── */
        .filter-section {
            max-width: 1100px;
            margin: 1.5rem auto 3rem;
            position: relative;
            z-index: 10;
        }

        .filter-bar {
            background: var(--white);
            border: 0.5px solid rgba(10, 43, 107, 0.08);
            border-radius: var(--radius);
            padding: 1.75rem 1.5rem;
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
            background: #1D6F42;
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

        .filter-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease, margin 0.3s ease;
            opacity: 0;
            margin-top: 0;
        }

        .filter-dropdown.open {
            max-height: 400px;
            opacity: 1;
            margin-top: 14px;
        }

        .filter-dropdown-inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            padding: 1.25rem;
            background: var(--gray-50);
            border-radius: 12px;
            border: 1px solid var(--gray-100);
        }

        .fd-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .fd-group label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-700);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .fd-group select, .fd-group input {
            height: 42px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1px solid var(--gray-200);
            background: var(--white);
            font-size: 0.88rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .fd-group select:focus, .fd-group input:focus {
            border-color: var(--primary);
        }

        .active-filters {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px dashed var(--gray-200);
        }

        .active-filters .label {
            font-size: 0.8rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        .filter-chip {
            padding: 6px 12px;
            background: var(--primary-50);
            color: var(--primary);
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }px 16px rgba(29, 111, 66, 0.3);
            color: #fff;
        }
        .btn-export svg { width: 14px; height: 14px; }

        /* ──── RESULT META BAR ──── */
        .meta-bar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.5rem; gap: 16px; flex-wrap: wrap;
        }
        .meta-bar-left { display: flex; align-items: center; gap: 12px; }
        .result-label {
            font-size: 0.8rem; color: var(--gray-500);
            display: flex; align-items: center; gap: 6px;
        }
        .result-label strong { color: var(--gray-900); font-weight: 700; }
        .platform-chip {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
            padding: 4px 12px; border-radius: 20px;
            background: rgba(10,43,107,0.07); color: var(--primary);
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

        /* ──── EMPTY ──── */
        .empty-state {
            text-align: center; padding: 6rem 2rem;
            background: var(--white); border-radius: 20px;
            border: 2px dashed var(--gray-200);
            max-width: 470px; margin: 0 auto;
        }
        .empty-state .empty-icon { font-size: 4.5rem; margin-bottom: 1.5rem; filter: grayscale(0.3); }
        .empty-state h3 { font-size: 1.25rem; font-weight: 800; color: var(--gray-800); margin-bottom: 0.5rem; }
        .empty-state p { color: var(--gray-500); font-size: 0.9rem; line-height: 1.6; }
        .empty-state a { color: var(--primary); font-weight: 600; }

        /* ──── PAGINATION ──── */
        .pagination-wrapper { margin-top: 1rem; display: flex; justify-content: center; }
        .pagination-wrapper nav { display: flex; gap: 5px; flex-wrap: wrap; justify-content: center; }
        .pagination-wrapper a,
        .pagination-wrapper span {
            padding: 9px 15px; border-radius: 10px;
            font-size: 0.82rem; font-weight: 600; letter-spacing: 0.02em;
            text-decoration: none; transition: all 0.2s ease;
        }
        .pagination-wrapper a {
            background: var(--white); color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }
        .pagination-wrapper a:hover { background: var(--primary); color: var(--white); border-color: var(--primary); }
        .pagination-wrapper span[aria-current="page"] span,
        .pagination-wrapper .active span {
            background: var(--primary); color: #fff;
            border: 1px solid var(--primary); border-radius: 10px;
        }

        /* ──── CHARTS & DASHBOARD ──── */
        .stats-dashboard {
            max-width: 1100px;
            margin: 0 auto 2.5rem;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 1.5rem;
            padding: 0 2rem;
        }

        .chart-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.75rem;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 20px rgba(10,43,107,0.03);
            display: flex;
            flex-direction: column;
            height: 380px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(10,43,107,0.08);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-title svg {
            color: var(--primary);
            width: 18px;
            height: 18px;
        }

        .chart-badge {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            background: var(--primary-50);
            padding: 4px 10px;
            border-radius: 12px;
        }

        .chart-container {
            flex: 1;
            position: relative;
            min-height: 0;
        }

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
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4A90D9, var(--primary), #4A90D9);
        }

        .footer-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3.5rem 2rem 2.5rem;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1.2fr;
            gap: 3rem;
        }

        .footer-brand { display: flex; flex-direction: column; gap: 1rem; }
        .footer-brand-logo img {
            height: 48px;
            width: auto;
            filter: brightness(0) invert(1) !important;
        }
        .footer-brand-desc { line-height: 1.6; margin-top: 0.5rem; max-width: 320px; }
        .footer-social { display: flex; gap: 12px; margin-top: 0.5rem; }
        .footer-social a {
            display: flex; align-items: center; justify-content: center;
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.7);
            transition: all 0.25s ease;
            text-decoration: none;
        }
        .footer-social a:hover { background: rgba(255,255,255,0.15); color: #ffffff; transform: translateY(-2px); }

        .footer-col { display: flex; flex-direction: column; }
        .footer-col-title {
            font-size: 0.95rem; font-weight: 700; color: #ffffff;
            margin-bottom: 1.25rem; position: relative; display: inline-block;
        }
        .footer-col-title::after {
            content: ''; position: absolute; left: 0; bottom: -6px;
            width: 24px; height: 3px; background: #4A90D9; border-radius: 3px;
        }

        .footer-link-list { list-style: none; margin: 0; padding: 0; }
        .footer-link-list li { margin-bottom: 0.85rem; }
        .footer-link-list a {
            color: rgba(255,255,255,0.7); text-decoration: none;
            display: flex; align-items: center; gap: 8px; transition: all 0.2s;
        }
        .footer-link-list a:hover { color: #ffffff; transform: translateX(3px); }
        .footer-link-list svg { width: 14px; height: 14px; color: #94A3B8; }

        .footer-contact-item { display: flex; gap: 12px; margin-bottom: 1.15rem; }
        .footer-contact-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.1); color: #ffffff;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .footer-contact-icon svg { width: 15px; height: 15px; }
        .footer-contact-text { display: flex; flex-direction: column; gap: 3px; }
        .footer-contact-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #94A3B8; }
        .footer-contact-value { color: #ffffff; font-weight: 500; line-height: 1.4; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 1.25rem 2rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            background: rgba(0,0,0,0.15);
        }
        .footer-bottom p { font-size: 0.72rem; color: rgba(255,255,255,0.85); letter-spacing: 0.04em; margin: 0; text-align: center; }
        .footer-bottom .footer-accent { color: #4A90D9; font-weight: 700; }

        /* ──── RESPONSIVE ──── */
        @media (max-width: 1024px) {
        }
        @media (max-width: 768px) {
            .footer-main { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; }
            .footer-brand { align-items: center; }
            .footer-brand-desc { max-width: 100%; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-link-list a { justify-content: center; }
            .footer-contact-item { justify-content: center; text-align: left; }

            .page-hero { padding: 90px 1.5rem 60px; text-align: center; }
            .hero-eyebrow { margin: 0 auto 1.5rem; }
            .page-hero h1 { font-size: 2rem; }
            .page-hero p { margin: 0 auto 2rem; font-size: 1rem; }
            .summary-stats { grid-template-columns: 1fr; margin-top: 2rem; width: 100%; max-width: 320px; margin-left: auto; margin-right: auto; }
            .summary-card { padding: 1.25rem; }
            .hero-stats-row { justify-content: center; gap: 1.5rem; }
            .page-hero-inner { grid-template-columns: 1fr; }
            
            .ig-feed-container { max-width: 100%; gap: 1.5rem; grid-template-columns: 1fr; }
            .ig-post { border-radius: 0; border-left: none; border-right: none; }
            
            .filter-section { margin: 1rem auto 2.5rem; padding: 0 1rem; }
            .filter-bar { padding: 1.5rem 1rem; }
            .filter-search-row { flex-wrap: wrap; gap: 10px; }
            .filter-search-input { min-width: 100%; }
            .btn-toggle-filter, .btn-search, .btn-reset, .btn-export { flex: 1; justify-content: center; }
            .filter-dropdown-inner { grid-template-columns: 1fr; }
            .platform-tabs { padding: 0 1rem; }

            .stats-dashboard {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }
            .chart-card { height: 350px; }
        }
        }

        /* ──── ANIMATIONS ──── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes heroIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hero-eyebrow { animation: heroIn 0.6s ease 0.1s both; }
        .page-hero h1 { animation: heroIn 0.6s ease 0.2s both; }
        .page-hero p { animation: heroIn 0.6s ease 0.3s both; }
        .summary-stats { animation: heroIn 0.6s ease 0.4s both; }
        .activity-card { animation: fadeInUp 0.5s ease both; }
        .activity-card:nth-child(1) { animation-delay: 0s; }
        .activity-card:nth-child(2) { animation-delay: 0.06s; }
        .activity-card:nth-child(3) { animation-delay: 0.12s; }
        .activity-card:nth-child(4) { animation-delay: 0.18s; }
        .activity-card:nth-child(5) { animation-delay: 0.24s; }
        .activity-card:nth-child(6) { animation-delay: 0.30s; }
        .activity-card:nth-child(7) { animation-delay: 0.36s; }
        .activity-card:nth-child(8) { animation-delay: 0.42s; }
        .activity-card:nth-child(9) { animation-delay: 0.48s; }
        .activity-card:nth-child(10) { animation-delay: 0.54s; }
        .activity-card:nth-child(11) { animation-delay: 0.60s; }
        .activity-card:nth-child(12) { animation-delay: 0.66s; }
        .activity-card:nth-child(13) { animation-delay: 0.72s; }
        .activity-card:nth-child(14) { animation-delay: 0.78s; }
        .activity-card:nth-child(15) { animation-delay: 0.84s; }
    </style>
</head>
<body>

    @include("partials.navbar")

    {{-- HERO HEADER --}}
    <section class="page-hero">
        <div class="page-hero-inner">
            <div>
                <div class="hero-eyebrow">Portal Kegiatan Resmi</div>
                <h1>Seluruh <em>Kegiatan</em><br>Kemenham</h1>
                <p>Rekap kegiatan harian dari seluruh Kantor Wilayah Kementerian Hak Asasi Manusia, dikurasi dari kanal media sosial resmi.</p>
                <div class="summary-stats">
                    <div class="summary-card">
                        <div class="summary-icon gold">
                            📋
                        </div>
                        <div class="summary-content">
                            <span class="summary-num">{{ $activities->total() }}</span>
                            <span class="summary-label">Total Kegiatan</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon green">
                            📅
                        </div>
                        <div class="summary-content">
                            <span class="summary-num">{{ \App\Models\Activity::published()->whereDate('approved_at', today())->count() }}</span>
                            <span class="summary-label">Hari Ini</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon blue">
                            🏛️
                        </div>
                        <div class="summary-content">
                            <span class="summary-num">{{ \App\Models\Office::count() }}</span>
                            <span class="summary-label">Unit Kerja</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PLATFORM TABS --}}
    @php
        $currentPlatform = request('platform', '');
        $platformCounts = \App\Models\Activity::published()
            ->selectRaw('platform, count(*) as total')
            ->groupBy('platform')->pluck('total', 'platform');

        $tabActiveClass = fn($p) => match(true) {
            $p === '' && $currentPlatform === '' => 'is-active',
            $p === 'instagram' && $currentPlatform === 'instagram' => 'is-active-ig is-active',
            $p === 'youtube' && $currentPlatform === 'youtube' => 'is-active-yt is-active',
            $p === 'tiktok' && $currentPlatform === 'tiktok' => 'is-active-tt is-active',
            $p === 'twitter' && $currentPlatform === 'twitter' => 'is-active-tw is-active',
            $p === 'facebook' && $currentPlatform === 'facebook' => 'is-active-fb is-active',
            default => '',
        };
    @endphp

    <div class="platform-tabs-wrap">
        <div class="platform-tabs">
            <a href="{{ route('public.kegiatan', request()->except(['platform','page'])) }}" class="platform-tab {{ $tabActiveClass('') }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M9 12h6M12 9v6"/></svg>
                Semua
                <span class="tab-pill">{{ $platformCounts->sum() }}</span>
            </a>
            @foreach([
                ['instagram','Instagram','#e1306c','<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0z"/>'],
                ['youtube','YouTube','#FF0000','<path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>'],
                ['tiktok','TikTok','#111','<path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>'],
                ['twitter','X / Twitter','#111','<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>'],
                ['facebook','Facebook','#1877F2','<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>'],
            ] as [$p,$label,$color,$svgPath])
            <a href="{{ route('public.kegiatan', array_merge(request()->except(['platform','page']), ['platform'=>$p])) }}"
               class="platform-tab {{ $tabActiveClass($p) }}">
                <svg viewBox="0 0 24 24" fill="currentColor" style="color:{{ $color }}">{!! $svgPath !!}</svg>
                {{ $label }}
                <span class="tab-pill">{{ $platformCounts->get($p, 0) }}</span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- BODY --}}
    <div class="page-body">

        {{-- FILTER PANEL --}}
        {{-- FILTER BAR --}}
        @php
            $activeFilterCount = 0;
            if(request('kanwil')) $activeFilterCount++;
            if(request('dari')) $activeFilterCount++;
            if(request('sampai')) $activeFilterCount++;
        @endphp

        <div class="filter-section">
            <form method="GET" action="{{ route('public.kegiatan') }}">
                @if($currentPlatform)
                    <input type="hidden" name="platform" value="{{ $currentPlatform }}">
                @endif

                <div class="filter-bar">
                    <div class="filter-search-row">
                        <div class="filter-search-input">
                            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            <input type="text" name="cari" placeholder="Cari kegiatan, kantor, atau topik..." value="{{ request('cari') }}">
                        </div>

                        <button type="button" class="btn-toggle-filter" onclick="toggleFilter()" id="btnToggleFilter">
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

                        @if(request()->hasAny(['cari','kanwil','dari','sampai']))
                            <a href="{{ route('public.kegiatan', $currentPlatform ? ['platform'=>$currentPlatform] : []) }}" class="btn-reset" title="Reset">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                            </a>
                            <a href="{{ route('public.export', request()->query()) }}" class="btn-export" title="Export Excel">
                                <svg fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M21.17 3.25Q21.5 3.25 21.76 3.5 22 3.74 22 4.08V19.92Q22 20.26 21.76 20.5 21.5 20.75 21.17 20.75H7.83Q7.5 20.75 7.24 20.5 7 20.26 7 19.92V17H2.83Q2.5 17 2.24 16.74 2 16.5 2 16.17V7.83Q2 7.5 2.24 7.24 2.5 7 2.83 7H7V4.08Q7 3.74 7.24 3.5 7.5 3.25 7.83 3.25H21.17M8.5 19.25H20.5V4.75H8.5V7H10.5V9H8.5V11H10.5V13H8.5V15H10.5V17H8.5V19.25M4.46 15.14L6.14 11.23L4.17 8.5H5.8L6.89 10.15L8 8.5H9.46L7.38 11.23L9.16 15.14H7.66L6.81 12.89L5.94 15.14H4.46Z"/></svg>
                            </a>
                        @endif
                    </div>

                    <div class="filter-dropdown" id="filterDropdown">
                        <div class="filter-dropdown-inner">
                            <div class="fd-group">
                                <label data-i18n="sort_unit">Unit Kerja</label>
                                <select name="kanwil">
                                    <option value="">Semua Unit</option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}" {{ request('kanwil') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fd-group">
                                <label data-i18n="date_start">Dari Tanggal</label>
                                <input type="date" name="dari" value="{{ request('dari') }}">
                            </div>
                            <div class="fd-group">
                                <label data-i18n="date_end">Sampai Tanggal</label>
                                <input type="date" name="sampai" value="{{ request('sampai') }}">
                            </div>
                        </div>

                        @if(request()->hasAny(['kanwil','dari','sampai']))
                        <div class="active-filters">
                            <span class="label">Filter Aktif:</span>
                            @if(request('kanwil'))
                                <span class="filter-chip">Unit: {{ $offices->find(request('kanwil'))?->name }}</span>
                            @endif
                            @if(request('dari'))
                                <span class="filter-chip">Dari: {{ request('dari') }}</span>
                            @endif
                            @if(request('sampai'))
                                <span class="filter-chip">Sampai: {{ request('sampai') }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- CHARTS DASHBOARD --}}
        <div class="stats-dashboard">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        Trend Kegiatan (7 Hari Terakhir)
                    </div>
                    <div class="chart-badge">Live Data</div>
                </div>
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        Distribusi per Platform
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="platformChart"></canvas>
                </div>
            </div>
        </div>

        {{-- RESULT META BAR --}}
        <div class="meta-bar">
            <div class="meta-bar-left">
                <p class="result-label">
                    Menampilkan <strong>{{ $activities->firstItem() ?? 0 }}–{{ $activities->lastItem() ?? 0 }}</strong>
                    dari <strong>{{ $activities->total() }}</strong> kegiatan
                </p>
                @if($currentPlatform)
                    <span class="platform-chip">{{ ucfirst($currentPlatform) }}</span>
                @endif
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

                        {{-- Body (Actions + Caption) --}}
                        <div class="ig-post-body">
                            <div class="ig-caption">
                                <span>{{ $officeName }}</span>
                                <div class="ig-caption-text">{{ $activity->extracted_title }}</div>
                                <div>
                                    <a href="{{ route('public.show', $activity) }}" style="color: var(--gray-500); font-size: 0.82rem; font-weight: 500; text-decoration: none; display: inline-block; margin-top: 4px;">Lihat selengkapnya...</a>
                                </div>
                            </div>

                            <div class="ig-time">
                                {{ ($activity->approved_at ?? $activity->created_at)->diffForHumans() }} • {{ ($activity->approved_at ?? $activity->created_at)->translatedFormat('H:i') }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">{{ $activities->links() }}</div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <h3>Tidak Ada Kegiatan Ditemukan</h3>
                <p>Coba ubah filter pencarian atau <a href="{{ route('public.kegiatan') }}">reset semua filter</a>.</p>
            </div>
        @endif
    </div>

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

    @include("partials.navbar-scripts")

    <script>
        function toggleFilter() {
            const dropdown = document.getElementById('filterDropdown');
            const btn = document.getElementById('btnToggleFilter');
            if (dropdown && btn) {
                dropdown.classList.toggle('open');
                btn.classList.toggle('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Trend Chart
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($trendLabels) !!},
                    datasets: [{
                        label: 'Jumlah Kegiatan',
                        data: {!! json_encode($trendValues) !!},
                        borderColor: '#0A2B6B',
                        backgroundColor: 'rgba(10, 43, 107, 0.05)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0A2B6B',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            padding: 12,
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 13 },
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, color: '#94A3B8', font: { size: 11 } },
                            grid: { borderDash: [5, 5], color: 'rgba(148, 163, 184, 0.1)' }
                        },
                        x: {
                            ticks: { color: '#94A3B8', font: { size: 11 } },
                            grid: { display: false }
                        }
                    }
                }
            });

            // Platform Chart
            const platformCtx = document.getElementById('platformChart').getContext('2d');
            const platformLabels = {!! json_encode($platformData->keys()) !!};
            const platformValues = {!! json_encode($platformData->values()) !!};
            
            // Map labels to human-friendly names and colors
            const platformConfig = {
                'instagram': { label: 'Instagram', color: '#e1306c' },
                'youtube': { label: 'YouTube', color: '#FF0000' },
                'tiktok': { label: 'TikTok', color: '#111111' },
                'twitter': { label: 'X / Twitter', color: '#111111' },
                'facebook': { label: 'Facebook', color: '#1877F2' }
            };

            const colors = platformLabels.map(p => platformConfig[p]?.color || '#94A3B8');
            const labels = platformLabels.map(p => platformConfig[p]?.label || p.charAt(0).toUpperCase() + p.slice(1));

            new Chart(platformCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: platformValues,
                        backgroundColor: colors,
                        hoverOffset: 15,
                        borderRadius: 5,
                        spacing: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: { size: 11, weight: '600' },
                                color: '#475569'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            padding: 12,
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 13 }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
