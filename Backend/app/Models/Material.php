<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'classroom_id',
        'title',
        'description',
        'file'
    ];

// Tambahkan relasi dengan Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

// Tambahkan relasi dengan User (guru)
    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
}
