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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
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
<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Detail Open Trip</h1>
            <h2>{{ $open_trip->nama_paket }}</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('opentrip') }}">Open Trip</a></li>
                    <li class="current">Detail Open Trip</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="max-w-5xl mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <img alt="{{ $open_trip->nama_paket }}" class="rounded-lg shadow-md" height="400" src="{{ asset('open_trip_images/' . $open_trip->image) }}" width="600" />
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Include</h2>
                    <ul class="list-disc list-inside text-sm text-gray-700 mt-2">
                        <li>TIKET PESAWAT/KAPAL FERRY PULANG PERGI</li>
                        <li>HOTEL BINTANG 3/4</li>
                        <li>BUS PARIWISATA PREMIUM</li>
                        <li>MAKAN 3X SEHARI & SARAPAN DIHOTEL</li>
                        <li>DRIVER, MINYAK, TOL, dan PARKIR</li>
                        <li>TOUR LEADER dan TOUR GUIDE PROFESIONAL</li>
                        <li>PENGISIAN EAD MADC (Malaysia Digital Arrival Card)</li>
                        <li>DIPANDU PENGISIAN MOBILE SINGAPURA</li>
                        <li>FREE TIKET CABLE CAR GENTING HIGHLAND</li>
                        <li>FREE MINERAL WATER SETIAP HARI</li>
                        <li>FREE DOKUMENTASI FOTO dan VIDIO KONTEN</li>
                    </ul>
                </div>
            </div>
            <div class="md:w-1/2 md:pl-8 mt-8 md:mt-0">
                <h1 class="text-2xl font-semibold text-green-700">{{ $open_trip->nama_paket }}</h1>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-map-marker-alt mr-2 text-[#276f5f]"></i>
                    <span>{{ $open_trip->destinasi }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-calendar-alt mr-2 text-[#276f5f]"></i>
                    <span>{{ \Carbon\Carbon::parse($open_trip->tanggal_berangkat)->format('d F Y') }} - {{ \Carbon\Carbon::parse($open_trip->tanggal_pulang)->format('d F Y') }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-clock mr-2 text-[#276f5f]"></i>
                    <span>{{ $open_trip->lama_keberangkatan }}</span>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Kuota</h2>
                    <p class="text-sm text-gray-700">{{ $open_trip->kuota }} Peserta</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Satuan</h2>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($open_trip->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-700">Ada penyesuaian harga selain dari provinsi Riau</p>
                </div>
                <!-- Form Pemesanan -->
                <div class="mt-4">
                    <button id="confirmBooking" class="bg-black text-white px-4 py-2 rounded" onclick="showLoginModal()">Pesan Sekarang</button>
                </div>

                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-download mr-2"></i>
                    <a class="text-green-700" href="#">Unduh ITENERY</a>
                </div>
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Exclude</h2>
                    <ul class="list-disc list-inside text-sm text-gray-700 mt-2">
                        <li>CHOP PASSPORT IMIGRASI</li>
                        <li>JAJAN PRIBADI</li>
                        <li>EXTRA BAGASI</li>
                    </ul>
                    <div class="mt-4">
                        <h2 class="text-lg font-semibold text-green-700">Deskripsi</h2>
                        <p class="text-sm text-gray-700">{{ $open_trip->deskripsi_trip }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" style="display: none;">
        <div class="bg-[#a8ccc4] p-10 rounded-lg shadow-lg text-center">
            <h1 class="text-xl font-bold mb-6">LOGIN DIPERLUKAN</h1>
            <div class="bg-white p-4 rounded-lg mb-6">
                <p class="text-gray-800">Silakan login terlebih dahulu untuk melanjutkan</p>
            </div>
            <button onclick="window.location.href='{{ url('/login') }}'" class="bg-[#276f5f] text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-teal-700">
                Login/Register
            </button>
            <!-- Close Modal Button -->
            <button onclick="closeLoginModal()" class="mt-4 text-gray-700 hover:text-gray-900">Close</button>
        </div>
    </div>

    <!-- JavaScript to Show/Close Modal -->
    <script>
        // Show modal when button is clicked
        function showLoginModal() {
            document.getElementById('loginModal').style.display = 'flex';
        }

        // Close modal when close button is clicked
        function closeLoginModal() {
            document.getElementById('loginModal').style.display = 'none';
        }
    </script>

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
                    <a href="https://maps.app.goo.gl/DFDBN3553ycHLxTm7">Jl. Dock Yard, Dumai, Riau, Indonesia</a>
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
            © <span>Copyright</span> <strong class="px-1 sitename">2024</strong>
            <span> Alfarouq Travel</span>
        </p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">MyAlfarouq_Travel</a>
        </div>
    </div>
</footer>

<div class="whatsapp-button">
    <a href="https://wa.me/6282269497774?text=Halo,%20saya%20ingin%20bertanya." target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span>Chat Kami</span>
    </a>
</div>

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
</body>
</html>