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
    <style>
body {
    background-color: #f8f9fa; /* Warna latar belakang yang lebih terang */
}

.card-custom {
    max-width: 70%; /* Atur lebar maksimum kartu menjadi 90% dari lebar layar */
    width: 600px; /* Lebar tetap untuk layar besar */
    margin: 20px auto; /* Pusatkan kartu di dalam container */
    background-color: #276f5f; /* Warna latar belakang kartu */
    border-radius: 15px; /* Sudut melengkung */
    padding: 20px; /* Tambahkan padding di dalam kartu */
    color: white; /* Warna teks di dalam kartu */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
    transition: transform 0.3s, box-shadow 0.3s; /* Transisi untuk efek hover */
}

.card-custom:hover {
    transform: translateY(-5px); /* Efek mengangkat saat hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam saat hover */
}

.btn-custom {
    background-color: #dc3545; /* Warna tombol */
    color: white; /* Warna teks tombol */
    border: none; /* Tanpa border */
    border-radius: 5px; /* Sudut melengkung tombol */
    padding: 10px 15px; /* Padding tombol */
    transition: background-color 0.3s; /* Transisi untuk efek hover */
}

.btn-custom:hover {
    background-color: #c82333; /* Warna tombol saat hover */
}

.header-custom {
    background-color: #2d2d2d; /* Warna latar belakang header */
    color: white; /* Warna teks header */
    padding: 15px 20px; /* Padding header */
    border-radius: 15px; /* Sudut melengkung header */
    display: flex; /* Flexbox untuk tata letak */
    align-items: center; /* Pusatkan item secara vertikal */
    text-align: center; /* Pusatkan teks di header */
}

.status-btn {
    color: white; /* Warna teks status */
    border-radius: 15px; /* Sudut melengkung */
    padding: 5px 10px; /* Padding status */
    font-weight: bold; /* Tebal untuk teks status */
}

.status-pending {
    background-color: #ffc107; /* Warna kuning untuk status 'pending' */
}

.status-confirmed {
    background-color: #28a745; /* Warna hijau untuk status 'terkonfirmasi' */
}

.status-cancelled {
    background-color: #dc3545; /* Warna merah untuk status 'dibatalkan' */
}

/* Media Queries untuk responsivitas */
@media (max-width: 768px) {
    .card-custom {
        padding: 15px; /* Kurangi padding pada layar kecil */
        width: 95%; /* Lebar kartu menjadi 95% pada layar kecil */
    }
    .header-custom {
        font-size: 1.2rem; /* Sesuaikan ukuran font pada header */
    }
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
   <!-- Flash Messages -->
   
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/user/img/background.png') }}')">
        <div class="container position-relative">
            <h1>TRIP SAYA</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="current">Trip Saya</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section id="get-a-quote" class="get-a-quote section">
        <div class="container mt-4">
        @if($pemesanans->isEmpty())
            <div class="alert alert-info text-center">
                Anda belum melakukan pemesanan.
            </div>
        @else
            @foreach($pemesanans as $pemesanan)
                <div class="card card-custom mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            @if($pemesanan->trip_type === 'open_trip' && $pemesanan->openTrip && $pemesanan->openTrip->image)
                                <img alt="Open Trip Image" class="img-fluid rounded" 
                                    src="{{ asset('open_trip_images/' . $pemesanan->openTrip->image) }}" />
                            @elseif($pemesanan->trip_type === 'private_trip' && $pemesanan->privateTrip && $pemesanan->privateTrip->image)
                                <img alt="Private Trip Image" class="img-fluid rounded" 
                                    src="{{ asset('private_trip_images/' . $pemesanan->privateTrip->image) }}" />
                            @else
                                <img alt="Default Image" class="img-fluid rounded" 
                                    src="{{ asset('default_image_url.jpg') }}" />
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-6"> 
                                    <h5 class="text-white">
                                        {{ ucwords($pemesanan->openTrip->nama_paket ?? $pemesanan->privateTrip->nama_trip) }}
                                        <span class="text-white">({{ ucfirst($pemesanan->trip_type) }})</span>
                                    </h5>
                                </div>
                                <div class="col-6"> 
                                        <p>
                                            <strong>Tanggal Pemesanan</strong><br/>
                                            {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            <div class="row"> 
                                <div class="col-6"> 
                                    <strong>Nama</strong><br/>        
                                    <p class="text-white">{{ ucwords($pemesanan->user->name) }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>No Telepon</strong><br/>          
                                    <p class="text-white">{{ $pemesanan->user->no_telepon }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user"></i>
                                <span class="ms-2">{{ $pemesanan->jumlah_peserta }} Orang</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        <strong>Star Point</strong><br/>
                                        {{ $pemesanan->openTrip->star_point ?? $pemesanan->privateTrip->star_point ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <strong>Destinasi</strong><br/>
                                        {{ $pemesanan->openTrip->destinasi ?? $pemesanan->privateTrip->destinasi ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="row">
                                    @if($pemesanan->trip_type == 'open_trip')
                                        <div class="col-6">
                                            <p>
                                                <strong>Keberangkatan</strong><br/>
                                                {{ \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_berangkat)->format('d F Y') }}
                                            </p>
                                        </div>

                                        <div class="col-6">
                                            <p>
                                                <strong>Kepulangan</strong><br/>
                                                {{ \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_pulang)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @elseif($pemesanan->trip_type == 'private_trip')
                                        <div class="col-6">
                                            <p>
                                                <strong>Keberangkatan</strong><br/>
                                                {{ \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_pergi)->format('d F Y') }}
                                            </p>
                                        </div>

                                        <div class="col-6">
                                            <p>
                                                <strong>Kepulangan</strong><br/>
                                                {{ \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_kembali)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="bg-white"/> <!-- Mengubah warna garis pemisah menjadi putih -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white"><strong>Status</strong></p>
                            <span class="status-btn 
                                {{ $pemesanan->status == 'pending' ? 'status-pending' : 
                                ($pemesanan->status == 'terkonfirmasi' ? 'status-confirmed' : 
                                ($pemesanan->status == 'dibatalkan' ? 'status-cancelled' : '')) }}">
                                {{ ucfirst($pemesanan->status) }} <!-- Menggunakan ucfirst untuk huruf kapital pertama -->
                            </span>
                        </div>
                        
                        <div>
                            <a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}" class="btn btn-info">Detail Pemesanan</a>
                        </div>
                    </div>


                    <hr class="bg-white"/> <!-- Mengubah warna garis pemisah menjadi putih -->
                    <div class="d-flex justify-content-between align-items-center"> 
                        <div>
                             <!-- Display payment status -->
                             @if($pemesanan->pembayaran)
                                    <p class="text-success">Status Pembayaran: {{ ucfirst($pemesanan->pembayaran->status_pembayaran) }}</p>
                                @else
                                    <p class="text-danger">Pembayaran belum dilakukan.</p>
                                @endif
                        </div>
                        <div>
                            @if($pemesanan->status == 'pending')
                            <form action="{{ route('user.tripsaya.batalPemesanan', $pemesanan->id) }}" method="POST" class="d-inline" id="cancel-form-{{ $pemesanan->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmCancellation({{ $pemesanan->id }})" aria-label="Batal Pemesanan">Batalkan Pemesanan</button>
                                </form>
                          @endif
                        </div>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmCancellation(pemesananId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pemesanan ini akan dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Use AJAX to submit the form
                $.ajax({
                    url: document.getElementById('cancel-form-' + pemesananId).action,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Optionally, remove the canceled booking from the UI
                            $('#cancel-form-' + pemesananId).closest('.card').remove();
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.error || 'Terjadi kesalahan saat membatalkan pemesanan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
</script>

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
                <h4>Alamat                     Kami</h4>
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
                        @if($footerPemesanans->isEmpty())
                            <li><a href="#">Anda belum melakukan pemesanan.</a></li>
                        @else
                            @foreach($footerPemesanans as $pemesanan)
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
