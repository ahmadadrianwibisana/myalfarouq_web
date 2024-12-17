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
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('assets/img/background.png') }}')">
        <div class="container position-relative">
            <h1>Detail Open Trip</h1>
            <h2>{{ $open_trips->nama_paket }}</h2>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li><a href="{{ route('user.opentrip') }}">Open Trip</a></li>
                    <li class="current">Detail Open Trip</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->
    

    <div class="max-w-5xl mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <img alt="{{ $open_trips->nama_paket }}" class="rounded-lg shadow-md" height="400" src="{{ asset('open_trip_images/' . $open_trips->image) }}" width="600" />
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
                <h1 class="text-2xl font-semibold text-green-700">{{ $open_trips->nama_paket }}</h1>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-map-marker-alt mr-2 text-[#276f5f]"></i>
                    <span>{{ $open_trips->destinasi }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-calendar-alt mr-2 text-[#276f5f]"></i>
                    <span>{{ \Carbon\Carbon::parse($open_trips->tanggal_berangkat)->format('d F Y') }} - {{ \Carbon\Carbon::parse($open_trips->tanggal_pulang)->format('d F Y') }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <i class="fas fa-clock mr-2 text-[#276f5f]"></i>
                    <span>{{ $open_trips->lama_keberangkatan }}</span>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Kuota</h2>
                    <p class="text-sm text-gray-700">{{ $open_trips->kuota }} Peserta</p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-green-700">Satuan</h2>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($open_trips->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-700">Ada penyesuain garga selain dari provinsi riau</p>
                </div>

                <!-- Form Pemesanan -->
                <form id="bookingForm" action="{{ route('user.bookOpenTrip', $open_trips->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="trip_type" value="open_trip">
                    <div class="mt-4 flex items-center">
                        <button id="decrease" type="button" class="bg-gray-200 text-gray-600 px-2 py-1 rounded-l">-</button>
                        <span id="participantCount" class="bg-gray-100 text-gray-800 px-4 py-1">1</span>
                        <button id="increase" type="button" class="bg-gray-200 text-gray-600 px-2 py-1 rounded-r">+</button>
                    </div>
                    <input type="hidden" name="jumlah_peserta" id="jumlah_peserta" value="1">
                    <div class="mt-4">
                        <h2 class="text-lg font-semibold text-green-700">Harga Total</h2>
                        <p id="totalPrice" class="text-xl font-bold text-gray-800">Rp {{ number_format($open_trips->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="mt-4">
                        <button type="button" id="confirmBooking" class="bg-black text-white px-4 py-2 rounded">Pesan Sekarang</button>
                    </div>
                </form>

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
                        <p class="text-sm text-gray-700">{{ $open_trips->deskripsi_trip }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title">Terima Kasih</h5>
            </div>
            <div class="card-body">
                <p>{{ session('success') }}</p>
                <div class="flex justify-center mt-4">
                    <button id="closeSuccessModal" class="btn btn-order mr-2">Tutup</button>
                    <a href="{{ route('user.tripsaya') }}" class="btn btn-success">Lihat Trip Saya</a>
                </div>
            </div>
        </div>
    </div>
@endif

    <!-- Modal for Alert -->
    <div id="alertModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h2 class="text-lg font-semibold text-red-600">Peringatan!</h2>
            <p class="text-sm text-gray-700">Jumlah peserta tidak boleh lebih dari kuota yang tersedia.</p>
            <div class="mt-4 flex justify-end">
                <button id="closeModal" class="bg-green-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="modal-content bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h5 class="modal-title">Ajukan pesanan?</h5>
            <p id="confirmationMessage">Anda akan melakukan pesanan untuk {{ $open_trips->nama_paket }} dengan 1 peserta.</p>
            <div class="d-flex justify-content-center">
                <button type="button" id="cancelOrder" class="btn btn-cancel me-2">Batal</button>
                <button type="button" id="confirmOrder" class="btn btn-order">Pesan</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const pricePerPerson = {{ $open_trips->harga }};
        const kuota = {{ $open_trips->kuota }};
        let participantCount = 1;
        const participantCountElement = document.getElementById('participantCount');
        const totalPriceElement = document.getElementById('totalPrice');
        const alertModal = document.getElementById('alertModal');
        const confirmationModal = document.getElementById('confirmationModal');
        const closeModalButton = document.getElementById('closeModal');
        const cancelOrderButton = document.getElementById('cancelOrder');
        const confirmOrderButton = document.getElementById('confirmOrder');
        const closeSuccessModalButton = document.getElementById('closeSuccessModal');

        // Periksa apakah tombol closeSuccessModalButton ada
        if (closeSuccessModalButton) {
            closeSuccessModalButton.addEventListener('click', function() {
                document.getElementById('successModal').style.display = 'none';
            });
        }

        document.getElementById('increase').addEventListener('click', function() {
            if (participantCount < kuota) {
                participantCount++;
                updateTotalPrice();
            } else {
                alertModal.classList.remove('hidden');
            }
        });

        document.getElementById('decrease').addEventListener('click', function() {
            if (participantCount > 1) {
                participantCount--;
                updateTotalPrice();
            }
        });

        document.getElementById('confirmBooking').addEventListener('click', function() {
            // Update the confirmation message with the current participant count
            const confirmationMessage = document.getElementById('confirmationMessage');
            confirmationMessage.textContent = `Anda akan melakukan pesanan untuk {{ $open_trips->nama_paket }} dengan ${participantCount} peserta.`;
            
            confirmationModal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', function() {
            alertModal.classList.add('hidden');
        });

        cancelOrderButton.addEventListener('click', function() {
            confirmationModal.classList.add('hidden');
        });

        confirmOrderButton.addEventListener('click', function() {
            document.getElementById('jumlah_peserta').value = participantCount; // Update hidden input
            document.getElementById('bookingForm').submit(); // Submit the form
        });

        function updateTotalPrice() {
            participantCountElement.textContent = participantCount;
            const totalPrice = pricePerPerson * participantCount;
            totalPriceElement.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            document.getElementById('jumlah_peserta').value = participantCount; // Update hidden input
        }
        

        // Initialize total price
        updateTotalPrice();
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