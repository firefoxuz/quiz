<?php

namespace App\Repository\Admin\Quiz;

use App\Models\ApiUser;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentQuizRepository
{
    /**
     * Paginate all users
     * @return LengthAwarePaginator
     * @var int $count Number of users to be returned in one page
     */
    public function paginate(int $count)
    {
        return Quiz::select([
            'id',
            'title',
            'summary',
            'count',
            'attempts',
            'time_limit',
            'starts_at',
            'ends_at',
            'created_at',
            'updated_at',
            'content',
        ])
            ->orderBy('id', 'desc')
            ->paginate($count);
    }

    /**
     * Return all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Quiz::query()->select([
            'id',
            'title',
            'summary',
            'count',
            'attempts',
            'time_limit',
            'starts_at',
            'ends_at',
            'created_at',
            'updated_at',
            'content',
        ])->get();
    }

    /**
     * Create a new user
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return Quiz::query()->create($data);
    }

    /**
     * Update user by id
     * @param array $data Data to be updated
     * @param int $id User id
     * @return int
     */
    public function update(array $data, $id)
    {
        return Quiz::query()->where('id', $id)->update($data);
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
            throw new \Exception('can not delete a quiz');
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
        return Quiz::query()->findOrFail($id);
    }
}
