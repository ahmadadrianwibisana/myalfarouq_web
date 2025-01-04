<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Profil Pengguna</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/main.css') }}" rel="stylesheet" />
    
    <style>
   
        .profile-card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #FFFFFF;
            border-radius: 15px 15px 0 0;
        }
        .profile-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }
        .profile-header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .profile-header h2 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            color: #000000;
        }
        .edit-btn {
            background-color: #B2DAD3;
            border: none;
            border-radius: 15px;
            padding: 5px 15px;
            font-size: 14px;
            font-weight: bold;
            color: #000000;
        }
        .profile-content {
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 0 0 15px 15px;
        }
        .profile-content h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .profile-content p {
            font-size: 14px;
            margin: 5px 0;
        }
        .profile-content .row {
            margin-bottom: 10px;
        }
        .update-btn {
            background-color: #B2DAD3;
            border: none;
            border-radius: 15px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
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

<main class="main">
         <!-- Page Title -->
         <div
        class="page-title dark-background"
        data-aos="fade"
        style="background-image: url('{{ asset('assets/user/img/background.png') }}')">
        <div class="container position-relative">
          <h1>PROFIL PENGGUNA</h1>
          <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('user.home') }}">Home</a></li>
              <li class="current">Profil Pengguna</li>
            </ol>
          </nav>
        </div>
      </div>

    <!-- Profil Pengguna Section -->
    <section id="user-profile" class="user-profile section">
        <div class="container">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="d-flex align-items-center">
                        <img src="{{ $user->image ? asset('images/' . $user->image) : asset('assets/user/img/default-profile.png') }}" alt="{{ $user->name }}" />
                        <div class="ms-3">
                            <h1>Selamat Datang</h1>
                            <h2>{{ $user->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="profile-content">
                    <h3>Data Diri</h3>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Nama Lengkap</strong></p>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>No Telepon</strong></p>
                            <p>{{ $user->no_telepon }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Email</strong></p>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('user.editProfile') }}" class="update-btn">Ubah Data Diri</a>
                </div>
            </div>
        </div>
    </section>
</main>

<footer id="footer" class="footer dark-background">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-about">
            <a href="{{ route('user.home') }}" class="logo d-flex align-items-center">
              <img src="assets/user/img/logo1.png" alt="" />
            </a>
            <h5>CV. Alfarouq Tour and Travel</h5>
            <p>
              Alfarouq Travel menawarkan paket perjalanan tour travel tiga
              negara yaitu Malaysia, Singapura dan Thailand dengan harga spesial
              khusus untuk per-orangan, keluarga dan rombongan.
            </p>
          </div>

          <div
            class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Alamat Kami</h4>
            <p>
              <strong>Alamat:</strong>
              <a href="https://maps.app.goo.gl/DFDBN3553ycHLxTm7"
                >Jl. Dock Yard, Dumai, Riau, Indonesia</a
              >
            </p>
            <p>
              <strong>Email:</strong>
              <a href="mailto:alfarouqtourtravel@gmail.com"
                >alfarouqtourtravel@gmail.com</a
              >
            </p>
            <p>
              <strong>WhatsApp:</strong
              ><a href="https://wa.me/6282269497774" target="_blank"
                >+62 822 6949 7774</a
              >
            </p>
            <p>
              <strong>Instagram:</strong>
              <a href="https://instagram.com/alfarouqtourtravel" target="_blank"
                >alfarouqtourtravel</a
              >
            </p>
          </div>

          <div class="col-lg-2 col-6 footer-links">
              <h4>Menu</h4>
              <ul>
                <li><a href="{{ route('user.home') }}" class="active">Home</a></li>
                <li><a href="{{ route('user.opentrip') }}">Open Trip</a></li>
                <li><a href="{{ route('user.privatetrip') }}">Private Trip</a></li>
                <li><a href="{{ route('user.dokumen') }}">Artikel</a></li>
                <li><a href="{{ route('user.profil-kami') }}">Profil Kami</a></li>
              </ul>
          </div>


          <div class="col-lg-2 col-6 footer-links">
                    <h4>Trip Saya</h4>
                        <ul>
                            @if($pemesanans->isEmpty())
                                <li><a href="#">Anda belum melakukan pemesanan.</a></li>
                            @else
                                @foreach($pemesanans as $pemesanan)
                                    <li>
                                        <a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}">
                                        {{ $pemesanan->trip_type === 'open_trip' ? $pemesanan->openTrip->nama_paket : $pemesanan->privateTrip->nama_trip }} : Star
                                        {{ $pemesanan->trip_type === 'open_trip' ? $pemesanan->openTrip->star_point : $pemesanan->privateTrip->star_point }}
                                    </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                </div>
        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p>
          © <span>Copyright</span> <strong class="px-1 sitename">2024</strong>
          <span> Alfarouq Travel</span>
        </p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">MyAlfarouq_Travel</a>
        </div>
      </div>
    </footer>

    <!-- <div class="whatsapp-button">
      <a
        href="https://wa.me/6282269497774?text=Halo,%20saya%20ingin%20bertanya."
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span>Chat Kami</span>
      </a>
    </div> -->

    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/user/vendor/php-email-form/validate.js"></script>
    <script src="assets/user/vendor/aos/aos.js"></script>
    <script src="assets/user/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/user/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/user/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/user/js/main.js"></script>

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
