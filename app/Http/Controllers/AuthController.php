<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Get user credentials from the request
        $credentials = $request->only('email', 'password');
        
        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the intended URL
            return redirect()->intended('/home');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->with('status', 'Invalid credentials');
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]*$/', // Only letters and spaces allowed
            'email' => 'required|string|email:filter|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.regex' => 'Name should contain only letters and spaces.',
            'email.unique' => 'Email already exists.',
            'password.min' => 'Password must be at least :min characters long.',
        ]);

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'user',
                'password' => Hash::make($request->input('password')),
            ]);

            // Redirect to the login page with a success message
            return redirect('/login')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Redirect back with input data and an error message if registration fails
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Email already exists.']);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the login page
        return redirect('/login')->with('success', 'Successfully logged out.');

        // Additional logic can be added here if needed
    }
}
