@extends('adminlte::page')

@section('title', 'Laporan Daftar Risiko')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <a href="{{ route('laporan.daftar.risiko.create') }}"
        class="btn btn-primary btn-sm float-right">
        <i class="fas fa-plus"></i> Tambah Risiko
</a>
        <h5 class="mb-0">Laporan Daftar Risiko</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Unit</th>
                        <th>Nama Kegiatan</th>
                        <th>Tujuan Kegiatan</th>
                        <th>ID Risiko</th>
                        <th>Pernyataan Risiko</th>
                        <th>Sebab</th>
                        <th>Dampak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($risiko as $i => $r)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td>{{ $r->unit_nama }}</td>
                        <td>{{ $r->nama_kegiatan }}</td>
                        <td>{{ $r->tujuan}}</td>
                        <td>{{ $r->id_risiko }}</td>
                        <td>{{ $r->pernyataan_risiko }}</td>
                        <td>{{ $r->sebab }}</td>
                        <td>{{ $r->dampak }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection