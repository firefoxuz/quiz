<?php

namespace App\Http\Controllers\Api\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\TakeQuestionCollection;
use App\Http\Resources\TakeResource;
use App\Models\Quiz;
use App\Models\Take;
use App\Repository\Admin\Quiz\EloquentTakeRepository;
use App\Services\AnswerChecker;
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
 *                "quiz_id": "1",
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
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer',
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
}
