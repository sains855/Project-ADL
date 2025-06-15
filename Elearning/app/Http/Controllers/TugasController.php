<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\TugasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TugasController extends Controller
{
    public function index()
    {
        $moduls = Module::all();
        $userId = Auth::id();

        // Cek untuk setiap modul apakah mahasiswa sudah mengumpulkan tugas
        $uploadedTugas = [];
        foreach ($moduls as $modul) {
            $uploadedTugas[$modul->id] = TugasMahasiswa::where('modul_id', $modul->id)
                ->where('mahasiswa_id', $userId)
                ->exists();
        }

        return view('modul.tugas', compact('moduls', 'uploadedTugas'));
    }
    public function uploadTugas(Request $request, $modul_id)
{
    // Validasi file yang diupload
    $request->validate([
        'file_tugas' => 'required|file|mimes:pdf,docx,zip|max:20480', // contoh validasi
    ]);

    // Simpan file
    $path = $request->file('file_tugas')->store('tugas_mahasiswa');

    // Simpan ke database
    TugasMahasiswa::create([
        'modul_id' => $modul_id,
        'mahasiswa_id' => Auth::id(),
        'file_path' => $path,
        'submitted_at' => now(),
    ]);

    return back()->with('success', 'Tugas berhasil diunggah!');
}

}
