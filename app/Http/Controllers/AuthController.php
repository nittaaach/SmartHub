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
        
        // autentikasi user
        $credentials = $request->only('email', 'password');
        if (! Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // cek role
        if ($user->role !== $request->role) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('error', 'Role tidak sesuai.');
        }

        // simpan hasil captcha ke tabel chapta
        ChaptaModels::create([
            'id_users' => $user->id,
            'number'   => session('chapta_sum'),
        ]);

        // redirect sesuai role
        return match ($user->role) {
            'ketua_rw' => redirect('ketua_rw/dashboard'),
            'pkk'      => redirect('pkk/dashboard'),
            'katar'    => redirect('katar/dashboard'),
            'rt'       => redirect('rt/dashboard'),
            default    => tap(back(), fn() => Auth::logout())
                ->with('error', 'Tidak ada hak akses'),
        };


        return back()->withErrors([
            'email' => 'Email or Password are incorrect.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing'); // redirect setelah logout
    }
}
