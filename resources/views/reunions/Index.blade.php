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
    background: #0055b3;
    color: #fff
}

.card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
}

table {
    width: 100%;
    border-collapse: collapse
}

th {
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .5px;
    text-transform: uppercase;
    color: #6b7280;
    padding: 12px 16px;
    border-bottom: 1px solid #e5e7eb;
    background: #f8fafc
}

td {
    padding: 14px 16px;
    font-size: 13px;
    color: #333;
    border-bottom: 1px solid #f5f5f5
}

tr:last-child td {
    border-bottom: none
}

tr:hover td {
    background: #fafbff
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

.btn-edit {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f0f4ff;
    color: #006AD7;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s
}

.btn-edit:hover {
    background: #e0eeff
}

.empty {
    text-align: center;
    padding: 48px;
    color: #6b7280;
    font-size: 14px
}

.flash {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #16a34a;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px
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
            <a href="#" class="sb-item">📣 Annonces</a>
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
                <h1>📅 Réunions</h1>
                <p>Gérez les réunions de copropriété</p>
            </div>
            <a href="{{ route('syndic.reunions.create') }}" class="btn-new">+ Nouvelle réunion</a>
        </div>

        @if(session('success'))
        <div class="flash">✅ {{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Copropriété</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reunions as $r)
                    <tr>
                        <td><strong>{{ $r->titre }}</strong></td>
                        <td>{{ $r->copropriete->nom ?? '—' }}</td>
                        <td>{{ $r->date->format('d/m/Y à H:i') }}</td>
                        <td>{{ $r->lieu }}</td>
                        <td>
                            @php $labels = [
                            'planifiee' => 'Planifiée',
                            'terminee' => 'Terminée',
                            'annulee' =>
                            'Annulée'
                            ] @endphp
                            <span class="badge b-{{ $r->statut }}">{{ $labels[$r->statut] ?? $r->statut }}</span>
                        </td>
                        <td>
                            <a href="{{ route('syndic.reunions.edit', $r) }}" class="btn-edit">✏️ Modifier</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty">📅 Aucune réunion pour l'instant.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px">{{ $reunions->links() }}</div>
    </main>
</div>
@endsection