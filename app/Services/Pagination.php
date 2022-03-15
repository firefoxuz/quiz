<?php

namespace App\Services;

/**
 * Class Pagination
 * @package App\Services
 */
class Pagination
{
    /**
     * @return mixed
     * @var string $name The name of the pagination in config/pagination.php
     */
    public static function perPage(string $name)
    {
        if (config('pagination.pagination' . $name)) {
            return config('pagination.pagination' . $name);
        }

        return config('pagination.default', 15);
    }
}