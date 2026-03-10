<?php

namespace App\Http\Controllers;

use App\Models\ChaptaModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        $a = rand(1, 10);
        $b = rand(1, 10);

        // simpan hasilnya ke session agar bisa diverifikasi
        session(['chapta_sum' => $a + $b]);

        return view('/login', compact('a', 'b'));
        return view('/login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'          => ['required', 'email'],
            'password'       => ['required'],
            'role'           => ['required'],
            'chapta_answer'  => ['required', 'numeric'],
        ]);

        // cek captcha
        if ((int)$request->chapta_answer !== (int)session('chapta_sum')) {
            return back()
                ->withInput()
                ->withErrors(['chapta_answer' => 'Jawaban penjumlahan salah.']);
        }

        $guard = match($request->role) {
            'Ketua_RW' => 'rw',
            'Ketua_PKK' => 'pkk',
            'Ketua_Katar' => 'katar',
            'Ketua_RT' => 'rt',
            default => 'web',
        };
        
        // autentikasi user
        $credentials = $request->only('email', 'password');
        if (! Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();
        $user = Auth::guard($guard)->user();

        // cek role
        if ($user->role !== $request->role) {
            Auth::guard($guard)->logout();
            return redirect('/login')->with('error', 'Role tidak sesuai.');
        }

        // simpan hasil captcha ke tabel chapta
        ChaptaModels::create([
            'id_users' => $user->id,
            'number'   => session('chapta_sum'),
        ]);

        // redirect sesuai role
        return match ($user->role) {
            'Ketua_RW' => redirect('ketua_rw/dashboard'),
            'Ketua_PKK'      => redirect('pkk/dashboard'),
            'Ketua_Katar'    => redirect('katar/dashboard'),
            'Ketua_RT'       => redirect('rt/dashboard'),
            default    => tap(back(), fn() => Auth::guard($guard)->logout())
                ->with('error', 'Tidak ada hak akses'),
        };
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('rw')->logout();
        Auth::guard('pkk')->logout();
        Auth::guard('katar')->logout();
        Auth::guard('rt')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing'); // redirect setelah logout
    }
}
