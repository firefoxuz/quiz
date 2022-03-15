<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use Barryvdh\Debugbar\Controllers\BaseController;

class QuizQuestionController extends BaseController
{

    public function addQuestion($id)
    {
        return view('quiz_question.add_question', ['quiz' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($quiz_id, $question_id)
    {
        return view('quiz_question.show', ['quiz_id' => $quiz_id, 'question_id' => $question_id]);
    }

    public function editQuestion($quiz_id, $question_id)
    {
        return view('quiz_question.edit', ['quiz_id' => $quiz_id, 'question_id' => $question_id]);
    }


}
