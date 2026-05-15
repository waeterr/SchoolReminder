<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function create(Request $request)
    {
        $user = session('user');

        if($user->role != 'guru'){
            return back();
        }

        Classroom::create([
            'teacher_id' => $user->id,
            'name' => $request->name,
            'subject' => $request->subject,
            'description' => $request->description,
            'photo' => $request->photo,
            'class_code' => strtoupper(Str::random(6))
        ]);

        return back();
    }

    public function join(Request $request)
    {
        $classroom = Classroom::where(
            'class_code',
            $request->class_code
        )->first();

        if(!$classroom){
            return back();
        }

        $classroom->students()->syncWithoutDetaching([
            session('user')->id
        ]);

        return back();
    }
}