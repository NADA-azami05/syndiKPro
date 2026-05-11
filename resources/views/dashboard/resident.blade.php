@extends('layouts.app')
@section('title', 'Mon Espace')
@push('styles')
<style>
*{margin:0;padding:0;box-sizing:border-box}
.dw{display:grid;grid-template-columns:220px 1fr;min-height:calc(100vh - 68px);background:#f0f4ff}
.sb{background:#fff;border-right:1px solid #e5e7eb;display:flex;flex-direction:column;padding:24px 0;position:sticky;top:68px;height:calc(100vh - 68px)}
.sb-logo{display:flex;align-items:center;gap:10px;padding:0 20px 24px;border-bottom:1px solid #e5e7eb;margin-bottom:16px;font-size:16px;font-weight:600;color:#006AD7}
.sb-logo .ic{width:34px;height:34px;background:#006AD7;border-radius:8px;display:grid;place-items:center;font-size:15px;color:#fff}
.sb-nav{flex:1;display:flex;flex-direction:column;gap:4px;padding:0 12px}
.sb-item{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:10px;text-decoration:none;font-size:14px;font-weight:500;color:#6b7280;transition:all .2s}
.sb-item:hover{background:#f0f4ff;color:#006AD7}
.sb-item.active{background:#006AD7;color:#fff}
.sb-bot{padding:16px 12px 0;border-top:1px solid #e5e7eb;margin-top:auto}
.sb-user{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;background:#f0f4ff;margin-bottom:8px}
.sb-av{width:34px;height:34px;border-radius:50%;background:#006AD7;color:#fff;display:grid;place-items:center;font-size:13px;font-weight:700;flex-shrink:0}
.sb-uname{font-size:13px;font-weight:600;color:#111}
.sb-urole{font-size:11px;color:#6b7280}
.sb-out{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;color:#ef4444;font-size:13px;font-weight:500;cursor:pointer;background:none;border:none;width:100%;font-family:inherit;transition:background .2s}
.sb-out:hover{background:#fef2f2}
.mc{padding:32px 36px}
.mh{margin-bottom:28px}
.mh h1{font-family:var(--font-serif);font-size:24px;font-weight:700;color:#111;margin-bottom:4px}
.mh p{font-size:14px;color:#6b7280}
.sl{font-size:16px;font-weight:600;color:#111;margin-bottom:16px;margin-top:28px}
.kg{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:8px}
.kc{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px 18px;display:flex;align-items:center;gap:14px}
.ki{width:46px;height:46px;border-radius:12px;display:grid;place-items:center;font-size:20px;flex-shrink:0}
.ki.b{background:#e6f2ff}.ki.g{background:#f0fdf4}.ki.o{background:#fffbeb}
.kn{font-family:var(--font-serif);font-size:26px;font-weight:700;color:#111;line-height:1}
.kl{font-size:12px;color:#6b7280;margin-top:3px}
.pb{background:linear-gradient(135deg,#21277B,#006AD7);border-radius:14px;padding:24px;color:#fff;display:flex;align-items:center;gap:20px;margin-bottom:8px}
.pa{width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,.2);display:grid;place-items:center;font-family:var(--font-serif);font-size:24px;font-weight:700;color:#fff;flex-shrink:0;border:3px solid rgba(255,255,255,.3)}
.pn{font-family:var(--font-serif);font-size:19px;font-weight:700}
.pe{font-size:13px;color:rgba(255,255,255,.7);margin-top:4px}
.pbs{display:flex;gap:8px;margin-top:10px;flex-wrap:wrap}
.pba{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:100px;padding:3px 12px;font-size:12px}
.g2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.dc{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:22px;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-bottom:16px}
.dc:last-child{margin-bottom:0}
.dch{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.dct{font-size:15px;font-weight:600;color:#111}
.dcl{font-size:13px;color:#006AD7;text-decoration:none;font-weight:500}
.ir{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid #f5f5f5}
.ir:last-child{border-bottom:none}
.ii{width:34px;height:34px;background:#e6f2ff;border-radius:8px;display:grid;place-items:center;font-size:14px;flex-shrink:0;margin-top:2px}
.il{font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;font-weight:600;margin-bottom:2px}
.iv{font-size:14px;color:#111;font-weight:500}
.lh{display:flex;align-items:center;gap:14px;background:#f0f4ff;border-radius:10px;padding:16px;margin-bottom:16px}
.ln{font-family:var(--font-serif);font-size:18px;font-weight:700;color:#006AD7}
.ls{font-size:12px;color:#6b7280;margin-top:2px}
.dt{width:100%;border-collapse:collapse}
.dt th{text-align:left;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:#6b7280;padding:8px 10px;border-bottom:1px solid #e5e7eb}
.dt td{padding:11px 10px;font-size:13px;color:#333;border-bottom:1px solid #f5f5f5}
.dt tr:last-child td{border-bottom:none}
.b{display:inline-flex;align-items:center;padding:3px 9px;border-radius:100px;font-size:11px;font-weight:600}
.bp{background:#f0fdf4;color:#16a34a}.be{background:#eff6ff;color:#2563eb}.br{background:#fef2f2;color:#dc2626}.bb{background:#f9fafb;color:#6b7280}.ba{background:#fffbeb;color:#d97706}.bec{background:#eff6ff;color:#2563eb}.bs{background:#f0fdf4;color:#16a34a}.bn{background:#f0f4ff;color:#006AD7}.bu{background:#fef2f2;color:#dc2626}
.es{text-align:center;padding:24px;color:#6b7280;font-size:14px}
</style>
@endpush
@section('content')
<div class="dw">
<aside class="sb">
  <div class="sb-logo"><div class="ic">🏢</div>SyndicPro</div>
  <nav class="sb-nav">
    <a href="{{ route('resident.dashboard') }}" class="sb-item active">🏠 Mon espace</a>
    <a href="#" class="sb-item">📄 Mes factures</a>
    <a href="#" class="sb-item">📢 Mes réclamations</a>
   <a href="{{ route('resident.votes.index') }}"
   class="sb-item {{ request()->routeIs('resident.votes*') ? 'active' : '' }}">
   🗳️ Votes
</a>
    <a href="#" class="sb-item">📣 Annonces</a>
    <a href="#" class="sb-item">📅 Réunions</a>
  </nav>
  <div class="sb-bot">
    <div class="sb-user">
      <div class="sb-av">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
      <div><div class="sb-uname">{{ Str::limit(auth()->user()->name,14) }}</div><div class="sb-urole">Résident</div></div>
    </div>
    <form action="{{ route('logout') }}" method="POST">@csrf
      <button type="submit" class="sb-out">🚪 Déconnexion</button>
    </form>
  </div>
</aside>
<main class="mc">
  <div class="mh">
    <h1>Mon Espace</h1>
    <p>Bienvenue, {{ auth()->user()->name }} — {{ now()->translatedFormat('l d F Y') }}</p>
  </div>
  @if(!$resident)
  <div class="dc" style="text-align:center;padding:60px">
    <div style="font-size:48px;margin-bottom:16px">🏠</div>
    <h2 style="font-family:var(--font-serif);font-size:20px;color:#111;margin-bottom:10px">Profil non configuré</h2>
    <p style="color:#6b7280;font-size:14px">Contactez votre syndic pour activer votre espace.</p>
  </div>
  @else
  {{-- Bannière profil --}}
  <div class="pb">
    <div class="pa">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
    <div>
      <div class="pn">{{ auth()->user()->name }}</div>
      <div class="pe">{{ auth()->user()->email }}</div>
      <div class="pbs">
        <span class="pba">{{ $resident->type==='proprietaire'?'🏠 Propriétaire':'🔑 Locataire' }}</span>
        <span class="pba">{{ $resident->statut==='actif'?'✅ Actif':'⏸ Inactif' }}</span>
        @if($resident->lot)<span class="pba">📍 Lot {{ $resident->lot->numero }}</span>@endif
      </div>
    </div>
  </div>
  {{-- KPIs --}}
  <p class="sl">Aperçu des statistiques</p>
  <div class="kg">
    <div class="kc"><div class="ki b">📄</div><div><div class="kn">{{ $factures->count() }}</div><div class="kl">Factures récentes</div></div></div>
    <div class="kc"><div class="ki g">✅</div><div><div class="kn">{{ $factures->where('statut','payee')->count() }}</div><div class="kl">Factures payées</div></div></div>
    <div class="kc"><div class="ki o">📢</div><div><div class="kn">{{ $reclamations->count() }}</div><div class="kl">Réclamations</div></div></div>
  </div>
  {{-- Profil + Lot --}}
  <p class="sl">Informations personnelles & Lot</p>
  <div class="g2">
    <div class="dc">
      <div class="dch"><span class="dct">👤 Mon profil</span></div>
      <div class="ir"><div class="ii">👤</div><div><div class="il">Nom complet</div><div class="iv">{{ auth()->user()->name }}</div></div></div>
      <div class="ir"><div class="ii">📧</div><div><div class="il">Email</div><div class="iv">{{ auth()->user()->email }}</div></div></div>
      <div class="ir"><div class="ii">📞</div><div><div class="il">Téléphone</div><div class="iv">{{ $resident->telephone ?? 'Non renseigné' }}</div></div></div>
      <div class="ir"><div class="ii">🏠</div><div><div class="il">Type</div><div class="iv">{{ ucfirst($resident->type) }}</div></div></div>
      <div class="ir"><div class="ii">📅</div><div><div class="il">Membre depuis</div><div class="iv">{{ $resident->created_at->format('d/m/Y') }}</div></div></div>
    </div>
    <div class="dc">
      <div class="dch"><span class="dct">🏢 Mon lot</span></div>
      @if($resident->lot)
      <div class="lh">
        <div style="font-size:28px">🏠</div>
        <div><div class="ln">Lot {{ $resident->lot->numero }}</div><div class="ls">{{ ucfirst($resident->lot->type) }}</div></div>
      </div>
      <div class="ir"><div class="ii">📐</div><div><div class="il">Surface</div><div class="iv">{{ $resident->lot->surface }} m²</div></div></div>
      <div class="ir"><div class="ii">📊</div><div><div class="il">Quote-part</div><div class="iv">{{ $resident->lot->quote_part }} %</div></div></div>
      @if($resident->lot->copropriete)
      <div class="ir"><div class="ii">🏙️</div><div><div class="il">Résidence</div><div class="iv">{{ $resident->lot->copropriete->nom }}</div></div></div>
      <div class="ir"><div class="ii">📍</div><div><div class="il">Adresse</div><div class="iv">{{ $resident->lot->copropriete->adresse }}, {{ $resident->lot->copropriete->ville }}</div></div></div>
      @endif
      @else
      <div class="es">🏠<br>Aucun lot associé.</div>
      @endif
    </div>
  </div>
  {{-- Factures --}}
  <p class="sl">Mes factures récentes</p>
  <div class="dc">
    <div class="dch"><span class="dct">📄 5 dernières factures</span><a href="#" class="dcl">Voir toutes →</a></div>
    @if($factures->count())
    <table class="dt">
      <thead><tr><th>Numéro</th><th>Mois</th><th>Total</th><th>Échéance</th><th>Statut</th></tr></thead>
      <tbody>
        @foreach($factures as $f)
        <tr>
          <td><strong>{{ $f->numero }}</strong></td>
          <td>{{ $f->mois }}</td>
          <td><strong>{{ number_format($f->total,0) }} MAD</strong></td>
          <td>{{ \Carbon\Carbon::parse($f->echeance)->format('d/m/Y') }}</td>
          <td>@php $bl=['payee'=>'bp','envoyee'=>'be','retard'=>'br','en_attente_confirmation'=>'ba','brouillon'=>'bb'];$ll=['payee'=>'✓ Payée','envoyee'=>'📤 Envoyée','retard'=>'⚠ Retard','en_attente_confirmation'=>'⏳ Confirm.','brouillon'=>'📝 Brouillon'];@endphp<span class="b {{ $bl[$f->statut]??'bb' }}">{{ $ll[$f->statut]??$f->statut }}</span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else<div class="es">📄<br>Aucune facture pour l'instant.</div>@endif
  </div>
  {{-- Réclamations --}}
  <p class="sl">Mes réclamations récentes</p>
  <div class="dc">
    <div class="dch"><span class="dct">📢 3 dernières réclamations</span><a href="#" class="dcl">Voir toutes →</a></div>
    @if($reclamations->count())
    <table class="dt">
      <thead><tr><th>Titre</th><th>Priorité</th><th>Statut</th><th>Date</th></tr></thead>
      <tbody>
        @foreach($reclamations as $r)
        <tr>
          <td>{{ Str::limit($r->titre,35) }}</td>
          <td><span class="b @if($r->priorite=='urgente') bu @elseif($r->priorite=='critique') b @else bn @endif">{{ ucfirst($r->priorite) }}</span></td>
          <td>@php $sb=['en_attente'=>'ba','en_cours'=>'bec','resolu'=>'bs','ferme'=>'bb'];$sl=['en_attente'=>'⏳ En attente','en_cours'=>'🔄 En cours','resolu'=>'✓ Résolu','ferme'=>'🔒 Fermé'];@endphp<span class="b {{ $sb[$r->statut]??'ba' }}">{{ $sl[$r->statut]??$r->statut }}</span></td>
          <td>{{ $r->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else<div class="es">📢<br>Aucune réclamation pour l'instant.</div>@endif
  </div>
  @endif
</main>
</div>
@endsection