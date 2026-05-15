<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json([

            'status' => true,
            'user' => $request->user()

        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gender' => 'nullable|in:Laki-Laki,Perempuan,unknown',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'school' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        // upload photo
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename =
                time().'_'.
                $photo->getClientOriginalName();
            $photo->move(
                public_path('profiles'),
                $filename
            );
            $user->photo = $filename;
        }

        // update data
        $user->name =
            $request->name;
        $user->email =
            $request->email;
        $user->gender =
            $request->gender;
        $user->school =
            $request->school;
        $user->phone_number =
            $request->phone_number;
        $user->address =
            $request->address;
        $user->date_of_birth =
            $request->date_of_birth;

        // update password
        if ($request->filled('new_password')) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama tidak cocok.']);
            }

            $user->password = Hash::make($request->new_password);
            // remember to save the user: $user->save();
        }

        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Profile berhasil diperbarui',
            'user' => $user
        ]);
    }
}