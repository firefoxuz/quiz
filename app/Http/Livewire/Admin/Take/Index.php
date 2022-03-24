<?php

namespace App\Http\Livewire\Admin\Take;

use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Repository\Admin\Quiz\EloquentTakeRepository;
use App\Services\Pagination;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $quiz_id;

    public function mount($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }

    public function render()
    {
        return view('livewire.admin.take.index', [
            'takes' => (new EloquentTakeRepository())->paginateQuizTakes($this->quiz_id, Pagination::perPage('take'))
        ]);
    }
}
