<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelajaran - {{ $class->name ?? 'RPS PBP' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header .course-info {
            color: #666;
            font-size: 1.1rem;
        }

        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: white;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(17, 153, 142, 0.6);
        }

        .btn-forum {
            background: linear-gradient(135deg, #fa709a, #fee140);
            color: white;
            box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
        }

        .btn-forum:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(250, 112, 154, 0.6);
        }

        .modules-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-title {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-content {
            max-height: 80vh;
            /* Membatasi tinggi maksimal modal */
            overflow-y: auto;
            /* Menambahkan scroll vertikal ketika konten melebihi tinggi */
            padding-right: 15px;
            /* Memberi ruang untuk scrollbar agar tidak menimpa konten */
        }

        /* Style untuk scrollbar di modal */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 10px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #5a67d8;
        }

        .module-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .module-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .module-title {
            font-size: 1.4rem;
            color: #333;
            font-weight: 700;
            flex: 1;
        }

        .module-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            color: #8B4513;
            border: none;
        }

        .btn-delete {
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            color: #DC143C;
            border: none;
        }

        .module-content {
            margin-bottom: 20px;
            color: #555;
            line-height: 1.6;
        }

        .file-download {
            background: rgba(102, 126, 234, 0.1);
            border: 2px dashed rgba(102, 126, 234, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .file-download:hover {
            background: rgba(102, 126, 234, 0.15);
            border-color: rgba(102, 126, 234, 0.5);
        }

        .file-download a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-download a:hover {
            color: #5a67d8;
        }

        .tasks-section {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid rgba(102, 126, 234, 0.2);
        }

        .tasks-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .tasks-title {
            font-size: 1.3rem;
            color: #333;
            font-weight: 600;
        }

        .task-item {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .task-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        .task-info {
            flex: 1;
        }

        .task-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .task-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .task-actions {
            display: flex;
            gap: 8px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-aktif {
            background: #d4edda;
            color: #155724;
        }

        .status-draft {
            background: #fff3cd;
            color: #856404;
        }

        .status-selesai {
            background: #cce5ff;
            color: #004085;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background: #f9f9f9;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .file-upload-area.dragover {
            border-color: #667eea;
            background: #e8f2ff;
        }

        .file-upload-input {
            display: none;
        }

        .file-upload-text {
            color: #666;
            margin-bottom: 10px;
        }

        .file-upload-button {
            background: #667eea;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .selected-file {
            margin-top: 10px;
            padding: 10px;
            background: #e8f5e8;
            border-radius: 4px;
            color: #2d5a2d;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
            font-style: italic;
        }

        .icon {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .module-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .tasks-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .task-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .task-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>

<body>
<div class="container">
        <div class="header">
            <h1>{{ $class->name ?? 'RPS PBP' }}</h1>
            <div class="course-info">
                {{ $class->description ?? 'Rencana Pembelajaran Semester - Pemrograman Berbasis Platform' }}</div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="openAddModuleModal()">
                <svg class="icon" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" />
                </svg>
                Tambah Modul
            </button>
            <a href="#" class="btn btn-forum">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                </svg>
                Forum Diskusi
            </a>
        </div>

        <div class="modules-section">
            <h2 class="section-title">
                <svg class="icon" viewBox="0 0 24 24">
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
                Modul Pembelajaran
            </h2>

            @if ($modules->count() > 0)
                @foreach ($modules as $module)
                    <div class="module-card">
                        <div class="module-header">
                            <div class="module-title">{{ $module->title }}</div>
                            @if($module->created_by === Auth::user()->id)
                            <div class="module-actions">
                                <button class="btn btn-edit btn-small"
                                    onclick="editModule({{ $module->id }}, '{{ $module->title }}', '{{ addslashes($module->content) }}', '{{ $module->file_path ?? '' }}')">
                                    <svg class="icon" viewBox="0 0 24 24">
                                        <path
                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                    </svg>
                                    Edit
                                </button>
                                <button class="btn btn-delete btn-small" onclick="deleteModule({{ $module->id }})">
                                    <svg class="icon" viewBox="0 0 24 24">
                                        <path
                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                            @endif
                        </div>

                        <div class="module-content">
                            {!! nl2br(e($module->content)) !!}

                            @if ($module->file_path)
                                <div class="file-download">
                                    <svg class="icon" viewBox="0 0 24 24" style="color: #667eea;">
                                        <path
                                            d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                    </svg>
                                    <a href="{{ asset('storage/' . $module->file_path) }}" target="_blank">
                                        <svg class="icon" viewBox="0 0 24 24">
                                            <path d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z" />
                                        </svg>
                                        Download Materi: {{ basename($module->file_path) }}
                                    </a>
                                    @if($module->created_by === Auth::user()->id)
                                        <button onclick="removeModuleFile({{ $module->id }})" class="btn btn-small" style="background: #ff6b6b; color: white; margin-left: 10px;">
                                            Hapus File
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="tasks-section">
                            <div class="tasks-header">
                                <div class="tasks-title">Tugas</div>
                                <button class="btn btn-secondary btn-small"
                                    onclick="openAddTaskModal({{ $module->id }})">
                                    <svg class="icon" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" />
                                    </svg>
                                    Tambah Tugas
                                </button>
                            </div>

                            <div id="tasks-module-{{ $module->id }}">
                                @if ($module->assignments->count() > 0)
                                    @foreach ($module->assignments as $assignment)
                                        <div class="task-item">
                                            <div class="task-info">
                                                <div class="task-title">{{ $assignment->title }}</div>
                                                <div class="task-meta">
                                                    Deadline:
                                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}
                                                    |
                                                    <span
                                                        class="status-badge status-{{ strtolower($assignment->status ?? 'aktif') }}">{{ $assignment->status ?? 'Aktif' }}</span>
                                                </div>
                                                <div style="margin-top: 8px; color: #666; font-size: 0.9rem;">
                                                    {{ Str::limit($assignment->description, 150) }}
                                                </div>
                                            </div>
                                            <div class="task-actions">
                                                <button class="btn btn-edit btn-small"
                                                    onclick="editTask({{ $assignment->id }}, '{{ $assignment->title }}', '{{ addslashes($assignment->description) }}', '{{ $assignment->due_date }}', '{{ $assignment->status ?? 'Aktif' }}')">
                                                    <svg class="icon" viewBox="0 0 24 24">
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                                <button class="btn btn-delete btn-small"
                                                    onclick="deleteTask({{ $assignment->id }})">
                                                    <svg class="icon" viewBox="0 0 24 24">
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="empty-state">
                                        Belum ada tugas untuk modul ini. Klik "Tambah Tugas" untuk menambahkan tugas
                                        baru.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h3>Belum ada modul pembelajaran</h3>
                    <p>Klik "Tambah Modul" untuk menambahkan modul pembelajaran pertama.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah/Edit Modul -->
    <div id="moduleModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('moduleModal')">&times;</span>
            <h2 id="moduleModalTitle">Tambah Modul Baru</h2>
            <form id="moduleForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="moduleMethod" value="POST">
                <div class="form-group">
                    <label for="moduleTitle">Judul Modul:</label>
                    <input type="text" id="moduleTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="moduleContent">Konten Pembelajaran:</label>
                    <textarea id="moduleContent" name="content" placeholder="Masukkan konten pembelajaran" required></textarea>
                </div>
                <div class="form-group">
                    <label for="moduleFile">File Materi (Opsional):</label>
                    <div class="file-upload-area" onclick="document.getElementById('moduleFile').click()">
                        <input type="file" id="moduleFile" name="file" class="file-upload-input"
                            accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.mp4,.mp3,.zip,.rar">
                        <div class="file-upload-text">
                            <svg class="icon" viewBox="0 0 24 24"
                                style="width: 48px; height: 48px; color: #ccc; margin-bottom: 10px;">
                                <path
                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                            <p>Klik untuk memilih file atau drag & drop</p>
                            <p style="font-size: 0.8rem; color: #999; margin-top: 5px;">Mendukung: PDF, DOC, PPT, XLS,
                                gambar, video, audio, ZIP (Max: 10MB)</p>
                        </div>
                        <button type="button" class="file-upload-button">Pilih File</button>
                        <div id="selectedFile" class="selected-file" style="display: none;"></div>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeModal('moduleModal')"
                        style="background: #ccc; color: #333;">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah/Edit Tugas -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('taskModal')">&times;</span>
            <h2 id="taskModalTitle">Tambah Tugas Baru</h2>
            <form id="taskForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="taskMethod" value="POST">
                <input type="hidden" id="taskModuleId" name="module_id">
                <div class="form-group">
                    <label for="taskTitle">Judul Tugas:</label>
                    <input type="text" id="taskTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Deskripsi Tugas:</label>
                    <textarea id="taskDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="taskDeadline">Deadline:</label>
                    <input type="date" id="taskDeadline" name="due_date" required>
                </div>
                <div class="form-group">
                    <label for="taskStatus">Status:</label>
                    <select id="taskStatus" name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Draft">Draft</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeModal('taskModal')"
                        style="background: #ccc; color: #333;">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let editingModuleId = null;
        let editingTaskId = null;
        const classId = {{ $class->id ?? 1 }};

        // Setup CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // File upload handling
        const fileInput = document.getElementById('moduleFile');
        const fileUploadArea = document.querySelector('.file-upload-area');
        const selectedFileDiv = document.getElementById('selectedFile');

        fileInput.addEventListener('change', function(e) {
            handleFileSelection(e.target.files[0]);
        });

        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelection(files[0]);
            }
        });

        function handleFileSelection(file) {
            if (file) {
                const maxSize = 10 * 1024 * 1024; // 10MB
                if (file.size > maxSize) {
                    alert('File terlalu besar! Maksimal ukuran file adalah 10MB.');
                    fileInput.value = '';
                    selectedFileDiv.style.display = 'none';
                    return;
                }

                const allowedTypes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'image/gif',
                    'video/mp4',
                    'audio/mp3',
                    'audio/mpeg',
                    'application/zip',
                    'application/x-rar-compressed'
                ];

                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file tidak diizinkan! Silakan pilih file dengan format yang didukung.');
                    fileInput.value = '';
                    selectedFileDiv.style.display = 'none';
                    return;
                }

                selectedFileDiv.innerHTML = `
            <strong>File dipilih:</strong> ${file.name} (${formatFileSize(file.size)})
            <button type="button" onclick="clearFileSelection()" style="margin-left: 10px; background: #ff6b6b; color: white; border: none; padding: 2px 8px; border-radius: 3px; cursor: pointer;">×</button>
        `;
                selectedFileDiv.style.display = 'block';
            }
        }

        function clearFileSelection() {
            fileInput.value = '';
            selectedFileDiv.style.display = 'none';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Modal functions
        function openAddModuleModal() {
            editingModuleId = null;
            document.getElementById('moduleModalTitle').textContent = 'Tambah Modul Baru';
            document.getElementById('moduleForm').action = `/learning/${classId}/modules`;
            document.getElementById('moduleMethod').value = 'POST';

            // Reset form
            document.getElementById('moduleTitle').value = '';
            document.getElementById('moduleContent').value = '';
            document.getElementById('moduleFile').value = '';
            selectedFileDiv.style.display = 'none';

            document.getElementById('moduleModal').style.display = 'block';
        }

        function editModule(id, title, content, filePath) {
            editingModuleId = id;
            document.getElementById('moduleModalTitle').textContent = 'Edit Modul';
            document.getElementById('moduleForm').action = `/learning/modules/${id}`;
            document.getElementById('moduleMethod').value = 'PUT';

            // Fill form with existing data
            document.getElementById('moduleTitle').value = title;
            document.getElementById('moduleContent').value = content.replace(/\\n/g, '\n').replace(/\\'/g, "'").replace(
                /\\"/g, '"');

            if (filePath) {
                selectedFileDiv.innerHTML = `
            <strong>File saat ini:</strong> ${filePath.split('/').pop()}
            <button type="button" onclick="clearFileSelection()" style="margin-left: 10px; background: #ff6b6b; color: white; border: none; padding: 2px 8px; border-radius: 3px; cursor: pointer;">×</button>
        `;
                selectedFileDiv.style.display = 'block';
            } else {
                selectedFileDiv.style.display = 'none';
            }

            document.getElementById('moduleModal').style.display = 'block';
        }

        function deleteModule(id) {
            if (confirm('Apakah Anda yakin ingin menghapus modul ini? Semua tugas terkait juga akan dihapus.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/learning/modules/${id}`;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function removeModuleFile(id) {
            if (confirm('Apakah Anda yakin ingin menghapus file dari modul ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/learning/modules/${id}/remove-file`;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function openAddTaskModal(moduleId) {
            editingTaskId = null;
            document.getElementById('taskModalTitle').textContent = 'Tambah Tugas Baru';
            document.getElementById('taskForm').action = `/learning/${classId}/assignments`;
            document.getElementById('taskMethod').value = 'POST';
            document.getElementById('taskModuleId').value = moduleId;

            // Reset form
            document.getElementById('taskTitle').value = '';
            document.getElementById('taskDescription').value = '';
            document.getElementById('taskDeadline').value = '';
            document.getElementById('taskStatus').value = 'Aktif';

            document.getElementById('taskModal').style.display = 'block';
        }

        function editTask(id, title, description, dueDate, status) {
            editingTaskId = id;
            document.getElementById('taskModalTitle').textContent = 'Edit Tugas';
            document.getElementById('taskForm').action = `/learning/assignments/${id}`;
            document.getElementById('taskMethod').value = 'PUT';

            // Fill form with existing data
            document.getElementById('taskTitle').value = title;
            document.getElementById('taskDescription').value = description.replace(/\\n/g, '\n').replace(/\\'/g, "'")
                .replace(/\\"/g, '"');
            document.getElementById('taskDeadline').value = dueDate;
            document.getElementById('taskStatus').value = status;

            document.getElementById('taskModal').style.display = 'block';
        }

        function deleteTask(id) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/learning/assignments/${id}`;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const moduleModal = document.getElementById('moduleModal');
            const taskModal = document.getElementById('taskModal');

            if (event.target === moduleModal) {
                moduleModal.style.display = 'none';
            }
            if (event.target === taskModal) {
                taskModal.style.display = 'none';
            }
        }

        // Form submission handling
        document.getElementById('moduleForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            // Re-enable button after 3 seconds to prevent permanent disable on error
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'Simpan';
            }, 3000);
        });

        document.getElementById('taskForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';

            // Re-enable button after 3 seconds to prevent permanent disable on error
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'Simpan';
            }, 3000);
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape key to close modals
            if (e.key === 'Escape') {
                const moduleModal = document.getElementById('moduleModal');
                const taskModal = document.getElementById('taskModal');

                if (moduleModal.style.display === 'block') {
                    closeModal('moduleModal');
                }
                if (taskModal.style.display === 'block') {
                    closeModal('taskModal');
                }
            }

            // Ctrl+M to open add module modal
            if (e.ctrlKey && e.key === 'm') {
                e.preventDefault();
                openAddModuleModal();
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });

        // Set minimum date for task deadline to today
        document.addEventListener('DOMContentLoaded', function() {
            const deadlineInput = document.getElementById('taskDeadline');
            if (deadlineInput) {
                const today = new Date().toISOString().split('T')[0];
                deadlineInput.setAttribute('min', today);
            }
        });
    </script>
</body>
</html>
