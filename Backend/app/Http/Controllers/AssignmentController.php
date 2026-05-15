<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function create(Request $request)
    {
        Assignment::create([
            'classroom_id' => $request->classroom_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline
        ]);
        return back()->with('success', 'Tugas berhasil dibuat!');
    }
}