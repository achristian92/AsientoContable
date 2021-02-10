<?php

function isOpenRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'open' : $route;
    return $route;
}

function isActiveRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'active' : $route;
    return $route;
}

if (!function_exists('_add4NumRand')) {
    function _add4NumRand(String $string = "123456")
    {
        $text_without_spaces = str_replace(' ', '', $string);
        return strtolower($text_without_spaces.rand(1000,9999));
    }
}
