@extends('layouts.app')
@section('title', 'Paiement — ' . $facture->numero)
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
    padding: 32px 36px;
    display: flex;
    flex-direction: column;
    align-items: center
}

.back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #6b7280;
    font-size: 13px;
    text-decoration: none;
    margin-bottom: 24px;
    align-self: flex-start;
    transition: color .2s
}

.back:hover {
    color: #006AD7
}

.pay-wrap {
    width: 100%;
    max-width: 560px
}

.pay-header {
    text-align: center;
    margin-bottom: 28px
}

.pay-header h1 {
    font-family: var(--font-serif);
    font-size: 22px;
    font-weight: 700;
    color: #111;
    margin-bottom: 6px
}

.pay-header p {
    font-size: 14px;
    color: #6b7280
}

/* Récapitulatif */
.recap {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
}

.recap-title {
    font-size: 13px;
    font-weight: 700;
    color: #006AD7;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 16px
}

.recap-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f5f5f5;
    font-size: 13px;
    color: #333
}

.recap-row:last-child {
    border-bottom: none
}

.recap-row.total {
    font-size: 15px;
    font-weight: 700;
    color: #111;
    border-top: 2px solid #e5e7eb;
    padding-top: 14px;
    margin-top: 6px
}

.recap-badge {
    display: inline-flex;
    align-items: center;
    padding: 2px 8px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    background: #fffbeb;
    color: #d97706
}

/* Charges */
.charges-list {
    margin: 8px 0 0
}

.charge-item {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #6b7280;
    padding: 4px 0
}

/* Stripe form */
.stripe-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, .04)
}

.stripe-title {
    font-size: 13px;
    font-weight: 700;
    color: #006AD7;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px
}

.stripe-secure {
    font-size: 11px;
    color: #16a34a;
    background: #f0fdf4;
    padding: 2px 8px;
    border-radius: 100px;
    font-weight: 600
}

#card-element {
    border: 1px solid #e5e7eb;
    border-radius: 9px;
    padding: 14px;
    background: #f9fafb;
    transition: border-color .2s
}

#card-element.StripeElement--focus {
    border-color: #006AD7;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(0, 106, 215, .08)
}

#card-errors {
    color: #dc2626;
    font-size: 12px;
    margin-top: 8px;
    min-height: 18px
}

.btn-pay {
    width: 100%;
    padding: 14px;
    background: #006AD7;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: inherit
}

.btn-pay:hover {
    background: #0057b3;
    transform: translateY(-1px)
}

.btn-pay:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none
}

.spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255, 255, 255, .3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: none
}

@keyframes spin {
    to {
        transform: rotate(360deg)
    }
}

.pay-note {
    text-align: center;
    font-size: 11px;
    color: #9ca3af;
    margin-top: 12px
}

.pay-note span {
    color: #16a34a;
    font-weight: 600
}

/* Success overlay */
.success-overlay {
    display: none;
    text-align: center;
    background: #fff;
    border: 1px solid #bbf7d0;
    border-radius: 14px;
    padding: 40px;
    margin-bottom: 20px
}

.success-icon {
    font-size: 56px;
    margin-bottom: 16px
}

.success-title {
    font-family: var(--font-serif);
    font-size: 22px;
    font-weight: 700;
    color: #16a34a;
    margin-bottom: 8px
}

.success-sub {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 20px
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 24px;
    border-radius: 10px;
    background: #006AD7;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s
}

.btn-back:hover {
    background: #0057b3
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
                class="sb-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">🏠 Mon espace</a>
            <a href="{{ route('resident.factures.mes') }}"
                class="sb-item {{ request()->routeIs('resident.factures*') ? 'active' : '' }}">📄 Mes factures</a>
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
        <a href="{{ route('resident.factures.mes') }}" class="back">← Retour à mes factures</a>

        <div class="pay-wrap">
            <div class="pay-header">
                <h1>💳 Paiement de facture</h1>
                <p>Facture <strong>{{ $facture->numero }}</strong> — {{ $facture->mois }}</p>
            </div>

            {{-- SUCCESS --}}
            <div class="success-overlay" id="success-box">
                <div class="success-icon">✅</div>
                <div class="success-title">Paiement réussi !</div>
                <div class="success-sub">Votre paiement de <strong>{{ number_format($facture->total, 0) }} MAD</strong>
                    a
                    été traité avec succès.</div>
                <a href="{{ route('resident.factures.mes') }}" class="btn-back">← Retour à mes factures</a>
            </div>

            {{-- RECAP --}}
            <div class="recap" id="payment-form-wrap">
                <div class="recap-title">📋 Récapitulatif</div>

                <div class="recap-row">
                    <span>Numéro</span><span><strong>{{ $facture->numero }}</strong></span>
                </div>
                <div class="recap-row">
                    <span>Période</span><span>{{ $facture->mois }}</span>
                </div>
                <div class="recap-row">
                    <span>Échéance</span>
                    <span>{{ \Carbon\Carbon::parse($facture->echeance)->format('d/m/Y') }}</span>
                </div>
                <div class="recap-row">
                    <span>Statut actuel</span>
                    <span class="recap-badge">
                        {{ ['envoyee' => '📤 Envoyée', 'retard' => '⚠ Retard', 'en_attente_confirmation' => '⏳ En attente'][$facture->statut] ?? $facture->statut }}
                    </span>
                </div>

                {{-- Détail charges --}}
                @if($facture->charges && count($facture->charges))
                <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f5f5f5">
                    <div style="font-size:12px;font-weight:600;color:#6b7280;margin-bottom:8px">DÉTAIL DES CHARGES</div>
                    <div class="charges-list">
                        @foreach($facture->charges as $charge)
                        <div class="charge-item">
                            <span>{{ $charge['libelle'] ?? $charge['type'] ?? 'Charge' }}</span>
                            <span>{{ number_format($charge['montant'] ?? 0, 2) }} MAD</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="recap-row total">
                    <span>Total à payer</span>
                    <span style="color:#006AD7">{{ number_format($facture->total, 2) }} MAD</span>
                </div>
            </div>

            {{-- STRIPE FORM --}}
            <div class="stripe-card" id="stripe-form-card">
                <div class="stripe-title">
                    🔒 Paiement sécurisé
                    <span class="stripe-secure">✓ SSL Stripe</span>
                </div>

                <div id="card-element"></div>
                <div id="card-errors"></div>

                <button id="pay-btn" class="btn-pay" style="margin-top:20px">
                    <div class="spinner" id="spinner"></div>
                    <span id="btn-text">💳 Payer {{ number_format($facture->total, 2) }} MAD</span>
                </button>

                <p class="pay-note">
                    <span>🔒 Sécurisé</span> — Vos données bancaires ne sont jamais stockées sur nos serveurs.
                </p>
            </div>

        </div>
    </main>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ $stripeKey }}');
const elements = stripe.elements();

const style = {
    base: {
        fontSize: '15px',
        color: '#111',
        fontFamily: 'system-ui, sans-serif',
        '::placeholder': {
            color: '#9ca3af'
        },
    },
    invalid: {
        color: '#dc2626'
    }
};

const card = elements.create('card', {
    style,
    hidePostalCode: true
});
card.mount('#card-element');

card.on('change', ({
    error
}) => {
    document.getElementById('card-errors').textContent = error ? error.message : '';
});

document.getElementById('pay-btn').addEventListener('click', async () => {
    const btn = document.getElementById('pay-btn');
    const spin = document.getElementById('spinner');
    const txt = document.getElementById('btn-text');

    btn.disabled = true;
    spin.style.display = 'block';
    txt.textContent = 'Traitement en cours...';

    const {
        paymentIntent,
        error
    } = await stripe.confirmCardPayment(
        '{{ $clientSecret }}', {
            payment_method: {
                card
            }
        }
    );

    if (error) {
        document.getElementById('card-errors').textContent = error.message;
        btn.disabled = false;
        spin.style.display = 'none';
        txt.textContent = '💳 Payer {{ number_format($facture->total, 2) }} MAD';
    } else if (paymentIntent.status === 'succeeded') {
        // Confirmer côté serveur
        await fetch('{{ route("resident.factures.confirmer", $facture) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                payment_intent_id: paymentIntent.id
            })
        });

        document.getElementById('stripe-form-card').style.display = 'none';
        document.getElementById('payment-form-wrap').style.display = 'none';
        document.getElementById('success-box').style.display = 'block';
    }
});
</script>
@endpush
@endsection