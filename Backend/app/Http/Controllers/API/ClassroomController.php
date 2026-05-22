<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    // AMBIL SEMUA KELAS
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'guru') {

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

        } else {

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

    // BUAT KELAS
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        $classroom = Classroom::create([
            'teacher_id' => Auth::id(),
            'name' => $request->name,
            'subject' => $request->subject,
            'description' => $request->description,
            'class_code' => strtoupper(Str::random(6))
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kelas berhasil dibuat',
            'data' => $classroom
        ]);
    }

    // JOIN KELAS
    public function join(Request $request)
    {
        $request->validate([
            'class_code' => 'required|exists:classrooms,class_code'
        ]);

        $classroom = Classroom::where(
            'class_code',
            $request->class_code
        )->first();

        if (!$classroom) {

            return response()->json([
                'status' => false,
                'message' => 'Kelas tidak ditemukan'
            ]);
        }

        $classroom->students()
            ->syncWithoutDetaching([
                Auth::id()
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil join kelas'
        ]);
    }

    // MEMBER KELAS
    public function members($id)
    {
        $classroom = Classroom::with([
            'teacher',
            'students'
        ])->find($id);

        if (!$classroom) {

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