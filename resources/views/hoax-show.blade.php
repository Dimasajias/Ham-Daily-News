<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Str::limit($hoax->title, 70) }} — Berita Hoax | HAMDANS</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
    <meta name="description" content="{{ Str::limit(strip_tags($hoax->content), 155) }}">

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

        /* ──── HERO ──── */
        .article-hero {
            margin-top: 70px;
            position: relative;
            width: 100%;
            height: 50vh;
            min-height: 360px;
            max-height: 540px;
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
            filter: blur(40px) brightness(0.4);
            z-index: 1;
            transform: scale(1.1);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(153,27,27,0.2) 0%, rgba(153,27,27,0.7) 100%);
            z-index: 2;
        }

        .article-hero img {
            position: relative;
            z-index: 3;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 2rem 2rem 4rem;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5));
        }

        .no-image-hero {
            margin-top: 70px;
            width: 100%;
            height: 280px;
            background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);
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

        /* ──── ARTICLE CONTAINER ──── */
        .article-container {
            max-width: 860px;
            margin: -80px auto 0;
            padding: 0 2rem 5rem;
            position: relative;
            z-index: 10;
        }

        /* ──── TITLE CARD ──── */
        .title-card {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 20px 40px rgba(153,27,27,0.08);
            margin-bottom: 2rem;
        }

        .verdict-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 18px;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }

        .article-title {
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1.4;
            color: var(--gray-900);
            letter-spacing: -0.02em;
            margin-bottom: 1.25rem;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 1.25rem;
            border-top: 1px solid var(--gray-100);
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        .meta-item svg { color: var(--gray-400); }

        /* ──── CONTENT CARD ──── */
        .content-card {
            background: var(--white);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.03);
            border: 1px solid var(--gray-100);
            margin-bottom: 2rem;
        }

        .content-card .section-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--danger);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-card .section-label::before {
            content: '';
            width: 20px; height: 2px;
            background: var(--danger);
            border-radius: 2px;
        }

        .content-body {
            font-size: 1rem;
            line-height: 1.9;
            color: var(--gray-700);
        }

        .content-body h2 { font-size: 1.2rem; margin-bottom: 0.75rem; margin-top: 1.5rem; color: var(--gray-900); }
        .content-body h3 { font-size: 1.05rem; margin-bottom: 0.5rem; margin-top: 1.25rem; color: var(--gray-900); }
        .content-body p { margin-bottom: 1.25rem; }
        .content-body ul, .content-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
        .content-body li { margin-bottom: 0.5rem; }
        .content-body blockquote {
            border-left: 3px solid var(--danger);
            padding-left: 1.25rem;
            margin: 1.5rem 0;
            color: var(--gray-600);
            font-style: italic;
        }
        .content-body a {
            color: var(--danger);
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .content-body strong { color: var(--gray-900); }

        /* ──── SOURCE LINK ──── */
        .source-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--gray-200);
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .source-icon {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            display: flex; align-items: center; justify-content: center;
            color: white;
            margin-bottom: 1rem;
        }

        .source-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--danger);
            margin-bottom: 1.25rem;
        }

        .source-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem 1.5rem;
            background: var(--danger-50);
            border-radius: 14px;
            border: 1px solid var(--danger-100);
            text-decoration: none;
            color: var(--danger);
            font-size: 0.88rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s;
        }

        .source-link:hover {
            background: var(--danger);
            color: white;
        }

        /* ──── RELATED ──── */
        .related-section {
            margin-bottom: 2rem;
        }

        .related-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .related-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .related-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--gray-200);
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
        }

        .related-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(220,38,38,0.1);
            border-color: rgba(220,38,38,0.2);
        }

        .related-card img {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }

        .related-no-img {
            width: 100%;
            height: 80px;
            background: linear-gradient(135deg, #FEF2F2, #FDE8E8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
        }

        .related-card-body {
            padding: 1rem;
        }

        .related-card-verdict {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 6px;
        }

        .related-card-title {
            font-size: 0.82rem;
            font-weight: 700;
            line-height: 1.5;
            color: var(--gray-800);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ──── BACK BUTTON ──── */
        .back-section {
            display: flex;
            justify-content: center;
            padding: 1rem 0;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 16px;
            background: var(--white);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid var(--gray-200);
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        }

        .back-link:hover {
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            color: white;
            border-color: var(--danger);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(220,38,38,0.2);
        }

        .back-link svg { transition: transform 0.2s; }
        .back-link:hover svg { transform: translateX(-4px); }

        /* ──── FOOTER ──── */
        .footer {
            margin-top: 3rem; position: relative;
            background: #f8fafc;
            border-top: 1px solid var(--gray-200);
            overflow: hidden;
        }
        .footer::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--primary-light), var(--danger), var(--primary-light));
        }
        .footer-bottom {
            padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: center;
        }
        .footer-bottom p { font-size: 0.72rem; color: var(--gray-400); letter-spacing: 0.04em; margin: 0; }
        .footer-accent { color: var(--danger); font-weight: 600; }

        /* ──── Responsive ──── */
        @media (max-width: 1024px) {
            .article-hero { height: 40vh; }
            .article-container { padding: 0 1.5rem 3rem; }
            .title-card, .content-card { padding: 2.5rem; }
        }
        
        @media (max-width: 768px) {
            .article-hero { height: auto; padding-bottom: 0; min-height: 240px; margin-top: 56px; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); }
            .hero-overlay { background: linear-gradient(to bottom, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.8) 100%); }
            .article-hero img { padding: 1.25rem 1.25rem 4rem; height: auto; max-height: 400px; }
            .article-container { margin-top: -60px; padding: 0 1rem 3rem; }
            .title-card { padding: 1.75rem 1.25rem; border-radius: 20px; text-align: center; }
            .article-title { font-size: 1.4rem; }
            .content-card { padding: 1.75rem 1.25rem; border-radius: 20px; }
            .content-body { font-size: 0.95rem; line-height: 1.7; }
            .related-grid { grid-template-columns: 1fr; }
            
            .no-image-hero { height: 200px; margin-top: 56px; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); }
            
            .source-card { padding: 1.5rem; }
            .source-link { font-size: 0.82rem; padding: 0.75rem 1rem; }
            
            .footer-bottom { padding: 1.25rem 1rem; }
            .footer-bottom p { font-size: 0.65rem; }
        }
    </style>
</head>
<body>

@include("partials.navbar")

<!-- ═══════ HERO ═══════ -->
@if($hoax->cover_image)
    <div class="article-hero">
        <div class="hero-bg-blur" style="background-image: url('{{ asset('storage/' . $hoax->cover_image) }}');"></div>
        <div class="hero-overlay"></div>
        <img src="{{ asset('storage/' . $hoax->cover_image) }}" alt="{{ Str::limit($hoax->title, 80) }}">
    </div>
@else
    <div class="no-image-hero">⚠️</div>
@endif

<!-- ═══════ ARTICLE ═══════ -->
<div class="article-container">

    {{-- Title Card --}}
    <div class="title-card">

        <h1 class="article-title">"{{ $hoax->title }}"</h1>

        <div class="article-meta">
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
                {{ $hoax->published_at?->translatedFormat('d F Y') ?? $hoax->created_at->translatedFormat('d F Y') }}
            </div>
            @if($hoax->user)
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 10-16 0"/></svg>
                <span data-i18n="staff_team">Tim HAMDANS</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
        <div class="section-label" data-i18n="fact_check_label">Klarifikasi & Penjelasan Resmi</div>
        <div class="content-body">
            {!! $hoax->content !!}
        </div>
    </div>

    {{-- Source Link --}}
    @if($hoax->source_url)
    @php
        $sourcePlatform = \App\Enums\Platform::detectFromUrl($hoax->source_url);
        $isSosmed = $sourcePlatform !== \App\Enums\Platform::Other;
        $platName = $isSosmed ? 'Sumber: ' . $sourcePlatform->label() : 'Sumber Referensi Resmi';

        $platBg = 'linear-gradient(135deg, var(--danger), var(--danger-dark))';
        if ($isSosmed) {
            $platBg = match($sourcePlatform) {
                \App\Enums\Platform::Instagram => 'linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%)',
                \App\Enums\Platform::TikTok => '#000000',
                \App\Enums\Platform::YouTube => '#FF0000',
                \App\Enums\Platform::Twitter => '#000000',
                \App\Enums\Platform::Facebook => '#1877F2',
                default => $platBg
            };
        }

        $platIconSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>';
        if ($isSosmed) {
            $platIconSvg = match($sourcePlatform) {
                \App\Enums\Platform::Instagram => '<svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0z"/></svg>',
                \App\Enums\Platform::TikTok => '<svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
                \App\Enums\Platform::YouTube => '<svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                \App\Enums\Platform::Twitter => '<svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                \App\Enums\Platform::Facebook => '<svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
                default => $platIconSvg
            };
        }
    @endphp

    <div class="source-card" style="{{ $isSosmed ? 'border-color: rgba(220,38,38,0.15); box-shadow: 0 8px 24px rgba(0,0,0,0.03);' : '' }}">
        <div class="source-icon" style="background: {{ $platBg }};">
            {!! $platIconSvg !!}
        </div>
        <div class="source-label" style="{{ $isSosmed ? 'color: var(--gray-800);' : '' }}">{!! $platName !!}</div>
        <a href="{{ $hoax->source_url }}" target="_blank" rel="noopener" class="source-link" {{ $isSosmed ? 'style="border-color: var(--gray-200); background: #f8fafc; color: var(--gray-700);"' : '' }}>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="16" height="16"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
            <span data-i18n="visit_source">Kunjungi Link Sumber Asli</span>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="14" height="14" style="margin-left:auto;"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
        </a>
    </div>
    @endif

    {{-- Related Hoaxes --}}
    @if($related->count() > 0)
    <div class="related-section">
        <div class="related-title" data-i18n="related_hoax">Berita Hoax Lainnya</div>
        <div class="related-grid">
            @foreach($related as $item)
                <a href="{{ route('public.hoax.show', $item) }}" class="related-card">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ Str::limit($item->title, 60) }}">
                    @else
                        <div class="related-no-img">⚠️</div>
                    @endif
                    <div class="related-card-body">
                        <div class="related-card-title">"{{ $item->title }}"</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Back Button --}}
    <div class="back-section">
        <a href="{{ route('public.hoax') }}" class="back-link">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span data-i18n="back_to_list">Kembali ke Daftar Hoax</span>
        </a>
    </div>

</div>

    <footer class="footer">
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <span class="footer-accent">HAMDANS</span> — Kementerian Hak Asasi Manusia Republik Indonesia</p>
        </div>
    </footer>
@include("partials.navbar-scripts")

</body>
</html>
