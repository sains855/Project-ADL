<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'read_at',
        'created_at',
    ];

    public $timestamps = false; // karena kolom timestamp dikelola manual

    /**
     * Relasi ke user (penerima notifikasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
