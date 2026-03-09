<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Str::limit($activity->extracted_title, 60) }} — HAM DAILY NEWS (HAMDANS)</title>
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

        /* ──── Navbar ──── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            height: 64px;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 0.5px solid rgba(10,43,107,0.06);
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 24px rgba(10,43,107,0.06);
            background: rgba(255,255,255,0.97);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(10, 43, 107, 0.3);
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
            transition: transform 0.2s;
        }

        .btn-back:hover svg {
            transform: translateX(-3px);
        }

        /* ──── Hero Image Banner ──── */
        .article-hero {
            margin-top: 64px;
            position: relative;
            width: 100%;
            overflow: hidden;
            background: var(--gray-900);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .article-hero img {
            width: 100%;
            height: auto;
            max-height: 620px;
            object-fit: contain;
            display: block;
        }

        .no-image-hero {
            margin-top: 64px;
            width: 100%;
            height: 260px;
            background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary) 50%, #1a4494 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            position: relative;
            overflow: hidden;
        }

        .no-image-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(200,169,81,0.15) 0%, transparent 70%);
        }

        .no-image-hero::after {
            content: '';
            position: absolute;
            bottom: -40%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* ──── Meta Tags ──── */
        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .platform-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 14px;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .platform-instagram { color: #e1306c; background: rgba(225,48,108,0.08); }
        .platform-tiktok { color: #111; background: rgba(0,0,0,0.04); }
        .platform-twitter { color: #111; background: rgba(0,0,0,0.04); }
        .platform-facebook { color: #1877F2; background: rgba(24,119,242,0.08); }
        .platform-youtube { color: #FF0000; background: rgba(255,0,0,0.08); }
        .platform-other { color: var(--gray-600); background: var(--gray-100); }

        .tag-office {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 14px;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 600;
            background: var(--accent-50);
            color: var(--accent-dark);
        }

        .hero-title {
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.4;
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .hero-date {
            margin-top: 0.75rem;
            font-size: 0.82rem;
            color: var(--gray-400);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hero-date svg {
            width: 14px;
            height: 14px;
            opacity: 0.6;
        }

        /* ──── Article Body ──── */
        .article-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 2rem 4rem;
            position: relative;
            z-index: 3;
        }

        /* ──── Description Section ──── */
        .description-section {
            background: var(--white);
            border-radius: 16px;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 4px 20px rgba(10,43,107,0.04);
            margin-bottom: 2rem;
            overflow: hidden;
            animation: fadeInUp 0.5s ease 0.1s both;
        }

        .description-header {
            padding: 1.25rem 1.75rem 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .description-header-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .description-header-text {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent-dark);
        }

        .description-body {
            padding: 1.25rem 1.75rem 1.75rem;
        }

        .description-body p {
            font-size: 0.92rem;
            line-height: 1.85;
            color: var(--gray-700);
            white-space: pre-line;
        }

        /* ──── Info Cards Row ──── */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 4px 20px rgba(10,43,107,0.04);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            box-shadow: 0 8px 32px rgba(10,43,107,0.08);
            transform: translateY(-2px);
        }

        .info-card-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gray-400);
            margin-bottom: 6px;
        }

        .info-card-value {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .info-card-icon {
            float: right;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .info-card-icon.user { background: var(--primary-50); color: var(--primary); }
        .info-card-icon.time { background: #FEF3C7; color: #D97706; }
        .info-card-icon.office { background: var(--accent-50); color: var(--accent-dark); }
        .info-card-icon.unit { background: #EDE9FE; color: #7C3AED; }

        /* ──── Source Link Section ──── */
        .source-section {
            background: var(--white);
            border-radius: 16px;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 4px 20px rgba(10,43,107,0.04);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .source-header {
            padding: 1.25rem 1.75rem 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .source-header-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
        }

        .source-header-icon svg {
            width: 16px;
            height: 16px;
        }

        .source-header-text {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--primary);
        }

        .source-body {
            padding: 1rem 1.75rem 1.5rem;
        }

        .source-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem 1.25rem;
            background: var(--gray-50);
            border-radius: 12px;
            border: 0.5px solid var(--gray-200);
            text-decoration: none;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 500;
            word-break: break-all;
            transition: all 0.3s ease;
        }

        .source-link:hover {
            background: var(--primary-50);
            border-color: var(--primary-100);
            transform: translateX(4px);
        }

        .source-link svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.5;
        }

        .source-link .arrow {
            margin-left: auto;
            opacity: 0.3;
            transition: all 0.2s;
        }

        .source-link:hover .arrow {
            opacity: 0.8;
            transform: translateX(3px);
        }

        /* ──── Back Button ──── */
        .back-section {
            display: flex;
            justify-content: center;
            padding-top: 1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 14px;
            background: var(--white);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.88rem;
            border: 0.5px solid rgba(10,43,107,0.08);
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(10,43,107,0.04);
        }

        .back-link svg {
            width: 18px;
            height: 18px;
            transition: transform 0.2s;
        }

        .back-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(10,43,107,0.2);
        }

        .back-link:hover svg {
            transform: translateX(-3px);
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
            background: linear-gradient(160deg, #060E1F 0%, #0A1A3A 40%, #0E2348 100%);
            color: rgba(255,255,255,0.6);
            font-size: 0.84rem;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
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
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .footer-brand-desc {
            font-size: 0.8rem;
            line-height: 1.75;
            color: rgba(255,255,255,0.45);
            max-width: 320px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 0.5rem;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer-social a:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #0A1A3A;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(200,169,81,0.3);
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-col-title {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--accent);
            margin-bottom: 1.25rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .footer-col-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 24px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
            opacity: 0.4;
        }

        .footer-link-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-link-list li a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 400;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .footer-link-list li a:hover {
            color: #ffffff;
            transform: translateX(3px);
        }

        .footer-link-list li a svg {
            width: 14px;
            height: 14px;
            opacity: 0.4;
            flex-shrink: 0;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .footer-contact-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(200,169,81,0.08);
            border: 1px solid rgba(200,169,81,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-contact-icon svg {
            width: 16px;
            height: 16px;
        }

        .footer-contact-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .footer-contact-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(255,255,255,0.35);
        }

        .footer-contact-value {
            font-size: 0.84rem;
            color: rgba(255,255,255,0.7);
            line-height: 1.5;
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
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.04em;
            margin: 0;
        }

        .footer-bottom .footer-accent {
            color: var(--accent);
            font-weight: 600;
        }

        /* ──── Responsive ──── */
        @media (max-width: 768px) {
            .article-hero img { height: 320px; }
            .hero-title { font-size: 1.4rem; }
            .article-hero-content { padding: 1.5rem; }
            .article-container { padding: 0 1rem 3rem; }
            .info-cards { grid-template-columns: 1fr; }
            .title-card { padding: 1.5rem; }
            .title-card h1 { font-size: 1.3rem; }
            .footer-main { grid-template-columns: 1fr; text-align: center; }
            .footer-brand { align-items: center; }
            .footer-col-title::after { left: 50%; transform: translateX(-50%); }
            .footer-social { justify-content: center; }
            .footer-contact-item { justify-content: center; }
            .navbar { padding: 0 1rem; }
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

    <!-- ═══════ NAVBAR ═══════ -->
    <nav class="navbar" id="navbar">
        <a href="{{ route('public.index') }}" class="navbar-brand">
            <img src="{{ asset('images/logo_header.png') }}" alt="Logo" style="height: 55px; width: auto;">
        </a>

        <div class="navbar-actions">
            <a href="{{ route('public.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                <span data-i18n="back">Kembali</span>
            </a>
        </div>
    </nav>

    @php
        $hasImage = $activity->foto_dokumentasi || $activity->extracted_image;
        $imageUrl = $activity->foto_dokumentasi
            ? asset('storage/' . $activity->foto_dokumentasi)
            : $activity->extracted_image;
    @endphp

    @if($hasImage)
        <!-- ═══════ HERO IMAGE ═══════ -->
        <div class="article-hero">
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
        <div style="background: var(--white); border-radius: 16px; border: 0.5px solid rgba(10,43,107,0.06); box-shadow: 0 4px 20px rgba(10,43,107,0.04); padding: 1.75rem; margin-bottom: 2rem; animation: fadeInUp 0.5s ease 0.1s both;">
            <p style="font-size: 0.92rem; line-height: 1.85; color: var(--gray-700); white-space: pre-line; margin: 0;">{{ $activity->description }}</p>
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
                <div class="info-card-value relative-time" data-time="{{ $activity->approved_at?->toIso8601String() }}">{{ $activity->approved_at?->diffForHumans() ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-icon office">🏛️</div>
                <div class="info-card-label" data-i18n="office_label">Kantor Wilayah</div>
                <div class="info-card-value">{{ $activity->office?->name ?? '-' }}</div>
            </div>
            @if($activity->unit)
            <div class="info-card">
                <div class="info-card-icon unit">🏢</div>
                <div class="info-card-label" data-i18n="unit_label">Unit Kerja</div>
                <div class="info-card-value">{{ $activity->unit->label() }}</div>
            </div>
            @endif
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
                    <li><a href="https://ham.go.id" target="_blank"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg> <span data-i18n="official_website">Website Resmi</span></a></li>
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

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        // ──── Translations (synced from main page via localStorage) ────
        const translations = {
            id: {
                back: 'Kembali',
                home: 'Beranda',
                source: 'Sumber Asli',
                submitted_by: 'Disubmit oleh',
                approved: 'Disetujui',
                office_label: 'Kantor Wilayah',
                unit_label: 'Unit Kerja',
                description_label: 'Deskripsi Kegiatan',
                back_portal: 'Kembali ke Portal',
                footer: 'Kementerian Hak Asasi Manusia Republik Indonesia',
                footer_desc: 'Portal Kegiatan Harian Kementerian Hak Asasi Manusia Republik Indonesia.',
                footer_links: 'Tautan',
                nav_home: 'Beranda',
                official_website: 'Website Resmi',
                contact_us: 'Hubungi Kami',
                phone: 'Telepon',
                our_address: 'Alamat',
            },
            en: {
                back: 'Back',
                home: 'Home',
                source: 'Original Source',
                submitted_by: 'Submitted by',
                approved: 'Approved',
                office_label: 'Regional Office',
                unit_label: 'Work Unit',
                description_label: 'Activity Description',
                back_portal: 'Back to Portal',
                footer: 'Ministry of Human Rights Republic of Indonesia',
                footer_desc: 'Daily Activity Portal of the Ministry of Human Rights of the Republic of Indonesia.',
                footer_links: 'Links',
                nav_home: 'Home',
                official_website: 'Official Website',
                contact_us: 'Contact Us',
                phone: 'Phone',
                our_address: 'Address',
            }
        };

        // ──── Relative Time ────
        function relativeTime(isoString, lang) {
            if (!isoString) return '-';
            const now = new Date();
            const date = new Date(isoString);
            const seconds = Math.floor((now - date) / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);
            const weeks = Math.floor(days / 7);
            const months = Math.floor(days / 30);
            const years = Math.floor(days / 365);

            const labels = {
                id: { now: 'baru saja', s: s => s+' detik yang lalu', m: m => m+' menit yang lalu', h: h => h+' jam yang lalu', d: d => d+' hari yang lalu', w: w => w+' minggu yang lalu', mo: m => m+' bulan yang lalu', y: y => y+' tahun yang lalu' },
                en: { now: 'just now', s: s => s+` second${s>1?'s':''} ago`, m: m => m+` minute${m>1?'s':''} ago`, h: h => h+` hour${h>1?'s':''} ago`, d: d => d+` day${d>1?'s':''} ago`, w: w => w+` week${w>1?'s':''} ago`, mo: m => m+` month${m>1?'s':''} ago`, y: y => y+` year${y>1?'s':''} ago` }
            };
            const l = labels[lang] || labels.id;

            if (seconds < 10) return l.now;
            if (seconds < 60) return l.s(seconds);
            if (minutes < 60) return l.m(minutes);
            if (hours < 24) return l.h(hours);
            if (days < 7) return l.d(days);
            if (weeks < 5) return l.w(weeks);
            if (months < 12) return l.mo(months);
            return l.y(years);
        }

        function setLang(lang) {
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.dataset.i18n;
                if (translations[lang] && translations[lang][key]) {
                    el.innerHTML = translations[lang][key];
                }
            });

            document.querySelectorAll('.relative-time[data-time]').forEach(el => {
                el.textContent = relativeTime(el.dataset.time, lang);
            });
        }

        // Auto-apply language from main page on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('hamdans_lang') || 'id';
            setLang(savedLang);
        });
    </script>

</body>
</html>
