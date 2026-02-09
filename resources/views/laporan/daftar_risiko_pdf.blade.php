<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{font-family:DejaVu Sans;font-size:8px}
table{border-collapse:collapse;width:100%}
th,td{border:1px solid #000;padding:3px;text-align:center}
.level-rendah{background:#28a745;color:#fff}
.level-moderat{background:#ffc107}
.level-tinggi{background:#fd7e14;color:#fff}
.level-ekstrim{background:#dc3545;color:#fff}
</style>
</head>
<body>

<h3 align="center">Laporan Manajemen Risiko</h3>

<table>
<thead>
<tr>
<th rowspan="3">No</th>
<th rowspan="3">Nama Unit</th>
<th rowspan="3">Nama Kegiatan</th>
<th rowspan="3">Tujuan</th>
<th rowspan="3">ID Risiko</th>
<th rowspan="3">Pernyataan Risiko</th>
<th rowspan="3">Sebab</th>
<th rowspan="3">UC/C</th>
<th rowspan="3">Dampak</th>

<th colspan="6">Pengendalian</th>

<th rowspan="3">Prob</th>
<th rowspan="3">Dampak</th>
<th rowspan="3">Nilai</th>
<th rowspan="3">Level</th>
<th rowspan="3">Keputusan</th>
<th rowspan="3">Perlakuan</th>
<th colspan="2">Rencana</th>
<th rowspan="3">PJ</th>
</tr>

<tr>
<th rowspan="2">Uraian</th>
<th colspan="2">Desain</th>
<th colspan="3">Efektivitas</th>
<th rowspan="2">Uraian</th>
<th rowspan="2">Jadwal</th>
</tr>

<tr>
<th>A</th><th>T</th><th>TE</th><th>KE</th><th>E</th>
</tr>
</thead>

<tbody>
@foreach($risiko as $r)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $r->unit_nama }}</td>
<td>{{ $r->nama_kegiatan }}</td>
<td>{{ $r->tujuan }}</td>
<td>{{ $r->id_risiko }}</td>
<td>{{ $r->pernyataan_risiko }}</td>
<td>{{ $r->sebab }}</td>
<td>{{ $r->uc_c }}</td>
<td>{{ $r->dampak }}</td>

<td>{{ $r->pengendalian_uraian }}</td>
<td>{{ $r->desain_a?'✔':'-' }}</td>
<td>{{ $r->desain_t?'✔':'-' }}</td>
<td>{{ $r->efektivitas_te?'✔':'-' }}</td>
<td>{{ $r->efektivitas_ke?'✔':'-' }}</td>
<td>{{ $r->efektivitas_e?'✔':'-' }}</td>

<td>{{ $r->probabilitas }}</td>
<td>{{ $r->dampak_risiko }}</td>
<td>{{ $r->nilai_risiko }}</td>

<td class="
@if($r->level_risiko=='Rendah')level-rendah
@elseif($r->level_risiko=='Moderat')level-moderat
@elseif($r->level_risiko=='Tinggi')level-tinggi
@else level-ekstrim
@endif">
{{ $r->level_risiko }}
</td>

<td>{{ $r->keputusan_penanganan }}</td>
<td>{{ $r->perlakuan_risiko }}</td>
<td>{{ $r->rencana_pengendalian }}</td>
<td>{{ $r->jadwal_pengendalian }}</td>
<td>{{ $r->penanggung_jawab }}</td>
</tr>
@endforeach
</tbody>
</table>
</body>
</html>