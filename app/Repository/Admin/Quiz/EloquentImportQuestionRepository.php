<?php

namespace App\Repository\Admin\Quiz;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentImportQuestionRepository
{

    public function handle($quiz_id, array $data)
    {
        \DB::beginTransaction();
        try {
            $quiz = $this->insertQuestion([
                'quiz_id' => $quiz_id,
                'type' => $this->identifyType($data['answers']),
                'level' => 2,
                'content' => $data['question']]);
            $this->insertAnswers($this->prepareAttributes($quiz, $data['answers']));
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }


    private function identifyType($answers)
    {
        if (count($answers) == 1) {
            return 2;
        } elseif (count($answers) > 1) {
            return 1;
        }
    }

    private function insertQuestion(array $data)
    {
        return QuizQuestion::query()->create($data);
    }

    private function insertAnswers(array $data)
    {
        return QuizAnswer::query()->insert($data);
    }

    private function prepareAttributes(QuizQuestion $quiz_question, array $answers)
    {
        $data = [];

        foreach ($answers as $key => $answer) {
            $data[] = [
                'quiz_id' => $quiz_question->quiz_id,
                'question_id' => $quiz_question->id,
                'correct' => $answer['is_correct'],
                'content' => $answer['answer']
            ];
        }
        return $data;
    }
}
