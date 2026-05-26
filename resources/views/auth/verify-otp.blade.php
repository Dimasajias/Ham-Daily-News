<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Verifikasi OTP — HAM DAILY NEWS (HAMDANS)</title>

        <link rel="icon" href="{{ asset('images/logo_kemenham.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }

            :root {
                --primary: #0A2B6B;
                --primary-dark: #071E4A;
                --accent: #C8A951;
                --accent-light: #FDB91F;
                --gray-50: #F8FAFC;
                --gray-100: #F1F5F9;
                --gray-200: #E2E8F0;
                --gray-400: #94A3B8;
                --gray-500: #64748B;
                --gray-700: #334155;
                --gray-900: #0F172A;
                --green-500: #22C55E;
                --green-50: #F0FDF4;
                --red-500: #EF4444;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                -webkit-font-smoothing: antialiased;
                background: linear-gradient(160deg, #EEF2F9 0%, #F5F7FB 30%, #FFF8E6 70%, #FFFDF5 100%);
            }

            .otp-container {
                width: 100%;
                max-width: 440px;
                padding: 2rem 1.5rem;
            }

            .otp-card {
                background: #ffffff;
                border-radius: 24px;
                padding: 3rem 2.5rem;
                box-shadow: 0 20px 60px rgba(10, 43, 107, 0.08), 0 4px 20px rgba(0,0,0,0.04);
                border: 1px solid rgba(10, 43, 107, 0.06);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .otp-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary), var(--accent), var(--primary));
            }

            .otp-icon {
                width: 72px;
                height: 72px;
                border-radius: 20px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.75rem;
                box-shadow: 0 8px 24px rgba(10, 43, 107, 0.2);
            }

            .otp-icon svg {
                width: 32px;
                height: 32px;
                color: #ffffff;
            }

            .otp-title {
                font-size: 1.5rem;
                font-weight: 800;
                color: var(--gray-900);
                margin-bottom: 0.5rem;
                letter-spacing: -0.02em;
            }

            .otp-desc {
                font-size: 0.88rem;
                color: var(--gray-500);
                line-height: 1.7;
                margin-bottom: 0.5rem;
            }

            .otp-email {
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 2rem;
            }

            /* ──── OTP Input ──── */
            .otp-input-group {
                display: flex;
                gap: 8px;
                justify-content: center;
                margin-bottom: 1.5rem;
            }

            .otp-digit {
                width: 50px;
                height: 58px;
                border: 2px solid var(--gray-200);
                border-radius: 14px;
                font-size: 1.5rem;
                font-weight: 800;
                font-family: inherit;
                text-align: center;
                color: var(--gray-900);
                background: var(--gray-50);
                outline: none;
                transition: all 0.25s ease;
                caret-color: var(--primary);
            }

            .otp-digit:focus {
                border-color: var(--primary);
                background: #fff;
                box-shadow: 0 0 0 4px rgba(10, 43, 107, 0.1);
                transform: scale(1.05);
            }

            .otp-digit.filled {
                border-color: var(--primary);
                background: var(--gray-50);
            }

            /* Hidden actual input */
            .otp-hidden-input {
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* ──── Timer ──── */
            .otp-timer {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                font-size: 0.82rem;
                color: var(--gray-500);
                margin-bottom: 1.5rem;
                font-weight: 500;
            }

            .otp-timer svg {
                width: 16px;
                height: 16px;
                color: var(--accent);
            }

            .otp-timer .time {
                font-weight: 700;
                color: var(--gray-700);
                font-variant-numeric: tabular-nums;
            }

            .otp-timer.expired .time {
                color: var(--red-500);
            }

            /* ──── Buttons ──── */
            .btn-verify {
                width: 100%;
                height: 50px;
                border: none;
                border-radius: 14px;
                font-size: 0.9rem;
                font-weight: 700;
                font-family: inherit;
                color: #fff;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                overflow: hidden;
                margin-bottom: 1rem;
            }

            .btn-verify:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(10, 43, 107, 0.35);
            }

            .btn-verify:active {
                transform: translateY(0);
            }

            .btn-verify:disabled {
                opacity: 0.5;
                cursor: not-allowed;
                transform: none;
                box-shadow: none;
            }

            .btn-resend {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                border: none;
                background: none;
                color: var(--primary);
                font-size: 0.84rem;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: all 0.2s;
                padding: 0.5rem 1rem;
                border-radius: 10px;
            }

            .btn-resend:hover {
                background: rgba(10, 43, 107, 0.05);
            }

            .btn-resend:disabled {
                color: var(--gray-400);
                cursor: not-allowed;
            }

            .btn-resend svg {
                width: 16px;
                height: 16px;
            }

            /* ──── Status Messages ──── */
            .alert-success {
                padding: 0.75rem 1rem;
                background: var(--green-50);
                border: 1px solid #BBF7D0;
                border-radius: 12px;
                font-size: 0.82rem;
                color: #16A34A;
                margin-bottom: 1.25rem;
                text-align: center;
                font-weight: 500;
            }

            .alert-error {
                padding: 0.75rem 1rem;
                background: #FEF2F2;
                border: 1px solid #FECACA;
                border-radius: 12px;
                font-size: 0.82rem;
                color: var(--red-500);
                margin-bottom: 1.25rem;
                text-align: center;
                font-weight: 500;
            }

            /* ──── Back Link ──── */
            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                margin-top: 1.5rem;
                font-size: 0.82rem;
                color: var(--gray-500);
                text-decoration: none;
                font-weight: 500;
                transition: all 0.2s;
            }

            .back-link:hover {
                color: var(--primary);
            }

            .back-link svg {
                width: 16px;
                height: 16px;
                transition: transform 0.2s;
            }

            .back-link:hover svg {
                transform: translateX(-3px);
            }

            /* ──── Responsive ──── */
            @media (max-width: 480px) {
                .otp-card { padding: 2rem 1.5rem; border-radius: 20px; }
                .otp-digit { width: 44px; height: 52px; font-size: 1.3rem; }
                .otp-title { font-size: 1.3rem; }
            }

            /* ──── Animations ──── */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }

            .otp-card { animation: fadeInUp 0.5s ease both; }
            .otp-icon { animation: fadeInUp 0.5s ease 0.1s both; }
            .otp-input-group { animation: fadeInUp 0.5s ease 0.2s both; }
            .btn-verify { animation: fadeInUp 0.5s ease 0.3s both; }
        </style>
    </head>
    <body>
        <div class="otp-container">
            <div class="otp-card">
                <div class="otp-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>

                <h1 class="otp-title">Verifikasi Login</h1>
                <p class="otp-desc">Masukkan kode 6 digit yang telah dikirim ke:</p>
                <p class="otp-email">{{ $email ?? '***@***.com' }}</p>

                @if (session('status'))
                    <div class="alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->has('otp_code'))
                    <div class="alert-error">{{ $errors->first('otp_code') }}</div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" id="otpForm">
                    @csrf
                    <input type="hidden" name="otp_code" id="otpHiddenInput" maxlength="6">

                    <div class="otp-input-group" id="otpInputGroup">
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="0" autofocus>
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="1">
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="2">
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="3">
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="4">
                        <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" pattern="[0-9]" data-index="5">
                    </div>

                    <div class="otp-timer" id="otpTimer">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Kode berlaku <span class="time" id="timerDisplay">05:00</span>
                    </div>

                    <button type="submit" class="btn-verify" id="btnVerify" disabled>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                        Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('otp.resend') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-resend" id="btnResend">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/>
                            <path d="M3 22v-6h6"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/>
                        </svg>
                        Kirim Ulang Kode
                    </button>
                </form>

                <a href="{{ route('login') }}" class="back-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Kembali ke halaman login
                </a>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const digits = document.querySelectorAll('.otp-digit');
                const hiddenInput = document.getElementById('otpHiddenInput');
                const btnVerify = document.getElementById('btnVerify');
                const timerDisplay = document.getElementById('timerDisplay');
                const timerContainer = document.getElementById('otpTimer');

                // ──── OTP Input Logic ────
                function updateHiddenInput() {
                    let code = '';
                    digits.forEach(d => code += d.value);
                    hiddenInput.value = code;
                    btnVerify.disabled = code.length !== 6;
                }

                digits.forEach((digit, idx) => {
                    digit.addEventListener('input', (e) => {
                        const val = e.target.value.replace(/\D/g, '');
                        e.target.value = val.charAt(0) || '';

                        if (val && idx < 5) {
                            digits[idx + 1].focus();
                        }

                        e.target.classList.toggle('filled', !!e.target.value);
                        updateHiddenInput();
                    });

                    digit.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value && idx > 0) {
                            digits[idx - 1].focus();
                            digits[idx - 1].value = '';
                            digits[idx - 1].classList.remove('filled');
                            updateHiddenInput();
                        }
                    });

                    // Handle paste
                    digit.addEventListener('paste', (e) => {
                        e.preventDefault();
                        const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').substring(0, 6);
                        paste.split('').forEach((char, i) => {
                            if (digits[i]) {
                                digits[i].value = char;
                                digits[i].classList.add('filled');
                            }
                        });
                        if (paste.length > 0) {
                            const focusIdx = Math.min(paste.length, 5);
                            digits[focusIdx].focus();
                        }
                        updateHiddenInput();
                    });
                });

                // ──── Countdown Timer (5 minutes) ────
                let timeLeft = 300; // 5 minutes in seconds

                function updateTimer() {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                    if (timeLeft <= 0) {
                        timerContainer.classList.add('expired');
                        timerDisplay.textContent = 'EXPIRED';
                        btnVerify.disabled = true;
                        return;
                    }

                    timeLeft--;
                    setTimeout(updateTimer, 1000);
                }

                updateTimer();
            });
        </script>
    </body>
</html>
