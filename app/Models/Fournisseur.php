<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
    'nom', 'categorie', 'telephone',
    'email', 'adresse', 'note', 'actif'
];

public function interventions() {
    return $this->hasMany(Intervention::class);
}
}
