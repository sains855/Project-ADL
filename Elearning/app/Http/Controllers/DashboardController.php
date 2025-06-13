<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function dashboard()
    {
        $teacherId = Auth::id();
        
        $classes = Classes::with('subjects')
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'totalClasses' => $classes->count(),
            'activeClasses' => $classes->where('status', 'Aktif')->count(),
            'completedClasses' => $classes->where('status', 'Selesai')->count(),
            'totalStudents' => $classes->sum('student_count'),
            'recentClasses' => $classes->take(4)
        ];

        return view('dosen.kelas.dashboard', [
            'stats' => $stats,
            'classes' => $classes,
            'mode' => 'dashboard'
        ]);
    }

    public function index()
    {
        $classes = Classes::where('teacher_id', Auth::id())
                    ->with('subjects')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('dosen.kelas.index', [
            'classes' => $classes,
            'mode' => 'index'
        ]);
    }

    protected function getTeacherClassesWithStats()
    {
        $classes = Classes::with(['subjects', 'students'])
                    ->where('teacher_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return [
            'classes' => $classes,
            'stats' => [
                'total' => $classes->count(),
                'active' => $classes->where('status', 'Aktif')->count(),
                'completed' => $classes->where('status', 'Selesai')->count(),
                'totalStudents' => $classes->sum(function($class) {
                    return $class->students->count();
                })
            ]
        ];
    }
}