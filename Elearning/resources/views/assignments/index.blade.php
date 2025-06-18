<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment Submissions by Module</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Daftar Pengumpulan Tugas untuk Modul: {{ $moduleName }}</h2>

    @if ($submissions->isEmpty())
        <div class="alert alert-warning mt-4">
            Belum ada pengumpulan tugas untuk modul ini.
        </div>
    @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Judul Tugas</th>
                    <th>Tanggal Pengumpulan</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $submission->user->name }}</td>
                        <td>{{ $submission->assignment->title ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ asset('storage/ '. $submission->file_url) }}" target="_blank" class="btn btn-sm btn-primary">
                                Lihat File
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
