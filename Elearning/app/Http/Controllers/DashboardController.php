<?php
namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $classes = Classes::with('subjects')
                ->where('teacher_id', $teacherId)
                ->get();

            $totalKelas = $classes->count();

            // Debug: uncomment baris di bawah jika ingin melihat data di log
            // \Log::info('Teacher ID: ' . $teacherId . ', Total Kelas: ' . $totalKelas);

        } catch (\Exception $e) {
            // Jika terjadi error, set default values
            $classes = collect();
            $totalKelas = 0;

            // Log error untuk debugging
        }

        return view('dosen.dashboard', compact('classes', 'totalKelas'));
    }
}
