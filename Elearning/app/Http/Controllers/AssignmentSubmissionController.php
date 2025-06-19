<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    /**
     * Tampilkan daftar submission berdasarkan assignment_id.
     *
     * @param  int  $assignmentId
     * @return \Illuminate\View\View
     */
    public function indexByAssignment($assignmentId)
    {
        // Ambil data assignment berdasarkan ID
        $assignment = Assignment::findOrFail($assignmentId);
        $assignment = Assignment::with('classes')->findOrFail($assignmentId);

        // Ambil semua submission untuk assignment ini, beserta data user
        $submissions = $assignment->submissions()->with('user')->get();

        // Kirim data ke view
        return view('assignments.index', [
            'assignment' => $assignment,
            'classes' => $assignment->Classes,
            'submissions' => $submissions,
        ]);
    }
}
