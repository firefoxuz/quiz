<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'type',
        'count',
        'attempts',
        'time_limit',
        'starts_at',
        'ends_at',
        'content',
    ];
}
