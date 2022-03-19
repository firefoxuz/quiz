<?php

namespace App\Services;

use App\Models\QuizQuestion;
use App\Repository\Admin\Quiz\EloquentRandomQuestionRepository;
use Illuminate\Database\Eloquent\Collection;

class RandomQuestion
{
    public function getRandomQuestion($quiz_id, $take_id , $limit): Collection
    {
        $questions = QuizQuestion::query()
            ->select([
                'id',
                'type',
                'content'
            ])
            ->where('quiz_id', $quiz_id)
            ->inRandomOrder()
            ->with('answers')
            ->limit($limit)
            ->get();

        $this->insertRandomQuestionsInDB($quiz_id, $take_id , $questions);

        return $questions;
    }

    public function getRandomQuestionFromDB($take_id)
    {

        $take = (new EloquentRandomQuestionRepository())->getQuestions($take_id);
        $questions = QuizQuestion::query()
            ->select([
                'id',
                'type',
                'content'
            ])
            ->with('answers')
            ->whereIn('id',$take->pluck('quiz_question_id'))
            ->get();
        return $questions;
    }

    private function  insertRandomQuestionsInDB($quiz_id, $take_id, $questions)
    {
        $random_questions = [];

        foreach ($questions as $question) {
            $random_questions[] = [
                'take_id' => $take_id,
                'quiz_question_id' => $question->id,
            ];
        }
        return (new EloquentRandomQuestionRepository())->insertQuestions($random_questions);
    }

    public function flushQuestions($take_id)
    {
        return (new EloquentRandomQuestionRepository())->flushQuestions($take_id);
    }
}
