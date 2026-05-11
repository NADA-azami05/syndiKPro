@extends('layouts.app')
@section('title', $vote->titre)
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
.page-header{display:flex;align-items:center;gap:14px;margin-bottom:28px;flex-wrap:wrap}
.page-header a{display:inline-flex;align-items:center;gap:6px;color:#6b7280;font-size:14px;text-decoration:none;padding:8px 14px;border-radius:9px;border:1px solid #e5e7eb;background:#fff;transition:all .2s;flex-shrink:0}
.page-header a:hover{border-color:#006AD7;color:#006AD7}
.page-header-info{flex:1}
.page-header-info h1{font-family:var(--font-serif);font-size:22px;font-weight:700;color:#111}
.page-header-info p{font-size:13px;color:#6b7280;margin-top:3px}
.badge{display:inline-flex;align-items:center;padding:4px 12px;border-radius:100px;font-size:12px;font-weight:600}
.badge-ouvert{background:#f0fdf4;color:#16a34a}
.badge-ferme{background:#fef2f2;color:#dc2626}
.content-grid{display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:24px;margin-bottom:20px}
.card-title{font-size:15px;font-weight:600;color:#111;margin-bottom:16px;display:flex;align-items:center;gap:8px}
.info-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f5f5f5;font-size:14px}
.info-row:last-child{border-bottom:none}
.info-label{color:#6b7280}
.info-val{font-weight:600;color:#111}
.result-item{margin-bottom:20px}
.result-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
.result-label{font-size:14px;font-weight:600;color:#111}
.result-stats{display:flex;align-items:center;gap:10px}
.result-pct{font-size:20px;font-weight:700;color:#006AD7}
.result-count{font-size:13px;color:#6b7280}
.result-bar-bg{height:12px;background:#f0f4ff;border-radius:100px;overflow:hidden}
.result-bar-fill{height:100%;border-radius:100px;background:linear-gradient(90deg,#006AD7,#3b9ef5);transition:width 1s ease}
.result-bar-fill.winner{background:linear-gradient(90deg,#16a34a,#4ade80)}
.vote-form-card{background:#fff;border:2px solid #006AD7;border-radius:14px;padding:24px}
.vote-form-title{font-size:15px;font-weight:700;color:#006AD7;margin-bottom:16px}
.vote-option{display:flex;align-items:center;gap:12px;padding:13px 16px;border:1px solid #e5e7eb;border-radius:10px;margin-bottom:10px;cursor:pointer;transition:all .2s}
.vote-option:hover{border-color:#006AD7;background:#f0f4ff}
.vote-option input[type=radio]{accent-color:#006AD7;width:18px;height:18px;flex-shrink:0}
.vote-option label{font-size:14px;font-weight:500;color:#111;cursor:pointer;flex:1}
.btn-voter{width:100%;padding:13px;background:#006AD7;color:#fff;font-size:15px;font-weight:700;border:none;border-radius:10px;cursor:pointer;margin-top:14px;transition:background .2s}
.btn-voter:hover{background:#0058b3}
.already-voted{text-align:center;padding:20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px}
.already-voted-icon{font-size:32px;margin-bottom:8px}
.already-voted p{font-size:14px;color:#16a34a;font-weight:600}
.closed-notice{text-align:center;padding:20px;background:#fef2f2;border:1px solid #fecaca;border-radius:12px}
.alert{padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626}
.total-badge{display:inline-flex;align-items:center;gap:6px;background:#f0f4ff;color:#006AD7;padding:6px 14px;border-radius:100px;font-size:13px;font-weight:600;margin-bottom:20px}
.btn-clot{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:10px;background:#fef2f2;color:#dc2626;font-size:14px;font-weight:600;border:1px solid #fecaca;cursor:pointer;transition:all .2s}
.btn-clot:hover{background:#fee2e2}
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

  <div class="page-header">
    {{-- ✅ Retour adapté selon le rôle --}}
    <a href="{{ auth()->user()->role === 'syndic' ? route('syndic.votes.index') : route('resident.votes.index') }}">
      ← Retour
    </a>
    <div class="page-header-info">
      <h1>{{ $vote->titre }}</h1>
      <p>🏙️ {{ $vote->copropriete->nom ?? '—' }} &nbsp;·&nbsp; Créé le {{ $vote->created_at->format('d/m/Y') }}</p>
    </div>
    <span class="badge {{ $vote->statut === 'ouvert' ? 'badge-ouvert' : 'badge-ferme' }}">
      {{ $vote->statut === 'ouvert' ? '🟢 Ouvert' : '🔴 Clôturé' }}
    </span>
  </div>

  @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">❌ {{ session('error') }}</div>
  @endif

  <div class="content-grid">

    {{-- Colonne gauche : infos + résultats --}}
    <div>

      {{-- Infos générales --}}
      <div class="card">
        <div class="card-title">📋 Informations</div>
        @if($vote->description)
          <p style="font-size:14px;color:#374151;margin-bottom:16px;line-height:1.6">{{ $vote->description }}</p>
        @endif
        <div class="info-row">
          <span class="info-label">Statut</span>
          <span class="info-val">{{ $vote->statut === 'ouvert' ? '🟢 Ouvert' : '🔴 Clôturé' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Date de clôture</span>
          <span class="info-val">
            {{ $vote->date_fin->format('d/m/Y à H:i') }}
            @if($vote->date_fin->isPast())
              <span style="font-size:11px;color:#dc2626;font-weight:400"> (expiré)</span>
            @else
              <span style="font-size:11px;color:#16a34a;font-weight:400"> ({{ $vote->date_fin->diffForHumans() }})</span>
            @endif
          </span>
        </div>
        <div class="info-row">
          <span class="info-label">Nombre d'options</span>
          <span class="info-val">{{ count($vote->options) }} options</span>
        </div>
        <div class="info-row">
          <span class="info-label">Participation</span>
          <span class="info-val">{{ $totalReponses }} vote(s)</span>
        </div>
      </div>

      {{-- Résultats --}}
      <div class="card">
        <div class="card-title">📊 Résultats en temps réel</div>
        @php $maxPct = collect($resultats)->max('pourcentage'); @endphp
        <div class="total-badge">👤 {{ $totalReponses }} participant(s) au total</div>

        @if($totalReponses === 0)
          <p style="text-align:center;color:#6b7280;padding:20px;font-size:14px">
            Aucun vote enregistré pour le moment.
          </p>
        @else
          @foreach($resultats as $option => $data)
            @php $isWinner = $data['pourcentage'] === $maxPct && $maxPct > 0; @endphp
            <div class="result-item">
              <div class="result-header">
                <div class="result-label">
                  {{ $option }}
                  @if($isWinner && $vote->statut === 'ferme')
                    <span style="font-size:12px;color:#16a34a;margin-left:6px">🏆 Gagnant</span>
                  @endif
                </div>
                <div class="result-stats">
                  <span class="result-pct">{{ $data['pourcentage'] }}%</span>
                  <span class="result-count">({{ $data['count'] }} vote(s))</span>
                </div>
              </div>
              <div class="result-bar-bg">
                <div class="result-bar-fill {{ $isWinner ? 'winner' : '' }}"
                     style="width:0%"
                     data-width="{{ $data['pourcentage'] }}%">
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>

      {{-- Bouton clôturer (syndic seulement) --}}
      @if(auth()->user()->role === 'syndic' && $vote->statut === 'ouvert')
        <form method="POST" action="{{ route('syndic.votes.cloturer', $vote) }}"
              onsubmit="return confirm('Clôturer définitivement ce vote ?')">
          @csrf @method('PATCH')
          <button type="submit" class="btn-clot">🔒 Clôturer ce vote</button>
        </form>
      @endif

    </div>

    {{-- Colonne droite --}}
    <div>

      @if(auth()->user()->role === 'resident')

        @if($aDejaVote)
          {{-- Déjà voté --}}
          <div class="already-voted">
            <div class="already-voted-icon">✅</div>
            <p>Vous avez déjà participé à ce vote.</p>
            <p style="font-size:13px;color:#6b7280;margin-top:4px;font-weight:400">Merci pour votre participation !</p>
          </div>

        @elseif($vote->statut === 'ferme' || $vote->date_fin->isPast())
          {{-- Vote clôturé --}}
          <div class="closed-notice">
            <div style="font-size:32px;margin-bottom:8px">🔒</div>
            <p style="font-size:14px;color:#dc2626;font-weight:600">Ce vote est clôturé</p>
            <p style="font-size:13px;color:#6b7280;margin-top:4px">La participation n'est plus possible.</p>
          </div>

        @else
          {{-- ✅ Formulaire de vote résident — route corrigée --}}
          <div class="vote-form-card">
            <div class="vote-form-title">🗳️ Participer au vote</div>
            <form method="POST" action="{{ route('resident.votes.voter', $vote) }}">
              @csrf
              @foreach($vote->options as $option)
                <div class="vote-option" onclick="this.querySelector('input').checked=true;highlightSelected(this)">
                  <input type="radio" name="choix" id="opt_{{ $loop->index }}" value="{{ $option }}">
                  <label for="opt_{{ $loop->index }}">{{ $option }}</label>
                </div>
              @endforeach
              @error('choix')
                <div style="font-size:12px;color:#dc2626;margin-top:6px">{{ $message }}</div>
              @enderror
              <button type="submit" class="btn-voter">Voter →</button>
            </form>
          </div>
        @endif

      @else
        {{-- Vue syndic côté droit : stats rapides --}}
        <div class="card">
          <div class="card-title">📈 Statistiques</div>
          <div class="info-row">
            <span class="info-label">Total participants</span>
            <span class="info-val">{{ $totalReponses }}</span>
          </div>
          @php $leading = collect($resultats)->sortByDesc('pourcentage')->first(); @endphp
          @if($leading && $totalReponses > 0)
            <div class="info-row">
              <span class="info-label">Option en tête</span>
              <span class="info-val">{{ collect($resultats)->sortByDesc('pourcentage')->keys()->first() }}</span>
            </div>
            <div class="info-row">
              <span class="info-label">Score max</span>
              <span class="info-val" style="color:#006AD7">{{ $leading['pourcentage'] }}%</span>
            </div>
          @endif
        </div>
      @endif

    </div>

  </div>

</main>
</div>

<script>
window.addEventListener('load', function () {
  document.querySelectorAll('.result-bar-fill').forEach(function (bar) {
    setTimeout(function () { bar.style.width = bar.dataset.width; }, 200);
  });
});

function highlightSelected(el) {
  document.querySelectorAll('.vote-option').forEach(function (o) {
    o.style.borderColor = '#e5e7eb';
    o.style.background = '#fff';
  });
  el.style.borderColor = '#006AD7';
  el.style.background = '#f0f4ff';
}
</script>
@endsection