<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Classes;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LearningController extends Controller
{
    /**
     * Menampilkan halaman detail pembelajaran
     */
    public function show($classId)
    {
        // Ambil data class/kelas
        $class = Classes::findOrFail($classId);

        // Ambil semua modul untuk class ini
        $modules = Module::with(['assignments' => function($query) {
            $query->orderBy('due_date', 'asc');
        }])
        ->where('class_id', $classId)
        ->orderBy('created_at', 'asc')
        ->get();

        return view('learning.detail', compact('class', 'modules'));
    }

    /**
     * Menyimpan modul baru
     */
    public function storeModule(Request $request, $classId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,mp4,mp3,jpg,jpeg,png,gif,zip,rar', // Max 10MB
        ]);

        $module = new Module();
        $module->title = $request->title;
        $module->content = $request->content;
        $module->class_id = $classId;
        $module->created_by = Auth::user()->id;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('modules', $fileName, 'public');
            $module->file_path = $filePath;
        }

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
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,mp4,mp3,jpg,jpeg,png,gif,zip,rar', // Max 10MB
        ]);

        $module = Module::findOrFail($moduleId);

        // Check authorization - only creator can update
        if ($module->created_by !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah modul ini');
        }

        $module->title = $request->title;
        $module->content = $request->content;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
                Storage::disk('public')->delete($module->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('modules', $fileName, 'public');
            $module->file_path = $filePath;
        }

        $module->save();

        return redirect()->back()->with('success', 'Modul berhasil diperbarui');
    }

    /**
     * Menghapus modul
     */
    public function destroyModule($moduleId)
    {
        $module = Module::findOrFail($moduleId);

        // Check authorization - only creator can delete
        if ($module->created_by !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus modul ini');
        }

        // Delete associated file if exists
        if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
            Storage::disk('public')->delete($module->file_path);
        }

        $module->delete();

        return redirect()->back()->with('success', 'Modul berhasil dihapus');
    }

    /**
     * Download file modul
     */
    public function downloadModuleFile($moduleId)
    {
        $module = Module::findOrFail($moduleId);

        if (!$module->file_path || !Storage::disk('public')->exists($module->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return Storage::download('public/file.pdf');
    }

    /**
     * Menghapus file dari modul tanpa menghapus modul
     */
    public function removeModuleFile($moduleId)
    {
        $module = Module::findOrFail($moduleId);

        // Check authorization - only creator can remove file
        if ($module->created_by !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus file ini');
        }

        if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
            Storage::disk('public')->delete($module->file_path);
            $module->file_path = null;
            $module->save();

            return redirect()->back()->with('success', 'File berhasil dihapus');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    /**
     * Menyimpan tugas baru
     */
    public function storeAssignment(Request $request, $classId)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:now',
        ]);

        // Verify module belongs to the class
        $module = Module::where('id', $request->module_id)
                        ->where('class_id', $classId)
                        ->first();

        if (!$module) {
            return redirect()->back()->with('error', 'Modul tidak valid untuk kelas ini');
        }

        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->class_id = $classId;
        $assignment->module_id = $request->module_id;
        $assignment->due_date = $request->due_date;
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
