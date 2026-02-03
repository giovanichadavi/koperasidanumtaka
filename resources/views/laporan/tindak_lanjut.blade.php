@extends('adminlte::page')

@section('title', 'Tindak Lanjut Risiko')

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
<div class="card shadow-sm mt-4">
    <div class="card-header">
        <h5 class="mb-0">Form Tindak Lanjut Risiko</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('laporan.risiko.tindaklanjut.simpan', $risiko->id) }}">
            @csrf
            <input type="hidden" name="unit" value="{{ $unit }}">

            <div class="row">
                <div class="col-md-6">
                    <label>Dampak</label>
                    <select name="dampak_risiko" id="dampak_risiko" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Dampak --</option>
                        <option value="1">1 - Tidak Signifikan</option>
                        <option value="2">2 - Rendah</option>
                        <option value="3">3 - Menengah</option>
                        <option value="4">4 - Besar</option>
                        <option value="5">5 - Dahsyat</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Probabilitas</label>
                    <select name="probabilitas" id="probabilitas" class="form-control" onchange="hitungRisiko()">
                        <option value="">-- Pilih Probabilitas --</option>
                        <option value="1">1 - Jarang</option>
                        <option value="2">2 - Kecil</option>
                        <option value="3">3 - Sedang</option>
                        <option value="4">4 - Besar</option>
                        <option value="5">5 - Hampir Pasti</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Tingkat Risiko</label>
                    <input type="text" id="nilai_risiko" class="form-control" readonly>
                    <input type="hidden" name="nilai_risiko" id="nilai_risiko_hidden">
                </div>

                <div class="col-md-6">
                    <label>Level Risiko</label>
                    <input type="text" id="level_risiko" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group mt-3">
                <label>Rencana Pengendalian</label>
                <textarea name="rencana_pengendalian" class="form-control" rows="3"></textarea>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Jadwal Pengendalian</label>
                    <input type="date" name="jadwal_pengendalian" class="form-control">
                </div>

<div class="col-md-6">
    <label>Penanggung Jawab</label>

    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="Direktur" id="pj1">
                <label class="form-check-label" for="pj1">Direktur</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="Manajer Produksi" id="pj2">
                <label class="form-check-label" for="pj2">Manajer Produksi</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="Manajer Teknik" id="pj3">
                <label class="form-check-label" for="pj3">Manajer Teknik</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="Manajer Keuangan" id="pj4">
                <label class="form-check-label" for="pj4">Manajer Keuangan</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="penanggung_jawab[]" value="Kepala Unit" id="pj5">
                <label class="form-check-label" for="pj5">Kepala Unit</label>
            </div>
        </div>
    </div>
</div>
            </div>

            <div class="text-right mt-4">
                <button class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
function hitungRisiko(){
    let d = document.getElementById('dampak_risiko').value;
    let p = document.getElementById('probabilitas').value;
    if(!d || !p) return;

    const matrix = {
        1:{1:1,2:3,3:5,4:8,5:20},
        2:{1:2,2:7,3:11,4:13,5:21},
        3:{1:4,2:10,3:14,4:17,5:22},
        4:{1:6,2:12,3:16,4:19,5:24},
        5:{1:9,2:15,3:18,4:23,5:25}
    };

    let nilai = matrix[d][p];
    let level = '';
    let warna = '';

    if ([1,2,3,5,7,8].includes(nilai)) {
        level = 'Rendah';
        warna = 'green';
    } else if ([4,10,11,13,20].includes(nilai)) {
        level = 'Moderat';
        warna = 'yellow';
    } else if ([6,12,14,16,17,21].includes(nilai)) {
        level = 'Tinggi';
        warna = 'orange';
    } else {
        level = 'Ekstrim';
        warna = 'red';
    }

    document.getElementById('nilai_risiko').value = nilai;
    document.getElementById('nilai_risiko_hidden').value = nilai;
    let el = document.getElementById('level_risiko');
    el.value = level;
    el.style.backgroundColor = warna;
    el.style.color = 'white';
}
</script>
@endpush