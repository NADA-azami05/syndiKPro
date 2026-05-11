<?php

namespace Database\Seeders;

use App\Models\Copropriete;
use App\Models\Facture;
use App\Models\Lot;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FactureSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Copropriété ────────────────────────────────────────────────────
        $copro = Copropriete::firstOrCreate(
            ['nom' => 'Résidence Al Andalous'],
            [
                'adresse' => '12 Avenue Hassan II',
                'ville' => 'Rabat',
                'nb_lots' => 10,
                'budget' => 120000,
                'syndic_nom' => 'Mohammed Alami',
            ]
        );

        // ── 2. Lots ───────────────────────────────────────────────────────────
        $lotsData = [
            ['numero' => 'A101', 'type' => 'appartement', 'surface' => 85.00, 'quote_part' => 0.1200, 'statut' => 'occupe'],
            ['numero' => 'A102', 'type' => 'appartement', 'surface' => 70.00, 'quote_part' => 0.0950, 'statut' => 'occupe'],
            ['numero' => 'A201', 'type' => 'appartement', 'surface' => 95.00, 'quote_part' => 0.1400, 'statut' => 'occupe'],
            ['numero' => 'B101', 'type' => 'commerce', 'surface' => 45.00, 'quote_part' => 0.0650, 'statut' => 'occupe'],
            ['numero' => 'P01', 'type' => 'parking', 'surface' => 15.00, 'quote_part' => 0.0200, 'statut' => 'libre'],
        ];

        $lots = [];
        foreach ($lotsData as $data) {
            $lots[] = Lot::firstOrCreate(
                ['copropriete_id' => $copro->id, 'numero' => $data['numero']],
                array_merge($data, ['copropriete_id' => $copro->id])
            );
        }

        // ── 3. Users résidents ────────────────────────────────────────────────
        $residentsData = [
            ['name' => 'Ahmed Benali', 'email' => 'resident@syndicpro.ma', 'lot' => 0],
            ['name' => 'Fatima Zahra', 'email' => 'fatima@syndicpro.ma', 'lot' => 1],
            ['name' => 'Karim Mansouri', 'email' => 'karim@syndicpro.ma', 'lot' => 2],
            ['name' => 'Nadia Chraibi', 'email' => 'nadia@syndicpro.ma', 'lot' => 3],
        ];

        $residents = [];
        foreach ($residentsData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'resident',
                ]
            );

            $resident = Resident::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'lot_id' => $lots[$data['lot']]->id,
                    'type' => 'proprietaire',
                    'statut' => 'actif',
                    'telephone' => '06' . rand(10000000, 99999999),
                ]
            );

            $residents[] = $resident;
        }

        // ── 4. Factures ───────────────────────────────────────────────────────
        $mois = [
            'Janvier 2026',
            'Février 2026',
            'Mars 2026',
            'Avril 2026',
            'Mai 2026',
        ];

        $chargesTypes = [
            ['libelle' => 'Charges communes', 'type' => 'repartition', 'montant' => 8000],
            ['libelle' => 'Entretien ascenseur', 'type' => 'repartition', 'montant' => 2000],
            ['libelle' => 'Gardiennage', 'type' => 'repartition', 'montant' => 3000],
            ['libelle' => 'Eau commune', 'type' => 'repartition', 'montant' => 1500],
            ['libelle' => 'Éclairage parties communes', 'type' => 'fixe', 'montant' => 200],
        ];

        $statuts = ['payee', 'payee', 'envoyee', 'retard', 'en_attente_confirmation'];
        $counter = Facture::count();

        foreach ($residents as $ri => $resident) {
            $lot = $lots[min($ri, count($lots) - 1)];

            foreach ($mois as $mi => $mois_label) {
                $counter++;

                // Calculer les charges selon la quote-part
                $charges = [];
                $total = 0;
                foreach ($chargesTypes as $charge) {
                    $montant = $charge['type'] === 'repartition'
                        ? round($charge['montant'] * $lot->quote_part, 2)
                        : $charge['montant'];
                    $charges[] = [
                        'libelle' => $charge['libelle'],
                        'type' => $charge['type'],
                        'montant' => $montant,
                    ];
                    $total += $montant;
                }

                $statut = $statuts[($ri + $mi) % count($statuts)];
                $echeance = now()->startOfMonth()->subMonths(count($mois) - $mi - 1)->endOfMonth();
                $date_paiement = $statut === 'payee' ? $echeance->copy()->subDays(rand(1, 10)) : null;

                Facture::firstOrCreate(
                    [
                        'resident_id' => $resident->id,
                        'mois' => $mois_label,
                    ],
                    [
                        'numero' => 'FAC-' . date('Y') . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                        'charges' => $charges,
                        'total' => $total,
                        'statut' => $statut,
                        'echeance' => $echeance,
                        'date_paiement' => $date_paiement,
                    ]
                );
            }
        }

        $this->command->info('✅ Seeder Factures : ' . ($counter) . ' factures créées pour ' . count($residents) . ' résidents.');
    }
}