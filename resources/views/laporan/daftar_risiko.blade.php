@extends('adminlte::page')

@section('title', 'Laporan Manajemen Risiko')

@section('content')
<div class="card mt-4 shadow-sm">
<div class="card-header">
<h5 class="mb-0 text-center">Manajemen Risiko</h5>
</div>

<div class="card-body">
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
<th rowspan="3">UC/C</th>
<th rowspan="3">Dampak Awal</th>

<th colspan="6">Pengendalian yang Ada</th>

<th rowspan="3">Probabilitas</th>
<th rowspan="3">Dampak</th>
<th rowspan="3">Nilai Risiko</th>
<th rowspan="3">Level Risiko</th>

<th rowspan="3">Keputusan Penanganan Risiko</th>
<th rowspan="3">Perlakuan Risiko</th>

<th colspan="2">Rencana Pengendalian</th>
<th rowspan="3">Penanggung Jawab</th>
<th rowspan="3">Aksi</th>
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
@foreach($risiko as $i=>$r)
<tr>
<td>{{ $risiko->firstItem()+$i }}</td>
<td>{{ $r->unit_nama }}</td>
<td>{{ $r->nama_kegiatan }}</td>
<td>{{ $r->tujuan }}</td>
<td>{{ $r->id_risiko }}</td>
<td>{{ $r->pernyataan_risiko }}</td>
<td>{{ $r->sebab }}</td>
<td>{{ $r->uc_c }}</td>
<td>{{ $r->dampak }}</td>

<td>{{ $r->pengendalian_uraian }}</td>
<td>{{ $r->desain_a ? '✔':'-' }}</td>
<td>{{ $r->desain_t ? '✔':'-' }}</td>
<td>{{ $r->efektivitas_te ? '✔':'-' }}</td>
<td>{{ $r->efektivitas_ke ? '✔':'-' }}</td>
<td>{{ $r->efektivitas_e ? '✔':'-' }}</td>

<td>{{ $r->probabilitas }}</td>
<td>{{ $r->dampak_risiko }}</td>
<td>{{ $r->nilai_risiko }}</td>

<td>
<span class="badge badge-{{ $r->warna_risiko }}">
{{ $r->level_risiko ?? 'Belum Dinilai' }}
</span>
</td>

<td>{{ $r->keputusan_penanganan ?? '-' }}</td>
<td>{{ $r->perlakuan_risiko ?? '-' }}</td>

<td>{{ $r->rencana_pengendalian }}</td>
<td>{{ $r->jadwal_pengendalian }}</td>
<td>{{ $r->penanggung_jawab }}</td>

<td>
<form action="{{ route('laporan.risiko.hapus',$r->id) }}" method="POST">
@csrf @method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
<a href="{{ route('laporan.risiko.tindaklanjut.form',$r->id) }}"
class="btn btn-success btn-sm">Tindak Lanjut</a>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

<a href="{{ route('laporan.daftar_risiko.pdf') }}" class="btn btn-danger btn-sm">
<i class="fas fa-file-pdf"></i> Download PDF
</a>

{{ $risiko->links() }}
</div>
</div>
</div>
@endsection