 @extends('Layouts.App')
 @section('title', 'Nouvelle Facture')

 @push('styles')
 <style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

.form-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid rgba(0, 106, 215, 0.09);
    box-shadow: 0 2px 16px rgba(0, 106, 215, 0.08);
    overflow: hidden;
    max-width: 800px;
    margin: 0 auto;
}

.form-card-header {
    background: linear-gradient(135deg, #006AD7, #0055b3);
    padding: 24px 32px;
}

.form-card-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 4px;
}

.form-card-header p {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
}

.form-card-body {
    padding: 32px;
}

.form-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 14px;
    font-weight: 600;
    color: #006AD7;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(0, 106, 215, 0.12);
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
    margin-bottom: 8px;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    background: #f8fafc;
    border: 1px solid rgba(0, 106, 215, 0.12);
    border-radius: 10px;
    font-size: 14px;
    color: #111;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}

.form-input:focus {
    border-color: #006AD7;
    box-shadow: 0 0 0 3px rgba(0, 106, 215, 0.12);
    background: #fff;
}

.form-input.is-invalid {
    border-color: #dc2626;
}

.invalid-feedback {
    font-size: 12px;
    color: #dc2626;
    margin-top: 5px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.charges-container {
    border: 1px solid rgba(0, 106, 215, 0.09);
    border-radius: 12px;
    overflow: hidden;
}

.charge-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 10px;
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0, 106, 215, 0.05);
    align-items: center;
    background: #fff;
}

.charge-row:last-child {
    border-bottom: none;
}

.charge-row-header {
    background: rgba(0, 106, 215, 0.04);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
    font-weight: 500;
}

.charge-input {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid rgba(0, 106, 215, 0.12);
    border-radius: 8px;
    font-size: 13px;
    color: #111;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: border-color .2s;
}

.charge-input:focus {
    border-color: #006AD7;
}

.btn-add-charge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 106, 215, 0.05);
    color: #006AD7;
    padding: 10px 16px;
    border-radius: 10px;
    border: 1px dashed rgba(0, 106, 215, 0.3);
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    transition: all .2s;
    margin-top: 10px;
    width: 100%;
    justify-content: center;
}

.btn-add-charge:hover {
    background: rgba(0, 106, 215, 0.1);
}

.btn-remove {
    background: rgba(220, 38, 38, 0.07);
    color: #dc2626;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}

.btn-remove:hover {
    background: #dc2626;
    color: #fff;
}

.total-box {
    background: linear-gradient(135deg, #006AD7, #0055b3);
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 16px;
}

.total-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
}

.total-value {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
}

.form-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 106, 215, 0.09);
    margin-top: 8px;
}

.btn-cancel {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    text-decoration: none;
    font-size: 13px;
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    transition: all .2s;
}

.btn-cancel:hover {
    border-color: #006AD7;
    color: #006AD7;
}

.btn-submit {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #006AD7;
    color: #fff;
    padding: 12px 28px;
    border-radius: 10px;
    border: none;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: background .2s, transform .15s;
}

.btn-submit:hover {
    background: #0055b3;
    transform: translateY(-1px);
}

.btn-brouillon {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    color: #006AD7;
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid rgba(0, 106, 215, 0.3);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: all .2s;
}

.btn-brouillon:hover {
    border-color: #006AD7;
    background: rgba(0, 106, 215, 0.05);
}

/* ── Gestion statut facture (syndic) ── */
.statut-card {
    background: #f0f4ff;
    border: 1px solid rgba(0, 106, 215, 0.15);
    border-radius: 12px;
    padding: 20px 24px;
    margin-top: 20px;
}

.statut-card h3 {
    font-size: 14px;
    font-weight: 600;
    color: #006AD7;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.statut-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.statut-option input[type=radio] {
    display: none
}

.statut-option label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 12px 8px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    transition: all .2s;
    text-align: center;
}

.statut-option label .sico {
    font-size: 20px
}

.statut-option input:checked+label {
    border-color: #006AD7;
    background: #e6f2ff;
    color: #006AD7
}

.statut-option.envoyee input:checked+label {
    border-color: #2563eb;
    background: #eff6ff;
    color: #2563eb
}

.statut-option.payee input:checked+label {
    border-color: #16a34a;
    background: #f0fdf4;
    color: #16a34a
}

.statut-option.retard input:checked+label {
    border-color: #dc2626;
    background: #fef2f2;
    color: #dc2626
}
 </style>
 @endpush

 @section('content')

 <div style="max-width:800px;margin:0 auto;">

     <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:#6b7280;">
         {{-- ✅ CORRIGÉ : route syndic --}}
         <a href="{{ route('syndic.factures.index') }}" style="color:#6b7280;text-decoration:none;">
             <i class="fas fa-file-invoice me-1"></i>Factures
         </a>
         <i class="fas fa-chevron-right" style="font-size:10px;"></i>
         <span style="color:#006AD7;">Nouvelle facture</span>
     </div>

     <div class="form-card">
         <div class="form-card-header">
             <h2>🧾 Nouvelle facture</h2>
             <p>Créez une facture pour un résident</p>
         </div>

         <div class="form-card-body">
             {{-- ✅ CORRIGÉ : route syndic --}}
             <form method="POST" action="{{ route('syndic.factures.store') }}" id="factureForm">
                 @csrf

                 {{-- Résident + Mois --}}
                 <div class="form-section-title">
                     <i class="fas fa-user" style="color:#006AD7;"></i> Informations
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label class="form-label">Résident *</label>
                         <select name="resident_id" class="form-input @error('resident_id') is-invalid @enderror"
                             required onchange="updateQuotePart(this)">
                             <option value="">— Sélectionner un résident —</option>
                             @foreach($residents as $r)
                             <option value="{{ $r->id }}" data-quote="{{ $r->lot->quote_part ?? 0 }}"
                                 {{ old('resident_id') == $r->id ? 'selected' : '' }}>
                                 {{ $r->user->name }} — Lot {{ $r->lot->numero ?? '?' }}
                             </option>
                             @endforeach
                         </select>
                         @error('resident_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                     </div>
                     <div class="form-group">
                         <label class="form-label">Mois de facturation *</label>
                         <input type="text" name="mois" class="form-input @error('mois') is-invalid @enderror"
                             value="{{ old('mois') }}" placeholder="Ex: Janvier 2026" required>
                         @error('mois')<div class="invalid-feedback">{{ $message }}</div>@enderror
                     </div>
                 </div>

                 <div class="form-row">
                     <div class="form-group">
                         <label class="form-label">Date d'échéance *</label>
                         <input type="date" name="echeance" class="form-input @error('echeance') is-invalid @enderror"
                             value="{{ old('echeance') }}" required>
                         @error('echeance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                     </div>
                     <div class="form-group">
                         <label class="form-label">Quote-part du résident</label>
                         <div
                             style="padding:12px 16px;background:#f0f4ff;border-radius:10px;border:1px solid rgba(0,106,215,0.12);">
                             <span id="quotePartDisplay" style="font-size:14px;font-weight:600;color:#006AD7;">—</span>
                             <span style="font-size:12px;color:#6b7280;">%</span>
                         </div>
                     </div>
                 </div>

                 {{-- Charges --}}
                 <div class="form-section-title" style="margin-top:8px;">
                     <i class="fas fa-list" style="color:#006AD7;"></i> Charges
                 </div>

                 <div class="charges-container" id="chargesContainer">
                     <div class="charge-row charge-row-header">
                         <span>Libellé</span>
                         <span>Montant (MAD)</span>
                         <span>Type</span>
                         <span></span>
                     </div>
                     <div class="charge-row" id="chargeRow0">
                         <input type="text" name="charges[0][libelle]" class="charge-input"
                             placeholder="Ex: Charges communes" required>
                         <input type="number" name="charges[0][montant]" class="charge-input" placeholder="0.00"
                             step="0.01" min="0" oninput="calculateTotal()" required>
                         <select name="charges[0][type]" class="charge-input" onchange="calculateTotal()">
                             <option value="fixe">Fixe</option>
                             <option value="repartition">Répartition</option>
                         </select>
                         <button type="button" class="btn-remove" onclick="removeCharge(this)">
                             <i class="fas fa-times" style="font-size:11px;"></i>
                         </button>
                     </div>
                 </div>

                 <button type="button" class="btn-add-charge" onclick="addCharge()">
                     <i class="fas fa-plus"></i> Ajouter une charge
                 </button>

                 {{-- Total --}}
                 <div class="total-box">
                     <div>
                         <div class="total-label">Total calculé automatiquement</div>
                         <div style="font-size:11px;color:rgba(255,255,255,0.6);margin-top:2px;">
                             Selon quote-part pour les charges en répartition
                         </div>
                     </div>
                     <div class="total-value" id="totalDisplay">0.00 MAD</div>
                 </div>

                 {{-- ✅ NOUVEAU : Statut contrôlé par le syndic --}}
                 <div class="statut-card">
                     <h3>📋 Statut de la facture</h3>
                     <div class="statut-grid">
                         <div class="statut-option brouillon">
                             <input type="radio" name="statut" id="s_brouillon" value="brouillon" checked>
                             <label for="s_brouillon">
                                 <span class="sico">📝</span>Brouillon
                             </label>
                         </div>
                         <div class="statut-option envoyee">
                             <input type="radio" name="statut" id="s_envoyee" value="envoyee">
                             <label for="s_envoyee">
                                 <span class="sico">📤</span>Envoyée
                             </label>
                         </div>
                         <div class="statut-option payee">
                             <input type="radio" name="statut" id="s_payee" value="payee">
                             <label for="s_payee">
                                 <span class="sico">✅</span>Payée
                             </label>
                         </div>
                         <div class="statut-option retard">
                             <input type="radio" name="statut" id="s_retard" value="retard">
                             <label for="s_retard">
                                 <span class="sico">⚠️</span>En retard
                             </label>
                         </div>
                     </div>
                 </div>

                 <div class="form-actions" style="margin-top:24px;">
                     <a href="{{ route('syndic.factures.index') }}" class="btn-cancel">
                         <i class="fas fa-arrow-left"></i> Annuler
                     </a>
                     <button type="submit" class="btn-submit">
                         <i class="fas fa-paper-plane"></i> Créer la facture
                     </button>
                 </div>

             </form>
         </div>
     </div>
 </div>

 @endsection

 @push('scripts')
 <script>
let chargeIndex = 1;
let currentQuotePart = 0;

function updateQuotePart(select) {
    const opt = select.options[select.selectedIndex];
    currentQuotePart = parseFloat(opt.dataset.quote) || 0;
    document.getElementById('quotePartDisplay').textContent = (currentQuotePart * 100).toFixed(2);
    calculateTotal();
}

function addCharge() {
    const container = document.getElementById('chargesContainer');
    const row = document.createElement('div');
    row.className = 'charge-row';
    row.innerHTML = `
        <input type="text" name="charges[${chargeIndex}][libelle]" class="charge-input" placeholder="Libellé" required>
        <input type="number" name="charges[${chargeIndex}][montant]" class="charge-input" placeholder="0.00" step="0.01" min="0" oninput="calculateTotal()" required>
        <select name="charges[${chargeIndex}][type]" class="charge-input" onchange="calculateTotal()">
            <option value="fixe">Fixe</option>
            <option value="repartition">Répartition</option>
        </select>
        <button type="button" class="btn-remove" onclick="removeCharge(this)">
            <i class="fas fa-times" style="font-size:11px;"></i>
        </button>
    `;
    container.appendChild(row);
    chargeIndex++;
}

function removeCharge(btn) {
    const rows = document.querySelectorAll('.charge-row:not(.charge-row-header)');
    if (rows.length > 1) {
        btn.closest('.charge-row').remove();
        calculateTotal();
    }
}

function calculateTotal() {
    let total = 0;
    const rows = document.querySelectorAll('.charge-row:not(.charge-row-header)');
    rows.forEach(row => {
        const montant = parseFloat(row.querySelector('input[type="number"]')?.value) || 0;
        const type = row.querySelector('select')?.value;
        if (type === 'repartition') {
            total += montant * currentQuotePart;
        } else {
            total += montant;
        }
    });
    document.getElementById('totalDisplay').textContent = total.toFixed(2) + ' MAD';
}
 </script>
 @endpush