@extends('adminlte::page')

@section('title', 'Kegiatan Tindak Lanjut')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@section('css')
<style>
    /* Variabel Warna Support Dark Mode */
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
        display: block; width: 100%; overflow-x: auto;
        border: 1px solid var(--table-border); border-radius: 8px;
        background-color: var(--table-bg);
    }

    .table-custom {
        min-width: 3800px; 
        border-collapse: separate; border-spacing: 0;
    }

    .table-custom thead th {
        vertical-align: middle; background-color: var(--header-bg);
        color: var(--table-text); text-align: center; font-size: 11px;
        white-space: nowrap; padding: 12px 8px; border: 1px solid var(--table-border);
    }

    .table-custom tbody td {
        vertical-align: middle; color: var(--table-text);
        font-size: 12px; white-space: nowrap; padding: 10px 8px;
        border: 1px solid var(--table-border);
    }

    .img-preview {
        width: 100px; height: 60px; object-fit: cover;
        border-radius: 4px; border: 1px solid var(--table-border);
        cursor: zoom-in; transition: transform 0.2s;
    }

    .img-preview:hover { transform: scale(1.05); }
    .zoom-img-full { width: 100%; height: auto; border-radius: 8px; }

    .badge-tinggi { background-color: #dc3545 !important; color: white !important; }
    .badge-sedang { background-color: #ffc107 !important; color: black !important; }
    .badge-rendah { background-color: #28a745 !important; color: white !important; }
</style>
@endsection

@section('content')
<div class="card mt-2 shadow-sm">
    <div class="card-header py-3 border-0">
        <h5 class="mb-0 text-center font-weight-bold text-uppercase">Kegiatan Tindak Lanjut</h5>
    </div>

    <div class="card-body">
        <form method="GET" action="{{ route('tindak-lanjut.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3 col-6 mb-2">
                    <select name="unit" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Unit --</option>
                        @foreach($units as $u)
                        <option value="{{ $u }}" {{ $activeUnit == $u ? 'selected' : '' }}>{{ $u }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 col-12 mb-2">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Kegiatan..." value="{{ request('search') }}">
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
                        <th rowspan="3">No</th>
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
                        <th colspan="2">Rencana Mitigasi</th>
                        <th rowspan="3">PJ</th>
                        <th rowspan="3" style="min-width: 150px;">Tanggal Pelaksanaan</th>
                        <th rowspan="3" style="min-width: 150px;">Foto Dokumentasi</th>
                        <th rowspan="3" style="min-width: 200px;">Aksi</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Desain</th>
                        <th colspan="3">Efektivitas</th>
                        <th rowspan="2">Prob</th>
                        <th rowspan="2">Damp</th>
                        <th rowspan="2">Nilai</th>
                        <th rowspan="2">Uraian</th>
                        <th rowspan="2">Deadline</th>
                    </tr>
                    <tr>
                        <th>A</th><th>T</th><th>TE</th><th>KE</th><th>E</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($risiko as $i=>$r)
                    <tr>
                        <td class="text-center">{{ $risiko->firstItem()+$i }}</td>
                        <td class="font-weight-bold">{{ $r->unit_nama }}</td>
                        <td>{{ $r->nama_kegiatan }}</td>
                        <td>{{ $r->tujuan }}</td>
                        <td class="text-center">{{ $r->id_risiko }}</td>
                        <td>{{ $r->pernyataan_risiko }}</td>
                        <td>{{ $r->sebab }}</td>
                        <td class="text-center">{{ $r->uc_c }}</td>
                        <td>{{ $r->dampak }}</td>
                        <td>{{ $r->pengendalian_uraian }}</td>
                        
                        <td class="text-center">{!! $r->desain_a ? '✅' : '-' !!}</td>
                        <td class="text-center">{!! $r->desain_t ? '✅' : '-' !!}</td>
                        <td class="text-center">{!! $r->efektivitas_te ? '✅' : '-' !!}</td>
                        <td class="text-center">{!! $r->efektivitas_ke ? '✅' : '-' !!}</td>
                        <td class="text-center">{!! $r->efektivitas_e ? '✅' : '-' !!}</td>
                        
                        <td class="text-center">{{ $r->probabilitas }}</td>
                        <td class="text-center">{{ $r->dampak_risiko }}</td>
                        <td class="text-center font-weight-bold">{{ $r->nilai_risiko }}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = 'secondary';
                                if(strtolower($r->level_risiko) == 'tinggi') $badgeClass = 'tinggi';
                                elseif(strtolower($r->level_risiko) == 'sedang') $badgeClass = 'sedang';
                                elseif(strtolower($r->level_risiko) == 'rendah') $badgeClass = 'rendah';
                            @endphp
                            <span class="badge badge-{{ $badgeClass }}">{{ $r->level_risiko ?? '-' }}</span>
                        </td>
                        <td>{{ $r->keputusan_penanganan }}</td>
                        <td>{{ $r->perlakuan_risiko }}</td>
                        <td>{{ $r->rencana_pengendalian }}</td>
                        <td>{{ $r->jadwal_pengendalian }}</td>
                        <td>{{ $r->penanggung_jawab }}</td>

                        <td class="text-center">
                            {{ $r->tanggal_pelaksanaan ? \Carbon\Carbon::parse($r->tanggal_pelaksanaan)->format('d/m/Y') : '-' }}
                        </td>

                        <td class="text-center">
                            @if($r->foto_dokumentasi)
                                <img src="{{ asset('storage/' . $r->foto_dokumentasi) }}" class="img-preview shadow-sm" data-toggle="modal" data-target="#modalZoomFoto{{ $r->id }}">
                            @else
                                <span class="text-muted italic small">Belum Ada Foto</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($r->tanggal_pelaksanaan && $r->foto_dokumentasi)
                                <button type="button" class="btn btn-primary btn-xs font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalTindakLanjut{{ $r->id }}">
                                    <i class="fas fa-edit mr-1"></i> UBAH FOTO & TANGGAL KEGIATAN
                                </button>
                            @else
                                <button type="button" class="btn btn-success btn-xs font-weight-bold shadow-sm" data-toggle="modal" data-target="#modalTindakLanjut{{ $r->id }}">
                                    <i class="fas fa-camera mr-1"></i> UPLOAD DOKUMENTASI KEGIATAN
                                </button>
                            @endif
                        </td>
                    </tr>

                    @if($r->foto_dokumentasi)
                    <div class="modal fade" id="modalZoomFoto{{ $r->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content bg-transparent border-0">
                                <div class="modal-body p-0 text-center">
                                    <button type="button" class="close text-white" data-dismiss="modal" style="position:absolute; right:10px; top:10px; z-index:999; font-size: 2rem;">&times;</button>
                                    <img src="{{ asset('storage/' . $r->foto_dokumentasi) }}" class="zoom-img-full shadow-lg">
                                    <div class="text-white mt-2 font-weight-bold">ID Risiko: {{ $r->id_risiko }} - {{ $r->nama_kegiatan }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="modal fade" id="modalTindakLanjut{{ $r->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="{{ route('tindak-lanjut.update', $r->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header {{ $r->foto_dokumentasi ? 'bg-primary' : 'bg-success' }} text-white">
                                        <h5 class="modal-title small font-weight-bold">
                                            {{ $r->foto_dokumentasi ? 'Ubah Data' : 'Update Pelaksanaan Kegiatan' }}: {{ $r->nama_kegiatan }}
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="form-group">
                                            <label class="small font-weight-bold">Tanggal Kegiatan Dilaksanakan:</label>
                                            <input type="date" name="tanggal_pelaksanaan" class="form-control" value="{{ $r->tanggal_pelaksanaan }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="small font-weight-bold">Foto Dokumentasi Kegiatan:</label>
                                            <input type="file" name="foto_dokumentasi" class="form-control" accept="image/*">
                                            @if($r->foto_dokumentasi)
                                                <div class="mt-2 text-center">
                                                    <p class="small text-muted mb-1">Foto saat ini:</p>
                                                    <img src="{{ asset('storage/' . $r->foto_dokumentasi) }}" width="150" class="rounded border">
                                                </div>
                                            @endif
                                            <small class="text-muted">Upload bukti foto kegiatan mitigasi (Max 2MB).</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn {{ $r->foto_dokumentasi ? 'btn-primary' : 'btn-success' }} btn-sm font-weight-bold">
                                            <i class="fas fa-save mr-1"></i> SIMPAN PERUBAHAN
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                {{ $risiko->appends(request()->all())->links() }}
            </div>
            <div>
<a href="{{ route('tindak-lanjut.export-pdf', request()->all()) }}" class="btn btn-danger shadow-sm font-weight-bold">
    <i class="fas fa-file-pdf mr-2"></i> DOWNLOAD PDF TINDAK LANJUT
</a>
            </div>
        </div>
    </div>
</div>
@endsection