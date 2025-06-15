<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:2048', // max 2MB
        ]);

        // Cek apakah user sudah pernah submit tugas ini
        $existingSubmission = AssignmentSubmission::where('assignment_id', $request->assignment_id)
                                                  ->where('user_id', Auth::id())
                                                  ->first();

        if ($existingSubmission) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini sebelumnya.');
        }

        // Simpan file ke folder storage/app/public/uploads
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $fileName, 'public');

        // Buat URL lengkap untuk file
        $fileUrl = Storage::url($path);

        // Simpan data ke database
        AssignmentSubmission::create([
            'assignment_id' => $request->assignment_id,
            'user_id' => Auth::id(),
            'submitted_at' => now(),
            'file_url' => $fileUrl,
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function index()
    {
        // Menampilkan semua submission tugas user yang login
        $submissions = AssignmentSubmission::where('user_id', Auth::id())
                                          ->with('assignment') // assuming ada relationship
                                          ->orderBy('submitted_at', 'desc')
                                          ->get();

        return view('tugas.index', compact('submissions'));
    }

    public function show($id)
    {
        // Menampilkan detail submission
        $submission = AssignmentSubmission::where('id', $id)
                                         ->where('user_id', Auth::id())
                                         ->with('assignment')
                                         ->firstOrFail();

        return view('tugas.show', compact('submission'));
    }

    public function destroy($id)
    {
        // Hapus submission (jika diizinkan)
        $submission = AssignmentSubmission::where('id', $id)
                                         ->where('user_id', Auth::id())
                                         ->firstOrFail();

        // Hapus file dari storage
        $filePath = str_replace('/storage/', '', $submission->file_url);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Hapus record dari database
        $submission->delete();

        return back()->with('success', 'Submission berhasil dihapus!');
    }
}
