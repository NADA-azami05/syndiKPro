<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Envoyer une notification à un seul user
     */
    public static function envoyer(int $userId, string $titre, string $message, string $type, string $lien = null): void
    {
        Notification::create([
            'user_id' => $userId,
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
            'lien' => $lien,
            'lue' => false,
        ]);
    }

    /**
     * Envoyer une notification à tous les résidents
     */
    public static function envoyerATous(string $titre, string $message, string $type, string $lien = null): void
    {
        $residents = User::where('role', 'resident')->get();

        foreach ($residents as $user) {
            self::envoyer($user->id, $titre, $message, $type, $lien);
        }
    }

    /**
     * Envoyer aux résidents d'une copropriété spécifique
     */
    public static function envoyerACopropriete(int $coproprieteId, string $titre, string $message, string $type, string $lien = null): void
    {
        $userIds = \App\Models\Resident::whereHas('lot', function ($q) use ($coproprieteId) {
            $q->where('copropriete_id', $coproprieteId);
        })->pluck('user_id');

        foreach ($userIds as $userId) {
            self::envoyer($userId, $titre, $message, $type, $lien);
        }
    }
}