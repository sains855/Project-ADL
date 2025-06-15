<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;

class ModulController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required',
        'deskripsi' => 'nullable',
        'file' => 'required|mimes:pdf,docx,zip,rar|max:10000',
        'class_id' => 'required|exists:classes,id'
    ]);

    // Simpan file ke storage
    $path = $request->file('file')->store('moduls', 'public');

    Modul::create([
        'judul' => $validated['judul'],
        'deskripsi' => $validated['deskripsi'],
        'file_path' => $path,
        'class_id' => $validated['class_id']
    ]);

    return back()->with('success', 'Modul berhasil diupload');
}

}
