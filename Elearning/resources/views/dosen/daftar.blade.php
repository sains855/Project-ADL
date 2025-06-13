<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Daftar Kelas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            margin-bottom: 30px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        h2 {
            color: #34495e;
            font-weight: normal;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .dashboard-menu {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .dashboard-menu a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .dashboard-menu a:hover {
            background-color: #eaf2f8;
        }

        .dashboard-menu a.active {
            color: #2980b9;
            font-weight: bold;
            border-bottom: 2px solid #2980b9;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 8px 15px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .class-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px;
            transition: transform 0.2s;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .class-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .class-code {
            font-weight: bold;
            color: #2c3e50;
            font-size: 18px;
        }

        .class-time {
            color: #7f8c8d;
            font-size: 14px;
        }

        .class-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            color: #2980b9;
        }

        .class-teacher {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }

        .class-capacity {
            font-size: 13px;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .class-schedule {
            font-size: 13px;
            color: #555;
            background-color: #f9f9f9;
            padding: 8px;
            border-radius: 4px;
        }

        .action-buttons {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: background-color 0.2s;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-add {
            background-color: #2ecc71;
            color: white;
            padding: 8px 15px;
            margin-bottom: 20px;
            display: inline-block;
            text-decoration: none;
        }

        .btn-add:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>EduManage</h1>
            <h2>Management Kelas</h2>
        </header>

        <div class="dashboard-menu">
            <a href="#" class="active">Daftar Kelas</a>
            <a href="{{ route('dosen.create') }}">Tambah Kelas</a>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Cari kelas berdasarkan nama atau kode...">
        </div>

        <a href="{{ route('dosen.create') }}" class="btn btn-add">+ Tambah Kelas</a>

        <div class="class-grid">
            @foreach($classes as $class)
            <div class="class-card">
                <div class="class-header">
                    <span class="class-code">{{ $class->code }}</span>
                </div>

                <div class="class-title">{{ $class->name }}</div>
                <div class="class-teacher">{{ $class->teacher->name }}</div>
                <div class="class-schedule">
                </div>

                <div class="action-buttons">
                    <a href="{{ route('dosen.edit', $class->id) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('dosen.destroy', $class->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
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
