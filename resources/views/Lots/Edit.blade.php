@extends('layouts.app')
@section('title', 'Modifier le Lot')
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

        .back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color .2s
        }

        .back:hover {
            color: #006AD7
        }

        .mh {
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

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            max-width: 700px
        }

        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px
        }

        .fg {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px
        }

        .fg label {
            font-size: 13px;
            font-weight: 600;
            color: #374151
        }

        .fg input,
        .fg select {
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            font-size: 14px;
            color: #111;
            outline: none;
            transition: border-color .2s;
            background: #fff
        }

        .fg input:focus,
        .fg select:focus {
            border-color: #006AD7;
            box-shadow: 0 0 0 3px rgba(0, 106, 215, .08)
        }

        .fg .hint {
            font-size: 11px;
            color: #9ca3af
        }

        .err {
            font-size: 11px;
            color: #dc2626;
            margin-top: 2px
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 8px
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 24px;
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

        .btn-cancel {
            background: #f3f4f6;
            color: #374151
        }

        .btn-cancel:hover {
            background: #e5e7eb
        }

        .btn-del {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca
        }

        .btn-del:hover {
            background: #fee2e2
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #006AD7;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb
        }

        .info-box {
            background: #f0f4ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #1e40af
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
            <a href="{{ route('syndic.lots.index') }}" class="back">← Retour aux lots</a>

            <div class="mh">
                <h1>✏️ Modifier le Lot</h1>
                <p>Modification du lot <strong>{{ $lot->numero }}</strong></p>
            </div>

            <div class="info-box">
                ℹ️ Lot <strong>{{ $lot->numero }}</strong> — {{ ucfirst($lot->type) }} —
                Copropriété : <strong>{{ $lot->copropriete->nom ?? '—' }}</strong>
            </div>

            <div class="card">
                <form action="{{ route('syndic.lots.update', $lot) }}" method="POST">
                    @csrf @method('PUT')

                    <p class="section-title">Informations du lot</p>

                    <div class="grid2">
                        {{-- Copropriété --}}
                        <div class="fg" style="grid-column:span 2">
                            <label for="copropriete_id">Copropriété *</label>
                            <select name="copropriete_id" id="copropriete_id" required>
                                <option value="">— Sélectionner une copropriété —</option>
                                @foreach($coproprietes as $c)
                                    <option value="{{ $c->id }}" {{ old('copropriete_id', $lot->copropriete_id) == $c->id ? 'selected' : '' }}>
                                        {{ $c->nom }} — {{ $c->ville }}
                                    </option>
                                @endforeach
                            </select>
                            @error('copropriete_id')<span class="err">{{ $message }}</span>@enderror
                        </div>

                        {{-- Numéro --}}
                        <div class="fg">
                            <label for="numero">Numéro du lot *</label>
                            <input type="text" name="numero" id="numero" value="{{ old('numero', $lot->numero) }}" required>
                            @error('numero')<span class="err">{{ $message }}</span>@enderror
                        </div>

                        {{-- Type --}}
                        <div class="fg">
                            <label for="type">Type *</label>
                            <select name="type" id="type" required>
                                <option value="appartement" {{ old('type', $lot->type) == 'appartement' ? 'selected' : '' }}>
                                    🏢
                                    Appartement</option>
                                <option value="commerce" {{ old('type', $lot->type) == 'commerce' ? 'selected' : '' }}>🏪
                                    Commerce
                                </option>
                                <option value="parking" {{ old('type', $lot->type) == 'parking' ? 'selected' : '' }}>🚗
                                    Parking
                                </option>
                                <option value="local" {{ old('type', $lot->type) == 'local' ? 'selected' : '' }}>🏭 Local
                                </option>
                            </select>
                            @error('type')<span class="err">{{ $message }}</span>@enderror
                        </div>

                        {{-- Surface --}}
                        <div class="fg">
                            <label for="surface">Surface (m²) *</label>
                            <input type="number" name="surface" id="surface" step="0.01" min="1"
                                value="{{ old('surface', $lot->surface) }}" required>
                            @error('surface')<span class="err">{{ $message }}</span>@enderror
                        </div>

                        {{-- Quote-part --}}
                        <div class="fg">
                            <label for="quote_part">Quote-part (entre 0 et 1) *</label>
                            <input type="number" name="quote_part" id="quote_part" step="0.0001" min="0" max="1"
                                value="{{ old('quote_part', $lot->quote_part) }}" required>
                            <span class="hint">Actuel : {{ number_format($lot->quote_part * 100, 2) }}%</span>
                            @error('quote_part')<span class="err">{{ $message }}</span>@enderror
                        </div>

                        {{-- Statut --}}
                        <div class="fg">
                            <label for="statut">Statut *</label>
                            <select name="statut" id="statut" required>
                                <option value="libre" {{ old('statut', $lot->statut) == 'libre' ? 'selected' : '' }}>🔓
                                    Libre
                                </option>
                                <option value="occupe" {{ old('statut', $lot->statut) == 'occupe' ? 'selected' : '' }}>✅
                                    Occupé
                                </option>
                            </select>
                            @error('statut')<span class="err">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
                        <a href="{{ route('syndic.lots.index') }}" class="btn btn-cancel">Annuler</a>
                    </div>
                </form>

                {{-- Suppression --}}
                <div style="margin-top:32px;padding-top:20px;border-top:1px solid #fee2e2">
                    <p style="font-size:13px;color:#6b7280;margin-bottom:12px">⚠️ Zone dangereuse — cette action est
                        irréversible.</p>
                    <form action="{{ route('syndic.lots.destroy', $lot) }}" method="POST"
                        onsubmit="return confirm('Supprimer définitivement le lot {{ $lot->numero }} ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-del">🗑️ Supprimer ce lot</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection