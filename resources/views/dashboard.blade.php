@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('navbar-right')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    ✅ {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif
@section('content_header')
<h1>Selamat Datang Di SiManis Danum Taka</h1>
@endsection

@section('content')
<div class="row">

    {{-- KIRI - Menggunakan col-md-6 --}}
    <div class="col-md-6 mb-3">
        <div class="card h-100"> {{-- h-100 memastikan tinggi card sama dengan sebelahnya --}}
            <div class="card-header bg-primary">
                <b>Jumlah Risiko Berdasarkan Unit / Divisi</b>
            </div>
            <div class="card-body">
                <canvas id="chartUnit"></canvas>
            </div>
        </div>
    </div>

    {{-- KANAN - Menggunakan col-md-6 agar sama rata --}}
    <div class="col-md-6 mb-3">
        <div class="card h-100"> {{-- h-100 memastikan tinggi card sama dengan sebelahnya --}}
            <div class="card-header bg-primary">
                <b>Status Risiko</b>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                {{-- Container ini menjaga agar Pie Chart tidak terlalu raksasa namun tetap proporsional --}}
                <div style="width: 100%; max-width: 300px; margin: 0 auto;">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
const unitLabels = {!! json_encode($risikoPerUnit->pluck('unit_nama')) !!};
const unitData = {!! json_encode($risikoPerUnit->pluck('total')) !!};

let rawStatusLabels = {!! json_encode($statusRisiko->pluck('status')) !!};
const statusData = {!! json_encode($statusRisiko->pluck('total')) !!};

// Mapping label
const statusLabels = rawStatusLabels.map(label => {
    return label === null ? 'Belum ditindaklanjuti' : label;
});

// BAR CHART (KIRI)
new Chart(document.getElementById('chartUnit'), {
    type: 'bar',
    data: {
        labels: unitLabels,
        datasets: [{
            data: unitData,
            backgroundColor: '#007bff'
        }]
    },
    options: {
        plugins: { legend: { display: false } }
    }
});

// PIE CHART (KANAN) + JUMLAH
new Chart(document.getElementById('chartStatus'), {
    type: 'pie',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: ['#007bff', '#dc3545']
        }]
    },
    options: {
        plugins: {
            legend: { position: 'bottom' },
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 12 },
                formatter: function(value, ctx) {
                    let label = ctx.chart.data.labels[ctx.dataIndex];
                    return label + ': ' + value;
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
</script>
@endpush