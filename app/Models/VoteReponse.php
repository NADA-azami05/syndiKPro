<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteReponse extends Model
{
    protected $fillable = [
    'vote_id', 'resident_id', 'choix'
];

public function vote() {
    return $this->belongsTo(Vote::class);
}
public function resident() {
    return $this->belongsTo(Resident::class);
}
}
