<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
<<<<<<< HEAD
    protected $fillable = [
    'resident_id', 'titre', 'description',
    'priorite', 'statut', 'reponse'
];

public function resident() {
    return $this->belongsTo(Resident::class);
}
public function interventions() {
    return $this->hasMany(Intervention::class);
}
=======
    //
>>>>>>> 5fca6984b59f74e69135a2a24e9501f2852530c6
}
