<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'Dosen') {
                return redirect()->intended('/dosen/dashboard');
            } else {
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_telepon' => 'required|string|max:20',
            'kata_sandi' => 'required|string|min:8|confirmed',
            'daftar_sebagai' => 'required|in:Dosen,Mahasiswa',
            'syarat_ketentuan' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->kata_sandi),
            'role' => $request->daftar_sebagai,
        ]);

        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'Dosen') {
            return redirect('/dosen/dashboard')->with('success', 'Selamat datang, Dosen!');
        } else {
            return redirect('/mahasiswa/dashboard')->with('success', 'Selamat datang, Mahasiswa!');
        }
    }
}
