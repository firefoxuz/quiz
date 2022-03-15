<?php

namespace App\Http\Livewire\Admin\QuizAnswer;

use App\Repository\Admin\Quiz\EloquentQuizAnswerRepository;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Livewire\Component;

class Edit extends Component
{

    public $quiz_id;
    public $question_id;
    public $answer_id;

    public $correct;
    public $content;


    protected $rules = [
        'correct' => 'nullable|boolean',
        'content' => 'required|min:1|string|max:1000',
    ];

    public function mount($quiz_id, $question_id, $answer_id)
    {
        $this->quiz_id = $quiz_id;
        $this->question_id = $question_id;
        $this->answer_id = $answer_id;
        $answer =  (new EloquentQuizAnswerRepository)->find($answer_id);
        $this->fill($answer->toArray());
    }


    public function create()
    {
        $data = $this->validate();

        DBTransaction::run(function () use ($data) {
            (new EloquentQuizAnswerRepository())->update([
                'correct' => $data['correct'] ? 1 : 0,
                'content' => $data['content'],
            ], $this->answer_id);

            SweetAlert::alertSuccess($this, 'updated successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->redirectRoute('quiz.show_question', [$this->quiz_id, $this->question_id]);
    }

    public function render()
    {
        return view('livewire.admin.quiz-answer.edit');
    }
}
