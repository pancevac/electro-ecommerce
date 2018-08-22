<?php
/**
 * Created by PhpStorm.
 * User: sile
 * Date: 16.5.18.
 * Time: 15.38
 */
function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
}

function calculateDiscountPrice($price, $percent_off)
{
    return $price - (($percent_off / 100) * $price);
}

function newProducts($time)
{
    if ($time->gt(\Carbon\Carbon::now()->subDays(setting('site.timeday')))) {
        return true;
    }
}

function getMinutesToTheNextHour()
{
    return \Carbon\Carbon::now()->diffInMinutes(\Carbon\Carbon::now()->addHour()->format('Y-m-d H:00:00'));
}