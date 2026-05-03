<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
<<<<<<< HEAD
   protected $fillable = [
    'copropriete_id', 'numero',
    'type', 'surface', 'quote_part', 'statut'
];

public function copropriete() {
    return $this->belongsTo(Copropriete::class);
}
public function resident() {
    return $this->hasOne(Resident::class);
}
=======
    //
>>>>>>> 5fca6984b59f74e69135a2a24e9501f2852530c6
}
