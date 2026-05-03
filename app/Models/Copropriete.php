<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Copropriete extends Model
{
    protected $fillable = [
    'nom', 'adresse', 'ville',
    'nb_lots', 'budget', 'syndic_nom'
];

public function lots() {
    return $this->hasMany(Lot::class);
}
public function annonces() {
    return $this->hasMany(Annonce::class);
}
public function votes() {
    return $this->hasMany(Vote::class);
}
public function reunions() {
    return $this->hasMany(Reunion::class);
}
public function interventions() {
    return $this->hasMany(Intervention::class);
}
}
