<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Take extends Model
{
    use HasFactory;

    public const STATUSES = [
        1 => 'started',
        2 => 'finished',
    ];

    protected $fillable = [
        'user_id',
        'quiz_id',
        'correct_answers',
        'status',
        'content',
        'starts_at',
        'ends_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ApiUser::class);
    }

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
