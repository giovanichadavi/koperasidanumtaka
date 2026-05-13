@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

{{-- Tambahkan SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        @yield('content_top_nav_right')

        {{-- ============================================================
             START: DROPDOWN NOTIFIKASI LOG AKTIVITAS (FINAL)
             ============================================================ --}}
        @php
            $recentLogs = \App\Models\LogAktivitas::whereDate('created_at', \Carbon\Carbon::today())
                            ->latest()
                            ->take(5)
                            ->get();
            $logCount = \App\Models\LogAktivitas::whereDate('created_at', \Carbon\Carbon::today())->count();
            $user = Auth::user();
            $isAdmin = $user && in_array($user->role, ['admin', 'admin_mr']);
        @endphp

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" title="Riwayat Aktivitas">
                <div class="notif-lingkaran-log">
                    <i class="fas fa-bell"></i> {{-- Icon Lonceng --}}
                    @if($logCount > 0)
                        <span class="navbar-badge badge-notif-custom">
                            {{ $logCount }}
                        </span>
                    @endif
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-0 shadow-lg">
                <span class="dropdown-item dropdown-header bg-light">{{ $logCount }} Aktivitas Hari Ini</span>
                <div class="dropdown-divider"></div>
                
                @forelse($recentLogs as $log)
                    <a href="{{ $isAdmin ? url('/log-aktivitas') : '#' }}" 
                       class="dropdown-item p-3" 
                       @if(!$isAdmin) onclick="showAccessDenied(); return false;" @endif>
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title font-weight-bold" style="font-size: 13px;">
                                    {{ $log->nama_user }}
                                    <span class="float-right text-sm text-muted">
                                        <i class="far fa-clock mr-1"></i>{{ $log->created_at->diffForHumans() }}
                                    </span>
                                </h3>
                                <p class="text-sm text-truncate mb-0" style="max-width: 220px;">
                                    {{ $log->aksi }}: {{ $log->keterangan }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @empty
                    <a href="#" class="dropdown-item text-center text-muted py-3">
                        <small>Tidak ada aktivitas hari ini</small>
                    </a>
                @endforelse

                @if($isAdmin)
                    <a href="{{ url('/log-aktivitas') }}" class="dropdown-item dropdown-footer bg-light font-weight-bold">
                        Lihat Semua Log Aktivitas
                    </a>
                @endif
            </div>
        </li>
        {{-- ============================================================
             END: DROPDOWN NOTIFIKASI
             ============================================================ --}}

        {{-- TOGGLE DARK MODE DENGAN ANIMASI --}}
        <li class="nav-item d-flex align-items-center px-2">
            <input type="checkbox" id="darkModeSwitch" style="display:none !important;" onclick="handleThemeToggle()">
            <label class="dark-mode-switch-label" for="darkModeSwitch">
                <div class="switch-ball">
                    <i class="fas fa-sun sun-icon"></i>
                    <i class="fas fa-moon moon-icon"></i>
                </div>
            </label>
        </li>

        {{-- USER MENU & ANIMASI LOGOUT --}}
        @if(Auth::user())
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                    <span class="mr-2 d-none d-md-inline font-weight-bold">{{ Auth::user()->name }}</span>
                    <div class="logout-anim-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-footer bg-transparent border-0">
                        <a href="#" class="btn btn-default btn-flat float-right logout-custom-btn"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off mr-2"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        @endif

        @if($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>
</nav>

<script>
    // Fungsi Pop-up Akses Ditolak (SweetAlert2)
    function showAccessDenied() {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Maaf, Anda tidak memiliki izin untuk mengakses Log Aktivitas ini.',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'OK',
            background: document.body.classList.contains('dark-mode') ? '#343a40' : '#fff',
            color: document.body.classList.contains('dark-mode') ? '#fff' : '#000'
        });
    }

    function handleThemeToggle() {
        const body = document.body;
        const switchInput = document.getElementById('darkModeSwitch');
        const isChecked = switchInput.checked;
        
        if (isChecked) {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        const switchInput = document.getElementById('darkModeSwitch');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            if(switchInput) switchInput.checked = true;
        }
    });
</script>