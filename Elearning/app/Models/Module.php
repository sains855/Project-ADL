<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // Field yang boleh diisi mass-assignment
    protected $fillable = ['title', 'content', 'subject_id', 'created_by'];

    /**
     * Relasi ke Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relasi ke User (guru pembuat modul)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
