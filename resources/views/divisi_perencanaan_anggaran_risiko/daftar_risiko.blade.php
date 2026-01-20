@extends('adminlte::page')

@section('title', 'Laporan Daftar Risiko | Perencanaan Anggaran')

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
@endsection

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <a href="{{ route('divisi_perencanaan_anggaran.risiko.create') }}"
           class="btn btn-primary btn-sm float-right">
            <i class="fas fa-plus mr-1"></i> Tambah Risiko Divisi Perencanaan Anggaran
        </a>
        <h5 class="mb-0">Laporan Daftar Risiko Divisi Perencanaan Anggaran</h5>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>

        <script>
            setTimeout(() => {
                $('.alert').alert('close');
            }, 3000);
        </script>
    @endif

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
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($risiko as $i => $r)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $r->unit_nama }}</td>
                        <td>{{ $r->nama_kegiatan }}</td>
                        <td>{{ $r->tujuan }}</td>
                        <td>{{ $r->id_risiko }}</td>
                        <td>{{ $r->pernyataan_risiko }}</td>
                        <td>{{ $r->sebab }}</td>
                        <td>{{ $r->dampak }}</td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center">

                                <a href="{{ route('divisi_perencanaan_anggaran.risiko.edit', $r->id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <form action="{{ route('divisi_perencanaan_anggaran.risiko.destroy', $r->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Data risiko belum tersedia
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
            <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Menampilkan {{ $risiko->firstItem() }} – {{ $risiko->lastItem() }}
                dari {{ $risiko->total() }} data
            </div>

            <div>
                {{ $risiko->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection