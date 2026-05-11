@extends('layouts.app')
@section('title', 'Fournisseurs')

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
.btn-primary { display:inline-flex; align-items:center; gap:8px; background:#006AD7; color:#fff; padding:11px 22px; border-radius:10px; font-size:14px; font-weight:500; border:none; cursor:pointer; font-family:inherit; text-decoration:none; transition:background .2s; }
.btn-primary:hover { background:#0055b3; }
.alert-success { background:#d1fae5; border:1px solid #6ee7b7; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; color:#065f46; }

.stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-radius:14px; padding:20px; text-align:center; }
.stat-val { font-size:28px; font-weight:700; }
.stat-val.blue { color:#006AD7; }
.stat-val.green { color:#10b981; }
.stat-val.orange { color:#f59e0b; }
.stat-lbl { font-size:12px; color:#9ca3af; margin-top:4px; }

.table-card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; overflow:hidden; }
.table-card-header { padding:18px 24px; border-bottom:1px solid #e5e7eb; display:flex; align-items:center; justify-content:space-between; }
.table-card-header h2 { font-size:15px; font-weight:600; color:#111; }

table { width:100%; border-collapse:collapse; }
thead th { background:#fafbff; padding:12px 16px; text-align:left; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; border-bottom:1px solid #e5e7eb; }
tbody td { padding:14px 16px; font-size:14px; color:#374151; border-bottom:1px solid #f3f4f6; }
tbody tr:last-child td { border-bottom:none; }
tbody tr:hover { background:#fafbff; }

.badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:500; }
.badge-green { background:#d1fae5; color:#065f46; }
.badge-red   { background:#fee2e2; color:#991b1b; }
.badge-cat   { background:#ede9fe; color:#5b21b6; }

.stars { color:#f59e0b; font-size:13px; }

.actions { display:flex; gap:6px; }
.btn-icon { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer; font-size:14px; text-decoration:none; transition:all .2s; }
.btn-icon:hover { border-color:#006AD7; background:#f0f4ff; }
.btn-icon.danger:hover { border-color:#ef4444; background:#fef2f2; }

.empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
.empty-state .icon { font-size:48px; margin-bottom:12px; }
.pagination-wrap { padding:16px 24px; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; }

/* Icônes catégorie */
.cat-icon { margin-right:5px; }
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
                <h1>🔧 Fournisseurs</h1>
                <p>Gérez vos prestataires et leurs interventions</p>
            </div>
            <a href="{{ route('syndic.fournisseurs.create') }}" class="btn-primary">+ Nouveau fournisseur</a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-val blue">{{ $fournisseurs->total() }}</div>
                <div class="stat-lbl">Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-val green">{{ $fournisseurs->where('actif', true)->count() }}</div>
                <div class="stat-lbl">Actifs</div>
            </div>
            <div class="stat-card">
                <div class="stat-val orange">{{ $fournisseurs->sum('interventions_count') }}</div>
                <div class="stat-lbl">Interventions</div>
            </div>
            <div class="stat-card">
                <div class="stat-val orange">{{ number_format($fournisseurs->avg('note'), 1) }} ⭐</div>
                <div class="stat-lbl">Note moyenne</div>
            </div>
        </div>

        {{-- Tableau --}}
        <div class="table-card">
            <div class="table-card-header">
                <h2>Liste des fournisseurs</h2>
                <a href="{{ route('syndic.interventions.index') }}" class="btn-primary" style="padding:8px 16px;font-size:13px;">
                    📋 Toutes les interventions
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fournisseur</th>
                        <th>Catégorie</th>
                        <th>Téléphone</th>
                        <th>Note</th>
                        <th>Interventions</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fournisseurs as $f)
                    <tr>
                        <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight:600;color:#111;">{{ $f->nom }}</div>
                            @if($f->email)
                                <div style="font-size:12px;color:#9ca3af;">{{ $f->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-cat">
                                @switch($f->categorie)
                                    @case('plomberie')   🔧 Plomberie   @break
                                    @case('electricite') ⚡ Électricité @break
                                    @case('nettoyage')   🧹 Nettoyage   @break
                                    @case('securite')    🔒 Sécurité    @break
                                    @default             🔩 Autre
                                @endswitch
                            </span>
                        </td>
                        <td>{{ $f->telephone ?? '—' }}</td>
                        <td>
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= round($f->note) ? '★' : '☆' }}
                                @endfor
                            </span>
                            <span style="font-size:12px;color:#9ca3af;margin-left:4px;">{{ number_format($f->note,1) }}</span>
                        </td>
                        <td style="text-align:center;">
                            <span style="background:#e0f2fe;color:#0369a1;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500;">
                                {{ $f->interventions_count }}
                            </span>
                        </td>
                        <td>
                            @if($f->actif)
                                <span class="badge badge-green">● Actif</span>
                            @else
                                <span class="badge badge-red">● Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('syndic.fournisseurs.show', $f) }}" class="btn-icon" title="Voir">👁️</a>
                                <a href="{{ route('syndic.fournisseurs.edit', $f) }}" class="btn-icon" title="Modifier">✏️</a>
                                <button type="submit" form="del-{{ $f->id }}" class="btn-icon danger"
                                        onclick="return confirm('Supprimer ce fournisseur ?')">🗑️</button>
                            </div>
                            <form id="del-{{ $f->id }}"
                                  action="{{ route('syndic.fournisseurs.destroy', $f) }}"
                                  method="POST" style="display:none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="icon">🔧</div>
                                <p>Aucun fournisseur enregistré.</p>
                                <a href="{{ route('syndic.fournisseurs.create') }}" class="btn-primary">+ Ajouter le premier</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($fournisseurs->hasPages())
                <div class="pagination-wrap">{{ $fournisseurs->links() }}</div>
            @endif
        </div>
    </main>
</div>
@endsection