<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Copropriete;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LotController extends Controller
{


    // ── Liste des lots ────────────────────────────────────────────────────────
    public function index(): View
    {
        $lots = Lot::with('copropriete')
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => Lot::count(),
            'occupes' => Lot::where('statut', 'occupe')->count(),
            'libres' => Lot::where('statut', 'libre')->count(),
        ];

        return view('lots.index', compact('lots', 'stats'));
    }

    // ── Formulaire création ───────────────────────────────────────────────────
    public function create(): View
    {
        $coproprietes = Copropriete::orderBy('nom')->get();
        return view('lots.create', compact('coproprietes'));
    }

    // ── Enregistrer ───────────────────────────────────────────────────────────
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'copropriete_id' => ['required', 'exists:coproprietes,id'],
            'numero' => ['required', 'string', 'max:50'],
            'type' => ['required', 'in:appartement,commerce,parking,local'],
            'surface' => ['required', 'numeric', 'min:1'],
            'quote_part' => ['required', 'numeric', 'min:0', 'max:1'],
            'statut' => ['required', 'in:occupe,libre'],
        ]);

        Lot::create($request->only([
            'copropriete_id',
            'numero',
            'type',
            'surface',
            'quote_part',
            'statut'
        ]));

        return redirect()->route('syndic.lots.index')
            ->with('success', 'Lot créé avec succès !');
    }

    // ── Formulaire modification ───────────────────────────────────────────────
    public function edit(Lot $lot): View
    {
        $coproprietes = Copropriete::orderBy('nom')->get();
        return view('lots.edit', compact('lot', 'coproprietes'));
    }

    // ── Mettre à jour ─────────────────────────────────────────────────────────
    public function update(Request $request, Lot $lot): RedirectResponse
    {
        $request->validate([
            'copropriete_id' => ['required', 'exists:coproprietes,id'],
            'numero' => ['required', 'string', 'max:50'],
            'type' => ['required', 'in:appartement,commerce,parking,local'],
            'surface' => ['required', 'numeric', 'min:1'],
            'quote_part' => ['required', 'numeric', 'min:0', 'max:1'],
            'statut' => ['required', 'in:occupe,libre'],
        ]);

        $lot->update($request->only([
            'copropriete_id',
            'numero',
            'type',
            'surface',
            'quote_part',
            'statut'
        ]));

        return redirect()->route('syndic.lots.index')
            ->with('success', 'Lot mis à jour avec succès !');
    }

    // ── Supprimer ─────────────────────────────────────────────────────────────
    public function destroy(Lot $lot): RedirectResponse
    {
        if ($lot->residents()->count() > 0) {
            return redirect()->route('syndic.lots.index')
                ->with('error', 'Impossible de supprimer : ce lot a des résidents associés.');
        }

        $lot->delete();

        return redirect()->route('syndic.lots.index')
            ->with('success', 'Lot supprimé avec succès.');
    }
}