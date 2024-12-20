<?php

use App\Http\Controllers\ConditionController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/conditions', [ConditionController::class, 'index'])->name('conditions.index');
    Route::post('/conditions/store', [ConditionController::class, 'store'])->name('conditions.store');

    Route::get('/conditions/history', [ConditionController::class, 'history'])->name('conditions.history');
    Route::get('/conditions/graph', [ConditionController::class, 'graph'])->name('conditions.graph');
    Route::get('/conditions/cycle', [ConditionController::class, 'cycle'])->name('conditions.cycle');
});

require __DIR__.'/auth.php';
