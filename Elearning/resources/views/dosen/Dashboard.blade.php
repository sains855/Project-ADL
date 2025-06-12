<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Custom CSS untuk halaman Manajemen Kelas - EduManage Style */

        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Background dan Layout Utama */
        body {
            background: linear-gradient(135deg, #4A6FA5 0%, #2E4A75 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        /* Typography */
        .text-2xl {
            font-size: 1.5rem;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-gray-600 {
            color: #6B7280;
        }

        .text-gray-500 {
            color: #6B7280;
        }

        .text-gray-700 {
            color: #374151;
        }

        .text-blue-600 {
            color: #3B82F6;
        }

        .text-yellow-600 {
            color: #F59E0B;
        }

        .text-white {
            color: white;
        }

        /* Layout */
        .flex {
            display: flex;
        }

        .space-x-4>*+* {
            margin-left: 1rem;
        }

        .space-x-2>*+* {
            margin-left: 0.5rem;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .w-1\/4 {
            width: 25%;
        }

        .text-center {
            text-align: center;
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, 1fr);
        }

        .gap-4 {
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .md\:grid-cols-3 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Cards and Shadows */
        .bg-white {
            background-color: white;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .p-4 {
            padding: 1rem;
        }

        /* Buttons */
        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .bg-blue-500 {
            background-color: #3B82F6;
        }

        .bg-red-500 {
            background-color: #EF4444;
        }

        /* List */
        ul {
            list-style: none;
        }

        /* Utility Classes */
        .rounded {
            border-radius: 0.375rem;
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
