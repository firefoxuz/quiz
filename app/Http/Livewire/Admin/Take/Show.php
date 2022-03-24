<?php

namespace App\Http\Livewire\Admin\Take;

use App\Repository\Admin\Quiz\EloquentTakeAnswerRepository;
use App\Repository\Admin\Quiz\EloquentTakeRepository;
use Livewire\Component;

class Show extends Component
{
    public $take_id;
    public $quiz_id;

    public function mount($quiz_id, $take_id)
    {
        $this->quiz_id = $quiz_id;
        $this->take_id = $take_id;
    }

    public function render()
    {
        return view('livewire.admin.take.show', [
            'take' => (new EloquentTakeRepository())->find($this->take_id),
            'questions' => (new EloquentTakeAnswerRepository())->all($this->take_id),
        ]);
    }
}
