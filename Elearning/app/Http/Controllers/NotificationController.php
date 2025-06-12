<?php

class NotificationController {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    // Menampilkan halaman utama notifikasi
    public function index() {
        $notifications = $this->getAllNotifications();
        $stats = $this->getNotificationStats();
        
        include 'views/notifications/index.php';
    }
    
    // Mendapatkan semua notifikasi
    private function getAllNotifications() {
        $query = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 20";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Mendapatkan statistik notifikasi berdasarkan kategori
    private function getNotificationStats() {
        $categories = ['tugas_baru', 'pesan_masuk', 'nilai_tersedia', 'pengingat_kelas'];
        $stats = [];
        
        foreach ($categories as $category) {
            $query = "SELECT COUNT(*) as count FROM notifications WHERE category = ? AND is_read = 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$category]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stats[$category] = $result['count'];
        }
        
        return $stats;
    }
    
    // Menampilkan notifikasi berdasarkan kategori
    public function getByCategory($category) {
        $query = "SELECT * FROM notifications WHERE category = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$category]);
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        echo json_encode($notifications);
    }
    
    // Menandai notifikasi sebagai dibaca
    public function markAsRead($id) {
        $query = "UPDATE notifications SET is_read = 1, read_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute([$id]);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
    
    // Membuat notifikasi baru
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $message = $_POST['message'] ?? '';
            $category = $_POST['category'] ?? '';
            $user_id = $_POST['user_id'] ?? 1;
            
            $query = "INSERT INTO notifications (title, message, category, user_id, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute([$title, $message, $category, $user_id]);
            
            if ($result) {
                header('Location: /notifications');
                exit;
            }
        }
        
        include 'views/notifications/create.php';
    }
    
    // Demo untuk menambahkan notifikasi contoh
    public function demo() {
        $demoNotifications = [
            [
                'title' => 'Tugas Matematika Baru',
                'message' => 'Tugas baru telah ditambahkan untuk mata pelajaran Matematika. Deadline: 15 Juni 2025',
                'category' => 'tugas_baru'
            ],
            [
                'title' => 'Pesan dari Guru',
                'message' => 'Anda memiliki pesan baru dari Bapak Ahmad mengenai jadwal ujian',
                'category' => 'pesan_masuk'
            ],
            [
                'title' => 'Nilai Ujian Tersedia',
                'message' => 'Nilai ujian Bahasa Indonesia telah tersedia untuk dilihat',
                'category' => 'nilai_tersedia'
            ],
            [
                'title' => 'Pengingat Kelas',
                'message' => 'Kelas Fisika akan dimulai dalam 30 menit',
                'category' => 'pengingat_kelas'
            ]
        ];
        
        foreach ($demoNotifications as $notification) {
            $query = "INSERT INTO notifications (title, message, category, user_id, created_at) VALUES (?, ?, ?, 1, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$notification['title'], $notification['message'], $notification['category']]);
        }
        
        header('Location: /notifications');
        exit;
    }
}