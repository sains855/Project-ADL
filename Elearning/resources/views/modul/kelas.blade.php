<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPlatform - Pilih Kelas</title>
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
        <a href="{{ route('modul.index') }}"><i class="fas fa-home"></i> Beranda</a>
        <a href="" class="active"><i class="fas fa-book-open"></i> Modul</a>
        <a href="{{ route('modul.tugas') }}"><i class="fas fa-tasks"></i> Tugas</a>
        <div class="profile-dropdown">
          <button class="profile-btn" onclick="toggleDropdown()">
            <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <span>{{ Auth::user()->name ?? 'User' }}</span>
            <span>▼</span>
          </button>
          <div class="dropdown-content" id="dropdownContent">
            <a href="{{ route('profile.index') }}" class="dropdown-item">👤 Profile</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">🚪 Logout</button>
            </form>
            <a href="../chatify" class="dropdown-item">💬 Chat</a>
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
          <h2>Pilih Kelas Anda</h2>
          <p>Silakan pilih kelas yang ingin Anda pelajari.</p>
        </div>
      </div>
    </section>

    <section class="features">
      <div class="container">
        <div class="features-grid">
          @forelse($classes as $class)
            <div class="feature-card">
              <div class="feature-icon">
                <i class="fas fa-chalkboard"></i>
              </div>
              <h3>{{ $class->name }}</h3>
              <p>{{ $class->description ?? 'Tidak ada deskripsi.' }}</p>
              <a href="{{ route('modul.dashboard', $class->id) }}" class="btn btn-primary">Lihat Modul</a>
            </div>
          @empty
            <p>Tidak ada kelas yang tersedia saat ini.</p>
          @endforelse
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
            <h3>EduMas</h3>
          </div>
          <p>Platform pembelajaran online interaktif untuk membantu Anda mencapai tujuan akademik.</p>
        </div>
        <div class="footer-links">
          <h4>Created By Kelompok 3</h4>
          <ul>
            <li>ABRAR WUJEDAAN</li>
            <li>ISRANOFRIANTI</li>
            <li>TRASMA ARRASMA AR</li>
            <li>MUH. SYAHRUL MUBARAK</li>
            <li>MUZHAR MAULANA</li>
            <li>ZAKKIYA FITRA RAHMA DINA</li>
          </ul>
        </div>
        <div class="footer-contact">
          <h4>Hubungi Kami</h4>
          <ul>
            <li><i class="fas fa-envelope"></i> hello@eduplatform.id</li>
            <li><i class="fas fa-phone"></i> +62 123 4567 890</li>
            <li><i class="fas fa-map-marker-alt"></i> Kendari, Indonesia</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 EduMas. All rights reserved.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    function toggleDropdown() {
      var content = document.getElementById('dropdownContent');
      content.style.display = content.style.display === 'block' ? 'none' : 'block';
    }
  </script>

  <script src="{{ asset('js/modul.js') }}"></script>
</body>
</html>
