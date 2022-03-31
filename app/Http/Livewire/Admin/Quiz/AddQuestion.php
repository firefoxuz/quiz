<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Models\QuizQuestion;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Livewire\Component;

class AddQuestion extends Component
{
    public $quiz_id;

    public $type;
    public $level;
    public $content;

    protected $rules = [
        'type' => 'required|integer|min:0|max:3',
        'level' => 'required|integer|min:1|max:3',
        'content' => 'required|min:3|string|max:1000',
    ];

    public function mount($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }


    public function create()
    {
        $question = null;
        $data = $this->validate();

        DBTransaction::run(function () use ($data, $question) {
            $question = (new EloquentQuizQuestionRepository())->create([
                'quiz_id' => $this->quiz_id,
                'type' => $data['type'],
                'level' => $data['level'],
                'content' => $data['content'],
            ]);

            $this->redirectToQuestionAnswers($question);
            SweetAlert::alertSuccess($this, 'created successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->reset([
            'type',
            'level',
            'content',
        ]);
    }


    public function redirectToQuestionAnswers(QuizQuestion $question)
    {
        $this->redirectRoute('quiz.store_answer', [
            'quiz_id' => $this->quiz_id,
            'question_id' => $question->id,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.quiz.add-question', [
            'types' => QuizQuestion::TYPES,
            'levels' => QuizQuestion::LEVELS,
        ]);
    }
}
