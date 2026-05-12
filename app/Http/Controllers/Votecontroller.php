<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\VoteReponse;
use App\Models\Copropriete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Liste tous les votes
     * Syndic : tous | Résident : ouverts seulement
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'syndic') {
            $votes = Vote::with('copropriete')
                ->withCount('reponses')
                ->latest()
                ->paginate(10);
        } else {
            $votes = Vote::with('copropriete')
                ->where('statut', 'ouvert')
                ->where('date_fin', '>=', now())
                ->withCount('reponses')
                ->latest()
                ->paginate(10);
        }

        return view('votes.index', compact('votes'));
    }

    /**
     * Formulaire de création (syndic seulement)
     */
    public function create()
    {
        abort_if(Auth::user()->role !== 'syndic', 403);
        $coproprietes = Copropriete::orderBy('nom')->get();
        return view('votes.create', compact('coproprietes'));
    }

    /**
     * Enregistre un nouveau vote
     */
    public function store(Request $request)
    {
        abort_if(Auth::user()->role !== 'syndic', 403);

        $validated = $request->validate([
            'copropriete_id' => 'required|exists:coproprietes,id',
            'titre'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'options'        => 'required|array|min:2',
            'options.*'      => 'required|string|max:255',
            'date_fin'       => 'required|date|after:now',
        ], [
            'copropriete_id.required' => 'Veuillez sélectionner une copropriété.',
            'titre.required'          => 'Le titre est obligatoire.',
            'options.min'             => 'Il faut au moins 2 options.',
            'options.*.required'      => 'Chaque option doit avoir un libellé.',
            'date_fin.after'          => 'La date de fin doit être dans le futur.',
        ]);

        // Filtrer les options vides
        $validated['options'] = array_values(array_filter($validated['options']));

        Vote::create($validated);

        return redirect()->route('syndic.votes.index')
            ->with('success', 'Vote créé avec succès.');
    }

    /**
     * Affiche les détails + résultats en % d'un vote
     */
    public function show(Vote $vote)
    {
        $user = Auth::user();
        $vote->load('copropriete', 'reponses');

        $totalReponses = $vote->reponses->count();
        $resultats = [];

        foreach ($vote->options as $option) {
            $count = $vote->reponses->where('choix', $option)->count();
            $resultats[$option] = [
                'count'       => $count,
                'pourcentage' => $totalReponses > 0
                    ? round(($count / $totalReponses) * 100, 1)
                    : 0,
            ];
        }

        $aDejaVote = false;
        if ($user->role === 'resident' && $user->resident) {
            $aDejaVote = VoteReponse::where('vote_id', $vote->id)
                ->where('resident_id', $user->resident->id)
                ->exists();
        }

        return view('votes.show', compact('vote', 'resultats', 'totalReponses', 'aDejaVote'));
    }

    /**
     * Enregistre le vote d'un résident
     */
    public function voter(Request $request, Vote $vote)
    {
        abort_if(Auth::user()->role !== 'resident', 403);

        $resident = Auth::user()->resident;

        if ($vote->statut === 'ferme') {
            return back()->with('error', 'Ce vote est clôturé.');
        }

        if ($vote->date_fin->isPast()) {
            return back()->with('error', 'La période de vote est terminée.');
        }

        $dejaVote = VoteReponse::where('vote_id', $vote->id)
            ->where('resident_id', $resident->id)
            ->exists();

        if ($dejaVote) {
            return back()->with('error', 'Vous avez déjà participé à ce vote.');
        }

        $request->validate([
            'choix' => 'required|string|in:' . implode(',', $vote->options),
        ], [
            'choix.required' => 'Veuillez sélectionner une option.',
            'choix.in'       => 'Option invalide.',
        ]);

        VoteReponse::create([
            'vote_id'     => $vote->id,
            'resident_id' => $resident->id,
            'choix'       => $request->choix,
        ]);

       
return redirect()->route('resident.votes.show', $vote)  
    ->with('success', 'Votre vote a été enregistré avec succès.');
    }

    /**
     * Clôturer un vote (syndic seulement)
     */
    public function cloturer(Vote $vote)
    {
        abort_if(Auth::user()->role !== 'syndic', 403);

        if ($vote->statut === 'ferme') {
            return back()->with('error', 'Ce vote est déjà clôturé.');
        }

        $vote->update(['statut' => 'ferme']);

        return redirect()->route('syndic.votes.index')
            ->with('success', "Le vote « {$vote->titre} » a été clôturé.");
    }
}