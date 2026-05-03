<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
    'fournisseur_id', 'copropriete_id', 'reclamation_id',
    'titre', 'description', 'date_intervention', 'cout', 'statut'
];

protected $casts = [
    'date_intervention' => 'date',
];

public function fournisseur() {
    return $this->belongsTo(Fournisseur::class);
}
public function copropriete() {
    return $this->belongsTo(Copropriete::class);
}
public function reclamation() {
    return $this->belongsTo(Reclamation::class);
}
}
