<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 1/29/2019
 * Time: 10:29 PM
 */

return [
    'routes' => [
        'dashboard' => 'customer/dashboard',
        'edit' => 'customer/edit',
        'update' => 'customer/update',
        'orders' => 'customer/orders',
        'order' => 'customer/order/{order}',
    ],

    'product' => 'product/{product}',
    'shop' => 'shop',

    'checkout' => 'checkout',
    'purchase' => 'purchase',

    'about' => 'about-us',
    'contact' => 'contact',
];