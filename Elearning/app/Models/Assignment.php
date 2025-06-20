<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'module_id','class_id', 'due_date', 'user_id'];

    /**
     * Relasi ke subject
     */
    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

        public function classes()
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * Relasi ke submissions (pengumpulan tugas)
     */
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
