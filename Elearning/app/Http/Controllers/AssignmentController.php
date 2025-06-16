<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Classes;

class AssignmentController extends Controller
{
    public function __construct()
    {
        // Middleware can be applied in the route definition or use parent::__construct() if needed
    }

    public function index()
    {
        $assignments = Assignment::where('class_id', Auth::id())->get();
        return view('assignments.index', compact('assignments'));
    }



    public function create()
    {
        // tampilkan form buat assignment
        return view('assignments.create');
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id'    => 'required|exists:classes,id',
            'module_id'   => 'required|exists:modules,id',
            'due_date'    => 'required|date',
            'status'      => 'nullable|string',
        ]);

        // Validasi modul milik kelas
        $module = \App\Models\Module::where('id', $validated['module_id'])
            ->where('class_id', $validated['class_id'])
            ->first();

        if (!$module) {
            return back()->withErrors(['module_id' => 'Modul tidak valid untuk kelas ini'])->withInput();
        }

        $validated['user_id'] = Auth::id(); // ⬅️ Tambahkan ini
        Assignment::create($validated);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }
    public function show($classId)
    {
        $class = Classes::findOrFail($classId);
        $modules = Module::where('class_id', $classId)->get();

        return view('learning.detail', compact('class', 'modules'));
    }

}
