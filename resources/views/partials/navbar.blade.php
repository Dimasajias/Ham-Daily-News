<!-- ═══════ NAVBAR ═══════ -->
    <nav class="navbar" id="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo_header.png') }}" alt="Logo Kemenham" style="height: 55px; width: auto;">
        </a>
        
        <div class="mobile-overlay" id="mobileOverlay"></div>
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="24" height="24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <div class="navbar-links">
                <a href="{{ url('/') }}" class="active">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4"/></svg>
                    <span data-i18n="nav_home">Beranda</span>
                </a>

                {{-- Dropdown Kegiatan --}}
                <div class="navbar-dropdown">
                    <a href="{{ route('public.kegiatan') }}">
                        <div class="nav-link-with-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span data-i18n="activities">Kegiatan</span>
                        </div>
                        <svg class="caret" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('public.kegiatan') }}">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                            Semua Kegiatan
                        </a>
                        <a href="{{ route('public.kegiatan') }}?hari_ini=1">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
                            Hari Ini
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('public.kegiatan') }}?platform=instagram">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15" style="color:#e1306c"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0z"/></svg>
                            Instagram
                        </a>
                        <a href="{{ route('public.kegiatan') }}?platform=youtube">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15" style="color:#FF0000"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                        <a href="{{ route('public.kegiatan') }}?platform=tiktok">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15" style="color:#111"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            TikTok
                        </a>
                        <a href="{{ route('public.kegiatan') }}?platform=twitter">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15" style="color:#111"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X / Twitter
                        </a>
                        <a href="{{ route('public.kegiatan') }}?platform=facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15" style="color:#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                    </div>
                </div>



                <a href="{{ route('public.offices') }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span data-i18n="regional_offices">Kanwil & Wilker</span>
                </a>

                <a href="{{ route('public.hoax') }}" class="nav-hoax">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
                    <span>Berita Hoax</span>
                </a>

                <a href="https://kemenham.go.id" target="_blank">Website Resmi</a>
            </div>
            
            <div class="navbar-actions">
                {{-- Language Dropdown Switcher --}}
                <div class="navbar-dropdown">
                    <a href="#" style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: 6px 14px; border-radius: 8px;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="16" height="16" style="margin-right:2px; color:var(--gray-500);"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 15h2.498"/></svg>
                        <span id="currentLangLabel">ID</span>
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="width:10px;height:10px;"><polyline points="6 9 12 15 18 9"/></svg>
                    </a>
                    <div class="dropdown-menu right-aligned" style="min-width: 140px;">
                        <a href="#" onclick="setLang('id'); return false;" style="font-size:0.85rem !important;">Indonesia (ID)</a>
                        <a href="#" onclick="setLang('en'); return false;" style="font-size:0.85rem !important;">English (EN)</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
