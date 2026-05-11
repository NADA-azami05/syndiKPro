@extends('layouts.app')
@section('title', 'Modifier Fournisseur')

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
.page-header { display:flex; align-items:center; gap:14px; margin-bottom:20px; }
.back-btn { color:#6b7280; text-decoration:none; font-size:14px; }
.back-btn:hover { color:#006AD7; }
.page-header h1 { font-size:24px; font-weight:700; color:#111; }

.info-banner { background:#e6f2ff; border:1px solid #bfdbfe; border-radius:12px; padding:14px 18px; margin-bottom:22px; font-size:13px; color:#1e40af; max-width:700px; }
.alert-success { background:#d1fae5; border:1px solid #6ee7b7; border-radius:10px; padding:12px 18px; margin-bottom:18px; font-size:13px; color:#065f46; max-width:700px; }

.form-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; max-width:700px; }
.form-card-header { padding:22px 28px; border-bottom:1px solid #e5e7eb; background:#fafbff; display:flex; align-items:center; justify-content:space-between; }
.form-card-header h2 { font-size:16px; font-weight:600; color:#111; }
.form-card-header p { font-size:13px; color:#6b7280; margin-top:4px; }
.edit-badge { background:#fffbeb; color:#d97706; border:1px solid #fcd34d; border-radius:8px; padding:4px 12px; font-size:12px; font-weight:600; }
.form-body { padding:28px; }
.section-title { font-size:11px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#6b7280; padding-bottom:10px; border-bottom:1px solid #f0f0f0; margin-bottom:20px; margin-top:28px; }
.section-title:first-child { margin-top:0; }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.form-grid-full { grid-column:1/-1; }
.form-group label { display:block; font-size:11px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#6b7280; margin-bottom:8px; }
.form-control { width:100%; padding:13px 16px; background:#f0f4ff; border:1px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111; font-family:inherit; outline:none; transition:border-color .2s, box-shadow .2s; }
.form-control:focus { border-color:#006AD7; box-shadow:0 0 0 3px rgba(0,106,215,.10); background:#fff; }
.form-control.is-invalid { border-color:#ef4444; }
.invalid-feedback { font-size:12px; color:#ef4444; margin-top:5px; }

.toggle-wrap { display:flex; align-items:center; gap:12px; padding:14px 16px; background:#f0f4ff; border:1px solid #e5e7eb; border-radius:10px; cursor:pointer; }
.toggle-wrap input[type=checkbox] { width:18px; height:18px; accent-color:#006AD7; cursor:pointer; }
.toggle-label { font-size:14px; color:#111; font-weight:500; }
.toggle-hint { font-size:12px; color:#9ca3af; margin-top:2px; }

.star-rating { display:flex; flex-direction:row-reverse; justify-content:flex-end; gap:6px; margin-top:4px; }
.star-rating input[type=radio] { display:none; }
.star-rating label { font-size:28px; color:#e5e7eb; cursor:pointer; transition:color .15s; }
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label { color:#f59e0b; }

.meta-row { display:flex; gap:20px; margin-top:20px; padding-top:20px; border-top:1px solid #f0f0f0; }
.meta-item { font-size:12px; color:#9ca3af; }
.meta-item strong { color:#6b7280; }

.form-footer { display:flex; align-items:center; justify-content:space-between; padding:20px 28px; border-top:1px solid #e5e7eb; background:#fafbff; }
.form-footer-right { display:flex; gap:12px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; background:#006AD7; color:#fff; padding:12px 24px; border-radius:10px; font-size:14px; font-weight:500; border:none; cursor:pointer; font-family:inherit; transition:background .2s; }
.btn-primary:hover { background:#0055b3; }
.btn-ghost { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#6b7280; border:1px solid #e5e7eb; padding:12px 20px; border-radius:10px; font-size:14px; text-decoration:none; transition:all .2s; }
.btn-ghost:hover { border-color:#006AD7; color:#006AD7; }
.btn-danger { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#ef4444; border:1px solid #ef4444; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:500; cursor:pointer; font-family:inherit; transition:all .2s; }
.btn-danger:hover { background:#fef2f2; }
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
            <a href="{{ route('syndic.fournisseurs.index') }}" class="back-btn">← Retour</a>
            <h1>✏️ Modifier fournisseur</h1>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="info-banner">
            ℹ️ Vous modifiez : <strong>&nbsp;{{ $fournisseur->nom }}</strong>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div>
                    <h2>Informations du fournisseur</h2>
                    <p>Modifiez les informations puis sauvegardez.</p>
                </div>
                <span class="edit-badge">✏️ Mode édition</span>
            </div>

            {{-- ✅ FORM UPDATE --}}
            <form id="form-update" method="POST"
                  action="{{ route('syndic.fournisseurs.update', $fournisseur) }}">
                @csrf @method('PUT')

                <div class="form-body">

                    <div class="section-title">📋 Informations générales</div>
                    <div class="form-grid">

                        <div class="form-group form-grid-full">
                            <label>Nom du fournisseur *</label>
                            <input type="text" name="nom"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom', $fournisseur->nom) }}" required>
                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Catégorie *</label>
                            <select name="categorie"
                                    class="form-control @error('categorie') is-invalid @enderror" required>
                                <option value="plomberie"   {{ old('categorie', $fournisseur->categorie) == 'plomberie'   ? 'selected' : '' }}>🔧 Plomberie</option>
                                <option value="electricite" {{ old('categorie', $fournisseur->categorie) == 'electricite' ? 'selected' : '' }}>⚡ Électricité</option>
                                <option value="nettoyage"   {{ old('categorie', $fournisseur->categorie) == 'nettoyage'   ? 'selected' : '' }}>🧹 Nettoyage</option>
                                <option value="securite"    {{ old('categorie', $fournisseur->categorie) == 'securite'    ? 'selected' : '' }}>🔒 Sécurité</option>
                                <option value="autre"       {{ old('categorie', $fournisseur->categorie) == 'autre'       ? 'selected' : '' }}>🔩 Autre</option>
                            </select>
                            @error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Statut</label>
                            <label class="toggle-wrap">
                                <input type="checkbox" name="actif" value="1"
                                    {{ old('actif', $fournisseur->actif) ? 'checked' : '' }}>
                                <div>
                                    <div class="toggle-label">Fournisseur actif</div>
                                    <div class="toggle-hint">Décochez pour désactiver</div>
                                </div>
                            </label>
                        </div>

                    </div>

                    <div class="section-title">📞 Contact</div>
                    <div class="form-grid">

                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="telephone"
                                class="form-control @error('telephone') is-invalid @enderror"
                                value="{{ old('telephone', $fournisseur->telephone) }}"
                                placeholder="06 XX XX XX XX">
                            @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $fournisseur->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group form-grid-full">
                            <label>Adresse</label>
                            <input type="text" name="adresse"
                                class="form-control @error('adresse') is-invalid @enderror"
                                value="{{ old('adresse', $fournisseur->adresse) }}">
                            @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div class="section-title">⭐ Note</div>
                    <div class="form-group">
                        <label>Évaluation (0 à 5)</label>
                        <div class="star-rating">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="note" id="star{{ $i }}" value="{{ $i }}"
                                    {{ old('note', intval($fournisseur->note)) == $i ? 'checked' : '' }}>
                                <label for="star{{ $i }}">★</label>
                            @endfor
                        </div>
                        @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="meta-row">
                        <span class="meta-item">📅 Créé le : <strong>{{ $fournisseur->created_at->format('d/m/Y') }}</strong></span>
                        <span class="meta-item">🔄 Modifié le : <strong>{{ $fournisseur->updated_at->format('d/m/Y') }}</strong></span>
                    </div>

                </div>

                <div class="form-footer">
                    {{-- ✅ Supprimer via form séparé --}}
                    <button type="submit" form="form-delete" class="btn-danger"
                            onclick="return confirm('Supprimer définitivement ce fournisseur ?')">
                        🗑️ Supprimer
                    </button>
                    <div class="form-footer-right">
                        <a href="{{ route('syndic.fournisseurs.index') }}" class="btn-ghost">Annuler</a>
                        <button type="submit" form="form-update" class="btn-primary">✓ Sauvegarder</button>
                    </div>
                </div>
            </form>

            {{-- ✅ FORM DELETE séparé --}}
            <form id="form-delete"
                  action="{{ route('syndic.fournisseurs.destroy', $fournisseur) }}"
                  method="POST" style="display:none">
                @csrf @method('DELETE')
            </form>

        </div>
    </main>
</div>
@endsection