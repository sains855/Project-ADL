<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPlatform - Tugas & Pengumpulan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/modul.css') }}">

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
        <a href="index.html"><i class="fas fa-home"></i> Beranda</a>
        <a href="modul.html"><i class="fas fa-book-open"></i> Modul</a>
        <a href="tugas.html" class="active"><i class="fas fa-tasks"></i> Tugas</a>
        <a href="#" class="btn-login"><i class="fas fa-user"></i> Masuk</a>
      </nav>
      <button class="menu-toggle"><i class="fas fa-bars"></i></button>
    </div>
  </header>

  <main class="tugas-page">
    <section class="page-header">
      <div class="container">
        <h1><i class="fas fa-tasks"></i> Tugas & Pengumpulan</h1>
        <p>Kelola tugas Anda dan pantau progress pengumpulan</p>
      </div>
    </section>

    <section class="tugas-section">
      <div class="container">
        <div class="progress-card">
          <div class="progress-info">
            <h3>Progress Tugas</h3>
            <p>Anda telah menyelesaikan 2 dari 5 tugas</p>
          </div>
          <div class="progress-bar">
            <div class="progress" style="width: 40%"></div>
          </div>
          <div class="progress-percent">40%</div>
        </div>

        <div class="tugas-filter">
          <div class="filter-group">
            <button class="filter-btn active">Semua</button>
            <button class="filter-btn">Belum Selesai</button>
            <button class="filter-btn">Selesai</button>
          </div>
          <div class="sort-group">
            <span>Urutkan:</span>
            <select class="sort-select">
              <option>Deadline Terdekat</option>
              <option>Deadline Terjauh</option>
              <option>Nama Tugas</option>
            </select>
          </div>
        </div>

        <div class="tugas-grid">
          <div class="tugas-card urgent">
            <div class="tugas-header">
              <h3><i class="fas fa-paint-brush"></i> Desain Antarmuka Aplikasi</h3>
              <span class="priority urgent"><i class="fas fa-exclamation-circle"></i> Prioritas Tinggi</span>
            </div>
            <p>Buat desain antarmuka untuk aplikasi mobile dengan minimal 5 halaman berbeda.</p>
            <div class="tugas-meta">
              <div class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Deadline: 3 Juni 2025</span>
              </div>
              <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span>Sisa: 2 Hari</span>
              </div>
            </div>
            <div class="tugas-footer">
              <div class="file-info">
                <i class="fas fa-file-image"></i>
                <span>Format: PNG/PDF</span>
              </div>
              <a href="#" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah Tugas</a>
            </div>
          </div>

          <div class="tugas-card normal">
            <div class="tugas-header">
              <h3><i class="fas fa-code"></i> Prototipe Interaktif</h3>
              <span class="priority normal"><i class="fas fa-info-circle"></i> Prioritas Normal</span>
            </div>
            <p>Buat prototipe interaktif menggunakan Figma dengan minimal 3 alur pengguna.</p>
            <div class="tugas-meta">
              <div class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Deadline: 10 Juni 2025</span>
              </div>
              <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span>Sisa: 9 Hari</span>
              </div>
            </div>
            <div class="tugas-footer">
              <div class="file-info">
                <i class="fab fa-figma"></i>
                <span>Format: File Figma</span>
              </div>
              <a href="#" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah Tugas</a>
            </div>
          </div>

          <div class="tugas-card completed">
            <div class="tugas-header">
              <h3><i class="fas fa-file-alt"></i> Laporan Studi Kasus</h3>
              <span class="priority completed"><i class="fas fa-check-circle"></i> Selesai</span>
            </div>
            <p>Analisis studi kasus tentang penerapan prinsip HCI dalam aplikasi e-commerce.</p>
            <div class="tugas-meta">
              <div class="meta-item">
                <i class="fas fa-calendar-check"></i>
                <span>Terkumpul: 20 Mei 2025</span>
              </div>
              <div class="meta-item">
                <i class="fas fa-star"></i>
                <span>Nilai: 87/100</span>
              </div>
            </div>
            <div class="tugas-footer">
              <div class="file-info">
                <i class="fas fa-file-word"></i>
                <span>Format: DOCX</span>
              </div>
              <a href="#" class="btn btn-outline"><i class="fas fa-eye"></i> Lihat Feedback</a>
            </div>
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
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
