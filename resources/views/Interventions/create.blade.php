@extends('layouts.app')
@section('title', 'Nouvelle Intervention')

@push('styles')
<style>
* { margin:0; padding:0; box-sizing:border-box; }
.dw { display:grid; grid-template-columns:220px 1fr; min-height:calc(100vh - 68px); background:#f0f4ff; }
.sb { background:#fff; border-right:1px solid #e5e7eb; display:flex; flex-direction:column; padding:24px 0; position:sticky; top:68px; height:calc(100vh - 68px); overflow-y:auto; }
.sb-nav { flex:1; display:flex; flex-direction:column; gap:4px; padding:0 12px; }
.sb-item { display:flex; align-items:center; gap:12px; padding:11px 14px; border-radius:10px; text-decoration:none; font-size:14px; font-weight:500; color:#6b7280; transition:all .2s; }
.sb-item:hover { background:#f0f4ff; color:#006AD7; }
.sb-item.active { background:#006AD7; color:#fff; }
.sb-bot { padding:16px 12px 0; border-top:1px solid #e5e7eb; margin-top:auto; }
.sb-user { display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:10px; background:#f0f4ff; margin-bottom:8px; }
.sb-av { width:34px; height:34px; border-radius:50%; background:#006AD7; color:#fff; display:grid; place-items:center; font-size:13px; font-weight:700; flex-shrink:0; }
.sb-uname { font-size:13px; font-weight:600; color:#111; }
.sb-urole { font-size:11px; color:#6b7280; }
.sb-out { display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:10px; color:#ef4444; font-size:13px; font-weight:500; cursor:pointer; background:none; border:none; width:100%; font-family:inherit; transition:background .2s; }
.sb-out:hover { background:#fef2f2; }

.mc { padding:32px 36px; }
.page-header { display:flex; align-items:center; gap:14px; margin-bottom:28px; }
.back-btn { color:#6b7280; text-decoration:none; font-size:14px; }
.back-btn:hover { color:#006AD7; }
.page-header h1 { font-size:24px; font-weight:700; color:#111; }

.form-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; max-width:700px; }
.form-card-header { padding:22px 28px; border-bottom:1px solid #e5e7eb; background:#fafbff; }
.form-card-header h2 { font-size:16px; font-weight:600; color:#111; }
.form-card-header p { font-size:13px; color:#6b7280; margin-top:4px; }
.form-body { padding:28px; }
.section-title { font-size:11px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#6b7280; padding-bottom:10px; border-bottom:1px solid #f0f0f0; margin-bottom:20px; margin-top:28px; }
.section-title:first-child { margin-top:0; }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.form-grid-full { grid-column:1/-1; }
.form-group label { display:block; font-size:11px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#6b7280; margin-bottom:8px; }
.form-control { width:100%; padding:13px 16px; background:#f0f4ff; border:1px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111; font-family:inherit; outline:none; transition:border-color .2s, box-shadow .2s; }
.form-control:focus { border-color:#006AD7; box-shadow:0 0 0 3px rgba(0,106,215,.10); background:#fff; }
.form-control::placeholder { color:#c4c9d4; }
.form-control.is-invalid { border-color:#ef4444; }
.invalid-feedback { font-size:12px; color:#ef4444; margin-top:5px; }
.form-hint { font-size:11px; color:#9ca3af; margin-top:5px; }

.form-footer { display:flex; align-items:center; justify-content:flex-end; gap:12px; padding:20px 28px; border-top:1px solid #e5e7eb; background:#fafbff; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; background:#006AD7; color:#fff; padding:12px 24px; border-radius:10px; font-size:14px; font-weight:500; border:none; cursor:pointer; font-family:inherit; }
.btn-primary:hover { background:#0055b3; }
.btn-ghost { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#6b7280; border:1px solid #e5e7eb; padding:12px 20px; border-radius:10px; font-size:14px; text-decoration:none; }
.btn-ghost:hover { border-color:#006AD7; color:#006AD7; }
</style>
@endpush

@section('content')
<div class="dw">
    <aside class="sb">
        <nav class="sb-nav">
            <a href="{{ route('syndic.dashboard') }}" class="sb-item">📊 Tableau de bord</a>
            <a href="{{ route('syndic.coproprietes.index') }}" class="sb-item">🏙️ Copropriétés</a>
            <a href="#" class="sb-item">👥 Résidents</a>
            <a href="#" class="sb-item">🏠 Lots</a>
            <a href="#" class="sb-item">📄 Factures</a>
            <a href="#" class="sb-item">📢 Réclamations</a>
            <a href="{{ route('syndic.fournisseurs.index') }}" class="sb-item active">🔧 Fournisseurs</a>
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
            <a href="{{ route('syndic.interventions.index') }}" class="back-btn">← Retour</a>
            <h1>🛠️ Nouvelle intervention</h1>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <h2>Planifier une intervention</h2>
                <p>Associez un fournisseur à une copropriété.</p>
            </div>

            <form method="POST" action="{{ route('syndic.interventions.store') }}">
                @csrf
                <div class="form-body">

                    <div class="section-title">🔧 Prestataire & lieu</div>
                    <div class="form-grid">

                        <div class="form-group">
                            <label>Fournisseur *</label>
                            <select name="fournisseur_id"
                                    class="form-control @error('fournisseur_id') is-invalid @enderror" required>
                                <option value="">— Choisir —</option>
                                @foreach($fournisseurs as $f)
                                    <option value="{{ $f->id }}"
                                        {{ old('fournisseur_id', request('fournisseur')) == $f->id ? 'selected' : '' }}>
                                        {{ $f->nom }} ({{ ucfirst($f->categorie) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('fournisseur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Copropriété *</label>
                            <select name="copropriete_id"
                                    class="form-control @error('copropriete_id') is-invalid @enderror" required>
                                <option value="">— Choisir —</option>
                                @foreach($coproprietes as $c)
                                    <option value="{{ $c->id }}" {{ old('copropriete_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('copropriete_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group form-grid-full">
                            <label>Réclamation liée <span style="color:#9ca3af;font-weight:400;">(optionnel)</span></label>
                            <select name="reclamation_id"
                                    class="form-control @error('reclamation_id') is-invalid @enderror">
                                <option value="">— Aucune réclamation —</option>
                                @foreach($reclamations as $r)
                                    <option value="{{ $r->id }}" {{ old('reclamation_id') == $r->id ? 'selected' : '' }}>
                                        #{{ $r->id }} — {{ Str::limit($r->titre ?? $r->sujet ?? 'Réclamation', 60) }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="form-hint">Liez cette intervention à une réclamation existante si besoin.</p>
                            @error('reclamation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div class="section-title">📋 Détails</div>
                    <div class="form-grid">

                        <div class="form-group form-grid-full">
                            <label>Titre *</label>
                            <input type="text" name="titre"
                                class="form-control @error('titre') is-invalid @enderror"
                                value="{{ old('titre') }}"
                                placeholder="Ex: Réparation fuite plomberie bâtiment A" required>
                            @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group form-grid-full">
                            <label>Description</label>
                            <textarea name="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Détails de l'intervention...">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Statut *</label>
                            <select name="statut"
                                    class="form-control @error('statut') is-invalid @enderror" required>
                                <option value="planifiee" {{ old('statut','planifiee') == 'planifiee' ? 'selected' : '' }}>📅 Planifiée</option>
                                <option value="en_cours"  {{ old('statut') == 'en_cours'  ? 'selected' : '' }}>🔄 En cours</option>
                                <option value="terminee"  {{ old('statut') == 'terminee'  ? 'selected' : '' }}>✅ Terminée</option>
                            </select>
                            @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Coût (MAD)</label>
                            <input type="number" name="cout"
                                class="form-control @error('cout') is-invalid @enderror"
                                value="{{ old('cout', 0) }}"
                                min="0" step="0.01">
                            <p class="form-hint">Montant en dirhams (0 par défaut)</p>
                            @error('cout')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div class="section-title">📅 Date</div>
                    <div class="form-grid">

                        <div class="form-group">
                            <label>Date d'intervention *</label>
                            <input type="date" name="date_intervention"
                                class="form-control @error('date_intervention') is-invalid @enderror"
                                value="{{ old('date_intervention') }}" required>
                            @error('date_intervention')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('syndic.interventions.index') }}" class="btn-ghost">Annuler</a>
                    <button type="submit" class="btn-primary">✓ Créer l'intervention</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection