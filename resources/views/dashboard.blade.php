@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@push('css')
<style>
    /* ============================================================
       1. NAVBAR & SIDEBAR SOLID (ANTI-TRANSPARAN)
       ============================================================ */
    .main-header.navbar {
        background-color: #ffffff !important;
        opacity: 1 !important;
        border-bottom: 1px solid #dee2e6 !important;
    }

    .main-sidebar, 
    .main-sidebar.elevation-4 {
        background-color: #ffffff !important;
        opacity: 1 !important;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1) !important;
    }

    .dark-mode .main-header.navbar {
        background-color: #343a40 !important;
        border-bottom: 1px solid #4b545c !important;
    }

    .dark-mode .main-sidebar,
    .dark-mode .main-sidebar.elevation-4 {
        background-color: #343a40 !important;
        border-right: 1px solid #4b545c !important;
    }

    /* ============================================================
       2. ANIMASI TIMBUL PADA CARD & SMALL BOX (HOVER EFFECT)
       ============================================================ */
    .content-wrapper { 
        background-color: #f8f9fa !important; 
    }
    
    .dark-mode .content-wrapper { 
        background-color: #454d55 !important; 
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease !important;
    }
    
    .card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important; 
    }

    .small-box {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease !important;
        display: block;
        color: inherit;
        cursor: pointer;
    }

    .small-box:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
        text-decoration: none;
        color: inherit;
    }

    .card-header {
        background-color: #ffffff !important;
        border-bottom: 1px solid #f0f0f0;
        border-radius: 15px 15px 0 0 !important;
        padding: 1.2rem;
    }

    .dark-mode .card-header {
        background-color: #3f474e !important;
        border-bottom: 1px solid #4b545c;
    }

    .card-title-custom {
        color: #2d3436;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .dark-mode .card-title-custom, 
    .dark-mode .welcome-text {
        color: #ffffff !important;
    }

    .welcome-text {
        font-weight: 800;
        color: #2d3436;
        letter-spacing: -0.5px;
        margin-bottom: 20px;
    }

    .small-box .inner h3 { font-weight: 800; }
</style>
@endpush

@section('content_header')
    <h1 class="welcome-text">Selamat Datang Di Manajemen Risiko Danum Taka</h1>
@endsection

@section('content')

@php
    // SINKRONISASI DATA DENGAN DATABASE
    $dataSudah = $statusRisiko->firstWhere('status', 'ditindaklanjuti')->total ?? 0;
    $dataBaru = $statusRisiko->whereIn('status', [null, 'baru'])->sum('total') ?? 0;
    $totalSemua = $risikoPerUnit->sum('total');

    // Cek Role (Asumsi menggunakan Spatie Permission atau kolom 'role' di tabel users)
    $canAccess = false;
    if(Auth::check()){
        $userRole = Auth::user()->role; // Sesuaikan dengan cara Anda menyimpan role
        $canAccess = in_array($userRole, ['admin', 'admin_mr']);
    }
@endphp

<div class="row">
    {{-- KOTAK TOTAL RISIKO --}}
    <div class="col-lg-3 col-6">
        <div onclick="checkAccess('{{ url('/laporan/daftar-risiko') }}')" class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3>{{ $totalSemua }}</h3>
                <p>Total Risiko Terlapor</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="small-box-footer">
                Lihat Semua <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    {{-- KOTAK SUDAH DITINDAKLANJUTI --}}
    <div class="col-lg-3 col-6">
        <div onclick="checkAccess('{{ url('/laporan/daftar-risiko?unit=&status=sudah&search=') }}')" class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ $dataSudah }}</h3>
                <p>Sudah Ditindaklanjuti</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <div class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>

    {{-- KOTAK BARU --}}
    <div class="col-lg-3 col-6">
        <div onclick="checkAccess('{{ url('/laporan/daftar-risiko?unit=&status=belum&search=') }}')" class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3>{{ $dataBaru }}</h3>
                <p>Baru</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
            <div class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>

    {{-- KOTAK TOTAL UNIT --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3 class="text-white">{{ $risikoPerUnit->count() }}</h3>
                <p class="text-white">Total Unit/Divisi</p>
            </div>
            <div class="icon"><i class="fas fa-building"></i></div>
        </div>
    </div>
</div>

<div class="row mt-3">
    {{-- Bagian Grafik tetap sama --}}
    <div class="col-md-7 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center">
                <span class="card-title-custom">
                    <i class="fas fa-chart-bar mr-2 text-primary"></i> Sebaran Risiko Per Unit
                </span>
            </div>
            <div class="card-body">
                <div style="position: relative; height:320px;">
                    <canvas id="chartUnit"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center">
                <span class="card-title-custom">
                    <i class="fas fa-chart-pie mr-2 text-info"></i> Status Tindak Lanjut
                </span>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div style="width: 100%; max-width: 280px; position: relative;">
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
{{-- Memastikan SweetAlert2 tersedia --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fungsi Pengecekan Akses
    function checkAccess(targetUrl) {
        const canAccess = {{ $canAccess ? 'true' : 'false' }};
        
        if (canAccess) {
            window.location.href = targetUrl;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Maaf, Anda tidak memiliki izin untuk mengakses laporan ini.',
                confirmButtonColor: '#d33',
            });
        }
    }

    const isDarkMode = document.body.classList.contains('dark-mode');
    const gridColor = isDarkMode ? '#4b545c' : '#f0f0f0';
    const textColor = isDarkMode ? '#ffffff' : '#636e72';

    const unitLabels = {!! json_encode($risikoPerUnit->pluck('unit_nama')) !!};
    const unitData = {!! json_encode($risikoPerUnit->pluck('total')) !!};

    Chart.register(ChartDataLabels);
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = textColor;

    // BAR CHART
    new Chart(document.getElementById('chartUnit').getContext('2d'), {
        type: 'bar',
        data: {
            labels: unitLabels,
            datasets: [{
                data: unitData,
                backgroundColor: '#0984e3',
                borderRadius: 10,
                hoverBackgroundColor: '#0056b3',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false }, 
                datalabels: { display: false } 
            },
            scales: {
                y: { beginAtZero: true, grid: { color: gridColor, drawBorder: false }, ticks: { stepSize: 1, color: textColor } },
                x: { grid: { display: false }, ticks: { color: textColor } }
            }
        }
    });

    // DOUGHNUT CHART
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: ['baru', 'ditindaklanjuti'],
            datasets: [{
                data: [{{ $dataBaru }}, {{ $dataSudah }}], 
                backgroundColor: ['#0084ff', '#ff2c2c'], 
                borderWidth: 5,
                borderColor: isDarkMode ? '#343a40' : '#ffffff',
                hoverOffset: 20,
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, padding: 25, font: { weight: 'bold' }, color: textColor }
                },
                datalabels: {
                    color: '#fff',
                    font: { weight: '800', size: 14 },
                    formatter: (value) => value,
                }
            }
        }
    });
</script>
@endpush