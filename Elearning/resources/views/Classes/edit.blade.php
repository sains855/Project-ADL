<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas - {{ $class->name }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e3f2fd;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 30px;
        }

        .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #764ba2;
        }

        .time-input-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .time-separator {
            font-weight: bold;
            color: #667eea;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating > .form-control,
        .form-floating > .form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .form-floating > label {
            padding: 1rem 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dosen.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dosen.dashboard') }}">Kelola Kelas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Kelas</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Kelas: {{ $class->name }}
                        </h4>
                        <small class="opacity-75">Perbarui informasi kelas</small>
                    </div>

                    <div class="card-body p-4">
                        <!-- Alert untuk menampilkan pesan error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Oops! Ada kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form Edit Kelas -->
                        <form action="{{ route('classes.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Kelas -->
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $class->name) }}"
                                       placeholder="Nama Kelas"
                                       maxlength="50"
                                       required>
                                <label for="name">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    Nama Kelas
                                </label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hari -->
                            <div class="form-floating mb-3">
                                <select class="form-select @error('hari') is-invalid @enderror"
                                        id="hari"
                                        name="hari"
                                        required>
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                        <option value="{{ $day }}"
                                                {{ old('hari', $class->hari) == $day ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="hari">
                                    <i class="fas fa-calendar-day me-2"></i>
                                    Hari
                                </label>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Waktu Kelas -->
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <input type="time"
                                               class="form-control @error('jam_mulai') is-invalid @enderror"
                                               id="jam_mulai"
                                               name="jam_mulai"
                                               value="{{ old('jam_mulai',  \Carbon\Carbon::createFromFormat('H:i:s', $class->jam_mulai)->format('H:i')) }}"
                                               required>
                                        <label for="jam_mulai">
                                            <i class="fas fa-clock me-2"></i>
                                            Jam Mulai
                                        </label>
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <span class="time-separator fs-4">-</span>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <input type="time"
                                               class="form-control @error('jam_selesai') is-invalid @enderror"
                                               id="jam_selesai"
                                               name="jam_selesai"
                                               value="{{ old('jam_selesai',  \Carbon\Carbon::createFromFormat('H:i:s', $class->jam_selesai)->format('H:i')) }}"
                                               required>
                                        <label for="jam_selesai">
                                            <i class="fas fa-clock me-2"></i>
                                            Jam Selesai
                                        </label>
                                        @error('jam_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Info Guru -->
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Pengajar:</strong> {{ Auth::user()->name }}
                                <small class="d-block mt-1">
                                    Guru yang mengajar kelas ini akan otomatis diatur sesuai dengan akun yang sedang login.
                                </small>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-3 justify-content-end mt-4">
                                <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Validasi Waktu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');

            function validateTime() {
                if (jamMulai.value && jamSelesai.value) {
                    if (jamSelesai.value <= jamMulai.value) {
                        jamSelesai.setCustomValidity('Jam selesai harus lebih besar dari jam mulai');
                    } else {
                        jamSelesai.setCustomValidity('');
                    }
                }
            }

            jamMulai.addEventListener('change', validateTime);
            jamSelesai.addEventListener('change', validateTime);

            // Auto focus pada field pertama
            document.getElementById('name').focus();
        });
    </script>
</body>
</html>
