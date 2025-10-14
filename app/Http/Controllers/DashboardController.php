<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'Ketua_RW':
                    return view('ketua_rw/dashboard'); // Replace with your actual view path
                case 'Ketua_PKK':
                    return view('pkk/dashboard'); // Replace with your actual view path
                case 'Ketua_Katar':
                    return view('katar/dashboard'); // Replace with your actual view path
                case 'Ketua_RT':
                    return view('rt/dashboard'); // Replace with your actual view path
                default:
                    // Fallback, though the middleware should prevent this
                    return redirect('/login');
            }
        }

        // Default catch-all view or logic
        return view('dashboard');
    }

    // ... other methods in your controller
}
