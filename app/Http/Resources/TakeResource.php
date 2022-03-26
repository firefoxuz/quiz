<?php

namespace App\Http\Resources;

use App\Models\Take;
use App\Repository\Admin\Quiz\EloquentQuizRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TakeResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quiz' => new QuizResource((new EloquentQuizRepository())->find($this->quiz_id)),
            'status' => Take::STATUSES[$this->status],
            'content' => $this->content,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'created_at' => $this->created_at,
        ];
    }
}
