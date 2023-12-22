<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $data = User::get();
        return view('user/user-list', compact('data'));
    }
    public function homePage()
    {
        $users = User::all();
        return view('home', compact('users'));
    }
    public function addUser(){
        return view('user/add-user');
    }
    
    public function saveUser(Request $request)
    {
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
    
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password; // Save the image path to the database
        $user->save();
    
        return redirect()->back()->with('success', 'User added successfully.');
    }
    
    
    public function editUser($id){
        $data = User::where('id','=',$id)->first();
        return view('user/edit-user', compact('data'));
    }
    public function updateUser(Request $request) {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;
        $password = $request->password;
    
        $user = User::findOrFail($id);

        // Update other fields
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password;
        $user->save();
    
        return redirect()->back()->with('success', 'User updated successfully.');
    }
    
    public function deleteUser($id){
       User::where('id','=',$id)->delete();
       return redirect()->back() ->with('success', 'User deleted successfully.');

    }
}
