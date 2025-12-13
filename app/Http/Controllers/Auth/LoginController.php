<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            ActivityLog::log(
                'user_login',
                'User logged in',
                'User',
                auth()->id()
            );

            // Redirect based on role
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->isTeacher()) {
                return redirect()->route('teacher.dashboard');
            } elseif (auth()->user()->isStudent()) {
                return redirect()->route('student.dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        ActivityLog::log(
            'user_logout',
            'User logged out',
            'User',
            auth()->id()
        );

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
