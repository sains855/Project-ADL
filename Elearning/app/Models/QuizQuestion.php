<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'options',
        'correct'
    ];

    // Meng-cast kolom 'options' dari JSON ke array otomatis
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Relasi ke kuis
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Relasi ke jawaban siswa
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }
}
