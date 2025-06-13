<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Only non-logged in users can access login page
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login process
     */
    public function login(Request $request)
    {
        // Basic validation
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get the selected role (default to 'user' if not specified)
        $role = $request->input('role', 'user');

        // Try to log in with the provided credentials and role
        $loginSuccessful = Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $role
        ], $request->filled('remember'));

        if ($loginSuccessful) {
            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect based on user role - Changed to redirect users to landing page
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
            } else {
                return redirect()->route('user.landing')->with('success', 'Login successful!');
            }
        }

        // If login failed, return to login page with error
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Generate a new CSRF token
        $request->session()->regenerateToken();

        // Redirect to home page
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
