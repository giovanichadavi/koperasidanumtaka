<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0.3cm; } 
        body { font-family: DejaVu Sans, sans-serif; font-size: 6.5px; margin: 0; padding: 0; }
        
        table { border-collapse: collapse; width: 100%; table-layout: fixed; border: 1pt solid #000; }
        th, td { border: 1pt solid #000; padding: 2px 1px; text-align: center; vertical-align: middle; word-wrap: break-word; }
        
        thead th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; font-size: 6px; }
        
        .level-rendah { background: #28a745; color: #fff; }
        .level-moderat { background: #ffc107; color: #000; }
        .level-tinggi { background: #fd7e14; color: #fff; }
        .level-ekstrim { background: #dc3545; color: #fff; }

        .img-doc { 
            width: 100%; 
            height: auto; 
            max-height: 45px; 
            display: block; 
            margin: 0 auto; 
        }

        /* Helper untuk memaksa teks atas-bawah */
        .text-break { display: block; line-height: 8px; }
    </style>
</head>
<body>

    <h3 align="center" style="font-size: 9px; margin-bottom: 5px; text-transform: uppercase;">
        LAPORAN DAFTAR RISIKO PERUMDA AIR MINUM DANUM TAKA PPU TAHUN 2026
    </h3>

    <table>
<thead>
    <tr>
        <th rowspan="3" width="1.5%">No</th>
        <th rowspan="3" width="5%">Nama Unit</th>
        <th rowspan="3" width="6%">Nama Kegiatan</th>
        <th rowspan="3" width="5%">Tujuan</th>
        <th rowspan="3" width="4%">ID Risiko</th>
        <th rowspan="3" width="8%">Pernyataan Risiko</th>
        <th rowspan="3" width="6%">Sebab</th>
        <th rowspan="3" width="2%">UC/C</th>
        <th rowspan="3" width="6%">Dampak</th>

        <th colspan="6" width="17%">Pengendalian</th>

        <th rowspan="3" width="2.5%">Peluang</th>
        <th rowspan="3" width="2.5%">Dampak</th>
        <th rowspan="3" width="3%">Tingkat Risiko</th>

        <th rowspan="3" width="4%">
            <span class="text-break">Level</span>
            <span class="text-break">Risiko</span>
        </th>

        <th rowspan="3" width="5%">
            <span class="text-break">Keputusan</span>
            <span class="text-break">Penanganan</span>
            <span class="text-break">Risiko</span>
        </th>

        <th rowspan="3" width="5%">
            <span class="text-break">Perlakuan</span>
            <span class="text-break">Risiko</span>
        </th>

        <th colspan="2" width="13%">Rencana Pengendalian</th>

        <th rowspan="3" width="4%">PJTL</th>

        {{-- Tetap dipertahankan --}}
        <th rowspan="3" width="5%">
            <span class="text-break">Tgl</span>
            <span class="text-break">Pelaksanaan</span>
        </th>

        {{-- Tetap dipertahankan --}}
        <th rowspan="3" width="8%">
            <span class="text-break">Foto</span>
            <span class="text-break">Dokumentasi</span>
        </th>
    </tr>

    <tr>
        <th rowspan="2" width="11%">Uraian</th>

        <th colspan="2" width="2%">Desain</th>

        <th colspan="3" width="3%">Efektivitas</th>

        <th rowspan="2" width="9%">Uraian</th>
        <th rowspan="2" width="4%">Jadwal</th>
    </tr>

    <tr>
        <th width="1%">A</th>
        <th width="1%">T</th>

        <th width="1%">TE</th>
        <th width="1%">KE</th>
        <th width="1%">E</th>
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
                <td>{{ $r->desain_a ? '✔' : '-' }}</td>
                <td>{{ $r->desain_t ? '✔' : '-' }}</td>
                <td>{{ $r->efektivitas_te ? '✔' : '-' }}</td>
                <td>{{ $r->efektivitas_ke ? '✔' : '-' }}</td>
                <td>{{ $r->efektivitas_e ? '✔' : '-' }}</td>

                <td>{{ $r->probabilitas }}</td>
                <td>{{ $r->dampak_risiko }}</td>
                <td>{{ $r->nilai_risiko }}</td>

                <td class="@if($r->level_risiko == 'Rendah') level-rendah @elseif($r->level_risiko == 'Moderat' || $r->level_risiko == 'Sedang') level-moderat @elseif($r->level_risiko == 'Tinggi') level-tinggi @else level-ekstrim @endif">
                    {{ $r->level_risiko }}
                </td>

                <td>{{ $r->keputusan_penanganan }}</td>
                <td>{{ $r->perlakuan_risiko }}</td>
                <td>{{ $r->rencana_pengendalian }}</td>
                <td>{{ $r->jadwal_pengendalian }}</td>
                <td>{{ $r->penanggung_jawab }}</td>

                <td>{{ $r->tanggal_pelaksanaan ? \Carbon\Carbon::parse($r->tanggal_pelaksanaan)->format('d/m/Y') : '-' }}</td>
                <td style="padding: 0;">
                    @if($r->foto_dokumentasi && file_exists(storage_path('app/public/' . $r->foto_dokumentasi)))
                        @php
                            $path = storage_path('app/public/' . $r->foto_dokumentasi);
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" class="img-doc">
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>