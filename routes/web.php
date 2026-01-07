<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\http\Controllers\RisikoController;
use App\Http\Controllers\LaporanRisikoController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
    return redirect()->route('dashboard');
});
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::get('/dashboard', fn() => view('dashboard'));

    Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

});
    Route::middleware(['auth'])->group(function () {
    Route::get('/risiko', [RisikoController::class, 'index'])
        ->name('risiko.index');
});

    Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});
    Route::get('/dashboard', function () {
    return view('dashboard');
    })->
    middleware(['auth'])->name('dashboard');

    Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::resource('users', UserController::class);
    });
    Route::patch('/users/{id}/status',
    [UserController::class, 'toggleStatus'])
    ->name('users.toggleStatus');
    
    Route::get('/peta-risiko', [RisikoController::class, 'index'])
    ->name('peta.risiko');
    });

    Route::get('/laporan/daftar-risiko', 
    [LaporanRisikoController::class, 'index'])
    ->name('laporan.daftar.risiko');

    Route::get('/laporan/daftar-risiko', 
    [LaporanRisikoController::class, 'index'])
    ->name('laporan.daftar.risiko');

    Route::get('/laporan/daftar-risiko/create', 
    [LaporanRisikoController::class, 'create'])
    ->name('laporan.daftar.risiko.create');

    Route::post('/laporan/daftar-risiko', 
    [LaporanRisikoController::class, 'store'])
    ->name('laporan.daftar.risiko.store');

require __DIR__.'/auth.php';
