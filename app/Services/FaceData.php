<?php

namespace App\Services;

use App\Models\ApiUser;
use App\Repository\Admin\ApiUser\EloquentApiUserRepository;

class FaceData
{
    public function getRandomFaceModels($user_id, $limit = 10)
    {
        $user = (new EloquentApiUserRepository())->findWithFaceData($user_id);


        $face_models[] = [
            'full_name' => $user->last_name . ' ' . $user->first_name,
            'face_token' => $this->generateFaceToken($user->id, $user->email, $user->last_login),
            'description' => $this->modelsToJSON($user->photos()->select('model')->get()),
        ];

        return $face_models;
    }

    private function modelsToJSON($models)
    {
        $arr = [];
        foreach ($models as $model) {
            $arr[] = json_decode($model->model);
        }

        return $arr;
    }

    private function generateFaceToken($user_id, $user_email, $user_last_login): string
    {
        return $user_id . '|' . md5($user_email . '|' . $user_last_login);
    }

    public function validateFaceToken($user_id, $face_token): bool
    {
        $user = (new EloquentApiUserRepository())->find($user_id);

        return $this->generateFaceToken($user->id, $user->email, $user->last_login) === $face_token;
    }
}
