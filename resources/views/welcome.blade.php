@extends('layouts.app')
@section('title', 'Accueil')

@push('styles')
<style>
/* ── HERO ── */
.hero {
    position: relative; min-height: 100vh;
    display: flex; align-items: center; overflow: hidden;
    background: transparent;

}
.hero-bg {
    position: absolute; inset: 0;
    background: url('{{ asset('images/hero_home.jpg') }}') center/cover no-repeat;
    opacity: 1;  /* ← photo à 100% */

}
.hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.55) 45%, rgba(0,0,0,0.25) 100%);

}
.hero-content {
    position: relative; z-index: 2;
    padding: 0 100px; max-width: 780px;
    animation: fadeUp .9s ease both;
}
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.10); border: 1px solid rgba(255,255,255,0.18);
    border-radius: 100px; padding: 6px 16px;
    font-size: 13px; color: rgba(255,255,255,0.85);
    margin-bottom: 30px; backdrop-filter: blur(8px);
}
.hero-badge-dot { width: 7px; height: 7px; background: var(--orange); border-radius: 50%; }
.hero h1 {
    font-family: var(--font-serif); font-size: clamp(50px,5.5vw,82px);
    font-weight: 900; line-height: 1.05; color: #fff;
    margin-bottom: 24px; letter-spacing: -1px;
}
.hero h1 em { font-style: italic; color: var(--orange); }
.hero-sub {
    font-size: 17px; color: rgba(255,255,255,0.60);
    line-height: 1.75; max-width: 460px; margin-bottom: 46px; font-weight: 300;
}
.hero-search {
    display: flex; max-width: 600px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 12px; overflow: hidden; backdrop-filter: blur(12px);
}
.hero-field {
    flex: 1; display: flex; align-items: center; gap: 10px;
    padding: 14px 20px; border-right: 1px solid rgba(255,255,255,0.10);
}
.hero-field input {
    background: transparent; border: none; outline: none;
    color: #fff; font-size: 14px; font-family: var(--font-sans); width: 100%; font-weight: 300;
}
.hero-field input::placeholder { color: rgba(255,255,255,0.35); }
.hero-field span { color: rgba(255,255,255,0.35); font-size: 15px; flex-shrink: 0; }
.hero-search-btn {
    background: var(--orange); color: #fff; border: none;
    padding: 14px 28px; font-size: 14px; font-weight: 500;
    cursor: pointer; font-family: var(--font-sans);
    transition: background .2s; white-space: nowrap;
}
.hero-search-btn:hover { background: #b8741f; }

/* ── STATS ── */
.stats {
    display: grid; grid-template-columns: repeat(3,1fr);
    background: #fff; border-bottom: 1px solid var(--border);
}
.stat {
    padding: 42px 50px; text-align: center;
    border-right: 1px solid var(--border);
}
.stat:last-child { border-right: none; }
.stat-num {
    font-family: var(--font-serif); font-size: 44px; font-weight: 700;
    color: var(--orange); display: block; line-height: 1;
}
.stat-label { font-size: 13px; color: var(--text-muted); margin-top: 8px; }

/* ── FEATURES ── */
.features { padding: 100px 80px; background: var(--bg); }
.section-header { text-align: center; margin-bottom: 60px; }
.section-header h2 {
    font-family: var(--font-serif); font-size: clamp(32px,4vw,52px);
    font-weight: 700; color: var(--navy); margin-bottom: 14px;
}
.section-header p { font-size: 16px; color: var(--text-muted); font-weight: 300; }
.features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; }
.feature-card {
    background: var(--bg-white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 36px;
    transition: box-shadow .3s, transform .3s;
    box-shadow: var(--card-shadow);
}
.feature-card:hover { box-shadow: var(--card-shadow-hover); transform: translateY(-4px); }
.feature-icon {
    width: 52px; height: 52px; background: var(--orange-light);
    border-radius: 12px; display: grid; place-items: center;
    font-size: 22px; margin-bottom: 22px;
}
.feature-card h3 {
    font-family: var(--font-serif); font-size: 18px; font-weight: 700;
    color: var(--navy); margin-bottom: 12px;
}
.feature-card p { font-size: 14px; color: var(--text-muted); line-height: 1.75; font-weight: 300; }

/* ── TESTIMONIALS ── */
.testimonials { padding: 100px 80px; background: var(--bg-white); }
.testimonials-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; margin-top: 60px; }
.testi-card {
    background: var(--bg); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 32px;
    box-shadow: var(--card-shadow);
}
.testi-stars { color: var(--orange); font-size: 14px; margin-bottom: 18px; letter-spacing: 2px; }
.testi-text {
    font-family: var(--font-serif); font-style: italic;
    font-size: 16px; color: var(--navy); line-height: 1.7; margin-bottom: 24px;
}
.testi-author { display: flex; align-items: center; gap: 12px; }
.testi-avatar {
    width: 42px; height: 42px; border-radius: 50%; background: var(--navy);
    display: grid; place-items: center; color: var(--orange);
    font-weight: 700; font-size: 15px; flex-shrink: 0;
}
.testi-name { font-size: 14px; font-weight: 500; color: var(--navy); }
.testi-role { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

/* ── CTA ── */
.cta-section {
    padding: 100px 80px; text-align: center;
    background: linear-gradient(135deg, var(--navy) 0%, #2d3a5c 100%);
}
.cta-section h2 {
    font-family: var(--font-serif); font-size: clamp(32px,4vw,52px);
    font-weight: 700; color: #fff; margin-bottom: 18px;
}
.cta-section p { font-size: 16px; color: rgba(255,255,255,0.60); margin-bottom: 40px; font-weight: 300; }
.cta-buttons { display: flex; gap: 16px; justify-content: center; }
.btn-white {
    background: #fff; color: var(--navy); padding: 14px 32px;
    border-radius: 10px; font-size: 15px; font-weight: 500;
    text-decoration: none; transition: transform .2s; display: inline-block;
}
.btn-white:hover { transform: translateY(-2px); }
.btn-outline-white {
    background: transparent; color: #fff;
    border: 1px solid rgba(255,255,255,0.35);
    padding: 14px 32px; border-radius: 10px;
    font-size: 15px; font-weight: 400; text-decoration: none;
    transition: border-color .2s; display: inline-block;
}
.btn-outline-white:hover { border-color: rgba(255,255,255,0.7); }

@keyframes fadeUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Plateforme de gestion n°1 au Maroc
        </div>
        <h1>La gestion de<br>copropriété <em>simplifiée</em></h1>
        <p class="hero-sub">
            SyndicPro réunit syndics et copropriétaires dans une plateforme unique, intuitive et sécurisée.
        </p>
        <div class="hero-search">
            <div class="hero-field">
                <span>🏠</span>
                <input type="text" placeholder="Nom de la résidence">
            </div>
            <div class="hero-field">
                <span>☰</span>
                <input type="text" placeholder="Type de copropriété">
            </div>
            <button class="hero-search-btn">Rechercher</button>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats">
    <div class="stat"><span class="stat-num">1 200+</span><div class="stat-label">Résidences gérées</div></div>
    <div class="stat"><span class="stat-num">98 %</span><div class="stat-label">Satisfaction client</div></div>
    <div class="stat"><span class="stat-num">45 000+</span><div class="stat-label">Résidents connectés</div></div>
</div>

{{-- FEATURES --}}
<section class="features">
    <div class="section-header">
        <h2>Une suite complète pour votre résidence</h2>
        <p>Tout ce dont vous avez besoin, dans un seul espace.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">💳</div>
            <h3>Finances & charges</h3>
            <p>Répartissez les charges, suivez les paiements et générez les appels de fonds en quelques clics.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📁</div>
            <h3>Documents & archives</h3>
            <p>PV d'AG, règlements, contrats — centralisés dans un espace partagé et sécurisé.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📢</div>
            <h3>Communication</h3>
            <p>Messagerie, notifications push et tableau d'affichage numérique pour tous les résidents.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🗳️</div>
            <h3>Assemblées générales</h3>
            <p>Convocations dématérialisées, votes en ligne et procès-verbaux automatiques.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔧</div>
            <h3>Travaux & incidents</h3>
            <p>Déclarez, suivez et clôturez les interventions avec photos et historique complet.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Tableau de bord</h3>
            <p>Vue d'ensemble en temps réel de l'ensemble de vos copropriétés et indicateurs clés.</p>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testimonials">
    <div class="section-header">
        <h2>Ils nous font confiance</h2>
    </div>
    <div class="testimonials-grid">
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"SyndicPro a divisé par 3 le temps que je consacrais à la gestion administrative. Indispensable."</p>
            <div class="testi-author">
                <div class="testi-avatar">M</div>
                <div>
                    <div class="testi-name">Marie Lefort</div>
                    <div class="testi-role">Syndic professionnel · Casablanca</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"Enfin une plateforme où tous les copropriétaires s'y retrouvent, même les moins technophiles."</p>
            <div class="testi-author">
                <div class="testi-avatar">A</div>
                <div>
                    <div class="testi-name">Ahmed Benali</div>
                    <div class="testi-role">Président de conseil syndical</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"La gestion des AG en ligne a transformé notre façon de travailler. Un gain de temps considérable."</p>
            <div class="testi-author">
                <div class="testi-avatar">S</div>
                <div>
                    <div class="testi-name">Sara Marchetti</div>
                    <div class="testi-role">Gestionnaire · Rabat</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <h2>Prêt à moderniser votre syndic ?</h2>
    <p>Rejoignez plus de 1 200 résidences qui font confiance à SyndicPro.</p>
    <div class="cta-buttons">
        <a href="{{ route('register') }}" class="btn-white">Commencer gratuitement</a>
        <a href="{{ route('login') }}" class="btn-outline-white">Se connecter</a>
    </div>
</section>

@endsection