<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'class_id'];

    // Relasi ke kelas (asumsi model-nya bernama SchoolClass)
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    // Relasi ke modul
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // Relasi ke tugas
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Relasi ke kuis
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}

