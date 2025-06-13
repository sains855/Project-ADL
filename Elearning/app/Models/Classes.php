<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'teacher_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
