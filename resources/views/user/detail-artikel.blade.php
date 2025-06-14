<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Alfarouq Tour Travel</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('assets/user/css/main.css') }}" rel="stylesheet" />
</head>

<body class="services-page">
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/user/img/logo.png') }}" alt="Logo" />
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
<main class="main detailartikel">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Detail Artikel</h1>
            <h2>{{ $artikel->judul_artikel }}</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('dokumen') }}">Artikel</a></li>
                    <li class="current">Detail Artikel</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

      <!-- detail-artikel.blade.php -->
      <section id="detail" class="detail section">
        <div class="container">
            <div class="row gy-4">
                <!-- Konten Utama -->
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="detail-content">
                        <!-- Teks Artikel -->
                        <h2 style="text-align: justify">
                            {{ $artikel->judul_artikel }}
                        </h2>
                        <p class="text-muted" style="text-align: justify">
                            <i class="bi bi-calendar-event" style="color: #276f5f"></i>
                            {{ date('d M Y', strtotime($artikel->tanggal_publish)) }} &nbsp;&nbsp;
                            <i class="bi bi-file-earmark-text" style="color: #276f5f"></i>
                            Dokumentasi
                        </p>
                        <p style="text-align: justify">
                            {{ $artikel->deskripsi }}
                        </p>

                    <!-- Galeri Tambahan -->
                    <div class="additional-gallery mt-4">
                        <h3>Galeri Tambahan</h3>
                        <div class="row">
                            @if ($artikel->images->isNotEmpty())
                                @foreach ($artikel->images as $image)
                                    <div class="col-4">
                                        <img src="{{ asset($image->image_path) }}" alt="Gallery Image" class="img-fluid rounded mb-3" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset($image->image_path) }}" />
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada gambar untuk artikel ini.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Modal untuk menampilkan gambar yang diperbesar -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Gambar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img id="modalImage" src="" alt="Gambar Besar" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Menangani klik pada gambar
                        document.querySelectorAll('.additional-gallery img').forEach(img => {
                            img.addEventListener('click', function() {
                                const imageSrc = this.getAttribute('data-image');
                                document.getElementById('modalImage').src = imageSrc;
                            });
                        });
                    </script>
                    </div>
                </div>
                <!-- End Konten Utama -->

                <!-- Sidebar -->
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="sidebar">
                       <!-- Gambar Utama -->
                        <div class="main-image mb-4">
                            @if ($artikel->images->isNotEmpty())
                                <img src="{{ asset($artikel->images->first()->image_path) }}" alt="Dokumentasi Artikel" class="img-fluid rounded" data-bs-toggle="modal" data-bs-target="#mainImageModal" data-image="{{ asset($artikel->images->first()->image_path) }}" />
                            @else
                                <img src="{{ asset('assets/img/default.jpg') }}" alt="Default Image" class="img-fluid rounded" />
                            @endif
                        </div>

                        <!-- Modal untuk menampilkan gambar utama yang diperbesar -->
                        <div class="modal fade" id="mainImageModal" tabindex="-1" aria-labelledby="mainImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mainImageModalLabel">Gambar Utama</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="mainModalImage" src="" alt="Gambar Utama" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Menangani klik pada gambar utama
                            document.querySelector('.main-image img').addEventListener('click', function() {
                                const imageSrc = this.getAttribute('data-image');
                                document.getElementById('mainModalImage').src = imageSrc;
                            });
                        </script>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
    </section>
    <!-- End Detail Section -->
</main>

<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('assets/user/img/logo1.png') }}" alt="" />
                </a>
                <h5>CV. Alfarouq Tour and Travel</h5>
                <p>
                    Alfarouq Travel menawarkan paket perjalanan tour travel tiga
                    negara yaitu Malaysia, Singapura dan Thailand dengan harga spesial
                    khusus untuk per-orangan, keluarga dan rombongan.
                </p>
            </div>
            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
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
                    <a href="mailto:alfarouqtourtravel@gmail.com">alfarouqtourtravel@gmail.com</a>
                </p>
                <p>
                    <strong>WhatsApp:</strong>
                    <a href="https://wa.me/6282269497774" target="_blank">+62 822 6949 7774</a>
                </p>
                <p>
                    <strong>Instagram:</strong>
                    <a href="https://instagram.com/alfarouqtourtravel" target="_blank">alfarouqtourtravel</a>
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
          © <span>Copyright</span> <strong class="px-1 sitename">2025</strong>
          <span> Alfarouq Travel</span>
        </p>
         <div class="credits">
          Designed by <a href="https://www.instagram.com/alfarouqtourtravel_web" target="_blank">AlfarouqTourTravel_Web</a>
        </div>
      </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

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
<!-- Link CSS Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Link JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>