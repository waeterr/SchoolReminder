<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // API Login untuk Android
    public function apiLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kombinasi nama dan password salah'
            ], 401);
        }

        // Generate Token (Opsional: Jika menggunakan Laravel Sanctum)
        // Jika tidak, kita kirimkan data user dasar saja
        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil',
            'user' => $user
        ]);
    }

    // API Register untuk Android
    public function apiRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'school' => $request->school,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil',
            'user' => $user
        ]); 
    }
    public function showLogin()
    {   
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $user = User::where('name', $request->name)->first();

        if (!$user) {
            return back()->with('error', 'Nama tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        // --- BAGIAN YANG HARUS DIGANTI ---
        
        // 1. Gunakan Auth::login untuk mendaftarkan user ke sistem Laravel
        // 2. Tambahkan parameter true/false untuk fitur 'remember me'
        Auth::login($user, $request->remember_me ? true : false);

        // 3. Regenerasi session untuk keamanan (mencegah session fixation)
        $request->session()->regenerate();

        // 4. Redirect ke halaman yang dituju
        return redirect()->intended('/dashboard'); 
    }

    public function register(Request $request)
    {
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

            'role' => $request->role,

            'nis' => $request->nis,

            'school' => $request->school

        ]);

        if($request->remember_me){

        session([
            'user' => $user
        ]);

        return redirect('/dashboard');
    }

    return redirect('/login')
        ->with(
            'success',
            'Register berhasil'
        );
    }
}