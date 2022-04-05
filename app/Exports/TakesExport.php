<?php

namespace App\Exports;

use App\Models\Take;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TakesExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithStrictNullComparison
{
    public $quiz;
    public $statuses;

    public function __construct($quiz)
    {
        $this->statuses = __('data.take.statuses');
        $this->quiz = $quiz;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->handleQuery();
    }

    public function map($take): array
    {
        return [
            $take->user->first_name . ' ' . $take->user->last_name,
            $take->correct_answers,
            $this->statuses[$take->status],
            $take->starts_at,
            $take->ends_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A1:F1')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }

    public function headings(): array
    {
        return [
            __('data.excel.header.full_name'),
            __('data.excel.header.score'),
            __('data.excel.header.status'),
            __('data.excel.header.starts_at'),
            __('data.excel.header.ends_at'),
        ];
    }

    private function handleQuery()
    {
        $quiz = $this->quiz->where('id', $this->quiz->id)->with(['takes', 'takes.user'])->first();
        $takes = $quiz->takes;
        return $takes;
    }
}
