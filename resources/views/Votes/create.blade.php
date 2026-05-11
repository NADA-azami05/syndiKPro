@extends('layouts.app')
@section('title', 'Créer un vote')
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
.page-header{display:flex;align-items:center;gap:14px;margin-bottom:28px}
.page-header a{display:inline-flex;align-items:center;gap:6px;color:#6b7280;font-size:14px;text-decoration:none;padding:8px 14px;border-radius:9px;border:1px solid #e5e7eb;background:#fff;transition:all .2s}
.page-header a:hover{border-color:#006AD7;color:#006AD7}
.page-header h1{font-family:var(--font-serif);font-size:22px;font-weight:700;color:#111}
.form-card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:32px;max-width:720px}
.form-section{margin-bottom:24px}
.form-section-title{font-size:13px;font-weight:700;color:#006AD7;text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;padding-bottom:8px;border-bottom:1px solid #e5e7eb}
.form-group{margin-bottom:18px}
.form-label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px}
.form-label span{color:#dc2626}
.form-control{width:100%;padding:10px 13px;border:1px solid #e5e7eb;border-radius:9px;font-size:14px;color:#111;background:#fff;transition:border-color .2s;font-family:inherit}
.form-control:focus{outline:none;border-color:#006AD7;box-shadow:0 0 0 3px rgba(0,106,215,.08)}
.form-control.is-invalid{border-color:#dc2626}
.invalid-feedback{font-size:12px;color:#dc2626;margin-top:4px}
.form-hint{font-size:12px;color:#9ca3af;margin-top:4px}
.options-list{display:flex;flex-direction:column;gap:10px}
.option-row{display:flex;align-items:center;gap:8px}
.option-num{width:26px;height:26px;border-radius:50%;background:#f0f4ff;color:#006AD7;font-size:12px;font-weight:700;display:grid;place-items:center;flex-shrink:0}
.option-row .form-control{flex:1}
.btn-remove-opt{width:32px;height:32px;border-radius:8px;background:#fef2f2;color:#dc2626;border:none;cursor:pointer;font-size:16px;display:grid;place-items:center;flex-shrink:0;transition:background .2s}
.btn-remove-opt:hover{background:#fee2e2}
.btn-add-opt{display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 14px;border-radius:9px;border:1px dashed #006AD7;background:transparent;color:#006AD7;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s}
.btn-add-opt:hover{background:#f0f4ff}
.form-actions{display:flex;gap:10px;margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb}
.btn-primary{padding:11px 24px;border-radius:10px;background:#006AD7;color:#fff;font-size:14px;font-weight:600;border:none;cursor:pointer;transition:background .2s}
.btn-primary:hover{background:#0058b3}
.btn-cancel{padding:11px 20px;border-radius:10px;background:#f9fafb;color:#374151;font-size:14px;font-weight:600;border:1px solid #e5e7eb;text-decoration:none;transition:all .2s}
.btn-cancel:hover{background:#f0f4ff}
</style>
@endpush

@section('content')
<div class="dw">

{{-- ═══════════════════════════ SIDEBAR (Syndic uniquement) ═══════════════════════════ --}}
<aside class="sb">
  <nav class="sb-nav">
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

{{-- ═══════════════════════════ MAIN ═══════════════════════════ --}}
<main class="mc">

  <div class="page-header">
    <a href="{{ route('syndic.votes.index') }}">← Retour</a>
    <h1>🗳️ Créer un nouveau vote</h1>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('syndic.votes.store') }}">
      @csrf

      {{-- Informations générales --}}
      <div class="form-section">
        <div class="form-section-title">Informations générales</div>

        <div class="form-group">
          <label class="form-label">Copropriété <span>*</span></label>
          <select name="copropriete_id"
                  class="form-control {{ $errors->has('copropriete_id') ? 'is-invalid' : '' }}">
            <option value="">— Sélectionner une copropriété —</option>
            @foreach($coproprietes as $copro)
              <option value="{{ $copro->id }}" {{ old('copropriete_id') == $copro->id ? 'selected' : '' }}>
                {{ $copro->nom }}
              </option>
            @endforeach
          </select>
          @error('copropriete_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Titre du vote <span>*</span></label>
          <input type="text" name="titre"
                 class="form-control {{ $errors->has('titre') ? 'is-invalid' : '' }}"
                 value="{{ old('titre') }}"
                 placeholder="Ex: Approbation du budget annuel 2025">
          @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"
                    placeholder="Décrivez l'objet du vote...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Date de clôture <span>*</span></label>
          <input type="datetime-local" name="date_fin"
                 class="form-control {{ $errors->has('date_fin') ? 'is-invalid' : '' }}"
                 value="{{ old('date_fin') }}"
                 min="{{ now()->format('Y-m-d\TH:i') }}">
          @error('date_fin')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <div class="form-hint">Le vote se fermera automatiquement à cette date.</div>
        </div>
      </div>

      {{-- Options de vote --}}
      <div class="form-section">
        <div class="form-section-title">Options de réponse</div>
        @error('options')
          <div class="invalid-feedback" style="margin-bottom:10px">{{ $message }}</div>
        @enderror

        <div class="options-list" id="options-list">
          @php $oldOptions = old('options', ['', '']); @endphp
          @foreach($oldOptions as $i => $opt)
            <div class="option-row" id="opt-{{ $i }}">
              <div class="option-num">{{ $i + 1 }}</div>
              <input type="text" name="options[]"
                     class="form-control {{ $errors->has('options.'.$i) ? 'is-invalid' : '' }}"
                     value="{{ $opt }}"
                     placeholder="Option {{ $i + 1 }}">
              @if($i >= 2)
                <button type="button" class="btn-remove-opt" onclick="removeOption(this)">×</button>
              @else
                <div style="width:32px"></div>
              @endif
            </div>
            @error('options.'.$i)
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          @endforeach
        </div>

        <button type="button" class="btn-add-opt" onclick="addOption()">+ Ajouter une option</button>
        <div class="form-hint">Minimum 2 options requises.</div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-primary">🗳️ Créer le vote</button>
        <a href="{{ route('syndic.votes.index') }}" class="btn-cancel">Annuler</a>
      </div>

    </form>
  </div>

</main>
</div>

<script>
let optCount = {{ count($oldOptions ?? ['','']) }};

function updateNumbers() {
  document.querySelectorAll('.option-row').forEach((row, i) => {
    row.querySelector('.option-num').textContent = i + 1;
    row.querySelector('input').placeholder = 'Option ' + (i + 1);
  });
}

function addOption() {
  optCount++;
  const list = document.getElementById('options-list');
  const div = document.createElement('div');
  div.className = 'option-row';
  div.id = 'opt-' + optCount;
  div.innerHTML = `
    <div class="option-num">${list.children.length + 1}</div>
    <input type="text" name="options[]" class="form-control" placeholder="Option ${list.children.length + 1}">
    <button type="button" class="btn-remove-opt" onclick="removeOption(this)">×</button>
  `;
  list.appendChild(div);
  div.querySelector('input').focus();
}

function removeOption(btn) {
  const row = btn.closest('.option-row');
  const list = document.getElementById('options-list');
  if (list.children.length <= 2) {
    alert('Il faut au minimum 2 options.');
    return;
  }
  row.remove();
  updateNumbers();
}
</script>
@endsection