@extends('layouts.app')
@section('title', 'Réunions')
@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

.dw {
    display: grid;
    grid-template-columns: 220px 1fr;
    min-height: calc(100vh - 68px);
    background: #f0f4ff
}

.sb {
    background: #fff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    padding: 24px 0;
    position: sticky;
    top: 68px;
    height: calc(100vh - 68px)
}

.sb-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    margin-bottom: 16px;
    font-size: 16px;
    font-weight: 600;
    color: #006AD7
}

.sb-logo .ic {
    width: 34px;
    height: 34px;
    background: #006AD7;
    border-radius: 8px;
    display: grid;
    place-items: center;
    font-size: 15px;
    color: #fff
}

.sb-nav {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 0 12px
}

.sb-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    transition: all .2s
}

.sb-item:hover {
    background: #f0f4ff;
    color: #006AD7
}

.sb-item.active {
    background: #006AD7;
    color: #fff
}

.sb-item.disabled {
    opacity: .4;
    cursor: not-allowed;
    pointer-events: none
}

.sb-bot {
    padding: 16px 12px 0;
    border-top: 1px solid #e5e7eb;
    margin-top: auto
}

.sb-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    background: #f0f4ff;
    margin-bottom: 8px
}

.sb-av {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #006AD7;
    color: #fff;
    display: grid;
    place-items: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0
}

.sb-uname {
    font-size: 13px;
    font-weight: 600;
    color: #111
}

.sb-urole {
    font-size: 11px;
    color: #6b7280
}

.sb-out {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    color: #ef4444;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    background: none;
    border: none;
    width: 100%;
    font-family: inherit;
    transition: background .2s
}

.sb-out:hover {
    background: #fef2f2
}

.badge-soon {
    font-size: 9px;
    background: #f0f4ff;
    color: #006AD7;
    padding: 1px 6px;
    border-radius: 20px;
    margin-left: auto;
    font-weight: 600
}

.mc {
    padding: 32px 36px
}

.page-top {
    margin-bottom: 28px
}

.page-top h1 {
    font-family: var(--font-serif);
    font-size: 26px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px
}

.page-top p {
    font-size: 14px;
    color: #6b7280
}

.reu-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 14px;
    display: flex;
    gap: 18px;
    align-items: flex-start;
    transition: box-shadow .2s
}

.reu-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, .08)
}

.reu-date-box {
    background: #006AD7;
    color: #fff;
    border-radius: 12px;
    padding: 12px 16px;
    text-align: center;
    flex-shrink: 0;
    min-width: 60px
}

.reu-day {
    font-family: var(--font-serif);
    font-size: 28px;
    font-weight: 700;
    line-height: 1
}

.reu-month {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 2px
}

.reu-body {
    flex: 1
}

.reu-title {
    font-size: 16px;
    font-weight: 600;
    color: #111;
    margin-bottom: 6px
}

.reu-meta {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 8px
}

.reu-meta span {
    display: flex;
    align-items: center;
    gap: 4px
}

.reu-ordre {
    font-size: 13px;
    color: #374151;
    background: #f8fafc;
    border-radius: 8px;
    padding: 10px 12px;
    margin-top: 8px;
    border-left: 3px solid #006AD7
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600
}

.b-planifiee {
    background: #dbeafe;
    color: #1d4ed8
}

.b-terminee {
    background: #d1fae5;
    color: #059669
}

.b-annulee {
    background: #fee2e2;
    color: #dc2626
}

.empty {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280
}

.empty .eicon {
    font-size: 52px;
    margin-bottom: 16px
}

.empty h3 {
    font-size: 18px;
    font-weight: 600;
    color: #111;
    margin-bottom: 8px
}
</style>
@endpush

@section('content')
<div class="dw">
    <aside class="sb">
        <div class="sb-logo">
            <div class="ic">🏢</div>SyndicPro
        </div>
        <nav class="sb-nav">
            <a href="{{ route('resident.dashboard') }}"
                class="sb-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">🏠 Mon espace</a>
            <a href="{{ route('resident.factures.mes') }}"
                class="sb-item {{ request()->routeIs('resident.factures*') ? 'active' : '' }}">📄 Mes factures</a>
            <a href="{{ route('resident.reclamations.mes') }}"
                class="sb-item {{ request()->routeIs('resident.reclamations*') ? 'active' : '' }}">📢 Mes
                réclamations</a>
            <span class="sb-item disabled">🗳️ Votes <span class="badge-soon">bientôt</span></span>
            <span class="sb-item disabled">📣 Annonces <span class="badge-soon">bientôt</span></span>
            <a href="{{ route('resident.reunions.mes') }}" class="sb-item active">📅 Réunions</a>
        </nav>
        <div class="sb-bot">
            <div class="sb-user">
                <div class="sb-av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="sb-uname">{{ Str::limit(auth()->user()->name, 14) }}</div>
                    <div class="sb-urole">Résident</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit" class="sb-out">🚪 Déconnexion</button>
            </form>
        </div>
    </aside>

    <main class="mc">
        <div class="page-top">
            <h1>📅 Réunions</h1>
            <p>Les réunions planifiées pour votre copropriété</p>
        </div>

        @forelse($reunions as $r)
        <div class="reu-card">
            <div class="reu-date-box">
                <div class="reu-day">{{ $r->date->format('d') }}</div>
                <div class="reu-month">{{ $r->date->translatedFormat('M Y') }}</div>
            </div>
            <div class="reu-body">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
                    <span class="reu-title">{{ $r->titre }}</span>
                    @php $labels = ['planifiee' => 'Planifiée', 'terminee' => 'Terminée', 'annulee' => 'Annulée']
                    @endphp
                    <span class="badge b-{{ $r->statut }}">{{ $labels[$r->statut] ?? $r->statut }}</span>
                </div>
                <div class="reu-meta">
                    <span>🕐 {{ $r->date->format('H:i') }}</span>
                    <span>📍 {{ $r->lieu }}</span>
                    <span>🏙️ {{ $r->copropriete->nom ?? '' }}</span>
                </div>
                @if($r->ordre_jour)
                <div class="reu-ordre">
                    <strong style="font-size:12px;color:#006AD7">Ordre du jour :</strong><br>
                    {{ $r->ordre_jour }}
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="empty">
            <div class="eicon">📅</div>
            <h3>Aucune réunion planifiée</h3>
            <p>Le syndic n'a pas encore planifié de réunion.</p>
        </div>
        @endforelse

        {{ $reunions->links() }}
    </main>
</div>
@endsection