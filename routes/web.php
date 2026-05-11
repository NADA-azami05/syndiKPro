<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoproprieteController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Espace Syndic ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:syndic'])
    ->prefix('syndic')
    ->name('syndic.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('coproprietes', CoproprieteController::class);
        Route::resource('lots', LotController::class);

        Route::resource('fournisseurs', FournisseurController::class);
        Route::post('fournisseurs/{fournisseur}/noter', [FournisseurController::class, 'noter'])
             ->name('fournisseurs.noter');

        Route::resource('interventions', InterventionController::class)
             ->only(['index', 'create', 'store', 'show', 'destroy']);

        // ✅ Votes syndic
        Route::resource('votes', VoteController::class)
             ->only(['index', 'create', 'store', 'show']);
        Route::patch('votes/{vote}/cloturer', [VoteController::class, 'cloturer'])
             ->name('votes.cloturer');
    });

// ── Espace Résident ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:resident'])
    ->prefix('resident')
    ->name('resident.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'resident'])->name('dashboard');

        // ✅ Votes résident
        Route::resource('votes', VoteController::class)
             ->only(['index', 'show']);
        Route::post('votes/{vote}/voter', [VoteController::class, 'voter'])
             ->name('votes.voter');
    });