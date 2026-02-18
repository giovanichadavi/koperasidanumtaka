@extends('adminlte::page')

@section('title', 'Tindak Lanjut Risiko')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Nama Unit</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Nama Kegiatan</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Tujuan Kegiatan</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">ID Risiko</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Pernyataan Risiko</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Sebab</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">UC/C</th>
<th rowspan="3" style="vertical-align: middle; padding-top: 12px;">Dampak Awal</th>
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

<form method="POST" action="{{ route('laporan.risiko.tindaklanjut.simpan', $risiko->id) }}">
@csrf

<input type="hidden" name="unit" value="{{ request('unit') }}">
<input type="hidden" name="page" value="{{ request('page') }}">

<div class="row">
<div class="col-md-6">
<label>Dampak</label>
<select name="dampak_risiko" id="dampak_risiko" class="form-control" onchange="hitungRisiko()" required>
<option value="">-- Pilih Dampak --</option>
<option value="1">1 - Tidak Signifikan</option>
<option value="2">2 - Rendah</option>
<option value="3">3 - Menengah</option>
<option value="4">4 - Besar</option>
<option value="5">5 - Dahsyat</option>
</select>
</div>

<div class="col-md-6">
<label>Probabilitas</label>
<select name="probabilitas" id="probabilitas" class="form-control" onchange="hitungRisiko()" required>
<option value="">-- Pilih Probabilitas --</option>
<option value="1">1 - Jarang</option>
<option value="2">2 - Kecil</option>
<option value="3">3 - Sedang</option>
<option value="4">4 - Besar</option>
<option value="5">5 - Hampir Pasti</option>
</select>
</div>
</div>

<div class="row mt-3">
<div class="col-md-6">
<label>Nilai Risiko</label>
<input type="text" id="nilai_risiko" class="form-control" readonly>
<input type="hidden" name="nilai_risiko" id="nilai_risiko_hidden">
</div>

<div class="col-md-6">
<label>Level Risiko</label>
<input type="text" id="level_risiko" class="form-control" readonly>
</div>
</div>

<div class="row mt-3">
<div class="col-md-6">
<label>Keputusan Penanganan Risiko</label>
<input type="text" class="form-control" name="keputusan_penanganan" value="YA" readonly>
</div>

<div class="col-md-6">
<label>Perlakuan Risiko</label>
<select name="perlakuan_risiko" class="form-control" required>
<option value="Mitigasi">Mitigasi</option>
</select>
</div>
</div>

<div class="form-group mt-3">
<label>Rencana Pengendalian</label>
<textarea name="rencana_pengendalian" class="form-control" rows="3" required></textarea>
</div>

<div class="row mt-3">
<div class="col-md-6">
<label>Jadwal Pengendalian</label>
<input type="date" name="jadwal_pengendalian" class="form-control" required>
</div>

<div class="col-md-6">
<label>Penanggung Jawab</label>
<div class="row">
<div class="col-md-6">
@foreach(['Direktur','Manajer Produksi','Manajer Teknik'] as $i => $pj)
<div class="form-check">
<input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="{{ $pj }}" id="pj{{ $i }}">
<label class="form-check-label" for="pj{{ $i }}">{{ $pj }}</label>
</div>
@endforeach
</div>
<div class="col-md-6">
@foreach(['Manajer Keuangan','Kepala Unit'] as $i => $pj)
<div class="form-check">
<input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="{{ $pj }}" id="pjx{{ $i }}">
<label class="form-check-label" for="pjx{{ $i }}">{{ $pj }}</label>
</div>
@endforeach
</div>
</div>
</div>
</div>

<div class="text-right mt-4">
<button class="btn btn-success">
<i class="fas fa-save"></i> Simpan
</button>
</div>

</form>
</div>
</div>
@endsection

@push('js')
<script>
function hitungRisiko(){
let d = document.getElementById('dampak_risiko').value;
let p = document.getElementById('probabilitas').value;
if(!d || !p) return;

const matrix = {
1:{1:1,2:3,3:5,4:8,5:20},
2:{1:2,2:7,3:11,4:13,5:21},
3:{1:4,2:10,3:14,4:17,5:22},
4:{1:6,2:12,3:16,4:19,5:24},
5:{1:9,2:15,3:18,4:23,5:25}
};

let nilai = matrix[d][p];
let level = '';
let warna = '';

if ([1,2,3,5,7,8].includes(nilai)) {
level = 'Rendah'; warna = 'green';
} else if ([4,10,11,13,20].includes(nilai)) {
level = 'Moderat'; warna = 'yellow';
} else if ([6,12,14,16,17,21].includes(nilai)) {
level = 'Tinggi'; warna = 'orange';
} else {
level = 'Ekstrim'; warna = 'red';
}

document.getElementById('nilai_risiko').value = nilai;
document.getElementById('nilai_risiko_hidden').value = nilai;

let el = document.getElementById('level_risiko');
el.value = level;
el.style.backgroundColor = warna;
el.style.color = 'white';
}
</script>
@endpush