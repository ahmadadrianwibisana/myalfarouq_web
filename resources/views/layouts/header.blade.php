<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="{{ route('user.home') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/user/img/logo.png') }}" alt="Logo" />
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('user.home') }}" class="active">Home</a></li>
                <li><a href="{{ route('user.opentrip') }}">Open Trip</a></li>
                <li><a href="{{ route('user.privatetrip') }}">Private Trip</a></li>
                <li><a href="{{ route('user.dokumen') }}">Artikel</a></li>
                <li><a href="{{ route('user.tripsaya') }}">Trip Saya</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>Profil</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('user.profil-kami') }}">Profil Kami</a></li>
                        <li><a href="{{ route('user.tentang-kami') }}">Tentang Kami</a></li>
                    </ul>
                </li>
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-getstarted" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>