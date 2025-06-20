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
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-header {
            background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 2px solid #e3f2fd;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 118, 210, 0.4);
        }

        .btn-secondary {
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            background-color: #757575;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #616161;
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
            color: #1976d2;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #0d47a1;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }

        .form-floating>label {
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $class->name) }}"
                                    placeholder="Nama Kelas" maxlength="255" required>
                                <label for="name">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    Nama Kelas
                                </label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi Kelas -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    placeholder="Deskripsi Kelas" style="height: 100px">{{ old('description', $class->description) }}</textarea>
                                <label for="description">
                                    <i class="fas fa-align-left me-2"></i>
                                    Deskripsi Kelas (Opsional)
                                </label>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pengajar/Guru -->
                            <div class="col-md-6 mb-3">
                                <input type="hidden" class="form-control" id="teacher_name"
                                    value="{{ auth()->user()->name }}" readonly>
                                <!-- Hidden input untuk teacher_id -->
                                <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}"
                                    id="teacher_id">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto focus pada field pertama
            document.getElementById('name').focus();
        });
    </script>
</body>

</html>
