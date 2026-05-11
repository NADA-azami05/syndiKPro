<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    // ✅ Pas de __construct() — middleware géré dans routes/web.php (Laravel 12)

    public function index()
    {
        $fournisseurs = Fournisseur::withCount('interventions')
            ->latest()
            ->paginate(10);

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'categorie' => 'required|in:plomberie,electricite,nettoyage,securite,autre',
            'telephone' => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
            'adresse'   => 'nullable|string|max:500',
            'note'      => 'nullable|numeric|min:0|max:5',
            'actif'     => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;

        Fournisseur::create($validated);

        return redirect()->route('syndic.fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès.');
    }

    public function show(Fournisseur $fournisseur)
    {
        $fournisseur->load(['interventions.copropriete', 'interventions.reclamation']);
        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'categorie' => 'required|in:plomberie,electricite,nettoyage,securite,autre',
            'telephone' => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
            'adresse'   => 'nullable|string|max:500',
            'note'      => 'nullable|numeric|min:0|max:5',
            'actif'     => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;

        $fournisseur->update($validated);

        return redirect()->route('syndic.fournisseurs.index')
            ->with('success', 'Fournisseur mis à jour avec succès.');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return redirect()->route('syndic.fournisseurs.index')
            ->with('success', 'Fournisseur supprimé avec succès.');
    }

    public function noter(Request $request, Fournisseur $fournisseur)
    {
        $request->validate(['note' => 'required|numeric|min:0|max:5']);

        $fournisseur->update(['note' => $request->note]);

        return back()->with('success', 'Note mise à jour.');
    }
}