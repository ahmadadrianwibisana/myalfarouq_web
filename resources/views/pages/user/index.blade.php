<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Web</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet" />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
  </head>

  <body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div
        class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <img src="assets/img/logo.png" alt="" />
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="index.html" class="active">Home<br /></a>
            </li>
            <li><a href="opentrip.html">Open Trip</a></li>
            <li><a href="privatetrip.html">Private Trip</a></li>
            <li><a href="artikel.html">Artikel</a></li>
            <li><a href="opentrip.html">Trip Saya</a></li>
            <li class="dropdown">
              <a href="#"
                ><span>Profil</span>
                <i class="bi bi-chevron-down toggle-dropdown"></i
              ></a>
              <ul>
                <li><a href="about.html">Profil Kami</a></li>
                <li><a href="contact.html">Tentang Kami</a></li>
              </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="index.html">Login</a>
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
                                <img src="assets/img/cta-bg.jpg" alt="Foto 1" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 2 -->
                            <div class="swiper-slide">
                                <img src="assets/img/cta-bg.jpg" alt="Foto 2" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 3 -->
                            <div class="swiper-slide">
                                <img src="assets/img/cta-bg.jpg" alt="Foto 3" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 4 -->
                            <div class="swiper-slide">
                                <img src="assets/img/cta-bg.jpg" alt="Foto 4" class="img-fluid" 
                                    style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <!-- Gambar 5 -->
                            <div class="swiper-slide">
                                <img src="assets/img/cta-bg.jpg" alt="Foto 5" class="img-fluid" 
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
                        <a href="#" class="btn btn-light" style="background-color: #2C2A36; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 5px;">Buat Jadwal Trip Anda!</a>
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
        <img src="assets/img/cta-bg.jpg" alt="" />

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

      <section
        id="featured-services"
        class="featured-services section"
        style="background-color: #f8f9fa; padding: 50px 0">
        <div class="container">
          <form
            action="#"
            method="GET"
            class="form-search d-flex align-items-center justify-content-center mb-3 p-4"
            style="
              background-color: white;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            ">
            <ul class="search-options d-flex gap-3 list-unstyled">
              <!-- Input untuk Search -->
              <li>
                <input
                  type="text"
                  name="search"
                  class="form-control search-input"
                  placeholder="Cari Open Trip...."
                  required />
              </li>

              <!-- Dropdown untuk Destinasi -->
              <li class="form-group">
                <select id="destination" name="destination" class="form-select">
                  <option value="*">Semua Destinasi</option>
                  <option value="malaysia">Malaysia</option>
                  <option value="singapura">Singapura</option>
                  <option value="thailand">Thailand</option>
                </select>
              </li>

              <!-- Dropdown untuk Durasi -->
              <li class="form-group">
                <select id="duration" name="duration" class="form-select">
                  <option value="*">Semua Durasi</option>
                  <option value="short-duration">3 Hari</option>
                  <option value="medium-duration">5 Hari</option>
                  <option value="long-duration">7 Hari</option>
                </select>
              </li>

              <!-- Tombol Pencarian -->
              <li>
                <button type="submit" class="btn btn-success btn-search">
                  <i class="fas fa-search"></i> Search
                </button>
              </li>
            </ul>
          </form>
        </div>
      </section>

      <!-- Opentrip -->
      <section id="services" class="services section">
        <div
          class="isotope-layout"
          data-default-filter="*"
          data-layout="masonry"
          data-sort="original-order">
          <!-- Section Filter -->
          <ul
            class="portfolio-filters isotope-filters"
            data-aos="fade-up"
            data-aos-delay="100">
            <li data-filter="*" class="filter-active">Semua Paket</li>
            <li data-filter=".filter-satu-negara">Satu Negara</li>
            <li data-filter=".filter-dua-negara">Dua Negara</li>
            <li data-filter=".filter-tiga-negara">Tiga Negara</li>
          </ul>

          <!-- Card Items -->
          <div class="container">
            <div class="row gy-4 isotope-container">
              <!-- Card 1 - Satu Negara -->
              <div
                class="col-lg-4 col-md-6 filter-satu-negara malaysia short-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/open1.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 1 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 17 - 19 Juli<br />
                    <i class="bi bi-geo-alt icon-location"></i> Malaysia
                  </p>
                  <a href="service-details.html" class="btn-detail">
                    <span>Detail</span>
                  </a>
                </div>
              </div>

              <!-- Card 2 - Dua Negara -->
              <div
                class="col-lg-4 col-md-6 filter-dua-negara malaysia singapura medium-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/profil1.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 2 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 18 - 22 Agustus<br />
                    <i class="bi bi-geo-alt icon-location"></i> Malaysia,
                    Singapura
                  </p>
                  <a href="service-details.html" class="btn-detail">
                    <span>Detail</span>
                  </a>
                </div>
              </div>

              <!-- Card 3 - Tiga Negara -->
              <div
                class="col-lg-4 col-md-6 filter-tiga-negara malaysia singapura thailand long-duration"
                data-aos="fade-up"
                data-aos-delay="100">
                <div class="card">
                  <div class="card-img">
                    <img
                      src="assets/img/open3.jpg"
                      alt="Tour Image"
                      class="img-fluid" />
                  </div>
                  <h3>Tour 3 Negara</h3>
                  <p>
                    <i class="bi bi-clock icon-clock"></i> 23 - 28 November<br />
                    <i class="bi bi-geo-alt icon-location"></i> Malaysia,
                    Singapura, Thailand
                  </p>
                  <a href="service-details.html" class="btn-detail">
                    <span>Detail</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Call To Action Section -->
      <section
        id="call-to-action"
        class="call-to-action section dark-background">
        <img src="assets/img/cta-bg.jpg" alt="" />

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

      <!-- About Section pertama -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-4 align-items-center">
            <!-- Kolom Teks  -->
            <div
              class="col-lg-6 content"
              data-aos="fade-up"
              data-aos-delay="100">
              <h2>WELCOME TO</h2>
              <h3><span class="green-text">ALFAROUQ TRAVEL</span></h3>
              <h6>Emang Beda Wak</h6>
              <p>
                Alfaraouq Travel menawarkan paket perjalanan tour tiga negara,
                yaitu Malaysia, Singapura, dan Thailand dengan harga spesial
                yang cocok untuk per-orangan, keluarga, dan rombongan. Paket ini
                juga sudah mencakup berbagai fasilitas, sehingga Anda hanya
                perlu duduk santai dan menikmati liburan Anda di ketiga negara
                tersebut.
              </p>
            </div>

            <!-- Kolom Gambar  -->
            <div
              class="col-lg-6 d-flex justify-content-center order-lg-last"
              data-aos="fade-up"
              data-aos-delay="200">
              <div class="position-relative">
                <img
                  src="assets/img/profil1.jpg"
                  class="img-fluid"
                  alt="Profil Image" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- About Section kedua -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-4 align-items-center">
            <!-- Kolom Gambar -->
            <div
              class="col-lg-6 d-flex justify-content-center"
              data-aos="fade-up"
              data-aos-delay="200">
              <div class="position-relative">
                <img
                  src="assets/img/profil1.jpg"
                  class="img-fluid"
                  alt="Profil Image" />
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
                    <li><a href="#" onclick="orderService('Bookingan Hotel mulai dari *2-*5 ')">Bookingan Hotel mulai dari *2-*5</a></li>
                    <li><a href="#" onclick="orderService('Jasa Tour Get & Tour Leader')">Jasa Tour Guide & Tour Leader</a></li>
                    <li><a href="#" onclick="orderService('Pembelian Tiket Wisata semua negara')">Pembelian Tiket Wisata semua negara</a></li>
                </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Dokumentasi -->
      <section id="artikel" class="artikel section">
        <div class="container section-title" data-aos="fade-up">
          <span>Dokumentasi<br /></span>
          <h2>Dokumentasi</h2>
        </div>
        <div class="container">
          <div class="row gy-4">
            <div
              class="col-lg-4 col-md-6"
              data-aos="fade-up"
              data-aos-delay="200">
              <div class="card">
                <div class="card-img">
                  <img src="assets/img/open1.jpg" alt="" class="img-fluid" />
                </div>
                <p class="card-info">
                  <i class="bi bi-calendar-event"></i> Agustus 23, 2024<br />
                  <i class="bi bi-file-earmark-text"></i> Dokumentasi
                </p>
                <h3 class="card-title">
                  <a href="detail.html" class="stretched-link">
                    Dokumentasi Private Tour 2 Negara Tgl 18 – 22 Agustus 2024
                    sebanyak 40 pax
                  </a>
                </h3>
              </div>
            </div>

            <div
              class="col-lg-4 col-md-6"
              data-aos="fade-up"
              data-aos-delay="200">
              <div class="card">
                <div class="card-img">
                  <img src="assets/img/open2.jpg" alt="" class="img-fluid" />
                </div>
                <p class="card-info">
                  <i class="bi bi-calendar-event"></i> Juli 20, 2024<br />
                  <i class="bi bi-file-earmark-text"></i> Dokumentasi
                </p>
                <h3 class="card-title">
                  <a href="#" class="stretched-link">
                    Dokumentasi Private Tour Malaysia Tgl 18 – 22 Juli 2024
                    sebanyak 20 pax
                  </a>
                </h3>
              </div>
            </div>

            <div
              class="col-lg-4 col-md-6"
              data-aos="fade-up"
              data-aos-delay="200">
              <div class="card">
                <div class="card-img">
                  <img src="assets/img/open3.jpg" alt="" class="img-fluid" />
                </div>
                <p class="card-info">
                  <i class="bi bi-calendar-event"></i> September 25, 2024<br />
                  <i class="bi bi-file-earmark-text"></i> Dokumentasi
                </p>
                <h3 class="card-title">
                  <a href="#" class="stretched-link">
                    Dokumentasi Private Tour 3 Negara Tgl 23 – 24 September 2024
                    sebanyak 15 pax
                  </a>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Dokumentasi -->

      <!-- Contact Section -->
      <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-4">
              <div
                class="info-item d-flex"
                data-aos="fade-up"
                data-aos-delay="300">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Whatsapp:</h3>
                  <a href="https://wa.me/6282269497774" target="_blank"
                    >+62 822 6949 7774</a
                  >
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
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="" />
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
              <li><a href="index.html">Home</a></li>
              <li><a href="opentrip.html">Open Trip</a></li>
              <li><a href="privatetrip.html">Private Trip</a></li>
              <li><a href="about.html">Profil</a></li>
              <li><a href="artikel.html">Artikel</a></li>
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
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Isotope JS CDN -->
    <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  </body>
</html>
