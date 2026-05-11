<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use App\Models\User;
use App\Services\NotificationService; // ← AJOUTÉ
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reclamation::with([
            'resident.user',
            'resident.lot.copropriete',
        ])->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $reclamations = $query->paginate(15)->withQueryString();

        $counts = [
            'total' => Reclamation::count(),
            'en_attente' => Reclamation::where('statut', 'en_attente')->count(),
            'en_cours' => Reclamation::where('statut', 'en_cours')->count(),
            'resolu' => Reclamation::where('statut', 'resolu')->count(),
            'ferme' => Reclamation::where('statut', 'ferme')->count(),
        ];

        return view('reclamations.index', compact('reclamations', 'counts'));
    }

    public function show(Reclamation $reclamation)
    {
        $reclamation->load(
            'resident.user',
            'resident.lot.copropriete',
            'interventions.fournisseur'
        );

        return view('reclamations.show', compact('reclamation'));
    }

    public function updateStatut(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,resolu,ferme',
            'reponse' => 'nullable|string',
        ]);

        $reclamation->update([
            'statut' => $request->statut,
            'reponse' => $request->reponse,
        ]);

        // ── NOTIFICATION → Résident quand syndic change le statut ──
        $labels = [
            'en_cours' => 'En cours de traitement',
            'resolu' => 'Résolue',
            'ferme' => 'Fermée',
        ];

        if (isset($labels[$request->statut])) {
            NotificationService::envoyer(
                $reclamation->resident->user_id,
                'Réclamation mise à jour',
                'Votre réclamation "' . $reclamation->titre . '" est maintenant : ' . $labels[$request->statut] . '.' .
                ($request->reponse ? ' Réponse du syndic : ' . $request->reponse : ''),
                'reclamation',
                route('resident.reclamations.mes')
            );
        }

        return redirect()
            ->route('syndic.reclamations.show', $reclamation)
            ->with('success', 'Réclamation mise à jour avec succès !');
    }

    public function create()
    {
        return view('reclamations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'priorite' => 'required|in:normale,urgente,critique',
        ]);

        $reclamation = Reclamation::create([
            'resident_id' => auth()->user()->resident->id,
            'titre' => $request->titre,
            'description' => $request->description,
            'priorite' => $request->priorite,
            'statut' => 'en_attente',
        ]);

        // ── NOTIFICATION → Syndic quand résident soumet ────────────
        $syndic = User::where('role', 'syndic')->first();
        if ($syndic) {
            $prioriteLabel = ['normale' => 'Normale', 'urgente' => '⚠ Urgente', 'critique' => '🔴 Critique'];
            NotificationService::envoyer(
                $syndic->id,
                'Nouvelle réclamation reçue',
                auth()->user()->name . ' a soumis une réclamation : "' . $request->titre . '" — Priorité : ' . ($prioriteLabel[$request->priorite] ?? $request->priorite),
                'reclamation',
                route('syndic.reclamations.index')
            );
        }

        return redirect()
            ->route('resident.reclamations.mes')
            ->with('success', 'Votre réclamation a été soumise. Le syndic en a été notifié.');
    }

    public function mesReclamations()
    {
        $reclamations = auth()->user()->resident
            ->reclamations()
            ->latest()
            ->get();

        return view('reclamations.mes', compact('reclamations'));
    }
}