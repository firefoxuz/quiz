<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'title' => $this->title,
            'summary' => $this->summary,
            'count' => $this->count,
            'attempts' => $this->attempts,
            'time_limit' => $this->time_limit,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'content' => $this->content
        ];
    }
}
