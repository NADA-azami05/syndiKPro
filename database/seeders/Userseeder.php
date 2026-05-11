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
<<<<<<< HEAD
                'name' => 'Admin Syndic',
                'password' => Hash::make('password'),
                'role' => 'syndic',
=======
                'name'     => 'Admin Syndic',
                'password' => Hash::make('password'),
                'role'     => 'syndic',
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
            ]
        );

        // ── Copropriété de test ───────────────────────────────────────────────
        $copropriete = Copropriete::firstOrCreate(
            ['nom' => 'Résidence Al Nour'],
            [
<<<<<<< HEAD
                'adresse' => '12 Rue des Orangers',
                'ville' => 'Casablanca',
                'nb_lots' => 10,
                'budget' => 50000,
=======
                'adresse'    => '12 Rue des Orangers',
                'ville'      => 'Casablanca',
                'nb_lots'    => 10,
                'budget'     => 50000,
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
                'syndic_nom' => 'Admin Syndic',
            ]
        );

        // ── Lot de test ───────────────────────────────────────────────────────
        $lot = Lot::firstOrCreate(
            ['numero' => 'A101', 'copropriete_id' => $copropriete->id],
            [
<<<<<<< HEAD
                'type' => 'appartement',
                'surface' => 85.00,
                'quote_part' => 10.50,
                'statut' => 'occupe',
=======
                'type'       => 'appartement',
                'surface'    => 85.00,
                'quote_part' => 10.50,
                'statut'     => 'occupe',
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
            ]
        );

        // ── Compte Résident de test ───────────────────────────────────────────
        $userResident = User::firstOrCreate(
            ['email' => 'resident@syndicpro.ma'],
            [
<<<<<<< HEAD
                'name' => 'Ahmed Benali',
                'password' => Hash::make('password'),
                'role' => 'resident',
=======
                'name'     => 'Ahmed Benali',
                'password' => Hash::make('password'),
                'role'     => 'resident',
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
            ]
        );

        // ── Profil Résident lié au lot ────────────────────────────────────────
        Resident::firstOrCreate(
            ['user_id' => $userResident->id],
            [
<<<<<<< HEAD
                'lot_id' => $lot->id,
                'type' => 'proprietaire',
                'statut' => 'actif',
=======
                'lot_id'    => $lot->id,
                'type'      => 'proprietaire',
                'statut'    => 'actif',
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
                'telephone' => '+212 6 12 34 56 78',
            ]
        );
    }
}