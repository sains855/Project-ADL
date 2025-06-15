<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'teacher_id', 'description'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function moduls()
    {
        return $this->hasMany(Modul::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id')
                    ->where('role', 'student');
    }

}
