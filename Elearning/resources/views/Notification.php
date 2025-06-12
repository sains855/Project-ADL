<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Desktop - Sistem Notifikasi</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }
        
        .main-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
        }
        
        .notification-center {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .notification-center h2 {
            color: #4a5568;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .features {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .features h3 {
            color: #2d3748;
            margin-bottom: 15px;
        }
        
        .features ul {
            list-style: none;
            color: #4a5568;
        }
        
        .features li {
            padding: 5px 0;
            padding-left: 20px;
            position: relative;
        }
        
        .features li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
        }
        
        .demo-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .demo-panel h3 {
            color: #4a5568;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .notification-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
            border-left: 4px solid;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        
        .notification-card.tugas_baru {
            border-left-color: #48bb78;
        }
        
        .notification-card.pesan_masuk {
            border-left-color: #4299e1;
        }
        
        .notification-card.nilai_tersedia {
            border-left-color: #ed8936;
        }
        
        .notification-card.pengingat_kelas {
            border-left-color: #9f7aea;
        }
        
        .notification-card h4 {
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        
        .notification-card p {
            color: #718096;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .notification-card small {
            color: #a0aec0;
            font-size: 0.8rem;
        }
        
        .category-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .category-btn {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .category-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        .category-btn h4 {
            color: #2d3748;
            margin-bottom: 5px;
        }
        
        .category-btn p {
            color: #718096;
            font-size: 0.85rem;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .notification-icon {
            width: 24px;
            height: 24px;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .category-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <span class="notification-icon">🎓</span>
                E-Learning Desktop
            </h1>
            <p>Sistem Notifikasi Interaktif untuk Pembelajaran Online</p>
        </div>
        
        <div class="main-content">
            <div class="notification-center">
                <h2>
                    <span class="notification-icon">🔔</span>
                    Pusat Notifikasi E-Learning
                </h2>
                
                <p style="color: #718096; margin-bottom: 20px;">
                    Sistem notifikasi yang dirancang khusus untuk aplikasi e-learning desktop dengan antarmuka yang 
                    modern dan interaktif. Setiap notifikasi dilengkapi dengan animasi yang halus dan tombol aksi yang 
                    memudahkan interaksi pengguna.
                </p>
                
                <div class="features">
                    <h3>Fitur Utama:</h3>
                    <ul>
                        <li>Notifikasi real-time dengan animasi slide</li>
                        <li>Kategorisasi berdasarkan jenis aktivitas</li>
                        <li>Tombol aksi cepat untuk respons langsung</li>
                        <li>Desain responsif untuk berbagai ukuran layar</li>
                        <li>Tema navy blue dan putih yang profesional</li>
                    </ul>
                </div>
                
                <div id="notifications-list">
                    <?php if (empty($notifications)): ?>
                        <p style="text-align: center; color: #718096; padding: 40px;">
                            Belum ada notifikasi. Klik "Demo Notifikasi" untuk melihat contoh.
                        </p>
                    <?php else: ?>
                        <?php foreach ($notifications as $notification): ?>
                            <div class="notification-card <?php echo htmlspecialchars($notification['category']); ?>" 
                                 data-id="<?php echo $notification['id']; ?>">
                                <h4><?php echo htmlspecialchars($notification['title']); ?></h4>
                                <p><?php echo htmlspecialchars($notification['message']); ?></p>
                                <small><?php echo date('d M Y H:i', strtotime($notification['created_at'])); ?></small>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="demo-panel">
                <h3>
                    <span class="notification-icon">▶️</span>
                    Demo Notifikasi
                </h3>
                
                <div class="category-buttons">
                    <button class="category-btn" onclick="loadCategory('tugas_baru')">
                        <h4>Tugas Baru</h4>
                        <p>Klik untuk melihat notifikasi tugas</p>
                    </button>
                    
                    <button class="category-btn" onclick="loadCategory('pesan_masuk')">
                        <h4>Pesan Masuk</h4>
                        <p>Klik untuk melihat notifikasi pesan</p>
                    </button>
                    
                    <button class="category-btn" onclick="loadCategory('nilai_tersedia')">
                        <h4>Nilai Tersedia</h4>
                        <p>Klik untuk melihat notifikasi nilai</p>
                    </button>
                    
                    <button class="category-btn" onclick="loadCategory('pengingat_kelas')">
                        <h4>Pengingat Kelas</h4>
                        <p>Klik untuk melihat pengingat</p>
                    </button>
                </div>
                
                <a href="/notifications/demo" class="btn" style="width: 100%; text-align: center; margin-top: 15px;">
                    Buat Demo Notifikasi
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Load notifikasi berdasarkan kategori
        function loadCategory(category) {
            fetch(`/notifications/category/${category}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('notifications-list');
                    container.innerHTML = '';
                    
                    if (data.length === 0) {
                        container.innerHTML = '<p style="text-align: center; color: #718096; padding: 40px;">Tidak ada notifikasi untuk kategori ini.</p>';
                        return;
                    }
                    
                    data.forEach(notification => {
                        const card = document.createElement('div');
                        card.className = `notification-card ${notification.category}`;
                        card.dataset.id = notification.id;
                        card.innerHTML = `
                            <h4>${notification.title}</h4>
                            <p>${notification.message}</p>
                            <small>${new Date(notification.created_at).toLocaleString('id-ID')}</small>
                        `;
                        card.addEventListener('click', () => markAsRead(notification.id));
                        container.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        
        // Tandai notifikasi sebagai dibaca
        function markAsRead(id) {
            fetch(`/notifications/read/${id}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const card = document.querySelector(`[data-id="${id}"]`);
                    if (card) {
                        card.style.opacity = '0.6';
                        card.style.transform = 'scale(0.98)';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        
        // Event listener untuk kartu notifikasi
        document.addEventListener('click', function(e) {
            if (e.target.closest('.notification-card')) {
                const card = e.target.closest('.notification-card');
                const id = card.dataset.id;
                if (id) {
                    markAsRead(id);
                }
            }
        });
    </script>
</body>
</html>