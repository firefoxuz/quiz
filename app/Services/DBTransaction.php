<?php


namespace App\Services;


class DBTransaction
{
    /**
     * @var callable $try
     * @var callable $catch
     */
    public static function run(callable $try, callable $catch)
    {
        \DB::beginTransaction();
        try {
            call_user_func($try);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            call_user_func($catch, $e);
        }
    }
}