<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $assignments = Assignment::with(['classroom'
        ])->get();
        $pending = [];
        
        // Cek setiap tugas apakah sudah dikumpulkan oleh user
        foreach($assignments as $assignment){
            $submitted = Submission::where('assignment_id',
            $assignment->id
            )->where('student_id',$userId)->exists();

            if(!$submitted){    // Jika belum dikumpulkan, tambahkan ke daftar pending
                $pending[] = [
                    'assignment_id' =>
                        $assignment->id,
                    'title' =>
                        $assignment->title,
                    'description' =>
                        $assignment->description,
                    'deadline' =>
                        $assignment->deadline,
                    'classroom' =>
                        $assignment->classroom->name
                ];
            }
        }
        return response()->json([   
            'status' => true,
            'pending_tasks' => $pending

        ]);
    }
}