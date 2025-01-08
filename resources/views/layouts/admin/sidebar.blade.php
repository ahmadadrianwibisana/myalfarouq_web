<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/templates/admin/img/logo.png') }}" alt="Logo" style="width: 200px; height: auto;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">AF</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>

            <!-- Dashboard Menu -->
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home" style="color: #3F51B5;"></i>                    
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Open Trip -->
            <li class="{{ Route::is('admin.open_trip') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.open_trip') }}">
                    <i class="fas fa-map-signs" style="color: #FF9800;"></i>                    
                    <span>Open Trip</span>
                </a>
            </li>

            <!-- Private Trip -->
            <li class="{{ Route::is('admin.private_trip') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.private_trip') }}">
                    <i class="fas fa-plane" style="color: #E91E63;"></i>                    
                    <span>Private Trip</span>
                </a>
            </li>
            
            <!-- Pemesanan -->
            <li class="{{ Route::is('admin.pemesanan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pemesanan') }}">
                    <i class="fas fa-receipt" style="color: #00BCD4;"></i>                    
                    <span>Pemesanan</span>
                </a>
            </li>

            <!-- Pembayaran -->
            <li class="{{ Route::is('admin.pembayaran') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pembayaran') }}">
                    <i class="fas fa-money-check-alt" style="color: #9C27B0;"></i>                    
                    <span>Pembayaran</span>
                </a>
            </li>

            <!-- Data Administrasi -->
            <li class="{{ Route::is('admin.data_administrasi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.data_administrasi') }}">
                    <i class="fas fa-folder-open" style="color: #673AB7;"></i>                    
                    <span>Data Administrasi</span>
                </a>
            </li>

        </ul>

    </aside>
</div>
