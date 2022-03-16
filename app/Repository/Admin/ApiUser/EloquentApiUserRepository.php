<?php

namespace App\Repository\Admin\ApiUser;

use App\Models\ApiUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentApiUserRepository implements IUserRepository
{
    /**
     * Paginate all users
     * @return LengthAwarePaginator
     * @var int $count Number of users to be returned in one page
     */
    public function paginate(int $count)
    {
        return ApiUser::select([
            'id',
            'first_name',
            'last_name',
            'phone',
            'email',
            'registered_at',
        ])->paginate($count);
    }

    /**
     * Return all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ApiUser::query()->select([
            'id',
            'first_name',
            'last_name',
            'phone',
            'email',
            'registered_at',
        ])->get();
    }

    /**
     * Create a new user
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return ApiUser::query()->create($data);
    }

    /**
     * Update user by id
     * @param array $data Data to be updated
     * @param int $id User id
     * @return int
     */
    public function update(array $data, $id)
    {
        return ApiUser::query()->where('id', $id)->update($data);
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
        return ApiUser::query()->findOrFail($id);
    }

    public function findWithFaceData($id)
    {
        return ApiUser::query()->select([
            'id',
            'first_name',
            'last_name',
            'phone',
            'email',
            'registered_at',
            'last_login'
        ])
            ->where('id', $id)
            ->with('photos')
            ->find($id);
    }

}
