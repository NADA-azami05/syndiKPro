@extends('layouts.app')
@section('title', 'Annonces')
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

.ann-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 14px;
    transition: box-shadow .2s
}

.ann-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, .08)
}

.ann-card.urgente {
    border-left: 4px solid #dc2626
}

.ann-card.maintenance {
    border-left: 4px solid #d97706
}

.ann-card.evenement {
    border-left: 4px solid #16a34a
}

.ann-card.generale {
    border-left: 4px solid #006AD7
}

.ann-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 12px
}

.ann-title {
    font-size: 17px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px
}

.ann-meta {
    font-size: 12px;
    color: #6b7280
}

.ann-body {
    font-size: 14px;
    color: #374151;
    line-height: 1.7;
    white-space: pre-line
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 600
}

.b-generale {
    background: #e0f2fe;
    color: #0369a1
}

.b-urgente {
    background: #fee2e2;
    color: #dc2626
}

.b-maintenance {
    background: #fef9c3;
    color: #a16207
}

.b-evenement {
    background: #f0fdf4;
    color: #16a34a
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
            {{-- SEUL CHANGEMENT : resident.annonces.mes → resident.annonces.index --}}
            <a href="{{ route('resident.annonces.index') }}"
                class="sb-item {{ request()->routeIs('resident.annonces*') ? 'active' : '' }}">📣 Annonces</a>
            <a href="{{ route('resident.reunions.mes') }}"
                class="sb-item {{ request()->routeIs('resident.reunions*') ? 'active' : '' }}">📅 Réunions</a>
            <span class="sb-item disabled">🗳️ Votes <span class="badge-soon">bientôt</span></span>
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
            <h1>📣 Annonces</h1>
            <p>Les annonces de votre copropriété</p>
        </div>

        @forelse($annonces as $a)
        <div class="ann-card {{ $a->type }}">
            <div class="ann-head">
                <div>
                    <div class="ann-title">{{ $a->titre }}</div>
                    <div class="ann-meta">
                        {{ $a->copropriete->nom ?? '' }} · {{ $a->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>
                @php
                $types = [
                'generale' => ['label' => '📢 Générale', 'cls' => 'b-generale'],
                'urgente' => ['label' => '🚨 Urgente', 'cls' => 'b-urgente'],
                'maintenance' => ['label' => '🔧 Maintenance', 'cls' => 'b-maintenance'],
                'evenement' => ['label' => '🎉 Événement', 'cls' => 'b-evenement'],
                ];
                $t = $types[$a->type] ?? ['label' => $a->type, 'cls' => 'b-generale'];
                @endphp
                <span class="badge {{ $t['cls'] }}">{{ $t['label'] }}</span>
            </div>
            <div class="ann-body">{{ $a->contenu }}</div>
        </div>
        @empty
        <div class="empty">
            <div class="eicon">📣</div>
            <h3>Aucune annonce</h3>
            <p>Votre syndic n'a pas encore publié d'annonce.</p>
        </div>
        @endforelse

        <div style="margin-top:16px">{{ $annonces->links() }}</div>
    </main>
</div>
@endsection