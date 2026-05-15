<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)  // API Register untuk Android
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:guru,siswa',
            'gender' => 'nullable|in:Laki-Laki,Perempuan,unknown',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
            'nis' => 'nullable|string|max:10',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(
                $request->password
            ),
            'role' => $request->role,
            'school' => $request->school,

        ]);

        $token = $user->createToken(
            'mobile'
        )->plainTextToken;

        return response()->json([

            'status' => true,
            'token' => $token,
            'user' => $user

        ]);
    }

    public function login(Request $request) // API Login untuk Android
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if(!$user){

            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        if(!Hash::check(    
            $request->password,
            $user->password
        )){

            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ]);
        }

        $token = $user->createToken(
            'mobile'
        )->plainTextToken;

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user

        ]);
    }

        public function logout(Request $request)    // API Logout untuk Android
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'status' => true
        ]);
    }
}