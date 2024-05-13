<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

   
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);
    }

    public function getUserbyId($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function getProfile($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['user' => $user], 200);
    }

    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        if ($user)
    {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return response()->json(['user' => $user], 200);
    }
    else {
            return response()->json(['error' => 'User not found'], 404);
        }   
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
