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

        <form method="POST" 
              action="{{ route('laporan.risiko.tindaklanjut.simpan', $risiko->id) }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label>Dampak</label>
                    <select name="dampak" id="dampak" class="form-control" onchange="hitungRisiko()">
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
                    <input type="text" name="penanggung_jawab" class="form-control">
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
function hitungRisiko() {
    let d = document.getElementById('dampak').value;
    let p = document.getElementById('probabilitas').value;

    if(!d || !p) return;

    let nilai = d * p;
    document.getElementById('nilai_risiko').value = nilai;

    let level = '';
    let warna = '';

    if ([1,2,3,5,7,8].includes(nilai)) {
        level = 'Rendah'; warna = 'green';
    } 
    else if ([4,10,11,13,20].includes(nilai)) {
        level = 'Moderat'; warna = 'gold';
    } 
    else if ([6,12,14,16,17,21].includes(nilai)) {
        level = 'Tinggi'; warna = 'orange';
    } 
    else {
        level = 'Ekstrim'; warna = 'red';
    }

    let el = document.getElementById('level_risiko');
    el.value = level;
    el.style.backgroundColor = warna;
    el.style.color = 'white';
}
</script>
@endpush