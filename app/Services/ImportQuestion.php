<?php

namespace App\Services;

use App\Repository\Admin\Quiz\EloquentImportQuestionRepository;

class ImportQuestion
{
    private $quiz_id;
    private $questions;

    public function __construct($quiz_id, $questions)
    {
        $this->questions = $questions;
        $this->quiz_id = $quiz_id;
    }

    public function handle()
    {
        $import_question_repository = new EloquentImportQuestionRepository();

        foreach ($this->questions as $question) {
            $import_question_repository->handle($this->quiz_id, $question);
        }
    }
}
