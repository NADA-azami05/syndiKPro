@extends('layouts.app')
@section('title', 'Accueil')

@push('styles')
<style>
/* ── HERO ── */
.hero { min-height: 92vh; display: grid; grid-template-columns: 1fr 1fr; overflow: hidden; background: #f0f4ff; }
.hero-left { display: flex; flex-direction: column; justify-content: center; padding: 80px 60px 80px 100px; background: #f0f4ff; }
.hero-badge { display: inline-flex; align-items: center; gap: 8px; background: #006AD7; border-radius: 100px; padding: 6px 16px; font-size: 13px; color: #fff; margin-bottom: 28px; width: fit-content; }
.hero-badge-dot { width: 7px; height: 7px; background: #fff; border-radius: 50%; }
.hero h1 { font-family: var(--font-serif); font-size: clamp(38px, 4.5vw, 62px); font-weight: 900; line-height: 1.1; color: #111111; margin-bottom: 20px; letter-spacing: -1px; }
.hero h1 em { font-style: italic; color: #006AD7; }
.hero-sub { font-size: 16px; color: #6b7280; line-height: 1.75; max-width: 420px; margin-bottom: 40px; font-weight: 300; }
.hero-btns { display: flex; gap: 14px; }
.btn-hero-main { background: #006AD7; color: #fff; padding: 13px 28px; border-radius: 10px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block; transition: background .2s, transform .15s; }
.btn-hero-main:hover { background: #0055b3; transform: translateY(-2px); }
.btn-hero-ghost { background: #fff; color: #006AD7; border: 1.5px solid #006AD7; padding: 13px 28px; border-radius: 10px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block; transition: background .2s; }
.btn-hero-ghost:hover { background: #e6f2ff; }
.hero-right { position: relative; overflow: hidden; }
.hero-right img { width: 100%; height: 100%; object-fit: cover; display: block; }
.hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, #f0f4ff 0%, rgba(240,244,255,0.5) 25%, transparent 60%); }
.hero-right-overlay-bottom { position: absolute; inset: 0; background: linear-gradient(to top, rgba(240,244,255,0.3) 0%, transparent 40%); }

/* ── STATS ── */
.stats { display: grid; grid-template-columns: repeat(3,1fr); background: #fff; border-top: 3px solid #006AD7; border-bottom: 1px solid #e5e7eb; }
.stat { padding: 40px 50px; text-align: center; border-right: 1px solid #e5e7eb; }
.stat:last-child { border-right: none; }
.stat-num { font-family: var(--font-serif); font-size: 44px; font-weight: 700; color: #006AD7; display: block; line-height: 1; }
.stat-label { font-size: 13px; color: #6b7280; margin-top: 8px; }

/* ── FEATURES ── */
.features { padding: 100px 80px; background: #f0f4ff; }
.section-header { text-align: center; margin-bottom: 60px; }
.section-header h2 { font-family: var(--font-serif); font-size: clamp(32px,4vw,50px); font-weight: 700; color: #111111; margin-bottom: 14px; }
.section-header p { font-size: 16px; color: #6b7280; font-weight: 300; }
.features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; }
.feature-card { background: #fff; border: 1px solid #e5e7eb; border-top: 3px solid #006AD7; border-radius: 20px; padding: 36px; transition: box-shadow .3s, transform .3s; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
.feature-card:hover { box-shadow: 0 8px 32px rgba(0,106,215,0.15); transform: translateY(-4px); }
.feature-icon { width: 52px; height: 52px; background: #e6f2ff; border-radius: 12px; display: grid; place-items: center; font-size: 22px; margin-bottom: 22px; }
.feature-card h3 { font-family: var(--font-serif); font-size: 18px; font-weight: 700; color: #111111; margin-bottom: 12px; }
.feature-card p { font-size: 14px; color: #6b7280; line-height: 1.75; font-weight: 300; }

/* ── TESTIMONIALS ── */
.testimonials { padding: 100px 80px; background: #fff; }
.testimonials-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; margin-top: 60px; }
.testi-card { background: #f0f4ff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 32px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
.testi-stars { color: #006AD7; font-size: 14px; margin-bottom: 18px; letter-spacing: 2px; }
.testi-text { font-family: var(--font-serif); font-style: italic; font-size: 16px; color: #111111; line-height: 1.7; margin-bottom: 24px; }
.testi-author { display: flex; align-items: center; gap: 12px; }
.testi-avatar { width: 42px; height: 42px; border-radius: 50%; background: #21277B; display: grid; place-items: center; color: #9AD9EA; font-weight: 700; font-size: 15px; flex-shrink: 0; }
.testi-name { font-size: 14px; font-weight: 500; color: #111111; }
.testi-role { font-size: 12px; color: #6b7280; margin-top: 2px; }

/* ── CONTACT ── */
.contact-section { padding: 100px 80px; background: #f0f4ff; text-align: center; }
.contact-section h2 { font-family: var(--font-serif); font-size: clamp(32px,4vw,50px); font-weight: 700; color: #111111; margin-bottom: 14px; }
.contact-section > p { font-size: 16px; color: #6b7280; font-weight: 300; margin-bottom: 60px; }
.contact-cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; max-width: 900px; margin: 0 auto; }
.contact-card { background: #fff; border: 1px solid #e5e7eb; border-top: 3px solid #006AD7; border-radius: 20px; padding: 40px 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: box-shadow .3s, transform .3s; }
.contact-card:hover { box-shadow: 0 8px 32px rgba(0,106,215,0.15); transform: translateY(-4px); }
.contact-card-icon { width: 60px; height: 60px; background: #e6f2ff; border-radius: 16px; display: grid; place-items: center; font-size: 26px; margin: 0 auto 20px; }
.contact-card h3 { font-size: 13px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; color: #006AD7; margin-bottom: 10px; }
.contact-card p { font-size: 15px; color: #111111; font-weight: 500; }
.contact-card span { font-size: 13px; color: #6b7280; display: block; margin-top: 4px; }

/* ── RÉGLEMENTATION ── */
.reglementation {
    padding: 100px 80px; background: #fff;
    scroll-margin-top: 80px;
}
.regl-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 50px; gap: 40px; }
.regl-header-left h2 { font-family: var(--font-serif); font-size: clamp(28px,3.5vw,44px); font-weight: 700; color: #111111; margin-bottom: 12px; }
.regl-header-left p { font-size: 15px; color: #6b7280; font-weight: 300; max-width: 500px; line-height: 1.7; }
.regl-badge { background: linear-gradient(135deg, #21277B, #006AD7); color: #fff; padding: 12px 22px; border-radius: 12px; font-size: 13px; font-weight: 500; text-align: center; white-space: nowrap; }
.regl-badge span { display: block; font-size: 11px; opacity: 0.75; margin-bottom: 4px; }

/* Accordéon */
.regl-accordion { display: flex; flex-direction: column; gap: 12px; }
.regl-item { border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden; transition: box-shadow .2s; }
.regl-item:hover { box-shadow: 0 4px 20px rgba(0,106,215,0.10); }
.regl-trigger {
    width: 100%; background: #fff; border: none; cursor: pointer;
    padding: 22px 28px; display: flex; align-items: center; gap: 16px;
    font-family: var(--font-sans); text-align: left;
    transition: background .2s;
}
.regl-trigger:hover { background: #f0f4ff; }
.regl-trigger.open { background: #f0f4ff; border-bottom: 1px solid #e5e7eb; }
.regl-trigger-icon { width: 42px; height: 42px; background: #e6f2ff; border-radius: 10px; display: grid; place-items: center; font-size: 18px; flex-shrink: 0; }
.regl-trigger-title { flex: 1; font-size: 16px; font-weight: 600; color: #111111; }
.regl-trigger-num { font-size: 12px; color: #006AD7; font-weight: 600; margin-right: 8px; }
.regl-trigger-arrow { font-size: 18px; color: #006AD7; transition: transform .3s; flex-shrink: 0; }
.regl-trigger.open .regl-trigger-arrow { transform: rotate(180deg); }
.regl-content { display: none; padding: 28px; background: #fafbff; }
.regl-content.open { display: block; animation: fadeIn .2s ease; }

/* Contenu réglementation */
.regl-section-title { font-size: 14px; font-weight: 700; color: #006AD7; margin: 20px 0 10px; text-transform: uppercase; letter-spacing: 0.5px; }
.regl-section-title:first-child { margin-top: 0; }
.regl-text { font-size: 14px; color: #444; line-height: 1.8; margin-bottom: 14px; font-weight: 300; }
.regl-list { list-style: none; display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
.regl-list li { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #444; line-height: 1.6; font-weight: 300; }
.regl-list li::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: #006AD7; flex-shrink: 0; margin-top: 7px; }
.regl-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 16px; }
.regl-table th { background: #21277B; color: #fff; padding: 10px 14px; text-align: left; font-weight: 600; }
.regl-table td { padding: 10px 14px; border-bottom: 1px solid #e5e7eb; color: #444; }
.regl-table tr:nth-child(even) td { background: #f5f8ff; }
.regl-note { background: #e6f2ff; border-left: 4px solid #006AD7; border-radius: 0 10px 10px 0; padding: 14px 18px; font-size: 13px; color: #21277B; margin: 16px 0; line-height: 1.6; }
.regl-source { display: inline-flex; align-items: center; gap: 8px; background: #006AD7; color: #fff; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 500; text-decoration: none; margin-top: 16px; transition: background .2s; }
.regl-source:hover { background: #0055b3; }

@keyframes fadeIn { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-badge"><span class="hero-badge-dot"></span> Plateforme de gestion n°1 au Maroc</div>
        <h1>Gérez votre<br>copropriété<br><em>simplement</em></h1>
        <p class="hero-sub">SyndicPro réunit syndics et copropriétaires dans une plateforme unique, intuitive et sécurisée.</p>
        <div class="hero-btns">
            <a href="{{ route('login') }}" class="btn-hero-main">Commencer</a>
            <a href="#features" class="btn-hero-ghost">En savoir plus</a>
        </div>
    </div>
    <div class="hero-right">
        <img src="/images/hero_home.jpg" alt="Résidence SyndicPro">
        <div class="hero-right-overlay"></div>
        <div class="hero-right-overlay-bottom"></div>
    </div>
</section>

{{-- STATS --}}
<div class="stats">
    <div class="stat"><span class="stat-num">1 200+</span><div class="stat-label">Résidences gérées</div></div>
    <div class="stat"><span class="stat-num">98 %</span><div class="stat-label">Satisfaction client</div></div>
    <div class="stat"><span class="stat-num">45 000+</span><div class="stat-label">Résidents connectés</div></div>
</div>

{{-- FEATURES --}}
<section class="features" id="features">
    <div class="section-header">
        <h2>Une suite complète pour votre résidence</h2>
        <p>Tout ce dont vous avez besoin, dans un seul espace.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card"><div class="feature-icon">💳</div><h3>Finances & charges</h3><p>Répartissez les charges, suivez les paiements et générez les appels de fonds en quelques clics.</p></div>
        <div class="feature-card"><div class="feature-icon">📁</div><h3>Documents & archives</h3><p>PV d'AG, règlements, contrats — centralisés dans un espace partagé et sécurisé.</p></div>
        <div class="feature-card"><div class="feature-icon">📢</div><h3>Communication</h3><p>Messagerie, notifications push et tableau d'affichage numérique pour tous les résidents.</p></div>
        <div class="feature-card"><div class="feature-icon">🗳️</div><h3>Assemblées générales</h3><p>Convocations dématérialisées, votes en ligne et procès-verbaux automatiques.</p></div>
        <div class="feature-card"><div class="feature-icon">🔧</div><h3>Travaux & incidents</h3><p>Déclarez, suivez et clôturez les interventions avec photos et historique complet.</p></div>
        <div class="feature-card"><div class="feature-icon">📊</div><h3>Tableau de bord</h3><p>Vue d'ensemble en temps réel de l'ensemble de vos copropriétés et indicateurs clés.</p></div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testimonials">
    <div class="section-header"><h2>Ils nous font confiance</h2></div>
    <div class="testimonials-grid">
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"SyndicPro a divisé par 3 le temps que je consacrais à la gestion administrative. Indispensable."</p>
            <div class="testi-author"><div class="testi-avatar">M</div><div><div class="testi-name">Marie Lefort</div><div class="testi-role">Syndic professionnel · Casablanca</div></div></div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"Enfin une plateforme où tous les copropriétaires s'y retrouvent, même les moins technophiles."</p>
            <div class="testi-author"><div class="testi-avatar">A</div><div><div class="testi-name">Ahmed Benali</div><div class="testi-role">Président de conseil syndical</div></div></div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-text">"La gestion des AG en ligne a transformé notre façon de travailler. Un gain de temps considérable."</p>
            <div class="testi-author"><div class="testi-avatar">S</div><div><div class="testi-name">Sara Marchetti</div><div class="testi-role">Gestionnaire · Rabat</div></div></div>
        </div>
    </div>
</section>

{{-- RÉGLEMENTATION --}}
<section class="reglementation" id="reglementation">
    <div class="regl-header">
        <div class="regl-header-left">
            <h2>Réglementation Copropriété</h2>
            <p>Tout ce que vous devez savoir sur le cadre juridique marocain régissant la gestion des copropriétés — Loi 18.00.</p>
        </div>
        <div class="regl-badge">
            <span>Texte officiel</span>
            Loi n° 18.00
        </div>
    </div>

    <div class="regl-accordion">

        {{-- 1. Présentation --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">⚖️</div>
                <span class="regl-trigger-num">01</span>
                <span class="regl-trigger-title">Présentation de la Loi 18.00</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-text">La Loi n° 18.00 relative au statut de la copropriété des immeubles bâtis est le texte fondamental régissant la vie en copropriété au Maroc. Elle a été promulguée par le Dahir n° 1-02-298 du 25 rejeb 1423 (3 octobre 2002) et publiée au Bulletin Officiel n° 5400 du 3 novembre 2002.</p>
                <table class="regl-table">
                    <tr><th>Référence</th><th>Détail</th></tr>
                    <tr><td>Intitulé</td><td>Loi relative au statut de la copropriété des immeubles bâtis</td></tr>
                    <tr><td>Numéro</td><td>Loi 18.00</td></tr>
                    <tr><td>Publication</td><td>Bulletin Officiel n° 5400 — 3 novembre 2002</td></tr>
                    <tr><td>Décret d'application</td><td>Décret n° 2-03-310 du 30 septembre 2003</td></tr>
                    <tr><td>Modification</td><td>Décret n° 2-16-301 (2016)</td></tr>
                </table>

            </div>
        </div>

        {{-- 2. Définitions --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">📖</div>
                <span class="regl-trigger-num">02</span>
                <span class="regl-trigger-title">Définitions et Terminologie</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">La Copropriété</p>
                <p class="regl-text">Immeuble bâti dont la propriété est répartie entre plusieurs personnes par lots comprenant une partie privative et une quote-part des parties communes.</p>
                <p class="regl-section-title">Les Parties Privatives</p>
                <p class="regl-text">Parties de l'immeuble à usage exclusif d'un copropriétaire : appartements, locaux commerciaux, caves, parkings attribués individuellement.</p>
                <p class="regl-section-title">Les Parties Communes</p>
                <ul class="regl-list">
                    <li>Le sol, les cours, les jardins et espaces verts</li>
                    <li>Les voies d'accès, couloirs et escaliers</li>
                    <li>Les ascenseurs et leurs gaines</li>
                    <li>Les canalisations et réseaux collectifs</li>
                    <li>Les toitures, façades et structures portantes</li>
                </ul>
                <p class="regl-section-title">Le Syndicat des Copropriétaires</p>
                <p class="regl-text">Personne morale de droit privé regroupant tous les copropriétaires, chargée de la conservation de l'immeuble et de l'administration des parties communes.</p>
                <p class="regl-section-title">Le Syndic</p>
                <p class="regl-text">Personne physique ou morale désignée par l'assemblée générale pour gérer l'immeuble. Il est le mandataire légal du syndicat.</p>
                <div class="regl-note">💡 Dans SyndicPro, le rôle "Syndic" correspond à ce mandataire légal disposant de tous les pouvoirs de gestion.</div>
            </div>
        </div>

        {{-- 3. Droits & Obligations --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">🤝</div>
                <span class="regl-trigger-num">03</span>
                <span class="regl-trigger-title">Droits et Obligations des Parties</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">Droits des Copropriétaires</p>
                <ul class="regl-list">
                    <li>Jouissance exclusive de sa partie privative</li>
                    <li>Utilisation des parties communes selon leur destination</li>
                    <li>Participation aux assemblées générales avec droit de vote</li>
                    <li>Accès aux documents comptables et procès-verbaux</li>
                    <li>Contestation des décisions dans les délais légaux (2 mois)</li>
                </ul>
                <p class="regl-section-title">Obligations des Copropriétaires</p>
                <ul class="regl-list">
                    <li>Paiement des charges communes à hauteur de leur quote-part</li>
                    <li>Respect du règlement de copropriété</li>
                    <li>Non-modification des parties communes sans autorisation</li>
                    <li>Entretien des parties privatives pour éviter tout trouble</li>
                </ul>
                <p class="regl-section-title">Obligations du Syndic</p>
                <ul class="regl-list">
                    <li>Exécution des décisions de l'assemblée générale</li>
                    <li>Établissement du budget prévisionnel annuel</li>
                    <li>Tenue d'une comptabilité régulière et séparée</li>
                    <li>Souscription des assurances obligatoires</li>
                    <li>Conservation des archives du syndicat</li>
                    <li>Entretien et conservation des parties communes</li>
                </ul>
                <div class="regl-note">💡 SyndicPro automatise ces obligations via les modules Factures, Réclamations, Fournisseurs et Tableau de bord.</div>
            </div>
        </div>

        {{-- 4. Assemblée Générale --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">🗳️</div>
                <span class="regl-trigger-num">04</span>
                <span class="regl-trigger-title">L'Assemblée Générale</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">Convocation</p>
                <p class="regl-text">L'assemblée générale ordinaire doit être convoquée au moins une fois par an. La convocation doit être adressée à chaque copropriétaire par lettre recommandée, au moins <strong>15 jours</strong> avant la réunion.</p>
                <p class="regl-section-title">Majorités requises</p>
                <table class="regl-table">
                    <tr><th>Type de décision</th><th>Majorité</th></tr>
                    <tr><td>Décisions courantes de gestion</td><td>Majorité simple (50% + 1)</td></tr>
                    <tr><td>Travaux d'amélioration</td><td>Majorité absolue (2/3 des voix)</td></tr>
                    <tr><td>Modification du règlement</td><td>Majorité qualifiée</td></tr>
                    <tr><td>Changement de destination</td><td>Unanimité</td></tr>
                    <tr><td>Vente des parties communes</td><td>Unanimité</td></tr>
                </table>
                <p class="regl-section-title">Procès-Verbal</p>
                <p class="regl-text">Les délibérations font l'objet d'un procès-verbal, adressé à tous les copropriétaires dans les <strong>8 jours</strong> suivant la réunion.</p>
                <div class="regl-note">💡 SyndicPro génère automatiquement les PV et les distribue numériquement à tous les copropriétaires.</div>
            </div>
        </div>

        {{-- 5. Charges --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">💳</div>
                <span class="regl-trigger-num">05</span>
                <span class="regl-trigger-title">Charges et Gestion Financière</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">Charges Générales</p>
                <p class="regl-text">Concernent la conservation, l'entretien et l'administration des parties communes. Réparties entre tous les copropriétaires proportionnellement à leurs quotes-parts.</p>
                <p class="regl-section-title">Charges Spéciales</p>
                <p class="regl-text">Concernent les services et équipements dont certains copropriétaires ne profitent pas. Réparties uniquement entre les copropriétaires concernés.</p>
                <p class="regl-section-title">Fonds de Réserve</p>
                <p class="regl-text">L'assemblée générale peut décider la constitution d'un fonds de réserve pour financer les travaux importants. Ce fonds est géré séparément des charges courantes.</p>
                <div class="regl-note">💡 Le module Factures de SyndicPro gère le calcul automatique et l'émission des appels de fonds pour chaque copropriétaire.</div>
            </div>
        </div>

        {{-- 6. Travaux --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">🔧</div>
                <span class="regl-trigger-num">06</span>
                <span class="regl-trigger-title">Les Travaux en Copropriété</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">Travaux d'Entretien Courant</p>
                <p class="regl-text">Peuvent être décidés par le syndic sans autorisation préalable de l'assemblée générale, dans la limite du budget voté.</p>
                <p class="regl-section-title">Travaux Urgents</p>
                <p class="regl-text">En cas d'urgence, le syndic peut faire exécuter les travaux nécessaires à la sauvegarde de l'immeuble sans attendre une assemblée générale, puis en informer immédiatement les copropriétaires.</p>
                <p class="regl-section-title">Travaux d'Amélioration</p>
                <p class="regl-text">Doivent être votés en assemblée générale à la <strong>majorité des deux tiers</strong>. Ils font l'objet d'un appel de fonds spécifique.</p>
                <div class="regl-note">💡 Le module Réclamations et Fournisseurs de SyndicPro assure le suivi complet des interventions.</div>
            </div>
        </div>

        {{-- 7. Litiges --}}
        <div class="regl-item">
            <button class="regl-trigger" onclick="toggleRegl(this)">
                <div class="regl-trigger-icon">⚖️</div>
                <span class="regl-trigger-num">07</span>
                <span class="regl-trigger-title">Résolution des Litiges</span>
                <span class="regl-trigger-arrow">▼</span>
            </button>
            <div class="regl-content">
                <p class="regl-section-title">Contestation des Décisions</p>
                <p class="regl-text">Tout copropriétaire peut contester une décision de l'assemblée générale devant le tribunal compétent dans un délai de <strong>2 mois</strong> suivant la notification du procès-verbal.</p>
                <p class="regl-section-title">Juridictions Compétentes</p>
                <table class="regl-table">
                    <tr><th>Type de litige</th><th>Juridiction</th></tr>
                    <tr><td>Litiges entre copropriétaires</td><td>Tribunal de première instance</td></tr>
                    <tr><td>Litiges avec le syndic</td><td>Tribunal de première instance</td></tr>
                    <tr><td>Charges impayées</td><td>Injonction de payer</td></tr>
                    <tr><td>Nullité d'assemblée générale</td><td>Tribunal de première instance</td></tr>
                </table>

            </div>
        </div>

    </div>
</section>

{{-- CONTACT --}}
<section class="contact-section" id="contact">
    <h2>Contactez-nous</h2>
    <p>Notre équipe est à votre disposition pour toute question.</p>
    <div class="contact-cards">
        <div class="contact-card"><div class="contact-card-icon">📧</div><h3>Email</h3><p>contact@syndicpro.ma</p><span>Réponse sous 24h</span></div>
        <div class="contact-card"><div class="contact-card-icon">📞</div><h3>Téléphone</h3><p>+212 5 22 00 00 00</p><span>Lun – Ven, 9h – 18h</span></div>
        <div class="contact-card"><div class="contact-card-icon">📍</div><h3>Adresse</h3><p>Casablanca, Maroc</p><span>Maarif, 20100</span></div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function toggleRegl(btn) {
    const content = btn.nextElementSibling;
    const isOpen = btn.classList.contains('open');

    // Fermer tous
    document.querySelectorAll('.regl-trigger').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.regl-content').forEach(c => c.classList.remove('open'));

    // Ouvrir si était fermé
    if (!isOpen) {
        btn.classList.add('open');
        content.classList.add('open');
    }
}

// Scroll auto si on clique sur "Réglementation copropriété" dans la navbar
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#reglementation') {
        setTimeout(() => {
            document.getElementById('reglementation')?.scrollIntoView({ behavior: 'smooth' });
        }, 300);
    }
});
</script>
@endpush