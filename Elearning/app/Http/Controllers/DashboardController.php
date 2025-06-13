<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk dashboard
        $totalKelas = Classes::where('teacher_id', Auth::user()->id)->count();
        // Hitung total mahasiswa dari semua kelas yang diajar dosen ini


        // Ambil 6 kelas terbaru

        return view('dosen.dashboard', [
            'totalKelas' => $totalKelas,
        ]);
    }
}
