<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'message',
        'type',
        'lien',
        'lue',
    ];

    protected $casts = [
        'lue' => 'boolean',
    ];

    // Relation vers le user destinataire
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Icône selon le type
    public function getIconeAttribute(): string
    {
        return match ($this->type) {
            'annonce' => '📣',
            'reunion' => '📅',
            'reclamation' => '📢',
            'facture' => '📄',
            'general' => '🔔',
            default => '🔔',
        };
    }

    // Couleur badge selon le type
    public function getCouleurAttribute(): string
    {
        return match ($this->type) {
            'annonce' => '#006AD7',
            'reunion' => '#7c3aed',
            'reclamation' => '#d97706',
            'facture' => '#16a34a',
            'general' => '#6b7280',
            default => '#6b7280',
        };
    }
}