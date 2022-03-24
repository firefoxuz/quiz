<?php

namespace App\Services;

use App\Models\TakeAnswer as Model;

class TakeAnswer
{
    private int $take_id;
    private int $user_id;
    private array $answers;
    private array $quiz_answers;


    public function __construct($take_id, $user_id, $answers)
    {
        $this->take_id = $take_id;
        $this->user_id = $user_id;
        $this->answers = $answers;

    }

    public function setQuizAnswers($quiz_answers): void
    {
        $this->quiz_answers = $quiz_answers;
    }

    public function insertIntoDB()
    {
        return Model::insert($this->prepareAttributes());
    }

    private function prepareAttributes(): array
    {
        $quiz_answers = $this->quiz_answers;

        $attr = [];
        foreach ($this->answers as $answer) {
            if (array_key_exists($answer['question_id'], $quiz_answers)) {
                $attr[] = [
                    'take_id' => $this->take_id,
                    'question_id' => $answer['question_id'],
                    'answer_id' => $answer['answer_id'] ?? null,
                    'content' => $answer['content'] ?? null,
                ];
                unset($quiz_answers[$answer['question_id']]);
            }
        }

        foreach ($quiz_answers as $answer) {
            $attr[] = [
                'take_id' => $this->take_id,
                'question_id' => $answer['question_id'],
                'answer_id' => null,
                'content' => null,
            ];
        }

        return $attr;
    }
}
