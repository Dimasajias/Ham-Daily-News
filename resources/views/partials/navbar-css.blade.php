/* ──── Navbar ──── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 2000;
            height: 70px;
            padding: 0 max(2rem, calc((100% - 1200px) / 2));
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            transition: all 0.4s ease;
            font-family: 'Outfit', sans-serif;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid transparent;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand img {
            /* Remove inversion for white header */
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
            margin-right: 28px;
        }

        .navbar-links a, .nav-link-with-icon {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .navbar-links a svg, .nav-link-with-icon svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .navbar-links a {
            text-decoration: none;
            color: var(--gray-600);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.01em;
            position: relative;
            padding: 8px 14px;
            transition: all 0.25s ease;
            border-radius: 8px;
        }

        .navbar-links a:hover {
            color: var(--primary);
            background: rgba(10,43,107,0.03);
        }

        .navbar-links a.active {
            color: var(--primary);
            font-weight: 600;
            background: rgba(10,43,107,0.05);
        }

        .nav-hoax {
            color: #DC2626 !important;
            font-weight: 700 !important;
        }

        .nav-hoax:hover {
            background: rgba(220, 38, 38, 0.05) !important;
        }

        /* Navbar Dropdown */
        .navbar-dropdown {
            position: relative;
        }

        .navbar-dropdown > a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            color: var(--gray-600);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.02em;
            padding: 6px 14px;
            transition: color 0.25s ease;
            border-radius: 8px;
            text-decoration: none;
        }

        .navbar-dropdown > a svg {
            width: 12px;
            height: 12px;
            transition: transform 0.25s ease;
        }

        .navbar-dropdown:hover > a {
            color: var(--primary);
            background: rgba(10,43,107,0.03);
        }

        .navbar-dropdown:hover > a svg {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            left: 50%;
            transform: translateX(-50%);
            min-width: 200px;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(10,43,107,0.08);
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(10,43,107,0.12);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-50%) translateY(-8px);
            transition: all 0.25s ease;
            z-index: 200;
        }

        .navbar-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-menu.right-aligned {
            left: auto;
            right: 0;
            transform: translateX(0) translateY(-8px);
        }

        .navbar-dropdown:hover .dropdown-menu.right-aligned {
            transform: translateX(0) translateY(0);
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 9px;
            color: var(--gray-700) !important;
            font-size: 0.8rem !important;
            font-weight: 500 !important;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .dropdown-menu a::after {
            display: none !important;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background: rgba(10,43,107,0.05);
            color: var(--primary) !important;
        }

        .dropdown-menu a svg {
            width: 16px;
            height: 16px;
            opacity: 0.6;
            flex-shrink: 0;
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(10,43,107,0.06);
            margin: 6px 8px;
        }

        /* Admin button */
        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            background: var(--primary-50);
            color: var(--primary) !important;
            border: 1px solid var(--primary-100);
            transition: all 0.25s ease;
        }

        .btn-admin svg {
            width: 15px;
            height: 15px;
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            background: var(--primary);
            color: #fff !important;
            box-shadow: 0 4px 14px rgba(10,43,107,0.2);
        }

        .btn-admin::after { display: none !important; }

        .navbar-brand img {
            /* Image inversion removed */
        }

        .navbar-title {
            font-size: 1.15rem;
            font-weight: 500;
            color: #ffffff;
        }

        .navbar-title .highlight {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            transition: all 0.25s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 43, 107, 0.35);
        }

        /* MOBILE SIDEBAR */
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .navbar-menu {
            display: contents;
        }

        .mobile-menu-btn {
            display: none;
        }

        .mobile-overlay {
            display: none;
        }

        

        
        @media (max-width: 768px) {
            .navbar { padding: 0 1rem; }
            
            .navbar-menu {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 0;
                right: 0;
                height: 100dvh;
                width: 320px;
                max-width: 85vw;
                background: white;
                z-index: 2000;
                padding: 80px 20px 40px;
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -4px 0 15px rgba(0,0,0,0.05);
                overflow-y: auto;
                overflow-x: hidden;
                overscroll-behavior: contain;
                -webkit-overflow-scrolling: touch;
            }
            .navbar-menu.open {
                transform: translateX(0);
            }
            .navbar-links {
                display: flex;
                position: static;
                transform: none;
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                width: 100%;
            }
            .navbar-links > a, .navbar-dropdown > a {
                padding: 12px 16px;
                font-size: 0.95rem;
                display: flex;
                width: 100%;
                justify-content: flex-start;
                align-items: center;
                gap: 12px;
                border-radius: 12px;
            }

            .navbar-links a svg, .nav-link-with-icon svg {
                width: 18px;
                height: 18px;
                opacity: 1;
            }

            .navbar-dropdown > a .caret {
                margin-left: auto;
                width: 12px;
                height: 12px;
            }

            .navbar-dropdown > a svg {
                transition: transform 0.3s ease;
            }
            .navbar-actions {
                display: flex;
                flex-direction: column;
                margin-top: 30px;
                gap: 12px;
                width: 100%;
            }
            .navbar-dropdown > .dropdown-menu {
                position: static;
                opacity: 0;
                visibility: hidden;
                transform: none !important;
                box-shadow: none;
                border: none;
                padding: 0 0 0 24px;
                margin-top: 0;
                display: flex;
                flex-direction: column;
                border-left: 2px solid var(--gray-200);
                margin-left: 8px;
                max-height: 0;
                overflow: hidden;
                transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .navbar-dropdown:hover > .dropdown-menu,
            .navbar-dropdown.is-active > .dropdown-menu {
                transform: none !important;
            }
            .navbar-dropdown.is-active > .dropdown-menu {
                max-height: 800px; /* Safe upper bound for animation */
                opacity: 1;
                visibility: visible;
                padding: 10px 0 10px 24px;
                margin-top: 5px;
            }
            .navbar-dropdown.is-active > a svg {
                transform: rotate(180deg);
            }
            .dropdown-menu a { padding: 8px 12px; font-size: 0.95rem; white-space: normal; line-height: 1.4; }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                background: none;
                border: none;
                cursor: pointer;
                color: var(--gray-800);
                padding: 6px;
                z-index: 1001; /* Keep above sidebar */
            }

            .mobile-overlay {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(10,43,107,0.4);
                backdrop-filter: blur(2px);
                z-index: 999;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }
            .mobile-overlay.open {
                opacity: 1;
                pointer-events: auto;
            }
        
        /* ──── Language Switch Polish ──── */
        [data-i18n], [data-i18n-placeholder], [data-i18n-title] {
            transition: opacity 0.3s ease;
        }
        body:not(.i18n-ready) [data-i18n], 
        body:not(.i18n-ready) [data-i18n-placeholder],
        body:not(.i18n-ready) [data-i18n-title] {
            opacity: 0;
        }
        body.i18n-ready [data-i18n],
        body.i18n-ready [data-i18n-placeholder],
        body.i18n-ready [data-i18n-title] {
            opacity: 1;
        }
    }
