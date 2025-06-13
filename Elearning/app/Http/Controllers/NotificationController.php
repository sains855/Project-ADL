<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Menampilkan halaman utama notifikasi
     */
    public function index(): View
    {
        $notifications = $this->getAllNotifications();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mengambil notifikasi berdasarkan tipe via AJAX
     */
    public function getByType(string $type): JsonResponse
    {
        try {
            $notifications = $this->getNotificationsByType($type);
            
            return response()->json([
                'success' => true,
                'data' => $notifications,
                'total' => count($notifications)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menandai notifikasi sebagai dibaca
     */
    public function markAsRead(int $id): JsonResponse
    {
        try {
            // Logic untuk menandai notifikasi sebagai dibaca
            // Implementasi database akan ditambahkan di sini
            
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi telah ditandai sebagai dibaca',
                'notification_id' => $id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menandai semua notifikasi sebagai dibaca
     */
    public function markAllAsRead(): JsonResponse
    {
        try {
            // Logic untuk menandai semua notifikasi sebagai dibaca
            
            return response()->json([
                'success' => true,
                'message' => 'Semua notifikasi telah ditandai sebagai dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai semua notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus notifikasi
     */
    public function deleteNotification(int $id): JsonResponse
    {
        try {
            // Logic untuk menghapus notifikasi
            
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus',
                'notification_id' => $id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil semua kategori notifikasi
     */
    private function getAllNotifications(): array
    {
        return [
            'tugas_baru' => [
                'title' => 'Tugas Baru',
                'description' => 'Klik untuk melihat notifikasi tugas',
                'count' => 3,
                'icon' => '📝',
                'color' => 'bg-blue-500',
                'type' => 'tugas_baru'
            ],
            'pesan_masuk' => [
                'title' => 'Pesan Masuk',
                'description' => 'Klik untuk melihat notifikasi pesan',
                'count' => 5,
                'icon' => '💬',
                'color' => 'bg-green-500',
                'type' => 'pesan_masuk'
            ],
            'nilai_tersedia' => [
                'title' => 'Nilai Tersedia',
                'description' => 'Klik untuk melihat notifikasi nilai',
                'count' => 2,
                'icon' => '📊',
                'color' => 'bg-yellow-500',
                'type' => 'nilai_tersedia'
            ],
            'pengingat_kelas' => [
                'title' => 'Pengingat Kelas',
                'description' => 'Klik untuk melihat pengingat',
                'count' => 1,
                'icon' => '🔔',
                'color' => 'bg-red-500',
                'type' => 'pengingat_kelas'
            ]
        ];
    }

    /**
     * Mengambil notifikasi berdasarkan tipe
     */
    private function getNotificationsByType(string $type): array
    {
        $notifications = [
            'tugas_baru' => [
                [
                    'id' => 1,
                    'title' => 'Tugas Matematika - Deadline Besok',
                    'message' => 'Tugas tentang integral harus dikumpulkan sebelum jam 23:59',
                    'time' => '2 jam yang lalu',
                    'read' => false,
                    'priority' => 'high',
                    'subject' => 'Matematika',
                    'deadline' => '2024-06-14 23:59:00'
                ],
                [
                    'id' => 2,
                    'title' => 'Tugas Bahasa Indonesia',
                    'message' => 'Essay tentang sastra Indonesia modern',
                    'time' => '1 hari yang lalu',
                    'read' => false,
                    'priority' => 'medium',
                    'subject' => 'Bahasa Indonesia',
                    'deadline' => '2024-06-20 23:59:00'
                ],
                [
                    'id' => 3,
                    'title' => 'Tugas Fisika - Praktikum',
                    'message' => 'Laporan praktikum gelombang elektromagnetik',
                    'time' => '3 hari yang lalu',
                    'read' => true,
                    'priority' => 'low',
                    'subject' => 'Fisika',
                    'deadline' => '2024-06-25 23:59:00'
                ]
            ],
            'pesan_masuk' => [
                [
                    'id' => 4,
                    'title' => 'Pesan dari Dosen Matematika',
                    'message' => 'Jadwal konsultasi hari Jumat tersedia',
                    'time' => '30 menit yang lalu',
                    'read' => false,
                    'sender' => 'Dr. Ahmad Sutrisno',
                    'type' => 'consultation'
                ],
                [
                    'id' => 5,
                    'title' => 'Pengumuman Kelas',
                    'message' => 'Perubahan jadwal kuliah minggu depan',
                    'time' => '3 jam yang lalu',
                    'read' => true,
                    'sender' => 'Admin Akademik',
                    'type' => 'announcement'
                ],
                [
                    'id' => 6,
                    'title' => 'Undangan Meeting Online',
                    'message' => 'Meeting diskusi proyek kelompok',
                    'time' => '5 jam yang lalu',
                    'read' => false,
                    'sender' => 'Ketua Kelompok',
                    'type' => 'meeting'
                ]
            ],
            'nilai_tersedia' => [
                [
                    'id' => 7,
                    'title' => 'Nilai UTS Matematika',
                    'message' => 'Nilai ujian tengah semester telah tersedia',
                    'time' => '1 hari yang lalu',
                    'read' => false,
                    'subject' => 'Matematika',
                    'score' => '85',
                    'grade' => 'A'
                ],
                [
                    'id' => 8,
                    'title' => 'Nilai Quiz Fisika',
                    'message' => 'Hasil quiz mingguan sudah dapat dilihat',
                    'time' => '2 hari yang lalu',
                    'read' => false,
                    'subject' => 'Fisika',
                    'score' => '78',
                    'grade' => 'B+'
                ]
            ],
            'pengingat_kelas' => [
                [
                    'id' => 9,
                    'title' => 'Kelas Fisika dalam 30 menit',
                    'message' => 'Jangan lupa bergabung di ruang virtual',
                    'time' => 'Sekarang',
                    'read' => false,
                    'subject' => 'Fisika',
                    'room' => 'Virtual Room 1',
                    'schedule' => '13:00 - 14:40'
                ],
                [
                    'id' => 10,
                    'title' => 'Reminder: Presentasi Besok',
                    'message' => 'Persiapkan presentasi proyek akhir',
                    'time' => '1 jam yang lalu',
                    'read' => true,
                    'subject' => 'Metodologi Penelitian',
                    'schedule' => '09:00 - 11:00'
                ]
            ]
        ];

        return $notifications[$type] ?? [];
    }

    /**
     * Mendapatkan statistik notifikasi
     */
    public function getStatistics(): JsonResponse
    {
        $stats = [
            'total_notifications' => 10,
            'unread_notifications' => 7,
            'today_notifications' => 4,
            'high_priority' => 2
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}