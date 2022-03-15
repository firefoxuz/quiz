<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Admin\BaseController;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\SweetAlert;

class QuizAnswerController extends BaseController
{
    public function addAnswer($quiz_id, $question_id)
    {
        return view('quiz_answer.add_answer',[
            'quiz_id' => $quiz_id,
            'question_id' => $question_id,
        ]);
    }

    public function editAnswer($quiz_id, $question_id, $answer_id)
    {
        return view('quiz_answer.edit',[
            'quiz_id' => $quiz_id,
            'question_id' => $question_id,
            'answer_id' => $answer_id,
        ]);
    }
}
