<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $fillable = [
        'copropriete_id',
        'titre',
        'date',
        'lieu',
        'ordre_jour',
        'statut',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function copropriete()
    {
        return $this->belongsTo(Copropriete::class);
    }
}