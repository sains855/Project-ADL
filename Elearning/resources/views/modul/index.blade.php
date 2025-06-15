<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPlatform - Beranda</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <<link rel="stylesheet" href="{{ asset('css/modul.css') }}">
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
        <a href="./dashboard" class="active"><i class="fas fa-home"></i> Beranda</a>
        <a href="./modul"><i class="fas fa-book-open"></i> Modul</a>
        <a href="./modul/tugas"><i class="fas fa-tasks"></i> Tugas</a>
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

  <main>
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <h2>Belajar Interaktif dengan Pengalaman Terbaik</h2>
          <p>Tingkatkan keterampilan Anda dengan modul pembelajaran berkualitas dan sistem penugasan yang terintegrasi.</p>
          <div class="hero-actions">
            <a href="./modul" class="btn btn-primary">Mulai Belajar</a>
            <a href="./modul/tugas" class="btn btn-outline">Lihat Tugas</a>
          </div>
        </div>
        <div class="hero-image">
          <img src="https://illustrations.popsy.co/amber/student-sitting-at-desk.svg" alt="Belajar Interaktif">
        </div>
      </div>
    </section>

    <section class="features">
      <div class="container">
        <h2 class="section-title">Keunggulan Platform Kami</h2>
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h3>Modul Interaktif</h3>
            <p>Materi pembelajaran dirancang secara interaktif untuk memaksimalkan pemahaman.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-clock"></i>
            </div>
            <h3>Fleksibel</h3>
            <p>Belajar kapan saja dan di mana saja sesuai dengan waktu luang Anda.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3>Progress Tracking</h3>
            <p>Pantau perkembangan belajar Anda dengan sistem pelacakan yang komprehensif.</p>
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
            <li><a href="./dashboard">Beranda</a></li>
            <li><a href=./modul">Modul</a></li>
            <li><a href=".modul/tugas">Tugas</a></li>
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
