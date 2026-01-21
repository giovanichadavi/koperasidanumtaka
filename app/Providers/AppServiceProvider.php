<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', fn($user) => $user->role === 'admin');
        Gate::define('user', fn($user) => $user->role === 'user');
        Gate::define('divisi_umum', fn($user) => $user->role === 'divisi_umum');
        Gate::define('divisi_hublang', fn($user) => $user->role === 'divisi_hublang');
        Gate::define('divisi_kepegawaian', fn($user) => $user->role === 'divisi_kepegawaian');
        Gate::define('divisi_legal_drafting', fn($user) => $user->role === 'divisi_legal_drafting');
        Gate::define('divisi_tunggakan_rekening_air', fn($user) => $user->role === 'divisi_tunggakan_rekening_air');
        Gate::define('divisi_penerbit_rekening', fn($user) => $user->role === 'divisi_penerbit_rekening');
        Gate::define('divisi_penyegelan_pemasangan_wm', fn($user) => $user->role === 'divisi_penyegelan_pemasangan_wm');
        Gate::define('divisi_pengaduan_pelanggan', fn($user) => $user->role === 'divisi_pengaduan_pelanggan');
        Gate::define('divisi_perencanaan_anggaran', fn($user) => $user->role === 'divisi_perencanaan_anggaran');
        Gate::define('divisi_pembukuan', fn($user) => $user->role === 'divisi_pembukuan');
        Gate::define('divisi_kas_penagihan', fn($user) => $user->role === 'divisi_kas_penagihan');
        Gate::define('unit_lawe_lawe', fn($user) => $user->role === 'unit_lawe_lawe');
        Gate::define('unit_sepaku', fn($user) => $user->role === 'unit_sepaku');
        Gate::define('unit_waru', fn($user) => $user->role === 'unit_waru');
        Gate::define('unit_sotek', fn($user) => $user->role === 'unit_sotek');
        Gate::define('unit_maridan', fn($user) => $user->role === 'unit_maridan');
        Gate::define('unit_babulu', fn($user) => $user->role === 'unit_babulu');
        Gate::define('divisi_laboratorium', fn($user) => $user->role === 'divisi_laboratorium');

        Paginator::useBootstrap();
        
    }
}
