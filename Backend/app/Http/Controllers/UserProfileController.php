<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function update(Request $request)
{
    $user = Auth::user();

    // Validasi dasar yang berlaku untuk keduanya
    $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . $user->id . '|max:100',
        'password' => 'nullable|min:6|confirmed',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'school' => 'required|string|max:100',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ];

    // Tambahkan validasi khusus Siswa (misal role 'siswa' = 2)
    if ($user->role === 'siswa') {
        $rules['class'] = 'required|string|max:10';
    }

    $request->validate($rules);

    // Update data umum
    $user->name = $request->name;
    $user->email = $request->email;
    $user->gender = $request->gender;
    $user->school = $request->school;

    // Update khusus siswa
    if ($user->role === 'siswa') {
        $user->class = $request->kelas;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('photo')) {
        if ($user->photo) { Storage::disk('public')->delete($user->photo); }
        $user->photo = $request->file('photo')->store('profile_photos', 'public');
    }

    $user->save();
    return back()->with('success', 'Profil berhasil diperbarui!');
}
}
