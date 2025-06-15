{{-- resources/views/assignments/submissions/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Submission Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 id="assignmentTitle">Daftar Submission</h1>
        <a href="{{ route('assignments.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
        </a>
    </div>

    {{-- Statistik Submission --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Statistik Submission</h5>
                <button class="btn btn-sm btn-outline-secondary" onclick="loadStats()">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>
            <div id="statsContainer" class="mt-3">
                <!-- Statistik diisi via JS -->
            </div>
        </div>
    </div>

    {{-- Daftar Submission --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Submission</h5>
            <div class="input-group" style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari mahasiswa...">
                <button class="btn btn-outline-secondary" onclick="searchSubmissions()">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Email</th>
                        <th>Waktu Pengumpulan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="submissionsTableBody">
                    <!-- Baris diisi oleh JS -->
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div id="totalSubmissions" class="text-muted"></div>
                <nav><ul class="pagination mb-0"></ul></nav>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Submission --}}
<div class="modal fade" id="submissionDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Submission</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="submissionDetailContent">
                <!-- Konten dari JS -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const assignmentId = '{{ $assignmentId }}';

    document.addEventListener('DOMContentLoaded', () => {
        if (!assignmentId) {
            alert('Assignment ID tidak ditemukan.');
            window.location.href = '/assignments';
            return;
        }

        loadSubmissions();
        loadStats();
    });

    function loadSubmissions(search = '') {
        let url = `/assignments/${assignmentId}/submissions`;
        if (search) url = `/assignments/${assignmentId}/submissions/search?search=${encodeURIComponent(search)}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return alert(data.message);
                document.getElementById('assignmentTitle').textContent =
                    `Daftar Submission: ${data.data.assignment.title}`;

                const tbody = document.getElementById('submissionsTableBody');
                tbody.innerHTML = '';
                data.data.submissions.forEach(sub => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${sub.student_name}</td>
                            <td>${sub.student_email}</td>
                            <td>${sub.submitted_at}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="viewSubmissionDetail(${sub.id})">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                                <a href="/assignments/submissions/${sub.id}/download" class="btn btn-sm btn-success">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </td>
                        </tr>`;
                });

                document.getElementById('totalSubmissions').textContent =
                    `Total: ${data.data.submissions.length} submission(s)`;
            });
    }

    function loadStats() {
        fetch(`/assignments/${assignmentId}/submissions/stats`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;
                document.getElementById('statsContainer').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>5 Submission Terakhir</h6>
                            <ul class="list-group">
                                ${data.data.recent_submissions.map(s => `
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>${s.student_name}</span>
                                        <span class="badge bg-primary">${s.submitted_at}</span>
                                    </li>`).join('')}
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Submission 7 Hari Terakhir</h6>
                            <ul class="list-group">
                                ${data.data.submissions_per_day.map(d => `
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>${d.date}</span>
                                        <span class="badge bg-success">${d.count}</span>
                                    </li>`).join('')}
                            </ul>
                        </div>
                    </div>
                    <div class="alert alert-info mt-3">
                        Total Submission: <strong>${data.data.total_submissions}</strong>
                    </div>`;
            });
    }

    function viewSubmissionDetail(id) {
        fetch(`/assignments/submissions/${id}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return alert(data.message);
                const d = data.data;
                document.getElementById('submissionDetailContent').innerHTML = `
                    <div class="mb-4">
                        <h4>${d.assignment.title}</h4>
                        <p class="text-muted">${d.assignment.description}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Mahasiswa</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Nama:</strong> ${d.student.name}</li>
                                <li class="list-group-item"><strong>Email:</strong> ${d.student.email}</li>
                                <li class="list-group-item"><strong>NIM:</strong> ${d.student.nim || '-'}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Submission</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Dikumpulkan:</strong> ${d.submitted_at}</li>
                                <li class="list-group-item"><strong>File:</strong>
                                    <a href="/assignments/submissions/${id}/download" class="ms-2">Download</a>
                                </li>
                                <li class="list-group-item"><strong>Update Terakhir:</strong> ${d.updated_at}</li>
                            </ul>
                        </div>
                    </div>`;
                new bootstrap.Modal(document.getElementById('submissionDetailModal')).show();
            });
    }

    function searchSubmissions() {
        const keyword = document.getElementById('searchInput').value;
        loadSubmissions(keyword);
    }
</script>
</body>
</html>
