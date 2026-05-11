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

.mc {
    padding: 32px 36px
}

.page-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px
}

.page-top h1 {
    font-family: var(--font-serif);
    font-size: 24px;
    font-weight: 700;
    color: #111
}

.page-top p {
    font-size: 14px;
    color: #6b7280;
    margin-top: 4px
}

.btn-new {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #006AD7;
    color: #fff;
    padding: 11px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s
}

.btn-new:hover {
    background: #0055b3
}

.ann-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    margin-bottom: 14px;
    transition: box-shadow .2s
}

.ann-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, .08)
}

.ann-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 10px
}

.ann-title {
    font-size: 16px;
    font-weight: 600;
    color: #111
}

.ann-meta {
    font-size: 12px;
    color: #6b7280;
    margin-top: 4px
}

.ann-body {
    font-size: 14px;
    color: #374151;
    line-height: 1.6
}

.ann-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid #f5f5f5
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 100px;
    font-size: 11px;
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

.b-publiee {
    background: #f0fdf4;
    color: #16a34a
}

.b-brouillon {
    background: #f9fafb;
    color: #6b7280
}

.ann-actions {
    display: flex;
    gap: 8px
}

.btn-edit {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    background: #f0f4ff;
    color: #006AD7;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: background .2s
}

.btn-edit:hover {
    background: #dbeafe
}

.btn-del {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    background: #fef2f2;
    color: #dc2626;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-family: inherit;
    transition: background .2s
}

.btn-del:hover {
    background: #fee2e2
}

.empty {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    color: #6b7280
}

.empty .eicon {
    font-size: 52px;
    margin-bottom: 16px
}
</style>
@endpush

@section('content')
<div class="dw">
    <aside class="sb">
        <nav class="sb-nav">
            <a href="{{ route('syndic.dashboard') }}"
                class="sb-item {{ request()->routeIs('syndic.dashboard') ? 'active' : '' }}">📊 Tableau de bord</a>
            <a href="{{ route('syndic.coproprietes.index') }}"
                class="sb-item {{ request()->routeIs('syndic.coproprietes*') ? 'active' : '' }}">🏙️ Copropriétés</a>
            <a href="{{ route('syndic.residents.index') }}"
                class="sb-item {{ request()->routeIs('syndic.residents*') ? 'active' : '' }}">👥 Résidents</a>
            <a href="{{ route('syndic.lots.index') }}"
                class="sb-item {{ request()->routeIs('syndic.lots*') ? 'active' : '' }}">🏠 Lots</a>
            <a href="{{ route('syndic.factures.index') }}"
                class="sb-item {{ request()->routeIs('syndic.factures*') ? 'active' : '' }}">📄 Factures</a>
            <a href="{{ route('syndic.reclamations.index') }}"
                class="sb-item {{ request()->routeIs('syndic.reclamations*') ? 'active' : '' }}">📢 Réclamations</a>
            <a href="{{ route('syndic.reunions.index') }}"
                class="sb-item {{ request()->routeIs('syndic.reunions*') ? 'active' : '' }}">📅 Réunions</a>
            <a href="#" class="sb-item">🔧 Fournisseurs</a>
            <a href="#" class="sb-item">🗳️ Votes</a>
            <a href="{{ route('syndic.annonces.index') }}"
                class="sb-item {{ request()->routeIs('syndic.annonces*') ? 'active' : '' }}">📣 Annonces</a>
        </nav>
        <div class="sb-bot">
            <div class="sb-user">
                <div class="sb-av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="sb-uname">{{ Str::limit(auth()->user()->name, 14) }}</div>
                    <div class="sb-urole">Syndic</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit" class="sb-out">🚪 Déconnexion</button>
            </form>
        </div>
    </aside>

    <main class="mc">
        <div class="page-top">
            <div>
                <h1>📣 Annonces</h1>
                <p>Gérez les annonces publiées aux résidents.</p>
            </div>
            <a href="{{ route('syndic.annonces.create') }}" class="btn-new">＋ Nouvelle annonce</a>
        </div>

        @if(session('success'))
        <div
            style="background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
            ✅ {{ session('success') }}
        </div>
        @endif

        @forelse($annonces as $a)
        <div class="ann-card">
            <div class="ann-head">
                <div>
                    <div class="ann-title">{{ $a->titre }}</div>
                    <div class="ann-meta">
                        {{ $a->copropriete->nom ?? '—' }} · {{ $a->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-shrink:0">
                    @php
                    $types = ['generale' => ['label' => 'Générale', 'cls' => 'b-generale'], 'urgente' => ['label' =>
                    'Urgente', 'cls' => 'b-urgente'], 'maintenance' => ['label' => 'Maintenance', 'cls' =>
                    'b-maintenance'], 'evenement' => ['label' => 'Événement', 'cls' => 'b-evenement']];
                    $t = $types[$a->type] ?? ['label' => $a->type, 'cls' => 'b-generale'];
                    @endphp
                    <span class="badge {{ $t['cls'] }}">{{ $t['label'] }}</span>
                    <span class="badge {{ $a->publiee ? 'b-publiee' : 'b-brouillon' }}">
                        {{ $a->publiee ? '✅ Publiée' : '📝 Brouillon' }}
                    </span>
                </div>
            </div>
            <div class="ann-body">{{ Str::limit($a->contenu, 200) }}</div>
            <div class="ann-footer">
                <span style="font-size:12px;color:#9ca3af">Par {{ $a->user->name ?? 'Syndic' }}</span>
                <div class="ann-actions">
                    <a href="{{ route('syndic.annonces.edit', $a) }}" class="btn-edit">✏️ Modifier</a>
                    <form action="{{ route('syndic.annonces.destroy', $a) }}" method="POST"
                        onsubmit="return confirm('Supprimer cette annonce ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-del">🗑 Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty">
            <div class="eicon">📣</div>
            <h3 style="font-size:18px;font-weight:600;color:#111;margin-bottom:8px">Aucune annonce</h3>
            <p>Créez votre première annonce pour informer les résidents.</p>
        </div>
        @endforelse

        <div style="margin-top:16px">{{ $annonces->links() }}</div>
    </main>
</div>
@endsection