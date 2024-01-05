<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'user' => $user,
            'message' => 'User Created ',
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response([
                'success'   => false,
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        // Session::put('auth_token', $token);

        $response = [
            'success'   => true,
            'user'      => $user,
            'token'     => $token,
            'message'   => 'Berhasil Login'
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $response = [
            'success'   => true,
            'message'   => 'Berhasil Logout'
        ];
        return response($response, 200);
    }

    public function testAuth(Request $request)
    {
        if ($request->user()) {
            return "auth";
        } else {
            return "guest";
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
