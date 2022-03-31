<?php

namespace App\Http\Controllers\Api\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\TakeCollection;
use App\Http\Resources\TakeQuestionCollection;
use App\Http\Resources\TakeResource;
use App\Models\Quiz;
use App\Models\Take;
use App\Repository\Admin\Quiz\EloquentTakeRepository;
use App\Services\AnswerChecker;
use App\Services\Pagination;
use App\Services\RandomQuestion;
use App\Services\TakeAnswer;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @OA\Schemas (
 *   @OA\Schema(
 *     schema="QuizStart",
 *     type="object",
 *     example={
 *        "status": "success",
 *        "message": null,
 *        "data": {
 *            "take": {
 *                "quiz": {
 *                      "id": 1,
 *                      "title": "Matematika",
 *                      "summary": "Matematika Matematika",
 *                      "count": 30,
 *                      "attempts": 100,
 *                      "time_limit": 30,
 *                      "starts_at": "2022-03-17 22:20:42",
 *                      "ends_at": "2022-03-31 22:20:46",
 *                      "content": "Matematika Matematika Matematika"
 *                      },
 *                "user_id": 1,
 *                "status": 1,
 *                "content": "",
 *                "starts_at": "2022-03-23 21:35:06",
 *                "ends_at": "2022-03-23 22:05:06",
 *                "updated_at": "2022-03-23T16:35:06.000000Z",
 *                "created_at": "2022-03-23T16:35:06.000000Z",
 *                "id": 10
 *            },
 *            "questions": {
 *                {
 *                    "id": 4,
 *                    "type_id": 2,
 *                    "type": "Input",
 *                    "content": "5 + 6 = ?"
 *                },
 *                {
 *                    "id": 2,
 *                    "type_id": 1,
 *                    "type": "Single Choice",
 *                    "content": "20 + 6 = ?",
 *                    "answers": {
 *                        {
 *                            "id": 2,
 *                            "content": "26"
 *                        },
 *                        {
 *                            "id": 3,
 *                            "content": "20"
 *                        },
 *                        {
 *                            "id": 4,
 *                            "content": "31"
 *                        },
 *                        {
 *                            "id": 5,
 *                            "content": "25"
 *                        }
 *                    }
 *                },
 *                {
 *                    "id": 1,
 *                    "type_id": 1,
 *                    "type": "Single Choice",
 *                    "content": "5 + 6 = ?",
 *                    "answers": {
 *                        {
 *                            "id": 6,
 *                            "content": "11"
 *                        },
 *                        {
 *                            "id": 7,
 *                            "content": "12"
 *                        },
 *                        {
 *                            "id": 8,
 *                            "content": "14"
 *                        }
 *                    }
 *                }
 *            }
 *        }
 *      }
 *      ),
 *  @OA\Schema(
 *   schema="QuizFinishBody",
 *   type="object",
 *  example={
 *        "take_id": 11,
 *        "answers" : {
 *            {
 *                "question_id": 1,
 *                "answer_id": 6,
 *            },
 *            {
 *                "question_id": 2,
 *                "answer_id": 2
 *            },
 *             {
 *                "question_id": 3,
 *                "content": "hello world"
 *            }
 *        }
 * }
 * ),
 *  @OA\Schema(
 *   schema="Take",
 *   type="object",
 *  example={
 *        {
 *            "data": {
 *                {
 *                    "id": 1,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 3,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 18:44:23",
 *                    "ends_at": "2022-03-19 19:14:23",
 *                    "created_at": "2022-03-19T13:44:23.000000Z"
 *                },
 *                {
 *                    "id": 2,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 18:54:22",
 *                    "ends_at": "2022-03-19 19:24:22",
 *                    "created_at": "2022-03-19T13:54:22.000000Z"
 *                },
 *                {
 *                    "id": 3,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 2,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 19:07:51",
 *                    "ends_at": "2022-03-19 19:37:51",
 *                    "created_at": "2022-03-19T14:07:51.000000Z"
 *                },
 *                {
 *                    "id": 4,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 2,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 19:18:29",
 *                    "ends_at": "2022-03-19 19:48:29",
 *                    "created_at": "2022-03-19T14:18:29.000000Z"
 *                },
 *                {
 *                    "id": 5,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 20:58:31",
 *                    "ends_at": "2022-03-19 21:28:31",
 *                    "created_at": "2022-03-19T15:58:31.000000Z"
 *                },
 *                {
 *                    "id": 6,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 21:00:41",
 *                    "ends_at": "2022-03-19 21:30:41",
 *                    "created_at": "2022-03-19T16:00:41.000000Z"
 *                },
 *                {
 *                    "id": 7,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 21:01:59",
 *                    "ends_at": "2022-03-19 21:31:59",
 *                    "created_at": "2022-03-19T16:01:59.000000Z"
 *                },
 *                {
 *                    "id": 8,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 21:03:38",
 *                    "ends_at": "2022-03-19 21:33:38",
 *                    "created_at": "2022-03-19T16:03:38.000000Z"
 *                },
 *                {
 *                    "id": 9,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 2,
 *                    "content": "",
 *                    "starts_at": "2022-03-19 21:10:30",
 *                    "ends_at": "2022-03-19 21:40:30",
 *                    "created_at": "2022-03-19T16:10:30.000000Z"
 *                },
 *                {
 *                    "id": 10,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 2,
 *                    "content": "",
 *                    "starts_at": "2022-03-23 21:35:06",
 *                    "ends_at": "2022-03-23 22:05:06",
 *                    "created_at": "2022-03-23T16:35:06.000000Z"
 *                },
 *                {
 *                    "id": 11,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 2,
 *                    "content": "",
 *                    "starts_at": "2022-03-23 22:19:00",
 *                    "ends_at": "2022-03-23 22:49:00",
 *                    "created_at": "2022-03-23T17:19:00.000000Z"
 *                },
 *                {
 *                    "id": 12,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 1,
 *                    "content": "",
 *                    "starts_at": "2022-03-24 15:15:39",
 *                    "ends_at": "2022-03-24 15:45:39",
 *                    "created_at": "2022-03-24T10:15:39.000000Z"
 *                },
 *                {
 *                    "id": 13,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 1,
 *                    "content": "",
 *                    "starts_at": "2022-03-24 18:59:35",
 *                    "ends_at": "2022-03-24 19:29:35",
 *                    "created_at": "2022-03-24T13:59:35.000000Z"
 *                },
 *                {
 *                    "id": 14,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": null,
 *                    "starts_at": "2022-03-23 22:14:25",
 *                    "ends_at": "2022-03-24 22:22:25",
 *                    "created_at": null
 *                },
 *                {
 *                    "id": 15,
 *                    "quiz": {
 *                        "id": 1,
 *                        "title": "Matematika",
 *                        "summary": "Matematika Matematika",
 *                        "count": 30,
 *                        "attempts": 100,
 *                        "time_limit": 30,
 *                        "starts_at": "2022-03-17 22:20:42",
 *                        "ends_at": "2022-03-31 22:20:46",
 *                        "content": "Matematika Matematika Matematika"
 *                    },
 *                    "status": "finished",
 *                    "correct_answers": 0,
 *                    "content": null,
 *                    "starts_at": "2022-03-23 22:14:25",
 *                    "ends_at": "2022-03-24 22:22:25",
 *                    "created_at": null
 *                }
 *            },
 *            "links": {
 *                "first": "http://quiz.uz/api/take?page=1",
 *                "last": "http://quiz.uz/api/take?page=2",
 *                "prev": null,
 *                "next": "http://quiz.uz/api/take?page=2"
 *            },
 *            "meta": {
 *                "current_page": 1,
 *                "from": 1,
 *                "last_page": 2,
 *                "links": {
 *                    {
 *                        "url": null,
 *                        "label": "&laquo; Previous",
 *                        "active": false
 *                    },
 *                    {
 *                        "url": "http://quiz.uz/api/take?page=1",
 *                        "label": "1",
 *                        "active": true
 *                    },
 *                    {
 *                        "url": "http://quiz.uz/api/take?page=2",
 *                        "label": "2",
 *                        "active": false
 *                    },
 *                    {
 *                        "url": "http://quiz.uz/api/take?page=2",
 *                        "label": "Next &raquo;",
 *                        "active": false
 *                    }
 *                },
 *                "path": "http://quiz.uz/api/take",
 *                "per_page": 15,
 *                "to": 15,
 *                "total": 17
 *            }
 *        }
 * }
 * ),
 *  @OA\Schema(
 *   schema="TakeShow",
 *   type="object",
 *  example={
 *        {
 *            "data": {
 *                "id": 1,
 *                "quiz": {
 *                    "id": 1,
 *                    "title": "Matematika",
 *                    "summary": "Matematika Matematika",
 *                    "count": 30,
 *                    "attempts": 100,
 *                    "time_limit": 30,
 *                    "starts_at": "2022-03-17 22:20:42",
 *                    "ends_at": "2022-03-31 22:20:46",
 *                    "content": "Matematika Matematika Matematika"
 *                },
 *                "status": "finished",
 *                "correct_answers": 3,
 *                "content": "",
 *                "starts_at": "2022-03-19 18:44:23",
 *                "ends_at": "2022-03-19 19:14:23",
 *                "created_at": "2022-03-19T13:44:23.000000Z"
 *            }
 *        }
 * }
 * ),
 *   ),
 * @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 * ),
 * @OA\Post(
 *     summary="Finish specific quiz",
 *     path="/api/quizzes/{id}/finish",
 *     description="Finish specific quiz",
 *     @OA\Parameter(
 *      name="id",
 *      in="path",
 *      @OA\Schema(type="integer"),
 *      required=true,
 *     ),
 *     tags={"Quiz"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/QuizFinishBody"
 *      ),
 *     ),
 *     @OA\Response(
 *      response="200",
 *      description="You have no attempts",
 *          @OA\JsonContent(
 *         type="object",
 *          example={
 *        "status": "success",
 *        "message": null,
 *        "data": {
 *            "id": 11,
 *            "user_id": 1,
 *            "quiz_id": 1,
 *            "correct_answers": 2,
 *            "status": 2,
 *            "starts_at": "2022-03-23 22:19:00",
 *            "ends_at": "2022-03-23 22:49:00",
 *            "content": "",
 *            "created_at": "2022-03-23T17:19:00.000000Z",
 *            "updated_at": "2022-03-23T17:19:15.000000Z"
 *        }
 *        }
 *          ),
 *      ),
 *     @OA\Response(
 *      response="404",
 *      description="You have no attempts",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="error"),
 *              @OA\Property(property="message", type="string", example="Quiz allready has finished"),
 *              @OA\Property(property="data", type="null", example="null")
 *          ),
 *      ),
 * ),
 * @OA\Get(
 *     summary="Start specific quiz",
 *     path="/api/quizzes/{id}/start",
 *     description="Start specific quiz",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          @OA\Schema(type="integer"),
 *          required=true,
 *     ),
 *     tags={"Quiz"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Successful",
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/QuizStart"
 *          ),
 *      ),
 *     @OA\Response(
 *      response="404",
 *      description="You have no attempts",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="error"),
 *              @OA\Property(property="message", type="string", example="You have no attempts"),
 *              @OA\Property(property="data", type="null", example="null")
 *          ),
 *      ),
 *     @OA\Response(
 *      response="403",
 *      description="Test not started yet",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="error"),
 *              @OA\Property(property="message", type="string", example="Test not started yet"),
 *              @OA\Property(property="data", type="null", example="null")
 *          ),
 *      ),
 *     @OA\Response(
 *      response="402",
 *      description="Test allready finished",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="error"),
 *              @OA\Property(property="message", type="string", example="Test allready finished"),
 *              @OA\Property(property="data", type="null", example="null")
 *          ),
 *      ),
 * ),
 *
 * @OA\Get(
 *     summary="Get user takes",
 *     path="/api/takes",
 *     description="Get user takes",
 *     tags={"Take"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Successful",
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/Take"
 *          ),
 *      ),
 * ),
 * @OA\Get(
 *     summary="Retrieve specific quiz",
 *     path="/api/takes/{id}",
 *     description="Retrieve specific quiz",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          @OA\Schema(type="integer"),
 *          required=true,
 *     ),
 *     tags={"Take"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *      response="200",
 *      description="Successful",
 *          @OA\JsonContent(
 *              type="object",
 *              ref="#/components/schemas/TakeShow"
 *          ),
 *      ),
 *     @OA\Response(
 *      response="404",
 *      description="You have no attempts",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="error"),
 *              @OA\Property(property="message", type="string", example="Take not found"),
 *              @OA\Property(property="data", type="null", example="null")
 *          ),
 *      ),

 * ),
 */
class TakeController extends Controller
{
    use ApiResponser;

    public function start($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $take = Take::where('quiz_id', $quiz_id)->where('user_id', auth()->user()->id)->get();

        $started_take = $take->where('status', 1)->first();

        if (Carbon::createFromTimeString($quiz->starts_at)->diffInSeconds(Carbon::now(), false) < 0) {
            return $this->error('Test not started yet', 403);
        }

        if (Carbon::createFromTimeString($quiz->ends_at)->diffInSeconds(Carbon::now(), false) > 0) {
            return $this->error('Test allready finished', 403);
        }


        if ($started_take != null) {
            return $this->success([
                'take' => new TakeResource($started_take),
                'questions' => new TakeQuestionCollection((new RandomQuestion())->getRandomQuestionFromDB($started_take->id)),
            ]);
        }


        if ($take->count() < $quiz->attempts) {

            $new_take = (new EloquentTakeRepository())->create([
                'quiz_id' => $quiz_id,
                'user_id' => auth()->user()->id,
                'status' => 1,
                'content' => '',
                'starts_at' => Carbon::now()->toDateTimeString(),
                'ends_at' => Carbon::now()->addMinutes($quiz->time_limit)->toDateTimeString(),
            ]);

            return $this->success([
                'take' => new TakeResource($new_take),
                'questions' => new TakeQuestionCollection((new RandomQuestion())->getRandomQuestion($quiz_id, $new_take->id, $quiz->count))
            ]);
        }

        return $this->error('You have no attempts', 404);
    }

    public function finish(Request $request, $quiz_id)
    {

        $this->validate($request, [
            'take_id' => 'required|integer|exists:takes,id',
            'answers' => 'nullable|array',
            'answers.*.question_id' => 'required_with:answers.*.answer_id,answers.*.content|integer',
            'answers.*.answer_id' => 'nullable|exists:quiz_answers,id|integer',
            'answers.*.content' => 'required_without:answers.*.answer_id|nullable',
        ]);

        $quiz = Quiz::findOrFail($quiz_id);
        $take = Take::where('id', $request->take_id)->where('quiz_id', $quiz_id)->where('status', 1)->where('user_id', auth()->user()->id)->first();

        if ($take == null) {
            return $this->error('Quiz allready has finished', 404);
        }

        $checker = new AnswerChecker($take->id, $take->user_id, $request->answers);

        $take->correct_answers = $checker->correct_answers;
        $take->status = 2;
        $take->save();

        $take_answers = new TakeAnswer($take->id, $take->user_id, $request->answers);
        $take_answers->setQuizAnswers($checker->getQuizAnswers());
        $take_answers->insertIntoDB();

        (new RandomQuestion())->flushQuestions($take->id);

        return $this->success($take);

    }

    public function index()
    {
        $takes = Take::where('user_id', auth()->user()->id)->paginate(Pagination::perPage('takes'));

        return new TakeCollection($takes);
    }

    public function show($take)
    {
        $take = Take::where('id', $take)->where('user_id', auth()->user()->id)->first();

        if ($take == null) {
            return $this->error('Take not found', 404);
        }

        return new TakeResource($take);
    }

}
