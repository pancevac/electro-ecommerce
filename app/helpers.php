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

if (! function_exists('getLocalizedURL')) {
    /**
     * Helper for generating localized URLs
     *
     * @param $url
     * @param array $attributes
     * @return mixed
     */
    function getLocalizedURL($url, $attributes = []) {

        return \LaravelLocalization::getLocalizedURL(
            \LaravelLocalization::getCurrentLocale(),
            $url, // URL
            $attributes // Attributes for the url
        );
    }
}

if (! function_exists('getLocalizedRoute')) {
    /**
     * Helper for generating localized routes
     *
     * @param $routeTransKey
     * @param array $attributes
     * @return mixed
     */
    function getLocalizedRoute($routeTransKey, $attributes = []) {

        return \LaravelLocalization::getURLFromRouteNameTranslated(
            \LaravelLocalization::getCurrentLocale(),
            $routeTransKey, // route trans key from  "resource/lang/[language]/routes"
            $attributes // Attributes for the route
        );
    }
}

if (! function_exists('isLocalizedRoute')) {
    /**
     * Check if requested route match current route
     *
     * @param $routeTransKey    // route trans key from  "resource/lang/[language]/routes"
     * @return bool
     */
    function isLocalizedRoute($routeTransKey) {

        return request()->url() === getLocalizedRoute($routeTransKey);
    }
}

if (! function_exists('getCartItems')) {
    /**
     * Get list of cart items
     *
     * @param bool $asJon
     * @return array|mixed|string
     */
    function getCartItems($asJon = false) {
        return app('cartExtended')->getCartItems($asJon);
    }
}

if (! function_exists('getCartStatus')) {
    /**
     * @param $withMessage
     * @param bool $asJson
     * @return \Illuminate\Http\JsonResponse|array
     */
    function getCartStatus($withMessage, $asJson = true) {
        return app('cartExtended')->getCartStatus($withMessage, $asJson);
    }
}

if (! function_exists('getCartCount')) {
    /**
     * Return number of items in cart
     *
     * @return mixed
     */
    function getCartCount() {
        return app('cartExtended')->getCartCount();
    }
}

if (! function_exists('getTotalPrice')) {
    /**
     * Get the total price (calculated discounts) of the items in the cart.
     *
     * @param bool $format
     * @return mixed
     */
    function getTotalPrice($format = false) {
        return app('cartExtended')->getTotalPrice($format);
    }
}

if (! function_exists('getMinutesToTheNextHour')) {

    function getMinutesToTheNextHour() {

        return 0;
        //return Carbon::now()->diffInMinutes(Carbon::now()->addHour()->format('Y-m-d H:00:00'));
    }
}

if (! function_exists('sendMail')) {
    /**
     * Send mail, THIS IS ONLY FOR 000wehhosting, without, mail can be normally send.
     *
     * @param $to
     * @param $subject
     * @param $render
     */
    function sendMail($to, $subject, $render) {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        mail($to, $subject, $render, $headers);
    }
}