<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua assignment
        $assignments = Assignment::all();

        // Cek untuk setiap assignment apakah user sudah mengumpulkan tugas
        $uploadedTugas = [];
        foreach ($assignments as $assignment) {
            $uploadedTugas[$assignment->id] = AssignmentSubmission::where('assignment_id', $assignment->id)
                ->where('user_id', $userId)
                ->exists();
        }

        return view('modul.tugas', compact('assignments', 'uploadedTugas'));
    }

    public function uploadTugas(Request $request, $assignment_id)
    {
        // Cek apakah user sudah mengumpulkan tugas ini
        $sudahUpload = AssignmentSubmission::where('assignment_id', $assignment_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahUpload) {
            return back()->with('error', 'Kamu sudah mengumpulkan tugas ini. Tidak bisa upload ulang.');
        }

        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,zip|max:20480',
        ]);

        // Simpan file
        $path = $request->file('file')->store('tugas_mahasiswa');

        // Buat record baru di AssignmentSubmission
        AssignmentSubmission::create([
            'assignment_id' => $assignment_id,
            'user_id' => Auth::id(),
            'file_url' => $path,
            'submitted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diupload.');
    }

    /**
     * Method untuk menampilkan detail submission
     */
    public function showSubmission($assignment_id)
    {
        $submission = AssignmentSubmission::with(['assignment', 'user'])
            ->where('assignment_id', $assignment_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission tidak ditemukan.');
        }

        return view('modul.submission-detail', compact('submission'));
    }

    /**
     * Method untuk download file submission
     */
    public function downloadSubmission($submission_id)
    {
        $submission = AssignmentSubmission::where('id', $submission_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$submission || !Storage::exists($submission->file_url)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($submission->file_url);
    }
}
