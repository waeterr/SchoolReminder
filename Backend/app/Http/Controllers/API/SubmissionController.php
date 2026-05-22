<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Siswa kirim tugas
    public function store(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        $submission = Submission::create([
            'assignment_id' => $request->assignment_id,
            'student_id'    => Auth::id(),
            'file'          => $filePath,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Tugas berhasil dikirim',
            'data'    => $submission
        ]);
    }

    // Guru lihat submission per assignment
    public function getByAssignment($assignmentId)
    {
        $assignment = Assignment::with([
            'submissions.student',
            'classroom.students'
        ])->find($assignmentId);

        if (!$assignment) {
            return response()->json([
                'status'  => false,
                'message' => 'Tugas tidak ditemukan'
            ]);
        }

        $totalStudents  = $assignment->classroom->students->count();
        $totalSubmitted = $assignment->submissions->count();

        return response()->json([
            'status'           => true,
            'assignment_title' => $assignment->title,
            'total_students'   => $totalStudents,
            'total_submitted'  => $totalSubmitted,
            'submissions'      => $assignment->submissions->map(function ($s) {
                return [
                    'id'            => $s->id,
                    'assignment_id' => $s->assignment_id,
                    'student_id'    => $s->student_id,
                    'file'          => $s->file,
                    'grade'         => $s->grade,
                    'student'       => $s->student ? [
                        'id'    => $s->student->id,
                        'name'  => $s->student->name,
                        'email' => $s->student->email,
                    ] : null,
                ];
            })
        ]);
    }

    // Guru beri nilai
    public function grade(Request $request)
    {
        $request->validate([
            'submission_id' => 'required|exists:submissions,id',
            'grade'         => 'required|integer|min:0|max:100',
        ]);

        $submission = Submission::find($request->submission_id);
        $submission->update(['grade' => $request->grade]);

        return response()->json([
            'status'  => true,
            'message' => 'Nilai berhasil disimpan'
        ]);
    }
}