@extends('adminlte::page')

@section('title', 'Peta Risiko')
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection


@section('navbar-right')
<li class="nav-item">
    <a class="nav-link" href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endsection


@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Peta Risiko</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
            <thead class="text-center align-middle">
                <tr>
                    <th rowspan="2" class="align-middle text-center">
                        Dampak <br> Kemungkinan
                    </th>
                    <th>Jarang</th>
                    <th>Kecil</th>
                    <th>Sedang</th>
                    <th>Besar</th>
                    <th>Hampir Pasti</th>
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
                    @for($d=5;$d>=1;$d--)
                    <tr>
                        @php
    $labelDampak = [
        1 => 'Tidak Signifikan',
        2 => 'Rendah',
        3 => 'Menengah',
        4 => 'Besar',
        5 => 'Dahsyat'
    ];
@endphp

<th class="align-middle text-center">
    {{ $labelDampak[$d] }} <br>
    <small>({{ $d }})</small>
</th>
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