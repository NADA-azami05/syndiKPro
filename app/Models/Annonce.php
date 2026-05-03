<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
    'user_id', 'copropriete_id',
    'titre', 'contenu', 'type', 'publiee'
];

public function user() {
    return $this->belongsTo(User::class);
}
public function copropriete() {
    return $this->belongsTo(Copropriete::class);
}
}
