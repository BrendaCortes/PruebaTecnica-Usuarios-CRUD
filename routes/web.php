<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

/*
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/usuarios', [UserController::class, 'addUser'])->name('usuarios.addUser');
Route::put('/usuarios/{user}', [UserController::class, 'updateUser'])->name('usuarios.updateUser');
Route::delete('/usuarios/{user}', [UserController::class, 'deleteUser'])->name('usuarios.deleteUser');
Route::get('/usuarios/export', [UserController::class, 'export'])->name('usuarios.export');
*/


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/usuarios/export', [UserController::class, 'export'])->name('usuarios.export');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::post('/usuarios', [UserController::class, 'addUser'])->name('usuarios.addUser');
    Route::put('/usuarios/{user}', [UserController::class, 'updateUser'])->name('usuarios.updateUser');
    Route::delete('/usuarios/{user}', [UserController::class, 'deleteUser'])->name('usuarios.deleteUser');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
