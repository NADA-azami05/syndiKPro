@extends('layouts.app')
@section('title', 'Modifier Résident')

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
            display: flex;
            justify-content: center;
        }

        .form-wrap {
            width: 100%;
            max-width: 580px;
        }

        .form-hero {
            background: linear-gradient(135deg, #006AD7 0%, #21277B 100%);
            border-radius: 20px 20px 0 0;
            padding: 32px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-hero::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 130px;
            height: 130px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .avatar-ph {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 3px dashed rgba(255, 255, 255, 0.5);
            display: grid;
            place-items: center;
            font-size: 28px;
            margin: 0 auto 14px;
        }

        .form-hero h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .form-hero p {
            font-size: 13px;
            opacity: 0.75;
        }

        .form-body {
            background: #fff;
            border-radius: 0 0 20px 20px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(0, 106, 215, 0.10);
        }

        .fg {
            margin-bottom: 20px;
        }

        .fg label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .fg input,
        .fg select {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            color: #111;
            background: #f9fafb;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            font-family: inherit;
        }

        .fg input:focus,
        .fg select:focus {
            border-color: #006AD7;
            box-shadow: 0 0 0 3px rgba(0, 106, 215, 0.10);
            background: #fff;
        }

        .fg input::placeholder {
            color: #9ca3af;
        }

        .fg input.is-invalid,
        .fg select.is-invalid {
            border-color: #dc2626;
        }

        .err {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }

        .fg-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .divider {
            border: none;
            border-top: 1.5px dashed #e5e7eb;
            margin: 20px 0;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #006AD7;
            margin-bottom: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #006AD7, #21277B);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
            margin-bottom: 12px;
            font-family: inherit;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-cancel {
            display: block;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 8px;
            border-radius: 10px;
            transition: background .2s;
        }

        .btn-cancel:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-danger-full {
            width: 100%;
            padding: 11px;
            background: #fff;
            color: #dc2626;
            border: 1.5px solid #fca5a5;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            font-family: inherit;
            margin-bottom: 10px;
        }

        .btn-danger-full:hover {
            background: #fef2f2;
        }

        .meta-info {
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
            margin-bottom: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="dw">

        {{-- ══════════ SIDEBAR ══════════ --}}
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

        {{-- ══════════ MAIN ══════════ --}}
        <main class="mc">
            <div class="form-wrap">

                {{-- Hero --}}
                <div class="form-hero">
                    <div class="avatar-ph">
                        {{ strtoupper(substr($resident->name, 0, 1)) }}
                    </div>
                    <h2>✏️ Modifier Résident</h2>
                    <p>{{ $resident->name }} — {{ $resident->email }}</p>
                </div>

                {{-- Formulaire --}}
                <div class="form-body">

                    <form id="form-update" action="{{ route('syndic.residents.update', $resident) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Informations personnelles --}}
                        <p class="section-label">👤 Informations personnelles</p>

                        <div class="fg-row">
                            <div class="fg">
                                <label>Nom complet</label>
                                <input type="text" name="name" placeholder="Ex: Ahmed Benali"
                                    value="{{ old('name', $resident->name) }}"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                                @error('name')<div class="err">{{ $message }}</div>@enderror
                            </div>
                            <div class="fg">
                                <label>Téléphone</label>
                                <input type="text" name="phone" placeholder="Ex: 06 12 34 56 78"
                                    value="{{ old('phone', $resident->phone) }}"
                                    class="{{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                @error('phone')<div class="err">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="fg">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="exemple@email.com"
                                value="{{ old('email', $resident->email) }}"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required>
                            @error('email')<div class="err">{{ $message }}</div>@enderror
                        </div>

                        <div class="fg">
                            <label>Appartement / Lot</label>
                            <select name="lot_id" class="{{ $errors->has('lot_id') ? 'is-invalid' : '' }}" required>
                                <option value="">— Sélectionner un appartement —</option>
                                @foreach($lots as $lot)
                                    <option value="{{ $lot->id }}" {{ old('lot_id', $resident->lot_id) == $lot->id ? 'selected' : '' }}>
                                        {{ $lot->numero }} — {{ $lot->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lot_id')<div class="err">{{ $message }}</div>@enderror
                        </div>

                        <hr class="divider">

                        {{-- Mot de passe --}}
                        <p class="section-label">🔒 Changer le mot de passe</p>
                        <p style="font-size:12px;color:#9ca3af;margin-bottom:14px;">Laissez vide pour conserver le mot de
                            passe actuel.</p>

                        <div class="fg-row">
                            <div class="fg">
                                <label>Nouveau mot de passe</label>
                                <input type="password" name="password" placeholder="Minimum 8 caractères"
                                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                                @error('password')<div class="err">{{ $message }}</div>@enderror
                            </div>
                            <div class="fg">
                                <label>Confirmer mot de passe</label>
                                <input type="password" name="password_confirmation" placeholder="Répéter le mot de passe">
                            </div>
                        </div>

                        <p class="meta-info">
                            Créé le {{ $resident->created_at->format('d/m/Y') }} —
                            Modifié le {{ $resident->updated_at->format('d/m/Y') }}
                        </p>

                        <button type="submit" class="btn-submit">💾 &nbsp; Enregistrer les modifications</button>
                        <a href="{{ route('syndic.residents.index') }}" class="btn-cancel">← Annuler</a>

                    </form>

                    <hr class="divider">

                    {{-- Suppression --}}
                    <form id="form-delete" action="{{ route('syndic.residents.destroy', $resident) }}" method="POST"
                        onsubmit="return confirm('Supprimer définitivement {{ $resident->name }} ? Cette action est irréversible.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-full">🗑️ Supprimer ce résident</button>
                    </form>

                </div>
            </div>
        </main>
    </div>
@endsection