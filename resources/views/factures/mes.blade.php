@extends('layouts.app')
@section('title', 'Mes Factures')
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

        .sb-item.disabled {
            opacity: .4;
            cursor: not-allowed;
            pointer-events: none
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

        .badge-soon {
            font-size: 9px;
            background: #f0f4ff;
            color: #006AD7;
            padding: 1px 6px;
            border-radius: 20px;
            margin-left: auto;
            font-weight: 600
        }

        .mc {
            padding: 32px 36px
        }

        .mh {
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .kg {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px
        }

        .kc {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px 18px;
            display: flex;
            align-items: center;
            gap: 14px
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

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
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
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb
        }

        .dt td {
            padding: 14px 12px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
            vertical-align: middle
        }

        .dt tr:last-child td {
            border-bottom: none
        }

        .dt tr:hover td {
            background: #f9fafb
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600
        }

        .badge-payee {
            background: #f0fdf4;
            color: #16a34a
        }

        .badge-envoyee {
            background: #eff6ff;
            color: #2563eb
        }

        .badge-retard {
            background: #fef2f2;
            color: #dc2626
        }

        .badge-brouillon {
            background: #f9fafb;
            color: #6b7280
        }

        .badge-attente {
            background: #fffbeb;
            color: #d97706
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s
        }

        .btn-pay {
            background: #006AD7;
            color: #fff
        }

        .btn-pay:hover {
            background: #0057b3
        }

        .btn-pdf {
            background: #f0f4ff;
            color: #006AD7
        }

        .btn-pdf:hover {
            background: #dbeafe
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 16px
        }

        .pag {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 20px
        }

        .pag a,
        .pag span {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            border: 1px solid #e5e7eb;
            color: #374151;
            text-decoration: none
        }

        .pag .active-p {
            background: #006AD7;
            color: #fff;
            border-color: #006AD7
        }
    </style>
@endpush
@section('content')
    <div class="dw">

        {{-- SIDEBAR --}}
        <aside class="sb">
            <div class="sb-logo">
                <div class="ic">🏢</div>SyndicPro
            </div>
            <nav class="sb-nav">
                <a href="{{ route('resident.dashboard') }}"
                    class="sb-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">
                    🏠 Mon espace
                </a>
                <a href="{{ route('resident.factures.mes') }}"
                    class="sb-item {{ request()->routeIs('resident.factures*') ? 'active' : '' }}">
                    📄 Mes factures
                </a>
                <span class="sb-item disabled">📢 Mes réclamations <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">🗳️ Votes <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📣 Annonces <span class="badge-soon">bientôt</span></span>
                <span class="sb-item disabled">📅 Réunions <span class="badge-soon">bientôt</span></span>
            </nav>
            <div class="sb-bot">
                <div class="sb-user">
                    <div class="sb-av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="sb-uname">{{ Str::limit(auth()->user()->name, 14) }}</div>
                        <div class="sb-urole">Résident</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="sb-out">🚪 Déconnexion</button>
                </form>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="mc">

            <div class="mh">
                <div>
                    <h1>📄 Mes Factures</h1>
                    <p>Historique complet de vos factures et paiements</p>
                </div>
            </div>

            @if(session('success'))
                <div
                    style="background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Stats --}}
            <div class="kg">
                <div class="kc">
                    <div class="ki b">📄</div>
                    <div>
                        <div class="kn">{{ $factures->total() }}</div>
                        <div class="kl">Total factures</div>
                    </div>
                </div>
                <div class="kc">
                    <div class="ki g">✅</div>
                    <div>
                        <div class="kn">{{ $factures->getCollection()->where('statut', 'payee')->count() }}</div>
                        <div class="kl">Payées</div>
                    </div>
                </div>
                <div class="kc">
                    <div class="ki o">⏳</div>
                    <div>
                        <div class="kn">{{ $factures->getCollection()->where('statut', 'envoyee')->count() }}</div>
                        <div class="kl">En attente</div>
                    </div>
                </div>
                <div class="kc">
                    <div class="ki r">⚠️</div>
                    <div>
                        <div class="kn">{{ $factures->getCollection()->where('statut', 'retard')->count() }}</div>
                        <div class="kl">En retard</div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card">
                @if($factures->count())
                    <table class="dt">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Mois</th>
                                <th>Total</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $f)
                                <tr>
                                    <td><strong>{{ $f->numero }}</strong></td>
                                    <td>{{ $f->mois }}</td>
                                    <td><strong>{{ number_format($f->total, 0) }} MAD</strong></td>
                                    <td>
                                        @php $ech = \Carbon\Carbon::parse($f->echeance); @endphp
                                        <span @if($ech->isPast() && $f->statut !== 'payee') style="color:#dc2626;font-weight:600"
                                        @endif>
                                            {{ $ech->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $bl = [
                                                'payee' => 'badge-payee',
                                                'envoyee' => 'badge-envoyee',
                                                'retard' => 'badge-retard',
                                                'brouillon' => 'badge-brouillon',
                                                'en_attente_confirmation' => 'badge-attente'
                                            ];
                                            $ll = [
                                                'payee' => '✓ Payée',
                                                'envoyee' => '📤 Envoyée',
                                                'retard' => '⚠ Retard',
                                                'brouillon'
                                                => '📝 Brouillon',
                                                'en_attente_confirmation' => '⏳ Confirmation'
                                            ];
                                        @endphp
                                        <span class="badge {{ $bl[$f->statut] ?? 'badge-brouillon' }}">
                                            {{ $ll[$f->statut] ?? $f->statut }}
                                        </span>
                                    </td>
                                    <td style="display:flex;gap:6px;align-items:center">

                                        {{-- Bouton Payer — seulement si pas encore payée --}}
                                        @if(!in_array($f->statut, ['payee', 'brouillon']))
                                            <a href="{{ route('resident.factures.paiement', $f) }}" class="btn btn-pay">
                                                💳 Payer
                                            </a>
                                        @endif

                                        {{-- ✅ PDF — route resident (corrigé) --}}
                                        <a href="{{ route('resident.factures.pdf', $f) }}" class="btn btn-pdf" target="_blank">
                                            📥 PDF
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if($factures->hasPages())
                        <div class="pag">{{ $factures->links() }}</div>
                    @endif

                @else
                    <div class="empty">
                        <div class="empty-icon">📄</div>
                        <p style="font-size:16px;font-weight:600;color:#111;margin-bottom:8px">Aucune facture</p>
                        <p style="font-size:14px">Vous n'avez pas encore de factures.</p>
                    </div>
                @endif
            </div>

        </main>
    </div>
@endsection