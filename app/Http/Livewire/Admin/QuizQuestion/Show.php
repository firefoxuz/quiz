<?php

namespace App\Http\Livewire\Admin\QuizQuestion;

use App\Repository\Admin\Quiz\EloquentQuizAnswerRepository;
use App\Repository\Admin\Quiz\EloquentQuizQuestionRepository;
use App\Services\DBTransaction;
use App\Services\Pagination;
use App\Services\SweetAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $quiz_id;
    public $question_id;

    public function mount($quiz_id, $question_id)
    {
        $this->quiz_id = $quiz_id;
        $this->question_id = $question_id;
    }


    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentQuizAnswerRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    public function render()
    {
        return view('livewire.admin.quiz-question.show', [
            'answers' => (new EloquentQuizAnswerRepository())->paginateByQuizIdAndQuestionId($this->quiz_id, $this->question_id, Pagination::perPage('quiz_answers')),
        ]);
    }
}
