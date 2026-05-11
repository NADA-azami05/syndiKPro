@extends('layouts.app')
@section('title', 'Gestion des Résidents')
@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dw {
            display: grid;
            grid-template-columns: 220px 1fr;
            min-height: calc(100vh - 68px);
            background: #f0f4ff;
        }

        /* ── Sidebar (identique au dashboard) ── */
        .sb {
            background: #fff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            position: sticky;
            top: 68px;
            height: calc(100vh - 68px);
            overflow-y: auto;
        }

        .sb-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 0 12px;
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
            transition: all .2s;
        }

        .sb-item:hover {
            background: #f0f4ff;
            color: #006AD7;
        }

        .sb-item.active {
            background: #006AD7;
            color: #fff;
        }

        .sb-bot {
            padding: 16px 12px 0;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }

        .sb-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: #f0f4ff;
            margin-bottom: 8px;
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
            flex-shrink: 0;
        }

        .sb-uname {
            font-size: 13px;
            font-weight: 600;
            color: #111;
        }

        .sb-urole {
            font-size: 11px;
            color: #6b7280;
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
            transition: background .2s;
        }

        .sb-out:hover {
            background: #fef2f2;
        }

        /* ── Contenu ── */
        .mc {
            padding: 32px 36px;
        }

        /* Hero */
        .res-hero {
            background: linear-gradient(135deg, #006AD7 0%, #21277B 100%);
            border-radius: 20px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .res-hero::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .res-hero h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .res-hero p {
            font-size: 13px;
            opacity: 0.75;
            margin-bottom: 16px;
        }

        .hero-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .res-search-input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            outline: none;
            font-family: inherit;
        }

        .res-search-input::placeholder {
            color: rgba(255, 255, 255, 0.65);
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: #006AD7;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity .2s, transform .15s;
        }

        .btn-new:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            color: #006AD7;
        }

        /* Flash */
        .flash-ok {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #15803d;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Cartes résidents */
        .res-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 10px;
            box-shadow: 0 1px 6px rgba(0, 106, 215, 0.07);
            transition: box-shadow .2s, transform .15s;
        }

        .res-card:hover {
            box-shadow: 0 6px 24px rgba(0, 106, 215, 0.13);
            transform: translateY(-2px);
        }

        .res-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, #006AD7, #21277B);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            position: relative;
        }

        .res-avatar .dot {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 11px;
            height: 11px;
            background: #22c55e;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        .res-info {
            flex: 1;
            min-width: 0;
        }

        .res-info .rname {
            font-weight: 600;
            font-size: 14px;
            color: #111;
        }

        .res-info .rlot {
            font-size: 12px;
            color: #006AD7;
            font-weight: 500;
            margin-top: 1px;
        }

        .res-info .rmail {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .res-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn-edit {
            padding: 7px 14px;
            border-radius: 9px;
            background: #e6f2ff;
            color: #006AD7;
            border: 1.5px solid #b3d4f7;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-edit:hover {
            background: #cce4ff;
            color: #006AD7;
        }

        .btn-del {
            padding: 7px 14px;
            border-radius: 9px;
            background: #fef2f2;
            color: #dc2626;
            border: 1.5px solid #fca5a5;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-del:hover {
            background: #fee2e2;
        }

        .res-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            background: #fff;
            border-radius: 16px;
            color: #6b7280;
            font-size: 14px;
        }

        .empty-state .icon {
            font-size: 40px;
            margin-bottom: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="dw">

        {{-- ── Sidebar ── --}}
        <aside class="sb">
            <nav class="sb-nav">
                <a href="{{ route('syndic.dashboard') }}" class="sb-item">📊 Tableau de bord</a>
                <a href="{{ route('syndic.coproprietes.index') }}" class="sb-item">🏙️ Copropriétés</a>
                <a href="{{ route('syndic.residents.index') }}" class="sb-item active">👥 Résidents</a>
                <a href="{{ route('syndic.lots.index') }}" class="sb-item">🏠 Lots</a>
                <a href="{{ route('syndic.factures.index') }}" class="sb-item">📄 Factures</a>
                <a href="#" class="sb-item">📢 Réclamations</a>
                <a href="#" class="sb-item">🔧 Fournisseurs</a>
                <a href="#" class="sb-item">🗳️ Votes</a>
                <a href="#" class="sb-item">📣 Annonces</a>
                <a href="#" class="sb-item">📅 Réunions</a>
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

        {{-- ── Contenu ── --}}
        <main class="mc">

            {{-- Hero --}}
            <div class="res-hero">
                <h1>👥 Résidents</h1>
                <p>Gérez les résidents de votre résidence</p>
                <div class="hero-row">
                    <input type="text" class="res-search-input" id="searchInput" placeholder="🔍  Rechercher un résident..."
                        onkeyup="filterResidents()">
                    <a href="{{ route('syndic.residents.create') }}" class="btn-new">⊕ Nouveau Résident</a>
                </div>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div class="flash-ok">✅ {{ session('success') }}</div>
            @endif

            {{-- Liste --}}
            <div id="residentList">
                @forelse($residents as $resident)
                    <div class="res-card" data-name="{{ strtolower($resident->name) }}"
                        data-email="{{ strtolower($resident->email) }}">

                        <div class="res-avatar">
                            {{ strtoupper(substr($resident->name, 0, 1)) }}{{ strtoupper(substr(strstr($resident->name, ' ') ?: ' ', 1, 1)) }}
                            <span class="dot"></span>
                        </div>

                        <div class="res-info">
                            <div class="rname">{{ $resident->name }}</div>
                            <div class="rlot">
                                @if($resident->lot) {{ $resident->lot->numero }} — {{ $resident->lot->type }}
                                @else <span style="color:#9ca3af;">Aucun lot</span>
                                @endif
                            </div>
                            <div class="rmail">{{ $resident->email }}</div>
                        </div>

                        <div class="res-actions">
                            <a href="{{ route('syndic.residents.edit', $resident) }}" class="btn-edit">✏️ Modifier</a>
                            <form action="{{ route('syndic.residents.destroy', $resident) }}" method="POST"
                                onsubmit="return confirm('Supprimer {{ $resident->name }} ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">🗑️ Supprimer</button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="empty-state">
                        <div class="icon">👥</div>
                        <p>Aucun résident pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="res-pagination">{{ $residents->links() }}</div>

        </main>
    </div>

    <script>
        function filterResidents() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.res-card').forEach(card => {
                const match = card.dataset.name.includes(q) || card.dataset.email.includes(q);
                card.style.display = match ? 'flex' : 'none';
            });
        }
    </script>
@endsection