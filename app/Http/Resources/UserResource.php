<?php

namespace App\Http\Resources;

use App\Repository\Admin\User\FaceData\EloquentFaceDataRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'photo' => $this->photo(),
            'email' => $this->email,
            'last_login' => $this->last_login,
            'registered_at' => $this->registered_at,
        ];
    }

    private function photo()
    {
        $face_data = (new EloquentFaceDataRepository())->findByUserId($this->id);
        if ($face_data) {
            return url('/') . '/' . $face_data->photo;
        }
        return null;
    }


}
