<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'subject_id', 'due_date'];

    /**
     * Relasi ke subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relasi ke submissions (pengumpulan tugas)
     */
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
