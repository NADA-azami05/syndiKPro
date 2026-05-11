<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 13px;
        color: #333;
        background: #fff;
    }

    /* Header */
    .header {
        display: table;
        width: 100%;
        padding-bottom: 20px;
        border-bottom: 3px solid #006AD7;
        margin-bottom: 24px;
    }

    .header-left {
        display: table-cell;
        vertical-align: middle;
    }

    .header-right {
        display: table-cell;
        text-align: right;
        vertical-align: middle;
    }

    .logo-box {
        background: #006AD7;
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        display: inline-block;
    }

    .logo-text {
        font-size: 18px;
        font-weight: bold;
    }

    .logo-sub {
        font-size: 10px;
        opacity: .8;
        margin-top: 2px;
    }

    .facture-title {
        font-size: 22px;
        font-weight: bold;
        color: #006AD7;
    }

    .facture-numero {
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: bold;
    }

    .badge-payee {
        background: #f0fdf4;
        color: #16a34a;
    }

    .badge-envoyee {
        background: #eff6ff;
        color: #2563eb;
    }

    .badge-retard {
        background: #fef2f2;
        color: #dc2626;
    }

    .badge-brouillon {
        background: #f9fafb;
        color: #6b7280;
    }

    .badge-attente {
        background: #fffbeb;
        color: #d97706;
    }

    /* Info grid */
    .info-grid {
        display: table;
        width: 100%;
        margin-bottom: 24px;
    }

    .info-col {
        display: table-cell;
        width: 50%;
        vertical-align: top;
    }

    .info-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 14px 16px;
        margin-right: 10px;
    }

    .info-box-right {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 14px 16px;
    }

    .info-label {
        font-size: 10px;
        font-weight: bold;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 8px;
    }

    .info-row {
        margin-bottom: 5px;
        font-size: 12px;
    }

    .info-val {
        font-weight: bold;
        color: #111;
    }

    /* Table charges */
    .section-title {
        font-size: 13px;
        font-weight: bold;
        color: #006AD7;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 10px;
        padding-bottom: 6px;
        border-bottom: 2px solid #e5e7eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table thead th {
        background: #006AD7;
        color: #fff;
        padding: 10px 12px;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    table tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 12px;
    }

    table tfoot td {
        padding: 12px;
        font-weight: bold;
        border-top: 2px solid #006AD7;
    }

    /* Total */
    .total-box {
        background: #006AD7;
        color: #fff;
        border-radius: 8px;
        padding: 16px 20px;
        display: table;
        width: 100%;
        margin-bottom: 24px;
    }

    .total-label {
        display: table-cell;
        font-size: 14px;
        font-weight: bold;
        vertical-align: middle;
    }

    .total-amount {
        display: table-cell;
        text-align: right;
        font-size: 22px;
        font-weight: bold;
        vertical-align: middle;
    }

    /* Statut paiement */
    .statut-box {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 24px;
    }

    .statut-payee {
        border-color: #16a34a;
        background: #f0fdf4;
    }

    .statut-retard {
        border-color: #dc2626;
        background: #fef2f2;
    }

    /* Footer */
    .footer {
        border-top: 2px solid #e5e7eb;
        padding-top: 16px;
        text-align: center;
        font-size: 10px;
        color: #9ca3af;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-left">
            <div class="logo-box">
                <div class="logo-text">SyndicPro</div>
                <div class="logo-sub">Gestion de copropriété</div>
            </div>
        </div>
        <div class="header-right">
            <div class="facture-title">FACTURE</div>
            <div class="facture-numero">{{ $facture->numero }}</div>
            <div style="margin-top:6px">
                @php
                $bl = ['payee' => 'badge-payee', 'envoyee' => 'badge-envoyee', 'retard' => 'badge-retard', 'brouillon'
                => 'badge-brouillon', 'en_attente_confirmation' => 'badge-attente'];
                $ll = ['payee' => '✓ Payée', 'envoyee' => 'Envoyée', 'retard' => '⚠ Retard', 'brouillon' => 'Brouillon',
                'en_attente_confirmation' => 'En attente'];
                @endphp
                <span class="badge {{ $bl[$facture->statut] ?? 'badge-brouillon' }}">
                    {{ $ll[$facture->statut] ?? $facture->statut }}
                </span>
            </div>
        </div>
    </div>

    {{-- INFOS --}}
    <div class="info-grid">
        <div class="info-col">
            <div class="info-box">
                <div class="info-label">Émetteur</div>
                <div class="info-row"><span class="info-val">SyndicPro</span></div>
                @if($facture->resident->lot->copropriete ?? false)
                <div class="info-row">{{ $facture->resident->lot->copropriete->nom }}</div>
                <div class="info-row">{{ $facture->resident->lot->copropriete->adresse }}</div>
                <div class="info-row">{{ $facture->resident->lot->copropriete->ville }}</div>
                @endif
            </div>
        </div>
        <div class="info-col">
            <div class="info-box-right">
                <div class="info-label">Destinataire</div>
                <div class="info-row"><span class="info-val">{{ $facture->resident->user->name ?? '—' }}</span></div>
                <div class="info-row">{{ $facture->resident->user->email ?? '' }}</div>
                @if($facture->resident->lot ?? false)
                <div class="info-row">Lot {{ $facture->resident->lot->numero }} —
                    {{ ucfirst($facture->resident->lot->type) }}</div>
                @endif
                @if($facture->resident->telephone ?? false)
                <div class="info-row">{{ $facture->resident->telephone }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- META --}}
    <div class="info-grid" style="margin-bottom:20px">
        <div class="info-col">
            <div class="info-box">
                <div class="info-label">Détails facture</div>
                <div class="info-row">Période : <span class="info-val">{{ $facture->mois }}</span></div>
                <div class="info-row">Date émission : <span
                        class="info-val">{{ $facture->created_at->format('d/m/Y') }}</span></div>
                <div class="info-row">Échéance : <span
                        class="info-val">{{ \Carbon\Carbon::parse($facture->echeance)->format('d/m/Y') }}</span></div>
                @if($facture->date_paiement)
                <div class="info-row">Date paiement : <span class="info-val"
                        style="color:#16a34a">{{ \Carbon\Carbon::parse($facture->date_paiement)->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- CHARGES --}}
    <div class="section-title">Détail des charges</div>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Type</th>
                <th style="text-align:right">Montant (MAD)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facture->charges as $charge)
            <tr>
                <td>{{ $charge['libelle'] ?? 'Charge' }}</td>
                <td>{{ $charge['type'] === 'fixe' ? 'Fixe' : 'Répartition' }}</td>
                <td style="text-align:right">{{ number_format($charge['montant'] ?? 0, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total-box">
        <div class="total-label">Total à payer</div>
        <div class="total-amount">{{ number_format($facture->total, 2) }} MAD</div>
    </div>

    {{-- STATUT --}}
    @if($facture->statut === 'payee')
    <div class="statut-box statut-payee">
        <strong style="color:#16a34a">✓ PAYÉE</strong>
        @if($facture->date_paiement)
        — le {{ \Carbon\Carbon::parse($facture->date_paiement)->format('d/m/Y') }}
        @endif
    </div>
    @elseif($facture->statut === 'retard')
    <div class="statut-box statut-retard">
        <strong style="color:#dc2626">⚠ EN RETARD</strong>
        — Veuillez régulariser votre situation au plus tôt.
    </div>
    @endif

    {{-- FOOTER --}}
    <div class="footer">
        <p>SyndicPro — Système de gestion de copropriété</p>
        <p>Document généré le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Ce document est généré automatiquement et ne nécessite pas de signature.</p>
    </div>

</body>

</html>