@extends('layouts.app')
@section('title', 'Votes')
@push('styles')
<style>
*{margin:0;padding:0;box-sizing:border-box}
.dw{display:grid;grid-template-columns:220px 1fr;min-height:calc(100vh - 68px);background:#f0f4ff}
.sb{background:#fff;border-right:1px solid #e5e7eb;display:flex;flex-direction:column;padding:24px 0;position:sticky;top:68px;height:calc(100vh - 68px)}
.sb-nav{flex:1;display:flex;flex-direction:column;gap:4px;padding:0 12px;overflow-y:auto}
.sb-item{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:10px;text-decoration:none;font-size:14px;font-weight:500;color:#6b7280;transition:all .2s}
.sb-item:hover{background:#f0f4ff;color:#006AD7}
.sb-item.active{background:#006AD7;color:#fff}
.sb-item.disabled{opacity:.4;cursor:not-allowed;pointer-events:none}
.sb-bot{padding:16px 12px 0;border-top:1px solid #e5e7eb;margin-top:auto}
.sb-user{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;background:#f0f4ff;margin-bottom:8px}
.sb-av{width:34px;height:34px;border-radius:50%;background:#006AD7;color:#fff;display:grid;place-items:center;font-size:13px;font-weight:700;flex-shrink:0}
.sb-uname{font-size:13px;font-weight:600;color:#111}
.sb-urole{font-size:11px;color:#6b7280}
.sb-out{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;color:#ef4444;font-size:13px;font-weight:500;cursor:pointer;background:none;border:none;width:100%;font-family:inherit;transition:background .2s}
.sb-out:hover{background:#fef2f2}
.badge-soon{font-size:9px;background:#f0f4ff;color:#006AD7;padding:1px 6px;border-radius:20px;margin-left:auto;font-weight:600}
.mc{padding:32px 36px}
.ph{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px}
.ph h1{font-family:var(--font-serif);font-size:24px;font-weight:700;color:#111;margin-bottom:4px}
.ph p{font-size:14px;color:#6b7280}
.btn-primary{display:inline-flex;align-items:center;gap:8px;background:#006AD7;color:#fff;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:background .2s}
.btn-primary:hover{background:#0058b3}
.filters{display:flex;gap:10px;margin-bottom:22px;flex-wrap:wrap}
.filter-btn{padding:7px 16px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;color:#6b7280;font-size:13px;font-weight:500;cursor:pointer;transition:all .2s;text-decoration:none}
.filter-btn.active,.filter-btn:hover{background:#006AD7;color:#fff;border-color:#006AD7}
.votes-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:16px}
.vote-card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:22px;transition:box-shadow .2s,transform .2s;display:flex;flex-direction:column;gap:14px}
.vote-card:hover{box-shadow:0 4px 20px rgba(0,106,215,.1);transform:translateY(-2px)}
.vc-top{display:flex;align-items:flex-start;justify-content:space-between;gap:10px}
.vc-title{font-size:15px;font-weight:600;color:#111;line-height:1.4}
.vc-copro{font-size:12px;color:#6b7280;margin-top:3px}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:100px;font-size:11px;font-weight:600;white-space:nowrap}
.badge-ouvert{background:#f0fdf4;color:#16a34a}
.badge-ferme{background:#fef2f2;color:#dc2626}
.vc-desc{font-size:13px;color:#6b7280;line-height:1.5}
.vc-meta{display:flex;gap:16px;flex-wrap:wrap}
.meta-item{display:flex;align-items:center;gap:6px;font-size:12px;color:#6b7280}
.vc-actions{display:flex;flex-direction:column;gap:8px;margin-top:auto}
.vc-actions-row{display:flex;gap:8px}
.btn-voir{flex:1;text-align:center;padding:9px;border-radius:9px;background:#f0f4ff;color:#006AD7;font-size:13px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:background .2s}
.btn-voir:hover{background:#e0ecff}
.btn-voter{display:block;width:100%;padding:9px;border-radius:9px;background:#006AD7;color:#fff;font-size:13px;font-weight:600;text-decoration:none;text-align:center;transition:background .2s}
.btn-voter:hover{background:#0058b3}
.btn-voted{display:block;width:100%;padding:9px;border-radius:9px;background:#f0fdf4;color:#16a34a;font-size:13px;font-weight:600;text-align:center}
.btn-clot{padding:9px 14px;border-radius:9px;background:#fef2f2;color:#dc2626;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background .2s}
.btn-clot:hover{background:#fee2e2}
.empty{text-align:center;padding:60px 20px;color:#6b7280}
.empty-icon{font-size:48px;margin-bottom:12px}
.alert{padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626}
.pag{margin-top:24px;display:flex;justify-content:center}
</style>
@endpush

@section('content')
<div class="dw">

{{-- ═══════════════════════════ SIDEBAR ═══════════════════════════ --}}
<aside class="sb">
  <nav class="sb-nav">

    @if(auth()->user()->role === 'syndic')
      <a href="{{ route('syndic.dashboard') }}"
         class="sb-item {{ request()->routeIs('syndic.dashboard') ? 'active' : '' }}">📊 Tableau de bord</a>
      <a href="{{ route('syndic.coproprietes.index') }}"
         class="sb-item {{ request()->routeIs('syndic.coproprietes*') ? 'active' : '' }}">🏙️ Copropriétés</a>
      <span class="sb-item disabled">👥 Résidents <span class="badge-soon">bientôt</span></span>
      <a href="{{ route('syndic.lots.index') }}"
         class="sb-item {{ request()->routeIs('syndic.lots*') ? 'active' : '' }}">🏠 Lots</a>
      <span class="sb-item disabled">📄 Factures <span class="badge-soon">bientôt</span></span>
      <span class="sb-item disabled">📢 Réclamations <span class="badge-soon">bientôt</span></span>
      <a href="{{ route('syndic.fournisseurs.index') }}"
         class="sb-item {{ request()->routeIs('syndic.fournisseurs*') ? 'active' : '' }}">🔧 Fournisseurs</a>
      <a href="{{ route('syndic.votes.index') }}"
         class="sb-item {{ request()->routeIs('syndic.votes*') ? 'active' : '' }}">🗳️ Votes</a>
      <span class="sb-item disabled">📣 Annonces <span class="badge-soon">bientôt</span></span>
      <span class="sb-item disabled">📅 Réunions <span class="badge-soon">bientôt</span></span>

    @else
      <a href="{{ route('resident.dashboard') }}"
         class="sb-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">🏠 Mon espace</a>
      <span class="sb-item disabled">📄 Mes factures <span class="badge-soon">bientôt</span></span>
      <span class="sb-item disabled">📢 Réclamations <span class="badge-soon">bientôt</span></span>
      <a href="{{ route('resident.votes.index') }}"
         class="sb-item {{ request()->routeIs('resident.votes*') ? 'active' : '' }}">🗳️ Votes</a>
      <span class="sb-item disabled">📣 Annonces <span class="badge-soon">bientôt</span></span>
      <span class="sb-item disabled">📅 Réunions <span class="badge-soon">bientôt</span></span>
    @endif

  </nav>
  <div class="sb-bot">
    <div class="sb-user">
      <div class="sb-av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      <div>
        <div class="sb-uname">{{ Str::limit(auth()->user()->name, 14) }}</div>
        <div class="sb-urole">{{ ucfirst(auth()->user()->role) }}</div>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">@csrf
      <button type="submit" class="sb-out">🚪 Déconnexion</button>
    </form>
  </div>
</aside>

{{-- ═══════════════════════════ MAIN ═══════════════════════════ --}}
<main class="mc">

  <div class="ph">
    <div>
      <h1>🗳️ Votes</h1>
      <p>{{ auth()->user()->role === 'syndic'
            ? 'Gérez et suivez les votes de la copropriété'
            : 'Participez aux votes de votre résidence' }}</p>
    </div>
    @if(auth()->user()->role === 'syndic')
      <a href="{{ route('syndic.votes.create') }}" class="btn-primary">+ Nouveau vote</a>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">❌ {{ session('error') }}</div>
  @endif

  {{-- Filtres --}}
  @php $routeName = auth()->user()->role === 'syndic' ? 'syndic.votes.index' : 'resident.votes.index'; @endphp
  <div class="filters">
    <a href="{{ route($routeName) }}"
       class="filter-btn {{ !request('statut') ? 'active' : '' }}">Tous</a>
    <a href="{{ route($routeName, ['statut' => 'ouvert']) }}"
       class="filter-btn {{ request('statut') === 'ouvert' ? 'active' : '' }}">🟢 Ouverts</a>
    <a href="{{ route($routeName, ['statut' => 'ferme']) }}"
       class="filter-btn {{ request('statut') === 'ferme' ? 'active' : '' }}">🔴 Clôturés</a>
  </div>

  {{-- Grille --}}
  @if($votes->isEmpty())
    <div class="empty">
      <div class="empty-icon">🗳️</div>
      <p style="font-size:16px;font-weight:600;color:#111;margin-bottom:6px">Aucun vote pour le moment</p>
      @if(auth()->user()->role === 'syndic')
        <p style="font-size:14px">Créez le premier vote en cliquant sur "+ Nouveau vote"</p>
      @else
        <p style="font-size:14px">Aucun vote ouvert pour le moment. Revenez plus tard.</p>
      @endif
    </div>
  @else
    <div class="votes-grid">
      @foreach($votes as $vote)
        <div class="vote-card">

          {{-- En-tête --}}
          <div class="vc-top">
            <div>
              <div class="vc-title">{{ $vote->titre }}</div>
              <div class="vc-copro">🏙️ {{ $vote->copropriete->nom ?? '—' }}</div>
            </div>
            <span class="badge {{ $vote->statut === 'ouvert' ? 'badge-ouvert' : 'badge-ferme' }}">
              {{ $vote->statut === 'ouvert' ? '🟢 Ouvert' : '🔴 Clôturé' }}
            </span>
          </div>

          {{-- Description --}}
          @if($vote->description)
            <p class="vc-desc">{{ Str::limit($vote->description, 90) }}</p>
          @endif

          {{-- Méta --}}
          <div class="vc-meta">
            <span class="meta-item">🗂️ {{ count($vote->options) }} options</span>
            <span class="meta-item">👤 {{ $vote->reponses_count }} votes</span>
            <span class="meta-item">
              📅 Fin : {{ $vote->date_fin->format('d/m/Y H:i') }}
              @if($vote->date_fin->isPast() && $vote->statut === 'ouvert')
                <span style="color:#dc2626;font-weight:600"> (expiré)</span>
              @endif
            </span>
          </div>

          {{-- Actions --}}
          <div class="vc-actions">

            {{-- Ligne 1 : Voir résultats + Clôturer (syndic) --}}
            <div class="vc-actions-row">
              <a href="{{ auth()->user()->role === 'syndic'
                          ? route('syndic.votes.show', $vote)
                          : route('resident.votes.show', $vote) }}"
                 class="btn-voir">Voir les résultats</a>

              @if(auth()->user()->role === 'syndic' && $vote->statut === 'ouvert')
                <form method="POST" action="{{ route('syndic.votes.cloturer', $vote) }}"
                      onsubmit="return confirm('Clôturer ce vote définitivement ?')">
                  @csrf @method('PATCH')
                  <button type="submit" class="btn-clot">🔒 Clôturer</button>
                </form>
              @endif
            </div>

            {{-- Ligne 2 : Voter (résident seulement) --}}
            @if(auth()->user()->role === 'resident' && $vote->statut === 'ouvert' && $vote->date_fin >= now())
              @php
                $aVote = \App\Models\VoteReponse::where('vote_id', $vote->id)
                    ->where('resident_id', auth()->user()->resident->id ?? 0)
                    ->exists();
              @endphp

              @if(!$aVote)
                <a href="{{ route('resident.votes.show', $vote) }}" class="btn-voter">
                  🗳️ Voter maintenant
                </a>
              @else
                <div class="btn-voted">✅ Vous avez déjà voté</div>
              @endif
            @endif

          </div>
        </div>
      @endforeach
    </div>

    <div class="pag">{{ $votes->links() }}</div>
  @endif

</main>
</div>
@endsection