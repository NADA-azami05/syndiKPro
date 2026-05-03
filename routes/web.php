<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// ── Page d'accueil ────────────────────────────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('home');

// ── Auth (invités uniquement) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

// ── Déconnexion ───────────────────────────────────────────────────────────────
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Espace Syndic ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:syndic'])->prefix('syndic')->name('syndic.')->group(function () {
    Route::get('/dashboard', fn() => view('syndic.dashboard'))->name('dashboard');
    // Les autres routes syndic seront ajoutées ici au fil des étapes
});

// ── Espace Résident ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:resident'])->prefix('resident')->name('resident.')->group(function () {
    Route::get('/dashboard', fn() => view('resident.dashboard'))->name('dashboard');
    // Les autres routes résident seront ajoutées ici au fil des étapes
});

