<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 1/29/2019
 * Time: 10:29 PM
 */

return [
    'customer' => [
        'dashboard' => 'customer/dashboard',
        'edit' => 'customer/edit',
        'update' => 'customer/update',
        'orders' => 'customer/orders',
        'order' => 'customer/order/{order}',
    ],

    'product' => 'products/{category}/{manufacturer}/{product}/{code}',
    'shop' => 'shop',

    'checkout' => 'checkout',
    'purchase' => 'purchase',

    'about' => 'about-us',
    'contact' => 'contact',

    'login' => 'login',
    'logout' => 'logout',
    'register' => 'register',
    'register-verify' => 'register/verify',
    'register-verify-resend' => 'register/verify/resend',

    'cart' => 'cart',
    'wish_list' => 'wish-list',
];