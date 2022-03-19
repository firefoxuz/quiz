<?php

namespace App\Services;

class AnswerChecker
{
    const CORRECT_ANSWER = 1;
    private int $take_id;
    private int $quiz_id;
    private array $answers;
    private array $quiz_answers;

    public int $correct_answers = 0;

    public function __construct(int $take_id, int $quiz_id, array $answers)
    {
        $this->take_id = $take_id;
        $this->quiz_id = $quiz_id;
        $this->answers = $answers;

        $this->check();

        return $this->correct_answers;
    }

    public function getQuizAnswers()
    {
        return $this->quiz_answers;
    }

    private function check(): void
    {
        $this->quiz_answers = $answers = $this->getAnswersFromDB();

        foreach ($this->answers as $answer) {
            if (array_key_exists($answer['question_id'], $answers)) {
                if ($this->isCorrectAnswer($answer, $answers[$answer['question_id']]))
                    $this->correct_answers++;
            }
        }
    }


    private function getAnswersFromDB(): array
    {
        $answers = [];

        $random_questions = (new RandomQuestion())->getRandomQuestionFromDB($this->take_id);

        foreach ($random_questions as $random_question) {
            $answers[$random_question->id] = [
                'type' => $random_question->type,
                'question_id' => $random_question->id,
                'answer_id' => $random_question->answers->where('correct', self::CORRECT_ANSWER)->first()->id,
                'content' => $random_question->answers->first()->content,
            ];
        }
        return $answers;
    }

    private function isCorrectAnswer($user_answer, $answer): bool
    {
        // Single choice question
        if ($answer['type'] == 1) {
            return ($user_answer['answer_id'] ?: 1) == $answer['answer_id'];
        }

        return trim(($user_answer['content'] ?: '')) == trim($answer['content']);
    }

}
