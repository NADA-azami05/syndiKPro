<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lot;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResidentController extends Controller
{
    // ── Liste des résidents ───────────────────────────────────────────────────
    public function index()
    {
        $residents = User::where('role', 'resident')
            ->with(['resident.lot'])
            ->paginate(10);

        return view('syndic.residents.index', compact('residents'));
    }

    // ── Formulaire création ───────────────────────────────────────────────────
    public function create()
    {
        $lots = Lot::all();
        return view('syndic.residents.create', compact('lots'));
    }

    // ── Enregistrer un nouveau résident ──────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'lot_id'   => 'required|exists:lots,id',
            'type'     => 'nullable|in:proprietaire,locataire',
            'password' => 'required|min:8|confirmed',
        ]);

        // 1. Créer le compte User
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'lot_id'   => $request->lot_id,
            'role'     => 'resident',
            'password' => Hash::make($request->password),
        ]);

        // 2. Créer le profil Resident lié ← correction du bug
        Resident::create([
            'user_id'   => $user->id,
            'lot_id'    => $request->lot_id,
            'type'      => $request->type ?? 'proprietaire',
            'statut'    => 'actif',
            'telephone' => $request->phone,
        ]);

        // 3. Marquer le lot comme occupé
        Lot::where('id', $request->lot_id)
            ->update(['statut' => 'occupe']);

        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident créé avec succès.');
    }

    // ── Afficher un résident ──────────────────────────────────────────────────
    public function show(User $resident)
    {
        $resident->load(['resident.lot']);
        return view('syndic.residents.show', compact('resident'));
    }

    // ── Formulaire modification ───────────────────────────────────────────────
    public function edit(User $resident)
    {
        $lots = Lot::all();
        $resident->load('resident');
        return view('syndic.residents.edit', compact('resident', 'lots'));
    }

    // ── Mettre à jour un résident ─────────────────────────────────────────────
    public function update(Request $request, User $resident)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $resident->id,
            'phone'    => 'nullable|string|max:20',
            'lot_id'   => 'required|exists:lots,id',
            'type'     => 'nullable|in:proprietaire,locataire',
            'statut'   => 'nullable|in:actif,inactif',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // 1. Mettre à jour le User
        $resident->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'lot_id' => $request->lot_id,
        ]);

        // 2. Mettre à jour ou créer le profil Resident ← correction du bug
        Resident::updateOrCreate(
            ['user_id' => $resident->id],
            [
                'lot_id'    => $request->lot_id,
                'type'      => $request->type ?? 'proprietaire',
                'statut'    => $request->statut ?? 'actif',
                'telephone' => $request->phone,
            ]
        );

        // 3. Mettre à jour le statut du lot
        Lot::where('id', $request->lot_id)
            ->update(['statut' => 'occupe']);

        // 4. Mettre à jour le mot de passe si fourni
        if ($request->filled('password')) {
            $resident->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident modifié avec succès.');
    }

    // ── Supprimer un résident ─────────────────────────────────────────────────
    public function destroy(User $resident)
    {
        // Libérer le lot avant suppression
        if ($resident->resident && $resident->resident->lot_id) {
            Lot::where('id', $resident->resident->lot_id)
                ->update(['statut' => 'libre']);
        }

        // Supprimer le profil Resident (si pas de cascade en BDD)
        if ($resident->resident) {
            $resident->resident->delete();
        }

        $resident->delete();

        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident supprimé avec succès.');
    }
}