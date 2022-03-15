<?php


namespace App\Services\Language;


use App;
use App\Exceptions\Language\InvalidLanguageException;

class Language
{
    /**
     * @return void
     * @var string $language_name
     */
    public static function set($language_name)
    {
        self::validate($language_name);
        App::setLocale($language_name);
        session(['locale' => $language_name]);
    }

    /**
     * @param string $language_name
     * @return void
     * @throws InvalidLanguageException
     */
    private static function validate(string $language_name)
    {
        if (!key_exists($language_name, config('lang'))) {
            throw new InvalidLanguageException('invalid language name passed');
        }
    }
}