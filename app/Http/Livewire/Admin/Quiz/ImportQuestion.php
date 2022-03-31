<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Carbon\Carbon;
use Livewire\Component;

class ImportQuestion extends Component
{
    protected $listeners = ['format'];

    public $quiz_id;

    public $questions;

    public function mount($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }

    public function format($questions)
    {
        $this->questions = $questions;

        $this->validate([
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.answer' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);
    }


    public function save()
    {
        $this->validate([
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.answer' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);

        DBTransaction::run(function () {
            $import = new \App\Services\ImportQuestion($this->quiz_id, $this->questions);
            $import->handle();
            SweetAlert::alertSuccess($this, 'imported successfully');
            $this->reset([
                'questions'
            ]);
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    public function render()
    {
        return view('livewire.admin.quiz.import-question');
    }
}
