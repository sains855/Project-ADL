<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'teacher_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }
}
