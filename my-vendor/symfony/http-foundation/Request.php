<?php

namespace Symfony\Component\HttpFoundation;

class Request
{
    protected static $httpMethodParameterOverride = false;

    public static function enableHttpMethodParameterOverride()
    {
        self::$httpMethodParameterOverride = true;
    }
}
