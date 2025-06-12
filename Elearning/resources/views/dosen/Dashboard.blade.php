<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Custom CSS untuk halaman Manajemen Kelas - EduManage Style */

        /* Background dan Layout Utama */
        body {
            background: linear-gradient(135deg, #4A6FA5 0%, #2E4A75 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .header-section h2 {
            color: #2E4A75;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-section p {
            color: #6B7280;
            font-size: 14px;
            margin: 0;
        }

        /* Navigation Tabs */
        .nav-tabs {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-tab {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #6B7280;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .nav-tab.active {
            background: #4A6FA5;
            color: white;
            box-shadow: 0 2px 8px rgba(74, 111, 165, 0.3);
        }

        .nav-tab:hover:not(.active) {
            background: rgba(74, 111, 165, 0.1);
            color: #4A6FA5;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #2E4A75;
            margin: 0 0 8px 0;
            line-height: 1;
        }

        .stat-label {
            color: #6B7280;
            font-size: 14px;
            font-weight: 500;
            margin: 0;
        }

        /* Main Content Section */
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .section-title {
            color: #2E4A75;
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 20px 0;
        }

        /* Class Cards Grid */
        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .class-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(74, 111, 165, 0.1);
            transition: all 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            border-color: rgba(74, 111, 165, 0.2);
        }

        .class-title {
            color: #2E4A75;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }

        .class-code {
            color: #6B7280;
            font-size: 12px;
            margin: 0 0 15px 0;
            font-weight: 500;
        }

        .class-details {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .class-details li {
            color: #374151;
            font-size: 13px;
            margin: 0 0 6px 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .class-details li:last-child {
            margin-bottom: 0;
        }

        /* Status Badges */
        .status-aktif {
            color: #3B82F6 !important;
            font-weight: 600;
        }

        .status-selesai {
            color: #F59E0B !important;
            font-weight: 600;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #F3F4F6;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-edit {
            background: #3B82F6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563EB;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #EF4444;
            color: white;
        }

        .btn-delete:hover {
            background: #DC2626;
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .classes-grid {
                grid-template-columns: 1fr;
            }

            .nav-tabs {
                flex-direction: column;
                gap: 2px;
            }

            .nav-tab {
                text-align: left;
            }

            .container {
                padding: 15px;
            }

            .header-section,
            .main-content {
                padding: 20px;
            }

            .stat-number {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /* Additional Enhancements */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #4A6FA5 0%, #2E4A75 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(74, 111, 165, 0.5);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(74, 111, 165, 0.7);
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="text-2xl font-bold mb-4">📚 Manajemen Kelas</h2>
        <p class="mb-6 text-gray-600">Kelola mata kuliah dan kelas dengan mudah dan efisien</p>

        <div class="flex space-x-4 mb-6">
            <div class="bg-white p-4 rounded shadow w-1/4 text-center">
                <p class="text-gray-500">Total Kelas</p>
                <h3 class="text-xl font-semibold">{{ $totalKelas }}</h3>
            </div>
            <div class="bg-white p-4 rounded shadow w-1/4 text-center">
                <p class="text-gray-500">Kelas Aktif</p>
                <h3 class="text-xl font-semibold">{{ $kelasAktif }}</h3>
            </div>
            <div class="bg-white p-4 rounded shadow w-1/4 text-center">
                <p class="text-gray-500">Total Mahasiswa</p>
                <h3 class="text-xl font-semibold">{{ $totalMahasiswa }}</h3>
            </div>
            <div class="bg-white p-4 rounded shadow w-1/4 text-center">
                <p class="text-gray-500">Kelas Selesai</p>
                <h3 class="text-xl font-semibold">{{ $kelasSelesai }}</h3>
            </div>
        </div>

        <h4 class="text-lg font-semibold mb-3">Kelas Terbaru</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($classes as $class)
                <div class="bg-white p-4 rounded shadow">
                    <h5 class="font-bold">{{ $class->name }}</h5>
                    <p class="text-sm text-gray-500">{{ $class->code ?? 'KODE-KELAS' }}</p>
                    <ul class="text-sm mt-2 text-gray-700">
                        <li>👨‍🏫 {{ $class->teacher->name }}</li>
                        <li>📘 {{ $class->subjects->count() }} Mata Kuliah</li>
                        <li>📅 Jadwal: {{ $class->schedule ?? 'Belum ditentukan' }}</li>
                        <li>🏫 Ruangan: {{ $class->room ?? '-' }}</li>
                        <li>👥 {{ $class->student_count }} mahasiswa</li>
                        <li>Status:
                            <span class="{{ $class->status == 'Aktif' ? 'text-blue-600' : 'text-yellow-600' }}">
                                {{ $class->status }}
                            </span>
                        </li>
                    </ul>
                    <div class="flex justify-end space-x-2 mt-3">
                        <a href="#" class="px-3 py-1 text-sm bg-blue-500 text-white rounded">Edit</a>
                        <a href="#" class="px-3 py-1 text-sm bg-red-500 text-white rounded">Hapus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
