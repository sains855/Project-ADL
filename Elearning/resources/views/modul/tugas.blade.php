<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduMas - Tugas & Pengumpulan</title>
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
        <h1>EduMas</h1>
      </div>
      <nav>
        <a href="../../mahasiswa/dashboard"><i class="fas fa-home"></i> Beranda</a>
        <a href="../modul"><i class="fas fa-book-open"></i> Modul</a>
        <a href="./tugas" class="active"><i class="fas fa-tasks"></i> Tugas</a>
        <div class="profile-dropdown">
            <button class="profile-btn" onclick="toggleDropdown()">
                <div class="profile-avatar"><?= strtoupper(substr(Auth::user()->name ?? 'User', 0, 1)) ?></div>
                <span><?= htmlspecialchars(Auth::user()->name ?? 'User') ?></span>
                <span>▼</span>
                </button>
            <div class="dropdown-content" id="dropdownContent">
                <a href="#" class="dropdown-item">👤 Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">🚪 Logout</button>
                </form>
            </div>
        </div>
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
              <style>
    .upload-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .upload-container h2 {
        margin-bottom: 20px;
        font-size: 22px;
        color: #333;
        text-align: center;
    }

    .upload-label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 500;
    }

    .upload-input {
        width: 100%;
        padding: 12px;
        background: #f9f9f9;
        border: 2px dashed #ccc;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-input:hover {
        background-color: #eef1ff;
        border-color: #5c6ac4;
    }

    .upload-button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background: #5c6ac4;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .upload-button:hover {
        background-color: #3e4aaa;
    }

    .success-message {
        margin-top: 15px;
        color: green;
        text-align: center;
        font-size: 14px;
    }
</style>

<div class="upload-container">
    <h2>Kirim Tugas</h2>
    <form action="{{ route('modul.tugas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file" class="upload-label">Pilih File Tugas:</label>
        <input type="file" name="file" id="file" class="upload-input">

        <button type="submit" class="upload-button">Upload</button>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>



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
              <div class="upload-container">
    <h2>Kirim Tugas</h2>
            <form action="{{ route('modul.tugas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file" class="upload-label">Pilih File Tugas:</label>
                <input type="file" name="file" id="file" class="upload-input">

                <button type="submit" class="upload-button">Upload</button>

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>

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
  <script src="{{ asset('js/modul.js') }}"></script>
</body>

</html>
