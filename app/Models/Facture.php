<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
    'resident_id', 'numero', 'mois', 'charges',
    'total', 'statut', 'echeance', 'date_paiement',
    'stripe_payment_intent', 'stripe_client_secret', 'preuve_path'
];

protected $casts = [
    'charges'       => 'array',
    'echeance'      => 'date',
    'date_paiement' => 'date',
];

public function resident() {
    return $this->belongsTo(Resident::class);
}
}
