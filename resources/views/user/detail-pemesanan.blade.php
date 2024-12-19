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
            <h1>Detail Pemesanan</h1>
            <h2>Alfarouq Travel</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li><a href="{{ route('user.tripsaya') }}">Trip Saya</a></li>
                    <li class="current">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div>
    

    <!-- Detail pemesanan -->
  <section id="get-a-quote" class="get-a-quote section">
    <div class="max-w-5xl mx-auto p-4">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2">
            @if($pemesanan->trip_type === 'open_trip' && $pemesanan->openTrip && $pemesanan->openTrip->image)
                <img alt="{{ $pemesanan->openTrip->nama_paket }}" class="rounded-lg shadow-md" height="400" src="{{ asset('open_trip_images/' . $pemesanan->openTrip->image) }}" width="600" />
            @elseif($pemesanan->trip_type === 'private_trip' && $pemesanan->privateTrip && $pemesanan->privateTrip->image)
                <img alt="{{ $pemesanan->privateTrip->nama_trip }}" class="rounded-lg shadow-md" height="400" src="{{ asset('private_trip_images/' . $pemesanan->privateTrip->image) }}" width="600" />
            @else
                <img alt="Default Image" class="rounded-lg shadow-md" height="400" src="{{ asset('default_image_url.jpg') }}" width="600" />
            @endif
        </div>
        <div class="md:w-1/2 md:pl-8 mt-8 md:mt-0">
        <h1 class="text-2xl font-semibold text-green-700">{{ ucwords($pemesanan->openTrip->nama_paket ?? $pemesanan->privateTrip->nama_trip) }}</h1>
            <p class="text-lg font-semibold text-green-700"><span>Type : </span>{{ ucfirst($pemesanan->trip_type) }}</p>

            <div class="mt-4">
                @if ($pemesanan->trip_type == 'open_trip')
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <i class="fas fa-map-marker-alt mr-2 text-[#276f5f]"></i>
                        <span>{{ $pemesanan->openTrip->destinasi ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <i class="fas fa-calendar-alt mr-2 text-[#276f5f]"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_berangkat)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($pemesanan->openTrip->tanggal_pulang)->format('d M Y') }}
                        </span>
                    </div>
                @elseif ($pemesanan->trip_type == 'private_trip')
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <i class="fas fa-map-marker-alt mr-2 text-[#276f5f]"></i>
                        <span>{{ $pemesanan->privateTrip->destinasi ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <i class="fas fa-calendar-alt mr-2 text-[#276f5f]"></i>
                        <span>
                          {{ \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_pergi)->format('d M Y') }} - 
                          {{ \Carbon\Carbon::parse($pemesanan->privateTrip->tanggal_kembali)->format('d M Y') }}
                        </span>
                    </div>
                @endif

                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-user mr-2 text-[#276f5f]"></i>
                    <span>{{ $pemesanan->jumlah_peserta }} Peserta</span>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">{{ ucwords($pemesanan->user->name) }}</h2>
                    <p class="text-sm text-gray-700">{{ $pemesanan->user->no_telepon }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Status Pemesanan</h2>
                    <p class="text-sm text-gray-700">{{ ucfirst($pemesanan->status) }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Total Pembayaran</h2>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Deskripsi</h2>
                    <p class="text-sm text-gray-700">{{ $pemesanan->openTrip->deskripsi_trip ?? $pemesanan->privateTrip->deskripsi_trip }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Informasi Tambahan</h2>
                    @if ($pemesanan->trip_type == 'open_trip')
                        <p><strong>Harga per Peserta:</strong> Rp. {{ number_format($pemesanan->openTrip->harga, 0, ',', '.') }}</p>
                        <p><strong>Lama Keberangkatan:</strong> {{ $pemesanan->openTrip->lama_keberangkatan ?? 'N/A' }}</p>
                        <p><strong>Kuota:</strong> {{ $pemesanan->openTrip->kuota ?? 'N/A' }}</p>
                    @elseif ($pemesanan->trip_type == 'private_trip')
                    <p><strong>Star Point:</strong> {{ $pemesanan->privateTrip->star_point ?? 'N/A' }}</p>
                        <p><strong>Harga:</strong> Rp. {{ number_format($pemesanan->privateTrip->harga, 0, ',', '.') }}</p>
                    @endif
                </div>

                <!-- Display messages based on status -->
                @if($pemesanan->status == 'pending')
                    <div class="alert alert-warning mt-3" role="alert">
                        <strong>Pemesanan masih dalam proses!</strong> Pemesanan Anda belum disetujui.
                    </div>
                @elseif($pemesanan->status == 'terkonfirmasi')
                    <div class="alert alert-success mt-3" role="alert">
                        <strong>Pemesanan telah disetujui!</strong> Tanggal disetujui: {{ \Carbon\Carbon::parse($pemesanan->tanggal_disetujui)->format('d M Y') }}.
                    </div>                 
                @elseif($pemesanan->status == 'dibatalkan' && !empty($pemesanan->alasan_batal))
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>Pemesanan Dibatalkan!</strong> {{ $pemesanan->alasan_batal }}
                    </div>
                @endif

                <div class="mt-4">
                    @if($pemesanan->trip_type === 'open_trip')
                        @if($pemesanan->status === 'pending')
                            <a href="{{ route('user.editPemesanan', $pemesanan->id) }}" class="btn btn-primary">Edit Pemesanan</a>
                        @elseif($pemesanan->status === 'terkonfirmasi')
                            <p class="text-danger">Pemesanan Anda untuk open trip telah terkonfirmasi. Jika Anda ingin membatalkan, harap <a href="https://wa.me/6282269497774" target="_blank" class="text-primary">hubungi admin melalui WhatsApp</a>.</p>
                        @elseif($pemesanan->status === 'dibatalkan')
                            <p class="text-danger">Pemesanan Anda untuk open trip telah dibatalkan/ditolak. Jika Anda ingin mengajukan pertanyaan lebih lanjut, silakan <a href="https://wa.me/6282269497774" target="_blank" class="text-primary">hubungi admin melalui WhatsApp</a>.</p>
                        @else
                            <p class="text-danger">Status pemesanan tidak dikenali.</p>
                        @endif
                    @elseif($pemesanan->trip_type === 'private_trip')
                        @if($pemesanan->status === 'terkonfirmasi')
                            <p class="text-danger">Pemesanan Anda untuk private trip telah terkonfirmasi. Jika Anda ingin membatalkan, harap <a href="https://wa.me/6282269497774" target="_blank" class="text-primary">hubungi admin melalui WhatsApp</a>.</p>
                        @elseif($pemesanan->status === 'dibatalkan')
                            <p class="text-danger">Pemesanan Anda untuk private trip telah dibatalkan/ditolak. Jika Anda ingin mengajukan pertanyaan lebih lanjut, silakan <a href="https://wa.me/6282269497774" target="_blank" class="text-primary">hubungi admin melalui WhatsApp</a>.</p>
                        @else
                            <p class="text-danger">Status pemesanan tidak dikenali.</p>
                        @endif
                    @else
                        <p class="text-danger">Tipe trip tidak dikenali.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>              

<!-- Halaman detail pembayaran dan data administrasi -->
<div class="max-w-5xl mx-auto p-4">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2">
            <!-- Payment Details Section -->
            <div class="mt-4">
                <h2 class="text-lg font-semibold text-green-700">Detail Pembayaran</h2>
                @if($pemesanan->status === 'terkonfirmasi')
                    @if($pembayaran)
                        <p>
                            <strong>Total Pembayaran:</strong> 
                            <span class="text-secondary"> Rp.{{ number_format($pembayaran->pemesanan->total_pembayaran, 0, ',', '.') }}</span>
                        </p>
                        <p>
                            <strong>Tanggal Pembayaran:</strong> 
                            <span class="text-secondary">{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d-m-Y') }}</span>
                        </p>
                        <p>
                            <strong>Jumlah Pembayaran:</strong> 
                            <span class="text-secondary"> Rp.{{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</span>
                        </p>
                        <div class="mt-4">
                            <h2 class="text-lg font-semibold text-green-700">Status Pembayaran</h2> 
                            <span class="text-secondary">
                                @if ($pembayaran->status_pembayaran == 'pending')
                                    <p class="text-sm text-gray-700">Pembayaran belum dikonfirmasi. Silakan tunggu konfirmasi dari admin.</p>
                                @elseif ($pembayaran->status_pembayaran == 'success')
                                    <p class="text-success">Selamat pembayaran anda telah berhasil dilakukan.</p>
                                @elseif ($pembayaran->status_pembayaran == 'failed')
                                    <p class="text-sm text-gray-700">Pembayaran gagal, upload ulang bukti pembayaran.</p>
                                    <p class="text-sm text-gray-700">Alasan: {{ $pembayaran->alasan_gagal }}</p>
                                @else
                                    <p class="text-sm text-gray-700">Status pembayaran tidak dapat diidentifikasi.</p>
                                @endif
                            </span>
                        </div>
                        <div class="mt-4">
                            <strong>Bukti Pembayaran:</strong> 
                            <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-info">
                                <i class="fas fa-file-download"></i> Lihat Bukti Pembayaran
                            </a>
                        </div>
                    @else
                        <p class="text-gray-700">Tidak ada detail pembayaran yang tersedia.</p>
                    @endif
                @else
                    <p class="text-danger">Status pemesanan belum terkonfirmasi. Anda tidak dapat melihat detail pembayaran.</p>
                @endif
            </div>
            <div class="mt-4">
                @if($pemesanan->status === 'terkonfirmasi')
                    <a href="{{ route('user.showUploadBuktiPembayaran', $pemesanan->id) }}" class="btn btn-success">Upload Bukti Pembayaran</a>
                @endif
            </div>
            @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        </div>

        <div class="md:w-1/2 md:pl-8 mt-8 md:mt-0">
            <div class="mt-4">
                <h2 class="text-lg font-semibold text-green-700">Data Administrasi</h2>
                @if($pemesanan->dataAdministrasi->isNotEmpty())
                    <ul class="list-disc pl-5">
                        @foreach($pemesanan->dataAdministrasi as $data)
                            <li>
                                <strong>File Dokumen:</strong> 
                                <a href="{{ asset('storage/' . $data->file_dokumen) }}" target="_blank" class="text-blue-500 underline">
                                    Lihat Dokumen
                                </a>
                                <br>
                                <strong>Status:</strong> {{ ucfirst($data->status) }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700">Tidak ada data administrasi yang tersedia.</p>
                @endif
            </div>
            
            <div class="mt-4">
                @if($pemesanan->status === 'terkonfirmasi')
                    <a href="{{ route('user.showUploadDataAdministrasi', $pemesanan->id) }}" class="btn btn-primary">Upload Data Administrasi</a>
                @endif
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

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>