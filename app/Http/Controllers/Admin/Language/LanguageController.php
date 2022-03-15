<?php


namespace App\Http\Controllers\Admin\Language;


use App\Http\Controllers\Admin\BaseController;
use App\Services\Language\Language;

class LanguageController extends BaseController
{
    public function setLanguage($name)
    {
        Language::set($name);
        return redirect()->route('home');
    }
}