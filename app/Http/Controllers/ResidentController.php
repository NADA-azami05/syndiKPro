<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = User::where('role', 'resident')
            ->with('lot')
            ->paginate(10);
        return view('syndic.residents.index', compact('residents'));
    }

    public function create()
    {
        $lots = Lot::all();
        return view('syndic.residents.create', compact('lots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'lot_id' => 'required|exists:lots,id',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'lot_id' => $request->lot_id,
            'role' => 'resident',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident créé avec succès.');
    }

    public function edit(User $resident)
    {
        $lots = Lot::all();
        return view('syndic.residents.edit', compact('resident', 'lots'));
    }

    public function update(Request $request, User $resident)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $resident->id,
            'phone' => 'nullable|string|max:20',
            'lot_id' => 'required|exists:lots,id',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $resident->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'lot_id' => $request->lot_id,
        ]);

        if ($request->filled('password')) {
            $resident->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident modifié avec succès.');
    }

    public function destroy(User $resident)
    {
        $resident->delete();
        return redirect()->route('syndic.residents.index')
            ->with('success', 'Résident supprimé.');
    }
}