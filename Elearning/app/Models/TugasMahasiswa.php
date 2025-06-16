<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tugas_mahasiswa';
    protected $fillable = [
        'modul_id',
        'mahasiswa_id',
        'file_path',
    ];

}

