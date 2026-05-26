<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Portal HAMDANS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --primary: #0A2B6B;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-body: #0f172a;
                --bg-card: #1e293b;
                --text-main: #f8fafc;
                --text-muted: #94a3b8;
            }
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            line-height: 1.6;
        }
        .error-card {
            background-color: var(--bg-card);
            border-radius: 1.25rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            padding: 3.5rem 2.5rem;
            max-width: 460px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes slideUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .error-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #0A2B6B 0%, #dc2626 50%, #0A2B6B 100%);
        }
        .logo {
            height: 35px;
            width: auto;
            margin-bottom: 2.5rem;
        }
        .error-code {
            font-size: 7.5rem;
            font-weight: 900;
            line-height: 1;
            color: var(--primary);
            margin: 0 0 1rem 0;
            letter-spacing: -0.04em;
        }
        @media (prefers-color-scheme: dark) {
            .error-code {
                color: #60a5fa;
            }
        }
        .error-title {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0 0 1rem 0;
            color: var(--text-main);
        }
        .error-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin: 0 0 2.5rem 0;
            line-height: 1.6;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--danger);
            color: #ffffff;
            text-decoration: none;
            padding: 0.85rem 2rem;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);
        }
        .btn-home:hover {
            background-color: var(--danger-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }
        .btn-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        @media (prefers-color-scheme: dark) {
            .error-card {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
</head>
<body>
    <div class="error-card">
        <!-- Menggunakan logo web HAMDANS (opsional bisa diubah jika path berbeda) -->
        <a href="/">
            <img src="/images/logo_kemenham.png" alt="HAMDANS" class="logo" onerror="this.style.display='none'">
        </a>
        
        <h1 class="error-code">@yield('code')</h1>
        <h2 class="error-title">Halaman Tidak Ditemukan</h2>
        
        <p class="error-desc">
            Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin URL yang Anda tuju sudah berubah, dihapus, atau Anda salah mengetikkan alamatnya.
        </p>
        
        <a href="/" class="btn-home">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
