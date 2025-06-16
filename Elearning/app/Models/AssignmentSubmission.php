<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'submitted_at',
        'file_url',
    ];

    /**
     * Relasi ke assignment
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * Relasi ke user (siswa yang mengumpulkan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

