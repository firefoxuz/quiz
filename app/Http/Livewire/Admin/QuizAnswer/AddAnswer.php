<?php

namespace App\Http\Livewire\Admin\QuizAnswer;

use App\Repository\Admin\Quiz\EloquentQuizAnswerRepository;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Livewire\Component;

class AddAnswer extends Component
{
    public $quiz_id;
    public $question_id;

    public $correct;
    public $content;

    protected $rules = [
        'correct' => 'nullable|boolean',
        'content' => 'required|min:1|string|max:1000',
    ];

    public function mount($quiz_id, $question_id)
    {
        $this->quiz_id = $quiz_id;
        $this->question_id = $question_id;
    }

    public function create()
    {
        $data = $this->validate();

        if ((new EloquentQuizQuestionRepository())->hasAnswerForInputQuestion($this->question_id)) {
            SweetAlert::alertError($this, 'This question already has an answer');
            return ;
        }


        DBTransaction::run(function () use ($data) {
            (new EloquentQuizAnswerRepository())->create([
                'quiz_id' => $this->quiz_id,
                'question_id' => $this->question_id,
                'correct' => $data['correct'] ? 1 : 0,
                'content' => $data['content'],
            ]);

            SweetAlert::alertSuccess($this, 'created successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->reset([
            'correct',
            'content',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.quiz-answer.add-answer');
    }
}
