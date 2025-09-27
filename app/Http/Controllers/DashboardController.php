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
                case 'ketua_rw':
                    return view('ketua_rw/dashboard'); // Replace with your actual view path
                case 'pkk':
                    return view('pkk/dashboard'); // Replace with your actual view path
                case 'katar':
                    return view('katar/dashboard'); // Replace with your actual view path
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
