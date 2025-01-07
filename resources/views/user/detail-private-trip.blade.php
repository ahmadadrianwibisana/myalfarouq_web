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
<!-- resources/views/user/detail-private-trip.blade.php -->

<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url('{{ asset('assets/user/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Detail Private Trip</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li><a href="{{ route('user.privatetrip') }}">Private Trip</a></li>
                    <li class="current">Detail Private Trip</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="private-trip-details section">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $privateTrip->nama_trip }}</h2>
                    <h2 class="card-title">{{ auth()->user()->name }}</h2>
                    <h2 class="card-title"><strong>No Telepon:</strong> {{ $privateTrip->no_telepon }}</h2>
                    <p class="card-text"><strong>Destinasi:</strong> {{ $privateTrip->destinasi }}</p>
                    <p class="card-text"><strong>Starting Point:</strong> {{ $privateTrip->star_point }}</p>
                    <p class="card-text"><strong>Tanggal Pergi:</strong> {{ $privateTrip->tanggal_pergi->format('d-m-Y') }}</p>
                    <p class="card-text"><strong>Tanggal Kembali:</strong> {{ $privateTrip->tanggal_kembali->format('d-m-Y') }}</p>
                    <p class="card-text"><strong>Jumlah Peserta:</strong> {{ $privateTrip->jumlah_peserta }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ ucfirst($privateTrip->status) }}</p>
                    <h6><strong>Detail Private Trip</strong></h6>
                    <p class="card-text"><strong>Deskripsi Trip:</strong> {{ $privateTrip->deskripsi_trip }}</p>
                    <p class="card-text"><strong>Harga:</strong> {{ number_format($privateTrip->harga, 2) }}</p>
                    <p class="card-text"><strong>Tanggal Pengajuan:</strong> {{ $privateTrip->tanggal_pengajuan->format('d-m-Y') }}</p>
                    <p class="card-text"><strong>Tanggal Disetujui:</strong> {{ $privateTrip->tanggal_disetujui ? $privateTrip->tanggal_disetujui->format('d-m-Y') : 'Belum disetujui' }}</p>
                    <p class="card-text"><strong>Keterangan Ditolak:</strong> {{ $privateTrip->keterangan_ditolak ?? 'Tidak ada' }}</p>
                    @if($privateTrip->status === 'pending')
                        <div class="action-buttons">
                            <button class="btn btn-warning" onclick="toggleEditForm()">Edit</button>
                            <form id="cancelForm" action="{{ route('user.batalPrivateTrip', $privateTrip->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmCancellation()">Batal</button>
                            </form>
                        </div>
                    @else
                        <p class="alert alert-info">Pengajuan Anda sudah {{ $privateTrip->status }}.</p>
                    @endif
                </div>
            </div>

            <!-- Edit Form -->
            <div id="editForm" style="display: none;">
                <h3>Edit Private Trip</h3>
                <form action="{{ route('user.updatePrivateTrip', $privateTrip->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="destinasi">Destinasi</label>
                        <input type="text" id="destinasi" name="destinasi" class="form-control" value ="{{ $privateTrip->destinasi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pergi">Tanggal Pergi</label>
                        <input type="date" id="tanggal_pergi" name="tanggal_pergi" class="form-control" value="{{ $privateTrip->tanggal_pergi->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ $privateTrip->tanggal_kembali->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="star_point">Starting Point</label>
                        <input type="text" id="star_point" name="star_point" class="form-control" value="{{ $privateTrip->star_point }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" id="jumlah_peserta" name="jumlah_peserta" class="form-control" value="{{ $privateTrip->jumlah_peserta }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Trip</button>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    function toggleEditForm() {
        const editForm = document.getElementById('editForm');
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
    }

    function confirmCancellation() {
        Swal.fire({
            title: 'Konfirmasi Pembatalan',
            text: "Apakah Anda yakin ingin membatalkan pengajuan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Tidak, kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelForm').submit(); // Submit the form if confirmed
            }
        });
    }

    function showSuccessMessage(message) {
        Swal.fire({
            title: 'Sukses!',
            text: message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Call this function after a successful update or cancellation
    @if(session('success'))
        showSuccessMessage("{{ session('success') }}");
    @endif
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showSuccessMessage(message) {
        Swal.fire({
            title: 'Sukses!',
            text: message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Call this function after a successful update or cancellation
    @if(session('success'))
        showSuccessMessage("{{ session('success') }}");
    @endif
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr .net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
  </body>
</html>
