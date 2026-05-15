<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Classroom;

use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    // list materi

    public function index($classroomId)
    {
        $classroom = Classroom::find($classroomId);
        if(!$classroom){
            return response()->json([
                'status' => false,
                'message' => 'Kelas tidak ditemukan'
            ],404);
        }

        $materials = Material::where(
            'classroom_id',
            $classroomId
        )
        ->latest()
        ->get();
        return response()->json([
            'status' => true,
            'data' => $materials
        ]);
    }
    // upload materi

    public function store(Request $request)
    {
        // hanya guru
        if(Auth::user()->role != 'guru'){
            return response()->json([
                'status' => false,
                'message' =>
                    'Hanya guru yang dapat upload materi'
            ],403);
        }

        $request->validate([
            'classroom_id' =>
                'required|exists:classrooms,id',
            'title' =>
                'required|string|max:255',
            'description' =>
                'nullable|string|max:2000',
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
                    'materials',
                    'public'
                );
        }

        $material = Material::create([
            'classroom_id' =>
                $request->classroom_id,
            'teacher_id' =>
                Auth::id(),
            'title' =>
                $request->title,
            'description' =>
                $request->description,
            'file' =>
                $filePath

        ]);
        return response()->json([
            'status' => true,
            'message' => 'Materi berhasil diupload',
            'data' => $material
        ]);
    }

    public function destroy($id)
    {
        $material = Material::find($id);
        if(!$material){
            return response()->json([
                'status' => false
            ],404);
        }

        // hanya guru pemilik
        if($material->teacher_id != Auth::id()){
            return response()->json([
                'status' => false
            ],403);
}
        $material->delete();

        return response()->json([
            'status' => true,
            'message' =>
                'Materi berhasil dihapus'
        ]);
    }
}