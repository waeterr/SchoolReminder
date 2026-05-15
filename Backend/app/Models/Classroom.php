<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'teacher_id',
        'name',
        'description',
        'class_code',
        'subject',
        'photo'];

    // Relasi dengan User (guru)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Relasi many-to-many dengan User (siswa)
    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    // Tambahkan relasi untuk tugas
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Tambahkan relasi untuk materi
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}