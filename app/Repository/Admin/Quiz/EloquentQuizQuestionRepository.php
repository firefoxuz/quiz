<?php

namespace App\Repository\Admin\Quiz;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentQuizQuestionRepository
{
    /**
     * Paginate all users
     * @return LengthAwarePaginator
     * @var int $count Number of users to be returned in one page
     */
    public function paginate(int $count)
    {
        return QuizQuestion::select([
            'id',
            'quiz_id',
            'type',
            'level',
            'published',
            'content',
        ])->paginate($count);
    }

    /**
     * Return all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return QuizQuestion::query()->select([
            'id',
            'quiz_id',
            'type',
            'level',
            'published',
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
        return QuizQuestion::query()->create($data);
    }

    /**
     * Update user by id
     * @param array $data Data to be updated
     * @param int $id User id
     * @return int
     */
    public function update(array $data, $id)
    {
        return QuizQuestion::query()->where('id', $id)->update($data);
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

        QuizAnswer::query()->where('question_id', $user->question_id)->delete();

        if (!$user->delete()) {
            throw new \Exception('can not delete a quiz');
        }

        return $user;
    }


    public function paginateByQuizId($quiz_id, int $count)
    {
        return QuizQuestion::select([
            'id',
            'quiz_id',
            'type',
            'level',
            'published',
            'content',
        ])->where('quiz_id', $quiz_id)->paginate($count);
    }

    /**
     * Find user by id
     * @param int $id User id
     * @return Model
     */
    public function find($id)
    {
        return QuizQuestion::query()->findOrFail($id);
    }

    public function hasAnswerForInputQuestion($question_id)
    {
        $question = $this->find($question_id);

        // Number 2 means that the question is input type
        if ($question->type != 2) {
            return false;
        }

        // If the question has answer, return true
        if ($question->answers->count() > 0) {
            return true;
        }

        return false;

    }

    public function changePublished($question_id)
    {
        $question = $this->find($question_id);

        if ($question->published == 1) {
            $question->published = 0;
        } else {
            $question->published = 1;
        }

        $question->save();

        return $question;
    }

}
