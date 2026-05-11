<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Fournisseur;
use App\Models\Copropriete;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    // ✅ Pas de __construct() — middleware géré dans routes/web.php (Laravel 12)

    public function index()
    {
        $interventions = Intervention::with(['fournisseur', 'copropriete', 'reclamation'])
            ->latest()
            ->paginate(10);

        return view('interventions.index', compact('interventions'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::where('actif', true)->orderBy('nom')->get();
        $coproprietes = Copropriete::orderBy('nom')->get();
        $reclamations = Reclamation::orderBy('created_at', 'desc')->get();

        return view('interventions.create', compact('fournisseurs', 'coproprietes', 'reclamations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fournisseur_id'    => 'required|exists:fournisseurs,id',
            'copropriete_id'    => 'required|exists:coproprietes,id',
            'reclamation_id'    => 'nullable|exists:reclamations,id',
            'titre'             => 'required|string|max:255',
            'description'       => 'nullable|string|max:1000',
            'date_intervention' => 'required|date',
            'cout'              => 'nullable|numeric|min:0',
            'statut'            => 'required|in:planifiee,en_cours,terminee',
        ]);

        Intervention::create($validated);

        return redirect()->route('syndic.interventions.index')
            ->with('success', 'Intervention créée avec succès.');
    }

    public function show(Intervention $intervention)
    {
        $intervention->load(['fournisseur', 'copropriete', 'reclamation']);
        return view('interventions.show', compact('intervention'));
    }

    public function destroy(Intervention $intervention)
    {
        $intervention->delete();

        return redirect()->route('syndic.interventions.index')
            ->with('success', 'Intervention supprimée avec succès.');
    }
}