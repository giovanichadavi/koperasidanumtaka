@extends('adminlte::page')

@section('title', 'Edit Risiko | Legal Drafting')

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
            Edit Daftar Risiko Divisi Legal Drafting
        </label>
    </div>

    <div class="card-body d-flex flex-column">

        <form method="POST"
              action="{{ route('divisi_legal_drafting.risiko.update', $risiko->id) }}"
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
                        <input type="text"
                               name="nama_kegiatan"
                               class="form-control"
                               value="{{ $risiko->nama_kegiatan }}"
                               placeholder="Masukkan nama kegiatan"
                               required>
                    </div>

                    <div class="form-group mb-4">
                        <label>Tujuan Kegiatan</label>
                        <input type="text"
                               name="tujuan"
                               class="form-control"
                               value="{{ $risiko->tujuan }}"
                               placeholder="Masukkan tujuan kegiatan"
                               required>
                    </div>

                    <div class="form-group mb-4">
                        <label>Pernyataan Risiko</label>
                        <textarea name="pernyataan_risiko"
                                  class="form-control auto-resize"
                                  rows="2"
                                  placeholder="Tuliskan pernyataan risiko"
                                  required>{{ $risiko->pernyataan_risiko }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label>Dampak</label>
                        <textarea name="dampak"
                                  class="form-control auto-resize"
                                  rows="2"
                                  placeholder="Tuliskan dampak yang ditimbulkan"
                                  required>{{ $risiko->dampak }}</textarea>
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
                                  rows="2"
                                  placeholder="Tuliskan penyebab terjadinya risiko"
                                  required>{{ $risiko->sebab }}</textarea>
                    </div>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="d-flex justify-content-end border-top pt-3 mt-auto">
                <a href="{{ route('divisi_legal_drafting.risiko.index') }}"
                   class="btn btn-secondary">
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

{{-- STYLE --}}
@push('css')
<style>
    textarea {
        resize: none;
    }
</style>
@endpush