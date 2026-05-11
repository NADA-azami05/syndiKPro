@extends('layouts.app')
@section('title', $fournisseur->nom)

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
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
.page-header-left { display:flex; align-items:center; gap:14px; }
.back-btn { color:#6b7280; text-decoration:none; font-size:14px; }
.back-btn:hover { color:#006AD7; }
.page-header h1 { font-size:24px; font-weight:700; color:#111; }
.btn-edit { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#006AD7; border:1px solid #006AD7; padding:10px 20px; border-radius:10px; font-size:14px; text-decoration:none; transition:all .2s; }
.btn-edit:hover { background:#006AD7; color:#fff; }
.alert-success { background:#d1fae5; border:1px solid #6ee7b7; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; color:#065f46; }

.grid2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }

/* Fiche */
.fiche { background:#fff; border:1px solid #e5e7eb; border-radius:16px; padding:28px; }
.fiche-header { display:flex; align-items:center; gap:18px; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid #f0f0f0; }
.fiche-avatar { width:60px; height:60px; border-radius:14px; background:#006AD7; color:#fff; display:grid; place-items:center; font-size:24px; }
.fiche-name { font-size:20px; font-weight:700; color:#111; }
.fiche-cat { font-size:13px; color:#6b7280; margin-top:2px; }
.badge-statut { display:inline-flex; align-items:center; padding:3px 12px; border-radius:20px; font-size:12px; font-weight:500; margin-top:6px; }
.badge-actif   { background:#d1fae5; color:#065f46; }
.badge-inactif { background:#fee2e2; color:#991b1b; }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.info-item label { font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#9ca3af; display:block; margin-bottom:4px; }
.info-item span { font-size:14px; color:#111; }

/* Note */
.note-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; padding:24px; }
.note-card h3 { font-size:15px; font-weight:600; color:#111; margin-bottom:16px; }
.stars-big { font-size:34px; color:#f59e0b; margin-bottom:6px; }
.note-val { font-size:40px; font-weight:700; color:#111; }
.note-sub { font-size:13px; color:#9ca3af; }
.star-form { margin-top:20px; padding-top:16px; border-top:1px solid #f0f0f0; }
.star-form-title { font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; display:block; margin-bottom:10px; }
.star-rating { display:flex; flex-direction:row-reverse; justify-content:flex-end; gap:6px; margin-bottom:12px; }
.star-rating input[type=radio] { display:none; }
.star-rating label { font-size:26px; color:#e5e7eb; cursor:pointer; transition:color .15s; }
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label { color:#f59e0b; }
.btn-noter { width:100%; padding:10px; background:#006AD7; color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:500; cursor:pointer; font-family:inherit; }
.btn-noter:hover { background:#0055b3; }

/* Interventions */
.interv-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; }
.interv-card-header { padding:18px 24px; border-bottom:1px solid #e5e7eb; display:flex; align-items:center; justify-content:space-between; }
.interv-card-header h3 { font-size:15px; font-weight:600; color:#111; }
.btn-sm { display:inline-flex; align-items:center; gap:6px; background:#006AD7; color:#fff; padding:8px 16px; border-radius:8px; font-size:13px; text-decoration:none; }

table { width:100%; border-collapse:collapse; }
thead th { background:#fafbff; padding:11px 16px; text-align:left; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; border-bottom:1px solid #e5e7eb; }
tbody td { padding:13px 16px; font-size:14px; color:#374151; border-bottom:1px solid #f3f4f6; }
tbody tr:last-child td { border-bottom:none; }
tbody tr:hover { background:#fafbff; }

.badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:500; }
.badge-planifiee { background:#fef3c7; color:#92400e; }
.badge-en_cours  { background:#dbeafe; color:#1e40af; }
.badge-terminee  { background:#d1fae5; color:#065f46; }

.empty-state { text-align:center; padding:40px; color:#9ca3af; font-size:14px; }
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
            <div class="page-header-left">
                <a href="{{ route('syndic.fournisseurs.index') }}" class="back-btn">← Retour</a>
                <h1>🔧 {{ $fournisseur->nom }}</h1>
            </div>
            <a href="{{ route('syndic.fournisseurs.edit', $fournisseur) }}" class="btn-edit">✏️ Modifier</a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="grid2">

            {{-- Fiche fournisseur --}}
            <div class="fiche">
                <div class="fiche-header">
                    <div class="fiche-avatar">🔧</div>
                    <div>
                        <div class="fiche-name">{{ $fournisseur->nom }}</div>
                        <div class="fiche-cat">
                            @switch($fournisseur->categorie)
                                @case('plomberie')   🔧 Plomberie   @break
                                @case('electricite') ⚡ Électricité @break
                                @case('nettoyage')   🧹 Nettoyage   @break
                                @case('securite')    🔒 Sécurité    @break
                                @default             🔩 Autre
                            @endswitch
                        </div>
                        @if($fournisseur->actif)
                            <span class="badge-statut badge-actif">● Actif</span>
                        @else
                            <span class="badge-statut badge-inactif">● Inactif</span>
                        @endif
                    </div>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>📞 Téléphone</label>
                        <span>{{ $fournisseur->telephone ?? '—' }}</span>
                    </div>
                    <div class="info-item">
                        <label>📧 Email</label>
                        <span>{{ $fournisseur->email ?? '—' }}</span>
                    </div>
                    <div class="info-item" style="grid-column:1/-1;">
                        <label>📍 Adresse</label>
                        <span>{{ $fournisseur->adresse ?? '—' }}</span>
                    </div>
                    <div class="info-item">
                        <label>📅 Depuis</label>
                        <span>{{ $fournisseur->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>🛠️ Interventions</label>
                        <span>{{ $fournisseur->interventions->count() }}</span>
                    </div>
                </div>
            </div>

            {{-- Note --}}
            <div class="note-card">
                <h3>⭐ Évaluation</h3>
                <div class="stars-big">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($fournisseur->note) ? '★' : '☆' }}
                    @endfor
                </div>
                <div class="note-val">{{ number_format($fournisseur->note, 1) }}</div>
                <div class="note-sub">sur 5 étoiles</div>

                <div class="star-form">
                    <span class="star-form-title">Mettre à jour la note</span>
                    <form method="POST" action="{{ route('syndic.fournisseurs.noter', $fournisseur) }}">
                        @csrf
                        <div class="star-rating">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="note" id="note{{ $i }}" value="{{ $i }}"
                                    {{ intval($fournisseur->note) == $i ? 'checked' : '' }}>
                                <label for="note{{ $i }}">★</label>
                            @endfor
                        </div>
                        <button type="submit" class="btn-noter">✓ Enregistrer la note</button>
                    </form>
                </div>
            </div>

        </div>

        {{-- Interventions --}}
        <div class="interv-card">
            <div class="interv-card-header">
                <h3>🛠️ Interventions ({{ $fournisseur->interventions->count() }})</h3>
                <a href="{{ route('syndic.interventions.create') }}?fournisseur={{ $fournisseur->id }}" class="btn-sm">
                    + Nouvelle intervention
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Copropriété</th>
                        <th>Réclamation</th>
                        <th>Date</th>
                        <th>Coût (MAD)</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fournisseur->interventions as $interv)
                    <tr>
                        <td style="font-weight:500;">{{ $interv->titre }}</td>
                        <td>{{ $interv->copropriete->nom ?? '—' }}</td>
                        <td>
                            @if($interv->reclamation)
                                <span style="background:#ede9fe;color:#5b21b6;padding:2px 8px;border-radius:8px;font-size:12px;">
                                    #{{ $interv->reclamation_id }}
                                </span>
                            @else
                                <span style="color:#9ca3af;">—</span>
                            @endif
                        </td>
                        <td>{{ $interv->date_intervention->format('d/m/Y') }}</td>
                        <td>{{ number_format($interv->cout, 2, ',', ' ') }}</td>
                        <td>
                            <span class="badge badge-{{ $interv->statut }}">
                                @switch($interv->statut)
                                    @case('planifiee') 📅 Planifiée @break
                                    @case('en_cours')  🔄 En cours @break
                                    @case('terminee')  ✅ Terminée @break
                                @endswitch
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">Aucune intervention pour ce fournisseur.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection