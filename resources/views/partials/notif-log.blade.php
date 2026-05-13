@php
    $logCount = \App\Models\LogAktivitas::whereDate('created_at', \Carbon\Carbon::today())->count();
    $user = Auth::user();
    $isAdmin = $user && in_array($user->role, ['admin', 'admin_mr']);
@endphp

<li class="nav-item">
    <a class="nav-link" 
       href="{{ $isAdmin ? url('/log-aktivitas') : '#' }}" 
       @if(!$isAdmin) onclick="alert('Akses Ditolak: Menu ini khusus Admin.'); return false;" @endif>
        <div class="notif-lingkaran-log">
            <i class="fas fa-history"></i>
            @if($logCount > 0)
                <span class="badge badge-warning navbar-badge">{{ $logCount }}</span>
            @endif
        </div>
    </a>
</li>