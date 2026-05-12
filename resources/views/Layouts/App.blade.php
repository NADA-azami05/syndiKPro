<!DOCTYPE html>
<html lang="fr">
<style>
.page-content {
    padding-top: 68px !important;
    display: block !important;
}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SyndicPro — @yield('title', 'Gestion de copropriété')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --blue: #006AD7;
        --blue-dark: #0055b3;
        --blue-navy: #21277B;
        --blue-light: #e6f2ff;
        --bg: #f0f4ff;
        --bg-white: #ffffff;
        --text: #111111;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --card-shadow: 0 2px 12px rgba(0, 0, 0, .06);
        --card-shadow-hover: 0 8px 32px rgba(0, 0, 0, .10);
        --radius: 14px;
        --radius-lg: 20px;
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'DM Sans', sans-serif;
        --orange: #006AD7;
        --orange-light: #e6f2ff;
        --navy: #111111;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: var(--font-sans);
        background: var(--bg);
        color: var(--text);
    }

    /* ── Navbar ── */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: #fff;
        border-bottom: 2px solid #006AD7;
        height: 68px;
        display: flex;
        align-items: center;
        padding: 0 60px;
        justify-content: space-between;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #006AD7;
        font-size: 18px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .brand-icon {
        width: 36px;
        height: 36px;
        background: #006AD7;
        border-radius: 9px;
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 16px;
    }

    .navbar-nav {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 40px;
    }

    .navbar-nav a {
        color: #006AD7;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color .2s;
        white-space: nowrap;
    }

    .navbar-nav a:hover,
    .navbar-nav a.active {
        color: #0055b3;
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .btn-ghost {
        color: #006AD7;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        font-family: var(--font-sans);
        transition: color .2s;
    }

    .btn-ghost:hover {
        color: #0055b3;
    }

    /* ── Cloche notification ── */
    .notif-bell {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f0f4ff;
        text-decoration: none;
        font-size: 16px;
        transition: background .2s;
    }

    .notif-bell:hover {
        background: #dbeafe;
    }

    .notif-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        background: #dc2626;
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        min-width: 16px;
        height: 16px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 3px;
        border: 2px solid #fff;
    }

    /* ── Flash ── */
    .flash-container {
        position: fixed;
        top: 80px;
        right: 24px;
        z-index: 999;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .flash {
        padding: 13px 18px;
        border-radius: var(--radius);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideIn .3s ease, fadeOut .3s ease 4s forwards;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .1);
        max-width: 340px;
    }

    .flash.success {
        background: #f0fdf4;
        border: 1px solid #86efac;
        color: #15803d;
    }

    .flash.error {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        color: #dc2626;
    }

    .page-content {
        padding-top: 68px;
        min-height: 100vh;
    }

    /* ── Footer ── */
    .footer {
        background: #fff;
        border-top: 2px solid #006AD7;
        padding: 0 60px;
        height: 68px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 600;
        color: #006AD7;
    }

    .footer-brand-icon {
        width: 30px;
        height: 30px;
        background: #006AD7;
        border-radius: 7px;
        display: grid;
        place-items: center;
        font-size: 13px;
        color: #fff;
    }

    .footer-copy {
        font-size: 12px;
        color: #6b7280;
        margin-top: 3px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(16px)
        }

        to {
            opacity: 1;
            transform: translateX(0)
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1
        }

        to {
            opacity: 0;
            pointer-events: none
        }
    }
    </style>
    @stack('styles')
</head>

<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">
            <div class="brand-icon">🏢</div>
            SyndicPro
        </a>
        <ul class="navbar-nav">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="/#features">Fonctionnalités</a></li>
            <li><a href="/#contact">Contact</a></li>
            <li><a href="/#reglementation">Réglementation copropriété</a></li>
            @auth
            @if(auth()->user()->isSyndic())
            <li><a href="{{ route('syndic.dashboard') }}" class="active">Dashboard</a></li>
            @else
            <li><a href="{{ route('resident.dashboard') }}" class="active">Mon espace</a></li>
            @endif
            @endauth
        </ul>
        <div class="navbar-actions">
            @auth
            {{-- ── Cloche notifications ── --}}
            @php
            $nbNotifs = \App\Models\Notification::where('user_id', auth()->id())
            ->where('lue', false)->count();
            $notifRoute = auth()->user()->isSyndic()
            ? route('syndic.notifications.index')
            : route('resident.notifications.index');
            @endphp
            <a href="{{ $notifRoute }}" class="notif-bell" title="Notifications">
                🔔
                @if($nbNotifs > 0)
                <span class="notif-badge">{{ $nbNotifs > 9 ? '9+' : $nbNotifs }}</span>
                @endif
            </a>

            <span style="font-size:14px;color:#006AD7;">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn-ghost">Déconnexion</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn-ghost">Connexion</a>
            @endauth
        </div>
    </nav>

    <div class="flash-container">
        @if(session('success'))
        <div class="flash success">✓ {{ session('success') }}</div>@endif
        @if(session('error'))
        <div class="flash error">✕ {{ session('error') }}</div>@endif
    </div>

    <main class="page-content">@yield('content')</main>

    <footer class="footer">
        <div>
            <div class="footer-brand">
                <div class="footer-brand-icon">🏢</div>SyndicPro
            </div>
            <p class="footer-copy">© {{ date('Y') }} SyndicPro — Tous droits réservés</p>
        </div>
    </footer>
     {{-- Chatbot : visible uniquement pour le résident --}}
    @auth
        @if(!auth()->user()->isSyndic())
            @include('components.chatbot')
        @endif
    @endauth

    @stack('scripts')
</body>

</html>