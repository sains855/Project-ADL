<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions Tugas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        #submissionChart {
            width: 100% !important;
            height: 100px !important;
        }
        .stat-card {
            background-color: #fff;
            border-left: 4px solid #4e73df;
        }
        .stat-card h3 {
            color: #4e73df;
        }
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(0,0,0,.1);
            border-radius: 50%;
            border-top-color: #4e73df;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Submission Tugas</h5>
                        <div class="d-flex">
                            <input type="text" id="searchInput" class="form-control mr-2" placeholder="Cari mahasiswa...">
                            <button id="searchBtn" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card stat-card">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Total Submission</h6>
                                        <h3 id="totalSubmissions" class="font-weight-bold">0</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card stat-card">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted">Statistik 7 Hari Terakhir</h6>
                                        <canvas id="submissionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Email</th>
                                        <th>Waktu Pengumpulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="submissionsTable">
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="loading-spinner mr-2"></div>
                                                <span>Memuat data...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk detail submission -->
    <div class="modal fade" id="submissionDetailModal" tabindex="-1" role="dialog" aria-labelledby="submissionDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionDetailModalLabel">Detail Submission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="submissionDetailContent">
                    <div class="d-flex justify-content-center py-4">
                        <div class="loading-spinner mr-2"></div>
                        <span>Memuat detail...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" id="downloadSubmissionBtn" class="btn btn-primary">
                        <i class="fas fa-download"></i> Download File
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        const assignmentId = new URLSearchParams(window.location.search).get('assignmentId') || {{ $assignmentId }};
        let submissionChart = null;
        let currentSubmissionId = null;

        // Load data awal
        loadSubmissions();
        loadSubmissionStats();

        // Fungsi untuk memuat data submission
        function loadSubmissions(searchTerm = '') {
            $('#submissionsTable').html(`
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="loading-spinner mr-2"></div>
                            <span>Memuat data...</span>
                        </div>
                    </td>
                </tr>
            `);

            let url = `/api/assignments/${assignmentId}/submissions`;
            if (searchTerm) {
                url += `/search?search=${encodeURIComponent(searchTerm)}`;
            }

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        renderSubmissionsTable(response.data.submissions || response.data);
                    } else {
                        showError(response.message);
                    }
                },
                error: function(xhr) {
                    showError(xhr.responseJSON?.message || 'Terjadi kesalahan saat memuat data');
                }
            });
        }

        // Fungsi untuk memuat statistik submission
        function loadSubmissionStats() {
            $.ajax({
                url: `/api/assignments/${assignmentId}/submissions/stats`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#totalSubmissions').text(response.data.total_submissions);
                        renderSubmissionChart(response.data.submissions_per_day);
                    }
                },
                error: function(xhr) {
                    console.error('Gagal memuat statistik:', xhr.responseJSON?.message);
                }
            });
        }

        // Fungsi untuk menampilkan data submission dalam tabel
        function renderSubmissionsTable(submissions) {
            const $tableBody = $('#submissionsTable');
            $tableBody.empty();

            if (submissions.length === 0) {
                $tableBody.append(`
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-inbox mr-2"></i> Tidak ada data submission
                        </td>
                    </tr>
                `);
                return;
            }

            submissions.forEach((submission, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${submission.student_name}</td>
                        <td>${submission.student_email}</td>
                        <td>${submission.submitted_at}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-detail" data-id="${submission.id}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-primary download-file" data-id="${submission.id}">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </td>
                    </tr>
                `;
                $tableBody.append(row);
            });
        }

        // Fungsi untuk menampilkan chart statistik submission
        function renderSubmissionChart(submissionsPerDay) {
            const ctx = document.getElementById('submissionChart').getContext('2d');

            // Format data untuk chart
            const labels = submissionsPerDay.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            }).reverse();

            const data = submissionsPerDay.map(item => item.count).reverse();

            if (submissionChart) {
                submissionChart.destroy();
            }

            submissionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Submission',
                        data: data,
                        backgroundColor: 'rgba(78, 115, 223, 0.5)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Fungsi untuk menampilkan detail submission
        function showSubmissionDetail(submissionId) {
            currentSubmissionId = submissionId;

            $('#submissionDetailContent').html(`
                <div class="d-flex justify-content-center py-4">
                    <div class="loading-spinner mr-2"></div>
                    <span>Memuat detail...</span>
                </div>
            `);

            $('#submissionDetailModal').modal('show');

            $.ajax({
                url: `/api/submissions/${submissionId}/detail`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const submission = response.data;
                        const detailContent = `
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">Informasi Mahasiswa</h6>
                                    <p><strong>Nama:</strong> ${submission.student.name}</p>
                                    <p><strong>Email:</strong> ${submission.student.email}</p>
                                    ${submission.student.nim ? `<p><strong>NIM:</strong> ${submission.student.nim}</p>` : ''}
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">Informasi Tugas</h6>
                                    <p><strong>Judul:</strong> ${submission.assignment.title}</p>
                                    <p><strong>Deskripsi:</strong> ${submission.assignment.description || '-'}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="text-muted mb-3">Detail Submission</h6>
                                    <p><strong>Waktu Pengumpulan:</strong> ${submission.submitted_at}</p>
                                    <p><strong>File:</strong>
                                        <a href="#" id="downloadFromModal" class="text-primary">
                                            <i class="fas fa-file-alt mr-1"></i>
                                            ${submission.file_url.split('/').pop()}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        `;

                        $('#submissionDetailContent').html(detailContent);
                    } else {
                        $('#submissionDetailContent').html(`
                            <div class="alert alert-danger">
                                ${response.message}
                            </div>
                        `);
                    }
                },
                error: function(xhr) {
                    $('#submissionDetailContent').html(`
                        <div class="alert alert-danger">
                            ${xhr.responseJSON?.message || 'Terjadi kesalahan saat memuat detail'}
                        </div>
                    `);
                }
            });
        }

        // Fungsi untuk menangani download file
        function downloadSubmission(submissionId) {
            window.location.href = `/submissions/${submissionId}/download`;
        }

        // Fungsi untuk menampilkan pesan error
        function showError(message) {
            const toast = `
                <div class="toast align-items-center text-white bg-danger border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            $(toast).appendTo('body').toast({ autohide: true, delay: 5000 }).toast('show');
        }

        // Event listener untuk pencarian
        $('#searchBtn').click(function() {
            const searchTerm = $('#searchInput').val();
            loadSubmissions(searchTerm);
        });

        $('#searchInput').keypress(function(e) {
            if (e.which === 13) {
                const searchTerm = $('#searchInput').val();
                loadSubmissions(searchTerm);
            }
        });

        // Event delegation untuk tombol detail dan download
        $(document).on('click', '.view-detail', function() {
            const submissionId = $(this).data('id');
            showSubmissionDetail(submissionId);
        });

        $(document).on('click', '.download-file', function() {
            const submissionId = $(this).data('id');
            downloadSubmission(submissionId);
        });

        // Event listener untuk tombol download di modal
        $('#downloadSubmissionBtn').click(function() {
            if (currentSubmissionId) {
                downloadSubmission(currentSubmissionId);
            }
        });

        // Event listener untuk link download di modal content
        $(document).on('click', '#downloadFromModal', function(e) {
            e.preventDefault();
            if (currentSubmissionId) {
                downloadSubmission(currentSubmissionId);
            }
        });
    });
    </script>
</body>
</html>
