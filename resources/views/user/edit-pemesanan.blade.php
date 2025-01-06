<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-Frame-Options" content="DENY">

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
        }
        .btn-order {
            background-color: #28a745;
            color: white;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            width: 300px; /* Anda dapat menyesuaikan ini jika diperlukan */
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #4CAF50; /* Warna latar belakang hijau muda */
            color: black; /* Warna teks hitam */
            text-align: center;
            padding: 10px;
            font-weight: bold;
        }
        .card-body {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #1C1C1C;
        }
        .container1 {
            max-width: 600px; /* Membatasi lebar container */
            margin: auto; /* Memusatkan container */
            padding: 20px; /* Menambahkan padding */
            border-radius: 10px; /* Membuat sudut membulat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
            background-color: #f8f9fa; /* Warna latar belakang yang lembut */
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
            <h1>Edit Pemesanan</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.tripsaya') }}">Trip Saya</a></li>
                <li><a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}">Detail Pemesanan</a></li>
                <li class="current">Edit Pemesanan</li>
            </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->
    <section>
    <div class="container1 mt-5">
        <h2 class="text-center mb-4">Edit Pemesanan</h2>

        <form id="edit-pemesanan-form" action="{{ route('user.updatePemesanan', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="open_trip_id" class="form-label">Pilih Trip</label>
                <select name="open_trip_id" id="open_trip_id" class="form-select" required>
                    @foreach($openTrips as $trip)
                        <option value="{{ $trip->id }}" {{ $trip->id == $pemesanan->open_trip_id ? 'selected' : '' }}>
                            {{ $trip->nama_paket }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <h2 class="text-lg font-semibold text-green-700">Kuota</h2>
                <p class="text-sm text-gray-700" id="kuota">{{ $pemesanan->openTrip->kuota }} Peserta</p>
            </div>

            <div class="mb-3">
                <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" value="{{ $pemesanan->jumlah_peserta }}" required>
                <p id="pesan" class="text-danger mt-2" style="display: none;"></p> <!-- Message for quota validation -->
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Update Pemesanan</button>
                <a href="{{ route('user.tripsaya.detail-pemesanan', $pemesanan->id) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function() {
    $('#edit-pemesanan-form').on('submit', function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Check if the number of participants exceeds the quota
        const kuota = parseInt(kuotaDisplay.textContent);
        const jumlahPeserta = parseInt(jumlahPesertaInput.value);

        if (jumlahPeserta > kuota) {
            Swal.fire({
                title: 'Gagal!',
                text: `Jumlah peserta tidak boleh lebih dari kuota yang tersedia (${kuota} peserta).`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Stop the form submission
        }

        // Proceed with the AJAX request if validation passes
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                // Show success message
                Swal.fire({
                    title: 'Pemesanan Diperbarui!',
                    text: 'Pemesanan Anda telah berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Redirect to the detail page
                    window.location.href = "{{ route('user.detailPemesanan', $pemesanan->id) }}";
                });
            },
            error: function(xhr) {
                // Handle error
                let errorMessage = 'Terjadi kesalahan saat memperbarui pemesanan.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                Swal.fire({
                    title: 'Gagal!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Existing JavaScript for fetching quota and validating participants
    const openTripSelect = document.getElementById('open_trip_id');
    const kuotaDisplay = document.getElementById('kuota');
    const jumlahPesertaInput = document.getElementById('jumlah_peserta');
    const pesanDisplay = document.getElementById('pesan');

    function fetchKuota(tripId) {
        fetch(`/open-trips/${tripId}`)
            .then(response => response.json())
            .then(data => {
                kuotaDisplay.textContent = `${data.kuota} Peserta`;
                validateJumlahPeserta(data.kuota);
            })
            .catch(error => console.error('Error fetching kuota:', error));
    }

    function validateJumlahPeserta(kuota) {
        const jumlahPeserta = parseInt(jumlahPesertaInput.value);
        if (jumlahPeserta > kuota) {
            pesanDisplay.textContent = `Jumlah peserta tidak boleh lebih dari kuota yang tersedia (${kuota} peserta).`;
            pesanDisplay.style.display = 'block'; // Show the message
        } else {
            pesanDisplay.textContent = ''; // Clear the message
            pesanDisplay.style.display = 'none'; // Hide the message
        }
    }

    // Initial fetch for the selected trip
    fetchKuota(openTripSelect.value);

    // Event listener for trip selection change
    openTripSelect.addEventListener('change', function() {
        fetchKuota(this.value);
    });

    // Event listener for jumlah peserta input change
    jumlahPesertaInput.addEventListener('input', function() {
        fetchKuota(openTripSelect.value); // Re-fetch quota when input changes
    });
});
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