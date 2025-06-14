<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar modul
        return view('modul.index');
    }
}
