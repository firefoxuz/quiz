<?php

namespace App\Http\Controllers\Api\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizCollection;
use App\Models\Quiz;
use App\Repository\Admin\Quiz\EloquentQuizRepository;
use App\Services\Pagination;
use App\Traits\ApiResponser;

/**
 * @OA\Examples(
 *        summary="VehicleStoreEx1",
 *        example = "VehicleStoreEx1",
 *       value = {
 *         },
 *      ),
 * @OA\Schemas (
 *   @OA\Schema(
 *     schema="Quiz",
 *     type="object",
 *     example={
 *    "data": {
 *        {
 *            "id": 2,
 *            "title": "Ingliz tili ",
 *            "summary": "Ingliz tili ",
 *            "count": 25,
 *            "attempts": 2,
 *            "time_limit": 50,
 *            "starts_at": "2022-03-16 00:00:00",
 *            "ends_at": "2022-03-19 00:00:00",
 *            "created_at": "2022-03-12T05:43:09.000000Z",
 *            "updated_at": "2022-03-12T05:43:09.000000Z",
 *            "content": "Ingliz tili  Ingliz tili  Ingliz tili "
 *        },
 *        {
 *            "id": 1,
 *            "title": "Matematika",
 *            "summary": "Matematika",
 *            "count": 10,
 *            "attempts": 1,
 *            "time_limit": 30,
 *            "starts_at": "2022-03-12 00:00:00",
 *            "ends_at": "2022-03-19 00:00:00",
 *            "created_at": "2022-03-12T04:51:03.000000Z",
 *            "updated_at": "2022-03-12T04:55:16.000000Z",
 *            "content": "Matematika Matematika Matematika"
 *        }
 *    },
 *    "links": {
 *        "self": "link-value",
 *        "first": "http://quiz.uz/api/quizzes?page=1",
 *        "last": "http://quiz.uz/api/quizzes?page=1",
 *        "prev": null,
 *        "next": null
 *    },
 *    "meta": {
 *        "current_page": 1,
 *        "from": 1,
 *        "last_page": 1,
 *        "links": {
 *            {
 *                "url": null,
 *                "label": "&laquo; Previous",
 *                "active": false
 *            },
 *            {
 *                "url": "http://quiz.uz/api/quizzes?page=1",
 *                "label": "1",
 *                "active": true
 *            },
 *            {
 *                "url": null,
 *                "label": "Next &raquo;",
 *                "active": false
 *            }
 *        },
 *        "path": "http://quiz.uz/api/quizzes",
 *        "per_page": 15,
 *        "to": 2,
 *        "total": 2
 *    }
 *}
 * ),
 * @OA\Schemas (
 *   @OA\Schema(
 *     schema="QuizShow",
 *     type="object",
 *     example={
 *       "status": "success",
 *       "message": null,
 *       "data": {
 *           "id": 1,
 *           "title": "Matematika",
 *           "summary": "Matematika",
 *           "count": 50,
 *           "attempts": 1,
 *           "time_limit": 30,
 *           "starts_at": "2022-03-16 00:00:00",
 *           "ends_at": "2022-03-19 00:00:00",
 *           "content": "Matematika Matematika Matematika",
 *           "created_at": "2022-03-16T16:27:16.000000Z",
 *           "updated_at": "2022-03-16T16:27:16.000000Z"
 *       }
 *}
 * ),
 *     ),
 * @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 * ),
 * @OA\Get(
 *     summary="Get list of Quizzes",
 *     path="/api/quizzes",
 *     description="Get list of Quizzes",
 *     tags={"Quiz"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Successful operation",
 *      @OA\JsonContent(
 *     type="object",
 *     ref="#/components/schemas/Quiz"
 * ),
 *      ),
 *     ),
 * ),
 * ),
 *
 * @OA\Get(
 *     summary="Get one Quiz",
 *     path="/api/quizzes/{id}",
 *     description="Get specific quiz",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          @OA\Schema(
 *
 *         type="integer"),
 *          required=true,
 *     ),
 *     tags={"Quiz"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Successful operation",
 *      @OA\JsonContent(
 *     type="object",
 *     ref="#/components/schemas/QuizShow"
 * ),
 *      ),
 *     ),
 * ),
 * )
 */
class QuizController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return QuizCollection
     */
    public function index()
    {
        return new QuizCollection((new EloquentQuizRepository())->paginate(Pagination::perPage('quizzes')));
    }

    public function show(Quiz $quiz)
    {
        return $this->success($quiz);
    }
}
