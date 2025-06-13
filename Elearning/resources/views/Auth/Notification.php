<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Learning Desktop - Sistem Notifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        .notification-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .slide-animation {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .modal-enter {
            animation: modalEnter 0.3s ease-out;
        }
        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-50px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .gradient-text {
            background: linear-gradient(45deg, #3B82F6, #8B5CF6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-purple-900 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-white rounded-full p-4 mr-4 shadow-lg">
                    <span class="text-4xl">🎓</span>
                </div>
                <h1 class="text-5xl font-bold text-white gradient-text">E-Learning Desktop</h1>
            </div>
            <p class="text-xl text-blue-200">Sistem Notifikasi Interaktif untuk Pembelajaran Online</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Notification Center -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-2xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <span class="text-3xl mr-3">🔔</span>
                        <h2 class="text-3xl font-bold text-gray-800">Pusat Notifikasi E-Learning</h2>
                    </div>
                    <button onclick="markAllAsRead()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        Tandai Semua Dibaca
                    </button>
                </div>
                
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Sistem notifikasi yang dirancang khusus untuk aplikasi e-learning desktop dengan antarmuka yang 
                    modern dan interaktif. Setiap notifikasi dilengkapi dengan animasi yang halus dan tombol aksi yang 
                    memudahkan interaksi pengguna.
                </p>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Fitur Utama:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-gray-700">
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Notifikasi real-time dengan animasi slide
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Kategorisasi berdasarkan jenis aktivitas
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Tombol aksi cepat untuk respons langsung
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Desain responsif untuk berbagai ukuran layar
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Tema navy blue dan putih yang profesional
                        </div>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                            Sistem prioritas untuk notifikasi penting
                        </div>
                    </div>
                </div>

            <!-- Demo Notifications -->
            <div class="bg-white rounded-3xl shadow-2xl p-6">
                <div class="flex items-center mb-6">
                    <span class="text-2xl mr-2">▶️</span>
                    <h3 class="text-2xl font-bold text-gray-800">Demo Notifikasi</h3>
                </div>

                <div class="space-y-4" id="notification-container">
                    @foreach($notifications as $key => $notification)
                    <div class="notification-card bg-gradient-to-r from-blue-50 to-white border border-blue-200 rounded-xl p-4 slide-animation hover:shadow-lg"
                         onclick="showNotificationDetails('{{ $key }}')">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-800 flex items-center">
                                <span class="mr-2 text-lg">{{ $notification['icon'] }}</span>
                                {{ $notification['title'] }}
                            </h4>
                            @if($notification['count'] > 0)
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full pulse-animation min-w-[20px] text-center">
                                {{ $notification['count'] }}
                            </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600">{{ $notification['description'] }}</p>
                        <div class="mt-2 flex justify-between items-center">
                            <span class="text-xs text-gray-400">Klik untuk detail</span>
                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">
                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Refresh Button -->
                <div class="mt-6 text-center">
                    <button onclick="refreshNotifications()" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all transform hover:scale-105">
                        🔄 Refresh Notifikasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Notification Details -->
    <div id="notification-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[80vh] overflow-y-auto modal-enter">
                <div class="sticky top-0 bg-white border-b p-6 rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-bold text-gray-800" id="modal-title">Detail Notifikasi</h3>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                </div>
                
                <div class="p-6">
                    <div id="modal-content" class="space-y-4">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
                
                <div class="sticky bottom-0 bg-gray-50 p-6 rounded-b-2xl border-t">
                    <div class="flex justify-end space-x-3">
                        <button onclick="closeModal()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                            Tutup
                        </button>
                        <button onclick="markAllInModalAsRead()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Tandai Semua Dibaca
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <span class="mr-2">✅</span>
            <span id="toast-message">Berhasil!</span>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                <span class="text-gray-700">Memuat...</span>
            </div>
        </div>
    </div>

    <script>
        // Setup CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        function showNotificationDetails(type) {
            const modal = document.getElementById('notification-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalContent = document.getElementById('modal-content');
            const loadingOverlay = document.getElementById('loading-overlay');
            
            // Show loading
            loadingOverlay.classList.remove('hidden');
            modalContent.innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div><p class="mt-4 text-gray-600">Memuat notifikasi...</p></div>';
            modal.classList.remove('hidden');
            
            // Fetch notifications by type
            fetch(`/notifications/${type}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                loadingOverlay.classList.add('hidden');
                
                if (data.success) {
                    const notifications = data.data;
                    modalTitle.textContent = `Detail ${type.replace('_', ' ').toUpperCase()} (${data.total} item)`;
                    
                    let content = '';
                    if (notifications.length > 0) {
                        notifications.forEach(notification => {
                            const readStatus = notification.read ? 'bg-gray-50 border-gray-200' : 'bg-blue-50 border-blue-200';
                            const readIcon = notification.read ? '✅' : '🔴';
                            const priorityBadge = notification.priority ? `<span class="text-xs px-2 py-1 rounded-full ${getPriorityColor(notification.priority)}">${getPriorityText(notification.priority)}</span>` : '';
                            
                            content += `
                                <div class="${readStatus} p-4 rounded-xl border-2 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-gray-800 flex-1">${notification.title}</h4>
                                        <div class="flex items-center space-x-2 ml-3">
                                            ${priorityBadge}
                                            <span class="text-lg">${readIcon}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-3">${notification.message}</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>⏰ ${notification.time}</span>
                                        ${notification.subject ? `<span class="bg-gray-200 px-2 py-1 rounded">${notification.subject}</span>` : ''}
                                    </div>
                                    ${notification.deadline ? `<div class="mt-2 text-sm text-red-600">📅 Deadline: ${formatDate(notification.deadline)}</div>` : ''}
                                    ${notification.score ? `<div class="mt-2 text-sm text-green-600">📊 Nilai: ${notification.score} (${notification.grade})</div>` : ''}
                                    <div class="mt-3 flex space-x-2">
                                        ${!notification.read ? `<button onclick="markAsRead(${notification.id})" class="text-xs bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition-colors">Tandai Dibaca</button>` : ''}
                                        <button onclick="deleteNotification(${notification.id})" class="text-xs bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors">Hapus</button>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        content = '<div class="text-center py-8 text-gray-500"><span class="text-4xl mb-4 block">📭</span><p>Tidak ada notifikasi</p></div>';
                    }
                    
                    modalContent.innerHTML = content;
                } else {
                    modalContent.innerHTML = '<div class="text-center py-8 text-red-500"><span class="text-4xl mb-4 block">❌</span><p>Gagal memuat notifikasi</p></div>';
                }
            })
            .catch(error => {
                loadingOverlay.classList.add('hidden');
                console.error('Error:', error);
                modalContent.innerHTML = '<div class="text-center py-8 text-red-500"><span class="text-4xl mb-4 block">❌</span><p>Terjadi kesalahan saat memuat notifikasi</p></div>';
            });
        }
        
        function closeModal() {
            document.getElementById('notification-modal').classList.add('hidden');
        }
        
        function markAsRead(id) {
            fetch(`/notifications/mark-read/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Notifikasi ditandai sebagai dibaca', 'success');
                    // Refresh the current modal if open
                    const modal = document.getElementById('notification-modal');
                    if (!modal.classList.contains('hidden')) {
                        // Reload modal content
                        location.reload();
                    }
                } else {
                    showToast('Gagal menandai notifikasi', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan', 'error');
            });
        }
        
        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Semua notifikasi ditandai sebagai dibaca', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast('Gagal menandai semua notifikasi', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan', 'error');
            });
        }
        
        function markAllInModalAsRead() {
            markAllAsRead();
        }
        
        function deleteNotification(id) {
            if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
                fetch(`/notifications/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Notifikasi berhasil dihapus', 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showToast('Gagal menghapus notifikasi', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan', 'error');
                });
            }
        }
        
        function refreshNotifications() {
            showToast('Memperbarui notifikasi...', 'info');
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
        
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            // Set colors based on type
            toast.className = 'fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 z-50';
            
            if (type === 'success') {
                toast.classList.add('bg-green-500', 'text-white');
                toastMessage.innerHTML = `<span class="mr-2">✅</span>${message}`;
            } else if (type === 'error') {
                toast.classList.add('bg-red-500', 'text-white');
                toastMessage.innerHTML = `<span class="mr-2">❌</span>${message}`;
            } else if (type === 'info') {
                toast.classList.add('bg-blue-500', 'text-white');
                toastMessage.innerHTML = `<span class="mr-2">ℹ️</span>${message}`;
            }
            
            // Show toast
            toast.classList.remove('translate-x-full');
            
            // Hide after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 3000);
        }
        
        function getPriorityColor(priority) {
            switch(priority) {
                case 'high': return 'bg-red-100 text-red-800';
                case 'medium': return 'bg-yellow-100 text-yellow-800';
                case 'low': return 'bg-green-100 text-green-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }
        
        function getPriorityText(priority) {
            switch(priority) {
                case 'high': return 'Tinggi';
                case 'medium': return 'Sedang';
                case 'low': return 'Rendah';
                default: return 'Normal';
            }
        }
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        
        // Auto-refresh notifications every 5 minutes
        setInterval(() => {
            const container = document.getElementById('notification-container');
            const cards = container.querySelectorAll('.notification-card');
            cards.forEach(card => {
                card.classList.add('pulse-animation');
                setTimeout(() => {
                    card.classList.remove('pulse-animation');
                }, 2000);
            });
        }, 300000); // 5 minutes
        
        // Close modal when clicking outside
        document.getElementById('notification-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ESC to close modal
            if (e.key === 'Escape') {
                closeModal();
            }
            // Ctrl+R to refresh
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                refreshNotifications();
            }
        });
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add entrance animation to notification cards
            const cards = document.querySelectorAll('.notification-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('slide-animation');
                }, index * 100);
            });
        });
    </script>
</body>
</html>