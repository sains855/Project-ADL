<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    /**
     * Menampilkan halaman detail pembelajaran
     */
    public function show($subjectId)
    {
        // Ambil data subject/matakuliah
        $subject = Subject::findOrFail($subjectId);

        // Ambil semua modul untuk subject ini
        $modules = Module::with(['assignments' => function($query) {
            $query->orderBy('due_date', 'asc');
        }])
        ->where('subject_id', $subjectId)
        ->orderBy('created_at', 'asc')
        ->get();

        return view('learning.detail', compact('subject', 'modules'));
    }

    /**
     * Menyimpan modul baru
     */
    public function storeModule(Request $request, $subjectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
        ]);

        $module = new Module();
        $module->title = $request->title;
        $module->content = $request->content;
        $module->subject_id = $subjectId;
        $module->created_by = Auth::user()->id;
        $module->save();

        return redirect()->back()->with('success', 'Modul berhasil ditambahkan');
    }

    /**
     * Mengupdate modul
     */
    public function updateModule(Request $request, $moduleId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
        ]);

        $module = Module::findOrFail($moduleId);
        $module->title = $request->title;
        $module->content = $request->content;
        $module->save();

        return redirect()->back()->with('success', 'Modul berhasil diperbarui');
    }

    /**
     * Menghapus modul
     */
    public function destroyModule($moduleId)
    {
        $module = Module::findOrFail($moduleId);
        $module->delete();

        return redirect()->back()->with('success', 'Modul berhasil dihapus');
    }

    /**
     * Menyimpan tugas baru
     */
    public function storeAssignment(Request $request, $subjectId)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|in:Aktif,Draft,Selesai',
        ]);

        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->subject_id = $subjectId;
        $assignment->module_id = $request->module_id;
        $assignment->due_date = $request->due_date;
        $assignment->status = $request->status;
        $assignment->save();

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan');
    }

    /**
     * Mengupdate tugas
     */
    public function updateAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->status = $request->status;
        $assignment->save();

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Menghapus tugas
     */
    public function destroyAssignment($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}
