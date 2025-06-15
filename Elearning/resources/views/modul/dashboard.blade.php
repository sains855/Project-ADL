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
        <h1>EduMas</h1>
      </div>
      <nav>
        <a href="{{ route('modul.index') }}"><i class="fas fa-home"></i> Beranda</a>
        <a href="../modul" class="active"><i class="fas fa-book-open"></i> Modul</a>
        <a href="{{ route('modul.tugas') }}"><i class="fas fa-tasks"></i> Tugas</a>
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
        @forelse($class->moduls as $modul)
            <div class="modul-card">
            <div class="modul-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3>{{ $modul->judul }}</h3>
            <p>{{ $modul->deskripsi }}</p>
            <div class="modul-meta">
                <span><i class="fas fa-paperclip"></i> File: {{ basename($modul->file_path) }}</span>
            </div>
            <a href="{{ asset('storage/' . $modul->file_path) }}" class="btn btn-outline" target="_blank">Lihat Materi</a>
            </div>
        @empty
            <p>Tidak ada modul yang tersedia untuk kelas ini.</p>
        @endforelse
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
