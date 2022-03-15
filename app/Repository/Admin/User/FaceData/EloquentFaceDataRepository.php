<?php

namespace App\Repository\Admin\User\FaceData;

use App\Models\ApiUser;
use App\Models\User;
use App\Models\UserFaceData;
use App\Repository\Admin\User\IUserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentFaceDataRepository implements IUserRepository
{
    /**
     * Paginate all users
     * @return LengthAwarePaginator
     * @var int $count Number of users to be returned in one page
     */
    public function paginate(int $count)
    {
        return UserFaceData::select([
            'user_id',
            'photo',
            'model',
        ])->paginate($count);
    }

    /**
     * Return all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return UserFaceData::query()->select([
            'user_id',
            'photo',
            'model',
        ])->get();
    }

    /**
     * Create a new user
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return UserFaceData::query()->create($data);
    }

    /**
     * Update user by id
     * @param array $data Data to be updated
     * @param int $id User id
     * @return int
     */
    public function update(array $data, $id)
    {
        return UserFaceData::query()->where('id', $id)->update($data);
    }

    /**
     * Delete user by id
     * @param int $id User id
     * @return Model
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $user = $this->find($id);

        if (!$user->delete()) {
            throw new \Exception('can not delete a user');
        }

        return $user;
    }

    /**
     * Find user by id
     * @param int $id User id
     * @return Model
     */
    public function find($id)
    {
        return UserFaceData::query()->findOrFail($id);
    }

}
