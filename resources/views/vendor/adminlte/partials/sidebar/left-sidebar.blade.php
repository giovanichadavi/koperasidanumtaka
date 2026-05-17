<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu">

                {{-- ================= MENU UTAMA ================= --}}
                <li class="nav-header text-uppercase text-muted font-weight-bold">
                    MENU UTAMA
                </li>

                @foreach($adminlte->menu('sidebar') as $item)
                    {{-- FILTER MENU UTAMA --}}
                    @if(!isset($item['text']) || in_array($item['text'], ['Tabel Risiko','Log Aktivitas','Manajemen Admin','Akun']))
                        @continue
                    @endif

                    {{-- Menambahkan atribut wire:navigate secara dinamis --}}
                    @php $item['attributes'] = array_merge($item['attributes'] ?? [], ['wire:navigate' => 'true']); @endphp
                    @include('adminlte::partials.sidebar.menu-item', ['item' => $item])
                @endforeach


                {{-- ================= MENU TAMBAHAN ================= --}}
                <li class="nav-header text-uppercase text-muted font-weight-bold mt-2">
                    MENU TAMBAHAN
                </li>

                @foreach($adminlte->menu('sidebar') as $item)
                    @if(isset($item['text']) && in_array($item['text'], ['Tabel Risiko','Log Aktivitas']))
                        {{-- Menambahkan atribut wire:navigate secara dinamis --}}
                        @php $item['attributes'] = array_merge($item['attributes'] ?? [], ['wire:navigate' => 'true']); @endphp
                        @include('adminlte::partials.sidebar.menu-item', ['item' => $item])
                    @endif
                @endforeach


                {{-- ================= MENU AKUN ================= --}}
                <li class="nav-header text-uppercase text-muted font-weight-bold mt-2">
                    MENU AKUN
                </li>

                @foreach($adminlte->menu('sidebar') as $item)
                    @if(isset($item['text']) && in_array($item['text'], ['Manajemen Admin','Akun']))
                        {{-- Menambahkan atribut wire:navigate secara dinamis --}}
                        @php $item['attributes'] = array_merge($item['attributes'] ?? [], ['wire:navigate' => 'true']); @endphp
                        @include('adminlte::partials.sidebar.menu-item', ['item' => $item])
                    @endif
                @endforeach

            </ul>
        </nav>
    </div>

</aside>