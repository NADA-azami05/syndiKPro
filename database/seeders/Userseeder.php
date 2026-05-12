<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Resident;
use App\Models\Lot;
use App\Models\Copropriete;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Compte Syndic ─────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'syndic@syndicpro.ma'],
            [
                'name'     => 'Admin Syndic',
                'password' => Hash::make('password'),
                'role'     => 'syndic',
            ]
        );

        // ── Copropriété de test ───────────────────────────────────────────────
        $copropriete = Copropriete::firstOrCreate(
            ['nom' => 'Résidence Al Nour'],
            [
                'adresse'    => '12 Rue des Orangers',
                'ville'      => 'Casablanca',
                'nb_lots'    => 10,
                'budget'     => 50000,
                'syndic_nom' => 'Admin Syndic',
            ]
        );

        // ── Lot de test ───────────────────────────────────────────────────────
        $lot = Lot::firstOrCreate(
            ['numero' => 'A101', 'copropriete_id' => $copropriete->id],
            [
                'type'       => 'appartement',
                'surface'    => 85.00,
                'quote_part' => 10.50,
                'statut'     => 'occupe',
            ]
        );

        // ── Compte Résident de test ───────────────────────────────────────────
        $userResident = User::firstOrCreate(
            ['email' => 'resident@syndicpro.ma'],
            [
                'name'     => 'Ahmed Benali',
                'password' => Hash::make('password'),
                'role'     => 'resident',
            ]
        );

        // ── Profil Résident lié au lot ────────────────────────────────────────
        Resident::firstOrCreate(
            ['user_id' => $userResident->id],
            [
                'lot_id'    => $lot->id,
                'type'      => 'proprietaire',
                'statut'    => 'actif',
                'telephone' => '+212 6 12 34 56 78',
            ]
        );
    }
}