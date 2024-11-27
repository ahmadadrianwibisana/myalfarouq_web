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

  <body class="services-page">
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

      <section
        id="featured-services"
        class="featured-services section"
        style="background-color: #f8f9fa; padding: 50px 0">
        <div class="container">
          <form
            action="#"
            method="GET"
            class="form-search d-flex align-items-center justify-content-center mb-3 p-4"
            style="
              background-color: white;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            ">
            <ul class="search-options d-flex gap-3 list-unstyled">
              <!-- Input untuk Search -->
              <li>
                <input
                  type="text"
                  name="search"
                  class="form-control search-input"
                  placeholder="Cari Open Trip...."
                  required />
              </li>

              <!-- Dropdown untuk Destinasi -->
              <li class="form-group">
                <select id="destination" name="destination" class="form-select">
                  <option value="*">Semua Destinasi</option>
                  <option value="malaysia">Malaysia</option>
                  <option value="singapura">Singapura</option>
                  <option value="thailand">Thailand</option>
                </select>
              </li>

              <!-- Dropdown untuk Durasi -->
              <li class="form-group">
                <select id="duration" name="duration" class="form-select">
                  <option value="*">Semua Durasi</option>
                  <option value="short-duration">3 Hari</option>
                  <option value="medium-duration">5 Hari</option>
                  <option value="long-duration">7 Hari</option>
                </select>
              </li>

              <!-- Tombol Pencarian -->
              <li>
                <button type="submit" class="btn btn-success btn-search">
                  <i class="fas fa-search"></i> Search
                </button>
              </li>
            </ul>
          </form>
        </div>
      </section>

      <!-- Services Section -->
      <section id="services" class="services section">
        <div
          class="isotope-layout"
          data-default-filter="*"
          data-layout="masonry"
          data-sort="original-order">
          <!-- Section Filter -->
          <ul
            class="portfolio-filters isotope-filters"
            data-aos="fade-up"
            data-aos-delay="100">
            <li data-filter="*" class="filter-active">Semua Paket</li>
            <li data-filter=".filter-satu-negara">Satu Negara</li>
            <li data-filter=".filter-dua-negara">Dua Negara</li>
            <li data-filter=".filter-tiga-negara">Tiga Negara</li>
          </ul>

          <!-- Card Items -->
          <div class="container">
            <div class="row gy-4 isotope-container">
              <!-- Card 1 - Satu Negara -->
              <div
                class="col-lg-4 col-md-6 filter-satu-negara malaysia short-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/open1.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 1 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 17 - 19 Juli<br /><i
                      class="bi bi-geo-alt icon-location"></i>
                    Malaysia
                  </p>
                  <a href="{{ url('/detailopen') }}" class="btn-detail"
                    ><span>Detail</span></a
                  >
                </div>
              </div>
              <!-- Card 2 - Dua Negara -->
              <div
                class="col-lg-4 col-md-6 filter-dua-negara malaysia singapura medium-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/0.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 2 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 18 - 22 Agustus<br /><i
                      class="bi bi-geo-alt icon-location"></i>
                    Malaysia, Singapura
                  </p>
                  <a href="{{ url('/detailopen') }}" class="btn-detail"
                    ><span>Detail</span></a
                  >
                </div>
              </div>
              <!-- Card 3 - Tiga Negara -->
              <div
                class="col-lg-4 col-md-6 filter-tiga-negara malaysia singapura thailand long-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/open3.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 3 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 23 - 28 November<br /><i
                      class="bi bi-geo-alt icon-location"></i>
                    Malaysia, Singapura, Thailand
                  </p>
                  <a href="{{ url('/detailopen') }}" class="btn-detail"
                    ><span>Detail</span></a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
              <li><a href="#">2 Negara : Start Pekanbaru</a></li>
              <li><a href="#">2 Negara : Start Dumai</a></li>
              <li><a href="#">3 Negara : Start Jakarta</a></li>
              <li><a href="#">3 Negara : Start Pekanbaru</a></li>
              <li><a href="#">1 Negara : Start Pekanbaru</a></li>
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

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
