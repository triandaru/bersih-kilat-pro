<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">



    {{-- Role Owner --}}
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


    {{-- Role Kasir --}}
    @if (session('id_role') == 2)
        <li class="{{ Request::is('kasir/dashboard*') ? 'mm-active' : '' }}">
            <a href="<?= url('kasir/dashboard') ?>">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="{{ Request::is('kasir/pelanggan*') ? 'mm-active' : '' }}">
            <a href="<?= url('kasir/pelanggan') ?>">
                <div class="parent-icon"><i class="lni lni-network"></i>
                </div>
                <div class="menu-title">Pelanggan</div>
            </a>
        </li>
        <li class="{{ Request::is('kasir/transaksi*') ? 'mm-active' : '' }}">
            <a href="<?= url('kasir/transaksi') ?>">
                <div class="parent-icon"><i class="lni lni-agenda"></i>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
        </li>
    @endif

    <!--end navigation-->
</aside>
<!--end sidebar -->
