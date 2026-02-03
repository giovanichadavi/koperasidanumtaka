@extends('adminlte::page')

@section('title', 'Laporan Manajemen Risiko')

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

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
    .nav-unit .nav-link {
        padding: 6px 14px;
        margin-right: 6px;
        font-size: 14px;
        border-radius: 20px;
    }
    table thead th {
        text-align: center !important;
        vertical-align: middle !important;
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
<div class="card mt-4 shadow-sm">

    <div class="card-header">
        <h5 class="mb-0 font-weight-semibold text-center">Manajemen Risiko</h5>
    </div>

    <div class="card-body">

        {{-- NAV UNIT --}}
        <ul class="nav nav-pills nav-unit mb-4 flex-wrap">
            @foreach($units as $unit)
                <li class="nav-item mb-2">
                    <a class="nav-link {{ $activeUnit == $unit ? 'active' : '' }}"
                       href="{{ route('laporan.daftar_risiko.index', ['unit' => $unit]) }}">
                        {{ $unit }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="text-center align-middle">
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Nama Unit</th>
                        <th rowspan="3">Nama Kegiatan</th>
                        <th rowspan="3">Tujuan Kegiatan</th>
                        <th rowspan="3">ID Risiko</th>
                        <th rowspan="3">Pernyataan Risiko</th>
                        <th rowspan="3">Sebab</th>
                        <th rowspan="3">UC / C</th>
                        <th rowspan="3">Dampak Awal</th>

                        <th colspan="6">Pengendalian yang Ada</th>

                        <th rowspan="3">Probabilitas</th>
                        <th rowspan="3">Dampak</th>
                        <th rowspan="3">Tingkat Risiko</th>
                        <th rowspan="3">Level Risiko</th>

                        <th colspan="2">Rencana Pengendalian</th>

                        <th rowspan="3">Penanggung Jawab</th>
                        <th rowspan="3" style="width:150px;">Aksi</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Desain</th>
                        <th colspan="3">Efektivitas</th>

                        <th rowspan="2">Uraian</th>
                        <th rowspan="2">Jadwal</th>
                    </tr>
                    <tr>
                        <th>A</th>
                        <th>T</th>
                        <th>TE</th>
                        <th>KE</th>
                        <th>E</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($risiko as $i => $r)
                    <tr>
                        <td class="text-center">{{ $risiko->firstItem() + $i }}</td>
                        <td>{{ $r->unit_nama }}</td>
                        <td>{{ $r->nama_kegiatan }}</td>
                        <td>{{ $r->tujuan }}</td>
                        <td>{{ $r->id_risiko }}</td>
                        <td>{{ $r->pernyataan_risiko }}</td>
                        <td>{{ $r->sebab }}</td>
                        <td class="text-center">{{ $r->uc_c }}</td>
                        <td>{{ $r->dampak }}</td>

                        <td>{{ $r->pengendalian_uraian }}</td>
                        <td class="text-center">{{ $r->desain_a ? '✔' : '-' }}</td>
                        <td class="text-center">{{ $r->desain_t ? '✔' : '-' }}</td>
                        <td class="text-center">{{ $r->efektivitas_te ? '✔' : '-' }}</td>
                        <td class="text-center">{{ $r->efektivitas_ke ? '✔' : '-' }}</td>
                        <td class="text-center">{{ $r->efektivitas_e ? '✔' : '-' }}</td>

                        <td class="text-center">{{ $r->probabilitas ?? '-' }}</td>
                        <td class="text-center">{{ $r->dampak_risiko ?? '-' }}</td>
                        <td class="text-center">{{ $r->nilai_risiko ?? '-' }}</td>

                        <td class="text-center">
                            @if($r->level_risiko)
                                <span class="badge 
                                    @if($r->warna_risiko == 'success') badge-success
                                    @elseif($r->warna_risiko == 'warning') badge-warning
                                    @elseif($r->warna_risiko == 'orange') badge-orange
                                    @else badge-danger
                                    @endif">
                                    {{ $r->level_risiko }}
                                </span>
                            @else
                                <span class="badge badge-secondary">Belum Dinilai</span>
                            @endif
                        </td>

                        <td>{{ $r->rencana_pengendalian ?? '-' }}</td>
                        <td class="text-center">{{ $r->jadwal_pengendalian ?? '-' }}</td>

                        <td>{{ $r->penanggung_jawab ?? '-' }}</td>

                        <td class="text-center">
                            <a href="{{ route('laporan.risiko.tindaklanjut.form', ['id'=>$r->id, 'unit'=>$activeUnit]) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-check-circle mr-1"></i> Tindak Lanjut
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="22" class="text-center text-muted">
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