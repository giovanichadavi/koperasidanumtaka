<?php

use App\Http\Controllers\DivisiUmumRisikoController;
use App\Http\Controllers\DivisiHublangRisikoController;
use App\Http\Controllers\DivisiKepegawaianRisikoController;
use App\Http\Controllers\DivisiLegalDraftingRisikoController;
use App\Http\Controllers\DivisiTunggakanRekeningAirRisikoController;
use App\Http\Controllers\DivisiPenerbitRekeningRisikoController;
use App\Http\Controllers\DivisiPenyegelanPemasanganWMRisikoController;
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

    // ==== DIVISI ====
    Route::middleware(['auth'])->prefix('divisi/umum')->group(function () {

    Route::get('/risiko', [DivisiUmumRisikoController::class, 'index'])
        ->name('divisi_umum.risiko.index');

    Route::get('/risiko/create', [DivisiUmumRisikoController::class, 'create'])
        ->name('divisi_umum.risiko.create');

    Route::post('/risiko', [DivisiUmumRisikoController::class, 'store'])
        ->name('divisi_umum.risiko.store');
});

    Route::middleware(['auth','role:divisi_hublang'])->prefix('divisi/hublang')->group(function () {
    Route::get('/risiko', [DivisiHublangRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiHublangRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiHublangRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_kepegawaian'])->prefix('divisi/kepegawaian')->group(function () {
    Route::get('/risiko', [DivisiKepegawaianRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiKepegawaianRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiKepegawaianRisikoController::class, 'store']);
    });


    Route::middleware(['auth','role:divisi_legal_drafting'])->prefix('divisi/hukum')->group(function () {
    Route::get('/risiko', [DivisiLegalDraftingRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiLegalDraftingRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiLegalDraftingRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_tunggakan_rekening_air'])->prefix('divisi/perencanaananggaran')->group(function () {
    Route::get('/risiko', [DivisiTunggakanRekeningAirRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiTunggakanRekeningAirRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiTunggakanRekeningAirRisikoController::class, 'store']);
    });
    
    Route::middleware(['auth','role:divisi_penerbit_rekening'])->prefix('divisi/perencanaananggaran')->group(function () {
    Route::get('/risiko', [DivisiPenerbitRekeningRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiPenerbitRekeningRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiPenerbitRekeningRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_penyegelan_pemasangan_WM'])->prefix('divisi/perencanaananggaran')->group(function () {
    Route::get('/risiko', [DivisiPenyegelanPemasanganWMRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiPenyegelanPemasanganWMRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiPenyegelanPemasanganWMRisikoController::class, 'store']);
    });
    
        Route::middleware(['auth','role:divisi_pengaduan_pelanggan'])->prefix('divisi/perencanaananggaran')->group(function () {
    Route::get('/risiko', [DivisiPengaduanPelangganRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiPengaduanPelangganRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiPengaduanPelangganRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_perencanaan_anggaran'])->prefix('divisi/perencanaananggaran')->group(function () {
    Route::get('/risiko', [DivisiPerencanaanAnggaranRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiPerencanaanAnggaranRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiPerencanaanAnggaranRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_pembukuan'])->prefix('divisi/pembukuan')->group(function () {
    Route::get('/risiko', [DivisiPembukuanRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiPembukuanRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiPembukuanRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_kas_penagihan'])->prefix('divisi/kaspenagihan')->group(function () {
    Route::get('/risiko', [DivisiKasPenagihanRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiKasPenagihanRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiKasPenagihanRisikoController::class, 'store']);
    });

        // ================= UNIT =================
    Route::middleware(['auth','role:unit_lawe_lawe'])->prefix('unit/lawe-lawe')->group(function () {
    Route::get('/risiko', [UnitLaweLaweRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitLaweLaweRisikoController::class, 'create']);
    Route::post('/risiko', [UnitLaweLaweRisikoController::class, 'store']);
    });
    
    Route::middleware(['auth','role:unit_sepaku'])->prefix('unit/sepaku')->group(function () {
    Route::get('/risiko', [UnitSepakuRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitSepakuRisikoController::class, 'create']);
    Route::post('/risiko', [UnitSepakuRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:unit_waru'])->prefix('unit/waru')->group(function () {
    Route::get('/risiko', [UnitWaruRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitWaruRisikoController::class, 'create']);
    Route::post('/risiko', [UnitWaruRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:unit_sotek'])->prefix('unit/sotek')->group(function () {
    Route::get('/risiko', [UnitSotekRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitSotekRisikoController::class, 'create']);
    Route::post('/risiko', [UnitSotekRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:unit_maridan'])->prefix('unit/maridan')->group(function () {
    Route::get('/risiko', [UnitMaridanRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitMaridanRisikoController::class, 'create']);
    Route::post('/risiko', [UnitMaridanRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:unit_babulu'])->prefix('unit/babulu')->group(function () {
    Route::get('/risiko', [UnitBabuluRisikoController::class, 'index']);
    Route::get('/risiko/create', [UnitBabuluRisikoController::class, 'create']);
    Route::post('/risiko', [UnitBabuluRisikoController::class, 'store']);
    });

    Route::middleware(['auth','role:divisi_laboratorium'])->prefix('divisi/laboratorium')->group(function () {
    Route::get('/risiko', [DivisiLaboratoriumRisikoController::class, 'index']);
    Route::get('/risiko/create', [DivisiLaboratoriumRisikoController::class, 'create']);
    Route::post('/risiko', [DivisiLaboratoriumRisikoController::class, 'store']);
     });



require __DIR__.'/auth.php';
