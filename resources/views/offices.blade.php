<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantor Wilayah — HAM DAILY NEWS (HAMDANS)</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="Daftar Kantor Wilayah dan Unit Kerja Kementerian Hak Asasi Manusia Republik Indonesia">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            --accent-light: #E0C46A;
            --accent-50: #FBF7EA;
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
            background: var(--gray-50);
            color: var(--gray-900);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        @include("partials.navbar-css")

        /* ──── Page Header ──── */
        .page-header {
            margin-top: 64px;
            background: linear-gradient(135deg, rgba(7, 30, 74, 0.45) 0%, rgba(10, 43, 107, 0.35) 100%), url('{{ asset('images/background1.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 5rem 2rem 6rem;
            position: relative;
            overflow: hidden;
        }

        /* Abstract Shapes */
        .shape {
            position: absolute;
            filter: blur(80px);
            opacity: 0.08;
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }
        .shape-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; right: -50px; }
        .shape-2 { width: 300px; height: 300px; background: var(--accent); bottom: -50px; left: -50px; }

        .page-header-inner {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 2.8rem;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 1rem;
            letter-spacing: -0.04em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .page-header p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
            max-width: 700px;
            line-height: 1.7;
            text-shadow: 0 1px 2px rgba(0,0,0,0.15);
        }

        /* ──── Search Box ──── */
        .search-container {
            max-width: 600px;
            margin: 2.5rem 0 0;
            position: relative;
            z-index: 2;
        }
        .search-inner { position: relative; display: flex; align-items: center; }
        .search-inner svg {
            position: absolute;
            left: 18px;
            color: rgba(255,255,255,0.7);
            pointer-events: none;
        }
        .search-inner input {
            width: 100%;
            height: 56px;
            padding: 0 16px 0 52px;
            border-radius: 16px;
            border: 1.5px solid rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            font-size: 1rem;
            font-family: inherit;
            color: #ffffff;
            outline: none;
            transition: all 0.25s ease;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }
        .search-inner input::placeholder { color: rgba(255,255,255,0.6); }
        .search-inner input:focus {
            background: rgba(255,255,255,0.25);
            border-color: #ffffff;
            box-shadow: 0 8px 32px rgba(10, 43, 107, 0.2);
        }

        /* ──── Summary Stats ──── */
        .summary-stats {
            max-width: 1100px;
            margin: 4rem auto 0;
            padding: 0 2rem;
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

        /* ──── Grid ──── */
        .offices-container {
            max-width: 1100px;
            margin: 4.5rem auto 0;
            padding: 0 2rem 5rem;
        }

        .offices-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.5rem;
        }

        .office-card {
            background: var(--white);
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            padding: 1.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .office-card.hidden { display: none; }

        .office-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(10, 43, 107, 0.12);
            border-color: var(--primary-100);
        }

        .office-card::after {
            content: '';
            position: absolute; top: 0; left: 0; width: 4px; height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
            opacity: 0; transition: opacity 0.3s ease;
        }
        .office-card:hover::after { opacity: 1; }

        .office-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .office-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--primary-50);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.25rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        .office-card:hover .office-avatar { transform: scale(1.1) rotate(-5deg); }

        .office-info { flex: 1; min-width: 0; }
        .office-name {
            font-size: 1rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1.3;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .office-location {
            font-size: 0.75rem;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .office-badge {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 700;
            background: #ECFDF5;
            color: #059669;
            border: 1px solid rgba(5, 150, 105, 0.1);
        }

        .office-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px dashed var(--gray-200);
        }

        .office-stat {
            background: var(--gray-50);
            border-radius: 12px;
            padding: 0.85rem;
            text-align: center;
            transition: background 0.3s ease;
        }
        .office-card:hover .office-stat { background: var(--white); border: 1px solid var(--gray-100); }

        .office-stat-num {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
        }

        .office-stat-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 6px;
        }

        .office-stat.today .office-stat-num { color: var(--accent-dark); }

        /* ──── Footer ──── */
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
            width: 24px; height: 3px; background: var(--accent); border-radius: 3px;
        }

        .footer-link-list { list-style: none; margin: 0; padding: 0; }
        .footer-link-list li { margin-bottom: 0.85rem; }
        .footer-link-list a {
            color: rgba(255,255,255,0.7); text-decoration: none;
            display: flex; align-items: center; gap: 8px; transition: all 0.2s;
        }
        .footer-link-list a:hover { color: #ffffff; transform: translateX(3px); }
        .footer-link-list svg { width: 14px; height: 14px; color: var(--gray-400); }

        .footer-contact-item { display: flex; gap: 12px; margin-bottom: 1.15rem; }
        .footer-contact-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.1); color: #ffffff;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .footer-contact-icon svg { width: 15px; height: 15px; }
        .footer-contact-text { display: flex; flex-direction: column; gap: 3px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.05); padding: 2rem; text-align: center; }
        .footer-bottom p { font-size: 0.85rem; color: rgba(255,255,255,0.5); }
        .footer-brand-text { color: var(--primary-light); font-weight: 800; margin-right: 4px; }

        /* ──── Responsive ──── */
        @media (max-width: 768px) {
            .page-header { 
                padding: 4.5rem 1.5rem 6.5rem; 
                text-align: left;
                margin-top: 56px;
            }
            .page-header h1 { font-size: 2.1rem; color: #ffffff; }
            .page-header p { font-size: 1rem; color: rgba(255, 255, 255, 0.9); margin: 0; line-height: 1.6; }

            .search-container { margin: 2rem 0 0; }
            .search-inner input { 
                height: 50px; 
                font-size: 0.95rem; 
                border-radius: 14px; 
                background: rgba(255,255,255,0.2); 
                border-color: rgba(255,255,255,0.3); 
                color: #ffffff; 
            }
            .search-inner input::placeholder { color: rgba(255,255,255,0.5); }
            .search-inner svg { color: rgba(255,255,255,0.8); left: 18px; }
            .search-inner input:focus { background: rgba(255,255,255,0.3); border-color: #ffffff; }
            
            .summary-stats { 
                display: flex;
                flex-direction: column;
                padding: 0;
                margin-top: 3rem;
                gap: 1.25rem;
            }
            .summary-card { 
                width: 100%;
                min-width: unset;
                padding: 1.25rem 1.5rem;
                box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            }
            .summary-stats::-webkit-scrollbar { display: none; /* Chrome/Safari */ }
            
            .summary-card { 
                min-width: 240px; 
                flex-shrink: 0; 
                scroll-snap-align: center; 
                padding: 1.15rem;
                box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            }
            .summary-icon { width: 44px; height: 44px; font-size: 1.25rem; }
            .summary-num { font-size: 1.5rem; }

            .offices-container { padding: 0 1.25rem 4rem; }
            .offices-grid { grid-template-columns: 1fr; gap: 0.85rem; }
            .office-card { padding: 1.25rem; gap: 1.25rem; }
            .office-avatar { width: 40px; height: 40px; font-size: 1rem; }
            .office-name { font-size: 0.95rem; }
            .office-stat-num { font-size: 1.15rem; }
            .office-badge { top: 1rem; right: 1rem; padding: 3px 8px; font-size: 0.6rem; }

            .footer-main { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; }
            .footer-brand { align-items: center; }
            .footer-brand-desc { max-width: 100%; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-link-list a { justify-content: center; }
            .footer-contact-item { justify-content: center; text-align: left; }
        }

        /* ──── Animations ──── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .summary-card { animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) both; }
        .summary-card:nth-child(1) { animation-delay: 0.1s; }
        .summary-card:nth-child(2) { animation-delay: 0.2s; }
        .summary-card:nth-child(3) { animation-delay: 0.3s; }
        
        .office-card { animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) both; }
    </style>
</head>
<body>

    @include("partials.navbar")

    <!-- ═══════ HEADER ═══════ -->
    <div class="page-header">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="page-header-inner">
            <h1 data-i18n="offices_page_title">Unit Kerja & Kantor Wilayah</h1>
            <p data-i18n="offices_page_desc">Daftar seluruh Kantor Wilayah dan Unit Kerja Kementerian Hak Asasi Manusia yang terintegrasi dalam portal kegiatan harian.</p>
            
            <div class="search-container">
                <div class="search-inner">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="officeSearch" placeholder="Cari Unit Kerja..." data-i18n-placeholder="office_search_placeholder">
                </div>
            </div>

            <!-- ═══════ SUMMARY STATS ═══════ -->
            <div class="summary-stats">
                <div class="summary-card">
                    <div class="summary-icon blue">🏛️</div>
                    <div class="summary-content">
                        <div class="summary-num">{{ $offices->count() }}</div>
                        <div class="summary-label" data-i18n="total_offices">Total Kantor</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon gold">📋</div>
                    <div class="summary-content">
                        <div class="summary-num">{{ $totalActivities }}</div>
                        <div class="summary-label" data-i18n="total_activities">Total Kegiatan</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon green">📅</div>
                    <div class="summary-content">
                        <div class="summary-num">{{ $totalToday }}</div>
                        <div class="summary-label" data-i18n="today_activities">Kegiatan Hari Ini</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ═══════ OFFICES GRID ═══════ -->
    <div class="offices-container">
        <div class="offices-grid">
            @foreach($offices as $i => $office)
                <a href="{{ route('public.index', ['kanwil' => $office->id]) }}" class="office-card" style="animation-delay: {{ 0.05 * $i }}s">
                    <div class="office-card-header">
                        <div class="office-avatar">🏛️</div>
                        <div class="office-info">
                            <div class="office-name">{{ $office->name }}</div>
                            @if($office->tempat_kedudukan)
                                <div class="office-location">📍 {{ $office->tempat_kedudukan }}</div>
                            @endif
                        </div>
                        @if($office->today_count > 0)
                            <span class="office-badge">🟢 {{ $office->today_count }} <span data-i18n="today_label">hari ini</span></span>
                        @endif
                    </div>
                    <div class="office-stats">
                        <div class="office-stat">
                            <div class="office-stat-num">{{ $office->published_count }}</div>
                            <div class="office-stat-label" data-i18n="activities_label">Kegiatan</div>
                        </div>
                        <div class="office-stat today">
                            <div class="office-stat-num">{{ $office->today_count }}</div>
                            <div class="office-stat-label" data-i18n="today_label2">Hari Ini</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
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
            <p>&copy; {{ date('Y') }} <span class="footer-brand-text">HAMDANS</span> — <span data-i18n="footer">Kementerian Hak Asasi Manusia Republik Indonesia</span></p>
        </div>
    </footer>

    @include("partials.navbar-scripts")

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const officeSearch = document.getElementById('officeSearch');
            const officeCards = document.querySelectorAll('.office-card');

            if (officeSearch) {
                officeSearch.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();

                    officeCards.forEach(card => {
                        const name = card.querySelector('.office-name').textContent.toLowerCase();
                        const location = card.querySelector('.office-location')?.textContent.toLowerCase() || '';

                        if (name.includes(query) || location.includes(query)) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    });
                });
            }
        });
    </script>

</body>
</html>
