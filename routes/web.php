<?php

use App\Http\Controllers\DivisiUmumRisikoController;
use App\Http\Controllers\DivisiHublangRisikoController;
use App\Http\Controllers\DivisiKepegawaianRisikoController;
use App\Http\Controllers\DivisiLegalDraftingRisikoController;
use App\Http\Controllers\DivisiTunggakanRekeningAirRisikoController;
use App\Http\Controllers\DivisiPenerbitRekeningRisikoController;
use App\Http\Controllers\DivisiPenyegelanPemasanganWmRisikoController;
use App\Http\Controllers\DivisiPengaduanPelangganRisikoController;
use App\Http\Controllers\DivisiPerencanaanAnggaranRisikoController;
use App\Http\Controllers\DivisiPembukuanRisikoController;
use App\Http\Controllers\DivisiKasPenagihanRisikoController;
use App\Http\Controllers\UnitLaweLaweRisikoController;
use App\Http\Controllers\UnitSepakuRisikoController;
use App\Http\Controllers\UnitWaruRisikoController;
use App\Http\Controllers\UnitSotekRisikoController;
use App\Http\Controllers\UnitMaridanRisikoController;
use App\Http\Controllers\UnitbabuluRisikoController;
use App\Http\Controllers\DivisiLaboratoriumRisikoController;
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

    // ==== DIVISI UMUM ====
    Route::middleware(['auth'])
    ->prefix('divisi/umum')
    ->name('divisi_umum.')
    ->group(function () {

        Route::get('/risiko', [DivisiUmumRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiUmumRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiUmumRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiUmumRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiUmumRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiUmumRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });
    //// DIVISI UMUM

///---------------------------
    /// DIVISI HUBLANG
    Route::middleware(['auth'])
    ->prefix('divisi/hublang')
    ->name('divisi_hublang.')
    ->group(function () {

        Route::get('/risiko', [DivisiHublangRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiHublangRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiHublangRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiHublangRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiHublangRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiHublangRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });
    /// DIVISI HUBLANG
///------------------

    /// DIVISI KEPEGAWAIAN
Route::middleware(['auth'])
    ->prefix('divisi/kepegawaian')
    ->name('divisi_kepegawaian.')
    ->group(function () {

        Route::get('/risiko', [DivisiKepegawaianRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiKepegawaianRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiKepegawaianRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiKepegawaianRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiKepegawaianRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiKepegawaianRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

    /// DIVISI LEGAL DRAFTING
    Route::middleware(['auth'])
    ->prefix('divisi/legal_drafting')
    ->name('divisi_legal_drafting.')
    ->group(function () {

        Route::get('/risiko', [DivisiLegalDraftingRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiLegalDraftingRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiLegalDraftingRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiLegalDraftingRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiLegalDraftingRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiLegalDraftingRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

/// DIVISI TUNGGAKAN REKENING AIR

    Route::middleware(['auth'])
    ->prefix('divisi/tunggakan_rekening_air')
    ->name('divisi_tunggakan_rekening_air.')
    ->group(function () {

        Route::get('/risiko', [DivisiTunggakanRekeningAirRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiTunggakanRekeningAirRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiTunggakanRekeningAirRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiTunggakanRekeningAirRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiTunggakanRekeningAirRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiTunggakanRekeningAirRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

//// DIVISI PENERBIT REKENING 
    Route::middleware(['auth'])
    ->prefix('divisi/penerbit_rekening')
    ->name('divisi_penerbit_rekening.')
    ->group(function () {

        Route::get('/risiko', [DivisiPenerbitRekeningRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiPenerbitRekeningRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiPenerbitRekeningRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiPenerbitRekeningRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiPenerbitRekeningRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiPenerbitRekeningRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

    //// DIVISI PENERBIT REKENING 
    Route::middleware(['auth'])
    ->prefix('divisi/penyegelan_pemasangan_wm')
    ->name('divisi_penyegelan_pemasangan_wm.')
    ->group(function () {

        Route::get('/risiko', [DivisiPenyegelanPemasanganWmRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiPenyegelanPemasanganWmRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiPenyegelanPemasanganWmRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiPenyegelanPemasanganWmRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiPenyegelanPemasanganWmRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiPenyegelanPemasanganWmRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

    //// DIVISI PENGADUAN PELANGGAN
    Route::middleware(['auth'])
    ->prefix('divisi/pengaduan_pelanggan')
    ->name('divisi_pengaduan_pelanggan.')
    ->group(function () {

        Route::get('/risiko', [DivisiPengaduanPelangganRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiPengaduanPelangganRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiPengaduanPelangganRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiPengaduanPelangganRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiPengaduanPelangganRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiPengaduanPelangganRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

    //// DIVISI PERENCANAAN ANGGARAN
    Route::middleware(['auth'])
    ->prefix('divisi/perencanaan_anggaran')
    ->name('divisi_perencanaan_anggaran.')
    ->group(function () {

        Route::get('/risiko', [DivisiPerencanaanAnggaranRisikoController::class, 'index'])
            ->name('risiko.index');

        Route::get('/risiko/create', [DivisiPerencanaanAnggaranRisikoController::class, 'create'])
            ->name('risiko.create');

        Route::post('/risiko', [DivisiPerencanaanAnggaranRisikoController::class, 'store'])
            ->name('risiko.store');

        Route::get('/risiko/{id}/edit', [DivisiPerencanaanAnggaranRisikoController::class, 'edit'])
            ->name('risiko.edit');

        Route::put('/risiko/{id}', [DivisiPerencanaanAnggaranRisikoController::class, 'update'])
            ->name('risiko.update');

        Route::delete('/risiko/{id}', [DivisiPerencanaanAnggaranRisikoController::class, 'destroy'])
            ->name('risiko.destroy');
    });

require __DIR__.'/auth.php';
