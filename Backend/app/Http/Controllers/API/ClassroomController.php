<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    // API untuk mendapatkan daftar kelas yang diikuti oleh user
    public function index()
    {
        $user = Auth::user();
        if($user->role == 'guru'){
            $classrooms = Classroom::with([
                'teacher',
                'students',
                'assignments',
                'materials'
            ])
            ->where(
                'teacher_id',
                $user->id
            )
            ->latest()  
            ->get();
        }else{

            $classrooms = $user
                ->joinedClassrooms()
                ->with([
                    'teacher',
                    'students',
                    'assignments',
                    'materials'
                ])
                ->latest()
                ->get();
        }
        return response()->json([
            'status' => true,
            'data' => $classrooms
        ]);
    }

    // API untuk bergabung ke kelas menggunakan class_code
    public function join(Request $request)
    {
        $request->validate([
            'class_code' => 'required|exists:classrooms,class_code'
        ]);
        // Cari kelas berdasarkan class_code yang diberikan
        $classroom = Classroom::where('class_code',$request->class_code
        )->first();
        if(!$classroom){
            return response()->json(['status' => false
            ]);
        }

        // Tambahkan siswa ke kelas tanpa menghapus siswa yang sudah ada
        $classroom->students()
            ->syncWithoutDetaching([
                Auth::id()
            ]);

        return response()->json([
            'status' => true
        ]);
    }

    // API untuk mendapatkan daftar anggota (guru dan siswa) dari sebuah kelas
    public function members($id)
    {
        $classroom = Classroom::with([
            'teacher',
            'students'
        ])->find($id);

        if(!$classroom){

            return response()->json([
                'status' => false,
                'message' => 'Class tidak ditemukan'
            ]);
        }

        return response()->json([

            'status' => true,

            'teacher' => $classroom->teacher,

            'students' => $classroom->students

        ]);
    }
}