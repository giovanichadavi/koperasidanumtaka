@extends('adminlte::page')

@section('title', 'Update Admin')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

@section('content_header')
    <div class="container-fluid mt-3"></div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header py-3 px-4">
                <h5 class="mb-0">Update Admin</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="name"
                               class="form-control form-control-sm"
                               value="{{ $user->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control form-control-sm"
                               value="{{ $user->email }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Password (Opsional)</label>
                        <input type="password" name="password"
                               class="form-control form-control-sm">
                    </div>

                    <div class="form-group mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control form-control-sm" required>

                            <optgroup label="Admin">
                                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Super Admin</option>
                                <option value="admin_mr" {{ $user->role=='admin_mr'?'selected':'' }}>Admin Manajemen Risiko</option>
                            </optgroup>

                            <optgroup label="Departemen Umum">
                                <option value="divisi_umum" {{ $user->role=='divisi_umum'?'selected':'' }}>Divisi Umum</option>
                                <option value="divisi_hublang" {{ $user->role=='divisi_hublang'?'selected':'' }}>Divisi Hublang</option>
                                <option value="divisi_kepegawaian" {{ $user->role=='divisi_kepegawaian'?'selected':'' }}>Divisi Kepegawaian</option>
                                <option value="divisi_legal_drafting" {{ $user->role=='divisi_legal_drafting'?'selected':'' }}>Divisi Legal Drafting</option>
                            </optgroup>

                            <optgroup label="Departemen Hublang">
                                <option value="divisi_tunggakan_rekening_air" {{ $user->role=='divisi_tunggakan_rekening_air'?'selected':'' }}>Divisi Tunggakan Rekening Air</option>
                                <option value="divisi_penerbit_rekening" {{ $user->role=='divisi_penerbit_rekening'?'selected':'' }}>Divisi Penerbit Rekening</option>
                                <option value="divisi_penyegelan_pemasangan_wm" {{ $user->role=='divisi_penyegelan_pemasangan_wm'?'selected':'' }}>Divisi Penyegelan & Pemasangan Water Meter</option>
                                <option value="divisi_pengaduan_pelanggan" {{ $user->role=='divisi_pengaduan_pelanggan'?'selected':'' }}>Divisi Pengaduan Pelanggan</option>
                            </optgroup>

                            <optgroup label="Departemen Keuangan">
                                <option value="divisi_perencanaan_anggaran" {{ $user->role=='divisi_perencanaan_anggaran'?'selected':'' }}>Divisi Perencanaan Anggaran</option>
                                <option value="divisi_pembukuan" {{ $user->role=='divisi_pembukuan'?'selected':'' }}>Divisi Pembukuan</option>
                                <option value="divisi_kas_penagihan" {{ $user->role=='divisi_kas_penagihan'?'selected':'' }}>Divisi Kas & Penagihan</option>
                            </optgroup>

                            <optgroup label="Departemen Teknik">
                                <option value="unit_lawe_lawe" {{ $user->role=='unit_lawe_lawe'?'selected':'' }}>Unit Lawe-Lawe</option>
                                <option value="unit_sepaku" {{ $user->role=='unit_sepaku'?'selected':'' }}>Unit Sepaku</option>
                                <option value="unit_waru" {{ $user->role=='unit_waru'?'selected':'' }}>Unit Waru</option>
                                <option value="unit_sotek" {{ $user->role=='unit_sotek'?'selected':'' }}>Unit Sotek</option>
                                <option value="unit_maridan" {{ $user->role=='unit_maridan'?'selected':'' }}>Unit Maridan</option>
                                <option value="unit_babulu" {{ $user->role=='unit_babulu'?'selected':'' }}>Unit Babulu</option>
                                <option value="divisi_laboratorium" {{ $user->role=='divisi_laboratorium'?'selected':'' }}>Divisi Laboratorium</option>
                            </optgroup>

                        </select>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary btn-sm px-4">
                            Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection