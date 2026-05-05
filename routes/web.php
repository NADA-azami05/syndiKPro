<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// ── Page d'accueil ────────────────────────────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('home');

// ── Auth (invités uniquement) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ── Déconnexion ───────────────────────────────────────────────────────────────
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Espace Syndic ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:syndic'])
    ->prefix('syndic')
    ->name('syndic.')
    ->group(function () {

        // Dashboard — données BDD via DashboardController
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // À ajouter aux prochaines étapes :
        // Route::resource('residents',    ResidentController::class);
        // Route::resource('lots',         LotController::class);
        // Route::resource('factures',     FactureController::class);
        // Route::resource('reclamations', ReclamationController::class);
        // Route::resource('fournisseurs', FournisseurController::class);
        // Route::resource('votes',        VoteController::class);
        // Route::resource('annonces',     AnnonceController::class);
        // Route::resource('reunions',     ReunionController::class);
    });

// ── Espace Résident ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:resident'])
    ->prefix('resident')
    ->name('resident.')
    ->group(function () {

        // Dashboard — données BDD via DashboardController
        Route::get('/dashboard', [DashboardController::class, 'resident'])->name('dashboard');

        // À ajouter aux prochaines étapes :
        // Route::get('factures',          [FactureController::class, 'index'])->name('factures.index');
        // Route::get('reclamations',      [ReclamationController::class, 'index'])->name('reclamations.index');
        // Route::get('votes',             [VoteController::class, 'index'])->name('votes.index');
        // Route::get('annonces',          [AnnonceController::class, 'index'])->name('annonces.index');
        // Route::get('reunions',          [ReunionController::class, 'index'])->name('reunions.index');
    });