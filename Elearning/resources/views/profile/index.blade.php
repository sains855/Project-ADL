<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .profile-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-card,
        .info-card,
        .actions-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-card:hover,
        .info-card:hover,
        .actions-card:hover {
            transform: translateY(-5px);
        }

        .profile-avatar {
            text-align: center;
            margin-bottom: 25px;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 3rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-role {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .role-dosen {
            background: #e3f2fd;
            color: #1976d2;
        }

        .role-mahasiswa {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #6c757d;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        .verification-status {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .verified {
            color: #28a745;
        }

        .unverified {
            color: #dc3545;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e9ecef;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            color: #495057;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-info {
            background: #cce7ff;
            color: #004085;
            border: 1px solid #b3d7ff;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .stats-grid {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #667eea;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }

            .profile-card,
            .info-card,
            .actions-card {
                padding: 20px;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-header h3 {
            color: #dc3545;
            margin-bottom: 10px;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-circle"></i> Profil Pengguna</h1>
            <p>Kelola informasi akun dan pengaturan profil Anda</p>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <span>
                    @foreach ($errors->all() as $error)
                        {{ $error }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </span>
            </div>
        @endif

        @if (!$user->hasVerifiedEmail())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Email Anda belum diverifikasi. Silakan cek email Anda atau kirim ulang link verifikasi.</span>
            </div>
        @endif

        <div class="profile-container">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-avatar">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-name">{{ $user->name }}</div>
                    <span class="profile-role role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                </div>

                <div class="info-section">
                    <div class="info-title">
                        <i class="fas fa-chart-line"></i>
                        Statistik Akun
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-value">{{ $user->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Hari Aktif</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">{{ $user->updated_at->format('H:i') }}</div>
                            <div class="stat-label">Update Terakhir</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="info-card">
                <div class="info-section">
                    <div class="info-title">
                        <i class="fas fa-info-circle"></i>
                        Informasi Personal
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ $user->name }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Role</div>
                            <div class="info-value">{{ ucfirst($user->role) }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Status Verifikasi Email</div>
                            <div class="verification-status">
                                @if ($user->hasVerifiedEmail())
                                    <span class="verified">
                                        <i class="fas fa-check-circle"></i>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span class="unverified">
                                        <i class="fas fa-times-circle"></i>
                                        Belum Terverifikasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tanggal Bergabung</div>
                            <div class="info-value">{{ $user->created_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="actions-grid">
                    <a href="{{ route('profile.edit') }}" class="action-btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit Profil
                    </a>

                    <button class="action-btn btn-danger" onclick="showDeleteModal()">
                        <i class="fas fa-trash-alt"></i>
                        Hapus Akun
                    </button>
                    <div class="actions">
                        <a href="{{ route('modul.index') }}" class="action-btn btn-primary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Change Modal -->
        <div id="passwordModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('passwordModal')">&times;</span>
                <div class="modal-header">
                    <h3><i class="fas fa-key"></i> Ubah Password</h3>
                    <p>Masukkan password lama dan password baru Anda</p>
                </div>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-input" required minlength="8">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-input" required>
                    </div>
                    <div class="modal-buttons">
                        <button type="button" class="action-btn btn-secondary"
                            onclick="closeModal('passwordModal')">Batal</button>
                        <button type="submit" class="action-btn btn-primary">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
                <div class="modal-header">
                    <h3><i class="fas fa-exclamation-triangle"></i> Hapus Akun</h3>
                    <p>Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.</p>
                </div>
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label class="form-label">Masukkan Password untuk Konfirmasi</label>
                        <input type="password" name="password" class="form-input" required>
                    </div>
                    <div class="modal-buttons">
                        <button type="button" class="action-btn btn-secondary"
                            onclick="closeModal('deleteModal')">Batal</button>
                        <button type="submit" class="action-btn btn-danger">Ya, Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Modal functions
            function showPasswordModal() {
                document.getElementById('passwordModal').style.display = 'block';
            }

            function showDeleteModal() {
                document.getElementById('deleteModal').style.display = 'block';
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modals = document.getElementsByClassName('modal');
                for (let modal of modals) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                }
            }

            // Animate cards on scroll
            function animateOnScroll() {
                const cards = document.querySelectorAll('.profile-card, .info-card, .stat-card');

                cards.forEach(card => {
                    const cardTop = card.getBoundingClientRect().top;
                    const cardVisible = 150;

                    if (cardTop < window.innerHeight - cardVisible) {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }
                });
            }

            // Initial animation setup
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.profile-card, .info-card, .stat-card');
                cards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                });

                // Trigger animation
                setTimeout(animateOnScroll, 100);
            });

            window.addEventListener('scroll', animateOnScroll);

            // Auto-hide alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
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
