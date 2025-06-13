<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
    }

   
    public function showLoginForm()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        // Basic validation
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        $role = $request->input('role', 'user');

        // Try to log in with the provided credentials and role
        $loginSuccessful = Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $role
        ], $request->filled('remember'));

        if ($loginSuccessful) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
            } else {
                return redirect()->route('user.landing')->with('success', 'Login successful!');
            }
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

   
    public function logout(Request $request)
    {
    
        Auth::logout();

        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
