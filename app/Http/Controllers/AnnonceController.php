<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Copropriete;
use App\Services\NotificationService; // ← AJOUTÉ
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    // SYNDIC — liste toutes les annonces
    public function index()
    {
        $annonces = Annonce::with('copropriete')->latest()->paginate(15);
        return view('annonces.index', compact('annonces'));
    }

    // SYNDIC — formulaire création
    public function create()
    {
        $coproprietes = Copropriete::all();
        return view('annonces.create', compact('coproprietes'));
    }

    // SYNDIC — enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'copropriete_id' => 'required|exists:coproprietes,id',
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type' => 'required|in:generale,urgente,maintenance,evenement',
            'publiee' => 'boolean',
        ]);

        $publiee = $request->boolean('publiee', true);

        Annonce::create([
            'user_id' => auth()->id(),
            'copropriete_id' => $request->copropriete_id,
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $request->type,
            'publiee' => $publiee,
        ]);

        // ── NOTIFICATION → Résidents si annonce publiée ───────────
        if ($publiee) {
            $typeLabel = [
                'generale' => '📢 Générale',
                'urgente' => '🚨 Urgente',
                'maintenance' => '🔧 Maintenance',
                'evenement' => '🎉 Événement',
            ];

            NotificationService::envoyerACopropriete(
                $request->copropriete_id,
                'Nouvelle annonce : ' . $request->titre,
                '[' . ($typeLabel[$request->type] ?? $request->type) . '] ' .
                \Illuminate\Support\Str::limit($request->contenu, 100),
                'annonce',
                route('resident.annonces.index')
            );
        }

        return redirect()->route('syndic.annonces.index')
            ->with('success', 'Annonce publiée avec succès !');
    }

    // SYNDIC — modifier
    public function edit(Annonce $annonce)
    {
        $coproprietes = Copropriete::all();
        return view('annonces.edit', compact('annonce', 'coproprietes'));
    }

    // SYNDIC — mettre à jour
    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type' => 'required|in:generale,urgente,maintenance,evenement',
            'publiee' => 'boolean',
        ]);

        $etaitPasPubliee = !$annonce->publiee;
        $publiee = $request->boolean('publiee', true);

        $annonce->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $request->type,
            'publiee' => $publiee,
        ]);

        // ── NOTIFICATION → Résidents si annonce nouvellement publiée
        if ($publiee && $etaitPasPubliee) {
            NotificationService::envoyerACopropriete(
                $annonce->copropriete_id,
                'Nouvelle annonce : ' . $request->titre,
                \Illuminate\Support\Str::limit($request->contenu, 100),
                'annonce',
                route('resident.annonces.index')
            );
        }

        return redirect()->route('syndic.annonces.index')
            ->with('success', 'Annonce mise à jour !');
    }

    // SYNDIC — supprimer
    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return redirect()->route('syndic.annonces.index')
            ->with('success', 'Annonce supprimée.');
    }

    // RÉSIDENT — voir les annonces de sa copropriété
    public function mesAnnonces()
    {
        $resident = auth()->user()->resident;
        $copropriete_id = $resident->lot->copropriete_id ?? null;

        $annonces = Annonce::where('copropriete_id', $copropriete_id)
            ->where('publiee', true)
            ->latest()
            ->paginate(10);

        return view('annonces.mes', compact('annonces'));
    }
}