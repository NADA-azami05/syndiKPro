<?php

namespace App\Http\Controllers;

use App\Models\Copropriete;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CoproprieteController extends Controller
{
    // ── Liste des copropriétés ────────────────────────────────────────────────
    public function index(): View
    {
        $coproprietes = Copropriete::withCount('lots')
            ->latest()
            ->paginate(10);

        return view('coproprietes.index', compact('coproprietes'));
    }

    // ── Formulaire création ───────────────────────────────────────────────────
    public function create(): View
    {
        return view('coproprietes.create');
    }

    // ── Enregistrer nouvelle copropriété ──────────────────────────────────────
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:100'],
            'nb_lots' => ['required', 'integer', 'min:1'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'syndic_nom' => ['nullable', 'string', 'max:255'],
        ]);

        Copropriete::create($request->only([
            'nom',
            'adresse',
            'ville',
            'nb_lots',
            'budget',
            'syndic_nom'
        ]));

        return redirect()->route('syndic.coproprietes.index')
            ->with('success', 'Copropriété créée avec succès !');
    }

    // ── Détail d'une copropriété ──────────────────────────────────────────────
    public function show(Copropriete $copropriete): View
    {
        $copropriete->load(['lots.residents.user']);

        return view('coproprietes.show', compact('copropriete'));
    }

    // ── Formulaire modification ───────────────────────────────────────────────
    public function edit(Copropriete $copropriete): View
    {
        return view('coproprietes.edit', compact('copropriete'));
    }

    // ── Mettre à jour ─────────────────────────────────────────────────────────
    public function update(Request $request, Copropriete $copropriete): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:100'],
            'nb_lots' => ['required', 'integer', 'min:1'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'syndic_nom' => ['nullable', 'string', 'max:255'],
        ]);

        $copropriete->update($request->only([
            'nom',
            'adresse',
            'ville',
            'nb_lots',
            'budget',
            'syndic_nom'
        ]));

        return redirect()->route('syndic.coproprietes.index')
            ->with('success', 'Copropriété mise à jour avec succès !');
    }

    // ── Supprimer ─────────────────────────────────────────────────────────────
    public function destroy(Copropriete $copropriete): RedirectResponse
    {
        // Vérifier s'il y a des lots avant de supprimer
        if ($copropriete->lots()->count() > 0) {
            return redirect()->route('syndic.coproprietes.index')
                ->with('error', 'Impossible de supprimer : cette copropriété contient des lots.');
        }

        $copropriete->delete();

        return redirect()->route('syndic.coproprietes.index')
            ->with('success', 'Copropriété supprimée avec succès.');
    }
}