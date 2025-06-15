<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;


class Module extends Model
{
    use HasFactory;

    // Field yang boleh diisi mass-assignment
    protected $fillable = ['title', 'content','file_path', 'class_id', 'created_by'];

    /**
     * Relasi ke Subject
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    /**
     * Relasi ke User (guru pembuat modul)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

}
