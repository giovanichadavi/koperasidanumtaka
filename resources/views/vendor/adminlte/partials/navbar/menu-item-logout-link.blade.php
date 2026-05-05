<li class="nav-item">
    <a class="nav-link logout-custom-btn" href="#" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-power-off mr-2"></i>
        <span>Keluar</span>
    </a>
</li>

<form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
    @if(config('adminlte.logout_method'))
        @method(config('adminlte.logout_method'))
    @endif
    @csrf
</form>