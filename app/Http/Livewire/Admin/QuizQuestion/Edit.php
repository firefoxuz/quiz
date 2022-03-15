<?php

namespace App\Http\Livewire\Admin\QuizQuestion;

use App\Models\QuizQuestion;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Livewire\Component;

class Edit extends Component
{
    public $quiz_id;
    public $question_id;


    public $type;
    public $level;
    public $content;

    protected $rules = [
        'level' => 'required|integer|min:1|max:3',
        'content' => 'required|min:3|string|max:1000',
    ];

    public function mount($quiz_id, $question_id)
    {
        $this->quiz_id = $quiz_id;
        $this->question_id = $question_id;
        $question = (new EloquentQuizQuestionRepository())->find($question_id);

        $this->fill($question->toArray());

    }

    public function create()
    {
        $data = $this->validate();

        DBTransaction::run(function () use ($data) {
            (new EloquentQuizQuestionRepository())->update([
                'level' => $data['level'],
                'content' => $data['content'],
            ], $this->question_id);
            SweetAlert::alertSuccess($this, 'updated successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->redirectRoute('quizzes.show', $this->quiz_id);
    }

    public function render()
    {
        return view('livewire.admin.quiz-question.edit', [
            'types' => QuizQuestion::TYPES,
            'levels' => QuizQuestion::LEVELS,
        ]);
    }
}
