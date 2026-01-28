@extends('adminlte::page')

@section('title', 'Manajemen Risiko')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
    /* Nav unit agar rapi & profesional */
    .nav-unit .nav-link {
        padding: 6px 14px;
        margin-right: 6px;
        font-size: 14px;
        border-radius: 20px;
    }
</style>
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
<div class="card mt-4 shadow-sm">

    {{-- HEADER --}}
    <div class="card-header">
        <h5 class="mb-0 font-weight-semibold">Manajemen Risiko</h5>
    </div>

    <div class="card-body">

        {{-- NAV ROLE / UNIT --}}
        <ul class="nav nav-pills nav-unit mb-4 flex-wrap">
            @foreach($units as $unit)
                <li class="nav-item mb-2">
                    <a class="nav-link {{ $activeUnit == $unit ? 'active' : '' }}"
                       href="{{ route('laporan.daftar_risiko.index', ['unit' => $unit]) }}">
                        {{ $unit }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- FORM --}}
        <form id="form-tindaklanjut"
              method="POST"
              action="{{ route('laporan.risiko.tindaklanjut') }}">
            @csrf

            {{-- TABLE --}}
            <table class="table table-bordered table-hover table-striped">
    <thead class="text-center bg-light">
        <tr>
            <th width="4%">
                <input type="checkbox" onclick="toggleAll(this)">
            </th>
            <th width="4%">No</th>
            <th>Nama Unit</th>
            <th>Nama Kegiatan</th>
            <th>Tujuan</th>
            <th>ID Risiko</th>
            <th>Pernyataan Risiko</th>
            <th>Sebab</th>
            <th>Dampak</th>
            <th>Tingkat Risiko</th>
            <th>Level Risiko</th>
        </tr>
    </thead>

    <tbody>
        @forelse($risiko as $i => $r)
        <tr>
            <td class="text-center">
                <input type="checkbox"
                       name="risiko_ids[]"
                       value="{{ $r->id }}">
            </td>
            <td class="text-center">
                {{ $risiko->firstItem() + $i }}
            </td>
            <td>{{ $r->unit_nama }}</td>
            <td>{{ $r->nama_kegiatan }}</td>
            <td>{{ $r->tujuan }}</td>
            <td>{{ $r->id_risiko }}</td>
            <td>{{ $r->pernyataan_risiko }}</td>
            <td>{{ $r->sebab }}</td>
            <td>{{ $r->dampak }}</td>

            {{-- TINGKAT RISIKO --}}
            <td class="text-center">
                {{ $r->tingkat_risiko ?? '-' }}
            </td>

            {{-- LEVEL + WARNA --}}
            <td class="text-center">
                @if($r->level_risiko)
                    <span class="badge 
                        @if($r->warna_risiko == 'success') badge-success
                        @elseif($r->warna_risiko == 'warning') badge-warning
                        @elseif($r->warna_risiko == 'orange') badge-orange
                        @else badge-danger
                        @endif">
                        {{ $r->level_risiko }}
                    </span>
                @else
                    <span class="badge badge-secondary">Belum Dinilai</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11" class="text-center text-muted">
                Data risiko belum tersedia
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

    {{-- FOOTER --}}
    <div class="card-footer d-flex align-items-center">

        {{-- PAGINATION KIRI --}}
        <div class="mr-auto">
            {{ $risiko->links() }}
        </div>

        {{-- BUTTON KANAN --}}
        <button form="form-tindaklanjut"
                class="btn btn-success">
            <i class="fas fa-check-circle"></i> Tindak Lanjuti
        </button>
    </div>

</div>
@endsection

@push('js')
<script>
function toggleAll(source) {
    document.querySelectorAll('input[name="risiko_ids[]"]')
        .forEach(cb => cb.checked = source.checked);
}
</script>
@endpush