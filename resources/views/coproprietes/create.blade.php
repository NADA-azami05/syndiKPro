@extends('layouts.app')
@section('title', 'Nouvelle Copropriété')

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

        .mc {
            padding: 32px 36px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
        }

        .back-btn:hover {
            color: #006AD7;
        }

        .page-header h1 {
            font-family: var(--font-serif);
            font-size: 24px;
            font-weight: 700;
            color: #111;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            max-width: 700px;
        }

        .form-card-header {
            padding: 22px 28px;
            border-bottom: 1px solid #e5e7eb;
            background: #fafbff;
        }

        .form-card-header h2 {
            font-size: 16px;
            font-weight: 600;
            color: #111;
        }

        .form-card-header p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }

        .form-body {
            padding: 28px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-grid-full {
            grid-column: 1/-1;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 13px 16px;
            background: #f0f4ff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            color: #111;
            font-family: inherit;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus {
            border-color: #006AD7;
            box-shadow: 0 0 0 3px rgba(0, 106, 215, .10);
            background: #fff;
        }

        .form-control::placeholder {
            color: #c4c9d4;
            font-weight: 300;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #ef4444;
            margin-top: 5px;
        }

        .form-hint {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 5px;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 28px;
            border-top: 1px solid #e5e7eb;
            background: #fafbff;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #006AD7;
            color: #fff;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: #0055b3;
        }

        .btn-ghost-nav {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-ghost-nav:hover {
            border-color: #006AD7;
            color: #006AD7;
        }
    </style>
@endpush

@section('content')
    <div class="dw">

        <aside class="sb">
            <nav class="sb-nav">
                <a href="{{ route('syndic.dashboard') }}" class="sb-item">📊 Tableau de bord</a>
                <a href="{{ route('syndic.coproprietes.index') }}" class="sb-item active">🏙️ Copropriétés</a>
                <a href="#" class="sb-item">👥 Résidents</a>
                <a href="#" class="sb-item">🏠 Lots</a>
                <a href="#" class="sb-item">📄 Factures</a>
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

        <main class="mc">
            <div class="page-header">
                <a href="{{ route('syndic.coproprietes.index') }}" class="back-btn">← Retour</a>
                <h1>🏙️ Nouvelle copropriété</h1>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <h2>Informations de la copropriété</h2>
                    <p>Remplissez les informations pour créer une nouvelle copropriété.</p>
                </div>

                <form method="POST" action="{{ route('syndic.coproprietes.store') }}">
                    @csrf
                    <div class="form-body">
                        <div class="form-grid">

                            {{-- Nom --}}
                            <div class="form-group form-grid-full">
                                <label for="nom">Nom de la résidence *</label>
                                <input type="text" id="nom" name="nom"
                                    class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}"
                                    placeholder="Ex: Résidence Al Fath" required>
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Adresse --}}
                            <div class="form-group form-grid-full">
                                <label for="adresse">Adresse *</label>
                                <input type="text" id="adresse" name="adresse"
                                    class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}"
                                    placeholder="Ex: 12 Rue des Orangers" required>
                                @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Ville --}}
                            <div class="form-group">
                                <label for="ville">Ville *</label>
                                <input type="text" id="ville" name="ville"
                                    class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}"
                                    placeholder="Ex: Casablanca" required>
                                @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Nombre de lots --}}
                            <div class="form-group">
                                <label for="nb_lots">Nombre de lots *</label>
                                <input type="number" id="nb_lots" name="nb_lots"
                                    class="form-control @error('nb_lots') is-invalid @enderror"
                                    value="{{ old('nb_lots', 1) }}" min="1" required>
                                @error('nb_lots')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Budget --}}
                            <div class="form-group">
                                <label for="budget">Budget annuel (MAD)</label>
                                <input type="number" id="budget" name="budget"
                                    class="form-control @error('budget') is-invalid @enderror"
                                    value="{{ old('budget', 0) }}" min="0" step="0.01" placeholder="Ex: 50000">
                                <p class="form-hint">Budget prévisionnel annuel en dirhams</p>
                                @error('budget')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Syndic nom --}}
                            <div class="form-group">
                                <label for="syndic_nom">Nom du syndic responsable</label>
                                <input type="text" id="syndic_nom" name="syndic_nom"
                                    class="form-control @error('syndic_nom') is-invalid @enderror"
                                    value="{{ old('syndic_nom', auth()->user()->name) }}" placeholder="Nom du syndic">
                                @error('syndic_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="form-footer">
                        <a href="{{ route('syndic.coproprietes.index') }}" class="btn-ghost-nav">Annuler</a>
                        <button type="submit" class="btn-primary">✓ Créer la copropriété</button>
                    </div>
                </form>
            </div>

        </main>
    </div>
@endsection