<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = Auth::user();
        if ($user->role === 'dosen') {
                    return view('profile.show', compact('user'));
        } else {
        return view('profile.index', compact('user'));
        }
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'role' => ['required', Rule::in(['dosen', 'mahasiswa'])],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($user instanceof \App\Models\User) {
            $user->save();
        }

        // Reset email verification if email changed
        if ($user instanceof \App\Models\User && $user->wasChanged('email')) {
            $user->email_verified_at = null;
            $user->save();

            // Optional: Send email verification notification
            // $user->sendEmailVerificationNotification();
        }
        if (Auth::user()->role === 'dosen') {
            return redirect()->route('profile.show')
                ->with('success', 'Profile berhasil diperbarui!');
        } else {
        return redirect()->route('profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
        }
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password saat ini tidak benar.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'Password tidak benar.',
        ]);

        $user = User::find(Auth::id());

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }

    /**
     * Verify email address.
     */
}
