<?php


namespace App\Http\Controllers\Admin\User\Login;


use App\Http\Controllers\Admin\BaseController;

class LoginController extends BaseController
{
    /**
     * Login page
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.login.index');
    }
}