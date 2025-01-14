<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login backend
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
    }

    // Autentikasi user backend
    public function authenticateBackend(Request $request)
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah user berhasil login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            // Cek status user, hanya izinkan login jika status aktif (misal: status == 1)
            if (Auth::user()->status == 0) {
                Auth::logout(); // Logout otomatis jika status tidak aktif
                return back()->with('error', 'User belum aktif');
            }

            // Regenerasi sesi untuk keamanan tambahan
            $request->session()->regenerate();

            // Redirect ke halaman yang diinginkan setelah login berhasil
            return redirect()->intended(route('backend.beranda'));
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Login Gagal, cek kembali email dan password');
    }

    // Logout user dari sesi yang aktif
    public function logoutBackend()
    {
        // Logout user
        Auth::logout();

        // Invalidate session
        request()->session()->invalidate();

        // Regenerate token CSRF
        request()->session()->regenerateToken();

        // Redirect kembali ke halaman login setelah logout
        return redirect(route('backend.login'));
    }
}
