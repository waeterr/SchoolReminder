<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'assignment_id' =>
                'required|exists:assignments,id',
            'file' =>
                'required|file|
                mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,zip|
                max:20480',

        ]);

        // upload file

        $filePath = null;
        if($request->hasFile('file')){
            $filePath = $request
                ->file('file')
                ->store(
                    'submissions',
                    'public'
                );
        }

        $submission = Submission::create([
            'assignment_id' =>
                $request->assignment_id,
            'student_id' =>
                Auth::id(),
            'file' =>
                $filePath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tugas berhasil dikirim',
            'data' => $submission
        ]);
    }
}