<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'classroom_id',
        'teacher_id',
        'title',
        'description',
        'deadline',
        'file'
    ];

    // Relasi dengan Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
public function submissions()
{
    return $this->hasMany(Submission::class);
}
    
}