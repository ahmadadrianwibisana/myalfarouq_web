<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/user/img/logo.png" rel="icon" />
    <link href="assets/user/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link
      href="assets/user/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet" />
    <link
      href="assets/user/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet" />
    <link href="assets/user/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/user/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet" />
    <link
      href="assets/user/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet" />
    <link href="assets/user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/user/css/main.css" rel="stylesheet" />
    <style>
        /* Sembunyikan tampilan mobile secara default */
        .mobile-view {
            display: none;
        }

        /* Tampilan responsif */
        @media (max-width: 768px) {
            .desktop-view {
                display: none; /* Sembunyikan tampilan desktop pada mobile */
            }
            .mobile-view {
                display: block; /* Tampilkan tampilan mobile */
            }
        }

        /* Gaya umum */
        .about {
            margin: 20px 0;
        }

        .user-dropdown {
    position: relative;
    display: inline-block;
    margin-left: 15px; /* Add some space between the dropdown and the toggle icon */
}

.user-dropdown a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: black; /* Adjust color as needed */
}

.user-image {
    width: 40px; /* Adjust size as needed */
    height: 40px;
    border-radius: 50%; /* Make image circular */
    margin-right: 10px; /* Space between image and name */
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.user-dropdown:hover .dropdown-content {
    display: block; /* Show dropdown on hover */
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: flex; /* Use flexbox for icon and text alignment */
    align-items: center; /* Center items vertically */
}

.dropdown-content a:hover {
    background-color: #f1f1f1; /* Background color on hover */
}
    </style>
  </head>

  <body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{ route('user.home') }}" class="logo d-flex align-items-center me-auto">
        <img src="assets/user/img/logo.png" alt="" />
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
      
              <div class="user-dropdown dropdown">
            <a class="btn-getstarted"> 
            <img src="{{ asset('images/' . $user->image) }}" alt="User  Image" class="user-image" />
                <span class="user-name">{{ $user->name }}</span>
            
            </a>
            <div class="dropdown-content">
                <a href="{{ route('user.profile') }}">Profil User</a>
                <a href="{{ route('user.completed-trips') }}">Riwayat Trip Selesai</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>



        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
  </header>


    <main class="main">



      <section id="hero" class="hero section">
        <div class="container">
            <!-- Container Baru -->
            <div class="row align-items-center justify-content-between mb-5">
                <!-- Bagian Foto (Kiri) -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="swiper mySwiper" style="border-radius: 10px; overflow: hidden; height: 100%;">
                        <div class="swiper-wrapper" style="height: 100%;">
                              <!-- Gambar 1 -->
                              <div class="swiper-slide">
                                <img src="assets/user/img/1.jpg" alt="Foto 1" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 2 -->
                            <div class="swiper-slide">
                                <img src="assets/user/img/2.jpg" alt="Foto 2" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 3 -->
                            <div class="swiper-slide">
                                <img src="assets/user/img/3.jpg" alt="Foto 3" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 4 -->
                            <div class="swiper-slide">
                                <img src="assets/user/img/4.jpg" alt="Foto 4" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 5 -->
                            <div class="swiper-slide">
                                <img src="assets/user/img/5.jpg" alt="Foto 5" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Bagian Teks (Kanan) -->
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="400">
                    <div style="background-color: #276f5f; color: white; padding: 2rem; border-radius: 10px; height: 100%;">
                        <h2 style="color: white;">Alfarouq Travel Professional Tour 3 Negara Dengan Harga Terjangkau</h2>
                        <p>
                            Anda ingin liburan bareng keluarga? Alfarouq Travel menyediakan private trip, 
                            Anda bisa membuat jadwal trip Anda sendiri sesuai kebutuhan. Yuk segera rencanakan perjalanan Anda!
                        </p>
                        <a href="{{ route('user.privatetrip') }}" class="btn btn-light" style="background-color: #2C2A36; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 5px;">Buat Jadwal Trip Anda!</a>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Script Swiper -->
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

            <script>
                const swiper = new Swiper('.mySwiper', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            </script>

        </div>
        </section>

      <section
        id="call-to-action"
        class="call-to-action section dark-background">
        <img src="assets/user/img/background.png" alt="" />

        <div class="container">
          <div
            class="row justify-content-center"
            data-aos="zoom-in"
            data-aos-delay="100">
            <div class="col-xl-10">
              <div class="text-center">
                <h1>PAKET OPEN TRIP</h1>
                <h2>Alfaraouq Travel</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
<!-- Home Page -->
<section id="featured-services" class="featured-services section" style="background-color: #f8f9fa; padding: 50px 0">
    <div class="container">
        <form action="{{ route('user.home') }}" method="GET" class="form-search d-flex align-items-center justify-content-center mb-3 p-4" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <ul class="search-options d-flex gap-3 list-unstyled">
                <li>
                    <input type="text" name="search" class="form-control search-input" placeholder="Cari Open Trip...." value="{{ request('search') }}" />
                </li>
                <li class="form-group">
                    <select id="destination" name="destination" class="form-select">
                        <option value="*">Semua Destinasi</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination }}" {{ request('destination') == $destination ? 'selected' : '' }}>{{ $destination }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="form-group">
                    <select id="duration" name="duration" class="form-select">
                        <option value="*">Semua Durasi</option>
                        @foreach($durations as $duration)
                            <option value="{{ $duration }}" {{ request('duration') == $duration ? 'selected' : '' }}>{{ $duration }}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <button type="submit" class ="btn btn-success btn-search">
                        <i class="fas fa-search"></i> Search
                    </button>
                </li>
            </ul>
        </form>
    </div>
</section>

<!-- Open Trip Section -->
<section id="services" class="services section">
    <div class="container">
        <div class="row gy-4">
            @foreach($open_trips as $open_trip)
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-img">
                            <img src="{{ asset('open_trip_images/' . $open_trip->image) }}" alt="Tour Image" class="img-fluid" />
                        </div>
                        <h3>{{ $open_trip->nama_paket }}</h3>
                        <p>
                            <i class="bi bi-clock icon-clock"></i> 
                            {{ \Carbon\Carbon::parse($open_trip->tanggal_berangkat)->format('d/F/Y') }} - 
                            {{ \Carbon\Carbon::parse($open_trip->tanggal_pulang)->format('d/F/Y') }}<br />
                            <i class="bi bi-geo-alt icon-location"></i> {{ $open_trip->destinasi }}
                        </p>
                        <a href="{{ route('user.detailopen', $open_trip->id) }}" class="btn-detail">
                            <span>Detail</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
      <section>
        <div></div>
      </section>



    <!-- Call To Action Section -->
    <section
        id="call-to-action"
        class="call-to-action section dark-background">
        <img src="assets/img/background.png" alt="" />

        <div class="container">
          <div
            class="row justify-content-center"
            data-aos="zoom-in"
            data-aos-delay="100">
            <div class="col-xl-10">
              <div class="text-center">
                <h1>Profil</h1>
                <h1>Alfarouq Travel</h1>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Call To Action Section -->

   <!-- About Section untuk Desktop -->
<section id="about" class="about section desktop-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Teks -->
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h2>WELCOME TO</h2>
                <h3><span class="green-text">ALFAROUQ TRAVEL</span></h3>
                <h6>Emang Beda Wak</h6>
                <p>
                    Alfaraouq Travel menawarkan paket perjalanan tur tiga negara,
                    yaitu Malaysia, Singapura, dan Thailand dengan harga spesial
                    yang cocok untuk per-orangan, keluarga, dan rombongan. Paket ini
                    juga sudah mencakup berbagai fasilitas, sehingga Anda hanya
                    perlu duduk santai dan menikmati liburan Anda di ketiga negara
                    tersebut.
                </p>
            </div>

            <!-- Kolom Gambar -->
            <div class="col-lg-6 d-flex justify-content-center order-lg-last" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/profil1.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section kedua untuk Desktop -->
<section id="about" class="about section desktop-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar -->
            <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/zz.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks -->
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h2>CV. Alfarouq Tour and Travel</h2>
                <h3>
                    <span class="green-text">Penawaran Jasa dan Tiket Perjalanan</span>
                </h3>
                <h6>Adapun Penawaran Jasa yang Kami Tawarkan:</h6>
                <p>Temukan pengalaman perjalanan yang tak terlupakan bersama kami! Pilih salah satu penawaran jasa di bawah ini dan nikmati kemudahan dalam merencanakan perjalanan Anda. Kami siap membantu Anda mewujudkan liburan impian!</p>
                <ol id="service-list">
                  <li><a href="#" onclick="orderService('Paket Wisata Terima Bersih dalam dan luar negeri')">Paket Wisata Terima Bersih dalam dan luar negeri</a></li>
                  <li><a href="#" onclick="orderService('Tiket Pesawat + Bagasi')">Tiket Pesawat + Bagasi</a></li>
                  <li><a href="#" onclick="orderService('Tiket Kapal Ferry')">Tiket Kapal Ferry</a></li>
                  <li><a href="#" onclick="orderService('Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)')">Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)</a></li>
                  <li><a href="#" onclick="orderService('Bookingan Hotel mulai dari *2-*5')">Bookingan Hotel mulai dari *2-*5</a></li>
                  <li><a href="#" onclick="orderService('Jasa Tour Get & Tour Leader')">Jasa Tour Get & Tour Leader</a></li>
                  <li><a href="#" onclick="orderService('Pembelian Tiket Wisata semua negara')">Pembelian Tiket Wisata semua negara</a></li>
              </ol>
            </div>
        </div>
    </div>
</section>

<!-- About Section untuk Mobile -->
<section id="about" class="about section mobile-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar untuk Mobile -->
            <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/profil1.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks untuk Mobile -->
            <div class="col-12 content" data-aos="fade-up" data-aos-delay="100">
                <h2>WELCOME TO</h2>
                <h3><span class="green-text">ALFAROUQ TRAVEL</span></h3>
                <h6>Emang Beda Wak</h6>
                <p>
                    Alfaraouq Travel menawarkan paket perjalanan tur tiga negara,
                    yaitu Malaysia, Singapura, dan Thailand dengan harga spesial
                    yang cocok untuk per-orangan, keluarga, dan rombongan. Paket ini
                    juga sudah mencakup berbagai fasilitas, sehingga Anda hanya
                    perlu duduk santai dan menikmati liburan Anda di ketiga negara
                    tersebut.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Section kedua untuk Mobile -->
<section id="about" class="about section mobile-view">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar untuk Mobile -->
            <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="position-relative">
                    <img src="assets/img/zz.png" class="img-fluid" alt="Profil Image" />
                </div>
            </div>

            <!-- Kolom Teks untuk Mobile -->
            <div class="col-12 content" data-aos="fade-up" data-aos-delay="100">
                <h2>CV. Alfarouq Tour and Travel</h2>
                <h3>
                    <span class="green-text">Penawaran Jasa dan Tiket Perjalanan</span>
                </h3>
                <h6>Adapun Penawaran Jasa yang Kami Tawarkan:</h6>
                <p>Temukan pengalaman perjalanan yang tak terlupakan bersama kami! Pilih salah satu penawaran jasa di bawah ini dan nikmati kemudahan dalam merencanakan perjalanan Anda. Kami siap membantu Anda mewujudkan liburan impian!</p>
                <ol id="service-list">
                <ol id="service-list">
                    <li><a href="#" onclick="orderService('Paket Wisata Terima Bersih dalam dan luar negeri')">Paket Wisata Terima Bersih dalam dan luar negeri</a></li>
                    <li><a href="#" onclick="orderService('Tiket Pesawat + Bagasi')">Tiket Pesawat + Bagasi</a></li>
                    <li><a href="#" onclick="orderService('Tiket Kapal Ferry')">Tiket Kapal Ferry</a></li>
                    <li><a href="#" onclick="orderService('Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)')">Penyewaan Transportasi (Mobil Pribadi atau Bus Premium Pariwisata VAN/HIACE)</a></li>
                    <li><a href="#" onclick="orderService('Bookingan Hotel mulai dari *2-*5')">Bookingan Hotel mulai dari *2-*5</a></li>
                    <li><a href="#" onclick="orderService('Jasa Tour Get & Tour Leader')">Jasa Tour Get & Tour Leader</a></li>
                    <li><a href="#" onclick="orderService('Pembelian Tiket Wisata semua negara')">Pembelian Tiket Wisata semua negara</a></li>
                </ol>
                </ol>
            </div>
        </div>
    </div>
</section>
<script>
    // Pass user data from Laravel to JavaScript
    const user = {
        name: @json($user->name) // Only include the user's name
    };

    function orderService(service) {
        const message = `Saya ${user.name}, mau pesan: ${service}`;
        const phoneNumber = '+6281275037017'; // Fixed phone number for WhatsApp Admin
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    }
</script>


<!-- Dokumentasi -->
<section id="artikel" class="artikel section">
    <div class="container section-title" data-aos="fade-up">
        <span>Dokumentasi<br /></span>
        <h2>Dokumentasi</h2>
    </div>
    <div class="container">
        <div class="row gy-4">
            @foreach($artikels as $artikelItem) <!-- Loop through each article -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-img">
                            @if($artikelItem->images->isNotEmpty()) <!-- Check if images exist -->
                                <img src="{{ asset('storage/' . $artikelItem->images->first()->image_path) }}" alt="" class="img-fluid" />
                            @else
                                <img src="assets/user/img/default.jpg" alt="Default Image" class="img-fluid" /> <!-- Default image if no image exists -->
                            @endif
                        </div>
                        <p class="card-info">
                            <i class="bi bi-calendar-event"></i> 
                            {{ date('d M Y', strtotime($artikelItem->tanggal_publish)) }}<br />
                            <i class="bi bi-file-earmark-text"></i> Dokumentasi
                        </p>
                        <h3 class="card-title">
                            <a href="{{ route('user.detail-artikel', $artikelItem->id) }}" class="stretched-link">
                                {{ $artikelItem->judul_artikel }} <!-- Display the article title -->
                            </a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Dokumentasi -->


      <!-- Contact Section -->
      <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-whatsapp flex-shrink-0"></i>
              <div>
                <h3>Whatsapp:</h3>
                <p>
                  <a href="https://wa.me/6282269497774" target="_blank">+62 822 6949 7774</a>
                </p>
                <p>
                  <a href="https://wa.me/6281234567890" target="_blank">+62 812 3456 7890</a>
                </p>
              </div>
            </div>
              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="400">
                <i class="bi bi-instagram flex-shrink-0"></i>
                <div>
                  <h3>Instagram:</h3>
                  <a
                    href="https://instagram.com/alfarouqtourtravel"
                    target="_blank"
                    >alfarouqtourtravel</a
                  >
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-tiktok flex-shrink-0"></i>
                <div>
                  <h3>Tiktok:</h3>
                  <a
                    href="https://www.tiktok.com/@alfarouqtourtravel"
                    target="_blank"
                    >alfarouqtourtravel</a
                  >
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-globe flex-shrink-0"></i>
                <div>
                  <h3>Website:</h3>
                  <p>alfarouqtourtravel.com</p>
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Location:</h3>
                  <a href="https://maps.app.goo.gl/DFDBN3553ycHLxTm7"
                    >Jl. Dock Yard, Dumai, Riau, Indonesia</a
                  >
                </div>
              </div>

              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="500">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email:</h3>
                  <a href="mailto:alfarouqtourtravel@gmail.com"
                    >alfarouqtourtravel@gmail.com</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-8">
              <iframe
                style="width: 100%; height: 500px"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.1327840182053!2d101.41797271003743!3d1.665502998312044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d3a8d750f9f1bb%3A0x7f6987fb4ec41ac!2sJl.%20Dock%20Yard%2C%20Kota%20Dumai%2C%20Riau%2028826!5e0!3m2!1sid!2sid!4v1730883090899!5m2!1sid!2sid"
                frameborder="0"
                allowfullscreen=""></iframe>
            </div>
          </div>
        </div>
      </section>
      <!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer dark-background">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-about">
            <a href="{{ route('user.home') }}" class="logo d-flex align-items-center">
              <img src="assets/user/img/logo1.png" alt="" />
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

    <!-- <div class="whatsapp-button">
      <a
        href="https://wa.me/6282269497774?text=Halo,%20saya%20ingin%20bertanya."
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span>Chat Kami</span>
      </a>
    </div> -->

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
    <script src="assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/user/vendor/php-email-form/validate.js"></script>
    <script src="assets/user/vendor/aos/aos.js"></script>
    <script src="assets/user/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/user/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/user/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/user/js/main.js"></script>

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
