<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">📚 Daftar Assignment Anda</h2>

        @if ($assignments->isEmpty())
            <div class="alert alert-warning">
                Belum ada assignment yang Anda buat.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kelas</th>
                            <th>Modul</th>
                            <th>Batas Waktu</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $index => $assignment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td>{{ $assignment->class->name ?? '-' }}</td>
                                <td>{{ $assignment->module->title ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</td>
                                <td>{{ $assignment->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('assignments.submissions.view', $assignment->id) }}" class="btn btn-primary btn-sm">
                                        📄 Submission
                                    </a>
                                    <a href="{{ route('assignments.submissions.stats', $assignment->id) }}" class="btn btn-secondary btn-sm">
                                        📊 Statistik
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
