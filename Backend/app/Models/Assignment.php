<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Tambahkan import ini

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

    // Tambahkan is_submitted ke dalam output JSON secara otomatis
    protected $appends = ['is_submitted'];

    /**
     * Logic untuk menentukan apakah siswa yang login sudah mengumpulkan tugas ini
     */
    public function getIsSubmittedAttribute()
    {
        // Jika tidak ada user login (auth), return false
        if (!Auth::check()) {
            return false;
        }

        // Cek keberadaan data di tabel submissions milik user yang sedang login
        return $this->submissions()
            ->where('student_id', Auth::id())
            ->exists();
    }

    // Relasi dengan Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Relasi dengan Submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}