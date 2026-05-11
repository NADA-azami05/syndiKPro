@extends('layouts.app')
@section('title', 'Nouvelle Annonce')
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
    gap: 14px;
    margin-bottom: 28px
}

.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 9px;
    color: #6b7280;
    text-decoration: none;
    font-size: 18px;
    flex-shrink: 0
}

.btn-back:hover {
    border-color: #006AD7;
    color: #006AD7
}

.page-top h1 {
    font-family: var(--font-serif);
    font-size: 24px;
    font-weight: 700;
    color: #111
}

.form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 32px;
    max-width: 680px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .05)
}

.field {
    margin-bottom: 20px
}

.field label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #111;
    margin-bottom: 8px
}

.req {
    color: #ef4444
}

.field input,
.field select,
.field textarea {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    color: #111;
    background: #fff;
    outline: none;
    transition: border-color .2s
}

.field input:focus,
.field select:focus,
.field textarea:focus {
    border-color: #006AD7
}

.field textarea {
    resize: vertical;
    min-height: 160px
}

.field .err {
    font-size: 12px;
    color: #dc2626;
    margin-top: 5px
}

.g2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 28px
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #006AD7;
    color: #fff;
    padding: 12px 28px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-family: inherit;
    transition: background .2s
}

.btn-submit:hover {
    background: #0055b3
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    background: #fff;
    color: #6b7280;
    padding: 12px 22px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    border: 1.5px solid #e5e7eb;
    text-decoration: none
}

.toggle-wrap {
    display: flex;
    align-items: center;
    gap: 12px
}

.toggle {
    position: relative;
    width: 44px;
    height: 24px
}

.toggle input {
    opacity: 0;
    width: 0;
    height: 0
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #e5e7eb;
    border-radius: 24px;
    transition: .3s
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background: #fff;
    border-radius: 50%;
    transition: .3s
}

input:checked+.slider {
    background: #006AD7
}

input:checked+.slider:before {
    transform: translateX(20px)
}

.alert-err {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13px;
    margin-bottom: 20px
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
            <a href="{{ route('syndic.annonces.index') }}" class="btn-back">←</a>
            <h1>Nouvelle annonce</h1>
        </div>

        <div class="form-card">
            @if($errors->any())
            <div class="alert-err">
                <ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('syndic.annonces.store') }}" method="POST">
                @csrf

                <div class="field">
                    <label>Titre <span class="req">*</span></label>
                    <input type="text" name="titre" value="{{ old('titre') }}"
                        placeholder="Ex: Travaux de peinture prévus">
                    @error('titre')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="g2">
                    <div class="field">
                        <label>Copropriété <span class="req">*</span></label>
                        <select name="copropriete_id">
                            <option value="">-- Choisir --</option>
                            @foreach($coproprietes as $c)
                            <option value="{{ $c->id }}" {{ old('copropriete_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->nom }}
                            </option>
                            @endforeach
                        </select>
                        @error('copropriete_id')<div class="err">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label>Type <span class="req">*</span></label>
                        <select name="type">
                            <option value="generale" {{ old('type') == 'generale' ? 'selected' : '' }}>📢 Générale
                            </option>
                            <option value="urgente" {{ old('type') == 'urgente' ? 'selected' : '' }}>🚨 Urgente</option>
                            <option value="maintenance" {{ old('type') == 'maintenance' ? 'selected' : '' }}>🔧
                                Maintenance</option>
                            <option value="evenement" {{ old('type') == 'evenement' ? 'selected' : '' }}>🎉 Événement
                            </option>
                        </select>
                        @error('type')<div class="err">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="field">
                    <label>Contenu <span class="req">*</span></label>
                    <textarea name="contenu"
                        placeholder="Rédigez le contenu de votre annonce...">{{ old('contenu') }}</textarea>
                    @error('contenu')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label>Publication</label>
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="publiee" value="1" {{ old('publiee', '1') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                        <span style="font-size:14px;color:#374151">Publier immédiatement</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">📣 Publier l'annonce</button>
                    <a href="{{ route('syndic.annonces.index') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection