<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ], 200);
    }

    // Fungsi cek user yang sedang login
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
    // Fungsi get all users (hanya bisa diakses pakai token)
    public function getAllUsers(Request $request)
    {
        $users = User::all();

        return response()->json([
            'message' => 'Daftar user berhasil diambil',
            'users' => $users
        ], 200);
    }
}
