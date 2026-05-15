<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index() // Fungsi untuk menampilkan dashboard berdasarkan peran pengguna
    {
        $user = Auth::user();
        if($user->role == 'guru'){
            return $this->teacherDashboard(
                $user
            );
        }else{
            return $this->studentDashboard(
                $user
            );
        }
    }

    private function teacherDashboard($user)    // Fungsi untuk menampilkan dashboard guru
    {
        $classes =
            $user->teachingClasses;

        $assignments =
            Assignment::where(
                'teacher_id',
                $user->id
            )->latest()->get();

        return response()->json([
            'role' => 'guru',
            'classes' => $classes,
            'assignments' => $assignments
        ]);
    }

    private function studentDashboard($user)    // Fungsi untuk menampilkan dashboard siswa
    {
        $classes =
            $user->classrooms;

        $pending = [];

        $assignments = Assignment::whereIn(

            'classroom_id',

            $classes->pluck('id')

        )->get();

        foreach($assignments as $assignment){

            $submitted = Submission::where('assignment_id',
                $assignment->id

            )->where(
                'student_id',
                $user->id

            )->exists();
            if(!$submitted){
                $pending[] = $assignment;
            }
        }

        return response()->json([
            'role' => 'siswa',
            'classes' => $classes,
            'pending_tasks' => $pending
        ]);
    }
}
