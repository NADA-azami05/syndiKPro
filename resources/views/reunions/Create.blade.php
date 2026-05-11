@extends('layouts.app')
@section('title', 'Nouvelle Réunion')
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
    max-width: 640px;
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
    min-height: 120px
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
        <div class="sb-logo">
            <div class="ic">🏢</div>SyndicPro
        </div>
        <nav class="sb-nav">
            <a href="{{ route('syndic.dashboard') }}" class="sb-item">📊 Tableau de bord</a>
            <a href="{{ route('syndic.coproprietes.index') }}" class="sb-item">🏙️ Copropriétés</a>
            <a href="{{ route('syndic.residents.index') }}" class="sb-item">👥 Résidents</a>
            <a href="{{ route('syndic.lots.index') }}" class="sb-item">🏠 Lots</a>
            <a href="{{ route('syndic.factures.index') }}" class="sb-item">📄 Factures</a>
            <a href="{{ route('syndic.reclamations.index') }}" class="sb-item">📢 Réclamations</a>
            <a href="{{ route('syndic.reunions.index') }}" class="sb-item active">📅 Réunions</a>
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
            <a href="{{ route('syndic.reunions.index') }}" class="btn-back">←</a>
            <div>
                <h1>Nouvelle réunion</h1>
            </div>
        </div>

        <div class="form-card">
            @if($errors->any())
            <div class="alert-err">
                <ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('syndic.reunions.store') }}" method="POST">
                @csrf

                <div class="field">
                    <label>Titre <span class="req">*</span></label>
                    <input type="text" name="titre" value="{{ old('titre') }}"
                        placeholder="Ex: Assemblée générale annuelle">
                    @error('titre')<div class="err">{{ $message }}</div>@enderror
                </div>

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

                <div class="g2">
                    <div class="field">
                        <label>Date et heure <span class="req">*</span></label>
                        <input type="datetime-local" name="date" value="{{ old('date') }}">
                        @error('date')<div class="err">{{ $message }}</div>@enderror
                    </div>
                    <div class="field">
                        <label>Lieu <span class="req">*</span></label>
                        <input type="text" name="lieu" value="{{ old('lieu') }}"
                            placeholder="Ex: Salle de réunion, Résidence...">
                        @error('lieu')<div class="err">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="field">
                    <label>Ordre du jour</label>
                    <textarea name="ordre_jour"
                        placeholder="Points à aborder lors de la réunion...">{{ old('ordre_jour') }}</textarea>
                    @error('ordre_jour')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">📅 Créer la réunion</button>
                    <a href="{{ route('syndic.reunions.index') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection