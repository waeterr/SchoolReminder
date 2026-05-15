<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:10000'
        ]);

        $file = $request->file('file');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('uploads'), $filename);

        Submission::create([
            'assignment_id' => $request->assignment_id,
            'student_id' => session('user')->id,
            'file' => $filename,
            'note' => $request->note
        ]);

        return back();
    }
}