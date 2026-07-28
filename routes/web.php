<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'menu.access'])->group(function () {

    Route::get('/profile', fn () => view('dashboard'))->name('profile.edit');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/foto', [UserController::class, 'uploadFoto'])->name('foto');
        Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{user}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    });

    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('menu-access')->name('menu-access.')->group(function () {
        Route::get('/', [\App\Http\Controllers\MenuAccessController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [\App\Http\Controllers\MenuAccessController::class, 'edit'])->name('edit');
        Route::put('/{user}', [\App\Http\Controllers\MenuAccessController::class, 'update'])->name('update');
    });

    Route::get('/activity-log', fn () => view('dashboard'))->name('activity-log.index');
    Route::get('/error-log', fn () => view('dashboard'))->name('error-log.index');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__ . '/auth.php';
