<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyEmailNotification;

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
            return redirect()->back()->withErrors([$validator->messages()]);
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
            // Assuming $user is the user model instance
            $verificationUrl = URL::temporarySignedRoute(
                "verifyMail", // Name of the verification route
                now()->addMinutes(10), // Expiry time for the URL (e.g., 60 minutes)
                ['id' => $user->id] // Route parameters
            );
            Mail::to($user->email)->send(new VerificationMail($verificationUrl));
            return redirect()->route('login');
        } else {
            return redirect()->back()->withErrors(["User not Found"]);
        }
    }

    public function mailVerification($id)
    {
        $user = User::find($id);
        if (!$user) {
            Log::error("User with ID $id not found.");
            // Handle the case where the user is not found
            // For example, return a response indicating that the user doesn't exist
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->email_verified_at = now();
        $user->save();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'password' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->messages()]);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return redirect()->back()->withErrors(["User not Found"]);
        }

        // //Check if user has already verified
        // if (auth()->user()->email_verified_at == null) {
        //     auth()->logout();
        //     return response()->json(['error' => 'User Not Found'], 401);
        // }

        return redirect()->route('dashboard');
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

        return redirect()->route('home');
    }
}
