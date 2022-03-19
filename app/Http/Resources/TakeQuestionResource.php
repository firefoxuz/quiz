<?php

namespace App\Http\Resources;

use App\Models\QuizQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class TakeQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type_id' => $this->type,
            'type' => QuizQuestion::TYPES[$this->type],
            'content' => $this->content,
            'answers' => $this->when($this->type == 1, new TakeQuestionAnswerCollection($this->answers))
        ];
    }
}
