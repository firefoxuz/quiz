<?php

use App\Services\RandomQuestion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', ['App\Http\Controllers\Admin\User\Login\LoginController', 'index'])->name('auth.login');
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);


Route::group(['middleware' => ['auth', 'disable.caching.on.local']], function () {
    Route::get('/', ['App\Http\Controllers\Admin\Home\HomeController', 'index'])->name('home');
    Route::get('/language/{name}', ['App\Http\Controllers\Admin\Language\LanguageController', 'setLanguage'])->name('lang');

    // Show,Store and Edit questions routes
    Route::get('/quizzes/{quiz_id}/questions/{question_id}', ['App\Http\Controllers\Admin\Quiz\QuizQuestionController', 'show'])->name('quiz.show_question');
    Route::get('/quizzes/{quiz_id}/store_question', ['App\Http\Controllers\Admin\Quiz\QuizQuestionController', 'addQuestion'])->name('quiz.store_question');
    Route::get('/quizzes/{quiz_id}/questions/{question_id}/edit_question', ['App\Http\Controllers\Admin\Quiz\QuizQuestionController', 'editQuestion'])->name('quiz.edit_question');

    // Store and Edit answers routes
    Route::get('/quizzes/{quiz_id}/questions/{question_id}/store_answer', ['App\Http\Controllers\Admin\Quiz\QuizAnswerController', 'addAnswer'])->name('quiz.store_answer');
    Route::get('/quizzes/{quiz_id}/questions/{question_id}/answers/{answer_id}/edit_answer', ['App\Http\Controllers\Admin\Quiz\QuizAnswerController', 'editAnswer'])->name('quiz.edit_answer');

    // Api Users routes

    Route::get('/api_users/face_data/{user_id}', ['App\Http\Controllers\Admin\User\FaceDataController', 'show'])->name('api_users.face_data.show');

    //Resource routes
    Route::resource('/quizzes', 'App\Http\Controllers\Admin\Quiz\QuizController');
    Route::resource('/user', 'App\Http\Controllers\Admin\User\UserController', ['only' => ['index', 'create']]);
    Route::resource('/api_users', 'App\Http\Controllers\Admin\User\ApiUserController', ['only' => ['index', 'create', 'show',]]);
    Route::resource('/face_api', 'App\Http\Controllers\Admin\User\FaceDataController', ['only' => ['index', 'create']]);
});

Route::get('/test', function () {
    return (new RandomQuestion)->getRandomQuestion(1, 10);
});
