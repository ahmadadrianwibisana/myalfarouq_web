<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
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
  </head>

  <body class="get-a-quote-page">
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
    <div class="page-title dark-background" style="background-image: url('{{ asset('assets/user/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Private Trip</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="current">Private Trip</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

   <!-- Get A Quote Section -->
<!-- Get A Quote Section -->
<section id="get-a-quote" class="get-a-quote section">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-5 quote-bg" style="background-image:url('{{ asset('assets/user/img/private.jpg') }}')"></div>

            <div class="col-lg-7">
                <form id="privateTripForm" class="php-email-form">
                    <h2>PENDAFTARAN PRIVATE TRIP</h2>
                    <input type="hidden" id="no_telepon" value="{{ $user->no_telepon }}" />
                    <input type="hidden" id="nama_user" value="{{ $user->name }}" />
                    <div class="row gy-4">
                        <div class="col-12">
                            <input type="text" id="nama_trip" class="form-control" value="Private Trip" readonly required />
                        </div>
                        <div class="col-12">
                            <input type="text" id="destinasi" class="form-control" placeholder="Masukkan Destinasi" required />
                        </div>
                        <div class="col-12">
                            <input type="date" id="tanggal_pergi" class="form-control" required />
                        </div>
                        <div class="col-12">
                            <input type="date" id="tanggal_kembali" class="form-control" required />
                        </div>
                        <div class="col-12">
                            <input type="text" id="star_point" class="form-control" placeholder="Masukkan Starting Point" required />
                        </div>
                        <div class="col-12">
                            <input type="number" id="jumlah_peserta" class="form-control" placeholder="Masukkan Jumlah Peserta" required />
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" onclick="sendWhatsAppMessage()">
                                <i class="fas fa-paper-plane"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Success Message -->
                <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                    Data telah berhasil dikirim!
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function sendWhatsAppMessage() {
        // Get the values from the form
        const namaUser    = document.getElementById('nama_user').value;
        const noTelepon = document.getElementById('no_telepon').value;
        const namaTrip = document.getElementById('nama_trip').value; // This will always be "Private Trip"
        const destinasi = document.getElementById('destinasi').value;
        const tanggalPergi = document.getElementById('tanggal_pergi').value;
        const tanggalKembali = document.getElementById('tanggal_kembali').value;
        const starPoint = document.getElementById('star_point').value;
        const jumlahPeserta = document.getElementById('jumlah_peserta').value;

        // Construct the WhatsApp message
        const message = `*Pendaftaran Private Trip*\n\n` +
                        `Nama User: ${namaUser   }\n` +
                        `No Telepon: ${noTelepon}\n` +
                        `Nama Trip: ${namaTrip}\n` +
                        `Destinasi: ${destinasi}\n` +
                        `Tanggal Pergi: ${tanggalPergi}\n` +
                        `Tanggal Kembali: ${tanggalKembali}\n` +
                        `Starting Point: ${starPoint}\n` +
                        `Jumlah Peserta: ${jumlahPeserta}\n`;

        // Encode the message for URL
        const encodedMessage = encodeURIComponent(message);

        // WhatsApp API URL
        const phoneNumber = '+62081275037017'; // Replace with your WhatsApp number
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

        // Open WhatsApp
        window.open(whatsappUrl, '_blank');

        // Show success message
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'block';

        // Optionally, you can hide the success message after a few seconds
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000); // Hide after 5 seconds
    }
</script>


    <!-- /Get A Quote Section -->
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
  </body>
</html>
