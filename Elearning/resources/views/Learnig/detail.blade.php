<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelajaran - RPS PBP</title>
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
        }

        .content-list {
            list-style: none;
            padding-left: 0;
        }

        .content-list li {
            padding: 8px 0;
            color: #555;
            font-size: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .content-list li:last-child {
            border-bottom: none;
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            <h1>{{ $subject->name ?? 'RPS PBP' }}</h1>
            <div class="course-info">{{ $subject->description ?? 'Rencana Pembelajaran Semester - Pemrograman Berbasis Platform' }}</div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="openAddModuleModal()">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                </svg>
                Tambah Modul
            </button>
            <a href="#" class="btn btn-forum">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
                Forum Diskusi
            </a>
        </div>

        <div class="modules-section">
            <h2 class="section-title">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Modul Pembelajaran
            </h2>

            @forelse($modules as $module)
            <div class="module-card">
                <div class="module-header">
                    <div class="module-title">{{ $module->title }}</div>
                    <div class="module-actions">
                        <button class="btn btn-edit btn-small" onclick="editModule({{ $module->id }}, '{{ addslashes($module->title) }}', '{{ addslashes($module->content) }}')">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                            Edit
                        </button>
                        <form method="POST" action="/learning/module/{{ $module->id }}/delete" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini? Semua tugas dalam modul ini juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-small">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="module-content">
                    @if($module->content)
                        @php
                            $contentLines = explode("\n", $module->content);
                        @endphp
                        <ul class="content-list">
                            @foreach($contentLines as $line)
                                @if(trim($line))
                                <li>{{ trim($line) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="tasks-section">
                    <div class="tasks-header">
                        <div class="tasks-title">Tugas</div>
                        <button class="btn btn-secondary btn-small" onclick="openAddTaskModal({{ $module->id }})">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                            </svg>
                            Tambah Tugas
                        </button>
                    </div>

                    <div id="tasks-module-{{ $module->id }}">
                        @forelse($module->assignments as $assignment)
                        <div class="task-item">
                            <div class="task-info">
                                <div class="task-title">{{ $assignment->title }}</div>
                                <div class="task-meta">
                                    Deadline: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d F Y') }} |
                                    Status: {{ $assignment->status }}
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="btn btn-edit btn-small" onclick="editTask({{ $assignment->id }}, '{{ addslashes($assignment->title) }}', '{{ addslashes($assignment->description) }}', '{{ $assignment->due_date }}', '{{ $assignment->status }}')">
                                    <svg class="icon" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                    Edit
                                </button>
                                <form method="POST" action="/learning/assignment/{{ $assignment->id }}/delete" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-small">
                                        <svg class="icon" viewBox="0 0 24 24">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            Belum ada tugas untuk modul ini. Klik "Tambah Tugas" untuk menambahkan tugas baru.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                Belum ada modul pembelajaran. Klik "Tambah Modul" untuk menambahkan modul baru.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Tambah/Edit Modul -->
    <div id="moduleModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('moduleModal')">&times;</span>
            <h2 id="moduleModalTitle">Tambah Modul Baru</h2>
            <form id="moduleForm" method="POST" action="/learning/{{ $subject->id ?? 1 }}/module">
                @csrf
                <input type="hidden" id="moduleMethod" name="_method" value="POST">
                <div class="form-group">
                    <label for="moduleTitle">Judul Modul:</label>
                    <input type="text" id="moduleTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="moduleDescription">Deskripsi:</label>
                    <textarea id="moduleDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="moduleContent">Konten Pembelajaran:</label>
                    <textarea id="moduleContent" name="content" placeholder="Masukkan poin-poin pembelajaran (pisahkan dengan enter)" required></textarea>
                </div>
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeModal('moduleModal')" style="background: #ccc; color: #333;">Batal</button>
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
            <form id="taskForm" method="POST" action="/learning/{{ $subject->id ?? 1 }}/assignment">
                @csrf
                <input type="hidden" id="taskMethod" name="_method" value="POST">
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
                    <select id="taskStatus" name="status" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Draft">Draft</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeModal('taskModal')" style="background: #ccc; color: #333;">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let editingModuleId = null;
        let editingTaskId = null;

        // Set CSRF token for all AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Modal functions
        function openAddModuleModal() {
            editingModuleId = null;
            document.getElementById('moduleModalTitle').textContent = 'Tambah Modul Baru';
            document.getElementById('moduleForm').reset();
            document.getElementById('moduleForm').action = `/learning/{{ $subject->id ?? 1 }}/module`;
            document.getElementById('moduleMethod').value = 'POST';
            document.getElementById('moduleModal').style.display = 'block';
        }

        function openAddTaskModal(moduleId) {
            editingTaskId = null;
            document.getElementById('taskModalTitle').textContent = 'Tambah Tugas Baru';
            document.getElementById('taskModuleId').value = moduleId;
            document.getElementById('taskForm').reset();
            document.getElementById('taskModuleId').value = moduleId;
            document.getElementById('taskForm').action = `/learning/{{ $subject->id ?? 1 }}/assignment`;
            document.getElementById('taskMethod').value = 'POST';
            document.getElementById('taskModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function editModule(moduleId, title, content) {
            editingModuleId = moduleId;
            document.getElementById('moduleModalTitle').textContent = 'Edit Modul';
            document.getElementById('moduleTitle').value = title;
            document.getElementById('moduleContent').value = content;
            document.getElementById('moduleForm').action = `/learning/module/${moduleId}/update`;
            document.getElementById('moduleMethod').value = 'PUT';
            document.getElementById('moduleModal').style.display = 'block';
        }

        function editTask(taskId, title, description, dueDate, status) {
            editingTaskId = taskId;
            document.getElementById('taskModalTitle').textContent = 'Edit Tugas';
            document.getElementById('taskTitle').value = title;
            document.getElementById('taskDescription').value = description;
            document.getElementById('taskDeadline').value = dueDate;
            document.getElementById('taskStatus').value = status;
            document.getElementById('taskForm').action = `/learning/assignment/${taskId}/update`;
            document.getElementById('taskMethod').value = 'PUT';
            document.getElementById('taskModal').style.display = 'block';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const moduleModal = document.getElementById('moduleModal');
            const taskModal = document.getElementById('taskModal');

            if (event.target === moduleModal) {
                closeModal('moduleModal');
            }
            if (event.target === taskModal) {
                closeModal('taskModal');
            }
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('moduleModal');
                closeModal('taskModal');
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>
