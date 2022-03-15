<?php

namespace App\Repository\Admin\Quiz;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentQuizAnswerRepository
{
    /**
     * Paginate all users
     * @return LengthAwarePaginator
     * @var int $count Number of users to be returned in one page
     */
    public function paginate(int $count)
    {
        return QuizAnswer::select([
            'id',
            'quiz_id',
            'question_id',
            'correct',
            'content'
        ])->paginate($count);
    }

    /**
     * Return all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return QuizAnswer::query()->select([
            'id',
            'quiz_id',
            'question_id',
            'correct',
            'content'
        ])->get();
    }

    /**
     * Create a new user
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return QuizAnswer::query()->create($data);
    }

    /**
     * Update user by id
     * @param array $data Data to be updated
     * @param int $id User id
     * @return int
     */
    public function update(array $data, $id)
    {
        return QuizAnswer::query()->where('id', $id)->update($data);
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
        return QuizAnswer::query()->findOrFail($id);
    }

    public function paginateByQuizIdAndQuestionId($quiz_id, $question_id, int $count)
    {
        return QuizAnswer::select([
            'id',
            'quiz_id',
            'question_id',
            'correct',
            'content'
        ])
            ->where('quiz_id', $quiz_id)
            ->where('question_id', $question_id)
            ->paginate($count);
    }
}