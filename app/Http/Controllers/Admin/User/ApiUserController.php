<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\ApiUser;
use Illuminate\Http\Request;

class ApiUserController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.api_user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('user.api_user.create');
    }

    public function show( ApiUser $api_user)
    {
        return view('user.api_user.update', [
            'api_user_id' => $api_user->id
        ]);
    }
}
