@extends('adminlte::page')

@section('title', 'Tindak Lanjut Risiko')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
    #level_risiko {
        font-weight: bold;
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h5 class="mb-0 text-center">Tindak Lanjut Risiko</h5>
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
                        <td>{{ $risiko->id_risiko }}</td>
                        <td>{{ $risiko->pernyataan_risiko }}</td>
                        <td>{{ $risiko->sebab }}</td>
                        <td>{{ $risiko->uc_c }}</td>
                        <td>{{ $risiko->dampak }}</td>
                        <td>{{ $risiko->pengendalian_uraian }}</td>
                        <td>{{ $risiko->desain_a ? '✔' : '-' }}</td>
                        <td>{{ $risiko->desain_t ? '✔' : '-' }}</td>
                        <td>{{ $risiko->efektivitas_te ? '✔' : '-' }}</td>
                        <td>{{ $risiko->efektivitas_ke ? '✔' : '-' }}</td>
                        <td>{{ $risiko->efektivitas_e ? '✔' : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <form method="POST" action="{{ route('laporan.risiko.tindaklanjut.simpan', $risiko->id) }}" novalidate>
            @csrf

            {{-- Hidden input untuk menjaga state pagination & filter --}}
            <input type="hidden" name="unit_filter" value="{{ request('unit') }}">
            <input type="hidden" name="page" value="{{ request('page') }}">

            <div class="row">
                <div class="col-md-6">
                    <label>Dampak</label>
                    <select name="dampak_risiko" id="dampak_risiko" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Dampak --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $labels = [1=>'Tidak Signifikan', 2=>'Rendah', 3=>'Menengah', 4=>'Besar', 5=>'Dahsyat'];
                            @endphp
                            <option value="{{ $i }}" {{ old('dampak_risiko', $risiko->dampak_risiko) == $i ? 'selected' : '' }}>
                                {{ $i }} - {{ $labels[$i] }}
                            </option>
                        @endfor
                    </select>
                    @error('dampak_risiko')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>Probabilitas</label>
                    <select name="probabilitas" id="probabilitas" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Probabilitas --</option>
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $labels = [1=>'Jarang', 2=>'Kecil', 3=>'Sedang', 4=>'Besar', 5=>'Hampir Pasti'];
                            @endphp
                            <option value="{{ $i }}" {{ old('probabilitas', $risiko->probabilitas) == $i ? 'selected' : '' }}>
                                {{ $i }} - {{ $labels[$i] }}
                            </option>
                        @endfor
                    </select>
                    @error('probabilitas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Nilai Risiko</label>
                    <input type="text" id="nilai_risiko" class="form-control" readonly value="{{ old('nilai_risiko', $risiko->nilai_risiko) }}">
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
                    <input type="text" class="form-control" name="keputusan_penanganan" value="YA" readonly>
                </div>

                <div class="col-md-6">
                    <label>Perlakuan Risiko</label>
                    <select name="perlakuan_risiko" class="form-control">
                        <option value="Mitigasi" {{ old('perlakuan_risiko', $risiko->perlakuan_risiko) == 'Mitigasi' ? 'selected' : '' }}>Mitigasi</option>
                    </select>
                    @error('perlakuan_risiko')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <label>Rencana Pengendalian</label>
                <textarea name="rencana_pengendalian" class="form-control" rows="3">{{ old('rencana_pengendalian', $risiko->rencana_pengendalian) }}</textarea>
                @error('rencana_pengendalian')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Jadwal Pengendalian</label>
                    <input type="date" name="jadwal_pengendalian" class="form-control" value="{{ old('jadwal_pengendalian', $risiko->jadwal_pengendalian) }}">
                    @error('jadwal_pengendalian')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>Penanggung Jawab</label>
                    @php
                        // Mengubah string penanggung_jawab dari DB menjadi array agar bisa dicek in_array
                        $pj_db = is_string($risiko->penanggung_jawab) ? explode(',', $risiko->penanggung_jawab) : ($risiko->penanggung_jawab ?? []);
                        $pj_selected = old('penanggung_jawab', $pj_db);
                    @endphp
                    <div class="row">
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
                    @error('penanggung_jawab')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('laporan.daftar_risiko.index', ['page' => request('page'), 'unit' => request('unit'), 'search' => request('search')]) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    // Jalankan fungsi hitung saat halaman pertama kali dimuat (untuk Mode Ubah)
    document.addEventListener('DOMContentLoaded', function() {
        hitungRisiko();
    });

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
        let level = '';
        let warna = '';

        if ([1,2,3,5,7,8].includes(nilai)) {
            level = 'Rendah'; warna = '#28a745'; // Green
        } else if ([4,10,11,13,20].includes(nilai)) {
            level = 'Moderat'; warna = '#ffc107'; // Yellow
        } else if ([6,12,14,16,17,21].includes(nilai)) {
            level = 'Tinggi'; warna = '#fd7e14'; // Orange
        } else {
            level = 'Ekstrim'; warna = '#dc3545'; // Red
        }

        document.getElementById('nilai_risiko').value = nilai;
        document.getElementById('nilai_risiko_hidden').value = nilai;

        let el = document.getElementById('level_risiko');
        el.value = level;
        el.style.backgroundColor = warna;
        el.style.color = (level === 'Moderat') ? 'black' : 'white';
    }
</script>
@endpush