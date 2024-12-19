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
            background-color: #f4f7fa; /* Light background for better contrast */
        }
        .modal-content {
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }
        .btn-cancel {
            border: 1px solid #28a745;
            color: #28a745;
            background-color: white;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s;
        }
        .btn-cancel:hover {
            background-color: #28a745;
            color: white;
        }
        .btn-order {
            background-color: #28a745;
            color: white;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s;
        }
        .btn-order:hover {
            background-color: #218838; /* Darker green on hover */
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px; /* Space between cards */
        }
        .card-header {
            background-color: #4CAF50; /* Light green background */
            color: white; /* White text for contrast */
            text-align: center;
            padding: 15px; /* Increased padding for better touch targets */
            font-weight: bold;
            font-size: 1.25rem; /* Larger font size for headers */
        }
        .card-body {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #1C1C1C;
        }
        .form-group {
            margin-bottom: 15px; /* Space between form elements */
        }
        .form-control {
            border-radius: 5px; /* Rounded corners for inputs */
            box-shadow: none; /* Remove default shadow */
            border: 1px solid #ced4da; /* Light border */
            transition: border-color 0.3s; /* Smooth transition for focus */
        }
        .form-control:focus {
            border-color: #28a745; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Add shadow on focus */
        }
        .container1 {
            max-width: 600px; /* Limit container width */
            margin: auto; /* Center container */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow */
            background-color: #ffffff; /* White background for the form */
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
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/user/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Upload Bukti Pembayaran</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li><a href="{{ route('user.tripsaya') }}">Trip Saya</a></li>
                    <li><a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}">Detail Pemesanan</a></li>
                    <li class="current">Upload Bukti Pembayaran</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>{{ isset($pembayaran) ? 'Edit Bukti Pembayaran' : 'Upload Bukti Pembayaran' }}</h5>
        </div>
        <div class="card-body">
        <form action="{{ route('user.uploadBuktiPembayaran', $pemesanan->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="form-group">
                    <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                    <input id="jumlah_pembayaran" type="text" class="form-control @error('jumlah_pembayaran') is-invalid @enderror" name="jumlah_pembayaran" value="{{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}" readonly>
                    @error('jumlah_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                    <input id="bukti_pembayaran" type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran" {{ isset($pembayaran) ? '' : 'required' }}>
                    @error('bukti_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Silakan unggah dokumen yang valid. Format yang diterima: <strong>PDF, JPG, PNG</strong> (maksimal 10MB).
                    </small>
                </div>

                @if(isset($pembayaran))
                    <div class="form-group">
                        <label>Bukti Pembayaran</label><br>
                        <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank">Lihat Bukti Pembayaran</a>
                    </div>
                @endif

                <div class="text-center">
                    <button type="submit" class="btn btn-order">{{ isset($pembayaran) ? 'Perbarui Bukti Pembayaran' : 'Upload Bukti Pembayaran' }}</button>
                    <a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
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