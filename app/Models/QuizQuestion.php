<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    public const LEVELS = [
        1 => 'Easy',
        2 => 'Medium',
        3 => 'Hard',
    ];

    public const TYPES = [
        1 => 'Single Choice',
        2 => 'Input',
    ];

    protected $fillable = [
        'quiz_id',
        'type',
        'level',
        'content',
        'published',
    ];

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id', 'id');
    }


    public function take_answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id', 'id');
    }

}
