<?php

namespace App\Services;

class Photo
{
    public $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function getPhoto($urn)
    {
        return $this->uri . '/' . $urn;
    }
}
