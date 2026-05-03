<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
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
}
