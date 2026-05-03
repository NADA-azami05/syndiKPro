<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SyndicPro — @yield('title', 'Gestion de copropriété')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:           #f4f4f8;
            --bg-white:     #ffffff;
            --navy:         #1a2340;
            --navy-light:   #2d3a5c;
            --orange:       #D4882A;
            --orange-light: #fef3e2;
            --text:         #1a2340;
            --text-muted:   #6b7280;
            --text-light:   #9ca3af;
            --border:       #e5e7eb;
            --card-shadow:  0 2px 12px rgba(0,0,0,0.06);
            --card-shadow-hover: 0 8px 32px rgba(0,0,0,0.10);
            --radius:       14px;
            --radius-lg:    20px;
            --font-serif:   'Playfair Display', serif;
            --font-sans:    'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background: var(--bg); color: var(--text); }

        /* ── Navbar ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            padding: 0 60px;
            height: 68px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .navbar-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; color: var(--navy);
            font-family: var(--font-sans); font-size: 18px; font-weight: 500;
        }
        .brand-icon {
            width: 36px; height: 36px; background: var(--orange);
            border-radius: 9px; display: grid; place-items: center;
            color: #fff; font-size: 16px;
        }
        .navbar-nav { display: flex; gap: 28px; list-style: none; }
        .navbar-nav a {
            color: var(--text-muted); text-decoration: none;
            font-size: 14px; font-weight: 400; transition: color .2s;
        }
        .navbar-nav a:hover, .navbar-nav a.active { color: var(--navy); }
        .navbar-actions { display: flex; align-items: center; gap: 14px; }
        .btn-ghost {
            color: var(--text-muted); text-decoration: none;
            font-size: 14px; font-weight: 400; transition: color .2s;
            background: none; border: none; cursor: pointer; font-family: var(--font-sans);
        }
        .btn-ghost:hover { color: var(--navy); }
        .btn-primary {
            background: var(--orange); color: #fff;
            padding: 10px 22px; border-radius: 10px;
            text-decoration: none; font-size: 14px; font-weight: 500;
            border: none; cursor: pointer; font-family: var(--font-sans);
            transition: background .2s, transform .15s; display: inline-block;
        }
        .btn-primary:hover { background: #b8741f; transform: translateY(-1px); }

        /* ── Flash ── */
        .flash-container {
            position: fixed; top: 80px; right: 24px; z-index: 999; display: flex; flex-direction: column; gap: 10px;
        }
        .flash {
            padding: 13px 18px; border-radius: var(--radius); font-size: 14px;
            display: flex; align-items: center; gap: 10px;
            animation: slideIn .3s ease, fadeOut .3s ease 4s forwards;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); max-width: 340px;
        }
        .flash.success { background: #f0fdf4; border: 1px solid #86efac; color: #15803d; }
        .flash.error   { background: #fef2f2; border: 1px solid #fca5a5; color: #dc2626; }

        /* ── Page ── */
        .page-content { padding-top: 68px; min-height: 100vh; }

        /* ── Footer ── */
        .footer {
            background: var(--navy); color: rgba(255,255,255,0.6);
            padding: 36px 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer p { font-size: 13px; }
        .footer a { color: var(--orange); text-decoration: none; font-size: 13px; }

        @keyframes slideIn { from { opacity:0; transform:translateX(16px); } to { opacity:1; transform:translateX(0); } }
        @keyframes fadeOut { from { opacity:1; } to { opacity:0; pointer-events:none; } }
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
        <li><a href="#">Fonctionnalités</a></li>
        <li><a href="#">Contact</a></li>
        @auth
            @if(auth()->user()->isSyndic())
                <li><a href="{{ route('syndic.dashboard') }}" class="active">Dashboard</a></li>
            @else
                <li><a href="{{ route('resident.dashboard') }}" class="active">Mon espace</a></li>
            @endif
        @endauth
    </ul>
    <div class="navbar-actions">
        @guest
            <a href="{{ route('login') }}" class="btn-ghost">Connexion</a>
            <a href="{{ route('register') }}" class="btn-primary">Essai gratuit</a>
        @else
            <span style="font-size:14px;color:var(--text-muted);margin-right:4px">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn-ghost">Déconnexion</button>
            </form>
        @endguest
    </div>
</nav>

<div class="flash-container">
    @if(session('success'))
        <div class="flash success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash error">✕ {{ session('error') }}</div>
    @endif
</div>

<main class="page-content">
    @yield('content')
</main>

<footer class="footer">
    <p>© {{ date('Y') }} SyndicPro — Tous droits réservés</p>
    <div style="display:flex;gap:20px">
        <a href="#">Politique de confidentialité</a>
        <a href="#">Mentions légales</a>
    </div>
</footer>

@stack('scripts')
</body>
</html>