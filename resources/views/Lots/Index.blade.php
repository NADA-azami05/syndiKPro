@extends('layouts.app')
@section('title', 'Gestion des Lots')
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
            padding: 0 12px;
            overflow-y: auto
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

        .mh {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px
        }

        .mh h1 {
            font-family: var(--font-serif);
            font-size: 24px;
            font-weight: 700;
            color: #111;
            margin-bottom: 4px
        }

        .mh p {
            font-size: 14px;
            color: #6b7280
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s
        }

        .btn-primary {
            background: #006AD7;
            color: #fff
        }

        .btn-primary:hover {
            background: #0057b3
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 7px
        }

        .btn-edit {
            background: #f0f4ff;
            color: #006AD7
        }

        .btn-edit:hover {
            background: #dbeafe
        }

        .btn-del {
            background: #fef2f2;
            color: #dc2626
        }

        .btn-del:hover {
            background: #fee2e2
        }

        .kg {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 28px
        }

        .kc {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px 18px;
            display: flex;
            align-items: center;
            gap: 14px
        }

        .ki {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
            flex-shrink: 0
        }

        .ki.b {
            background: #e6f2ff
        }

        .ki.g {
            background: #f0fdf4
        }

        .ki.o {
            background: #fffbeb
        }

        .kn {
            font-family: var(--font-serif);
            font-size: 26px;
            font-weight: 700;
            color: #111;
            line-height: 1
        }

        .kl {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap
        }

        .filters select,
        .filters input {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 13px;
            color: #374151;
            background: #fff;
            outline: none
        }

        .filters select:focus,
        .filters input:focus {
            border-color: #006AD7
        }

        .dt {
            width: 100%;
            border-collapse: collapse
        }

        .dt th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #6b7280;
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb
        }

        .dt td {
            padding: 13px 12px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
            vertical-align: middle
        }

        .dt tr:last-child td {
            border-bottom: none
        }

        .dt tr:hover td {
            background: #f9fafb
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600
        }

        .badge-occupe {
            background: #f0fdf4;
            color: #16a34a
        }

        .badge-libre {
            background: #fffbeb;
            color: #d97706
        }

        .badge-app {
            background: #eff6ff;
            color: #2563eb
        }

        .badge-com {
            background: #fdf4ff;
            color: #9333ea
        }

        .badge-par {
            background: #f0f4ff;
            color: #006AD7
        }

        .badge-loc {
            background: #fff7ed;
            color: #ea580c
        }

        .pag {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 20px
        }

        .pag a,
        .pag span {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            border: 1px solid #e5e7eb;
            color: #374151;
            text-decoration: none
        }

        .pag .active-p {
            background: #006AD7;
            color: #fff;
            border-color: #006AD7
        }
    </style>
@endpush
@section('content')
    <div class="dw">

        {{-- SIDEBAR --}}
        <aside class="sb">
            <nav class="sb-nav">
                <a href="{{ route('syndic.dashboard') }}"
                    class="sb-item {{ request()->routeIs('syndic.dashboard') ? 'active' : '' }}">📊 Tableau de bord</a>
                <a href="{{ route('syndic.coproprietes.index') }}"
                    class="sb-item {{ request()->routeIs('syndic.coproprietes*') ? 'active' : '' }}">🏙️ Copropriétés</a>
                <a href="{{ route('syndic.lots.index') }}"
                    class="sb-item {{ request()->routeIs('syndic.lots*') ? 'active' : '' }}">🏠 Lots</a>
                <span class="sb-item disabled">👥 Résidents <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📄 Factures <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📢 Réclamations <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">🔧 Fournisseurs <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">🗳️ Votes <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📣 Annonces <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📅 Réunions <span class="badge-soon">bientôt</span></span>
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

        {{-- MAIN --}}
        <main class="mc">

            <div class="mh">
                <div>
                    <h1>🏠 Gestion des Lots</h1>
                    <p>Liste de tous les lots des copropriétés</p>
                </div>
                <a href="{{ route('syndic.lots.create') }}" class="btn btn-primary">+ Nouveau lot</a>
            </div>

            @if(session('success'))
                <div
                    style="background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
                    ✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div
                    style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
                    ❌ {{ session('error') }}</div>
            @endif

            {{-- Stats --}}
            <div class="kg">
                <div class="kc">
                    <div class="ki b">🏠</div>
                    <div>
                        <div class="kn">{{ $stats['total'] }}</div>
                        <div class="kl">Total lots</div>
                    </div>
                </div>
                <div class="kc">
                    <div class="ki g">✅</div>
                    <div>
                        <div class="kn">{{ $stats['occupes'] }}</div>
                        <div class="kl">Occupés</div>
                    </div>
                </div>
                <div class="kc">
                    <div class="ki o">🔓</div>
                    <div>
                        <div class="kn">{{ $stats['libres'] }}</div>
                        <div class="kl">Libres</div>
                    </div>
                </div>
            </div>

            <div class="card">
                {{-- Filtres --}}
                <form method="GET" class="filters">
                    <input type="text" name="search" placeholder="🔍 Rechercher un lot..." value="{{ request('search') }}"
                        style="flex:1;min-width:200px">
                    <select name="type">
                        <option value="">Tous les types</option>
                        <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                        <option value="commerce" {{ request('type') == 'commerce' ? 'selected' : '' }}>Commerce</option>
                        <option value="parking" {{ request('type') == 'parking' ? 'selected' : '' }}>Parking</option>
                        <option value="local" {{ request('type') == 'local' ? 'selected' : '' }}>Local</option>
                    </select>
                    <select name="statut">
                        <option value="">Tous les statuts</option>
                        <option value="occupe" {{ request('statut') == 'occupe' ? 'selected' : '' }}>Occupé</option>
                        <option value="libre" {{ request('statut') == 'libre' ? 'selected' : '' }}>Libre</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                    <a href="{{ route('syndic.lots.index') }}" class="btn btn-sm"
                        style="background:#f3f4f6;color:#374151">Réinitialiser</a>
                </form>

                <table class="dt">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Copropriété</th>
                            <th>Type</th>
                            <th>Surface</th>
                            <th>Quote-part</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lots as $lot)
                            <tr>
                                <td><strong>{{ $lot->numero }}</strong></td>
                                <td>{{ $lot->copropriete->nom ?? '—' }}</td>
                                <td>
                                    @php
                                        $tc =
                                            ['appartement' => 'badge-app', 'commerce' => 'badge-com', 'parking' => 'badge-par', 'local' => 'badge-loc'];
                                        $ti = ['appartement' => '🏢', 'commerce' => '🏪', 'parking' => '🚗', 'local' => '🏭'];
                                    @endphp
                                    <span class="badge {{ $tc[$lot->type] ?? '' }}">{{ $ti[$lot->type] ?? '' }}
                                        {{ ucfirst($lot->type) }}</span>
                                </td>
                                <td>{{ number_format($lot->surface, 2) }} m²</td>
                                <td>{{ number_format($lot->quote_part * 100, 2) }}%</td>
                                <td>
                                    <span class="badge {{ $lot->statut === 'occupe' ? 'badge-occupe' : 'badge-libre' }}">
                                        {{ $lot->statut === 'occupe' ? '✅ Occupé' : '🔓 Libre' }}
                                    </span>
                                </td>
                                <td style="display:flex;gap:6px">
                                    <a href="{{ route('syndic.lots.edit', $lot) }}" class="btn btn-sm btn-edit">✏️ Modifier</a>
                                    <form action="{{ route('syndic.lots.destroy', $lot) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce lot ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-del">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;color:#6b7280;padding:30px">
                                    Aucun lot trouvé.
                                    <a href="{{ route('syndic.lots.create') }}" style="color:#006AD7">Créer le premier lot →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($lots->hasPages())
                    <div class="pag">{{ $lots->appends(request()->query())->links() }}</div>
                @endif
            </div>

        </main>
    </div>
@endsection