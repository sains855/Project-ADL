<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>EduMas - Tugas & Pengumpulan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/modul.css') }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <style>
    .upload-container {
        max-width: 400px;
        margin-top: 20px;
        padding: 20px;
        background: #8598caeb;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .upload-label {
        margin-bottom: 8px;
        font-weight: 500;
        display: block;
    }
    .upload-input {
        width: 100%;
        padding: 10px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        background: #f9f9f9;
    }
    .upload-button {
        margin-top: 15px;
        padding: 10px;
        width: 100%;
        background: #5c6ac4;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    .upload-button:hover {
        background: #3e4aaa;
    }
    .success-message {
        color: green;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }
  </style>
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
        <a href="./modul"><i class="fas fa-book-open"></i> Modul</a>
        <a href="#" class="active"><i class="fas fa-tasks"></i> Tugas</a>
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
        <div class="tugas-grid">
          @foreach ($assignments as $assignment)
            <div class="tugas-card {{ $uploadedTugas[$assignment->id] ? 'completed' : 'urgent' }}">
              <div class="tugas-header">
                <h3>
                  <i class="fas fa-book"></i>
                  {{ $assignment->module->title ?? 'Kelas Tidak Diketahui' }} - {{ $assignment->title }}
                </h3>
                <span class="priority {{ $uploadedTugas[$assignment->id] ? 'completed' : 'urgent' }}">
                  <i class="fas {{ $uploadedTugas[$assignment->id] ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                  {{ $uploadedTugas[$assignment->id] ? 'Terkumpul' : 'Belum Terkumpul' }}
                </span>
              </div>

              <p>{{ $assignment->deskripsi }}</p>
              <div class="tugas-meta">
                <div class="meta-item">
                  <i class="fas fa-calendar-alt"></i>
                  <span>Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}</span>
                </div>
              </div>

              <div class="tugas-footer">
                @if ($uploadedTugas[$assignment->id])
                  <div class="upload-container">
                    <p class="success-message">✅ Tugas telah diupload. Anda tidak dapat mengunggah ulang.</p>
                  </div>
                @else
                  <div class="upload-container">
                    <form action="{{ route('tugas.upload', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <label class="upload-label" for="file_{{ $assignment->id }}">Upload Tugas:</label>
                      <input type="file" name="file" id="file_{{ $assignment->id }}" class="upload-input" accept=".pdf,.docx,.zip" required>
                      <small style="color: #666; font-size: 12px; display: block; margin-top: 5px;">
                        Format yang diizinkan: PDF, DOCX, ZIP (Maks. 20MB)
                      </small>
                      <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                      <button type="submit" class="upload-button">
                        <i class="fas fa-upload"></i> Upload Tugas
                      </button>
                    </form>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
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
            <li><i class="fas fa-envelope"></i> hello@edumas.id</li>
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

  <!-- Success/Error Messages -->
  @if(session('success'))
    <div style="position: fixed; top: 20px; right: 20px; background: #4CAF50; color: white; padding: 15px; border-radius: 5px; z-index: 1000;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="position: fixed; top: 20px; right: 20px; background: #f44336; color: white; padding: 15px; border-radius: 5px; z-index: 1000;">
      {{ session('error') }}
    </div>
  @endif

  <script>
    function toggleDropdown() {
      document.getElementById("dropdownContent").classList.toggle("show");
    }

    // Auto hide messages after 5 seconds
    setTimeout(function() {
      const messages = document.querySelectorAll('[style*="position: fixed"]');
      messages.forEach(function(message) {
        if (message.style.position === 'fixed') {
          message.style.display = 'none';
        }
      });
    }, 5000);
  </script>
</body>
</html>
