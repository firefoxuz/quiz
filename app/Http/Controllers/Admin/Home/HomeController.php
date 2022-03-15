<?php


namespace App\Http\Controllers\Admin\Home;


use App\Http\Controllers\Admin\BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        \Log::info(app()->getLocale());
    }

    public function index()
    {
        return view('home.index');
    }
}