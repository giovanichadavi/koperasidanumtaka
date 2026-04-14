@extends('adminlte::page')

@section('title', 'Tabel Risiko')
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@section('css')
<style>
    /* 1. Mencegah Card meluap di HP */
    .card-body {
        padding: 10px;
    }

    /* 2. Styling Tabel agar Muat Satu Layar (No Scroll) */
    .table-risk {
        width: 100%;
        table-layout: fixed; /* Memaksa lebar kolom sama rata */
        border-collapse: collapse;
        margin-bottom: 0;
    }

    /* Header & Cell General */
    .table-risk th, .table-risk td {
        padding: 8px 2px !important;
        text-align: center;
        vertical-align: middle !important;
        font-size: 11px; /* Ukuran font standar */
        border: 1px solid #dee2e6;
    }

    /* Header Kolom (Kemungkinan) */
    .table-risk thead th {
        background-color: #f4f6f9;
        font-weight: bold;
    }

    /* Kolom Pertama (Dampak) */
    .table-risk tbody th {
        background-color: #f4f6f9;
        width: 70px; /* Lebar kolom label dampak */
    }

    /* Sel Warna Risiko */
    .risk-cell {
        height: 60px; /* Membuat sel mendekati bentuk kotak */
        color: white;
        font-weight: bold;
        line-height: 1.2;
    }

    .risk-cell small {
        display: block;
        font-size: 9px;
        font-weight: normal;
        margin-top: 2px;
    }

    /* 3. RESPONSIVE SETUP (HP/Smartphone) */
    @media (max-width: 576px) {
        .table-risk th, .table-risk td {
            font-size: 9px; /* Perkecil font di HP */
            padding: 4px 1px !important;
        }

        .table-risk tbody th {
            width: 55px; /* Perkecil kolom label dampak di HP */
        }

        .risk-cell {
            height: 50px; /* Perkecil tinggi kotak di HP */
        }

        /* Sembunyikan teks panjang di HP, hanya tampilkan angka ID jika perlu */
        .hide-mobile {
            display: none;
        }
    }

    /* Penyesuaian Warna AdminLTE */
    .bg-danger { background-color: #dc3545 !important; }
    .bg-warning { background-color: #ffc107 !important; color: #212529 !important; }
    .bg-success { background-color: #28a745 !important; }
    .bg-orange { background-color: #fd7e14 !important; } /* Warna Tinggi */
</style>
@endsection

@section('content')
<div class="card mt-2 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-center font-weight-bold"><i class="fas fa-th-large mr-2"></i> Matriks Penilaian Risiko</h5>
    </div>

    <div class="card-body">
        <table class="table-risk">
            <thead>
                <tr>
                    <th rowspan="2" style="font-size: 9px;">Dampak /<br>Peluang</th>
                    <th>Jarang</th>
                    <th>Kecil</th>
                    <th>Sedang</th>
                    <th>Besar</th>
                    <th>Pasti</th>
                </tr>
                <tr>
                    <th>(1)</th>
                    <th>(2)</th>
                    <th>(3)</th>
                    <th>(4)</th>
                    <th>(5)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $labelDampak = [
                        1 => 'Tidak Signifikan',
                        2 => 'Rendah',
                        3 => 'Menengah',
                        4 => 'Besar',
                        5 => 'Dahsyat'
                    ];
                @endphp

                @for($d=5; $d>=1; $d--)
                <tr>
                    <th class="font-weight-bold">
                        {{ $labelDampak[$d] }}<br>
                        <small>({{ $d }})</small>
                    </th>
                    
                    @for($k=1; $k<=5; $k++)
                        @php
                            $cell = $risiko->where('dampak', $d)
                                           ->where('kemungkinan', $k)
                                           ->first();
                        @endphp
                        
                        @if($cell)
                            <td class="risk-cell bg-{{ $cell->warna }}">
                                {{ $cell->nilai_risiko }}<br>
                                <small>{{ $cell->tingkat_risiko }}</small>
                            </td>
                        @else
                            <td class="bg-light">-</td>
                        @endif
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
        
        {{-- Keterangan Singkat di Bawah Tabel --}}
        <div class="mt-3 d-sm-none" style="font-size: 10px; line-height: 1.5;">
            <p class="mb-0 text-muted"><b>Dampak:</b> Dhst (Dahsyat), Bsr (Besar), Mngh (Menengah), Rndh (Rendah), T.Sig (Tidak Signifikan)</p>
            <p class="mb-0 text-muted"><b>Peluang:</b> Jar (Jarang), Kcl (Kecil), Sed (Sedang), Bsr (Besar), Pst (Hampir Pasti)</p>
        </div>
    </div>
</div>
@endsection