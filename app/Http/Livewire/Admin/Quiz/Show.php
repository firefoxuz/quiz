<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Models\QuizQuestion;
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

    public function mount($quiz)
    {
        $this->quiz_id = $quiz;
    }

    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentQuizQuestionRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    public function render()
    {
        return view('livewire.admin.quiz.show', [
            'questions' => (new EloquentQuizQuestionRepository())->paginateByQuizId($this->quiz_id, Pagination::perPage('quiz_questions')),
            'types' => QuizQuestion::TYPES,
            'levels' => QuizQuestion::LEVELS,
        ]);
    }
}
