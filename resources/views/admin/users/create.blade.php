@extends('adminlte::page')

@section('title', 'Tambah Admin')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

@section('content_header')
    <div class="container-fluid mt-3"></div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header py-3 px-4">
                <h5 class="mb-0">Tambah Admin</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="name"
                               class="form-control form-control-sm">
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control form-control-sm">
                    </div>

                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password"
                               class="form-control form-control-sm">
                    </div>

                    <div class="form-group mb-4">
                        <label>Role</label>
                        <select name="role" class="form-control form-control-sm">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="user">Divisi Umum</option>
                            <option value="user">Divisi Hublang</option>
                            <option value="user">Divisi Kepegawaian</option>
                            <option value="user">Divisi Humas</option>
                            <option value="user">Divisi Hukum</option>
                            <option value="user">Divisi Perencanaan Anggaran</option>
                            <option value="user">Divisi Pembukuan</option>
                            <option value="user">Divisi Kas Dan Penagihan</option>
                            <option value="user">Unit Lawe-Lawe</option>
                            <option value="user">Unit Sepaku</option>
                            <option value="user">Unit Waru</option>
                            <option value="user">Unit Sotek</option>
                            <option value="user">Unit Maridan</option>
                            <option value="user">Unit Babulu</option>
                            <option value="user">Divisi Laboratorium</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary btn-sm px-4">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection