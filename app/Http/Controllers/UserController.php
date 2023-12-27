<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a list of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = User::get();
        return view('user/user-list', compact('data'));
    }

    /**
     * Display the home page with a list of users.
     *
     * @return \Illuminate\View\View
     */
    public function homePage()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    /**
     * Display the form to add a new user.
     *
     * @return \Illuminate\View\View
     */
    public function addUser()
    {
        return view('user/add-user');
    }

    /**
     * Save a new user to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $role = $request->role;
        $password = $request->password;

        // Check if the user already exists in the database
        $existingUser = User::where('name', $email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'User with this name already exists.');
        }

        // Save the user to the database
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password;
        $user->save();

        return redirect()->back()->with('success', 'User added successfully.');
    }

    /**
     * Display the form to edit a user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editUser($id)
    {
        $data = User::where('id', '=', $id)->first();
        return view('user/edit-user', compact('data'));
    }

    /**
     * Update a user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;
        $password = $request->password;

        // Find the user in the database
        $user = User::findOrFail($id);

        // Update fields
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
