@extends('adminlte::page')

@section('title', 'Laporan Manajemen Risiko')
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@section('css')
<style>
    /* Variabel Warna untuk Dark Mode Support */
    :root {
        --table-bg: #ffffff;
        --table-text: #212529;
        --table-border: #dee2e6;
        --header-bg: #f4f6f9;
        --sticky-bg: #ffffff;
    }

    /* Otomatis deteksi jika AdminLTE menggunakan dark mode */
    .dark-mode {
        --table-bg: #343a40;
        --table-text: #ffffff;
        --table-border: #4b545c;
        --header-bg: #3f474e;
        --sticky-bg: #343a40;
    }

    /* 1. Container utama */
    .table-responsive-custom {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid var(--table-border);
        border-radius: 8px;
        background-color: var(--table-bg);
        position: relative;
    }

    /* Scrollbar Styling agar terlihat kontras di kedua mode */
    .table-responsive-custom::-webkit-scrollbar { height: 10px; }
    .table-responsive-custom::-webkit-scrollbar-track { background: var(--header-bg); border-radius: 10px; }
    .table-responsive-custom::-webkit-scrollbar-thumb { background: #007bff; border-radius: 10px; }

    /* 2. Lebar Tabel */
    .table-custom {
        min-width: 2600px; 
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        background-color: var(--table-bg);
        color: var(--table-text);
    }

    /* 3. Sticky Column Fix (Hanya No) */
    @media (max-width: 768px) {
        .sticky-no {
            position: sticky !important;
            left: 0;
            z-index: 5 !important;
            background-color: var(--sticky-bg) !important;
            border-right: 2px solid var(--table-border) !important;
            color: var(--table-text) !important;
        }

        .bottom-actions {
            display: block !important;
            width: 100%;
            margin-top: 20px;
            text-align: center;
        }

        .pagination-wrapper {
            width: 100%;
            overflow-x: scroll !important;
            display: block !important;
            padding: 15px 0;
            margin-bottom: 10px;
            -webkit-overflow-scrolling: touch;
        }

        .pagination { display: inline-flex !important; flex-wrap: nowrap !important; margin: 0 auto !important; }
    }

    /* Styling Header & Cell agar Teks Terlihat */
    .table-custom thead th {
        vertical-align: middle;
        background-color: var(--header-bg);
        color: var(--table-text);
        text-align: center;
        font-size: 11px;
        white-space: nowrap;
        padding: 12px 8px;
        border: 1px solid var(--table-border);
    }

    .table-custom tbody td {
        vertical-align: middle;
        color: var(--table-text);
        font-size: 12px;
        white-space: nowrap;
        padding: 10px 8px;
        border: 1px solid var(--table-border);
    }

    /* 4. TOMBOL AKSI SEJAJAR */
    .action-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 6px; 
        min-width: 260px;
    }

    .form-inline-action { display: inline-block; margin: 0; padding: 0; }

    .btn-action {
        width: 125px; 
        height: 34px; 
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px !important;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    /* Warna Badge khusus Level */
    .badge-tinggi { background-color: #dc3545 !important; color: white !important; }
    .badge-sedang { background-color: #ffc107 !important; color: black !important; }
    .badge-rendah { background-color: #28a745 !important; color: white !important; }
    .badge { padding: 6px 10px; font-size: 11px; border-radius: 4px; }
</style>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<div class="card mt-2 shadow-sm">
    <div class="card-header py-3 border-0">
        <h5 class="mb-0 text-center font-weight-bold text-uppercase">Manajemen Risiko</h5>
    </div>

    <div class="card-body">
        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('laporan.daftar_risiko.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3 col-6 mb-2">
                    <select name="unit" class="form-control form-control-sm">
                        <option value="">-- Semua Unit --</option>
                        @foreach($units as $u)
                        <option value="{{ $u }}" {{ $activeUnit == $u ? 'selected' : '' }}>{{ $u }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-6 mb-2">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Area Tabel --}}
        <div class="table-responsive-custom">
            <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th rowspan="3" class="sticky-no">No</th>
                        <th rowspan="3">Nama Unit</th>
                        <th rowspan="3">Nama Kegiatan</th>
                        <th rowspan="3">Tujuan Kegiatan</th>
                        <th rowspan="3">ID Risiko</th>
                        <th rowspan="3">Pernyataan</th>
                        <th rowspan="3">Sebab</th>
                        <th rowspan="3">UC/C</th>
                        <th rowspan="3">Dampak Awal</th>
                        <th colspan="6">Pengendalian yang Ada</th>
                        <th colspan="3">Penilaian Risiko</th>
                        <th rowspan="3">Level</th>
                        <th rowspan="3">Keputusan</th>
                        <th rowspan="3">Perlakuan</th>
                        <th colspan="2">Rencana Pengendalian</th>
                        <th rowspan="3">PJ</th>
                        <th rowspan="3">Aksi</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Desain</th>
                        <th colspan="3">Efektivitas</th>
                        <th rowspan="2">Prob</th>
                        <th rowspan="2">Damp</th>
                        <th rowspan="2">Nilai</th>
                        <th rowspan="2">Uraian</th>
                        <th rowspan="2">Jadwal</th>
                    </tr>
                    <tr>
                        <th>A</th><th>T</th><th>TE</th><th>KE</th><th>E</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($risiko as $i=>$r)
                    <tr>
                        <td class="text-center sticky-no">{{ $risiko->firstItem()+$i }}</td>
                        <td class="font-weight-bold">{{ $r->unit_nama }}</td>
                        <td>{{ $r->nama_kegiatan }}</td>
                        <td>{{ $r->tujuan }}</td>
                        <td class="text-center">{{ $r->id_risiko }}</td>
                        <td>{{ $r->pernyataan_risiko }}</td>
                        <td>{{ $r->sebab }}</td>
                        <td class="text-center">{{ $r->uc_c }}</td>
                        <td>{{ $r->dampak }}</td>
                        <td>{{ $r->pengendalian_uraian }}</td>
                        
                        <td class="text-center text-success">{!! $r->desain_a ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-center text-success">{!! $r->desain_t ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-center text-success">{!! $r->efektivitas_te ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-center text-success">{!! $r->efektivitas_ke ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-center text-success">{!! $r->efektivitas_e ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        
                        <td class="text-center">{{ $r->probabilitas }}</td>
                        <td class="text-center">{{ $r->dampak_risiko }}</td>
                        <td class="text-center font-weight-bold">{{ $r->nilai_risiko }}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = 'secondary';
                                if($r->warna_risiko == 'danger' || strtolower($r->level_risiko) == 'tinggi') $badgeClass = 'tinggi';
                                elseif($r->warna_risiko == 'warning' || strtolower($r->level_risiko) == 'sedang') $badgeClass = 'sedang';
                                elseif($r->warna_risiko == 'success' || strtolower($r->level_risiko) == 'rendah') $badgeClass = 'rendah';
                            @endphp
                            <span class="badge badge-{{ $badgeClass }} shadow-sm">
                                {{ $r->level_risiko ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $r->keputusan_penanganan ?? '-' }}</td>
                        <td>{{ $r->perlakuan_risiko ?? '-' }}</td>
                        <td>{{ $r->rencana_pengendalian }}</td>
                        <td>{{ $r->jadwal_pengendalian }}</td>
                        <td>{{ $r->penanggung_jawab }}</td>
                        <td class="text-center">
                            <div class="action-container">
                                <form action="{{ route('laporan.risiko.hapus',$r->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="form-inline-action">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action">
                                        <i class="fas fa-trash"></i> HAPUS
                                    </button>
                                </form>

                                @if($r->keputusan_penanganan)
                                    <a href="{{ route('laporan.risiko.tindaklanjut.form',$r->id) }}?page={{ $risiko->currentPage() }}" class="btn btn-primary btn-action">
                                        <i class="fas fa-edit"></i> UBAH
                                    </a>
                                @else
                                    <a href="{{ route('laporan.risiko.tindaklanjut.form',$r->id) }}?page={{ $risiko->currentPage() }}" class="btn btn-success btn-action">
                                        <i class="fas fa-plus-circle"></i> TINDAK LANJUT
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination & PDF --}}
        <div class="bottom-actions d-flex justify-content-between align-items-center mt-4">
            <div class="pagination-wrapper">
                {{ $risiko->appends(request()->all())->links() }}
            </div>
            <div class="download-wrapper">
                <a href="{{ route('laporan.daftar_risiko.pdf', request()->all()) }}" class="btn btn-danger btn-sm shadow-sm">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>

    </div>
</div>
@endsection