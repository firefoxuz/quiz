<?php

namespace App\Repository\Admin\Quiz;

use App\Models\Quiz;
use App\Models\RandomQuestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentRandomQuestionRepository
{
    public function getQuestions($take_id)
    {
//        return response()->json(RandomQuestion::where('take_id', $take_id)->get());
        return RandomQuestion::where('take_id', $take_id)->get();
    }

    public function insertQuestions($random_questions)
    {
        return RandomQuestion::query()->insert($random_questions);
    }

    public function flushQuestions($take_id)
    {
        return RandomQuestion::where('take_id', $take_id)->delete();
    }
}
