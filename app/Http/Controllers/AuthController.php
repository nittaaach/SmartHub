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
        return view('/login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

        //     $user = Auth::user();
        //     $selectRole = $request->role;

        //     if ($user->role !== $selectRole) {
        //         Auth::logout();
        //         $request->session()->invalidate();
        //         $request->session()->regenerateToken();

        //         return redirect('/login')->with('error', 'Authentication failed. You are not authorized for the selected role.');
        //     }

        //     ChaptaModels::create([
        //         'id_users' => $user->id,
        //         'number'  => session('chapta_sum'), // atau bisa $request->captcha_answer
        //     ]);

        //     // arahkan sesuai role
        //     switch ($user->role) {
        //         case 'ketua_rw':
        //             return redirect()->intended('ketua_rw/dashboard');
        //         case 'pkk':
        //             return redirect()->intended('pkk/dashboard');
        //         case 'katar':
        //             return redirect()->intended('katar/dashboard');
        //         case 'rt':
        //             return redirect()->intended('rt/dashboard');
        //         default:
        //             // fallback jika tidak ada role
        //             Auth::logout();
        //             return redirect('/login')->with('error', 'You Dont Have Any Permission');
        //     }
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
