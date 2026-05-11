@extends('layouts.app')
@section('title', 'Mes Réclamations')

@push('styles')
    <style>
        body {
            background: #f5f7ff !important;
        }

        .rp-wrap {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: calc(100vh - 68px);
        }

        .rp-sb {
            background: #fff;
            border-right: 1px solid #e8ecf4;
            padding: 28px 0 0;
            position: sticky;
            top: 68px;
            height: calc(100vh - 68px);
            display: flex;
            flex-direction: column;
        }

        .rp-user {
            padding: 0 20px 22px;
            border-bottom: 1px solid #f0f2f8;
            margin-bottom: 10px;
        }

        .rp-av {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #006AD7, #21277B);
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .rp-name {
            font-size: 14px;
            font-weight: 600;
            color: #111;
        }

        .rp-role {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }

        .rp-lot {
            font-size: 12px;
            color: #006AD7;
            margin-top: 3px;
            font-weight: 500;
        }

        .rp-nav {
            flex: 1;
            padding: 0 12px;
        }

        .rp-nav a,
        .rp-nav span {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            transition: all .2s;
            margin-bottom: 3px;
        }

        .rp-nav a:hover {
            background: #f0f4ff;
            color: #006AD7;
        }

        .rp-nav a.active {
            background: #006AD7;
            color: #fff;
        }

        .rp-nav span {
            opacity: .4;
            cursor: not-allowed;
        }

        .soon {
            font-size: 10px;
            background: #f0f4ff;
            color: #006AD7;
            padding: 2px 7px;
            border-radius: 20px;
            margin-left: auto;
            font-weight: 600;
        }

        .rp-sb-bot {
            padding: 14px 12px;
            border-top: 1px solid #f0f2f8;
            margin-top: auto;
        }

        .rp-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #ef4444;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            font-family: inherit;
            transition: background .2s;
        }

        .rp-logout:hover {
            background: #fef2f2;
        }

        .rp-main {
            padding: 36px 40px;
            max-width: 900px;
        }

        .rp-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .rp-title {
            font-size: 26px;
            font-weight: 700;
            color: #111;
            letter-spacing: -.3px;
        }

        .rp-sub {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
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
            font-weight: 500;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-new:hover {
            background: #0055b3;
            color: #fff;
        }

        .rp-tabs {
            display: flex;
            border-bottom: 2px solid #e8ecf4;
            margin: 28px 0 24px;
        }

        .rp-tab {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            text-decoration: none;
            transition: color .2s;
        }

        .rp-tab:hover {
            color: #006AD7;
        }

        .rp-tab.active {
            color: #006AD7;
            border-bottom-color: #006AD7;
        }

        .tab-count {
            background: #e8ecf4;
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            min-width: 22px;
            text-align: center;
        }

        .rp-tab.active .tab-count {
            background: #006AD7;
            color: #fff;
        }

        .rp-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .rp-card {
            background: #fff;
            border: 1px solid #e8ecf4;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: box-shadow .2s, border-color .2s;
        }

        .rp-card:hover {
            box-shadow: 0 4px 20px rgba(0, 106, 215, .10);
            border-color: #c7d8f5;
        }

        .rp-ico {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .ico-normale {
            background: #f0f4ff;
        }

        .ico-urgente {
            background: #fff7ed;
        }

        .ico-critique {
            background: #fef2f2;
        }

        .rp-body {
            flex: 1;
            min-width: 0;
        }

        .rp-card-titre {
            font-size: 15px;
            font-weight: 600;
            color: #111;
            margin-bottom: 3px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .rp-card-desc {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 3px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .rp-card-ref {
            font-size: 12px;
            color: #9ca3af;
        }

        .rp-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
            flex-shrink: 0;
        }

        .rp-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .s-en_attente {
            background: #fff7ed;
            color: #d97706;
        }

        .s-en_cours {
            background: #eff6ff;
            color: #2563eb;
        }

        .s-resolu {
            background: #f0fdf4;
            color: #16a34a;
        }

        .s-ferme {
            background: #f9fafb;
            color: #6b7280;
        }

        .rp-date {
            font-size: 13px;
            color: #9ca3af;
        }

        .rp-arrow {
            font-size: 20px;
            color: #d1d5db;
            margin-left: 4px;
        }

        .rp-reponse {
            margin-top: 8px;
            padding: 8px 12px;
            background: #f0f6ff;
            border-left: 3px solid #006AD7;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
            color: #1e3a5f;
        }

        .rp-reponse strong {
            display: block;
            font-size: 11px;
            color: #006AD7;
            margin-bottom: 2px;
        }

        .rp-empty {
            text-align: center;
            padding: 80px 24px;
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e8ecf4;
        }

        .rp-empty-ico {
            font-size: 52px;
            margin-bottom: 16px;
        }

        .rp-empty h3 {
            font-size: 18px;
            font-weight: 600;
            color: #111;
            margin-bottom: 8px;
        }

        .rp-empty p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .rp-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f0f6ff;
            border-radius: 10px;
            padding: 12px 18px;
            margin-top: 20px;
            font-size: 13px;
            color: #1e3a5f;
        }
    </style>
@endpush

@section('content')
    @php
        $tous = $reclamations;
        $en_cours = $reclamations->where('statut', 'en_cours');
        $en_attente = $reclamations->where('statut', 'en_attente');
        $resolues = $reclamations->where('statut', 'resolu');
        $fermees = $reclamations->where('statut', 'ferme');
        $filtre = request('filtre', 'tous');
        $liste = match ($filtre) {
            'en_cours' => $en_cours,
            'en_attente' => $en_attente,
            'resolues' => $resolues,
            'fermees' => $fermees,
            default => $tous,
        };

        function getIconeRecl($titre)
        {
            $t = mb_strtolower($titre);
            if (str_contains($t, 'eau') || str_contains($t, 'fuite'))
                return '💧';
            if (str_contains($t, 'lumi') || str_contains($t, 'eclair'))
                return '💡';
            if (str_contains($t, 'porte'))
                return '🚪';
            if (str_contains($t, 'bruit') || str_contains($t, 'son'))
                return '🔊';
            if (str_contains($t, 'parking') || str_contains($t, 'place'))
                return '🚗';
            if (str_contains($t, 'ascenseur'))
                return '🛗';
            if (str_contains($t, 'nettoyage') || str_contains($t, 'propret'))
                return '🧹';
            return '📋';
        }
     @endphp

    <div class="rp-wrap">

        {{-- SIDEBAR --}}
        <aside class="rp-sb">
            <div class="rp-user">
                <div class="rp-av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="rp-name">{{ auth()->user()->name }}</div>
                <div class="rp-role">Résident</div>
                @if(auth()->user()->resident?->lot)
                    <div class="rp-lot">📍 Appartement {{ auth()->user()->resident->lot->numero }}</div>
                @endif
            </div>
            <nav class="rp-nav">
                <a href="{{ route('resident.dashboard') }}">🏠 Tableau de bord</a>
                <a href="{{ route('resident.factures.mes') }}">📄 Mes charges</a>
                <a href="{{ route('resident.reclamations.mes') }}" class="active">💬 Mes réclamations</a>
                <span>🗳️ Sondages <span class="soon">bientôt</span></span>
                <span>📣 Annonces <span class="soon">bientôt</span></span>
                <span>📅 Réunions <span class="soon">bientôt</span></span>
            </nav>
            <div class="rp-sb-bot">
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="rp-logout">🚪 Déconnexion</button>
                </form>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="rp-main">
            <div class="rp-header">
                <div>
                    <div class="rp-title">Mes réclamations</div>
                    <div class="rp-sub">Suivez vos réclamations et consultez leurs avancements.</div>
                </div>
                <a href="{{ route('resident.reclamations.create') }}" class="btn-new">＋ Nouvelle réclamation</a>
            </div>

            @if(session('success'))
                <div
                    style="background:#f0fdf4;border:1px solid #86efac;color:#15803d;padding:12px 16px;border-radius:10px;margin-top:16px;font-size:14px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- TABS --}}
            <div class="rp-tabs">
                <a href="?filtre=tous" class="rp-tab {{ $filtre === 'tous' ? 'active' : '' }}">Toutes <span
                        class="tab-count">{{ $tous->count() }}</span></a>
                <a href="?filtre=en_cours" class="rp-tab {{ $filtre === 'en_cours' ? 'active' : '' }}">En cours <span
                        class="tab-count">{{ $en_cours->count() }}</span></a>
                <a href="?filtre=en_attente" class="rp-tab {{ $filtre === 'en_attente' ? 'active' : '' }}">En attente <span
                        class="tab-count">{{ $en_attente->count() }}</span></a>
                <a href="?filtre=resolues" class="rp-tab {{ $filtre === 'resolues' ? 'active' : '' }}">Résolues <span
                        class="tab-count">{{ $resolues->count() }}</span></a>
                <a href="?filtre=fermees" class="rp-tab {{ $filtre === 'fermees' ? 'active' : '' }}">Fermées <span
                        class="tab-count">{{ $fermees->count() }}</span></a>
            </div>

            {{-- LISTE --}}
            @if($liste->count())
                <div class="rp-list">
                    @foreach($liste as $r)
                        @php
                            $badges = [
                                'en_attente' => ['label' => 'En attente', 'cls' => 's-en_attente'],
                                'en_cours' => ['label' => 'En cours', 'cls' => 's-en_cours'],
                                'resolu' => ['label' => 'Résolue', 'cls' => 's-resolu'],
                                'ferme' => ['label' => 'Fermée', 'cls' => 's-ferme'],
                            ];
                            $b = $badges[$r->statut] ?? ['label' => $r->statut, 'cls' => 's-ferme'];
                         @endphp
                        <div class="rp-card">
                            <div class="rp-ico ico-{{ $r->priorite }}">{{ getIconeRecl($r->titre) }}</div>
                            <div class="rp-body">
                                <div class="rp-card-titre">{{ $r->titre }}</div>
                                <div class="rp-card-desc">{{ Str::limit($r->description, 90) }}</div>
                                <div class="rp-card-ref">Réf.
                                    #RC-{{ $r->created_at->format('Y') }}-{{ str_pad($r->id, 4, '0', STR_PAD_LEFT) }}</div>
                                @if($r->reponse)
                                    <div class="rp-reponse">
                                        <strong>💬 Réponse du syndic :</strong>{{ $r->reponse }}
                                    </div>
                                @endif
                            </div>
                            <div class="rp-right">
                                <span class="rp-badge {{ $b['cls'] }}">{{ $b['label'] }}</span>
                                <span class="rp-date">{{ $r->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="rp-arrow">›</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rp-empty">
                    <div class="rp-empty-ico">💬</div>
                    <h3>Aucune réclamation</h3>
                    <p>Vous n'avez aucune réclamation dans cette catégorie.</p>
                    <a href="{{ route('resident.reclamations.create') }}" class="btn-new"
                        style="margin:0 auto;display:inline-flex;">＋ Nouvelle réclamation</a>
                </div>
            @endif

            <div class="rp-info">ℹ️ Vous ne trouvez pas votre réclamation ? Contactez votre syndic.</div>
        </main>
    </div>
@endsection