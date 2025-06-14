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

  <body class="get-a-quote-page">
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
          <h1>Private Trip</h1>
          <h2>Alfarouq Travel</h2>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">Private Trip</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->

      <!-- Get A Quote Section -->
      <section id="get-a-quote" class="get-a-quote section">
  <div class="container">
    <div class="row g-0" data-aos="fade-up" data-aos-delay="100">
      <!-- Left Column: Image -->
      <div class="col-lg-5 quote-bg" style="background-image: url(assets/img/private.jpg)"></div>

      <!-- Right Column: Form -->
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
        <form
          action="forms/get-a-quote.php"
          method="post"
          class="php-email-form"
          id="privateTripForm"
          onsubmit="handleSubmit(event)">
          <h2>PENDAFTARAN PRIVATE TRIP</h2>

          <div class="row gy-4">
            <div class="col-12">
              <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Masukkan Nama Lengkap"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                class="form-control"
                name="phone"
                placeholder="Masukkan No Telepon"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                name="delivery"
                class="form-control"
                placeholder="Masukkan Destinasi Keberangkatan"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                name="weight"
                class="form-control"
                placeholder="Masukkan Tanggal Keberangkatan"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                name="dimensions"
                class="form-control"
                placeholder="Masukkan Tanggal Kepulangan"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                name="departure"
                class="form-control"
                placeholder="Masukkan Starting Point"
                required="" />
            </div>

            <div class="col-12">
              <input
                type="text"
                name="dimensions"
                class="form-control"
                placeholder="Masukkan Jumlah Peserta"
                required="" />
            </div>

            <div class="col-12 text-center">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">
                Your quote request has been sent successfully. Thank you!
              </div>

              <!-- Submit Button -->
              <button type="submit">Submit</button>
            </div>
          </div>
        </form>

        <!-- Message and Login Button -->
        <div id="loginMessage" style="display: none; text-align: center; margin-top: 20px;">
          <h5>LOGIN DIPERLUKAN</h5>
          <p style="font-size: 16px; color: #276f5f;">Silakan login terlebih dahulu untuk melanjutkan </p>
          <a href="{{ url('/login') }}" class="btn btn-login">Login/Register</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Function to handle form submission
  function handleSubmit(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Hide the form and show the login message
    document.getElementById('privateTripForm').style.display = 'none';
    document.getElementById('loginMessage').style.display = 'block';
  }
</script>

<style>
  /* Custom Login Button Style */
  .btn-login {
    background-color: #276f5f;
    color: white; /* Make text color same as background */
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
    margin-top: 10px;
    border: 2px solid #276f5f; /* Add border to match button color */
  }

</style>

      <!-- /Get A Quote Section -->
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
