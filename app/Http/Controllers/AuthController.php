<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8|confirmed', // Adds password confirmation
            'level' => 'required|string|in:worker,company',
        ]);

        try {
            // Create user with MD5 hashing
            User::create([
                'username' => $request->username,
                'password' => md5($request->password), // Hash the password using MD5
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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve the input data
        $credentials = $request->only('username', 'password');
        // Hash the provided password with MD5 to match the stored hash
        $hashedPassword = md5($credentials['password']);

        // Find the user by username and compare the hashed password
        $user = User::where('username', $credentials['username'])
                    ->where('password', $hashedPassword)
                    ->first();

        if ($user) {
            // Log the user in and set session variable
            Auth::login($user);
            $request->session()->put('logged_in', true);

            // Redirect based on user role
            if ($user->level == 'worker') {
                return redirect()->route('worker.dashboard'); // Redirect to worker dashboard
            } elseif ($user->level == 'company') {
                return redirect()->route('company.dashboard'); // Redirect to company dashboard
            }
        }

        return back()->withErrors(['login_error' => 'Invalid username or password']);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('logged_in'); // Clear the session
        return redirect('/signin');
    }
}