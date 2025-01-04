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
    <style>
        /* Sembunyikan tampilan mobile secara default */
        .mobile-view {
            display: none;
        }

        /* Tampilan responsif */
        @media (max-width: 768px) {
            .desktop-view {
                display: none; /* Sembunyikan tampilan desktop pada mobile */
            }
            .mobile-view {
                display: block; /* Tampilkan tampilan mobile */
            }
        }

        /* Gaya umum */
        .about {
            margin: 20px 0;
        }
    </style>
  </head>

  <body class="about-page">
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
          <h1>Profil</h1>
          <h1>Alfarouq Travel</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">About</li>
            </ol>
          </nav>
        </div>
      </div>
     <!-- About Section untuk Desktop -->
<section id="about" class="about section desktop-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Teks -->
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h2>WELCOME TO</h2>
                <h3><span class="green-text">ALFAROUQ TRAVEL</span></h3>
                <h6>Emang Beda Wak</h6>
                <p>
                    Alfaraouq Travel menawarkan paket perjalanan tur tiga negara,
                    yaitu Malaysia, Singapura, dan Thailand dengan harga spesial
                    yang cocok untuk per-orangan, keluarga, dan rombongan. Paket ini
                    juga sudah mencakup berbagai fasilitas, sehingga Anda hanya
                    perlu duduk santai dan menikmati liburan Anda di ketiga negara
                    tersebut.
                </p>
            </div>

            <!-- Kolom Gambar -->
            <div class="col-lg-6 d-flex justify-content-center order-lg-last" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/profil1.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section kedua untuk Desktop -->
<section id="about" class="about section desktop-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar -->
            <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/zz.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks -->
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h2>CV. Alfarouq Tour and Travel</h2>
                <h3>
                    <span class="green-text">Penawaran Jasa dan Tiket Perjalanan</span>
                </h3>
                <h6>Adapun Penawaran Jasa yang Kami Tawarkan:</h6>
                <p>Temukan pengalaman perjalanan yang tak terlupakan bersama kami! Pilih salah satu penawaran jasa di bawah ini dan nikmati kemudahan dalam merencanakan perjalanan Anda. Kami siap membantu Anda mewujudkan liburan impian!</p>
                <ol id="service-list">
                    <li><a href="#" onclick="orderService('Paket Wisata Terima Bersih dalam dan luar negeri')">Paket Wisata Terima Bersih dalam dan luar negeri</a></li>
                    <li><a href="#" onclick="orderService('Tiket Pesawat + Bagasi')">Tiket Pesawat + Bagasi</a></li>
                    <li><a href="#" onclick="orderService('Tiket Kapal Ferry')">Tiket Kapal Ferry</a></li>
                    <li><a href="#" onclick="orderService('Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)')">Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)</a></li>
                    <li><a href="#" onclick="orderService('Bookingan Hotel mulai dari *2-*5 ')">Bookingan Hotel mulai dari *2-*5</a></li>
                    <li><a href="#" onclick="orderService('Jasa Tour Get & Tour Leader')">Jasa Tour Get & Tour Leader</a></li>
                    <li><a href="#" onclick="orderService('Pembelian Tiket Wisata semua negara')">Pembelian Tiket Wisata semua negara</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- About Section untuk Mobile -->
<section id="about" class="about section mobile-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar untuk Mobile -->
            <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/profil1.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks untuk Mobile -->
            <div class="col-12 content" data-aos="fade-up" data-aos-delay="100">
                <h2>WELCOME TO</h2>
                <h3><span class="green-text">ALFAROUQ TRAVEL</span></h3>
                <h6>Emang Beda Wak</h6>
                <p>
                    Alfaraouq Travel menawarkan paket perjalanan tur tiga negara,
                    yaitu Malaysia, Singapura, dan Thailand dengan harga spesial
                    yang cocok untuk per-orangan, keluarga, dan rombongan. Paket ini
                    juga sudah mencakup berbagai fasilitas, sehingga Anda hanya
                    perlu duduk santai dan menikmati liburan Anda di ketiga negara
                    tersebut.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Section kedua untuk Mobile -->
<section id="about" class="about section mobile-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar untuk Mobile -->
            <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/zz.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks untuk Mobile -->
            <div class="col-12 content" data-aos="fade-up" data-aos-delay="100">
                <h2>CV. Alfarouq Tour and Travel</h2>
                <h3>
                    <span class="green-text">Penawaran Jasa dan Tiket Perjalanan</span>
                </h3>
                <h6>Adapun Penawaran Jasa yang Kami Tawarkan:</h6>
                <p>Temukan pengalaman perjalanan yang tak terlupakan bersama kami! Pilih salah satu penawaran jasa di bawah ini dan nikmati kemudahan dalam merencanakan perjalanan Anda. Kami siap membantu Anda mewujudkan liburan impian!</p>
                <ol id="service-list">
                    <li><a href="#" onclick="orderService('Paket Wisata Terima Bersih dalam dan luar negeri')">Paket Wisata Terima Bersih dalam dan luar negeri</a></li>
                    <li><a href="#" onclick="orderService('Tiket Pesawat + Bagasi')">Tiket Pesawat + Bagasi</a></li>
                    <li><a href="#" onclick="orderService('Tiket Kapal Ferry')">Tiket Kapal Ferry</a></li>
                    <li><a href="#" onclick="orderService('Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)')">Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)</a></li>
                    <li><a href="#" onclick="orderService('Bookingan Hotel mulai dari *2-*5')">Bookingan Hotel mulai dari *2-*5</a></li>
                    <li><a href="#" onclick="orderService('Jasa Tour Get & Tour Leader')">Jasa Tour Get & Tour Leader</a></li>
                    <li><a href="#" onclick="orderService('Pembelian Tiket Wisata semua negara')">Pembelian Tiket Wisata semua negara</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<script>
  function orderService(service) {
    const message = `Saya mau pesan: ${service}`;
    const phoneNumber = '+6281275037017'; // Ganti dengan nomor WhatsApp Admin Anda
    const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message )}`;
    window.open(url, '_blank');
  }
</script>


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
