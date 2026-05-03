<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
    'copropriete_id', 'titre',
    'description', 'options', 'statut', 'date_fin'
];

protected $casts = [
    'options'  => 'array',
    'date_fin' => 'datetime',
];

public function copropriete() {
    return $this->belongsTo(Copropriete::class);
}
public function reponses() {
    return $this->hasMany(VoteReponse::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
}
