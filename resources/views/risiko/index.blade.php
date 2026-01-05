@extends('adminlte::page')


@section('content_header')
    <h1>Halaman Risiko</h1>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection


@section('title', 'Peta Risiko')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Peta Risiko</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th rowspan="2">Dampak \ Kemungkinan</th>
                        <th>Jarang</th>
                        <th>Kecil</th>
                        <th>Sedang</th>
                        <th>Besar</th>
                        <th>Hampir Pasti</th>
                    </tr>
                    <tr>
                        <th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th>
                    </tr>
                </thead>
                <tbody>
                    @for($d=5;$d>=1;$d--)
                    <tr>
                        <th>Dampak {{ $d }}</th>
                        @for($k=1;$k<=5;$k++)
                            @php
                                $cell = $risiko->where('dampak',$d)
                                               ->where('kemungkinan',$k)
                                               ->first();
                            @endphp
                            <td class="bg-{{ $cell->warna }} text-white fw-bold">
                                {{ $cell->nilai_risiko }} <br>
                                <small>{{ $cell->tingkat_risiko }}</small>
                            </td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection