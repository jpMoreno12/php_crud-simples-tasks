<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'status'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
