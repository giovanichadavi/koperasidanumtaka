@extends('adminlte::page')

@section('title', 'Log Aktivitas Sistem')
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@section('content_header')
    <h1><i class="fas fa-fingerprint mr-2 text-primary"></i>Log Aktivitas Sistem</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header">
        <h3 class="card-title text-bold">Riwayat Aktivitas Pengguna</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="text-center">No</th>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                        <th>Unit Terkait</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $key => $log)
                    @php
                        /** * LOGIKA PENGAMAN:
                         * Memastikan parameter 'id' tidak kosong di URL.
                         * Urutan prioritas: nama_kegiatan > id_risiko > potongan keterangan.
                         */
                        $valId = $log->nama_kegiatan ?: $log->id_risiko;
                        
                        if(!$valId) {
                            $valId = str_replace('Memperbarui data : ', '', $log->keterangan);
                        }
                        
                        $badgeClass = 'aksi-' . Str::slug($log->aksi);
                    @endphp

                    <tr style="cursor: pointer;" 
                        onclick="window.location='{{ url('laporan/daftar-risiko') }}?id={{ urlencode(trim($valId)) }}'"
                        title="Klik untuk melihat detail data: {{ $valId }}"
                        class="log-row">
                        
                        <td class="text-center text-muted">{{ $logs->firstItem() + $key }}</td>
                        <td class="text-nowrap">
                            <span class="font-weight-bold">{{ $log->created_at->format('d M Y') }}</span><br>
                            <small class="text-muted">{{ $log->created_at->format('H:i:s') }} WIB</small>
                        </td>
                        <td>
                            <span class="text-primary font-weight-bold">{{ $log->nama_user }}</span>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ strtoupper(str_replace('_', ' ', $log->role_user)) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge-log {{ $badgeClass }}">
                                {{ $log->aksi }}
                            </span>
                        </td>
                        <td>{{ $log->unit_terkait }}</td>
                        <td>
                            <strong class="text-info">{{ $log->keterangan }}</strong>
                            <i class="fas fa-external-link-alt ml-1 text-xs text-muted"></i>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-info-circle fa-2x mb-3 text-muted"></i><br>
                            <span class="text-muted font-italic">Belum ada riwayat aktivitas yang tercatat.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($logs->hasPages())
    <div class="card-footer clearfix">
        <div class="float-right">
            {{ $logs->links() }}
        </div>
    </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v={{ time() }}">
    <style>
        .log-row:hover {
            background-color: rgba(0, 123, 255, 0.08) !important;
        }
        .dark-mode .log-row:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        .text-info {
            color: #17a2b8 !important;
        }
    </style>
@stop