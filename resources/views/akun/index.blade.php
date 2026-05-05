@extends('adminlte::page')

@section('title', 'Akun Saya')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

@section('css')
<style>
    /* 1. Navbar Solid & Solid Colors */
    .main-header.navbar {
        background-color: #ffffff !important;
        opacity: 1 !important;
        border-bottom: 1px solid #dee2e6 !important;
    }

    .dark-mode .main-header.navbar {
        background-color: #343a40 !important;
        border-bottom: 1px solid #4b545c !important;
    }

    /* 2. Card Styling */
    .custom-card {
        border-radius: 15px;
        border: none;
    }
    .custom-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    /* 3. Layout: Tombol Sejajar di Bawah */
    .flex-form {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .btn-container {
        margin-top: auto;
        padding-top: 20px;
    }

    /* Jarak proporsional dari bar atas */
    .content-wrapper {
        padding-top: 10px !important;
    }
</style>
@stop

@section('content')
<div class="container-fluid">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="icon fas fa-check mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Posisi mt-4 sudah cukup ideal untuk jarak dari Navbar --}}
    <div class="row mt-2">
        
        {{-- Card Profil --}}
        <div class="col-md-6 d-flex align-items-stretch mb-4">
            <div class="card shadow-sm custom-card w-100 d-flex flex-column">
                <div class="card-header bg-primary text-white custom-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle mr-2"></i> Profil Saya
                    </h5>
                </div>

                <div class="card-body d-flex flex-column">
                    <form method="POST" action="{{ route('akun.updateProfil') }}" enctype="multipart/form-data" class="flex-form">
                        @csrf
                        <div class="form-group">
                            <label class="text-muted small">NAMA LENGKAP</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   class="form-control"
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-outline-primary btn-sm px-4">
                                <i class="fas fa-save mr-1"></i> Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card Password --}}
        <div class="col-md-6 d-flex align-items-stretch mb-4">
            <div class="card shadow-sm custom-card w-100 d-flex flex-column">
                <div class="card-header bg-primary text-white custom-header">
                    <h5 class="mb-0">
                        <i class="fas fa-shield-alt mr-2"></i> Keamanan Akun
                    </h5>
                </div>

                <div class="card-body d-flex flex-column">
                    <form method="POST" action="{{ route('akun.updatePassword') }}" class="flex-form">
                        @csrf
                        <div class="form-group">
                            <label class="text-muted small">PASSWORD BARU</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Masukkan password baru">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-muted small">KONFIRMASI PASSWORD</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru">
                        </div>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-outline-primary btn-sm px-4">
                                <i class="fas fa-key mr-1"></i> Ganti Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop