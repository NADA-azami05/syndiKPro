<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteReponse extends Model
{
<<<<<<< HEAD
    protected $fillable = [
    'vote_id', 'resident_id', 'choix'
];

public function vote() {
    return $this->belongsTo(Vote::class);
}
public function resident() {
    return $this->belongsTo(Resident::class);
}
=======
    //
>>>>>>> 5fca6984b59f74e69135a2a24e9501f2852530c6
}
