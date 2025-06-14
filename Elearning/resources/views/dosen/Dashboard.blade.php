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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
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
            color: #333;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 0.5rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-content.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
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
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
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
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .dashboard-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Stats Cards */
        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .stats-info h3 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .stats-info p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Table Styles */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            color: #333;
            font-weight: 600;
        }

        .add-btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
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
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background: linear-gradient(45deg, #667eea, #764ba2);
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
            background: rgba(102, 126, 234, 0.05);
        }

        .subject-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .subject-link:hover {
            color: #764ba2;
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
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
        }

        .btn-show:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.4);
        }

        .btn-edit {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }

        .btn-delete {
            background: linear-gradient(45deg, #f44336, #d32f2f);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.4);
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            background: linear-gradient(45deg, #4CAF50, #45a049);
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
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .alert-error {
            background: linear-gradient(45deg, #f44336, #d32f2f);
            color: white;
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.3);
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
                    <div class="profile-avatar"><?= strtoupper(substr($user['name'] ?? 'dosen', 0, 1)) ?></div>
                    <span><?= htmlspecialchars($user['name'] ?? 'dosen') ?></span>
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
        <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']) ?>
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
        <?php endif; ?>

        <!-- Total Kelas Stats -->
        <div class="stats-card">
            <div class="stats-content">
                <div class="stats-icon">📚</div>
                <div class="stats-info">
                    <h3 id="totalKelas"><?= $totalKelas ?? 0 ?></h3>
                    <p>Total Kelas</p>
                </div>
            </div>
        </div>

        <!-- Daftar Kelas Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Daftar Kelas</h2>
                <a href="/classes/create" class="add-btn">+ Tambah Kelas</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelajaran</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Berakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($classes)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #666;">
                            Belum ada data kelas
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($classes as $class): ?>
                    <tr>
                        <td><?= $class['id'] ?></td>
                        <td><?= htmlspecialchars($class['name']) ?></td>
                        <td><?= htmlspecialchars($class['hari']) ?></td>
                        <td><?= htmlspecialchars($class['jam_mulai']) ?></td>
                        <td><?= htmlspecialchars($class['jam_selesai']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ Route('learning.show') }}" class="btn btn-show">Detail</a>
                                <a href="/classes/<?= $class['id'] ?>/edit" class="btn btn-edit">Edit</a>
                                <form action="{{ route('dosen.destroy', $class->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="<?= csrf_token() ?? '' ?>">
    </form>

    <script>
        // Populate table if no server data
        if (document.querySelector('tbody').children.length === 1 &&
            document.querySelector('tbody').textContent.includes('Belum ada data kelas')) {
            populateTable(sampleClasses);
            document.getElementById('totalKelas').textContent = sampleClasses.length;
        }

        function populateTable(classes) {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            classes.forEach(classData => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${classData.no}</td>
                    <td>${classData.name}</td>
                    <td>
                        ${classData.subject_id ?
                            `<a href="/classes/${classData.id}/subjects" class="subject-link">${classData.subject}</a>` :
                            `<span style="color: #999;">${classData.subject}</span>`
                        }
                    </td>
                    <td>${classData.teacher}</td>
                    <td>${classData.schedule}</td>
                    <td><span class="status-badge">${classData.status}</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="/classes/${classData.id}" class="btn btn-show">Detail</a>
                            <a href="/classes/${classData.id}/edit" class="btn btn-edit">Edit</a>
                            <button class="btn btn-delete" onclick="deleteClass(${classData.id}, '${classData.name}')">Hapus</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

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

        // Delete class function
        function deleteClass(classId, className) {
            if (confirm(`Apakah Anda yakin ingin menghapus kelas "${className}"?`)) {
                const form = document.getElementById('deleteForm');
                form.action = `/dosen`;
                form.submit();
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Auto hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>

</html>
