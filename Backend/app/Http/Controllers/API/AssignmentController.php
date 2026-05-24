<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    // API untuk membuat tugas baru

   public function store(Request $request)
{
    $request->validate([

        'classroom_id' =>
            'required|exists:classrooms,id',

        'title' =>
            'required|string|max:255',

        'description' =>
            'required|string|max:3000',

        'deadline' =>
            'required|date',

        'file' =>
            'nullable|file|
            mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,zip|
            max:20480',
    ]);

    $filePath = null;

    if($request->hasFile('file')){

        $filePath = $request
            ->file('file')
            ->store(
                'assignments',
                'public'
            );
    }

    $assignment = Assignment::create([

        'classroom_id' =>
            $request->classroom_id,

        'teacher_id' =>
            Auth::id(),

        'title' =>
            $request->title,

        'description' =>
            $request->description,

        'deadline' =>
            $request->deadline,

        'file' =>
            $filePath
    ]);

    return response()->json([

        'status' => true,

        'message' =>
            'Tugas berhasil dibuat',

        'data' => $assignment
    ]);
}}