@extends('Layouts.App')
@section('title', 'Factures')

@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin: 0;
}

.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #006AD7;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background .2s, transform .15s;
    white-space: nowrap;
}

.btn-add:hover {
    background: #0055b3;
    color: #fff;
    transform: translateY(-1px);
}

.filters {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 7px 18px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 500;
    border: 1px solid #e5e7eb;
    background: #fff;
    color: #6b7280;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s;
}

.filter-btn:hover {
    background: #f0f4ff;
    color: #006AD7;
    border-color: #006AD7;
}

.filter-btn.active {
    background: #006AD7;
    color: #fff;
    border-color: #006AD7;
}

.filter-btn.f-payee.active {
    background: #059669;
    border-color: #059669;
}

.filter-btn.f-retard.active {
    background: #dc2626;
    border-color: #dc2626;
}

.filter-btn.f-brouillon.active {
    background: #6b7280;
    border-color: #6b7280;
}

.table-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid rgba(0, 106, 215, .09);
    box-shadow: 0 2px 16px rgba(0, 106, 215, .06);
    overflow: hidden;
}

.table-header {
    padding: 18px 24px;
    border-bottom: 1px solid rgba(0, 106, 215, .09);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8faff;
}

.table-title {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 600;
    color: #006AD7;
    margin: 0;
}

.table-pro {
    width: 100%;
    border-collapse: collapse;
}

.table-pro th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #6b7280;
    font-weight: 600;
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 106, 215, .09);
    text-align: left;
    background: #fafbff;
}

.table-pro td {
    font-size: 13px;
    color: #111;
    padding: 12px 16px;
    border-bottom: 1px solid #f0f4ff;
    vertical-align: middle;
}

.table-pro tr:last-child td {
    border-bottom: none;
}

.table-pro tr:hover td {
    background: #f8faff;
}

.badge-statut {
    font-size: 10px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 100px;
    white-space: nowrap;
    display: inline-block;
}

.s-payee {
    background: #d1fae5;
    color: #059669;
}

.s-envoyee {
    background: #dbeafe;
    color: #1d4ed8;
}

.s-retard {
    background: #fee2e2;
    color: #dc2626;
}

.s-brouillon {
    background: #f3f4f6;
    color: #6b7280;
}

.s-attente {
    background: #fef3c7;
    color: #d97706;
}

.actions-cell {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: nowrap;
}

.btn-action {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all .2s;
    white-space: nowrap;
    line-height: 1.4;
}

.btn-voir {
    background: #006AD7;
    color: #fff;
    border-color: #006AD7;
}

.btn-voir:hover {
    background: #0055b3;
    color: #fff;
}

.btn-pdf {
    background: #fff;
    color: #dc2626;
    border-color: #dc2626;
}

.btn-pdf:hover {
    background: #dc2626;
    color: #fff;
}

.resident-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.resident-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #006AD7;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    flex-shrink: 0;
}

.num-facture {
    font-weight: 700;
    color: #006AD7;
}

/* ── Pagination compacte ── */
.pagination-wrap {
    padding: 12px 24px;
    border-top: 1px solid rgba(0, 106, 215, .09);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}

.pg-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 30px;
    padding: 0 8px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #e5e7eb;
    color: #6b7280;
    background: #fff;
    transition: all .2s;
}

.pg-btn:hover {
    background: #f0f4ff;
    color: #006AD7;
    border-color: #006AD7;
}

.pg-btn.active {
    background: #006AD7;
    color: #fff;
    border-color: #006AD7;
}

.pg-btn.disabled {
    opacity: .35;
    pointer-events: none;
}
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>🧾 Factures</h1>
        <p style="font-size:13px;color:#6b7280;margin:4px 0 0;">{{ $factures->total() }} facture(s) au total</p>
    </div>
    <a href="{{ route('syndic.factures.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Nouvelle facture
    </a>
</div>

{{-- Filtres --}}
<div class="filters">
    <a href="{{ route('syndic.factures.index') }}"
        class="filter-btn {{ !request('statut') ? 'active' : '' }}">Toutes</a>
    <a href="{{ route('syndic.factures.index', ['statut' => 'envoyee']) }}"
        class="filter-btn {{ request('statut') === 'envoyee' ? 'active' : '' }}">Envoyées</a>
    <a href="{{ route('syndic.factures.index', ['statut' => 'payee']) }}"
        class="filter-btn f-payee {{ request('statut') === 'payee' ? 'active' : '' }}">Payées</a>
    <a href="{{ route('syndic.factures.index', ['statut' => 'retard']) }}"
        class="filter-btn f-retard {{ request('statut') === 'retard' ? 'active' : '' }}">En retard</a>
    <a href="{{ route('syndic.factures.index', ['statut' => 'brouillon']) }}"
        class="filter-btn f-brouillon {{ request('statut') === 'brouillon' ? 'active' : '' }}">Brouillons</a>
</div>

<div class="table-card">
    <div class="table-header">
        <h5 class="table-title">Liste des factures</h5>
        <span style="font-size:12px;color:#6b7280;">
            Page {{ $factures->currentPage() }} / {{ $factures->lastPage() }}
        </span>
    </div>

    @if($factures->count() > 0)
    <table class="table-pro">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Résident</th>
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
                <td><span class="num-facture">{{ $f->numero }}</span></td>
                <td>
                    <div class="resident-info">
                        <div class="resident-avatar">
                            {{ strtoupper(substr($f->resident->user->name ?? 'R', 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:500;">{{ $f->resident->user->name ?? '—' }}</div>
                            <div style="font-size:11px;color:#6b7280;">Lot {{ $f->resident->lot->numero ?? '—' }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $f->mois }}</td>
                <td style="font-weight:600;">{{ number_format($f->total, 2) }} MAD</td>
                <td>
                    <span
                        style="font-size:12px;{{ $f->echeance < now() && $f->statut !== 'payee' ? 'color:#dc2626;font-weight:600;' : 'color:#6b7280;' }}">
                        {{ \Carbon\Carbon::parse($f->echeance)->format('d/m/Y') }}
                    </span>
                </td>
                <td>
                    @php
                    $sc = match ($f->statut) {
                    'payee' => 's-payee',
                    'retard' => 's-retard',
                    'brouillon' => 's-brouillon',
                    'en_attente_confirmation' => 's-attente',
                    default => 's-envoyee',
                    };
                    $sl = match ($f->statut) {
                    'payee' => '✓ Payée',
                    'retard' => '⚠ Retard',
                    'brouillon' => '📝 Brouillon',
                    'en_attente_confirmation' => '⏳ Confirmation',
                    default => '📤 Envoyée',
                    };
                    @endphp
                    <span class="badge-statut {{ $sc }}">{{ $sl }}</span>
                </td>
                <td>
                    <div class="actions-cell">
                        <a href="{{ route('syndic.factures.show', $f) }}" class="btn-action btn-voir">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        <a href="{{ route('syndic.factures.pdf', $f) }}" class="btn-action btn-pdf">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination compacte --}}
    @if($factures->hasPages())
    <div class="pagination-wrap">
        {{-- Précédent --}}
        @if($factures->onFirstPage())
        <span class="pg-btn disabled">‹</span>
        @else
        <a href="{{ $factures->previousPageUrl() }}" class="pg-btn">‹</a>
        @endif

        {{-- Numéros de pages --}}
        @foreach(range(1, $factures->lastPage()) as $p)
        @if($p == $factures->currentPage())
        <span class="pg-btn active">{{ $p }}</span>
        @else
        <a href="{{ $factures->url($p) }}" class="pg-btn">{{ $p }}</a>
        @endif
        @endforeach

        {{-- Suivant --}}
        @if($factures->hasMorePages())
        <a href="{{ $factures->nextPageUrl() }}" class="pg-btn">›</a>
        @else
        <span class="pg-btn disabled">›</span>
        @endif
    </div>
    @endif

    @else
    <div style="text-align:center;padding:60px 20px;">
        <i class="fas fa-file-invoice" style="font-size:48px;color:#dbeafe;display:block;margin-bottom:16px;"></i>
        <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#111;margin-bottom:8px;">Aucune facture
        </h3>
        <p style="font-size:13px;color:#6b7280;margin-bottom:20px;">
            {{ request('statut') ? 'Aucune facture avec ce statut.' : 'Créez votre première facture.' }}
        </p>
        @if(!request('statut'))
        <a href="{{ route('syndic.factures.create') }}" class="btn-add" style="margin:0 auto;">
            <i class="fas fa-plus"></i> Créer une facture
        </a>
        @endif
    </div>
    @endif
</div>

@endsection