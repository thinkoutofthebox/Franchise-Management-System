<?php

use App\StateCity;
use App\Course;

if (!function_exists('getStates')) {
    function getStates()
    {
        return StateCity::distinct()->get(['state']);
    }
}


if (!function_exists('getCourses')) {
    function getCourses()
    {
        return Course::all();
    }
}