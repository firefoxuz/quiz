<?php

namespace App\Repository\Admin\Quiz;

use App\Models\ApiUser;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Take;
use App\Models\TakeAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentTakeAnswerRepository
{
    /**
     * Return all users
     * @return array
     */
    public function all($takeId): array
    {
        $arr = [];

        $take_answers = TakeAnswer::query()
            ->select([
                'question_id',
                'answer_id',
                'content',
            ])
            ->where('take_id', $takeId)
            ->get();

        $quiz_questions = QuizQuestion::query()
            ->select([
                'id',
                'type',
                'content',
            ])
            ->whereIn('id', $take_answers->pluck('question_id'))
            ->with('answers')
            ->get();

        foreach ($take_answers as $take_answer) {
            $quiz_question = $quiz_questions->where('id', $take_answer->question_id)->first();
            $correct_answer = $this->getCorrectAnswer($quiz_question->type, $quiz_question->answers);
            $arr[] = [
                'question' => $quiz_question->content,
                'type' => $quiz_question->type,
                'user_answer' => $this->getAnswerContent($quiz_question->type, $take_answer, $quiz_question),
                'answers' => $quiz_question->answers->toArray(),
                'is_correct' => $this->isCorrect($quiz_question->type, $correct_answer, $take_answer)
            ];
        }

        return $arr;
    }

    private function getAnswerContent($type, $take_answer, $quiz_question)
    {
        if ($type == 2) {
            return $take_answer->content;
        } else {
            if ($take_answer->answer_id)
                return $quiz_question->answers->where('id', $take_answer->answer_id)->first()->content;
            else
                return '';
        }
    }

    private function getCorrectAnswer($type, $answers)
    {
        foreach ($answers as $answer) {
            if ($answer->correct) {
                if ($type == 1) {
                    return $answer->id;
                } else {
                    return $answer->content;
                }
            }
        }
        return '';
    }

    private function isCorrect($type, $correct_answer, $take_answer): bool
    {
        if ($type == 1) {
            return $correct_answer == $take_answer->answer_id;
        } else {
            return $correct_answer == $take_answer->content;
        }
    }
}
