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
        $userId = Auth::id();
        $moduls = Module::with('class')->get();

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
        $sudahUpload = TugasMahasiswa::where('modul_id', $modul_id)
        ->where('mahasiswa_id', Auth::id())
        ->exists();

        if ($sudahUpload) {
            return back()->with('error', 'Kamu sudah mengumpulkan tugas ini. Tidak bisa upload ulang.');
        }

        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,zip|max:20480',
        ]);

        $path = $request->file('file')->store('tugas_mahasiswa');

        TugasMahasiswa::create([
            'modul_id' => $modul_id,
            'mahasiswa_id' => Auth::id(),
            'file_path' => $path,
            'submitted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diupload.');
    }

}
