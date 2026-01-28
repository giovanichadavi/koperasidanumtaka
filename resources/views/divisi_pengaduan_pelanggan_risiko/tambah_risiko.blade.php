@extends('adminlte::page')

@section('title', 'Tambah Risiko | Pengaduan Pelanggan')

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
    <div class="card custom-card h-100 shadow-sm">

        <div class="card-header">
            <label class="mb-0 font-weight-semibold">
                Tambah Daftar Risiko Divisi Pengaduan Pelanggan
            </label>
        </div>

        <div class="card-body d-flex flex-column">

            <form method="POST"
                  action="{{ route('divisi_pengaduan_pelanggan.risiko.store') }}"
                  class="flex-grow-1 d-flex flex-column">
                @csrf

        <div class="row flex-grow-1">

            {{-- KOLOM KIRI --}}
            <div class="col-md-6">

                <div class="form-group mb-4">
                    <label>Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control"
                        placeholder="Masukkan nama kegiatan" required>
                </div>

                <div class="form-group mb-4">
                    <label>Tujuan Kegiatan</label>
                    <input type="text" name="tujuan" class="form-control"
                        placeholder="Masukkan tujuan kegiatan" required>
                </div>

                <div class="form-group mb-4">
                    <label>Pernyataan Risiko</label>
                    <textarea name="pernyataan_risiko" class="form-control auto-resize"
                            rows="2" required></textarea>
                </div>

                <div class="form-group mb-4">
                    <label>Dampak</label>
                    <textarea name="dampak" class="form-control auto-resize"
                            rows="2" required></textarea>
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
                                {{-- URAIAN (sama seperti Dampak) --}}
                                <td>
                                    <textarea name="pengendalian_uraian"
                                            class="form-control auto-resize"
                                            rows="2"
                                            placeholder="Tuliskan uraian pengendalian"></textarea>
                                </td>

                                {{-- DESAIN A --}}
                                <td>
                                    <input type="checkbox"
                                        name="desain_a"
                                        value="1">
                                </td>

                                {{-- DESAIN T --}}
                                <td>
                                    <input type="checkbox"
                                        name="desain_t"
                                        value="1">
                                </td>

                                {{-- EFEKTIVITAS --}}
                                <td>
                                    <input type="checkbox"
                                        name="efektivitas_te"
                                        value="1">
                                </td>
                                <td>
                                    <input type="checkbox"
                                        name="efektivitas_ke"
                                        value="1">
                                </td>
                                <td>
                                    <input type="checkbox"
                                        name="efektivitas_e"
                                        value="1">
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
    @endphp

    <div class="row">
        @foreach($jenisRisiko as $i => $risiko)
        <div class="col-sm-6 mb-2">
            <div class="custom-control custom-switch">
                <input type="checkbox"
                       class="custom-control-input"
                       id="risiko{{ $i }}"
                       name="id_risiko[]"
                       value="{{ $risiko }}">
                <label class="custom-control-label" for="risiko{{ $i }}">
                    {{ $risiko }}
                </label>
            </div>
        </div>
        @endforeach
    </div>
</div>

                <div class="form-group mb-4">
                    <label>Sebab</label>
                    <textarea name="sebab" class="form-control auto-resize"
                            rows="2" required></textarea>
                </div>

                {{-- INPUT BARU UC / C --}}
                <div class="form-group mb-4">
                    <label>UC / C</label>
                    <select name="uc_c" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="UC">UC</option>
                        <option value="C">C</option>
                    </select>
                </div>

            </div>
        </div>

                {{-- FOOTER --}}
                <div class="d-flex justify-content-end border-top pt-3 mt-auto">
                    <a href="{{ route('divisi_pengaduan_pelanggan.risiko.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary ml-2">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

{{-- AUTO RESIZE TEXTAREA --}}
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

{{-- CUSTOM STYLE --}}
@push('css')
<style>
    .content-wrapper {
        min-height: calc(100vh - 56px);
    }

    .custom-card {
        min-height: calc(100vh - 130px);
        margin-bottom: 20px;
    }

    textarea {
        resize: none;
    }
</style>
@endpush