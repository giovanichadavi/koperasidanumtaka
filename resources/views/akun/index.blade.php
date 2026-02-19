@extends('adminlte::page')

@section('title', 'Akun Saya')
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
    .custom-card {
        border-radius: 15px;
    }
    .custom-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
</style>
@endsection

@section('navbar-right')
<li class="nav-item">
    <a class="nav-link" href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endsection

@section('content')

<div class="container-fluid">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- SPASI BIAR TURUN --}}
    <div class="row mt-5"></div>

    <div class="row mt-4">

        {{-- CARD PROFIL --}}
        <div class="col-md-6">
            <div class="card shadow-sm custom-card mt-4">
                <div class="card-header bg-primary text-white custom-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user"></i> Profil Saya
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('akun.updateProfil') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   class="form-control"
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fas fa-save"></i> Simpan Profil
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- CARD PASSWORD --}}
        <div class="col-md-6">
            <div class="card shadow-sm custom-card mt-4">
                <div class="card-header bg-primary text-white custom-header">
                    <h5 class="mb-0">
                        <i class="fas fa-key"></i> Ganti Password
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('akun.updatePassword') }}">
                        @csrf

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Masukkan password baru">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru">
                        </div>

                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-key"></i> Ganti Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection