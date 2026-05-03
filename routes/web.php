<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'role:syndic'])->group(function () {
    Route::get('/dashboard/syndic', [DashboardController::class, 'index'])->name('dashboard.syndic');
});

Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/dashboard/resident', [DashboardController::class, 'resident'])->name('dashboard.resident');
});

