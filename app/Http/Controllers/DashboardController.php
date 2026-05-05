<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Facture;
use App\Models\Reclamation;
use App\Models\Fournisseur;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.syndic', [
            'nb_residents' => Resident::where('statut', 'actif')->count(),
            'nb_factures_attente' => Facture::whereIn('statut', ['envoyee', 'retard'])->count(),
            'nb_reclamations' => Reclamation::where('statut', 'en_attente')->count(),
            'total_recouvre' => Facture::where('statut', 'payee')->sum('total'),
            'nb_fournisseurs' => Fournisseur::where('actif', true)->count(),
        ]);
    }

    public function resident()
    {
        $resident = auth()->user()->resident;

        if (!$resident) {
            return view('dashboard.resident', [
                'resident' => null,
                'factures' => collect(),
                'reclamations' => collect(),
            ]);
        }

        return view('dashboard.resident', [
            'resident' => $resident,
            'factures' => $resident->factures()->latest()->take(5)->get(),
            'reclamations' => $resident->reclamations()->latest()->take(3)->get(),
        ]);
    }
}