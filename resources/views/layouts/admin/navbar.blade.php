<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if(Auth::guard('admin')->user()->foto)
                    <img alt="image" src="{{ asset('images/' . Auth::guard('admin')->user()->foto) }}" class="rounded-circle mr-1" style="width: 30px; height: 30px;">
                @else
                    <img alt="image" src="{{ asset('assets/templates/admin/img/default-avatar.png') }}" class="rounded-circle mr-1" style="width: 30px; height: 30px;">
                @endif
                <div class="d-sm-none d-lg-inline-block">{{ Auth::guard('admin')->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- Link to Admin Profile -->
                <a class="dropdown-item has-icon" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user" style="color: #3F51B5;"></i>                    
                    Profil Admin
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>