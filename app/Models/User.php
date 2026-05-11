<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'stripe_customer_id',
        'phone',      // ← ajouté
        'lot_id',     // ← ajouté
    ];

    // ─── Relations ───────────────────────────────────────────

    public function lot()
    {
        return $this->belongsTo(Lot::class); // ← ajouté
    }

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'resident_id');
    }

    public function resident()
    {
        return $this->hasOne(Resident::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    // ─── Helpers ─────────────────────────────────────────────

    public function isSyndic()
    {
        return $this->role === 'syndic';
    }

    public function isResident()
    {
        return $this->role === 'resident';
    }

    // ─── Hidden & Casts ──────────────────────────────────────

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}