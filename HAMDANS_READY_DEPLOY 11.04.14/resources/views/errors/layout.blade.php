<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — HAMDANS</title>
    <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0A2B6B;
            --primary-dark: #071E4A;
            --danger: #DC2626;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-400: #94A3B8;
            --gray-600: #475569;
            --gray-800: #1E293B;
            --gray-900: #0F172A;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Ambient Background */
        body::before {
            content: '';
            position: absolute;
            top: -20%; right: -10%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(10,43,107,0.04) 0%, transparent 60%);
            border-radius: 50%;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -20%; left: -10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(220,38,38,0.03) 0%, transparent 60%);
            border-radius: 50%;
            z-index: 0;
        }

        .error-container {
            max-width: 560px;
            width: 100%;
            background: white;
            padding: 3.5rem 2.5rem;
            border-radius: 28px;
            box-shadow: 0 10px 40px rgba(10, 43, 107, 0.08);
            border: 1px solid var(--gray-200);
            position: relative;
            z-index: 10;
        }

        .error-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--danger), var(--primary));
        }

        .logo-wrap {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
        }
        
        .logo-wrap img {
            height: 50px;
            width: auto;
        }

        .error-code {
            font-family: 'Outfit', sans-serif;
            font-size: 7rem;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -0.05em;
        }

        .error-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 0.95rem;
            color: var(--gray-600);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--danger), #b91c1c);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.25);
            width: 100%;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(220, 38, 38, 0.35);
        }

        @media (max-width: 640px) {
            .error-container { padding: 3rem 1.5rem; }
            .error-code { font-size: 5.5rem; }
            .error-title { font-size: 1.25rem; }
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo_header.png') }}" alt="Logo Kemenham">
        </div>
        <div class="error-code">@yield('code')</div>
        <h1 class="error-title">@yield('message')</h1>
        <p class="error-message">@yield('description')</p>
        
        <a href="{{ url('/') }}" class="btn-home">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4"/></svg>
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>
