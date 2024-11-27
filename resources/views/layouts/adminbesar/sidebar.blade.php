<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('adminbesar.dashboard') }}">
                <img src="assets/templates/admin/img/logo.png" alt="" style="width: 200px; height: auto;">
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('adminbesar.dashboard') }}">AF</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>

            <!-- Dashboard Menu -->
            <li class="{{ Route::is('adminbesar.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminbesar.dashboard') }}">
                    <i class="fas fa-home" style="color: #3F51B5;"></i>                    
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Artikel Menu -->
            <li class="{{ Route::is('adminbesar.artikel') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminbesar.artikel') }}">
                    <i class="fas fa-newspaper" style="color: #2196F3;"></i>
                    <span>Total Artikel</span>
                </a>
            </li>

            <!-- Laporan Menu -->
            <li class="{{ Route::is('adminbesar.laporan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminbesar.laporan') }}">
                    <i class="fas fa-file-alt" style="color: #FF5722;"></i>
                    <span>Total Laporan</span>
                </a>
            </li>

            <!-- Riwayat Menu -->
            <li class="{{ Route::is('adminbesar.riwayat') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminbesar.riwayat') }}">
                    <i class="fas fa-history" style="color: #FFC107;"></i>
                    <span>Total Riwayat</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
