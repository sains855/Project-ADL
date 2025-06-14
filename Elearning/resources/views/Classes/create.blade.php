<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Baru</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .container {
            max-width: 800px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #764ba2;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .form-control[readonly] {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dosen"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kelas</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Kelas Baru
                </h4>
            </div>
            <div class="card-body p-4">
                <!-- Alert untuk error -->
                <div id="errorAlert" class="alert alert-danger d-none">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="errorMessage"></span>
                </div>

                <form id="createClassForm" action="/classes" method="POST">
                    <!-- CSRF Token (Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <!-- Nama Kelas -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                Nama Kelas <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Contoh: X IPA 1, XI IPS 2" maxlength="50" required>
                            <div class="invalid-feedback">
                                Nama kelas wajib diisi (maksimal 50 karakter)
                            </div>
                        </div>

                        <!-- Guru Pengajar -->
                        <div class="col-md-6 mb-3">
                            <label for="teacher_name" class="form-label">
                                Guru Pengajar
                            </label>
                            <input type="text" class="form-control" id="teacher_name"
                                value="{{ auth()->user()->name }}" readonly>
                            <!-- Hidden input untuk teacher_id -->
                            <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}" id="teacher_id">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Otomatis terisi sesuai akun yang login
                            </small>
                        </div>
                    </div>

                    <!-- Hari -->
                    <div class="col-md-4 mb-3">
                        <label for="hari" class="form-label">
                            Hari <span class="required">*</span>
                        </label>
                        <select class="form-select" id="hari" name="hari" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        <div class="invalid-feedback">
                            Pilih hari
                        </div>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="col-md-4 mb-3">
                        <label for="jam_mulai" class="form-label">
                            Jam Mulai <span class="required">*</span>
                        </label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                        <div class="invalid-feedback">
                            Jam mulai wajib diisi
                        </div>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="col-md-4 mb-3">
                        <label for="jam_selesai" class="form-label">
                            Jam Selesai <span class="required">*</span>
                        </label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                        <div class="invalid-feedback">
                            Jam selesai harus lebih besar dari jam mulai
                        </div>
                    </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong>
                <ul class="mb-0 mt-2">
                    <li>Semua field yang bertanda <span class="required">*</span> wajib diisi</li>
                    <li>Nama kelas maksimal 50 karakter</li>
                    <li>Jam selesai harus lebih besar dari jam mulai</li>
                    <li>Guru pengajar otomatis terisi sesuai akun yang sedang login</li>
                </ul>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between pt-3">
                <a href="/classes" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
                <div>
                    <button type="reset" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-undo me-2"></i>
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Simpan Kelas
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Validasi form
document.getElementById('createClassForm').addEventListener('submit', function(e) {
    const form = this;
    const jamMulai = document.getElementById('jam_mulai').value;
    const jamSelesai = document.getElementById('jam_selesai').value;

    form.classList.remove('was-validated');
    document.getElementById('errorAlert').classList.add('d-none');

    if (jamMulai && jamSelesai && jamSelesai <= jamMulai) {
        e.preventDefault();
        showError('Jam selesai harus lebih besar dari jam mulai');
        document.getElementById('jam_selesai').classList.add('is-invalid');
        return;
    }

    // Lolos validasi, form akan disubmit ke Laravel
    // Tidak perlu e.preventDefault()
});

        // Fungsi untuk menampilkan error
        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorAlert').classList.remove('d-none');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Fungsi simulasi berhasil (untuk demo)
        function showSuccess() {
            alert('Kelas berhasil ditambahkan! (Demo)');
            // Dalam implementasi nyata, form akan di-submit ke Laravel
            // document.getElementById('createClassForm').submit();
        }

        // Auto-hide error saat input berubah
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                if (!document.querySelector('.is-invalid')) {
                    document.getElementById('errorAlert').classList.add('d-none');
                }
            });
        });

        // Reset form
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            document.getElementById('createClassForm').classList.remove('was-validated');
            document.getElementById('errorAlert').classList.add('d-none');
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
        });
    </script>
</body>

</html>
