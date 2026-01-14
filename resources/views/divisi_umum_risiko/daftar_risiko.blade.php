@extends('adminlte::page')

@section('title', 'Laporan Daftar Risiko Divisi Umum')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <a href="{{ route('divisi_umum.risiko.create') }}"
        class="btn btn-primary btn-sm float-right">
        <i class="fas fa-plus"></i> Tambah Risiko Divisi Umum
</a>
        <h5 class="mb-0">Laporan Daftar Risiko Divisi Umum</h5>
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
            </table>
        </div>
    </div>
</div>
@endsection