<?php
namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $teacherId = Auth::user()->id;

        // Ambil semua kelas milik dosen dengan error handling
        try {
            // Perbaikan: hapus ->with('classes') karena tidak ada relasi classes di model Classes
            // Sesuaikan dengan struktur migration yang hanya memiliki: id, name, description, teacher_id, timestamps
            $classes = Classes::where('teacher_id', $teacherId)
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan yang terbaru
                ->get();

            $totalKelas = $classes->count();

            // Debug: uncomment baris di bawah jika ingin melihat data di log
            Log::info('Teacher ID: ' . $teacherId . ', Total Kelas: ' . $totalKelas);
            // Log::info('Classes Data: ', $classes->toArray());

        } catch (\Exception $e) {
            // Jika terjadi error, set default values
            $classes = collect();
            $totalKelas = 0;

            // Log error untuk debugging
            Log::error('Error mengambil data kelas: ' . $e->getMessage());

            // Optional: tambahkan flash message untuk user
            session()->flash('error', 'Terjadi kesalahan saat mengambil data kelas.');
        }

        return view('dosen.dashboard', compact('classes', 'totalKelas'));
    }
}
