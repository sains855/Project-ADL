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
            <button class="btn btn-primary" onclick="window.location.href='/assignments'">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
            </button>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Statistik Submission</h5>
                    <button class="btn btn-sm btn-outline-secondary" onclick="loadStats()">
                        <i class="bi bi-arrow-clockwise"></i> Refresh
                    </button>
                </div>
                <div id="statsContainer" class="mt-3">
                    <!-- Stats will be loaded here -->
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Submission</h5>
                <div class="input-group" style="width: 300px;">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari mahasiswa...">
                    <button class="btn btn-outline-secondary" type="button" onclick="searchSubmissions()">
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
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div id="totalSubmissions" class="text-muted"></div>
                    <nav>
                        <ul class="pagination mb-0">
                            <!-- Pagination will be added here if needed -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Submission Detail -->
    <div class="modal fade" id="submissionDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="submissionDetailContent">
                    <!-- Detail will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const assignmentId = new URLSearchParams(window.location.search).get('assignmentId');

        document.addEventListener('DOMContentLoaded', function() {
            if (!assignmentId) {
                alert('Assignment ID tidak ditemukan');
                window.location.href = '/assignments';
                return;
            }

            loadSubmissions();
            loadStats();
        });

        function loadSubmissions(searchTerm = '') {
            let url = `/api/assignments/${assignmentId}/submissions`;
            if (searchTerm) {
                url += `/search?search=${encodeURIComponent(searchTerm)}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('assignmentTitle').textContent =
                            `Daftar Submission: ${data.data.assignment.title}`;

                        const tableBody = document.getElementById('submissionsTableBody');
                        tableBody.innerHTML = '';

                        data.data.submissions.forEach(submission => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${submission.student_name}</td>
                                <td>${submission.student_email}</td>
                                <td>${submission.submitted_at}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="viewSubmissionDetail(${submission.id})">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="/api/submissions/${submission.id}/download" class="btn btn-sm btn-success">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });

                        document.getElementById('totalSubmissions').textContent =
                            `Total: ${data.data.submissions.length} submission(s)`;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data');
                });
        }

        function loadStats() {
            fetch(`/api/assignments/${assignmentId}/submissions/stats`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const statsContainer = document.getElementById('statsContainer');

                        // Recent submissions
                        let recentSubsHtml = `
                            <div class="mb-3">
                                <h6>5 Submission Terakhir</h6>
                                <ul class="list-group">
                        `;

                        data.data.recent_submissions.forEach(sub => {
                            recentSubsHtml += `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>${sub.student_name}</span>
                                    <span class="badge bg-primary rounded-pill">${sub.submitted_at}</span>
                                </li>
                            `;
                        });

                        recentSubsHtml += `</ul></div>`;

                        // Submissions per day (chart would be better, but using simple list for now)
                        let perDayHtml = `
                            <div>
                                <h6>Submission 7 Hari Terakhir</h6>
                                <ul class="list-group">
                        `;

                        data.data.submissions_per_day.forEach(day => {
                            perDayHtml += `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>${day.date}</span>
                                    <span class="badge bg-success rounded-pill">${day.count} submission(s)</span>
                                </li>
                            `;
                        });

                        perDayHtml += `</ul></div>`;

                        statsContainer.innerHTML = `
                            <div class="row">
                                <div class="col-md-6">
                                    ${recentSubsHtml}
                                </div>
                                <div class="col-md-6">
                                    ${perDayHtml}
                                </div>
                            </div>
                            <div class="alert alert-info mt-3">
                                Total Submission: <strong>${data.data.total_submissions}</strong>
                            </div>
                        `;
                    }
                });
        }

        function viewSubmissionDetail(submissionId) {
            fetch(`/api/submissions/${submissionId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modalContent = document.getElementById('submissionDetailContent');

                        modalContent.innerHTML = `
                            <div class="mb-4">
                                <h4>${data.data.assignment.title}</h4>
                                <p class="text-muted">${data.data.assignment.description}</p>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Informasi Mahasiswa</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>Nama:</strong> ${data.data.student.name}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Email:</strong> ${data.data.student.email}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>NIM:</strong> ${data.data.student.nim || '-'}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Detail Submission</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>Dikumpulkan pada:</strong> ${data.data.submitted_at}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>File:</strong>
                                            <a href="/api/submissions/${submissionId}/download" class="ms-2">
                                                Download <i class="bi bi-download"></i>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Diperbarui pada:</strong> ${data.data.updated_at}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        `;

                        const modal = new bootstrap.Modal(document.getElementById('submissionDetailModal'));
                        modal.show();
                    } else {
                        alert(data.message);
                    }
                });
        }

        function searchSubmissions() {
            const searchTerm = document.getElementById('searchInput').value;
            loadSubmissions(searchTerm);
        }
    </script>
</body>
</html>
