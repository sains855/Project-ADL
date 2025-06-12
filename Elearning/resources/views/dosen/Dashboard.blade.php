<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EduManage - Dashboard Dosen</title>
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #4A6FA5 0%, #2E4A75 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Header Navigation */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .logo span {
            margin-right: 5px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            color: white;
            gap: 10px;
        }

        .notification {
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .avatar {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4A6FA5;
            font-weight: bold;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            color: #2E4A75;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
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

        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .class-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .class-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .class-header {
            margin-bottom: 15px;
        }

        .class-name {
            font-size: 16px;
            font-weight: bold;
            color: #2E4A75;
            margin-bottom: 5px;
        }

        .class-code {
            color: #6B7280;
            font-size: 12px;
            background: #f3f4f6;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .class-details {
            list-style: none;
            margin-bottom: 15px;
        }

        .class-details li {
            color: #4B5563;
            font-size: 13px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
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
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <span>🎓</span>
                EduManage
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="{{ route('dosen.dashboard') }}" class="active">Dashboard</a></li>
                    <li><a href="#">Kelas</a></li>
                    <li><a href="#">Mahasiswa</a></li>
                    <li><a href="#">Laporan</a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <div class="notification">3</div>
                <div>
                    <div style="font-size: 12px; opacity: 0.8;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 10px; opacity: 0.6;">Dosen</div>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
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
    </script>
</body>
</html>
