@extends('layouts.app')
@section('title', 'Dashboard Syndic')
@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

.dw {
    display: grid;
    grid-template-columns: 220px 1fr;
    min-height: calc(100vh - 68px);
    background: #f0f4ff
}

.sb {
    background: #fff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    padding: 24px 0;
    position: sticky;
    top: 68px;
    height: calc(100vh - 68px)
}

.sb-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    margin-bottom: 16px;
    font-size: 16px;
    font-weight: 600;
    color: #006AD7
}

.sb-logo .ic {
    width: 34px;
    height: 34px;
    background: #006AD7;
    border-radius: 8px;
    display: grid;
    place-items: center;
    font-size: 15px;
    color: #fff
}

.sb-nav {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 0 12px
}

.sb-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    transition: all .2s
}

.sb-item:hover {
    background: #f0f4ff;
    color: #006AD7
}

.sb-item.active {
    background: #006AD7;
    color: #fff
}

.sb-bot {
    padding: 16px 12px 0;
    border-top: 1px solid #e5e7eb;
    margin-top: auto
}

.sb-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    background: #f0f4ff;
    margin-bottom: 8px
}

.sb-av {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #006AD7;
    color: #fff;
    display: grid;
    place-items: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0
}

.sb-uname {
    font-size: 13px;
    font-weight: 600;
    color: #111
}

.sb-urole {
    font-size: 11px;
    color: #6b7280
}

.sb-out {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    color: #ef4444;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    background: none;
    border: none;
    width: 100%;
    font-family: inherit;
    transition: background .2s
}

.sb-out:hover {
    background: #fef2f2
}

.mc {
    padding: 32px 36px
}

.mh {
    margin-bottom: 28px
}

.mh h1 {
    font-family: var(--font-serif);
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px
}

.mh p {
    font-size: 14px;
    color: #6b7280
}

.sl {
    font-size: 16px;
    font-weight: 600;
    color: #111;
    margin-bottom: 16px;
    margin-top: 28px
}

.kg {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
    margin-bottom: 8px
}

.kc {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: box-shadow .2s, transform .2s
}

.kc:hover {
    box-shadow: 0 4px 20px rgba(0, 106, 215, .1);
    transform: translateY(-2px)
}

.ki {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    font-size: 20px;
    flex-shrink: 0
}

.ki.b {
    background: #e6f2ff
}

.ki.g {
    background: #f0fdf4
}

.ki.o {
    background: #fffbeb
}

.ki.r {
    background: #fef2f2
}

.ki.p {
    background: #f5f3ff
}

.kn {
    font-family: var(--font-serif);
    font-size: 26px;
    font-weight: 700;
    color: #111;
    line-height: 1
}

.kl {
    font-size: 12px;
    color: #6b7280;
    margin-top: 3px
}

.cg {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px
}

.cg3 {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 16px
}

.dc {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
}

.dch {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px
}

.dct {
    font-size: 15px;
    font-weight: 600;
    color: #111
}

.dcl {
    font-size: 13px;
    color: #006AD7;
    text-decoration: none;
    font-weight: 500
}

.dcl:hover {
    text-decoration: underline
}

.dt {
    width: 100%;
    border-collapse: collapse
}

.dt th {
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .5px;
    text-transform: uppercase;
    color: #6b7280;
    padding: 8px 10px;
    border-bottom: 1px solid #e5e7eb
}

.dt td {
    padding: 11px 10px;
    font-size: 13px;
    color: #333;
    border-bottom: 1px solid #f5f5f5
}

.dt tr:last-child td {
    border-bottom: none
}

.b {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600
}

.bp {
    background: #f0fdf4;
    color: #16a34a
}

.be {
    background: #eff6ff;
    color: #2563eb
}

.br {
    background: #fef2f2;
    color: #dc2626
}

.bb {
    background: #f9fafb;
    color: #6b7280
}

.ba {
    background: #fffbeb;
    color: #d97706
}

.bn {
    background: #f0f4ff;
    color: #006AD7
}

.bu {
    background: #fef2f2;
    color: #dc2626
}

.bc {
    background: #fdf4ff;
    color: #9333ea
}

.pw {
    margin-bottom: 14px
}

.pl {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #444;
    margin-bottom: 6px
}

.pb {
    height: 8px;
    background: #e5e7eb;
    border-radius: 100px;
    overflow: hidden
}

.pf {
    height: 100%;
    border-radius: 100px;
    transition: width .5s
}

.pf.g {
    background: #22c55e
}

.pf.o {
    background: #f59e0b
}

.fa {
    font-family: var(--font-serif);
    font-size: 32px;
    font-weight: 700;
    color: #22c55e;
    text-align: center;
    padding: 12px 0 16px;
    line-height: 1
}

.fl {
    font-size: 13px;
    color: #6b7280;
    text-align: center;
    margin-bottom: 16px
}

.fi {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid #f5f5f5
}

.fi:last-child {
    border-bottom: none
}

.fav {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    background: #e6f2ff;
    display: grid;
    place-items: center;
    font-size: 17px;
    flex-shrink: 0
}

.fn {
    font-size: 13px;
    font-weight: 500;
    color: #111
}

.fc {
    font-size: 11px;
    color: #6b7280;
    margin-top: 1px
}

.st {
    color: #f59e0b;
    font-size: 11px
}
</style>
@endpush
@section('content')
<div class="dw">
    <aside class="sb">
        <nav class="sb-nav">
            <a href="{{ route('syndic.dashboard') }}" class="sb-item active">📊 Tableau de bord</a>
            <a href="#" class="sb-item">🏙️ Copropriétés</a>
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
        <div class="mh">
            <h1>Tableau de bord</h1>
            <p>Vue synthétique de la gestion en cours — {{ now()->translatedFormat('l d F Y') }}</p>
        </div>
        <p class="sl">Aperçu des statistiques</p>
        <div class="kg">
            <div class="kc">
                <div class="ki b">👥</div>
                <div>
                    <div class="kn">{{ $nb_residents }}</div>
                    <div class="kl">Résidents actifs</div>
                </div>
            </div>
            <div class="kc">
                <div class="ki o">📄</div>
                <div>
                    <div class="kn">{{ $nb_factures_attente }}</div>
                    <div class="kl">Factures en attente</div>
                </div>
            </div>
            <div class="kc">
                <div class="ki r">📢</div>
                <div>
                    <div class="kn">{{ $nb_reclamations }}</div>
                    <div class="kl">Réclamations</div>
                </div>
            </div>
            <div class="kc">
                <div class="ki g">💰</div>
                <div>
                    <div class="kn">{{ number_format($total_recouvre / 1000, 1) }}k</div>
                    <div class="kl">Recouvré (MAD)</div>
                </div>
            </div>
            <div class="kc">
                <div class="ki p">🔧</div>
                <div>
                    <div class="kn">{{ $nb_fournisseurs }}</div>
                    <div class="kl">Fournisseurs</div>
                </div>
            </div>
        </div>
        <p class="sl">Activité récente</p>
        <div class="cg">
            <div class="dc">
                <div class="dch"><span class="dct">📄 Dernières factures</span><a href="#" class="dcl">Voir tout →</a>
                </div>
                <table class="dt">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Résident</th>
                            <th>Total</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Facture::with('resident.user')->latest()->take(5)->get() as $f)
                        <tr>
                            <td><strong>{{ $f->numero }}</strong></td>
                            <td>{{ $f->resident->user->name ?? '—' }}</td>
                            <td>{{ number_format($f->total, 0) }} MAD</td>
                            <td>
                                @php $bl = [
                                'payee' => 'bp',
                                'envoyee' => 'be',
                                'retard' => 'br',
                                'brouillon' => 'bb',
                                'en_attente_confirmation' => 'ba'
                                ];
                                $ll = [
                                'payee' => '✓ Payée',
                                'envoyee' => '📤 Envoyée',
                                'retard' => '⚠ Retard',
                                'brouillon' => '📝 Brouillon',
                                'en_attente_confirmation' => '⏳ Confirm.'
                                ]; @endphp
                                <span class="b {{ $bl[$f->statut] ?? 'bb' }}">{{ $ll[$f->statut] ?? $f->statut }}</span>
                            </td>
                        </tr>
                        @empty<tr>
                            <td colspan="4" style="text-align:center;color:#6b7280;padding:16px">Aucune facture</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="dc">
                <div class="dch"><span class="dct">📢 Réclamations</span><a href="#" class="dcl">Voir tout →</a></div>
                <table class="dt">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Reclamation::where('statut', 'en_attente')->latest()->take(5)->get() as $r)
                        <tr>
                            <td>{{ Str::limit($r->titre, 22) }}</td>
                            <td><span
                                    class="b @if($r->priorite == 'urgente') bu @elseif($r->priorite == 'critique') bc @else bn @endif">{{ ucfirst($r->priorite) }}</span>
                            </td>
                            <td><span class="b ba">⏳ En attente</span></td>
                        </tr>
                        @empty<tr>
                            <td colspan="3" style="text-align:center;color:#6b7280;padding:16px">Aucune réclamation</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <p class="sl">Finances & Prestataires</p>
        <div class="cg3">
            <div class="dc">
                @php
                $tE = \App\Models\Facture::whereIn('statut', ['envoyee', 'retard'])->sum('total');
                $tP = \App\Models\Facture::where('statut', 'payee')->sum('total');
                $tA = $tE + $tP;
                $pct = $tA > 0 ? round(($tP / $tA) * 100) : 0;
                $pctA = $tA > 0 ? round(($tE / $tA) * 100) : 0;
                @endphp
                <div class="dch"><span class="dct">💰 Bilan financier</span></div>
                <div class="fa">{{ number_format($total_recouvre, 0, ',', ' ') }} MAD</div>
                <div class="fl">Total recouvré</div>
                <div class="pw">
                    <div class="pl"><span>Taux de recouvrement</span><span><strong>{{ $pct }}%</strong></span></div>
                    <div class="pb">
                        <div class="pf g" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
                <div class="pw">
                    <div class="pl"><span>En attente</span><span><strong>{{ number_format($tE, 0, ',', ' ') }}
                                MAD</strong></span></div>
                    <div class="pb">
                        <div class="pf o" style="width:{{ $pctA }}%"></div>
                    </div>
                </div>
            </div>
            <div class="dc">
                <div class="dch"><span class="dct">🔧 Fournisseurs</span><a href="#" class="dcl">Voir tout →</a></div>
                @forelse(\App\Models\Fournisseur::where('actif', true)->orderByDesc('note')->take(5)->get() as $f)
                <div class="fi">
                    <div class="fav">
                        @php $ic = [
                        'plomberie' => '🔧',
                        'electricite' => '⚡',
                        'nettoyage' => '🧹',
                        'securite' => '🔒',
                        'autre' => '🏢'
                        ]; @endphp{{ $ic[$f->categorie] ?? '🏢' }}
                    </div>
                    <div style="flex:1">
                        <div class="fn">{{ Str::limit($f->nom, 18) }}</div>
                        <div class="fc">{{ ucfirst($f->categorie) }}</div>
                    </div>
                    <div class="st">@for($i = 1; $i <= 5; $i++){{ $i <= $f->note ? '★' : '☆' }}@endfor</div>
                    </div>
                    @empty<p style="text-align:center;color:#6b7280;padding:20px;font-size:13px">Aucun fournisseur</p>
                    @endforelse
                </div>
            </div>
    </main>
</div>
@endsection