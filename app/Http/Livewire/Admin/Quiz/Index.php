<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Repository\Admin\User\EloquentUserRepository;
use App\Services\DBTransaction;
use App\Services\Pagination;
use App\Services\SweetAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public function delete(int $id)
    {
        DBTransaction::run(function () use ($id) {
            (new EloquentQuizRepository())->delete($id);
            SweetAlert::alertSuccess($this, 'deleted successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });
    }

    public function render()
    {
        return view('livewire.admin.quiz.index', [
            'quizzes' => (new EloquentQuizRepository())->paginate(Pagination::perPage('quiz'))
        ]);
    }
}
