<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $fillable = [
        'resident_id',
        'titre',
        'description',
        'priorite',
        'statut',
        'reponse'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}