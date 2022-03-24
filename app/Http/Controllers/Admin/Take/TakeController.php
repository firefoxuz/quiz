<?php

namespace App\Http\Controllers\Admin\Take;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($quiz_id)
    {
        return view('quiz.take.index',['quiz_id'=>$quiz_id]);
    }


    public function show($quiz_id,$take_id)
    {
        return view('quiz.take.show',['quiz_id'=>$quiz_id,'take_id'=>$take_id]);
    }
}
