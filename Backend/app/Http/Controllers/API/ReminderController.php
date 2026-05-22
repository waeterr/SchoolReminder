<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use Carbon\Carbon;

class ReminderController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with([
            'classroom',
            'submissions'
        ])
        ->where('teacher_id', Auth::id())
        ->latest()
        ->get();

        $data = [];

        foreach($assignments as $assignment){

            $totalStudents =
                $assignment->classroom
                ->students()
                ->count();

            $submitted =
                $assignment->submissions()
                ->count();

            $deadline =
                Carbon::parse($assignment->deadline);

            $daysLeft =
                now()->diffInDays(
                    $deadline,
                    false
                );

            $badge = "H-" . $daysLeft;

            $data[] = [

                'id' =>
                    $assignment->id,

                'title' =>
                    $assignment->title,

                'classroom' =>
                    $assignment->classroom->name,

                'submission' =>
                    $submitted .
                    " dari " .
                    $totalStudents .
                    " siswa sudah mengumpulkan",

                'deadline' =>
                    $assignment->deadline,

                'badge' =>
                    $badge
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}