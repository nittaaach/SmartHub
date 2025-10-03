<?php

namespace App\Http\Controllers;

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

            $user = Auth::user();
            $selectRole = $request->role;

            if ($user -> role !== $selectRole){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->with('error', 'Authentication failed. You are not authorized for the selected role.');
            }

            // arahkan sesuai role
            switch ($user->role) {
                case 'ketua_rw':
                    return redirect()->intended('rw/dashboard');
                case 'pkk':
                    return redirect()->intended('pkk/dashboard');
                case 'katar':
                    return redirect()->intended('katar/dashboard');
                default:
                    // fallback jika tidak ada role
                    Auth::logout();
                    return redirect('/login')->with('error', 'You Dont Have Any Permission');
            }
        }

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
