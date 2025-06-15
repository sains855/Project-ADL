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
        $classes = Classes::with(['teacher'])
                    ->orderBy('name')
                    ->get();
        // Hitung total kelas
        $totalClasses = $classes->count();
        // Format data untuk tabel
        $formattedClasses = $classes->map(function($class, $index) {
            return [
                'no' => $index + 1,
                'id' => $class->id,
                'name' => $class->name,
                'description' => $class->description,
                'teacher' => $class->teacher->name,
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
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
        $class->load(['teacher', 'students', 'moduls']);
        return view('modul.dashboard', compact('class')); // ← ini penting
    }


    /**
     * Menampilkan form edit kelas
     */
    public function edit($id)
    {
        $teachers = User::where('role', 'teacher')->get();
        $class = Classes::findOrFail($id);
        return view('classes.edit', compact('class', 'teachers'));
    }
    /**
     * Mengupdate data kelas
     */
    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id'
        ]);
        $class->update($validated);
        return redirect()->route('dosen.dashboard')
            ->with('success', 'Data kelas ' . $class->name . ' berhasil diperbarui');
    }
    /**
     * Menghapus kelas
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $className = $class->name;
        $class->delete();
        return redirect()->route('dosen.dashboard')
            ->with('success', 'Kelas ' . $className . ' berhasil dihapus');
    }
}

