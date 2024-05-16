<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    public function getAllUsers()
    {
        $users = User::all();

        return view('Admin.data-Pengguna', ['title' => 'Data Pengguna'], compact('users'));
    }

    public function getUserbyId($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(["Error"]);
        }

        return view('Admin.data-Pengguna', ['title' => 'Data Pengguna'], compact('users'));
    }

    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return $this->getAllUsers();
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return $this->getAllUsers();
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
    }
}
