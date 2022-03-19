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
use Illuminate\Validation\Rule;

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
                'take' => $new_take,
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
