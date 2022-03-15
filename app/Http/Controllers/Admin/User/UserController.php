<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('user.create');
    }

}
