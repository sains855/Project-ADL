<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Menampilkan semua notifikasi user yang login (misalnya siswa)
    public function index()
    {
        $userId = Auth::id();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $unreadCount = DB::table('notifications')
            ->where('user_id', $userId)
            ->whereNull('read_at')
            ->count();

        return view('notification', compact('notifications', 'unreadCount'));
    }

    // Admin/guru membuat notifikasi ke user tertentu (misalnya siswa)
    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string',
        ]);

        DB::table('notifications')->insert([
            'user_id'    => $request->user_id,
            'content'    => $request->content,
            'created_at' => now(),
        ]);

        return redirect()->route('notification')->with('success', 'Notifikasi berhasil dikirim.');
    }

    // Siswa menandai notifikasi sebagai dibaca
    public function markAsRead($id)
    {
        $updated = DB::table('notifications')
            ->where('id', $id)
            ->where('user_id', $userId = Auth::id())
            ->update(['read_at' => now()]);

        return response()->json(['success' => $updated]);
    }

    // API untuk siswa melihat notifikasi
    public function getByUser()
    {
        $userId = Auth::id();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Demo notifikasi oleh admin/guru
    public function demo()
    {
        $demoNotifications = [
            'Tugas baru dari Matematika telah tersedia. Deadline: 20 Juni.',
            'Anda mendapat pesan dari Ibu Rina.',
            'Nilai UTS Bahasa Inggris telah keluar.',
            'Pengingat: Kelas Fisika akan dimulai 30 menit lagi.',
        ];

        foreach ($demoNotifications as $content) {
            DB::table('notifications')->insert([
                'user_id'    => 1, // ganti sesuai siswa
                'content'    => $content,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('notifications.index')->with('success', 'Demo notifikasi berhasil dikirim.');
    }
}
