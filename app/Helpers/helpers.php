<?php

use Carbon\Carbon;

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

if (!function_exists('customerID')) {
    function customerID()
    {
        return (int) request()->segment(3);
    }
}

function formatDate(string $date = null)
{
    if ($date === null)
        return '';

    return Carbon::parse($date)->format('d/m/y');
}

function flatten($array) {
    $result = [];
    foreach ($array as $item) {
        if (is_array($item)) {
            $result[] = array_filter($item, function($array) {
                return ! is_array($array);
            });
            $result = array_merge($result, flatten($item));
        }
    }
    return array_filter($result);
}
