<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomQuestion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'take_id',
        'quiz_question_id'
    ];
}
