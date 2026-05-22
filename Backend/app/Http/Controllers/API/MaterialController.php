<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    // Upload materi
    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:3000',
            'file'         => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public');
        }

        $material = Material::create([
            'classroom_id' => $request->classroom_id,
            'teacher_id'   => Auth::id(),
            'title'        => $request->title,
            'description'  => $request->description,
            'file'         => $filePath,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Materi berhasil diupload',
            'data'    => $material
        ]);
    }

    // Ambil materi per kelas
    public function index($classroom)
    {
        $materials = Material::where('classroom_id', $classroom)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data'   => $materials
        ]);
    }
}