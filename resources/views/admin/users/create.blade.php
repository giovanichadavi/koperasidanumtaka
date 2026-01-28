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

                    <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>

                <optgroup label="Admin">
                    <option value="admin"> Super Admin</option>
                    <option value="admin_mr">Admin Manajemen Risiko</option>
                </optgroup>

                <optgroup label="Departemen Umum">
                    <option value="divisi_umum">Divisi Umum</option>
                    <option value="divisi_hublang">Divisi Hublang</option>
                    <option value="divisi_kepegawaian">Divisi Kepegawaian</option>
                    <option value="divisi_legal_drafting">Divisi Legal Drafting</option>
                </optgroup>

                <optgroup label="Departemen Hublang">
                    <option value="divisi_tunggakan_rekening_air">Divisi Tunggakan Rekening Air</option>
                    <option value="divisi_penerbit_rekening">Divisi Penerbit Rekening</option>
                    <option value="divisi_penyegelan_pemasangan_wm">Divisi Penyegelan & Pemasangan Water Meter</option>
                    <option value="divisi_pengaduan_pelanggan">Divisi Pengaduan Pelanggan</option>
                </optgroup>
                </optgroup>

                <optgroup label="Departemen Keuangan">
                    <option value="divisi_perencanaan_anggaran">Divisi Perencanaan Anggaran</option>
                    <option value="divisi_pembukuan">Divisi Pembukuan</option>
                    <option value="divisi_kas_penagihan">Divisi Kas & Penagihan</option>
                </optgroup>

                <optgroup label="Departemen Teknik">
                    <option value="unit_lawe_lawe">Unit Lawe-Lawe</option>
                    <option value="unit_sepaku">Unit Sepaku</option>
                    <option value="unit_waru">Unit Waru</option>
                    <option value="unit_sotek">Unit Sotek</option>
                    <option value="unit_maridan">Unit Maridan</option>
                    <option value="unit_babulu">Unit Babulu</option>
                    <option value="divisi_laboratorium">Divisi Laboratorium</option>
                    <option value="admin_mr">Admin Manajemen Risiko</option>
                </optgroup>

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