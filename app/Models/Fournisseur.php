<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
<<<<<<< HEAD
    protected $fillable = [
    'nom', 'categorie', 'telephone',
    'email', 'adresse', 'note', 'actif'
];

public function interventions() {
    return $this->hasMany(Intervention::class);
}
=======
    //
>>>>>>> 5fca6984b59f74e69135a2a24e9501f2852530c6
}
