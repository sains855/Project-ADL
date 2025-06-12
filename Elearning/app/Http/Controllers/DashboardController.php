<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $teacherId = Auth::user()->id; // user yang login adalah dosen

        // Ambil semua kelas milik dosen
        $classes = Classes::with('subjects')
            ->where('teacher_id', $teacherId)
            ->get();

        $totalKelas = $classes->count();
        $kelasAktif = $classes->where('status', 'Aktif')->count();
        $kelasSelesai = $classes->where('status', 'Selesai')->count();
        $totalMahasiswa = $classes->sum('student_count');

        return view('dosen.dashboard', compact('classes', 'totalKelas', 'kelasAktif', 'kelasSelesai', 'totalMahasiswa'));
    }
}
