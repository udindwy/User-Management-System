<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', fn () => view('dashboard'))->name('users.index');
    Route::get('/jenis-user', fn () => view('dashboard'))->name('jenis-user.index');
    Route::get('/menus', fn () => view('dashboard'))->name('menus.index');
    Route::get('/menu-level', fn () => view('dashboard'))->name('menu-level.index');
    Route::get('/activity-log', fn () => view('dashboard'))->name('activity-log.index');
    Route::get('/error-log', fn () => view('dashboard'))->name('error-log.index');

});

require __DIR__.'/auth.php';
