@extends('adminlte::page')

@section('title', 'Tambah Risiko | Legal Drafting')

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
                Tambah Daftar Risiko Divisi Legal Drafting
            </label>
        </div>

        <div class="card-body d-flex flex-column">

            <form method="POST"
                  action="{{ route('divisi_legal_drafting.risiko.store') }}"
                  class="flex-grow-1 d-flex flex-column"
                  novalidate>
                @csrf

        <div class="row flex-grow-1">

            {{-- KOLOM KIRI --}}
            <div class="col-md-6">

                <div class="form-group mb-4">
                    <label>Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control"
                        placeholder="Masukkan Nama Kegiatan" required
                        value="{{ old('nama_kegiatan') }}">
                    @error('nama_kegiatan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Tujuan Kegiatan</label>
                    <input type="text" name="tujuan" class="form-control"
                        placeholder="Masukkan Tujuan Kegiatan" required
                        value="{{ old('tujuan') }}">
                    @error('tujuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Pernyataan Risiko</label>
                    <textarea name="pernyataan_risiko" class="form-control auto-resize"
                    placeholder="Masukkan Pernyataan Risiko"
                    rows="2" required>{{ old('pernyataan_risiko') }}</textarea>
                    @error('pernyataan_risiko')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Dampak</label>
                    <textarea name="dampak" class="form-control auto-resize"
                    placeholder="Masukkan Dampak Risiko"
                            rows="2" required>{{ old('dampak') }}</textarea>
                    @error('dampak')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

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
                                            rows="2"
                                            placeholder="Tuliskan Uraian Pengendalian">{{ old('pengendalian_uraian') }}</textarea>
                                    @error('pengendalian_uraian')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </td>

                                <td><input type="checkbox" name="desain_a" value="1" {{ old('desain_a') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="desain_t" value="1" {{ old('desain_t') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="efektivitas_te" value="1" {{ old('efektivitas_te') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="efektivitas_ke" value="1" {{ old('efektivitas_ke') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="efektivitas_e" value="1" {{ old('efektivitas_e') ? 'checked' : '' }}></td>
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
                       value="{{ $risiko }}"
                       {{ in_array($risiko, old('id_risiko', [])) ? 'checked' : '' }}>
                <label class="custom-control-label" for="risiko{{ $i }}">
                    {{ $risiko }}
                </label>
            </div>
        </div>
        @endforeach
    </div>
    @error('id_risiko')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

                <div class="form-group mb-4">
                    <label>Sebab</label>
                    <textarea name="sebab" class="form-control auto-resize"
                    placeholder="Masukkan Sebab Dari Risiko"
                            rows="2" required>{{ old('sebab') }}</textarea>
                    @error('sebab')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label>UC / C</label>
                    <select name="uc_c" class="form-control" required>
                        <option value="">-- Pilih Uncontrol atau Control --</option>
                        <option value="UC" {{ old('uc_c') == 'UC' ? 'selected' : '' }}>UC</option>
                        <option value="C" {{ old('uc_c') == 'C' ? 'selected' : '' }}>C</option>
                    </select>
                    @error('uc_c')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
        </div>

                <div class="d-flex justify-content-end border-top pt-3 mt-auto">
                    <a href="{{ route('divisi_legal_drafting.risiko.index') }}"
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