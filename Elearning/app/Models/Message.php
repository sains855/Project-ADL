<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'sent_at'
    ];

    public $timestamps = false; // kita menggunakan sent_at secara manual

    /**
     * Relasi ke pengguna yang mengirim pesan
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relasi ke pengguna yang menerima pesan
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
