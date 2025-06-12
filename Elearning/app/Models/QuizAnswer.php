<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'answer',
        'is_correct'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Relasi ke pertanyaan kuis
     */
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    /**
     * Relasi ke user (siswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
