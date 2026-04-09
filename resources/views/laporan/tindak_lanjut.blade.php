@extends('adminlte::page')

@section('title', 'Tindak Lanjut Risiko')
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@section('css')
<style>
    /* Variabel Warna untuk Mode Terang & Gelap */
    :root {
        --card-header-bg: #ffffff;
        --card-header-text: #007bff;
        --input-readonly-bg: #e9ecef;
    }

    .dark-mode {
        --card-header-bg: #3f474e;
        --card-header-text: #ffffff;
        --input-readonly-bg: #454d55; /* Warna input readonly di mode gelap */
    }

    /* Styling Header Kartu */
    .card-header-custom {
        background-color: var(--card-header-bg) !important;
        color: var(--card-header-text) !important;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }

    #level_risiko {
        font-weight: bold;
        transition: all 0.3s ease;
        color: white !important;
    }

    .text-success-check {
        color: #28a745;
        font-size: 1.1rem;
    }

    /* Input Readonly Adaptif */
    .form-control-readonly {
        background-color: var(--input-readonly-bg) !important;
        cursor: not-allowed;
    }

    /* Penyesuaian Tabel & Label di Mode Gelap */
    .dark-mode .table-responsive { background-color: #343a40; }
    .dark-mode label { color: #fff; }
    .dark-mode .card { background-color: #343a40; color: #fff; }
</style>
@endsection

@section('content')
<div class="card mt-4 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-header card-header-custom">
        <h5 class="mb-0 text-center font-weight-bold text-uppercase">Tindak Lanjut Risiko</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center align-middle">
                    <tr>
                        <th rowspan="3">Nama Unit</th>
                        <th rowspan="3">Nama Kegiatan</th>
                        <th rowspan="3">Tujuan Kegiatan</th>
                        <th rowspan="3">ID Risiko</th>
                        <th rowspan="3">Pernyataan Risiko</th>
                        <th rowspan="3">Sebab</th>
                        <th rowspan="3">UC/C</th>
                        <th rowspan="3">Dampak Awal</th>
                        <th colspan="6">Pengendalian yang Ada</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Desain</th>
                        <th colspan="3">Efektivitas</th>
                    </tr>
                    <tr>
                        <th>A</th>
                        <th>T</th>
                        <th>TE</th>
                        <th>KE</th>
                        <th>E</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    <tr>
                        <td>{{ $risiko->unit_nama }}</td>
                        <td>{{ $risiko->nama_kegiatan }}</td>
                        <td>{{ $risiko->tujuan }}</td>
                        <td><b class="text-primary">{{ $risiko->id_risiko }}</b></td>
                        <td>{{ $risiko->pernyataan_risiko }}</td>
                        <td>{{ $risiko->sebab }}</td>
                        <td>{{ $risiko->uc_c }}</td>
                        <td>{{ $risiko->dampak }}</td>
                        <td>{{ $risiko->pengendalian_uraian }}</td>
                        <td class="text-success-check">{!! $risiko->desain_a ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-success-check">{!! $risiko->desain_t ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-success-check">{!! $risiko->efektivitas_te ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-success-check">{!! $risiko->efektivitas_ke ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                        <td class="text-success-check">{!! $risiko->efektivitas_e ? '<i class="fas fa-check"></i>' : '-' !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <form method="POST" action="{{ route('laporan.risiko.tindaklanjut.simpan', $risiko->id) }}" novalidate>
            @csrf

            <input type="hidden" name="unit_filter" value="{{ request('unit') }}">
            <input type="hidden" name="page" value="{{ request('page') }}">

            <div class="row">
                <div class="col-md-6">
                    <label>Dampak</label>
                    <select name="dampak_risiko" id="dampak_risiko" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Dampak --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            @php $labels = [1=>'Tidak Signifikan', 2=>'Rendah', 3=>'Menengah', 4=>'Besar', 5=>'Dahsyat']; @endphp
                            <option value="{{ $i }}" {{ old('dampak_risiko', $risiko->dampak_risiko) == $i ? 'selected' : '' }}>
                                {{ $i }} - {{ $labels[$i] }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Probabilitas</label>
                    <select name="probabilitas" id="probabilitas" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Probabilitas --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            @php $labels = [1=>'Jarang', 2=>'Kecil', 3=>'Sedang', 4=>'Besar', 5=>'Hampir Pasti']; @endphp
                            <option value="{{ $i }}" {{ old('probabilitas', $risiko->probabilitas) == $i ? 'selected' : '' }}>
                                {{ $i }} - {{ $labels[$i] }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Nilai Risiko</label>
                    <input type="text" id="nilai_risiko" class="form-control form-control-readonly" readonly value="{{ old('nilai_risiko', $risiko->nilai_risiko) }}">
                    <input type="hidden" name="nilai_risiko" id="nilai_risiko_hidden" value="{{ old('nilai_risiko', $risiko->nilai_risiko) }}">
                </div>

                <div class="col-md-6">
                    <label>Level Risiko</label>
                    <input type="text" id="level_risiko" class="form-control" readonly value="{{ old('level_risiko', $risiko->level_risiko) }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Keputusan Penanganan Risiko</label>
                    {{-- Diperbaiki agar menggunakan class 'form-control-readonly' yang adaptif terhadap dark mode --}}
                    <input type="text" class="form-control form-control-readonly" name="keputusan_penanganan" value="YA" readonly>
                </div>

                <div class="col-md-6">
                    <label>Perlakuan Risiko</label>
                    <select name="perlakuan_risiko" class="form-control">
                        <option value="Mitigasi" {{ old('perlakuan_risiko', $risiko->perlakuan_risiko) == 'Mitigasi' ? 'selected' : '' }}>Mitigasi</option>
                    </select>
                </div>
            </div>

            <div class="form-group mt-3">
                <label>Rencana Pengendalian</label>
                <textarea name="rencana_pengendalian" class="form-control" rows="3" placeholder="Masukkan rencana mitigasi...">{{ old('rencana_pengendalian', $risiko->rencana_pengendalian) }}</textarea>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Jadwal Pengendalian</label>
                    <input type="date" name="jadwal_pengendalian" class="form-control" value="{{ old('jadwal_pengendalian', $risiko->jadwal_pengendalian) }}">
                </div>

                <div class="col-md-6">
                    <label>Penanggung Jawab</label>
                    @php
                        $pj_db = is_string($risiko->penanggung_jawab) ? explode(',', $risiko->penanggung_jawab) : ($risiko->penanggung_jawab ?? []);
                        $pj_selected = old('penanggung_jawab', $pj_db);
                    @endphp
                    <div class="row p-2 rounded border mx-0" style="background-color: rgba(0,0,0,0.05);">
                        <div class="col-md-6">
                            @foreach(['Direktur','Manajer Produksi','Manajer Teknik'] as $i => $pj)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="{{ $pj }}" id="pj{{ $i }}"
                                    {{ is_array($pj_selected) && in_array($pj, $pj_selected) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pj{{ $i }}">{{ $pj }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            @foreach(['Manajer Keuangan','Kepala Unit'] as $i => $pj)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="{{ $pj }}" id="pjx{{ $i }}"
                                    {{ is_array($pj_selected) && in_array($pj, $pj_selected) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pjx{{ $i }}">{{ $pj }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-5">
                <a href="{{ route('laporan.daftar_risiko.index', ['page' => request('page'), 'unit' => request('unit')]) }}" class="btn btn-secondary px-4">
                    <i class="fas fa-times-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() { hitungRisiko(); });

    function hitungRisiko(){
        let d = document.getElementById('dampak_risiko').value;
        let p = document.getElementById('probabilitas').value;
        if(!d || !p) return;

        const matrix = {
            1:{1:1, 2:3, 3:5, 4:8, 5:20},
            2:{1:2, 2:7, 3:11, 4:13, 5:21},
            3:{1:4, 2:10, 3:14, 4:17, 5:22},
            4:{1:6, 2:12, 3:16, 4:19, 5:24},
            5:{1:9, 2:15, 3:18, 4:23, 5:25}
        };

        let nilai = matrix[d][p];
        let level = ''; let warna = '';

        if ([1,2,3,5,7,8].includes(nilai)) { level = 'Rendah'; warna = '#28a745'; } 
        else if ([4,10,11,13,20].includes(nilai)) { level = 'Moderat'; warna = '#ffc107'; } 
        else if ([6,12,14,16,17,21].includes(nilai)) { level = 'Tinggi'; warna = '#fd7e14'; } 
        else { level = 'Ekstrim'; warna = '#dc3545'; }

        document.getElementById('nilai_risiko').value = nilai;
        document.getElementById('nilai_risiko_hidden').value = nilai;

        let el = document.getElementById('level_risiko');
        el.value = level;
        el.style.backgroundColor = warna;
        el.style.color = (level === 'Moderat') ? 'black' : 'white';
    }
</script>
@endpush