<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />


    <!-- Main CSS File -->
    <link href="{{ asset('assets/user/css/main.css') }}" rel="stylesheet" />
    <style>
    .view-count {
        margin-top: 10px; /* Jarak atas untuk badge */
        text-align: center; /* Pusatkan teks */
    }
    .badge {
        padding: 8px 12px; /* Padding untuk badge */
        font-size: 14px; /* Ukuran font */
        border-radius: 20px; /* Membuat badge bulat */
        background-color: #276f5f; /* Warna latar belakang badge */
        color: white; /* Warna teks badge */
    }
    .card {
        transition: transform 0.2s; /* Efek transisi saat hover */
    }
    .card:hover {
        transform: scale(1.05); /* Membesarkan kartu saat hover */
    }
  </style>
  </head>

  <body class="services-page">
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
          <h1>PAKET OPEN TRIP</h1>
          <h2>Alfarouq Travel</h2>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">Open Trip</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->
<!-- Open Trip Section -->
<section id="services" class="services section">
    <div class="container">
        <form action="{{ route('user.opentrip') }}" method="GET" class="form-search d-flex align-items-center justify-content-center mb-3 p-4" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <ul class="search-options d-flex gap-3 list-unstyled">
                <li>
                    <input type="text" name="search" class="form-control search-input" placeholder="Cari Open Trip...." value="{{ request('search') }}" />
                </li>
                <li class="form-group">
                    <select id="destination" name="destination" class="form-select">
                        <option value="*">Semua Destinasi</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination }}" {{ request('destination') == $destination ? 'selected' : '' }}>{{ $destination }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="form-group">
                    <select id="duration" name="duration" class="form-select">
                        <option value="*">Semua Durasi</option>
                        @foreach($durations as $duration)
                            <option value="{{ $duration }}" {{ request('duration') == $duration ? 'selected' : '' }}>{{ $duration }}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <button type="submit" class="btn btn-success btn-search">
                        <i class="fas fa-search"></i> Search
                    </button>
                </li>
            </ul>
        </form>

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <!-- Section Filter -->
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            </ul>

            <!-- Card Items -->
            <div class="row gy-4 isotope-container">
                @foreach($open_trips as $open_trip)
                    <div class="col-lg-4 col-md-6 filter-{{ strtolower(str_replace(' ', '-', $open_trip->destinasi)) }} {{ strtolower(str_replace(' ', '-', $open_trip->lama_keberangkatan)) }}" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('open_trip_images/' . $open_trip->image) }}" alt="Tour Image" class="img-fluid" />
                            </div>
                            <h3>{{ $open_trip->nama_paket }}</h3>
                            <p>
                                <i class="bi bi-clock icon-clock"></i> 
                                {{ \Carbon\Carbon::parse($open_trip->tanggal_berangkat)->format('d F Y') }} - 
                                {{ \Carbon\Carbon::parse($open_trip->tanggal_pulang)->format('d F Y') }}<br />
                                <i class="bi bi-geo-alt icon-location"></i> {{ $open_trip->destinasi }}<br />
                                <i class="bi bi-currency-dollar icon-price"></i> 
                                <strong>Rp {{ number_format($open_trip->harga, 2, ',', '.') }}</strong>
                            </p>
                            <a href="{{ route('user.detailopen', $open_trip->id) }}" class="btn-detail">
                                <span>Detail</span>
                            </a>
                            <div class="view-count">
                              <span class="badge">Telah dilihat: {{ $open_trip->view_count }} kali</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $open_trips->links() }}
        </div>
    </div>
</section>

    </main>

    <footer id="footer" class="footer dark-background">
      <div class="container footer-top">
        <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
            <a href="{{ route('user.home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/user/img/logo1.png') }}" alt="" />
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

    <div class="whatsapp-button">
      <a
        href="https://wa.me/6282269497774?text=Halo,%20saya%20ingin%20bertanya."
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span>Chat Kami</span>
      </a>
    </div>


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
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>


    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
