<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::paginate(10, ['*'], 'users_page');

        if (request()->expectsJson()) {
            return response()->json(['users' => $users], 200);
        }

        return view('Admin.data_pengguna', ['title' => 'Data Pengguna'], compact('users'));
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        if (!$user) {
            return request()->expectsJson()
                ? response()->json(['message' => 'User not found'], 404)
                : redirect()->back()->withErrors(['message' => 'User not found']);
        }

        if (request()->expectsJson()) {
            return response()->json(['user' => $user], 200);
        }

        return view('profile', ['title' => 'Profil'], compact('user'));
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
        $user = User::find($id);
        if (!$user) {
            return request()->expectsJson()
                ? response()->json(['message' => 'User not found'], 404)
                : redirect()->back()->withErrors(['message' => 'User not found']);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'number' => 'required|string|unique:users,number,' . $user->id,
        ]);

        $user->update($validatedData);

        if (request()->expectsJson()) {
            return response()->json(['user' => $user], 200);
        }
        return redirect()->route('Profile')->with('success', 'User updated successfully');
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        } else {
            return redirect()->back()->withErrors(["User not found"]);
        }
        return redirect()->route('Data Pengguna');
    }

    public function getDataEditUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors(["User not found"]);
        }
        return view('Admin.data-Pengguna-edit', ['title' => 'Edit Pengguna'], compact('user'));
    }

    public function getUserbyName()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $users = User::where('name', 'LIKE', request('name') . '%')->where('role_id', 0)->paginate(10, ['*'], 'users_page');

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'users' => $users,
            ]);
        }

        return view('Admin.data_pengguna', ['title' => 'Data Pengguna'], compact('users'));
    }
}
