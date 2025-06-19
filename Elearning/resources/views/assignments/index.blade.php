<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengumpulan Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(33, 150, 243, 0.3);
        }

        .page-header h2 {
            margin: 0;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .assignment-info {
            background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #2196F3;
        }

        .btn-back {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            color: white;
            text-decoration: none;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .table thead th {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
            text-align: center;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #E3F2FD;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem;
            border-color: #E3F2FD;
            vertical-align: middle;
        }

        .file-link {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .file-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            color: white;
            text-decoration: none;
        }

        .alert-custom {
            background: linear-gradient(135deg, #FFF3E0, #FFE0B2);
            border: none;
            border-radius: 12px;
            border-left: 4px solid #FF9800;
            color: #E65100;
            font-weight: 500;
        }

        .table-stats {
            background: linear-gradient(135deg, #E8F5E8, #C8E6C9);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #4CAF50;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2E7D32;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="container fade-in">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/dosen" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="page-header">
            <h2><i class="fas fa-clipboard-list me-3"></i>Daftar Pengumpulan Tugas: {{ $assignment->title }}</h2>
        </div>

        <div class="assignment-info">
            <p class="mb-0"><strong><i class="fas fa-id-card me-2"></i>Assignment ID:</strong> {{ $assignment->id }}</p>
        </div>

        @if($submissions->isEmpty())
            <div class="alert alert-custom mt-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Belum ada pengumpulan tugas.
            </div>
        @else
            <div class="table-stats">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users me-3 text-success" style="font-size: 1.5rem;"></i>
                    <div>
                        <div class="stat-number">{{ count($submissions) }}</div>
                        <small class="text-muted">Total Pengumpulan</small>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>#</th>
                            <th><i class="fas fa-user me-2"></i>Nama Siswa</th>
                            <th><i class="fas fa-clock me-2"></i>Waktu Pengumpulan</th>
                            <th><i class="fas fa-file me-2"></i>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $index => $submission)
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <i class="fas fa-user-circle me-2 text-primary"></i>
                                    {{ $submission->user->name ?? 'Tidak Diketahui' }}
                                </td>
                                <td>
                                    <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                    {{ $submission->submitted_at }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/' . $submission->file_url) }}" target="_blank" class="file-link">
                                        <i class="fas fa-download me-2"></i>Lihat File
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
