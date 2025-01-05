<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show signup form
    public function showSignupForm()
    {
        return view('signup');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('signin');
    }

    // Handle user registration
    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|string|in:worker,company',
        ]);

        try {
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => $request->level,
            ]);

            return redirect()->route('signin')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['register_error' => 'Registration failed. Please try again.']);
        }
    }

    // Handle user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
        
            $request->session()->put('logged_in', true);

            if ($user->level == 'worker') {
                return redirect()->route('worker.dashboard');
            } elseif ($user->level == 'company') {
                return redirect()->route('company.dashboard');
            }
        }

        return redirect('/signin')->withErrors(['login_error' => 'Invalid email or password']);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/')->with('status', 'You have been logged out successfully.');
    }
}