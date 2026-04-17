@extends('adminlte::page')

@section('title', 'Laporan Daftar Risiko | Penerbit Rekening')
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
        --info-text-color: #6c757d;
    }

    .dark-mode {
        --table-bg: #343a40;
        --table-text: #ffffff;
        --table-border: #4b545c;
        --header-bg: #3f474e;
        --sticky-bg: #343a40;
        --info-text-color: #adb5bd;
    }

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

    .table-responsive-custom::-webkit-scrollbar { height: 10px; }
    .table-responsive-custom::-webkit-scrollbar-track { background: var(--header-bg); border-radius: 10px; }
    .table-responsive-custom::-webkit-scrollbar-thumb { background: #007bff; border-radius: 10px; }

    .table-custom {
        min-width: 2600px; 
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        background-color: var(--table-bg);
        color: var(--table-text);
    }

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
            overflow-x: auto !important;
            display: block !important;
            padding: 15px 0;
            margin-bottom: 10px;
            -webkit-overflow-scrolling: touch;
        }
        .pagination { display: inline-flex !important; flex-wrap: nowrap !important; margin: 0 auto !important; }
    }

    .table-custom thead th {
        vertical-align: middle;
        background-color: var(--header-bg);
        color: var(--table-text);
        text-align: center;
        font-size: 11px;
        white-space: nowrap;
        padding: 15px 10px;
        border: 1px solid var(--table-border);
    }

    .table-custom tbody td {
        vertical-align: middle;
        color: var(--table-text);
        font-size: 12px;
        white-space: nowrap;
        padding: 12px 10px;
        border: 1px solid var(--table-border);
    }

    .action-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 10px;
        min-width: 200px;
    }

    .form-inline-action { display: inline-block; margin: 0; padding: 0; }

    .btn-action {
        width: 85px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px !important;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 5px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        filter: brightness(1.1);
    }

    .btn-action i { margin-right: 5px; font-size: 10px; }

    .info-text-box {
        color: var(--info-text-color);
        font-size: 13px;
        font-weight: 500;
    }
    .info-text-box b { color: #007bff; }
    .separator-dash { margin: 0 8px; font-weight: bold; color: var(--table-text); }
    
    .user-info {
        font-size: 10px;
        line-height: 1.4;
        min-width: 160px;
    }
    .user-info i { width: 15px; }

    /* Tambahan style agar feedback terlihat rapi di dalam tabel */
    .feedback-box {
        margin-top: 5px;
        padding: 5px;
        background: #fff5f5;
        border-left: 3px solid #dc3545;
        color: #b02a37;
        font-size: 11px;
        white-space: normal;
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

{{-- NOTIFIKASI FEEDBACK ADMIN --}}
@foreach($risiko as $r)
    @if($r->feedback_admin)
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="background-color: #dc3545; color: white; border: none;">
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5>
                <i class="icon fas fa-comment-dots"></i> 
                <strong>Feedback Admin:</strong> Ada revisi untuk kegiatan <b>{{ $r->nama_kegiatan }}</b>
            </h5>
            <p class="mb-0">Catatan: <b>{{ $r->feedback_admin }}</b></p>
        </div>
    @endif
@endforeach

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<div class="card mt-2 shadow-sm">
    <div class="card-header py-3 border-0 d-flex align-items-center">
        <h5 class="mb-0 flex-grow-1 text-center font-weight-bold text-uppercase">Laporan Daftar Risiko Divisi Penerbit Rekening</h5>
        <a href="{{ route('divisi_penerbit_rekening.risiko.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Risiko
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive-custom">
            <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th rowspan="3" class="sticky-no">No</th>
                        <th rowspan="3">Nama Unit</th>
                        <th rowspan="3">Nama Kegiatan</th>
                        <th rowspan="3">Tujuan Kegiatan</th>
                        <th rowspan="3">ID Risiko</th>
                        <th rowspan="3">Pernyataan Risiko</th>
                        <th rowspan="3">Sebab</th>
                        <th rowspan="3">UC / C</th>
                        <th rowspan="3">Dampak</th>
                        <th colspan="6">Pengendalian yang Ada</th>
                        <th rowspan="3">Input/Update Oleh</th> 
                        <th rowspan="3">Aksi</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Desain</th>
                        <th colspan="3">Efektivitas</th>
                    </tr>
                    <tr>
                        <th>A</th><th>T</th><th>TE</th><th>KE</th><th>E</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($risiko as $i => $r)
                    <tr>
                        <td class="text-center sticky-no">{{ $risiko->firstItem() + $i }}</td>
                        <td class="font-weight-bold">{{ $r->unit_nama }}</td>
                        <td>
                            {{ $r->nama_kegiatan }}
                            {{-- FEEDBACK PINDAH KE SINI --}}
                            @if($r->feedback_admin)
                                <div class="feedback-box">
                                    <strong><i class="fas fa-exclamation-circle"></i> Feedback Admin:</strong> {{ $r->feedback_admin }}
                                </div>
                            @endif
                        </td>
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
                        
                        <td class="user-info">
                            <div>
                                <i class="fas fa-plus-circle text-primary"></i> 
                                <b>{{ $r->user_creator ?? 'Data Lama' }}</b>
                            </div>
                            <div class="text-muted">
                                <i class="fas fa-history text-secondary"></i> 
                                {{ $r->user_updater ?? '-' }}
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="action-container">
                                <form action="{{ route('divisi_penerbit_rekening.risiko.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="form-inline-action">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>

                                <a href="{{ route('divisi_penerbit_rekening.risiko.edit', $r->id) }}" class="btn btn-warning btn-action shadow-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="17" class="text-center text-muted py-4">Data risiko belum tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bottom-actions d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 px-2">
            <div class="info-text-box mb-3 mb-md-0">
                Menampilkan <b>{{ $risiko->firstItem() }}</b><span class="separator-dash">sampai</span><b>{{ $risiko->lastItem() }}</b> dari <b>{{ $risiko->total() }}</b> data
            </div>
            <div class="pagination-wrapper">
                {{ $risiko->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection