<?php

namespace MyApp\helpers;

class Request
{

    /**
     * Returns query param if exists
     *
     * @param string $param
     * @return string|null
     */
    public static function getQueryParam(string $param): ?string
    {
        return $_GET[$param];
    }

}