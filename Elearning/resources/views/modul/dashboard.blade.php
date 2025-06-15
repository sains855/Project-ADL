<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPlatform - Modul Pembelajaran</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('css/modul.css') }}">
 <script src="{{ mix('js/app.js') }}"></script>
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
  <header class="navbar">
    <div class="container">
      <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <h1>EduPlatform</h1>
      </div>
      <nav>
        <a href="./dashboard"><i class="fas fa-home"></i> Beranda</a>
        <a href="./modul" class="active"><i class="fas fa-book-open"></i> Modul</a>
        <a href="./modul/tugas"><i class="fas fa-tasks"></i> Tugas</a>
      </nav>
      <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    </div>
  </header>

  <main class="modul-page">
    <section class="page-header">
      <div class="container">
        <h1><i class="fas fa-book-open"></i> Modul Pembelajaran</h1>
        <p>Pilih modul untuk memulai pembelajaran interaktif Anda</p>
      </div>
    </section>

    <section class="modul-section">
      <div class="container">
        <div class="section-header">
          <h2>Daftar Modul</h2>
          <div class="search-filter">
            <div class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" id="searchInput" placeholder="Cari modul...">
            </div>
            <select class="filter-select">
              <option>Semua Kategori</option>
              <option>Pemrograman</option>
              <option>Desain</option>
              <option>Bisnis</option>
            </select>
          </div>
        </div>

        <div class="modul-grid">
          <div class="modul-card completed">
            <div class="modul-badge completed">
              <i class="fas fa-check"></i> Selesai
            </div>
            <div class="modul-icon">
              <i class="fas fa-laptop-code"></i>
            </div>
            <h3>Pengenalan HTML & CSS</h3>
            <p>Pelajari dasar-dasar pembuatan website dengan HTML dan CSS.</p>
            <div class="modul-meta">
              <span><i class="fas fa-book"></i> 12 Materi</span>
              <span><i class="fas fa-clock"></i> 4 Jam</span>
            </div>
            <a href="#" class="btn btn-outline">Lihat Materi</a>
          </div>

          <div class="modul-card active">
            <div class="modul-badge active">
              <i class="fas fa-spinner"></i> Dalam Proses
            </div>
            <div class="modul-icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <h3>Desain UI/UX Mobile</h3>
            <p>Prinsip desain antarmuka pengguna untuk aplikasi mobile.</p>
            <div class="modul-meta">
              <span><i class="fas fa-book"></i> 8 Materi</span>
              <span><i class="fas fa-clock"></i> 3 Jam</span>
            </div>
            <a href="#" class="btn btn-primary">Lanjutkan</a>
          </div>

          <div class="modul-card">
            <div class="modul-badge">
              <i class="fas fa-lock"></i> Terkunci
            </div>
            <div class="modul-icon">
              <i class="fas fa-database"></i>
            </div>
            <h3>Database Fundamental</h3>
            <p>Konsep dasar database dan SQL untuk pemula.</p>
            <div class="modul-meta">
              <span><i class="fas fa-book"></i> 10 Materi</span>
              <span><i class="fas fa-clock"></i> 5 Jam</span>
            </div>
            <a href="#" class="btn btn-disabled">Mulai Belajar</a>
          </div>

          <div class="modul-card">
            <div class="modul-badge">
              <i class="fas fa-lock"></i> Terkunci
            </div>
            <div class="modul-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3>Analisis Data</h3>
            <p>Teknik analisis data menggunakan tools modern.</p>
            <div class="modul-meta">
              <span><i class="fas fa-book"></i> 15 Materi</span>
              <span><i class="fas fa-clock"></i> 6 Jam</span>
            </div>
            <a href="#" class="btn btn-disabled">Mulai Belajar</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-about">
          <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h3>EduPlatform</h3>
          </div>
          <p>Platform pembelajaran online interaktif untuk membantu Anda mencapai tujuan akademik.</p>
        </div>
        <div class="footer-links">
          <h4>Tautan Cepat</h4>
          <ul>
            <li><a href="index.html">Beranda</a></li>
            <li><a href="modul.html">Modul</a></li>
            <li><a href="tugas.html">Tugas</a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </div>
        <div class="footer-contact">
          <h4>Hubungi Kami</h4>
          <ul>
            <li><i class="fas fa-envelope"></i> hello@eduplatform.id</li>
            <li><i class="fas fa-phone"></i> +62 123 4567 890</li>
            <li><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2023 EduPlatform. All rights reserved.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/script.js"></script>
  <script>
    // Fungsi pencarian
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      const query = searchInput.value.toLowerCase();
      const modulCards = document.querySelectorAll('.modul-card');
      modulCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        card.style.display = title.includes(query) ? 'block' : 'none';
      });
    });

    // Toggle menu di perangkat mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');
    menuToggle.addEventListener('click', function() {
      nav.classList.toggle('active');
    });
  </script>
</body>
</html>
