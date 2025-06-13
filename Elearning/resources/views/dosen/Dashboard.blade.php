<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manajemen Kelas</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(to bottom right, #0f3c73, #a5b8da);
      color: #333;
      min-height: 100vh;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #052f5f;
      padding: 10px 30px;
      color: white;
    }

    .navbar .brand {
      font-weight: bold;
      font-size: 20px;
    }

    .navbar .menu {
      display: flex;
      gap: 20px;
    }

    .navbar .menu a {
      color: white;
      text-decoration: none;
      font-weight: 500;
    }

    .navbar .menu a:hover {
      text-decoration: underline;
    }

    .navbar .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .container {
      max-width: 1100px;
      margin: 30px auto;
      background-color: #e6eef8;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .section-header {
      background-color: #d9e4f0;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .section-header h2 {
      margin: 0;
      color: #052f5f;
    }

    .section-header p {
      margin: 5px 0 0;
      color: #555;
    }

    .nav-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .nav-tabs button {
      padding: 8px 20px;
      border: none;
      border-radius: 8px;
      background-color: #c2d4ee;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .nav-tabs button:hover {
      background-color: #a5b8da;
    }

    .nav-tabs button.active {
      background-color: #1d3f72;
      color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .grid-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .card h4 {
      margin: 0 0 10px 0;
      color: #1d3f72;
    }

    .card p {
      font-size: 14px;
      margin: 3px 0;
      color: #555;
    }

    .card .actions {
      margin-top: 10px;
      display: flex;
      gap: 8px;
    }

        .page-subtitle {
            color: #6B7280;
            font-size: 14px;
        }

        /* Tab Navigation */
        .tab-nav {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .tab-buttons {
            display: flex;
            gap: 15px;
        }

        .tab-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #6B7280;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .tab-btn.active {
            background: #4A6FA5;
            color: white;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #4A6FA5;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #6B7280;
            font-size: 14px;
        }

        /* Classes Section */
        .classes-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #2E4A75;
            margin-bottom: 20px;
        }

    .stat-box {
      flex: 1;
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-box br {
      display: none;
    }

    .stat-box:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

        .status-aktif {
            color: #3B82F6;
            font-weight: 500;
        }

        .status-selesai {
            color: #F59E0B;
            font-weight: 500;
        }

        .class-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #3B82F6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563EB;
        }

        .btn-delete {
            background: #EF4444;
            color: white;
        }

        .btn-delete:hover {
            background: #DC2626;
        }

        .btn-view {
            background: #10B981;
            color: white;
        }

        .btn-view:hover {
            background: #059669;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6B7280;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #4B5563;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .classes-grid {
                grid-template-columns: 1fr;
            }

            .profile-dropdown {
                right: -10px;
                min-width: 180px;
            }
        }
    </style>
</head>
<body>

  <div class="navbar">
    <div class="brand">📚 EduManage</div>
    <div class="menu">
      <a href="#">Dashboard</a>
      <a href="#">Kelas</a>
      <a href="#">Mahasiswa</a>
      <a href="#">Laporan</a>
    </div>
    <div class="profile">
      <span>👤 Dr. Ahmad Susanto</span>
      <span style="background:#ccc; padding:5px 10px; border-radius:50%;">AS</span>
    </div>
  </div>

  <div class="container">
    <div class="section-header">
      <h2>📘 Manajemen Kelas</h2>
      <p>Kelola mata kuliah dan kelas dengan mudah dan efisien</p>
    </div>

    <div class="nav-tabs">
      <button class="active">Dashboard</button>
      <button>Daftar Kelas</button>
      <button>Tambah Kelas</button>
    </div>

    <!-- Dashboard Section -->
    <div class="stats">
      <div class="stat-box">4 <br/>Total Kelas</div>
      <div class="stat-box">3 <br/>Kelas Aktif</div>
      <div class="stat-box">103 <br/>Total Mahasiswa</div>
      <div class="stat-box">1 <br/>Kelas Selesai</div>
    </div>

    <h3>Kelas Terbaru</h3>
    <div class="grid-cards">
      <div class="card">
        <h4>Basis Data (IF-302)</h4>
        <p>👩‍🏫 Prof. Siti Nurhaliza</p>
        <p>📚 3 SKS • Selasa, 10:00–12:00</p>
        <p>🏫 Ruang Kelas A • 👥 30/35 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>

      <div class="card">
        <h4>Pemrograman Web (IF-301)</h4>
        <p>👨‍🏫 Dr. Ahmad Susanto</p>
        <p>📚 4 SKS • Senin, 08:00–10:00</p>
        <p>🏫 Lab Komputer 1 • 👥 28/30 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>

      <div class="card">
        <h4>Kecerdasan Buatan (IF-303)</h4>
        <p>👨‍🏫 Dr. Bambang Setiawan</p>
        <p>📚 3 SKS • Rabu, 13:00–15:00</p>
        <p>🏫 Ruang Kelas B • 👥 25/30 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
    </header>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                📚 Dashboard Dosen
            </h1>
            <p class="page-subtitle">Kelola mata kuliah dan kelas dengan mudah dan efisien</p>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-nav">
            <div class="tab-buttons">
                <button class="tab-btn active">Dashboard</button>
                <button class="tab-btn">Daftar Kelas</button>
                <button class="tab-btn">Tambah Kelas</button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalKelas }}</div>
                <div class="stat-label">Total Kelas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $kelasAktif }}</div>
                <div class="stat-label">Kelas Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalMahasiswa }}</div>
                <div class="stat-label">Total Mahasiswa</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $kelasSelesai }}</div>
                <div class="stat-label">Kelas Selesai</div>
            </div>
        </div>

        <!-- Classes Section -->
        <div class="classes-section">
            <div class="section-title">Kelas Terbaru</div>

            @if($classes->count() > 0)
                <div class="classes-grid">
                    @foreach($classes->take(6) as $class)
                        <div class="class-card">
                            <div class="class-header">
                                <div class="class-name">{{ $class->subjects->name ?? 'Mata Kuliah Tidak Tersedia' }}</div>
                                <span class="class-code">{{ $class->class_code }}</span>
                            </div>
                            <ul class="class-details">
                                <li>
                                    <span>📅</span>
                                    <span>{{ $class->schedule ?? 'Jadwal belum ditentukan' }}</span>
                                </li>
                                <li>
                                    <span>👥</span>
                                    <span>{{ $class->student_count }} Mahasiswa</span>
                                </li>
                                <li>
                                    <span>📍</span>
                                    <span>{{ $class->room ?? 'Ruangan belum ditentukan' }}</span>
                                </li>
                                <li>
                                    <span>🎯</span>
                                    <span class="status-{{ strtolower($class->status) }}">{{ $class->status }}</span>
                                </li>
                                <li>
                                    <span>📊</span>
                                    <span>{{ $class->semester ?? 'Semester tidak tersedia' }}</span>
                                </li>
                            </ul>
                            <div class="class-actions">
                                <a href="#" class="btn btn-view">Lihat</a>
                                <a href="#" class="btn btn-edit">Edit</a>
                                <button class="btn btn-delete" onclick="confirmDelete({{ $class->id }})">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <h3>Belum Ada Kelas</h3>
                    <p>Anda belum memiliki kelas yang diampu. Silakan tambah kelas baru.</p>
                    <br>
                    <a href="#" class="btn btn-edit">Tambah Kelas Baru</a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Profile dropdown functionality
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const avatar = document.querySelector('.avatar');

            if (!dropdown.contains(event.target) && !avatar.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        function confirmDelete(classId) {
            if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
                // Implementasi delete via AJAX atau form
                console.log('Deleting class with ID:', classId);
                // window.location.href = '/dosen/classes/' + classId + '/delete';
            }
        }

        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('profileDropdown').classList.remove('show');
            }
        });
    </script>
</body>
</html>
