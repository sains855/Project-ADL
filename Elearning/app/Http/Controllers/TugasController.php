<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function store(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:2048', // max 2MB
        ]);

        // Simpan file ke folder storage/app/public/uploads
        $path = $request->file('file')->store('uploads', 'public');

        return back()->with('success', 'File berhasil diupload! Path: ' . $path);
    }
}

