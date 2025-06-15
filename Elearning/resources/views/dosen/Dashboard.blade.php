<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kelas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            background: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e40af;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #1e40af;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.2);
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 0.5rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            border: 1px solid #e2e8f0;
        }

        .dropdown-content.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #1e293b;
            text-decoration: none;
            transition: background-color 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: inherit;
            font-family: inherit;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
            color: #1e40af;
        }

        /* Form inside dropdown should not affect styling */
        .dropdown-content form {
            margin: 0;
            padding: 0;
            display: block;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            color: #1e40af;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            color: #64748b;
        }

        /* Stats Cards */
        .stats-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .stats-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: #1e40af;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .stats-info h3 {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stats-info p {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Table Styles */
        .table-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.5rem;
            color: #1e293b;
            font-weight: 600;
        }

        .add-btn {
            padding: 0.75rem 1.5rem;
            background: #1e40af;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #1e40af;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        th:first-child {
            border-radius: 10px 0 0 0;
        }

        th:last-child {
            border-radius: 0 10px 0 0;
        }

        tr:hover {
            background: #f8fafc;
        }

        .subject-link {
            color: #1e40af;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .subject-link:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-show {
            background: #1e40af;
            color: white;
        }

        .btn-show:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(30, 64, 175, 0.2);
        }

        .btn-edit {
            background: #1e40af;
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(30, 64, 175, 0.2);
        }

        .btn-delete {
            background: #64748b;
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(100, 116, 139, 0.2);
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            background: #1e40af;
            color: white;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            position: relative;
        }

        .alert-success {
            background: #1e40af;
            color: white;
            box-shadow: 0 4px 10px rgba(30, 64, 175, 0.2);
        }

        .alert-error {
            background: #64748b;
            color: white;
            box-shadow: 0 4px 10px rgba(100, 116, 139, 0.2);
        }

        .close-alert {
            position: absolute;
            top: 0.5rem;
            right: 1rem;
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .navbar {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .table-container {
                padding: 1rem;
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.3rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-card,
        .table-container {
            animation: fadeIn 0.6s ease forwards;
        }

        .table-container {
            animation-delay: 0.2s;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">EduManage</div>
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown()">
                    <div class="profile-avatar"><?= strtoupper(substr(Auth::user()->name ?? 'User', 0, 1)) ?></div>
                    <span><?= htmlspecialchars(Auth::user()->name ?? 'User') ?></span>
                    <span>▼</span>
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="/profile" class="dropdown-item">👤 Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard Kelas</h1>
            <p class="dashboard-subtitle">Kelola semua kelas pembelajaran dengan mudah</p>
        </div>

        <!-- Alert Messages (Laravel Flash Messages) -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
        @endif

        <!-- Total Kelas Stats -->
        <div class="stats-card">
            <div class="stats-content">
                <div class="stats-icon">📚</div>
                <div class="stats-info">
                    <h3 id="totalKelas">{{ $totalKelas ?? 0 }}</h3>
                    <p>Total Kelas</p>
                </div>
            </div>
        </div>

        <!-- Daftar Kelas Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Daftar Kelas</h2>
                <a href="{{ route('classes.create') }}" class="add-btn">+ Tambah Kelas</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($classes->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem; color: #64748b;">
                            <div style="font-size: 1.2rem; margin-bottom: 0.5rem;">📚</div>
                            Belum ada kelas yang dibuat
                        </td>
                    </tr>
                    @else
                    @foreach($classes as $index => $class)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->description ?? 'Tidak ada deskripsi' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('learning.detail', $class->id) }}" class="btn btn-show">Detail</a>
                                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-delete" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $class->name }}?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownContent');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.profile-btn') && !event.target.closest('.profile-btn')) {
                const dropdown = document.getElementById('dropdownContent');
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Auto hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>

</html>
