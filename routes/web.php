<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoproprieteController;
<<<<<<< HEAD
use App\Http\Controllers\LotController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FournisseurController; // ← AJOUTÉ
use App\Http\Controllers\InterventionController; // ← AJOUTÉ
use App\Http\Controllers\VoteController;         // ← AJOUTÉ
=======
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\VoteController;
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;

Route::get('/', fn() => view('welcome'))->name('home');

<<<<<<< HEAD
// ── Auth ──────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
=======
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
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
<<<<<<< HEAD
        Route::resource('factures', FactureController::class);
        Route::resource('residents', ResidentController::class);

        Route::get('factures/{facture}/pdf', [FactureController::class, 'pdf'])->name('factures.pdf');

        Route::resource('reclamations', ReclamationController::class)->only(['index', 'show']);
        Route::post('reclamations/{reclamation}/statut', [ReclamationController::class, 'updateStatut'])->name('reclamations.statut');

        Route::resource('reunions', ReunionController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);

        Route::resource('annonces', AnnonceController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

        // ── FOURNISSEURS ──────────────────────────────────────────
        Route::resource('fournisseurs', FournisseurController::class);
        Route::post('fournisseurs/{fournisseur}/noter', [FournisseurController::class, 'noter'])->name('fournisseurs.noter');

        // ── INTERVENTIONS ─────────────────────────────────────────
        Route::resource('interventions', InterventionController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

        // ── VOTES ─────────────────────────────────────────────────
        Route::resource('votes', VoteController::class)->only(['index', 'create', 'store', 'show']);
        Route::patch('votes/{vote}/cloturer', [VoteController::class, 'cloturer'])->name('votes.cloturer');

        // ── NOTIFICATIONS ─────────────────────────────────────────
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('notifications/toutes-lues', [NotificationController::class, 'marquerToutesLues'])->name('notifications.toutes-lues');
        Route::post('notifications/{notification}/lue', [NotificationController::class, 'marquerLue'])->name('notifications.lue');
        Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::get('notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
=======

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
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
    });

// ── Espace Résident ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:resident'])
    ->prefix('resident')
    ->name('resident.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'resident'])->name('dashboard');

<<<<<<< HEAD
        Route::get('mes-factures', [FactureController::class, 'mesFactures'])->name('factures.mes');
        Route::get('factures/{facture}/paiement', [FactureController::class, 'initierPaiement'])->name('factures.paiement');
        Route::post('factures/{facture}/confirmer', [FactureController::class, 'confirmerPaiement'])->name('factures.confirmer');
        Route::get('factures/{facture}/pdf', [FactureController::class, 'pdf'])->name('factures.pdf');

        Route::get('reclamations', [ReclamationController::class, 'mesReclamations'])->name('reclamations.mes');
        Route::get('reclamations/create', [ReclamationController::class, 'create'])->name('reclamations.create');
        Route::post('reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');

        Route::get('reunions', [ReunionController::class, 'mesReunions'])->name('reunions.mes');

        Route::get('annonces', [AnnonceController::class, 'mesAnnonces'])->name('annonces.index');

        // ── VOTES RÉSIDENT ────────────────────────────────────────
        Route::resource('votes', VoteController::class)->only(['index', 'show']);
        Route::post('votes/{vote}/voter', [VoteController::class, 'voter'])->name('votes.voter');

        // ── NOTIFICATIONS ─────────────────────────────────────────
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('notifications/toutes-lues', [NotificationController::class, 'marquerToutesLues'])->name('notifications.toutes-lues');
        Route::post('notifications/{notification}/lue', [NotificationController::class, 'marquerLue'])->name('notifications.lue');
        Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::get('notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
    });

// ── Webhook Stripe (sans auth) ────────────────────────────────────────────────
Route::post('/stripe/webhook', [FactureController::class, 'webhook'])->name('stripe.webhook');
=======
        // ✅ Votes résident
        Route::resource('votes', VoteController::class)
             ->only(['index', 'show']);
        Route::post('votes/{vote}/voter', [VoteController::class, 'voter'])
             ->name('votes.voter');
    });
>>>>>>> 23e859eb1341ed83e8908e12cbdbb8afac276d95
