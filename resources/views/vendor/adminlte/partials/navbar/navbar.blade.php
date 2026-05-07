@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

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

        {{-- TOGGLE DARK MODE DENGAN ANIMASI --}}
        <li class="nav-item d-flex align-items-center px-3">
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
                    {{-- Tombol Logout Merah Solid --}}
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
    function handleThemeToggle() {
        const body = document.body;
        const isChecked = document.getElementById('darkModeSwitch').checked;
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