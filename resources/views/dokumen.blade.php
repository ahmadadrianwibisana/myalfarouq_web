<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet" />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
  </head>

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="" />
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>
          <li><a href="{{ url('/opentrip') }}">Open Trip</a></li>
          <li><a href="{{ url('/privatetrip') }}">Private Trip</a></li>
          <li><a href="{{ url('/dokumen') }}">Artikel</a></li>
          <li class="dropdown">
            <a href="#">
              <span>Profil</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li><a href="{{ url('/profil-kami') }}">Profil Kami</a></li>
              <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ url('/login') }}">Login</a>
    </div>
  </header>

      <main class="main">
      <!-- Page Title -->
      <div
        class="page-title dark-background"
        data-aos="fade"
        style="background-image:  url('{{ asset('assets/img/background.png') }}')">
        <div class="container position-relative">
          <h1>Artikel</h1>
          <h2>Dokumentasi Trip</h2>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">Artikel</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->

    <!-- Dokumentasi -->
<section id="artikel" class="artikel section">
    <div class="container section-title" data-aos="fade-up">
        <span>Dokumentasi<br /></span>
        <h2>Dokumentasi</h2>
    </div>
    <div class="container">
        <div class="row gy-4">
            @foreach($artikels as $artikelItem) <!-- Loop through each article -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-img">
                            @if($artikelItem->images->isNotEmpty()) <!-- Check if images exist -->
                                <img src="{{ asset('storage/' . $artikelItem->images->first()->image_path) }}" alt="" class="img-fluid" />
                            @else
                                <img src="assets/user/img/default.jpg" alt="Default Image" class="img-fluid" /> <!-- Default image if no image exists -->
                            @endif
                        </div>
                        <p class="card-info">
                            <i class="bi bi-calendar-event"></i> 
                            {{ date('d M Y', strtotime($artikelItem->tanggal_publish)) }}<br />
                            <i class="bi bi-file-earmark-text"></i> Dokumentasi
                        </p>
                        <h3 class="card-title">
                            <a href="{{ route('detail-artikel', $artikelItem->id) }}" class="stretched-link">
                                {{ $artikelItem->judul_artikel }} <!-- Display the article title -->
                            </a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Dokumentasi -->
      <!-- /Services Section -->
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container footer-top">
          <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-about">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
              <img src="assets/img/logo1.png" alt="" />
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
              <a href="https://maps.app.goo.gl/KKLHJQEmDUC5Bre67"
                >Jl. Hasanah
                Simpang Tetap Darul Ihsan, Kec. Dumai Bar, Kota Dumai, Riau</a
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
                    <li><a href="{{ route('home') }}" class="active">Home</a></li>
                    <li><a href="{{ route('opentrip') }}">Open Trip</a></li>
                    <li><a href="{{ route('privatetrip') }}">Private Trip</a></li>
                    <li><a href="{{ route('dokumen') }}">Artikel</a></li>
                    <li><a href="{{ route('profil.kami') }}">Profil Kami</a></li>
                </ul>
            </div>

  
            <div class="col-lg-2 col-6 footer-links">
              <h4>Trip Saya</h4>
              <ul>
              <li><a href="{{ url('/login') }}">Login Terlebih Dahulu Untuk Melihat Trip Saya</a></li>
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
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
