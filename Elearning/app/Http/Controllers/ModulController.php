<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModulController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'content' => 'nullable',
        'file' => 'required|mimes:pdf,docx,zip,rar|max:10000',
        'class_id' => 'required|exists:classes,id',
        
    ]);

    // Simpan file ke storage
    $path = $request->file('file')->store('modules', 'public');

    Module::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'file_path' => $path,
        'class_id' => $validated['class_id']
    ]);

    return back()->with('success', 'Modul berhasil diupload');
}

}
