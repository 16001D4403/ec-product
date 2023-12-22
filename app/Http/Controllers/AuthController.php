<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }

        return redirect()->back()->with('status', 'Invalid credentials');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        try {
            // Create user logic
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'user',
                'password' => Hash::make($request->input('password')),
            ]);
    
            return redirect('/login')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Email already exists.']);
        }
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/login');
        // Additional logic if needed
    }
}
