<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('images/logo-100.jpg') }}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Senjani Kitchen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/personel/ibeng-160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/profil/1" class="d-block">Ibeng Abdul Latif</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Personel
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/personel" class="nav-link">
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>Personel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jabatan" class="nav-link">
                                <i class="fas fa-address-card nav-icon"></i>
                                <p>Jabatan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hamburger"></i>
                        <p>
                            Paket
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/paket" class="nav-link">
                                <i class="fas fa-hamburger nav-icon"></i>
                                <p>Paket</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori-paket" class="nav-link">
                                <i class="fas fa-store nav-icon"></i>
                                <p>Kategori Paket</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/pelanggan" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="/pembelian" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pembelian
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pesanan" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Pesanan
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengantaran" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Pengantaran
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">LOGOUT</li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>