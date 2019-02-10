<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 1/29/2019
 * Time: 10:29 PM
 */

return [
    'customer' => [
        'dashboard' => 'moj-nalog',
        'edit' => 'izmena-naloga',
        'update' => 'azuriranje-naloga',
        'orders' => 'porudzbine',
        'order' => 'porudzbine/{order}',
    ],

    'product' => 'proizvodi/{category}/{manufacturer}/{product}/{code}',
    'shop' => 'shop',

    'checkout' => 'checkout',
    'purchase' => 'naplati',

    'about' => 'o-nama',
    'contact' => 'kontakt',

    'login' => 'prijava',
    'logout' => 'odjava',
    'register' => 'registracija',
    'register-verify' => 'registracija/validacija',
    'register-verify-resend' => 'registracija/validacija/ponovno-slanje',
];