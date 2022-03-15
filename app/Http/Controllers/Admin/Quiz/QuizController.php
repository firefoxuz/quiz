<?php

namespace App\Http\Controllers\Admin\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function index()
    {
        return view('quiz.index');
    }

    public function create()
    {
        return view('quiz.create');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('quiz.show', ['quiz' => $id]);
    }

    public function edit($quiz)
    {
        return view('quiz.edit', ['quiz' => $quiz]);
    }

}
