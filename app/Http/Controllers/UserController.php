<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all();

        if(request()->expectsJson()) {
            return response()->json(['users' => $users], 200);
        }
        return view('Admin.data-Pengguna', ['title' => 'Data Pengguna'], compact('users'));
        // return response()->json(['users' => $users], 200);
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        if (!$user) {
            return request()->expectsJson() 
                ? response()->json(['message' => 'User not found'], 404)
                : redirect()->back()->withErrors(['message' => 'User not found']);
        }
        if(request()->expectsJson()) {
            return response()->json(['user' => $user], 200);
        }
        return view('Admin.data-Pengguna-detail', ['title' => 'Detail Pengguna'], compact('user'));
    }

     public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create($validatedData);
        
        if (request()->expectsJson()) {
            return response()->json(['user' => $user], 201);
        }
        
        return redirect()->back()->with('success', 'User created successfully');
    }

    public function updateUser($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$id,
        ]);
        // if ($validatedData->fails()) {
        //     return redirect()->back()->withErrors($validatedData)->withInput();
        // }

        $user = User::find($id);
        if (!$user) {
            return request()->expectsJson() 
                ? response()->json(['message' => 'User not found'], 404)
                : redirect()->back()->withErrors(['message' => 'User not found']);
        }

        $user->update($validatedData);

        if (request()->expectsJson()) {
            return response()->json(['user' => $user], 200);
        }
        
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->withErrors(["User not found"]);
        }
    }

    public function getDataEditUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors(["User not found"]);
        }
        return view('Admin.data-Pengguna-edit', ['title' => 'Edit Pengguna'], compact('user'));
    }
}
