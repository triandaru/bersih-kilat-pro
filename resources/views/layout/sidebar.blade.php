<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">



    {{-- Role Admin --}}
    @if (session('id_akses') == 1)
        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item {{ Request::is('admin/layanan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/layanan') }}">
                <i class="fas fa-fw fa-clone"></i>
                <span>Layanan</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/transaksi*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/transaksi') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item {{ Request::is('admin/laporan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/laporan') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Laporan</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item {{ Request::is('admin/manajemen_user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/manajemen_user') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Manajemen User</span>
            </a>
        </li>

        <hr class="sidebar-divider">
    @endif


    {{-- Role User --}}
    @if (session('id_akses') == 2)
        <li class="nav-item {{ Request::is('user/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('user/dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item {{ Request::is('user/layanan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('user/layanan') }}">
                <i class="fas fa-fw fa-clone"></i>
                <span>Layanan</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('user/transaksi*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('user/transaksi') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Transaksi</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif

    <!--end navigation-->
</aside>
<!--end sidebar -->
