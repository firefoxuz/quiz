<?php

namespace App\Http\Livewire\Admin\Quiz;

use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Services\DBTransaction;
use App\Services\SweetAlert;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $quiz_id;

    public string $title = '';
    public string $summary = '';
    public int $count = 0;
    public int $time_limit = 30;
    public int $attempts = 1;
    public string $starts_at = '';
    public string $ends_at = '';
    public string $content = '';

    protected $rules = [
        'title' => 'required|min:5|max:75',
        'summary' => 'nullable|min:5|max:255',
        'starts_at' => 'required|date|date_format:d.m.Y',
        'count' => 'required|integer|min:1|max:100',
        'time_limit' => 'required|integer|min:1|max:120',
        'attempts' => 'required|integer|min:1|max:5',
        'ends_at' => 'required|date|after:starts_at|date_format:d.m.Y',
        'content' => 'required|min:3|string|max:1000',
    ];

    public function mount($quiz)
    {
        $this->quiz_id = $quiz;
        $quiz = (new EloquentQuizRepository())->find($this->quiz_id);
        $quiz->starts_at = Carbon::parse($quiz->starts_at)->format('d.m.Y');
        $quiz->ends_at = Carbon::parse($quiz->ends_at)->format('d.m.Y');
        $this->fill($quiz->toArray());
    }

    public function create()
    {
        $data = $this->validate();

        DBTransaction::run(function () use ($data) {
            (new EloquentQuizRepository())->update([
                'title' => $data['title'],
                'summary' => $data['summary'],
                'count' => $data['count'],
                'time_limit' => $data['time_limit'],
                'attempts' => $data['attempts'],
                'starts_at' => Carbon::createFromFormat('d.m.Y', $data['starts_at'])->minute(0)->hours(0)->seconds(0)->toDateTimeString(),
                'ends_at' => Carbon::createFromFormat('d.m.Y', $data['ends_at'])->minute(0)->hours(0)->seconds(0)->toDateTimeString(),
                'content' => $data['content'],
            ], $this->quiz_id);
            SweetAlert::alertSuccess($this, 'updated successfully');
        }, function ($exception) {
            SweetAlert::alertError($this, $exception->getMessage());
        });

        $this->redirectRoute('quizzes.index');
    }


    public function render()
    {
        return view('livewire.admin.quiz.edit');
    }
}
