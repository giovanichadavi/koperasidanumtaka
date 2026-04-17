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

    .dark-mode {
        --table-bg: #343a40;
        --table-text: #ffffff;
        --table-border: #4b545c;
        --header-bg: #3f474e;
        --sticky-bg: #343a40;
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
        min-width: 2800px; 
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
        .bottom-actions { display: block !important; width: 100%; margin-top: 20px; text-align: center; }
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

    .user-info {
        font-size: 10px;
        line-height: 1.3;
        min-width: 150px;
    }

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
        width: 115px; 
        height: 32px; 
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px !important;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    .badge-tinggi { background-color: #dc3545 !important; color: white !important; }
    .badge-sedang { background-color: #ffc107 !important; color: black !important; }
    .badge-rendah { background-color: #28a745 !important; color: white !important; }
    .badge { padding: 6px 10px; font-size: 11px; border-radius: 4px; }
</style>
@endsection

@section('content')

{{-- NOTIFIKASI DEADLINE ALERT 2 MINGGU --}}
@if(isset($alerts) && $alerts->count() > 0)
    @foreach($alerts as $alert)
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0" role="alert" style="border-left: 5px solid #ffc107 !important;">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            @if(auth()->user()->role == 'admin')
                <strong>Monitor Deadline:</strong> Unit <b>{{ $alert->unit_nama }}</b> memiliki jadwal mitigasi (ID: {{ $alert->id_risiko }}) dalam {{ \Carbon\Carbon::now()->diffInDays($alert->jadwal_pengendalian) }} hari lagi.
            @else
                <strong>Peringatan Jadwal:</strong> Risiko <b>{{ $alert->id_risiko }}</b> harus diselesaikan paling lambat tanggal {{ \Carbon\Carbon::parse($alert->jadwal_pengendalian)->format('d M Y') }} (Tersisa {{ \Carbon\Carbon::now()->diffInDays($alert->jadwal_pengendalian) }} hari).
            @endif
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endforeach
@endif

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
        <form method="GET" action="{{ route('laporan.daftar_risiko.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3 col-6 mb-2">
                    <select name="unit" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Unit --</option>
                        @foreach($units as $u)
                        <option value="{{ $u }}" {{ $activeUnit == $u ? 'selected' : '' }}>{{ $u }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-6 mb-2">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="sudah" {{ request('status') == 'sudah' ? 'selected' : '' }}>Sudah Ditindak Lanjut</option>
                        <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Ditindak Lanjut</option>
                    </select>
                </div>

                <div class="col-md-4 col-12 mb-2">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
                        <th rowspan="3">Petugas (Add/Edit)</th>
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
                        <td>
                            {{ $r->nama_kegiatan }}
                            {{-- FEEDBACK ADMIN PINDAH KE SINI --}}
                            @if($r->feedback_admin)
                                <div class="mt-1">
                                    <small class="text-danger font-weight-bold" data-toggle="tooltip" title="{{ $r->feedback_admin }}">
                                        <i class="fas fa-comment-dots"></i> Feedback: {{ Str::limit($r->feedback_admin, 20) }}
                                    </small>
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

                        <td class="user-info">
                            <div><i class="fas fa-plus-circle text-primary"></i> <b>{{ $r->user_creator ?? '-' }}</b></div>
                            <div class="text-muted"><i class="fas fa-history text-secondary"></i> {{ $r->user_updater ?? '-' }}</div>
                        </td>

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

                                {{-- TOMBOL FEEDBACK KHUSUS ADMIN --}}
                                @if(auth()->user()->role == 'admin')
                                    <button type="button" class="btn btn-info btn-action" data-toggle="modal" data-target="#modalFeedback{{ $r->id }}">
                                        <i class="fas fa-comment-alt"></i> FEEDBACK
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL FEEDBACK ADMIN --}}
                    <div class="modal fade" id="modalFeedback{{ $r->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{ route('laporan.risiko.feedback', $r->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit mr-2"></i> Berikan Catatan Admin</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small text-muted">Risiko: <b>{{ $r->id_risiko }}</b> ({{ $r->unit_nama }})</p>
                                        <div class="form-group">
                                            <label>Isi Feedback / Catatan Perbaikan:</label>
                                            <textarea name="feedback_admin" class="form-control" rows="5" placeholder="Tulis instruksi perbaikan untuk unit disini..." required>{{ $r->feedback_admin }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">Kirim Feedback</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bottom-actions d-flex justify-content-between align-items-center mt-4">
            <div class="pagination-wrapper">
                {{ $risiko->appends(request()->all())->links() }}
            </div>
            <div class="download-wrapper">
                <a href="{{ route('laporan.daftar_risiko.pdf', request()->all()) }}" class="btn btn-danger btn-sm shadow-sm">
                    <i class="fas fa-file-pdf mr-1"></i> Download Laporan PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection