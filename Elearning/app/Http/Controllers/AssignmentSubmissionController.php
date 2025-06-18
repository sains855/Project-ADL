<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use App\Models\Module;
use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    /**
     * Tampilkan data pengumpulan tugas berdasarkan modul.
     *
     * @param int $moduleId
     * @return \Illuminate\Http\Response
     */

    public function byModule($moduleId)
    {
        $submissions = AssignmentSubmission::with(['assignment', 'user', 'assignment.module'])
            ->whereHas('assignment', function ($query) use ($moduleId) {
                $query->where('module_id', $moduleId);
            })
            ->get();

        $moduleName = Module::find($moduleId)?->name ?? 'Modul Tidak Diketahui';

        return view('assignments.index', compact('submissions', 'moduleName'));
    }
}
