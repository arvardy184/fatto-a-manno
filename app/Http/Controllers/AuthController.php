<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'number' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->message()]);
        }

        //Create User
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'address' => request('address'),
            'number' => request('number'),
            'role_id' => 0
        ]);

        if ($user) {
            return response()->json(['message' => "Registration Succeed"]);
        } else {
            return response()->json(['message' => "Registration Failed"]);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return redirect()->route('page-login');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('page-login');
    }
}
