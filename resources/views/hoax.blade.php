<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Hoax — HAMDANS | Kementerian Hak Asasi Manusia RI</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="Pusat informasi klarifikasi dan debunking berita hoax dari Kementerian Hak Asasi Manusia Republik Indonesia.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0A2B6B;
            --primary-dark: #071E4A;
            --primary-light: #1a4494;
            --primary-50: #EDF1F8;
            --primary-100: #D4DEEF;
            --accent: #C8A951;
            --accent-dark: #A68B2E;
            --accent-50: #FBF7EA;
            --danger: #DC2626;
            --danger-dark: #991B1B;
            --danger-50: #FEF2F2;
            --danger-100: #FECACA;
            --warning: #D97706;
            --success: #16A34A;
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
            margin-top: 70px;
            background: linear-gradient(135deg, rgba(254, 242, 242, 0.4) 0%, rgba(253, 232, 232, 0.3) 100%), url('{{ asset('images/hoax.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 3.5rem 2rem 4rem;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(220,38,38,0.1);
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -60%; right: -5%;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(220,38,38,0.06) 0%, transparent 65%);
            pointer-events: none;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -40%; left: -5%;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(220,38,38,0.04) 0%, transparent 65%);
            pointer-events: none;
        }

        .page-hero-inner {
            max-width: 1100px; margin: 0 auto;
            position: relative; z-index: 2;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.72rem; font-weight: 800; letter-spacing: 0.12em;
            text-transform: uppercase; color: #ffffff;
            background: var(--danger);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 20px; border-radius: 50px; margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(220,38,38,0.25);
        }

        .hero-badge svg { color: #ffffff; opacity: 1; }

        .hero-badge::before { content: ''; width: 6px; height: 6px; background: var(--danger); border-radius: 50%; animation: pulse 1.5s infinite; }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .page-hero h1 {
            font-size: 2.8rem; font-weight: 900; line-height: 1.15;
            color: #ffffff; letter-spacing: -0.03em; margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.25);
        }

        .page-hero h1 span {
            background: linear-gradient(135deg, #DC2626, #991B1B);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .page-hero p {
            color: rgba(255,255,255,0.95); font-size: 1rem; max-width: 580px;
            line-height: 1.8; margin-bottom: 2.5rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* ──── STATS ROW ──── */
        .stats-row {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 10px 20px;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .stat-pill-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .stat-pill-num {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--gray-900);
        }

        .stat-pill-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ──── MAIN CONTENT ──── */
        .main-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 2rem 5rem;
        }

        /* ──── FILTER PANEL ──── */
        .filter-panel {
            background: var(--white);
            border-radius: 18px;
            border: 1px solid rgba(10,43,107,0.07);
            box-shadow: 0 4px 24px rgba(10,43,107,0.05);
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            display: flex; gap: 10px; flex-wrap: wrap; align-items: center;
        }
        .filter-search-wrap { flex: 1; min-width: 200px; position: relative; }
        .filter-search-wrap input {
            width: 100%; border: 1.5px solid var(--gray-200);
            border-radius: 12px; padding: 10px 14px 10px 40px;
            font-size: 0.875rem; font-family: inherit; outline: none;
            background: var(--gray-50); transition: all 0.2s;
            color: var(--gray-800);
        }
        .filter-search-wrap input:focus { border-color: var(--danger); background: #fff; box-shadow: 0 0 0 3px rgba(220,38,38,0.07); }
        .filter-search-wrap input::placeholder { color: var(--gray-400); }
        .search-ico {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: var(--gray-400); pointer-events: none;
        }
        .filter-date { border: 1.5px solid var(--gray-200); border-radius: 12px; padding: 10px 14px; font-size: 0.875rem; font-family: inherit; background: var(--gray-50); outline: none; color: var(--gray-700); transition: all 0.2s; min-width: 140px; }
        .filter-date:focus { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(220,38,38,0.07); }
        .filter-divider { width: 1px; height: 28px; background: var(--gray-200); flex-shrink: 0; }
        .btn-apply {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: 12px;
            font-size: 0.8rem; font-weight: 700; font-family: inherit; letter-spacing: 0.04em;
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            color: #fff; border: none; cursor: pointer; transition: all 0.25s ease;
        }
        .btn-apply:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(220,38,38,0.3); }
        .btn-reset {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 18px; border-radius: 12px;
            font-size: 0.8rem; font-weight: 600; font-family: inherit;
            background: transparent; color: var(--gray-500);
            border: 1.5px solid var(--gray-200); text-decoration: none; transition: all 0.2s;
        }
        .btn-reset:hover { border-color: var(--gray-300); color: var(--gray-700); }

        /* ──── VERDICT TABS ──── */
        .verdict-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }

        .verdict-tab {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: all 0.2s;
        }

        .verdict-tab:hover { transform: translateY(-1px); }
        .verdict-tab.all { background: var(--gray-900); color: white; border-color: var(--gray-900); }
        .verdict-tab.hoax { background: var(--danger-50); color: var(--danger); border-color: var(--danger-100); }
        .verdict-tab.hoax.active { background: var(--danger); color: white; }
        .verdict-tab.menyesatkan { background: #FEF3C7; color: #D97706; border-color: #FDE68A; }
        .verdict-tab.menyesatkan.active { background: #D97706; color: white; }
        .verdict-tab.klarifikasi { background: #DCFCE7; color: var(--success); border-color: #BBF7D0; }
        .verdict-tab.klarifikasi.active { background: var(--success); color: white; }

        /* ──── CARD GRID ──── */
        .hoax-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        /* ──── HOAX CARD ──── */
        .hoax-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .hoax-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(220,38,38,0.1);
            border-color: rgba(220,38,38,0.2);
        }

        .hoax-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .hoax-card-no-image {
            width: 100%;
            height: 160px;
            background: linear-gradient(135deg, #FEF2F2 0%, #FDE8E8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .hoax-card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .hoax-card-verdict {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
            width: fit-content;
        }

        .hoax-card-title {
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.5;
            color: var(--gray-900);
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hoax-card-excerpt {
            font-size: 0.85rem;
            line-height: 1.7;
            color: var(--gray-500);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1.25rem;
            flex: 1;
        }

        .hoax-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-100);
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        .hoax-card-footer span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-arrow {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-400);
            transition: all 0.2s;
        }

        .hoax-card:hover .card-arrow {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        /* ──── EMPTY STATE ──── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            grid-column: 1 / -1;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }

        .empty-state h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.88rem;
            color: var(--gray-400);
        }

        /* ──── PAGINATION ──── */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination-wrap nav {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        /* ════════ FOOTER ════════ */
        .footer {
            margin-top: 4rem;
            position: relative;
            background: linear-gradient(160deg, #0A0F1A 0%, #151B2E 50%, #1E253A 100%);
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
            background: linear-gradient(90deg, #DC2626, var(--danger), #DC2626);
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
        .footer-social a:hover { background: rgba(220,38,38,0.2); color: #ffffff; transform: translateY(-2px); }

        .footer-col { display: flex; flex-direction: column; }
        .footer-col-title {
            font-size: 0.95rem; font-weight: 700; color: #ffffff;
            margin-bottom: 1.25rem; position: relative; display: inline-block;
        }
        .footer-col-title::after {
            content: ''; position: absolute; left: 0; bottom: -6px;
            width: 24px; height: 3px; background: var(--danger); border-radius: 3px;
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
        .footer-bottom .footer-accent { color: var(--danger); font-weight: 700; }

        @media (max-width: 768px) {
            .footer-main { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; }
            .footer-brand { align-items: center; }
            .footer-brand-desc { max-width: 100%; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-link-list a { justify-content: center; }
            .footer-contact-item { justify-content: center; text-align: left; }
            .page-hero { padding: 2.5rem 1.25rem 3rem; }
            .page-hero h1 { font-size: 2rem; }
            .hoax-grid { grid-template-columns: 1fr; }
            .stats-row { gap: 1rem; }
            .main-wrap { padding: 1.5rem 1rem 4rem; }
            .filter-panel { flex-direction: column; align-items: stretch; }
            .filter-search-wrap { min-width: 100%; }
            .filter-divider { display: none; }
        }
    </style>
</head>
<body>

@include("partials.navbar")

<!-- ═══════ HERO ═══════ -->
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="hero-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
            <span data-i18n="hoax_news">Pusat Berita Hoax & Disinformasi</span>
        </div>
        <h1 data-i18n="fact_check_title">Cek Fakta & <span>Anti Hoax</span><br>Kemenham</h1>
        <p data-i18n="hoax_hero_desc">Kementerian Hak Asasi Manusia berkomitmen melawan disinformasi. Temukan klarifikasi resmi dan debunking berita hoax yang berkaitan dengan HAM di Indonesia.</p>

    </div>
</section>

<!-- ═══════ MAIN ═══════ -->
<main class="main-wrap">

    <!-- Filter Panel -->
    <form method="GET" action="{{ route('public.hoax') }}" class="filter-panel">
        <div class="filter-search-wrap">
            <svg class="search-ico" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul berita hoax..." data-i18n-placeholder="search_placeholder_hoax">
        </div>
        <input type="date" name="tanggal_mulai" class="filter-date" value="{{ request('tanggal_mulai') }}" title="Dari Tanggal" data-i18n-title="from_date">
        <input type="date" name="tanggal_akhir" class="filter-date" value="{{ request('tanggal_akhir') }}" title="Sampai Tanggal" data-i18n-title="to_date">
        <div class="filter-divider"></div>
        <button type="submit" class="btn-apply">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="14" height="14"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <span data-i18n="search_btn">Cari</span>
        </button>
        @if(request()->anyFilled(['cari', 'tanggal_mulai', 'tanggal_akhir']))
            <a href="{{ route('public.hoax') }}" class="btn-reset">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="13" height="13"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                <span data-i18n="reset">Reset</span>
            </a>
        @endif
    </form>

    <!-- Hoax Cards -->
    <div class="hoax-grid">
        @forelse($hoaxes as $hoax)
            <a href="{{ route('public.hoax.show', $hoax) }}" class="hoax-card">
                @if($hoax->cover_image)
                    <img src="{{ asset('storage/' . $hoax->cover_image) }}" alt="{{ Str::limit($hoax->title, 60) }}" class="hoax-card-image">
                @else
                    <div class="hoax-card-no-image">⚠️</div>
                @endif

                <div class="hoax-card-body">
                    <h2 class="hoax-card-title">"{{ $hoax->title }}"</h2>

                    <div class="hoax-card-excerpt">
                        {{ Str::limit(strip_tags($hoax->content), 120) }}
                    </div>

                    <div class="hoax-card-footer">
                        <span>
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
                            {{ $hoax->published_at?->translatedFormat('d M Y') ?? $hoax->created_at->translatedFormat('d M Y') }}
                        </span>
                        <div class="card-arrow">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h3 data-i18n="no_hoax_data">Belum ada data berita hoax</h3>
                <p data-i18n="no_hoax_desc">Saat ini belum ada berita hoax yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($hoaxes->hasPages())
        <div class="pagination-wrap">
            {{ $hoaxes->links() }}
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

@include("partials.navbar-scripts")

</body>
</html>
