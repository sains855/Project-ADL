<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'start_time',
        'end_time',
        'duration'
    ];

    /**
     * Relasi ke subject (mata pelajaran)
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relasi ke pertanyaan dalam kuis
     */
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
