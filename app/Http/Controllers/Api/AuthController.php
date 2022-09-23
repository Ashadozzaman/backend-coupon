<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rules;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => ['required'],
        ]);
        if (auth()->attempt($request->all())) {
            return response([
                'message' => 'User Login Successfull',
                'user' => auth()->user(),
                'access_token' => auth()->user()->createToken('authToken')->accessToken
            ], Response::HTTP_OK);
        }


        return response([
            'message' => 'This User does not exist'
        ], Response::HTTP_UNAUTHORIZED);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);
        return response([
            'message' => 'User Register Successfull',
            'user' => auth()->user(),
            'access_token' => auth()->user()->createToken('authToken')->accessToken
        ], Response::HTTP_CREATED);

        // return response($user, Response::HTTP_CREATED);
    }

    public function logoutApi()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response([
            'message' => 'User logged out',
        ], Response::HTTP_OK);

    }
}
