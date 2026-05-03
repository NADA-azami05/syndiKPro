<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
<<<<<<< HEAD
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
=======
    //
>>>>>>> 5fca6984b59f74e69135a2a24e9501f2852530c6
}
