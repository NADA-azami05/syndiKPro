@extends('layouts.app')
@section('title', 'Réclamations')

@push('styles')
    <style>
        /* ── Variables ── */
        :root {
            --blue: #006AD7;
            --navy: #1e3a5f;
            --bg: #f5f7ff;
            --border: #e8ecf4;
            --text: #111827;
            --muted: #6b7280;
            --radius: 12px;
        }

        /* ── Layout ── */
        .rc-page {
            padding: 32px 40px;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* ── Header ── */
        .rc-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .rc-head-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
        }

        .rc-head-sub {
            font-size: 14px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* ── Filtres ── */
        .rc-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .rc-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid transparent;
            transition: all .2s;
            background: #fff;
            color: var(--muted);
            border-color: var(--border);
        }

        .rc-filter-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .rc-filter-btn.active {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .rc-filter-btn.active.warn {
            background: #d97706;
            border-color: #d97706;
        }

        .rc-filter-btn.active.info {
            background: #2563eb;
            border-color: #2563eb;
        }

        .rc-filter-btn.active.ok {
            background: #16a34a;
            border-color: #16a34a;
        }

        .rc-filter-btn.active.dark {
            background: #374151;
            border-color: #374151;
        }

        .rc-badge-count {
            background: rgba(255, 255, 255, .25);
            padding: 1px 7px;
            border-radius: 20px;
            font-size: 11px;
        }

        .rc-filter-btn:not(.active) .rc-badge-count {
            background: var(--bg);
            color: var(--muted);
        }

        /* ── Table card ── */
        .rc-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
        }

        /* ── Table ── */
        .rc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rc-table thead tr {
            background: #f8fafd;
        }

        .rc-table thead th {
            padding: 13px 16px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .rc-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .rc-table tbody tr:last-child {
            border-bottom: none;
        }

        .rc-table tbody tr:hover {
            background: #f8fafd;
        }

        .rc-table td {
            padding: 14px 16px;
            vertical-align: middle;
        }

        /* ── Réf ── */
        .rc-ref {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            font-family: monospace;
            white-space: nowrap;
        }

        /* ── Résident ── */
        .rc-resident-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .rc-resident-email {
            font-size: 12px;
            color: var(--muted);
            margin-top: 1px;
        }

        /* ── Lot ── */
        .rc-lot-num {
            display: inline-block;
            padding: 3px 10px;
            background: #f0f4ff;
            color: var(--blue);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .rc-lot-type {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        /* ── Copropriété ── */
        .rc-copro {
            font-size: 13px;
            color: var(--text);
        }

        /* ── Titre réclamation ── */
        .rc-titre {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 2px;
        }

        .rc-desc {
            font-size: 12px;
            color: var(--muted);
        }

        /* ── Priorité ── */
        .prio-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .prio-normale {
            background: #f0f4ff;
            color: #3b5bdb;
        }

        .prio-urgente {
            background: #fff7ed;
            color: #d97706;
        }

        .prio-critique {
            background: #fef2f2;
            color: #dc2626;
        }

        /* ── Statut ── */
        .statut-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .s-en_attente {
            background: #fff7ed;
            color: #d97706;
        }

        .s-en_cours {
            background: #eff6ff;
            color: #2563eb;
        }

        .s-resolu {
            background: #f0fdf4;
            color: #16a34a;
        }

        .s-ferme {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ── Date ── */
        .rc-date {
            font-size: 12px;
            color: var(--muted);
            white-space: nowrap;
        }

        /* ── Action ── */
        .btn-traiter {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--blue);
            color: #fff;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-traiter:hover {
            background: #0055b3;
            color: #fff;
        }

        /* ── Vide ── */
        .rc-empty {
            text-align: center;
            padding: 80px 24px;
            color: var(--muted);
        }

        .rc-empty-ico {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .rc-empty-txt {
            font-size: 15px;
            font-weight: 500;
        }

        /* ── Pagination ── */
        .rc-pagination {
            margin-top: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="rc-page">

        {{-- En-tête --}}
        <div class="rc-head">
            <div>
                <div class="rc-head-title">💬 Réclamations</div>
                <div class="rc-head-sub">Gérez et traitez toutes les réclamations des résidents.</div>
            </div>
        </div>

        {{-- Filtres rapides avec compteurs --}}
        <div class="rc-filters">
            <a href="{{ url()->current() }}" class="rc-filter-btn {{ !request('statut') ? 'active' : '' }}">
                Toutes
                <span class="rc-badge-count">{{ $counts['total'] }}</span>
            </a>
            <a href="?statut=en_attente"
                class="rc-filter-btn warn {{ request('statut') === 'en_attente' ? 'active warn' : '' }}">
                ⏳ En attente
                <span class="rc-badge-count">{{ $counts['en_attente'] }}</span>
            </a>
            <a href="?statut=en_cours"
                class="rc-filter-btn info {{ request('statut') === 'en_cours' ? 'active info' : '' }}">
                🔧 En cours
                <span class="rc-badge-count">{{ $counts['en_cours'] }}</span>
            </a>
            <a href="?statut=resolu" class="rc-filter-btn ok {{ request('statut') === 'resolu' ? 'active ok' : '' }}">
                ✅ Résolues
                <span class="rc-badge-count">{{ $counts['resolu'] }}</span>
            </a>
            <a href="?statut=ferme" class="rc-filter-btn dark {{ request('statut') === 'ferme' ? 'active dark' : '' }}">
                🔒 Fermées
                <span class="rc-badge-count">{{ $counts['ferme'] }}</span>
            </a>
        </div>

        {{-- Tableau --}}
        <div class="rc-card">
            <table class="rc-table">
                <thead>
                    <tr>
                        <th>Réf.</th>
                        <th>Résident</th>
                        <th>Lot</th>
                        <th>Copropriété</th>
                        <th>Réclamation</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reclamations as $r)
                        <tr>
                            {{-- Référence --}}
                            <td>
                                <span class="rc-ref">#RC-{{ str_pad($r->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            {{-- Résident --}}
                            <td>
                                <div class="rc-resident-name">{{ $r->resident->user->name }}</div>
                                <div class="rc-resident-email">{{ $r->resident->user->email }}</div>
                                @if($r->resident->telephone)
                                    <div class="rc-resident-email">📞 {{ $r->resident->telephone }}</div>
                                @endif
                            </td>

                            {{-- Lot --}}
                            <td>
                                <span class="rc-lot-num">{{ $r->resident->lot->numero }}</span>
                                <div class="rc-lot-type">
                                    {{ ucfirst($r->resident->lot->type) }}
                                    @if($r->resident->lot->surface)
                                        · {{ $r->resident->lot->surface }} m²
                                    @endif
                                </div>
                            </td>

                            {{-- Copropriété --}}
                            <td>
                                <div class="rc-copro">{{ $r->resident->lot->copropriete->nom }}</div>
                            </td>

                            {{-- Titre + description --}}
                            <td>
                                <div class="rc-titre">{{ $r->titre }}</div>
                                <div class="rc-desc">{{ Str::limit($r->description, 60) }}</div>
                            </td>

                            {{-- Priorité --}}
                            <td>
                                @php
                                    $prioIco = ['normale' => '🟢', 'urgente' => '🟡', 'critique' => '🔴'];
                                @endphp
                                <span class="prio-badge prio-{{ $r->priorite }}">
                                    {{ $prioIco[$r->priorite] ?? '' }}
                                    {{ ucfirst($r->priorite) }}
                                </span>
                            </td>

                            {{-- Statut --}}
                            <td>
                                @php
                                    $statutLabels = [
                                        'en_attente' => 'En attente',
                                        'en_cours' => 'En cours',
                                        'resolu' => 'Résolue',
                                        'ferme' => 'Fermée',
                                    ];
                                @endphp
                                <span class="statut-badge s-{{ $r->statut }}">
                                    {{ $statutLabels[$r->statut] ?? ucfirst($r->statut) }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td>
                                <div class="rc-date">{{ $r->created_at->format('d/m/Y') }}</div>
                                <div class="rc-date">{{ $r->created_at->format('H:i') }}</div>
                            </td>

                            {{-- Action --}}
                            <td>
                                <a href="{{ route('syndic.reclamations.show', $r) }}" class="btn-traiter">
                                    👁 Traiter
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="rc-empty">
                                    <div class="rc-empty-ico">✅</div>
                                    <div class="rc-empty-txt">Aucune réclamation
                                        {{ request('statut') ? 'dans cette catégorie' : 'pour le moment' }}.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="rc-pagination">
            {{ $reclamations->links() }}
        </div>

    </div>
@endsection