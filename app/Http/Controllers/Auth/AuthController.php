<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // ── Afficher login ────────────────────────────────────────────────────────
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // ── Traiter login ─────────────────────────────────────────────────────────
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()
                ->withErrors(['email' => 'Aucun compte trouvé avec cet email.'])
                ->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return Auth::user()->isSyndic()
                ? redirect()->route('syndic.dashboard')
                    ->with('success', 'Bienvenue ' . Auth::user()->name . ' !')
                : redirect()->route('resident.dashboard')
                    ->with('success', 'Bienvenue ' . Auth::user()->name . ' !');
        }

        return back()
            ->withErrors(['email' => 'Email ou mot de passe incorrect.'])
            ->onlyInput('email');
    }

    // ── Afficher register ─────────────────────────────────────────────────────
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // ── Traiter register (syndic uniquement via formulaire public) ────────────
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // hashé via cast
            'role'     => 'syndic',
        ]);

        Auth::login($user);

        return redirect()->route('syndic.dashboard')
            ->with('success', 'Compte créé avec succès !');
    }

    // ── Déconnexion ───────────────────────────────────────────────────────────
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Vous avez été déconnecté.');
    }
}