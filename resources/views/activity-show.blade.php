<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Str::limit($activity->extracted_title, 60) }} — HAM DAILY NEWS (HAMDANS)</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="{{ Str::limit($activity->extracted_title, 160) }}">

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

        /* ──── Hero Image Banner ──── */
        .article-hero {
            margin-top: 70px;
            position: relative;
            width: 100%;
            height: 50vh;
            min-height: 380px;
            max-height: 600px;
            overflow: hidden;
            background: var(--gray-900);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-bg-blur {
            position: absolute;
            top: -15%; left: -15%; right: -15%; bottom: -15%;
            background-size: cover;
            background-position: center;
            filter: blur(40px) brightness(0.5);
            opacity: 0.9;
            z-index: 1;
            transform: scale(1.1);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.8) 100%);
            z-index: 2;
        }

        .article-hero img {
            position: relative;
            z-index: 3;
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5));
            padding: 2rem 2rem 4rem; /* Extra padding at bottom for overlap overlap */
            transform: scale(0.98);
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-hero:hover img {
            transform: scale(1);
        }

        .no-image-hero {
            margin-top: 70px;
            width: 100%;
            height: 280px;
            background: linear-gradient(135deg, var(--gray-900) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            position: relative;
            overflow: hidden;
        }
        .no-image-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 60%);
        }

        /* ──── Meta Tags ──── */
        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 1.25rem;
        }

        .platform-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .platform-instagram { color: #e1306c; background: rgba(225,48,108,0.08); }
        .platform-tiktok { color: #111; background: rgba(0,0,0,0.05); }
        .platform-twitter { color: #111; background: rgba(0,0,0,0.05); }
        .platform-facebook { color: #1877F2; background: rgba(24,119,242,0.08); }
        .platform-youtube { color: #FF0000; background: rgba(255,0,0,0.08); }
        .platform-other { color: var(--gray-600); background: var(--gray-100); }

        .hero-title {
            font-size: 2.3rem;
            font-weight: 800;
            line-height: 1.35;
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .hero-date {
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--gray-100);
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .hero-date svg {
            width: 16px;
            height: 16px;
            color: var(--primary);
        }

        /* ──── Article Body ──── */
        .article-container {
            max-width: 900px;
            margin: -80px auto 0; /* Overlap the hero */
            padding: 0 2rem 4rem;
            position: relative;
            z-index: 10;
        }

        .title-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 20px 40px rgba(10,43,107,0.08);
            margin-bottom: 2.5rem;
            text-align: center;
        }

        /* ──── Content Block ──── */
        .content-card {
             background: var(--white);
             border-radius: 24px;
             padding: 3rem;
             box-shadow: 0 4px 24px rgba(0,0,0,0.03);
             border: 1px solid var(--gray-100);
             margin-bottom: 2.5rem;
             position: relative;
        }
        .content-card::before {
             content: '"';
             position: absolute;
             top: 1rem; left: 1.5rem;
             font-size: 8rem;
             color: var(--gray-50);
             font-family: Georgia, serif;
             line-height: 1;
             z-index: 0;
        }
        .content-card p {
             font-size: 1.05rem;
             line-height: 1.9;
             color: var(--gray-700);
             white-space: pre-line;
             margin: 0;
             position: relative;
             z-index: 1;
        }

        /* ──── Info Cards Row ──── */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .info-card {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--gray-100);
            box-shadow: 0 4px 24px rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(10,43,107,0.08);
            border-color: var(--primary-100);
        }

        .info-card-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
        }

        .info-card-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .info-card-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.4;
        }

        .info-card-icon.user { background: var(--primary-50); color: var(--primary); }
        .info-card-icon.time { background: rgba(217,119,6,0.1); color: #D97706; }
        .info-card-icon.office { background: var(--accent-50); color: var(--accent-dark); }
        .info-card-icon.unit { background: rgba(124,58,237,0.1); color: #7C3AED; }

        /* ──── Source Link Section ──── */
        .source-section {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 24px rgba(0,0,0,0.03);
            overflow: hidden;
            margin-bottom: 2.5rem;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .source-header-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-bottom: 1rem;
        }

        .source-header-icon svg {
            width: 20px;
            height: 20px;
        }

        .source-header-text {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .source-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 1rem 1.5rem;
            background: var(--gray-50);
            border-radius: 14px;
            border: 1px solid var(--gray-200);
            text-decoration: none;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            word-break: break-all;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 100%;
        }

        .source-link:hover {
            background: var(--primary-50);
            border-color: var(--primary-100);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10,43,107,0.06);
        }

        .source-link svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .source-link .arrow {
            margin-left: auto;
            opacity: 0.5;
            transition: all 0.2s;
        }

        .source-link:hover .arrow {
            opacity: 1;
            transform: translateX(4px);
        }

        /* ──── Back Button ──── */
        .back-section {
            display: flex;
            justify-content: center;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            border-radius: 16px;
            background: var(--white);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.95rem;
            border: 1px solid var(--gray-200);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        }

        .back-link svg {
            width: 20px;
            height: 20px;
            transition: transform 0.2s;
        }

        .back-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(10,43,107,0.25);
        }

        .back-link:hover svg {
            transform: translateX(-4px);
        }

        /* ──── Title card for no-image ──── */
        .title-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2.5rem;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 4px 20px rgba(10,43,107,0.04);
            margin-bottom: 2rem;
        }

        .title-card h1 {
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.4;
            color: var(--gray-900);
            letter-spacing: -0.01em;
        }

        .title-card .title-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--gray-100);
        }

        .title-card .platform-badge {
            color: initial;
            backdrop-filter: none;
        }
        .title-card .platform-instagram { color: #e1306c; background: rgba(225,48,108,0.06); }
        .title-card .platform-tiktok { color: #111; background: rgba(0,0,0,0.04); }
        .title-card .platform-twitter { color: #111; background: rgba(0,0,0,0.04); }
        .title-card .platform-facebook { color: #1877F2; background: rgba(24,119,242,0.06); }
        .title-card .platform-youtube { color: #FF0000; background: rgba(255,0,0,0.06); }
        .title-card .platform-other { color: var(--gray-600); background: var(--gray-100); }

        .title-card .tag-office {
            background: var(--accent-50);
            color: var(--accent-dark);
        }

        .title-card .hero-date {
            color: var(--gray-400);
        }

        /* ════════ FOOTER ════════ */
        .footer {
            margin-top: 0;
            position: relative;
            background: #f8fafc;
            color: var(--gray-600);
            font-size: 0.84rem;
            overflow: hidden;
            border-top: 1px solid var(--gray-200);
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
            background: var(--gray-100);
            color: var(--gray-600);
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .footer-social a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-col-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gray-900);
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
            color: var(--gray-600);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .footer-link-list a:hover {
            color: var(--primary);
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
            background: var(--primary-50);
            color: var(--primary);
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
            color: var(--gray-900);
            font-weight: 500;
            line-height: 1.4;
        }

        .footer-bottom {
            border-top: 1px solid var(--gray-100);
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: var(--white);
        }

        .footer-bottom p {
            font-size: 0.72rem;
            color: var(--gray-400);
            letter-spacing: 0.04em;
            margin: 0;
        }

        .footer-accent {
            color: var(--primary);
            font-weight: 600;
        }

        /* ──── Responsive ──── */
        @media (max-width: 768px) {
            .article-hero { height: auto; min-height: 250px; }
            .article-hero img { padding: 1rem 1rem 3rem; }
            .hero-title { font-size: 1.6rem; }
            .article-container { padding: 0 1rem 3rem; margin-top: -40px; }
            .title-card { padding: 2rem 1.5rem; border-radius: 20px; }
            .content-card { padding: 2rem 1.5rem; border-radius: 20px; }
            .info-cards { grid-template-columns: 1fr; gap: 1rem; }
            .source-section { padding: 1.5rem; }
            .footer-main { grid-template-columns: 1fr; text-align: center; }
            .footer-brand { align-items: center; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-contact-item { justify-content: center; }
        }

        /* ──── Animations ──── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .article-hero { animation: fadeIn 0.6s ease both; }
        .info-cards .info-card:nth-child(1) { animation: fadeInUp 0.5s ease 0.1s both; }
        .info-cards .info-card:nth-child(2) { animation: fadeInUp 0.5s ease 0.2s both; }
        .info-cards .info-card:nth-child(3) { animation: fadeInUp 0.5s ease 0.3s both; }
        .source-section { animation: fadeInUp 0.5s ease 0.35s both; }
        .back-section { animation: fadeInUp 0.5s ease 0.4s both; }
        .title-card { animation: fadeInUp 0.5s ease 0.15s both; }
    </style>
</head>
<body>

    @include("partials.navbar")

    @php
        $hasImage = $activity->foto_dokumentasi || $activity->extracted_image;
        $imageUrl = $activity->foto_dokumentasi
            ? asset('storage/' . $activity->foto_dokumentasi)
            : $activity->extracted_image;
    @endphp

    @if($hasImage)
        <!-- ═══════ HERO IMAGE ═══════ -->
        <div class="article-hero">
            <div class="hero-bg-blur" style="background-image: url('{{ $imageUrl }}');"></div>
            <div class="hero-overlay"></div>
            <img src="{{ $imageUrl }}" alt="{{ Str::limit($activity->extracted_title, 80) }}">
        </div>
    @else
        <!-- ═══════ NO IMAGE HERO ═══════ -->
        <div class="no-image-hero">
            {{ $activity->platform?->icon() ?? '🔗' }}
        </div>
    @endif

    <!-- ═══════ ARTICLE CONTENT ═══════ -->
    <div class="article-container">
        <!-- Title Card (always shown below image) -->
        <div class="title-card">
            <div class="hero-meta">
                <span class="platform-badge platform-{{ strtolower($activity->platform?->value ?? 'other') }}">
                    {{ $activity->platform?->icon() }} {{ $activity->platform?->label() }}
                </span>
            </div>
            <h1 class="hero-title">{{ $activity->extracted_title ?? 'Kegiatan Kementerian HAM' }}</h1>
            <div class="hero-date">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
                {{ $activity->approved_at?->isoFormat('D MMMM YYYY, HH:mm') ?? '-' }}
            </div>
        </div>

        @if($activity->description)
        <div class="content-card">
            <p>{{ $activity->description }}</p>
        </div>
        @endif

        <!-- ─── Info Cards ─── -->
        <div class="info-cards">
            <div class="info-card">
                <div class="info-card-icon user">👤</div>
                <div class="info-card-label" data-i18n="submitted_by">Disubmit oleh</div>
                <div class="info-card-value">{{ $activity->user?->name ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-icon time">⏱️</div>
                <div class="info-card-label" data-i18n="approved">Disetujui</div>
                <div class="info-card-value">{{ $activity->approved_at?->translatedFormat('H:i') ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-icon office">🏛️</div>
                <div class="info-card-label" data-i18n="office_label">Kantor Wilayah</div>
                <div class="info-card-value">{{ $activity->office?->name ?? '-' }}</div>
            </div>
        </div>

        <!-- ─── Source Link ─── -->
        @if($activity->social_media_url)
        <div class="source-section">
            <div class="source-header">
                <div class="source-header-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </div>
                <span class="source-header-text" data-i18n="source">Sumber Asli</span>
            </div>
            <div class="source-body">
                <a href="{{ $activity->social_media_url }}" target="_blank" rel="noopener" class="source-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    {{ $activity->social_media_url }}
                    <svg class="arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>
        </div>
        @endif

        <!-- ─── Back ─── -->
        <div class="back-section">
            <a href="{{ route('public.index') }}" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                <span data-i18n="back_portal">Kembali ke Portal</span>
            </a>
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
                    Portal Kegiatan Harian Kementerian Hak Asasi Manusia Republik Indonesia.
                </p>
                <div class="footer-social">
                    <a href="https://www.instagram.com/kemaborham/" target="_blank" title="Instagram">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@KemenkumhamChannel" target="_blank" title="YouTube">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://x.com/kemaborham" target="_blank" title="X / Twitter">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@kemaborham" target="_blank" title="TikTok">
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
            <p>&copy; {{ date('Y') }} <span class="footer-accent">HAMDANS</span> — <span data-i18n="footer">Kementerian Hak Asasi Manusia Republik Indonesia</span></p>
        </div>
    </footer>

    @include("partials.navbar-scripts")

</body>
</html>
