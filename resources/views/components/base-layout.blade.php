<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $brandingFile = storage_path('app/branding.json');
        $bs = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];
        $bSiteName     = $bs['site_name']                  ?? config('branding.site_name');
        $bSiteDesc     = $bs['site_desc']                 ?? config('branding.site_desc');
        $bFavicon      = $bs['favicon']                   ?? config('branding.favicon');
        $bLogo         = $bs['logo']                      ?? config('branding.logo');
        $bFooterLogo   = ($bs['footer_logo'] ?? null) ?: $bLogo;
        $bHeaderImage  = $bs['header_image']              ?? config('branding.header_image');
        $bPrimary      = $bs['colors']['primary']         ?? config('branding.colors.primary');
        $bPrimaryHover = $bs['colors']['primary_hover']   ?? config('branding.colors.primary_hover');
        $bAccent       = $bs['colors']['accent']          ?? config('branding.colors.accent');
        $bAccentHover  = $bs['colors']['accent_hover']    ?? config('branding.colors.accent_hover');
        $bHeaderBg     = $bs['colors']['header_bg']       ?? config('branding.colors.header_bg');
        $bHeaderText   = $bs['colors']['header_text']     ?? config('branding.colors.header_text');
        $bFooterBg     = $bs['colors']['footer_bg']       ?? config('branding.colors.footer_bg');
        $bCtaBg        = $bs['colors']['cta_bg']          ?? config('branding.colors.cta_bg');
        $bCtaText      = $bs['colors']['cta_text']        ?? '#ffffff';
        $bCtaBtnBg     = $bs['colors']['cta_btn_bg']      ?? config('branding.colors.cta_btn_bg');
        $bCtaBtnText   = $bs['colors']['cta_btn_text']    ?? config('branding.colors.cta_btn_text');
        $bBodyBg       = $bs['colors']['body_bg']         ?? config('branding.colors.body_bg');
        $bBodyText     = $bs['colors']['body_text']       ?? config('branding.colors.body_text');
        $bCardBg       = $bs['colors']['card_bg']         ?? config('branding.colors.card_bg');
        $bFooterText   = $bs['colors']['footer_text']     ?? config('branding.colors.footer_text');
        $bHeroBg       = $bs['colors']['hero_bg']         ?? config('branding.colors.hero_bg');
        $bHeroText     = $bs['colors']['hero_text']       ?? config('branding.colors.hero_text');
        $bHeroSub      = $bs['colors']['hero_sub']        ?? config('branding.colors.hero_sub');
        $bTopbarBg     = $bs['colors']['topbar_bg']       ?? config('branding.colors.topbar_bg');
        $bTopbarText   = $bs['colors']['topbar_text']     ?? config('branding.colors.topbar_text');
        $bHeaderHover  = $bs['colors']['header_hover']    ?? config('branding.colors.header_hover');
        $bFontFamily   = $bs['fonts']['family']           ?? config('branding.fonts.family');
        $bFontGoogle   = $bs['fonts']['google']           ?? config('branding.fonts.google');
        $bFooterFacebook  = $bs['footer_facebook']  ?? '';
        $bFooterInstagram = $bs['footer_instagram'] ?? '';
        $bFooterLinkedin  = $bs['footer_linkedin']  ?? '';
        $bFooterTwitter   = $bs['footer_twitter']   ?? '';
        $bPhone           = $bs['site_phone']       ?? '';
        $bHours           = $bs['site_hours']       ?? '';
        $bContactEmail    = $bs['contact_email']    ?? '';

        $bTemplate = $bs['template'] ?? config('branding.template', 'modern');
        $cookieTheme = request()->cookie('template');
        if ($cookieTheme && in_array($cookieTheme, ['modern', 'minimal', 'warm', 'corporate', 'dark', 'retro', 'helder'])) {
            $bTemplate = $cookieTheme;
        }
    @endphp

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/fa/css/all.min.css">
    @if($bFontGoogle)
        <link href="{{ $bFontGoogle }}" rel="stylesheet">
    @endif


    @if($bTemplate === 'minimal')
        <link rel="stylesheet" href="/themes/minimal.css">
    @elseif($bTemplate === 'warm')
        <link rel="stylesheet" href="/themes/warm.css">
    @elseif($bTemplate === 'corporate')
        <link rel="stylesheet" href="/themes/corporate.css">
    @elseif($bTemplate === 'dark')
        <link rel="stylesheet" href="/themes/dark.css">
    @elseif($bTemplate === 'retro')
        <link rel="stylesheet" href="/themes/retro.css">
    @elseif($bTemplate === 'helder')
        <link rel="stylesheet" href="/themes/helder.css">
    @elseif($bTemplate === 'snel')
        <link rel="stylesheet" href="/themes/snel.css">
    @else
        <link rel="stylesheet" href="/style.css">
    @endif

    <style>
        :root {
            --color-primary:       {{ $bPrimary }};
            --color-primary-hover: {{ $bPrimaryHover }};
            --color-accent:        {{ $bAccent }};
            --color-accent-hover:  {{ $bAccentHover }};
            --color-header-bg:     {{ $bHeaderBg }};
            --color-header-text:   {{ $bHeaderText }};
            --color-footer-bg:     {{ $bFooterBg }};
            --color-cta-bg:        {{ $bCtaBg }};
            --color-cta-text:      {{ $bCtaText }};
            --color-cta-btn-bg:    {{ $bCtaBtnBg }};
            --color-cta-btn-text:  {{ $bCtaBtnText }};
            --color-body-bg:       {{ $bBodyBg }};
            --color-body-text:     {{ $bBodyText }};
            --color-card-bg:       {{ $bCardBg }};
            --color-footer-text:   {{ $bFooterText }};
            --color-hero-bg:       {{ $bHeroBg }};
            --color-hero-text:     {{ $bHeroText }};
            --color-hero-sub:      {{ $bHeroSub }};
            --color-topbar-bg:     {{ $bTopbarBg }};
            --color-topbar-text:   {{ $bTopbarText }};
            --color-header-hover:  {{ $bHeaderHover }};
            --font-family:         {{ $bFontFamily }};
            --header-image:        url('{{ $bHeaderImage }}');
        }

        /* ── Plus Jakarta Sans als header font ──────────── */
        .topbar, .site-header, .site-header *:not(i) {
            font-family: 'Plus Jakarta Sans', var(--font-family, sans-serif);
        }

        /* ── Topbalk ─────────────────────────────────────── */
        .topbar {
            background: var(--color-topbar-bg, #0f0f0f);
            color: var(--color-topbar-text, #9ca3af);
            font-size: 11.5px;
            font-weight: 500;
            letter-spacing: 0.03em;
            width: 100%;
            border-bottom: 1px solid #1f1f1f;
        }
        .topbar__inner {
            max-width: 1250px;
            margin: 0 auto;
            padding: 8px 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 28px;
            flex-wrap: wrap;
        }
        .topbar__inner a,
        .topbar__inner span {
            color: var(--color-topbar-text, #fff);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 500;
            transition: color 0.15s;
            white-space: nowrap;
        }
        .topbar__inner a:hover { color: #fff; }
        .topbar__inner i { font-size: 11px; color: var(--color-accent, #6366f1); }
        .topbar__sep {
            width: 1px;
            height: 12px;
            background: #333;
            flex-shrink: 0;
        }
        @media (max-width: 640px) {
            .topbar__inner { gap: 14px; }
            .topbar__sep { display: none; }
        }

        /* ── Hoofdheader ─────────────────────────────────── */
        .site-header {
            background: var(--color-header-bg);
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .site-header__inner {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 32px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .site-header__logo img {
            height: 64px;
            width: auto;
            display: block;
        }

        /* Nav gecentreerd */
        .site-header__nav {
            display: flex;
            align-items: center;
            gap: 6px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .site-header__nav > a {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 10px 16px;
            border-radius: 8px;
            white-space: nowrap;
            position: relative;
            transition: color 0.18s, background 0.18s;
        }
        .site-header__nav > a::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 16px;
            right: 16px;
            height: 2px;
            background: var(--color-header-hover, var(--color-accent, #6366f1));
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform 0.22s cubic-bezier(.4,0,.2,1);
        }
        .site-header__nav > a:hover { color: var(--color-header-hover, var(--color-accent, #6366f1)); }
        .site-header__nav > a:hover::after { transform: scaleX(1); }

        /* Admin nav links */
        .site-header__admin-link {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 9px 14px;
            border-radius: 8px;
            white-space: nowrap;
            transition: background 0.15s, color 0.15s;
        }
        .site-header__admin-link:hover {
            background: rgba(0,0,0,0.06);
            color: var(--color-accent, #6366f1);
        }

        /* Acties rechts */
        .site-header__actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .site-header__logout-btn {
            background: #111111;
            color: #fff;
            border: none;
            padding: 11px 26px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 12.5px;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: background 0.18s;
            white-space: nowrap;
        }
        .site-header__logout-btn:hover {
            background: #333333;
        }
        .site-header__logout-btn:active { background: #000000; }

        /* Dropdown */
        .site-header__dropdown { position: relative; }
        .site-header__dropdown-toggle {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s, color 0.15s;
        }
        .site-header__dropdown-toggle:hover {
            background: rgba(0,0,0,0.06);
            color: var(--color-accent, #6366f1);
        }
        .site-header__dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            min-width: 200px;
            overflow: hidden;
            border: 1px solid #f3f4f6;
        }
        .site-header__dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 20px;
            color: #111827 !important;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            opacity: 1 !important;
            transition: background 0.12s, color 0.12s;
        }
        .site-header__dropdown-menu a:hover {
            background: #f5f3ff;
            color: var(--color-accent, #6366f1) !important;
        }
        .site-header__dropdown.open .site-header__dropdown-menu,
        .site-header__dropdown:hover .site-header__dropdown-menu { display: block; }

        /* CTA knop rechts */
        .site-header__cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #1a1a1a;
            color: #fff;
            text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 10px 22px;
            border-radius: 50px;
            white-space: nowrap;
            transition: background 0.18s, transform 0.18s;
        }
        .site-header__cta-btn i { font-size: 11px; }
        .site-header__cta-btn:hover {
            background: #333;
            transform: translateY(-1px);
        }
        @media (max-width: 900px) {
            .site-header__cta-btn { display: none; }
        }

        /* Hamburger */
        .site-header__hamburger {
            display: none;
            background: rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            cursor: pointer;
            color: #1a1a1a;
            font-size: 18px;
            padding: 9px 12px;
            line-height: 1;
            transition: background 0.15s;
        }
        .site-header__hamburger:hover { background: rgba(0,0,0,0.1); }

        /* Zoekbalk */
        .site-header__searchbar {
            background: var(--color-header-bg);
            padding: 10px 32px 14px;
            display: flex;
            justify-content: center;
        }
        .site-header__searchbar-inner {
            width: 100%;
            max-width: 640px;
            display: flex;
            align-items: center;
            gap: 0;
            background: #ede8de;
            border: 1.5px solid #d8d0c2;
            border-radius: 50px;
            padding: 0 6px 0 20px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .site-header__searchbar-inner:focus-within {
            border-color: var(--color-accent, #6366f1);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .site-header__searchbar-inner i {
            color: #8b7d6b;
            font-size: 14px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .site-header__searchbar-inner input {
            flex: 1;
            background: none;
            border: none;
            outline: none;
            color: #1a1a1a;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 500;
            padding: 10px 0;
            min-width: 0;
        }
        .site-header__searchbar-inner input::placeholder {
            color: #9e8e7a;
            font-weight: 400;
        }
        .site-header__searchbar-divider {
            width: 1px;
            height: 22px;
            background: #c8bfb0;
            margin: 0 8px;
            flex-shrink: 0;
        }
        .site-header__searchbar-inner .search-input-plaats {
            width: 160px;
            flex-shrink: 0;
        }
        .site-header__search-btn {
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 9px 22px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.18s;
        }
        .site-header__search-btn:hover { background: #333; }

        /* Mobiel */
        @media (max-width: 900px) {
            .site-header__nav {
                display: none;
                position: fixed;
                top: 135px;
                left: 0;
                right: 0;
                background: var(--color-header-bg);
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                padding: 12px 0 20px;
                box-shadow: 0 16px 40px rgba(0,0,0,0.12);
                transform: none;
            }
            .site-header__nav.open { display: flex; }
            .site-header__nav > a {
                padding: 14px 32px;
                border-radius: 0;
                border-bottom: 1px solid rgba(0,0,0,0.06);
                font-size: 14px;
                color: #1a1a1a;
            }
            .site-header__nav > a:last-child { border-bottom: none; }
            .site-header__nav > a::after { display: none; }
            .site-header__hamburger { display: flex; align-items: center; }
            .site-header__admin-link { display: none; }
            .site-header__searchbar { padding: 8px 16px 10px; }
            .site-header__searchbar-inner .search-input-plaats,
            .site-header__searchbar-divider { display: none; }
        }
    </style>

    <title>{{ $bSiteName }}</title>
    <meta name="description" content="{{ $bSiteDesc }}">
    <link rel="icon" type="image/png" href="{{ $bFavicon }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@if($bTemplate === 'minimal')
<body class="body theme-minimal">
@elseif($bTemplate === 'warm')
<body class="body theme-warm">
@elseif($bTemplate === 'corporate')
<body class="body theme-corporate">
@elseif($bTemplate === 'dark')
<body class="body theme-dark">
@elseif($bTemplate === 'retro')
<body class="body theme-retro">
@elseif($bTemplate === 'helder')
<body class="body theme-helder">
@elseif($bTemplate === 'snel')
<body class="body theme-snel">
@else
<body class="body theme-modern">
@endif

{{-- ── Topbalk (altijd zichtbaar, niet sticky) ─────────────── --}}
<div class="topbar">
    <div class="topbar__inner">
        @if($bPhone)
            <span><i class="fa-solid fa-phone"></i> {{ $bPhone }}</span>
            @if($bContactEmail || $bHours || $bFooterInstagram || $bFooterFacebook || $bFooterLinkedin || $bFooterTwitter)
            <div class="topbar__sep"></div>
            @endif
        @endif
        @if($bContactEmail)
            <a href="mailto:{{ $bContactEmail }}"><i class="fa-solid fa-envelope"></i> {{ $bContactEmail }}</a>
            @if($bHours || $bFooterInstagram || $bFooterFacebook || $bFooterLinkedin || $bFooterTwitter)
            <div class="topbar__sep"></div>
            @endif
        @endif
        @if($bHours)
            <span><i class="fa-regular fa-clock"></i> {{ $bHours }}</span>
            @if($bFooterInstagram || $bFooterFacebook || $bFooterLinkedin || $bFooterTwitter)
            <div class="topbar__sep"></div>
            @endif
        @endif
        @if($bFooterInstagram)
            <a href="{{ $bFooterInstagram }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
        @endif
        @if($bFooterFacebook)
            <a href="{{ $bFooterFacebook }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook"></i></a>
        @endif
        @if($bFooterLinkedin)
            <a href="{{ $bFooterLinkedin }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
        @endif
        @if($bFooterTwitter)
            <a href="{{ $bFooterTwitter }}" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
        @endif
    </div>
</div>

{{-- ── Hoofdheader (sticky) ────────────────────────────────── --}}
<header class="site-header">
    <div class="site-header__inner">

        <div class="site-header__logo">
            <a href="{{ route('home.index') }}"><img src="{{ $bLogo }}" alt="{{ $bSiteName }}"></a>
        </div>

        @if(auth()->check())
            <nav class="site-header__nav">
                <a href="{{ route('admin.index') }}" class="site-header__admin-link">Dashboard</a>
                <div class="site-header__dropdown">
                    <a href="#" class="site-header__dropdown-toggle">Toevoegen &#x25BE;</a>
                    <div class="site-header__dropdown-menu">
                        <a href="{{ route('admin.create') }}">Bedrijf toevoegen</a>
                        <a href="{{ route('admin.newCategorie') }}">Categorie toevoegen</a>
                    </div>
                </div>
                <a href="{{ route('admin.settings') }}" class="site-header__admin-link">Instellingen</a>
            </nav>
            <div class="site-header__actions">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="site-header__logout-btn">Uitloggen</button>
                </form>
            </div>
        @else
            <nav class="site-header__nav" id="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/bedrijven') }}">Bedrijven</a>
                <a href="{{ url('/about') }}">Over ons</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </nav>
            <div class="site-header__actions">
                <a href="{{ route('contact.index') }}" class="site-header__cta-btn">
                    Aanmelden
                </a>
                <button class="site-header__hamburger" id="hamburger" aria-label="Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        @endif

    </div>

</header>

@if(!auth()->check() && !request()->routeIs('bedrijven.index', 'login', 'register'))
<div class="site-header__searchbar">
    <form action="{{ route('bedrijven.index') }}" method="GET" class="site-header__searchbar-inner">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="soort_bedrijf" placeholder="Zoek een bedrijf of categorie...">
        <div class="site-header__searchbar-divider"></div>
        <input type="text" name="plaats" placeholder="Plaats" class="search-input-plaats">
        <button type="submit" class="site-header__search-btn">Zoeken</button>
    </form>
</div>
@endif

<main class="main">
    <div class="main-inner">
        {{ $slot }}
    </div>
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-col footer-col--logo">
                <img src="{{ $bFooterLogo }}" alt="Logo">
                <p>{{ $bSiteDesc }}</p>
                <div class="footer-socials">
                    @if($bFooterInstagram)
                    <a href="{{ $bFooterInstagram }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if($bFooterFacebook)
                    <a href="{{ $bFooterFacebook }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook"></i></a>
                    @endif
                    @if($bFooterLinkedin)
                    <a href="{{ $bFooterLinkedin }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                    @if($bFooterTwitter)
                    <a href="{{ $bFooterTwitter }}" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                </div>
            </div>
            <div class="footer-col">
                <h4>Navigatie</h4>
                <ul>
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{ route('bedrijven.index') }}">Bedrijven</a></li>
                    <li><a href="{{ route('about.index') }}">Over ons</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Overig</h4>
                <ul>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                    <li><a href="{{ route('av.download') }}">Algemene Voorwaarden</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© {{ date('Y') }} {{ $bSiteName }}. All rights reserved.</span>
    </div>
</footer>

{{-- Bevestigingsmodal (admin) --}}
<div id="admin-confirm-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:99999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:36px 28px 28px;max-width:420px;width:calc(100% - 40px);box-shadow:0 24px 64px rgba(0,0,0,0.22);font-family:var(--font-family, sans-serif);">
        <div style="text-align:center;margin-bottom:20px;">
            <div style="display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#fef2f2;margin-bottom:14px;">
                <i class="fa-solid fa-triangle-exclamation" style="color:#dc2626;font-size:24px;"></i>
            </div>
            <h3 id="admin-confirm-title" style="margin:0 0 10px;font-size:1.1rem;font-weight:700;color:#111827;">Weet je zeker?</h3>
            <p id="admin-confirm-message" style="margin:0;color:#6b7280;font-size:14.5px;line-height:1.55;"></p>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button id="admin-confirm-cancel" style="flex:1;padding:10px 0;background:#fff;color:#374151;border:1.5px solid #d1d5db;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Annuleren</button>
            <button id="admin-confirm-ok" style="flex:1;padding:10px 0;background:#dc2626;color:#fff;border:none;border-radius:6px;font-size:14px;font-weight:700;cursor:pointer;">Bevestigen</button>
        </div>
    </div>
</div>
<style>
#admin-confirm-cancel:hover { background:#f9fafb; }
#admin-confirm-ok:hover     { background:#b91c1c; }
</style>

<script>
// Bevestigingsmodal
(function() {
    var overlay, okBtn, cancelBtn, msgEl;
    function init() {
        overlay   = document.getElementById('admin-confirm-overlay');
        okBtn     = document.getElementById('admin-confirm-ok');
        cancelBtn = document.getElementById('admin-confirm-cancel');
        msgEl     = document.getElementById('admin-confirm-message');
        if (!overlay) return;
        cancelBtn.addEventListener('click', function() { overlay.style.display = 'none'; });
        overlay.addEventListener('click', function(e) { if (e.target === overlay) overlay.style.display = 'none'; });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') overlay.style.display = 'none'; });
    }
    window.adminConfirm = function(message, onConfirm, title) {
        if (!overlay) init();
        msgEl.textContent = message;
        document.getElementById('admin-confirm-title').textContent = title || 'Weet je zeker?';
        overlay.style.display = 'flex';
        okBtn.onclick = function() { overlay.style.display = 'none'; onConfirm(); };
        setTimeout(function() { okBtn.focus(); }, 50);
    };
    window.adminConfirmSubmit = function(form, message, title) {
        adminConfirm(message, function() { form.submit(); }, title);
        return false;
    };
    document.addEventListener('DOMContentLoaded', init);
})();


document.addEventListener('DOMContentLoaded', function() {
    // Dropdown (admin)
    const dropdownToggle = document.querySelector('.site-header__dropdown-toggle');
    if (dropdownToggle) {
        const dropdown = dropdownToggle.closest('.site-header__dropdown');
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            dropdown.classList.toggle('open');
        });
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) dropdown.classList.remove('open');
        });
    }

    // Hamburger (publiek)
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.getElementById('nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('open');
            const icon = hamburger.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-xmark');
        });
        document.addEventListener('click', function(e) {
            if (!navLinks.contains(e.target) && !hamburger.contains(e.target)) {
                navLinks.classList.remove('open');
                const icon = hamburger.querySelector('i');
                if (icon) { icon.classList.add('fa-bars'); icon.classList.remove('fa-xmark'); }
            }
        });
    }
});
</script>

</body>
</html>
