@extends('adminlte::page')

@section('content')
<form method="POST" action="{{ route('users.update',$user->id) }}">
@csrf
@method('PUT')

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="name" class="form-control"
           value="{{ $user->name }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
           value="{{ $user->email }}">
</div>

<div class="form-group">
    <label>Password (Opsional)</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control">
        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
        <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
        <optgroup label="Departemen Umum">
            <option value="divisi_umum">Divisi Umum</option>
            <option value="divisi_hublang">Divisi Hublang</option>
            <option value="divisi_kepegawaian">Divisi Kepegawaian</option>
            <option value="divisi_legal_drafting">Divisi Legal Drafting</option>
        </optgroup>

        <optgroup label="Departemen Hublang">
            <option value="divisi_tunggakan_rekening_air">Divisi Tunggakan Rekening Air</option>
            <option value="divisi_penerbit_rekening">Divisi Penerbit Rekening</option>
            <option value="divisi_penyegelan_pemasangan_WM">Divisi Penyegelan & Pemasangan Water Meter</option>
            <option value="divisi_pengaduan_pelanggan">Divisi Pengaduan Pelanggan</option>
        </optgroup>

        <optgroup label="Departemen Keuangan">
            <option value="divisi_perencanaan_anggaran">Divisi Perencanaan Anggaran</option>
            <option value="divisi_pembukuan">Divisi Pembukuan</option>
            <option value="divisi_kas_penagihan">Divisi Kas Dan Penagihan</option>
        </optgroup>

        <optgroup label="Departemen Teknik">
            <option value="unit_lawe_lawe">Unit Lawe-Lawe</option>
            <option value="unit_sepaku">Unit Sepaku</option>
            <option value="unit_waru">Unit Waru</option>
            <option value="unit_sotek">Unit Sotek</option>
            <option value="unit_Maridan">Unit Maridan</option>
            <option value="unit_babulu">Unit Babulu</option>
            <option value="divisi_laboratorium">Divisi Laboratorium</option>
        </optgroup>


    </select>
</div>

<button class="btn btn-success">Update</button>
</form>
@endsection