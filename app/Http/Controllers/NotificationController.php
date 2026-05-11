<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Liste toutes les notifications du résident connecté
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        // Marquer toutes comme lues automatiquement à l'ouverture
        Notification::where('user_id', auth()->id())
            ->where('lue', false)
            ->update(['lue' => true]);

        return view('notifications.index', compact('notifications'));
    }

    // Marquer une seule comme lue (appel AJAX ou lien)
    public function marquerLue(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['lue' => true]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect($notification->lien ?? route('resident.notifications.index'));
    }

    // Marquer toutes comme lues
    public function marquerToutesLues()
    {
        Notification::where('user_id', auth()->id())
            ->where('lue', false)
            ->update(['lue' => true]);

        return back()->with('success', 'Toutes les notifications marquées comme lues.');
    }

    // Supprimer une notification
    public function destroy(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->delete();
        return back()->with('success', 'Notification supprimée.');
    }

    // API JSON — nombre de non lues (pour la cloche en temps réel)
    public function count()
    {
        $count = Notification::where('user_id', auth()->id())
            ->where('lue', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}