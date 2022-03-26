<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'sendFaceData'])->name('login');
Route::post('/login/face', [App\Http\Controllers\Api\Auth\LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [App\Http\Controllers\Api\UserController::class, 'index']);
        Route::put('/', [App\Http\Controllers\Api\UserController::class, 'update']);
    });
    Route::apiResource('/quizzes', App\Http\Controllers\Api\Quiz\QuizController::class, ['only' => ['index', 'show']]);
    Route::apiResource('/takes', App\Http\Controllers\Api\Quiz\TakeController::class, ['only' => ['index', 'show']]);
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LogoutController::class, 'logout']);
    Route::get('/quizzes/{quiz_id}/start', [App\Http\Controllers\Api\Quiz\TakeController::class, 'start']);
    Route::post('/quizzes/{quiz_id}/finish', [App\Http\Controllers\Api\Quiz\TakeController::class, 'finish']);
});
