<?php

use App\Http\Controllers\ConditionController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MenstruationController; 

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
     // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 体調記録の基本機能
    Route::get('/conditions', [ConditionController::class, 'index'])->name('conditions.index');
    Route::post('/conditions/store', [ConditionController::class, 'store'])->name('conditions.store');

     // 体調記録の表示機能
    Route::get('/conditions/history', [ConditionController::class, 'history'])->name('conditions.history');
    Route::get('/conditions/graph', [ConditionController::class, 'graph'])->name('conditions.graph');
    Route::get('/conditions/cycle', [ConditionController::class, 'cycle'])->name('conditions.cycle');

    // 追加: 編集と更新のルート
    Route::get('/conditions/{condition}/edit', [ConditionController::class, 'edit'])->name('conditions.edit');
    Route::put('/conditions/{condition}', [ConditionController::class, 'update'])->name('conditions.update');
    Route::delete('/conditions/{condition}', [ConditionController::class, 'destroy'])->name('conditions.destroy');

    // 月経記録関連のルート
    Route::get('/menstruation', [MenstruationController::class, 'index'])->name('menstruation.index');
    Route::get('/menstruation/create', [MenstruationController::class, 'create'])->name('menstruation.create');
    Route::post('/menstruation', [MenstruationController::class, 'store'])->name('menstruation.store');
    Route::post('/menstruation/end', [MenstruationController::class, 'storeEnd'])->name('menstruation.storeEnd');
});

require __DIR__.'/auth.php';
