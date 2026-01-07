@extends('adminlte::page')

@section('title', 'Tambah Risiko')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h5>Tambah Daftar Risiko</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('laporan.daftar.risiko.store') }}">
            @csrf

            <div class="form-group mb-3">
                <label>Nama Unit</label>
                <select name="unit_nama" class="form-control" required>
                    <option value="">-- Pilih Unit --</option>
                    <option value="Lawe-Lawe">Unit Lawe-Lawe</option>
                    <option value="Sepaku">Unit Sepaku</option>
                    <option value="Waru">Unit Waru</option>
                    <option value="Sotek">Unit Sotek</option>
                    <option value="Maridan">Unit Maridan</option>
                    <option value="Babulu">Unit Babulu</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Nama Kegiatan</label>
                    <input type="text"
                        name="nama_kegiatan"
                        class="form-control"
                        placeholder="Masukkan nama kegiatan"
                        required>
            </div>

            <div class="form-group mb-3">
                <label>Tujuan Kegiatan</label>
                    <input type="text"
                        name="tujuan"
                        class="form-control"
                        placeholder="Masukkan tujuan kegiatan"
                        required>
            </div>

            
        <div class="form-group">
            <label class="fw-bold">Jenis Risiko</label>

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
                <div class="col-md-6">
                    <div class="custom-control custom-switch mb-2">
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
            <div class="form-group mb-3">
                <label>Pernyataan Risiko</label>
                <textarea name="pernyataan_risiko" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Sebab</label>
                <textarea name="sebab" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Dampak</label>
                <textarea name="dampak" class="form-control"></textarea>
            </div>

            <div class="text-end">
                <button class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection