<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Menampilkan dashboard kelas
     */
    public function index()
    {
        // Ambil data kelas beserta relasinya
        $classes = Classes::with(['teacher', 'subjects'])
                    ->orderBy('name')
                    ->get();

        // Hitung total kelas
        $totalClasses = $classes->count();

        // Format data untuk tabel
        $formattedClasses = $classes->map(function($class, $index) {
            // Ambil mata pelajaran pertama sebagai contoh (bisa disesuaikan dengan kebutuhan)
            $subject = $class->subjects->first();

            return [
                'no' => $index + 1,
                'id' => $class->id,
                'name' => $class->name,
                'subject' => $subject ? $subject->name : 'Belum ada mapel',
                'subject_id' => $subject ? $subject->id : null,
                'teacher' => $class->teacher->name,
                'schedule' => $class->hari . ', ' . $class->jam_mulai . ' - ' . $class->jam_selesai,
                'status' => 'Aktif' // Asumsi semua kelas aktif
            ];
        });

        return view('dashboard.class', [
            'totalClasses' => $totalClasses,
            'classes' => $formattedClasses
        ]);
    }

    /**
     * Menampilkan form tambah kelas
     */
    public function create()
    {
        // Ambil daftar guru untuk dropdown
        $teachers = User::where('role', 'teacher')->get();

        return view('classes.create', compact('teachers'));
    }

    /**
     * Menyimpan kelas baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'teacher_id' => 'required|exists:users,id'
        ]);

        $class = Classes::create($validated);

        return redirect()->route('dosen.dashboard')
            ->with('success', 'Kelas ' . $class->name . ' berhasil ditambahkan');
    }

    /**
     * Menampilkan detail kelas
     */
    public function show(Classes $class)
    {
        $class->load(['teacher', 'subjects', 'students']);

        return view('learning.detail', compact('class'));
    }

    /**
     * Menampilkan form edit kelas
     */
    public function edit(Classes $class)
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('classes.edit', compact('class', 'teachers'));
    }

    /**
     * Mengupdate data kelas
     */
    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $validated['teacher_id'] = Auth::user()->id;
        $class->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Data kelas ' . $class->name . ' berhasil diperbarui');
    }

    /**
     * Menghapus kelas
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('dosen.dashboard')
            ->with('success', ' berhasil dihapus');
    }

    /**
     * Menampilkan daftar mata pelajaran untuk kelas tertentu
     */
    public function showSubjects(Classes $class)
    {
        $subjects = $class->subjects()->with('teacher')->get();

        return view('classes.subjects', [
            'class' => $class,
            'subjects' => $subjects
        ]);
    }
}
