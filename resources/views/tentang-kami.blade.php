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

  <body class="contact-page">
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
          <!-- <li><a href="{{ url('/opentrip') }}">Trip Saya</a></li> -->
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
        style="background-image: url(assets/img/background.png)">
        <div class="container position-relative">
          <h1>Tentang Kami</h1>
          <p>
            Alfarouq Travel menawarkan paket perjalanan tour travel tiga negara
            yaitu Malaysia, Singapura dan Thailand dengan harga spesial khusus
            untuk per-orangan, keluarga dan rombongan.
          </p>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">Contact</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->

      <!-- Contact Section -->
      <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Whatsapp:</h3>
                <p>
                  <a href="https://wa.me/6282269497774" target="_blank">+62 822 6949 7774</a>
                </p>
                <p>
                  <a href="https://wa.me/6281234567890" target="_blank">+62 812 3456 7890</a>
                </p>
              </div>
            </div>
              <!-- End Info Item -->

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="400">
                <i class="bi bi-instagram flex-shrink-0"></i>
                <div>
                  <h3>Instagram:</h3>
                  <a
                    href="https://instagram.com/alfarouqtourtravel"
                    target="_blank"
                    >alfarouqtourtravel</a
                  >
                </div>
              </div>
              <!-- End Info Item -->

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-tiktok flex-shrink-0"></i>
                <div>
                  <h3>Tiktok:</h3>
                  <a
                    href="https://www.tiktok.com/@alfarouqtourtravel"
                    target="_blank"
                    >alfarouqtourtravel</a
                  >
                </div>
              </div>
              <!-- End Info Item -->

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-globe flex-shrink-0"></i>
                <div>
                  <h3>Website:</h3>
                  <p>alfarouqtourtravel.com</p>
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Location:</h3>
                  <a href="https://maps.app.goo.gl/KKLHJQEmDUC5Bre67"
                  >Jl. Hasanah
                  Simpang Tetap Darul Ihsan, Kec. Dumai Bar, Kota Dumai, Riau</a
                >
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email:</h3>
                  <a href="mailto:alfarouqtourtravel@gmail.com"
                    >alfarouqtourtravel@gmail.com</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-8">
              <iframe
                style="width: 100%; height: 500px"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.119996244095!2d101.4181536!3d1.6718094000000177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d3a8db4a46d61d%3A0xbb3c786e1901b0ab!2sJl.%20Hasanah%2C%20Simpang%20Tetap%20Darul%20Ihsan%2C%20Kec.%20Dumai%20Bar.%2C%20Kota%20Dumai%2C%20Riau%2028826!5e0!3m2!1sid!2sid!4v1736405876949!5m2!1sid!2sid"
                frameborder="0"
                allowfullscreen=""></iframe>
            </div>
          </div>
        </div>
      </section>
      <!-- /Contact Section -->
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
  </body>
</html>
