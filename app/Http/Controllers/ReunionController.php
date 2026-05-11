<?php
namespace App\Http\Controllers;

use App\Models\Reunion;
use App\Models\Copropriete;
use App\Services\NotificationService; // ← AJOUTÉ
use Illuminate\Http\Request;

class ReunionController extends Controller
{
    // SYNDIC — liste
    public function index()
    {
        $reunions = Reunion::with('copropriete')->latest('date')->paginate(15);
        return view('reunions.index', compact('reunions'));
    }

    // SYNDIC — formulaire création
    public function create()
    {
        $coproprietes = Copropriete::all();
        return view('reunions.create', compact('coproprietes'));
    }

    // SYNDIC — enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'copropriete_id' => 'required|exists:coproprietes,id',
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'ordre_jour' => 'nullable|string',
        ]);

        $reunion = Reunion::create([
            'copropriete_id' => $request->copropriete_id,
            'titre' => $request->titre,
            'date' => $request->date,
            'lieu' => $request->lieu,
            'ordre_jour' => $request->ordre_jour,
            'statut' => 'planifiee',
        ]);

        // ── NOTIFICATION → Tous les résidents de la copropriété ───
        NotificationService::envoyerACopropriete(
            $request->copropriete_id,
            'Nouvelle réunion planifiée',
            'Une réunion "' . $request->titre . '" est prévue le ' .
            \Carbon\Carbon::parse($request->date)->format('d/m/Y à H:i') .
            ' à ' . $request->lieu . '.',
            'reunion',
            route('resident.reunions.mes')
        );

        return redirect()->route('syndic.reunions.index')
            ->with('success', 'Réunion créée avec succès !');
    }

    // SYNDIC — modifier
    public function edit(Reunion $reunion)
    {
        $coproprietes = Copropriete::all();
        return view('reunions.edit', compact('reunion', 'coproprietes'));
    }

    // SYNDIC — mettre à jour
    public function update(Request $request, Reunion $reunion)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'statut' => 'required|in:planifiee,terminee,annulee',
            'ordre_jour' => 'nullable|string',
        ]);

        $reunion->update($request->all());

        // ── NOTIFICATION → Résidents si statut annulée ────────────
        if ($request->statut === 'annulee') {
            NotificationService::envoyerACopropriete(
                $reunion->copropriete_id,
                'Réunion annulée',
                'La réunion "' . $reunion->titre . '" prévue le ' .
                $reunion->date->format('d/m/Y à H:i') . ' a été annulée.',
                'reunion',
                route('resident.reunions.mes')
            );
        }

        return redirect()->route('syndic.reunions.index')
            ->with('success', 'Réunion mise à jour !');
    }

    // RÉSIDENT — voir les réunions de sa copropriété
    public function mesReunions()
    {
        $resident = auth()->user()->resident;
        $copropriete_id = $resident->lot->copropriete_id ?? null;

        $reunions = Reunion::where('copropriete_id', $copropriete_id)
            ->latest('date')
            ->paginate(10);

        return view('reunions.mes', compact('reunions'));
    }
}