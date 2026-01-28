@extends('adminlte::page')

@section('title', 'Edit Risiko | Perencanaan Anggaran')

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
<div class="container-fluid pt-4">
<div class="card custom-card shadow-sm">

    <div class="card-header">
        <label class="mb-0 font-weight-semibold">
            Edit Daftar Risiko Divisi Perencanaan Anggaran
        </label>
    </div>

    <div class="card-body d-flex flex-column">

        <form method="POST"
              action="{{ route('divisi_perencanaan_anggaran.risiko.update', $risiko->id) }}"
              class="flex-grow-1 d-flex flex-column">
            @csrf
            @method('PUT')

            @php
                $jenisRisiko = [
                    'Risiko Operasional',
                    'Risiko K3',
                    'Risiko Hukum',
                    'Risiko SDM',
                    'Risiko Keuangan',
                    'Risiko Transparansi',
                    'Risiko Kepatuhan'
                ];
                $selected = explode(', ', $risiko->id_risiko);
            @endphp

            <div class="row flex-grow-1">

                {{-- KOLOM KIRI --}}
                <div class="col-md-6">

                    <div class="form-group mb-4">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan"
                               class="form-control"
                               value="{{ $risiko->nama_kegiatan }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label>Tujuan Kegiatan</label>
                        <input type="text" name="tujuan"
                               class="form-control"
                               value="{{ $risiko->tujuan }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label>Pernyataan Risiko</label>
                        <textarea name="pernyataan_risiko"
                                  class="form-control auto-resize"
                                  rows="2" required>{{ $risiko->pernyataan_risiko }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label>Dampak</label>
                        <textarea name="dampak"
                                  class="form-control auto-resize"
                                  rows="2" required>{{ $risiko->dampak }}</textarea>
                    </div>

                    {{-- TABEL PENGENDALIAN --}}
                    <div class="form-group mb-4">
                        <label>Pengendalian</label>
                        <table class="table table-bordered text-center">
                            <thead>
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
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="pengendalian_uraian"
                                                  class="form-control auto-resize"
                                                  rows="2">{{ $risiko->pengendalian_uraian }}</textarea>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="desain_a" value="1"
                                            {{ $risiko->desain_a ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="desain_t" value="1"
                                            {{ $risiko->desain_t ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="efektivitas_te" value="1"
                                            {{ $risiko->efektivitas_te ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="efektivitas_ke" value="1"
                                            {{ $risiko->efektivitas_ke ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="efektivitas_e" value="1"
                                            {{ $risiko->efektivitas_e ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- KOLOM KANAN --}}
                <div class="col-md-6">

                    <div class="form-group mb-4">
                        <label class="mb-2">Jenis Risiko</label>
                        <div class="row">
                            @foreach($jenisRisiko as $i => $jr)
                                <div class="col-sm-6 mb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="jr{{ $i }}"
                                               name="id_risiko[]"
                                               value="{{ $jr }}"
                                               {{ in_array($jr, $selected) ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                               for="jr{{ $i }}">
                                            {{ $jr }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label>Sebab</label>
                        <textarea name="sebab"
                                  class="form-control auto-resize"
                                  rows="2" required>{{ $risiko->sebab }}</textarea>
                    </div>

                    {{-- UC / C --}}
                    <div class="form-group mb-4">
                        <label>UC / C</label>
                        <select name="uc_c" class="form-control" required>
                            <option value="UC" {{ $risiko->uc_c == 'UC' ? 'selected' : '' }}>UC</option>
                            <option value="C" {{ $risiko->uc_c == 'C' ? 'selected' : '' }}>C</option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="d-flex justify-content-end border-top pt-3 mt-auto">
                <a href="{{ route('divisi_perencanaan_anggaran.risiko.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-primary ml-2">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>
</div>
@endsection

@push('js')
<script>
document.querySelectorAll('.auto-resize').forEach(el => {
    el.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
});
</script>
@endpush

@push('css')
<style>
textarea { resize: none; }
</style>
@endpush