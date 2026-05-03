<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
    'user_id', 'lot_id',
    'type', 'statut', 'telephone'
];

public function user() {
    return $this->belongsTo(User::class);
}
public function lot() {
    return $this->belongsTo(Lot::class);
}
public function factures() {
    return $this->hasMany(Facture::class);
}
public function reclamations() {
    return $this->hasMany(Reclamation::class);
}
public function voteReponses() {
    return $this->hasMany(VoteReponse::class);
}
}
