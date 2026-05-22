<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'description' => 'required',
            ]);

            // DEBUG USER LOGIN
            if (!auth()->check()) {

                return response()->json([
                    'status' => false,
                    'message' => 'User belum login'
                ], 401);
            }

            $classroom = Classroom::create([
                'teacher_id' => auth()->user()->id,
                'name' => $request->name,
                'subject' => $request->subject,
                'description' => $request->description,
                'class_code' => strtoupper(substr(md5(time()),0,6))
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Kelas berhasil dibuat',
                'data' => $classroom
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}