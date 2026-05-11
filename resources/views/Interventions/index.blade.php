@extends('layouts.app')
@section('title', 'Interventions')

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
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
.page-header h1 { font-size:24px; font-weight:700; color:#111; }
.page-header p { font-size:13px; color:#6b7280; margin-top:4px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; background:#006AD7; color:#fff; padding:11px 22px; border-radius:10px; font-size:14px; font-weight:500; border:none; cursor:pointer; font-family:inherit; text-decoration:none; }
.btn-primary:hover { background:#0055b3; }
.alert-success { background:#d1fae5; border:1px solid #6ee7b7; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; color:#065f46; }

.stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:14px; padding:20px; text-align:center; }
.stat-val { font-size:28px; font-weight:700; }
.stat-val.blue   { color:#006AD7; }
.stat-val.yellow { color:#f59e0b; }
.stat-val.green  { color:#10b981; }
.stat-lbl { font-size:12px; color:#9ca3af; margin-top:4px; }

.table-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; }
.table-card-header { padding:18px 24px; border-bottom:1px solid #e5e7eb; }
.table-card-header h2 { font-size:15px; font-weight:600; color:#111; }

table { width:100%; border-collapse:collapse; }
thead th { background:#fafbff; padding:12px 16px; text-align:left; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; border-bottom:1px solid #e5e7eb; }
tbody td { padding:14px 16px; font-size:14px; color:#374151; border-bottom:1px solid #f3f4f6; }
tbody tr:last-child td { border-bottom:none; }
tbody tr:hover { background:#fafbff; }

.badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:500; }
.badge-planifiee { background:#fef3c7; color:#92400e; }
.badge-en_cours  { background:#dbeafe; color:#1e40af; }
.badge-terminee  { background:#d1fae5; color:#065f46; }

.btn-icon { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer; font-size:14px; text-decoration:none; }
.btn-icon:hover { border-color:#ef4444; background:#fef2f2; }
.empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
.empty-state .icon { font-size:48px; margin-bottom:12px; }
.pagination-wrap { padding:16px 24px; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; }
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
            <div>
                <h1>🛠️ Interventions</h1>
                <p>Suivi de toutes les interventions des fournisseurs</p>
            </div>
            <a href="{{ route('syndic.interventions.create') }}" class="btn-primary">+ Nouvelle intervention</a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-val blue">{{ $interventions->total() }}</div>
                <div class="stat-lbl">Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-val yellow">{{ $interventions->where('statut','en_cours')->count() }}</div>
                <div class="stat-lbl">En cours</div>
            </div>
            <div class="stat-card">
                <div class="stat-val green">{{ $interventions->where('statut','terminee')->count() }}</div>
                <div class="stat-lbl">Terminées</div>
            </div>
            <div class="stat-card">
                <div class="stat-val blue">{{ number_format($interventions->sum('cout'), 0, ',', ' ') }} MAD</div>
                <div class="stat-lbl">Coût total</div>
            </div>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <h2>Liste des interventions</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Fournisseur</th>
                        <th>Copropriété</th>
                        <th>Date</th>
                        <th>Coût (MAD)</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interventions as $interv)
                    <tr>
                        <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
                        <td style="font-weight:600;">{{ $interv->titre }}</td>
                        <td>
                            <a href="{{ route('syndic.fournisseurs.show', $interv->fournisseur) }}"
                               style="color:#006AD7;text-decoration:none;">
                                {{ $interv->fournisseur->nom }}
                            </a>
                        </td>
                        <td>{{ $interv->copropriete->nom }}</td>
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
                        <td>
                            <button type="submit" form="del-{{ $interv->id }}" class="btn-icon"
                                    onclick="return confirm('Supprimer cette intervention ?')">🗑️</button>
                            <form id="del-{{ $interv->id }}"
                                  action="{{ route('syndic.interventions.destroy', $interv) }}"
                                  method="POST" style="display:none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="icon">🛠️</div>
                                <p>Aucune intervention enregistrée.</p>
                                <a href="{{ route('syndic.interventions.create') }}" class="btn-primary">+ Créer la première</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($interventions->hasPages())
                <div class="pagination-wrap">{{ $interventions->links() }}</div>
            @endif
        </div>
    </main>
</div>
@endsection