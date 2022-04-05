<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Exports\TakesExport;
use App\Models\Quiz;
use App\Models\Take;
use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Repository\Admin\User\EloquentUserRepository;
use App\Services\DBTransaction;
use App\Services\Pagination;
use App\Services\SweetAlert;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportToExcel(Quiz $quiz): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        return Excel::download(new TakesExport($quiz), $this->renderNameForExcel($quiz));
    }

    private function renderNameForExcel(Quiz $quiz): string
    {
        $now = Carbon::now();
        return "{$quiz->title} {$now->format('Y-m-d H:i:s')}.xlsx";
    }

    public function render()
    {
        return view('livewire.admin.quiz.index', [
            'quizzes' => (new EloquentQuizRepository())->paginate(Pagination::perPage('quiz'))
        ]);
    }
}
