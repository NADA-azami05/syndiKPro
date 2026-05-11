 @extends('Layouts.App')
 @section('title', 'Facture ' . $facture->numero)

 @push('styles')
 <style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

.facture-header {
    background: linear-gradient(135deg, #006AD7, #0055b3);
    border-radius: 18px;
    padding: 28px 32px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.facture-numero {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 4px;
}

.facture-mois {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.7);
}

.facture-total {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    color: #fff;
}

.facture-total-lbl {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.6);
    text-align: right;
}

.card-pro {
    background: #fff;
    border-radius: 18px;
    border: 1px solid rgba(0, 106, 215, 0.09);
    box-shadow: 0 2px 16px rgba(0, 106, 215, 0.06);
    overflow: hidden;
    margin-bottom: 20px;
}

.card-pro-header {
    padding: 16px 24px;
    border-bottom: 1px solid rgba(0, 106, 215, 0.09);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-pro-title {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 600;
    color: #006AD7;
    margin: 0;
}

.card-pro-body {
    padding: 20px 24px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.info-item {
    background: rgba(0, 106, 215, 0.04);
    border-radius: 10px;
    padding: 14px 16px;
}

.info-lbl {
    font-size: 11px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.info-val {
    font-size: 14px;
    font-weight: 600;
    color: #111;
}

.charge-table {
    width: 100%;
    border-collapse: collapse;
}

.charge-table th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
    font-weight: 500;
    padding: 10px 14px;
    border-bottom: 1px solid rgba(0, 106, 215, 0.09);
    text-align: left;
}

.charge-table td {
    font-size: 13px;
    color: #111;
    padding: 12px 14px;
    border-bottom: 1px solid rgba(0, 106, 215, 0.05);
}

.charge-table tr:last-child td {
    border-bottom: none;
}

.charge-table tfoot td {
    font-weight: 700;
    color: #006AD7;
    border-top: 2px solid rgba(0, 106, 215, 0.09);
    padding-top: 14px;
}

.badge-statut {
    font-size: 11px;
    font-weight: 600;
    padding: 5px 14px;
    border-radius: 100px;
}

.s-payee {
    background: rgba(16, 185, 129, 0.12);
    color: #059669
}

.s-envoyee {
    background: rgba(0, 106, 215, 0.10);
    color: #006AD7
}

.s-retard {
    background: rgba(220, 38, 38, 0.10);
    color: #dc2626
}

.s-brouillon {
    background: rgba(107, 114, 128, 0.10);
    color: #6b7280
}

.s-en_attente_confirmation {
    background: rgba(245, 158, 11, 0.10);
    color: #d97706
}

.btn-action {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 11px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid;
    transition: all .2s;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
}

.btn-blue {
    background: #006AD7;
    color: #fff;
    border-color: #006AD7;
}

.btn-blue:hover {
    background: #0055b3;
    color: #fff
}

.btn-outline {
    background: #fff;
    color: #6b7280;
    border-color: #e5e7eb;
}

.btn-outline:hover {
    border-color: #006AD7;
    color: #006AD7
}

/* ── Gestion statut par le syndic ── */
.statut-manager {
    background: #f0f4ff;
    border: 1px solid rgba(0, 106, 215, 0.15);
    border-radius: 12px;
    padding: 18px 20px;
}

.statut-manager h6 {
    font-size: 13px;
    font-weight: 600;
    color: #006AD7;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.statut-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.statut-opt input[type=radio] {
    display: none
}

.statut-opt label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    transition: all .2s;
    background: #fff;
}

.statut-opt input:checked+label {
    border-color: #006AD7;
    background: #e6f2ff;
    color: #006AD7
}

.statut-opt.s-payee input:checked+label {
    border-color: #059669;
    background: #f0fdf4;
    color: #059669
}

.statut-opt.s-retard input:checked+label {
    border-color: #dc2626;
    background: #fef2f2;
    color: #dc2626
}

.statut-opt.s-envoyee input:checked+label {
    border-color: #006AD7;
    background: #eff6ff;
    color: #006AD7
}

.btn-save-statut {
    width: 100%;
    background: #006AD7;
    color: #fff;
    border: none;
    padding: 11px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    margin-top: 12px;
    transition: background .2s;
}

.btn-save-statut:hover {
    background: #0055b3
}
 </style>
 @endpush

 @section('content')

 <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:#6b7280;">
     {{-- ✅ CORRIGÉ --}}
     <a href="{{ route('syndic.factures.index') }}" style="color:#6b7280;text-decoration:none;">
         <i class="fas fa-file-invoice me-1"></i>Factures
     </a>
     <i class="fas fa-chevron-right" style="font-size:10px;"></i>
     <span style="color:#006AD7;">{{ $facture->numero }}</span>
 </div>

 {{-- Header --}}
 <div class="facture-header">
     <div>
         <div class="facture-numero">{{ $facture->numero }}</div>
         <div class="facture-mois">{{ $facture->mois }}</div>
         <div style="margin-top:12px;">
             <span class="badge-statut s-{{ $facture->statut }}">
                 {{ strtoupper(str_replace('_', ' ', $facture->statut)) }}
             </span>
         </div>
     </div>
     <div style="text-align:right;">
         <div class="facture-total-lbl">TOTAL</div>
         <div class="facture-total">{{ number_format($facture->total, 2) }} MAD</div>
     </div>
 </div>

 <div class="row g-3">
     <div class="col-md-8">

         {{-- Informations --}}
         <div class="card-pro">
             <div class="card-pro-header">
                 <h5 class="card-pro-title">📋 Informations</h5>
             </div>
             <div class="card-pro-body">
                 <div class="info-grid">
                     <div class="info-item">
                         <div class="info-lbl">Résident</div>
                         <div class="info-val">{{ $facture->resident->user->name }}</div>
                     </div>
                     <div class="info-item">
                         <div class="info-lbl">Lot</div>
                         <div class="info-val">{{ $facture->resident->lot->numero ?? '—' }}</div>
                     </div>
                     <div class="info-item">
                         <div class="info-lbl">Échéance</div>
                         <div class="info-val">{{ \Carbon\Carbon::parse($facture->echeance)->format('d/m/Y') }}</div>
                     </div>
                     <div class="info-item">
                         <div class="info-lbl">Date de paiement</div>
                         <div class="info-val">
                             {{ $facture->date_paiement ? \Carbon\Carbon::parse($facture->date_paiement)->format('d/m/Y') : '—' }}
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         {{-- Détail charges --}}
         <div class="card-pro">
             <div class="card-pro-header">
                 <h5 class="card-pro-title">💰 Détail des charges</h5>
             </div>
             <div class="card-pro-body p-0">
                 <table class="charge-table">
                     <thead>
                         <tr>
                             <th>Libellé</th>
                             <th>Type</th>
                             <th style="text-align:right;">Montant</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($facture->charges as $charge)
                         <tr>
                             <td>{{ $charge['libelle'] }}</td>
                             <td>
                                 <span style="font-size:11px;padding:3px 8px;border-radius:6px;
                                    {{ $charge['type'] === 'repartition'
                                        ? 'background:rgba(0,106,215,0.08);color:#006AD7;'
                                        : 'background:rgba(107,114,128,0.08);color:#374151;' }}">
                                     {{ $charge['type'] === 'repartition' ? 'Répartition' : 'Fixe' }}
                                 </span>
                             </td>
                             <td style="text-align:right;font-weight:500;">
                                 {{ number_format($charge['montant'], 2) }} MAD
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                     <tfoot>
                         <tr>
                             <td colspan="2"><strong>Total</strong></td>
                             <td style="text-align:right;">{{ number_format($facture->total, 2) }} MAD</td>
                         </tr>
                     </tfoot>
                 </table>
             </div>
         </div>

     </div>

     <div class="col-md-4">

         {{-- ✅ NOUVEAU : Gestion statut par le syndic --}}
         <div class="card-pro">
             <div class="card-pro-header">
                 <h5 class="card-pro-title">📋 Gérer le statut</h5>
             </div>
             <div class="card-pro-body">
                 <form method="POST" action="{{ route('syndic.factures.update', $facture) }}">
                     @csrf
                     @method('PUT')
                     <div class="statut-manager">
                         <h6>🔄 Changer le statut</h6>
                         <div class="statut-options">
                             <div class="statut-opt s-brouillon">
                                 <input type="radio" name="statut" id="st_brouillon" value="brouillon"
                                     {{ $facture->statut === 'brouillon' ? 'checked' : '' }}>
                                 <label for="st_brouillon">📝 Brouillon</label>
                             </div>
                             <div class="statut-opt s-envoyee">
                                 <input type="radio" name="statut" id="st_envoyee" value="envoyee"
                                     {{ $facture->statut === 'envoyee' ? 'checked' : '' }}>
                                 <label for="st_envoyee">📤 Envoyée au résident</label>
                             </div>
                             <div class="statut-opt s-payee">
                                 <input type="radio" name="statut" id="st_payee" value="payee"
                                     {{ $facture->statut === 'payee' ? 'checked' : '' }}>
                                 <label for="st_payee">✅ Payée</label>
                             </div>
                             <div class="statut-opt s-retard">
                                 <input type="radio" name="statut" id="st_retard" value="retard"
                                     {{ $facture->statut === 'retard' ? 'checked' : '' }}>
                                 <label for="st_retard">⚠️ En retard</label>
                             </div>
                         </div>
                         <button type="submit" class="btn-save-statut">
                             💾 Enregistrer le statut
                         </button>
                     </div>
                 </form>
             </div>
         </div>

         {{-- Actions --}}
         <div class="card-pro">
             <div class="card-pro-header">
                 <h5 class="card-pro-title">⚡ Actions</h5>
             </div>
             <div class="card-pro-body" style="display:flex;flex-direction:column;gap:10px;">
                 <a href="{{ route('syndic.factures.pdf', $facture) }}" class="btn-action btn-blue">
                     <i class="fas fa-file-pdf"></i> Télécharger PDF
                 </a>
                 <a href="{{ route('syndic.factures.index') }}" class="btn-action btn-outline">
                     <i class="fas fa-arrow-left"></i> Retour
                 </a>
             </div>
         </div>

     </div>
 </div>

 @endsection