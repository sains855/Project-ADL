<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 id="detailTitle">Detail Submission</h1>
            <button class="btn btn-secondary" onclick="window.history.back()">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <div class="card">
            <div class="card-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submissionId = new URLSearchParams(window.location.search).get('submissionId');

            if (!submissionId) {
                alert('Submission ID tidak ditemukan');
                window.history.back();
                return;
            }

            loadSubmissionDetail(submissionId);
        });

        function loadSubmissionDetail(submissionId) {
            fetch(`/api/submissions/${submissionId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('detailTitle').textContent =
                            `Detail Submission: ${data.data.assignment.title}`;

                        const detailContent = document.getElementById('detailContent');

                        detailContent.innerHTML = `
                            <div class="mb-4">
                                <h2>${data.data.assignment.title}</h2>
                                <p class="text-muted">${data.data.assignment.description}</p>
                                <hr>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h4>Informasi Mahasiswa</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Nama:</strong> ${data.data.student.name}</p>
                                            <p><strong>Email:</strong> ${data.data.student.email}</p>
                                            <p><strong>NIM:</strong> ${data.data.student.nim || '-'}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Detail Submission</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Dikumpulkan pada:</strong> ${data.data.submitted_at}</p>
                                            <p><strong>File:</strong>
                                                <a href="/api/submissions/${submissionId}/download" class="btn btn-sm btn-success ms-2">
                                                    <i class="bi bi-download"></i> Download File
                                                </a>
                                            </p>
                                            <p><strong>Dibuat pada:</strong> ${data.data.created_at}</p>
                                            <p><strong>Diperbarui pada:</strong> ${data.data.updated_at}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/assignments/${data.data.assignment.id}/submissions" class="btn btn-primary">
                                    <i class="bi bi-list-ul"></i> Lihat Semua Submission Tugas Ini
                                </a>
                            </div>
                        `;
                    } else {
                        alert(data.message);
                        window.history.back();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat detail submission');
                    window.history.back();
                });
        }
    </script>
</body>
</html>
