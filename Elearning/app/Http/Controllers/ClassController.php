<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    // Menampilkan semua kelas
    public function index()
    {
        return view('dosen.classes.index', [
            'classes' => Classes::with('subject')
                                ->where('teacher_id', Auth::user()->id)
                                ->get(),
        ]);
    }

    // Menyimpan kelas baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'hari' => 'required|string|max:10',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Cari atau buat subject baru
        $subject = Subject::firstOrCreate([
            'name' => $request->name
        ]);

        // Generate kode kelas unik
        $classCode = strtoupper(substr($request->name, 0, 3)) . '-' . rand(100, 999);

        // Buat kelas baru
        $class = Classes::create([
            'subject_id' => $subject->id,
            'teacher_id' => Auth::user()->id,
            'class_code' => $classCode,
            'schedule' => $request->hari . ', ' . $request->waktu_mulai . ' - ' . $request->waktu_selesai,
        ]);

        return redirect()->route('dosen.dashboard')
                         ->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Menampilkan detail kelas
    public function show($id)
    {
        $class = Classes::with(['subject'])
                        ->where('teacher_id', Auth::user()->id)
                        ->findOrFail($id);

        return view('dosen.classes.show', compact('class'));
    }

    // Mengupdate kelas
    public function update(Request $request, $id)
    {
        $class = Classes::where('teacher_id', Auth::user()->id)
                         ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'hari' => 'required|string|max:10',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Update subject
        $subject = Subject::firstOrCreate([
            'name' => $request->name
        ]);

        // Update kelas
        $class->update([
            'subject_id' => $subject->id,
            'schedule' => $request->hari . ', ' . $request->waktu_mulai . ' - ' . $request->waktu_selesai,
        ]);

        return redirect()->route('dosen.dashboard')
                         ->with('success', 'Kelas berhasil diperbarui!');
    }

    // Menghapus kelas
    public function destroy($id)
    {
        $class = Classes::where('teacher_id', Auth::user()->id)
                         ->findOrFail($id);

        $class->delete();

        return redirect()->route('dosen.dashboard')
                         ->with('success', 'Kelas berhasil dihapus!');
    }

    // Helper untuk mendapatkan semester saat ini
    private function getCurrentSemester()
    {
        $month = date('n');
        $year = date('Y');

        // Semester ganjil: Agustus - Januari
        // Semester genap: Februari - Juli
        if ($month >= 8 || $month <= 1) {
            return 'Ganjil ' . ($month >= 8 ? $year . '/' . ($year + 1) : ($year - 1) . '/' . $year);
        } else {
            return 'Genap ' . $year . '/' . $year;
        }
    }
}
