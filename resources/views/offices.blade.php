<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantor Wilayah — HAM DAILY NEWS (HAMDANS)</title>
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
            box-shadow: 0 8px 24px rgba(10,43,107,0.3);
        }

        .btn-back svg { width: 16px; height: 16px; transition: transform 0.2s; }
        .btn-back:hover svg { transform: translateX(-3px); }

        /* ──── Page Header ──── */
        .page-header {
            margin-top: 64px;
            background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary) 60%, #1a4494 100%);
            padding: 3.5rem 2rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200,169,81,0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-header-inner {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.55);
            max-width: 600px;
            line-height: 1.6;
        }

        /* ──── Summary Stats ──── */
        .summary-stats {
            max-width: 1100px;
            margin: -1.5rem auto 2rem;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .summary-card {
            background: var(--white);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 4px 20px rgba(10,43,107,0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .summary-icon.blue { background: var(--primary-50); }
        .summary-icon.gold { background: var(--accent-50); }
        .summary-icon.green { background: #ECFDF5; }

        .summary-num {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .summary-label {
            font-size: 0.72rem;
            color: var(--gray-400);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ──── Grid ──── */
        .offices-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }

        .offices-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1rem;
        }

        .office-card {
            background: var(--white);
            border-radius: 16px;
            border: 0.5px solid rgba(10,43,107,0.06);
            box-shadow: 0 2px 12px rgba(10,43,107,0.03);
            padding: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .office-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(10,43,107,0.1);
            border-color: rgba(10,43,107,0.12);
        }

        .office-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .office-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .office-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.3;
        }

        .office-location {
            font-size: 0.72rem;
            color: var(--gray-400);
            margin-top: 2px;
        }

        .office-stats {
            display: flex;
            gap: 0.75rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-100);
        }

        .office-stat {
            flex: 1;
            background: var(--gray-50);
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
        }

        .office-stat-num {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary);
        }

        .office-stat-label {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 2px;
        }

        .office-stat.today .office-stat-num {
            color: var(--accent-dark);
        }

        .office-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--accent-50);
            color: var(--accent-dark);
            margin-left: auto;
        }

        /* ──── Footer ──── */
        .footer {
            position: relative;
            background: linear-gradient(160deg, #060E1F 0%, #0A1A3A 40%, #0E2348 100%);
            color: rgba(255,255,255,0.6);
            font-size: 0.84rem;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent), var(--accent-light), var(--accent), transparent);
        }

        .footer-bottom {
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.15);
        }

        .footer-bottom p {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.04em;
            margin: 0;
        }

        .footer-accent { color: var(--accent); font-weight: 600; }

        /* ──── Responsive ──── */
        @media (max-width: 768px) {
            .page-header { padding: 2.5rem 1rem 2rem; }
            .page-header h1 { font-size: 1.5rem; }
            .summary-stats { grid-template-columns: 1fr; padding: 0 1rem; }
            .offices-container { padding: 0 1rem 3rem; }
            .offices-grid { grid-template-columns: 1fr; }
            .navbar { padding: 0 1rem; }
        }

        /* ──── Animations ──── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .summary-card { animation: fadeInUp 0.4s ease both; }
        .summary-card:nth-child(2) { animation-delay: 0.1s; }
        .summary-card:nth-child(3) { animation-delay: 0.2s; }
        .office-card { animation: fadeInUp 0.4s ease both; }
    </style>
</head>
<body>

    <!-- ═══════ NAVBAR ═══════ -->
    <nav class="navbar" id="navbar">
        <a href="{{ route('public.index') }}" class="navbar-brand">
            <img src="{{ asset('images/logo_header.png') }}" alt="Logo" style="height: 55px; width: auto;">
        </a>
        <a href="{{ route('public.index') }}" class="btn-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            <span data-i18n="back">Kembali</span>
        </a>
    </nav>

    <!-- ═══════ HEADER ═══════ -->
    <div class="page-header">
        <div class="page-header-inner">
            <h1 data-i18n="page_title">Kantor Wilayah & Unit Kerja</h1>
            <p data-i18n="page_desc">Daftar seluruh Kantor Wilayah dan Unit Kerja Kementerian Hak Asasi Manusia yang terintegrasi dalam portal kegiatan harian.</p>
        </div>
    </div>

    <!-- ═══════ SUMMARY STATS ═══════ -->
    <div class="summary-stats">
        <div class="summary-card">
            <div class="summary-icon blue">🏛️</div>
            <div>
                <div class="summary-num">{{ $offices->count() }}</div>
                <div class="summary-label" data-i18n="total_offices">Total Kantor</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon gold">📋</div>
            <div>
                <div class="summary-num">{{ $totalActivities }}</div>
                <div class="summary-label" data-i18n="total_activities">Total Kegiatan</div>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon green">📅</div>
            <div>
                <div class="summary-num">{{ $totalToday }}</div>
                <div class="summary-label" data-i18n="today_activities">Kegiatan Hari Ini</div>
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
                        <div>
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
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <span class="footer-accent">HAMDANS</span> — <span data-i18n="footer">Kementerian Hak Asasi Manusia Republik Indonesia</span></p>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        const translations = {
            id: {
                back: 'Kembali',
                page_title: 'Kantor Wilayah & Unit Kerja',
                page_desc: 'Daftar seluruh Kantor Wilayah dan Unit Kerja Kementerian Hak Asasi Manusia yang terintegrasi dalam portal kegiatan harian.',
                total_offices: 'Total Kantor',
                total_activities: 'Total Kegiatan',
                today_activities: 'Kegiatan Hari Ini',
                activities_label: 'Kegiatan',
                today_label: 'hari ini',
                today_label2: 'Hari Ini',
                footer: 'Kementerian Hak Asasi Manusia Republik Indonesia',
            },
            en: {
                back: 'Back',
                page_title: 'Regional Offices & Work Units',
                page_desc: 'List of all Regional Offices and Work Units of the Ministry of Human Rights integrated in the daily activity portal.',
                total_offices: 'Total Offices',
                total_activities: 'Total Activities',
                today_activities: 'Activities Today',
                activities_label: 'Activities',
                today_label: 'today',
                today_label2: 'Today',
                footer: 'Ministry of Human Rights Republic of Indonesia',
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const lang = localStorage.getItem('hamdans_lang') || 'id';
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.dataset.i18n;
                if (translations[lang] && translations[lang][key]) {
                    el.innerHTML = translations[lang][key];
                }
            });
        });
    </script>

</body>
</html>
