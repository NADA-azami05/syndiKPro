@extends('layouts.app')
@section('title', 'Copropriétés')

@push('styles')
<style>
* { margin:0; padding:0; box-sizing:border-box; }
.dw { display:grid; grid-template-columns:220px 1fr; min-height:calc(100vh - 68px); background:#f0f4ff; }

/* ── SIDEBAR ── */
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

/* ── CONTENU ── */
.mc { padding:32px 36px; }
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
.page-header h1 { font-family:var(--font-serif); font-size:24px; font-weight:700; color:#111; }
.page-header p { font-size:14px; color:#6b7280; margin-top:4px; }
.btn-primary { display:inline-flex; align-items:center; gap:8px; background:#006AD7; color:#fff; padding:11px 20px; border-radius:10px; font-size:14px; font-weight:500; text-decoration:none; transition:background .2s; border:none; cursor:pointer; font-family:inherit; }
.btn-primary:hover { background:#0055b3; }
.btn-secondary { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#006AD7; border:1px solid #006AD7; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:500; text-decoration:none; transition:all .2s; }
.btn-secondary:hover { background:#e6f2ff; }
.btn-danger { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#ef4444; border:1px solid #ef4444; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:500; text-decoration:none; transition:all .2s; cursor:pointer; font-family:inherit; }
.btn-danger:hover { background:#fef2f2; }

/* ── STATS ── */
.stats-row { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px; }
.stat-card { background:#fff; border:1px solid #e5e7eb; border-top:3px solid #006AD7; border-radius:14px; padding:20px; display:flex; align-items:center; gap:14px; }
.stat-icon { width:44px; height:44px; border-radius:11px; background:#e6f2ff; display:grid; place-items:center; font-size:20px; flex-shrink:0; }
.stat-num { font-family:var(--font-serif); font-size:26px; font-weight:700; color:#111; line-height:1; }
.stat-label { font-size:12px; color:#6b7280; margin-top:3px; }

/* ── TABLE CARD ── */
.table-card { background:#fff; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,.04); }
.table-card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 22px; border-bottom:1px solid #e5e7eb; }
.table-card-title { font-size:15px; font-weight:600; color:#111; }
.search-box { display:flex; align-items:center; gap:10px; }
.search-input { padding:9px 14px; border:1px solid #e5e7eb; border-radius:8px; font-size:13px; font-family:inherit; outline:none; width:220px; transition:border-color .2s; }
.search-input:focus { border-color:#006AD7; }

/* ── TABLE ── */
.dt { width:100%; border-collapse:collapse; }
.dt th { text-align:left; font-size:11px; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#6b7280; padding:12px 16px; border-bottom:1px solid #e5e7eb; background:#fafbff; }
.dt td { padding:14px 16px; font-size:13px; color:#333; border-bottom:1px solid #f5f5f5; vertical-align:middle; }
.dt tr:last-child td { border-bottom:none; }
.dt tr:hover td { background:#fafbff; }

/* ── BADGES ── */
.badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:100px; font-size:11px; font-weight:600; }
.badge-blue { background:#e6f2ff; color:#006AD7; }
.badge-green { background:#f0fdf4; color:#16a34a; }

/* ── ACTIONS ── */
.actions { display:flex; gap:8px; }

/* ── EMPTY ── */
.empty-state { text-align:center; padding:60px 20px; color:#6b7280; }
.empty-state .icon { font-size:40px; margin-bottom:14px; }
.empty-state h3 { font-family:var(--font-serif); font-size:18px; color:#111; margin-bottom:8px; }

/* ── PAGINATION ── */
.pagination-wrap { padding:16px 22px; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; }

/* ── FLASH ── */
.flash { padding:13px 18px; border-radius:10px; font-size:14px; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
.flash.success { background:#f0fdf4; border:1px solid #86efac; color:#15803d; }
.flash.error { background:#fef2f2; border:1px solid #fca5a5; color:#dc2626; }
</style>
@endpush

@section('content')
<div class="dw">

    {{-- SIDEBAR --}}
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
                <div><div class="sb-uname">{{ Str::limit(auth()->user()->name, 14) }}</div><div class="sb-urole">Syndic</div></div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit" class="sb-out">🚪 Déconnexion</button>
            </form>
        </div>
    </aside>

    {{-- CONTENU --}}
    <main class="mc">

        {{-- Header --}}
        <div class="page-header">
            <div>
                <h1>🏙️ Copropriétés</h1>
                <p>Gérez vos immeubles et résidences</p>
            </div>
            <a href="{{ route('syndic.coproprietes.create') }}" class="btn-primary">
                + Nouvelle copropriété
            </a>
        </div>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flash success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash error">✕ {{ session('error') }}</div>
        @endif

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">🏙️</div>
                <div><div class="stat-num">{{ $coproprietes->total() }}</div><div class="stat-label">Total copropriétés</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏠</div>
                <div><div class="stat-num">{{ $coproprietes->sum('lots_count') }}</div><div class="stat-label">Total lots</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div><div class="stat-num">{{ number_format($coproprietes->sum('budget') / 1000, 0) }}k</div><div class="stat-label">Budget total (MAD)</div></div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Liste des copropriétés</span>
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="🔍 Rechercher..." id="searchInput">
                </div>
            </div>

            @if($coproprietes->count())
            <table class="dt">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Lots</th>
                        <th>Budget (MAD)</th>
                        <th>Syndic</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($coproprietes as $c)
                    <tr>
                        <td>
                            <strong style="color:#111">{{ $c->nom }}</strong>
                        </td>
                        <td>{{ $c->adresse }}</td>
                        <td><span class="badge badge-blue">{{ $c->ville }}</span></td>
                        <td>
                            <span class="badge badge-green">{{ $c->lots_count }} lots</span>
                        </td>
                        <td>{{ number_format($c->budget, 0, ',', ' ') }} MAD</td>
                        <td>{{ $c->syndic_nom ?? '—' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('syndic.coproprietes.edit', $c) }}" class="btn-secondary">✏️ Modifier</a>
                                <form action="{{ route('syndic.coproprietes.destroy', $c) }}" method="POST" onsubmit="return confirm('Supprimer cette copropriété ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrap">
                {{ $coproprietes->links() }}
            </div>
            @else
            <div class="empty-state">
                <div class="icon">🏙️</div>
                <h3>Aucune copropriété</h3>
                <p>Commencez par créer votre première copropriété.</p>
                <br>
                <a href="{{ route('syndic.coproprietes.create') }}" class="btn-primary">+ Créer une copropriété</a>
            </div>
            @endif
        </div>

    </main>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endpush