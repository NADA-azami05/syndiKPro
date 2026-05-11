<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Resident;
use App\Models\User;
use App\Services\NotificationService; // ← AJOUTÉ
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class FactureController extends Controller
{
    // ══════════════════════════════════════════════════════════════
    // SYNDIC
    // ══════════════════════════════════════════════════════════════

    public function index(): View
    {
        $factures = Facture::with('resident.user', 'resident.lot')
            ->latest()
            ->when(request('statut'), fn($q) => $q->where('statut', request('statut')))
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Facture::count(),
            'payees' => Facture::where('statut', 'payee')->count(),
            'attente' => Facture::whereIn('statut', ['envoyee', 'en_attente_confirmation'])->count(),
            'retard' => Facture::where('statut', 'retard')->count(),
            'montant' => Facture::where('statut', 'payee')->sum('total'),
        ];

        return view('factures.index', compact('factures', 'stats'));
    }

    public function create(): View
    {
        $residents = Resident::with('user', 'lot')
            ->where('statut', 'actif')
            ->get();

        return view('factures.create', compact('residents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'mois' => 'required|string',
            'echeance' => 'required|date',
            'charges' => 'required|array',
            'statut' => 'nullable|in:brouillon,envoyee',
        ]);

        $resident = Resident::with('lot')->find($request->resident_id);
        $quote_part = $resident->lot->quote_part;
        $total = 0;

        foreach ($request->charges as $charge) {
            if ($charge['type'] === 'repartition') {
                $total += $charge['montant'] * $quote_part;
            } else {
                $total += $charge['montant'];
            }
        }

        $numero = 'FAC-' . date('Y') . '-' . str_pad(Facture::count() + 1, 4, '0', STR_PAD_LEFT);
        $statut = $request->statut ?? 'envoyee';

        $facture = Facture::create([
            'resident_id' => $request->resident_id,
            'numero' => $numero,
            'mois' => $request->mois,
            'charges' => $request->charges,
            'total' => round($total, 2),
            'echeance' => $request->echeance,
            'statut' => $statut,
        ]);

        // ── NOTIFICATION → Résident si facture envoyée ────────────
        if ($statut === 'envoyee') {
            NotificationService::envoyer(
                $resident->user_id,
                'Nouvelle facture reçue',
                'Une nouvelle facture ' . $numero . ' de ' . number_format($total, 2) . ' MAD pour ' . $request->mois . ' a été émise.',
                'facture',
                route('resident.factures.mes')
            );
        }

        return redirect()->route('syndic.factures.index')
            ->with('success', 'Facture créée avec succès !');
    }

    public function show(Facture $facture): View
    {
        $facture->load('resident.user', 'resident.lot.copropriete');
        return view('factures.show', compact('facture'));
    }

    public function update(Request $request, Facture $facture): RedirectResponse
    {
        $request->validate([
            'statut' => 'required|in:brouillon,envoyee,en_attente_confirmation,payee,retard',
        ]);

        $facture->update([
            'statut' => $request->statut,
            'date_paiement' => $request->statut === 'payee' ? now() : $facture->date_paiement,
        ]);

        // ── NOTIFICATION → Résident si facture en retard ──────────
        if ($request->statut === 'retard') {
            NotificationService::envoyer(
                $facture->resident->user_id,
                'Facture en retard',
                'Votre facture ' . $facture->numero . ' de ' . number_format($facture->total, 2) . ' MAD est en retard de paiement.',
                'facture',
                route('resident.factures.mes')
            );
        }

        return redirect()->route('syndic.factures.index')
            ->with('success', 'Statut de la facture mis à jour.');
    }

    public function destroy(Facture $facture): RedirectResponse
    {
        if ($facture->statut === 'payee') {
            return redirect()->route('syndic.factures.index')
                ->with('error', 'Impossible de supprimer une facture déjà payée.');
        }

        $facture->delete();

        return redirect()->route('syndic.factures.index')
            ->with('success', 'Facture supprimée avec succès.');
    }

    public function pdf(Facture $facture)
    {
        $facture->load('resident.user', 'resident.lot.copropriete');

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('factures.pdf', compact('facture'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('facture-' . $facture->numero . '.pdf');
    }

    // ══════════════════════════════════════════════════════════════
    // RÉSIDENT
    // ══════════════════════════════════════════════════════════════

    public function mesFactures(): View
    {
        $resident = auth()->user()->resident;

        if (!$resident) {
            return view('factures.mes', ['factures' => collect()]);
        }

        $factures = $resident->factures()->latest()->paginate(10);

        return view('factures.mes', compact('factures'));
    }

    public function initierPaiement(Facture $facture): View
    {
        if ($facture->resident->user_id !== auth()->id())
            abort(403);
        if ($facture->statut === 'payee')
            abort(403, 'Cette facture est déjà payée.');

        Stripe::setApiKey(config('services.stripe.secret'));

        if ($facture->stripe_payment_intent) {
            $pi = PaymentIntent::retrieve($facture->stripe_payment_intent);
        } else {
            $pi = PaymentIntent::create([
                'amount' => (int) ($facture->total * 100),
                'currency' => 'mad',
                'metadata' => [
                    'facture_id' => $facture->id,
                    'resident_id' => $facture->resident_id,
                    'numero' => $facture->numero,
                ],
            ]);

            $facture->update([
                'stripe_payment_intent' => $pi->id,
                'stripe_client_secret' => $pi->client_secret,
                'statut' => 'en_attente_confirmation',
            ]);
        }

        return view('factures.paiement', [
            'facture' => $facture,
            'clientSecret' => $pi->client_secret,
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    public function confirmerPaiement(Request $request, Facture $facture)
    {
        if ($facture->resident->user_id !== auth()->id())
            abort(403);

        Stripe::setApiKey(config('services.stripe.secret'));

        $pi = PaymentIntent::retrieve($request->input('payment_intent_id'));

        if ($pi->status === 'succeeded') {
            $facture->update([
                'statut' => 'payee',
                'date_paiement' => now(),
            ]);

            // ── NOTIFICATION → Syndic quand résident paie ─────────
            $syndic = User::where('role', 'syndic')->first();
            if ($syndic) {
                NotificationService::envoyer(
                    $syndic->id,
                    'Paiement reçu',
                    $facture->resident->user->name . ' a payé la facture ' . $facture->numero . ' (' . number_format($facture->total, 2) . ' MAD).',
                    'facture',
                    route('syndic.factures.show', $facture)
                );
            }

            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'error', 'message' => 'Paiement non confirmé par Stripe.'], 422);
    }

    public function webhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                config('services.stripe.webhook_secret')
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        if ($event->type === 'payment_intent.succeeded') {
            $factureId = $event->data->object->metadata->facture_id ?? null;

            if ($factureId) {
                $facture = Facture::find($factureId);
                if ($facture) {
                    $facture->update(['statut' => 'payee', 'date_paiement' => now()]);

                    // ── NOTIFICATION → Syndic via webhook ─────────
                    $syndic = User::where('role', 'syndic')->first();
                    if ($syndic) {
                        NotificationService::envoyer(
                            $syndic->id,
                            'Paiement reçu',
                            'La facture ' . $facture->numero . ' a été payée via Stripe.',
                            'facture',
                            route('syndic.factures.show', $facture)
                        );
                    }
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}