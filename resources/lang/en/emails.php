<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 2/10/2019
 * Time: 3:12 PM
 */

return [
    'verify_email' => [
        'title' => 'Email verification',
        'h1' => 'Click here to verify your account',
        'button' => 'Verify',
        'link' => 'If you can not click on button, please follow this link <br><a href=":link">:link</a>',
        'follow_us' => 'Follow us',
    ],
    'order_purchase' => [
        'title' => 'Successful purchase',
        'h1' => 'YOUR PURCHASE IS READY FOR DELIVERY',
        'h1_small' => 'Your order is processed and ready for delivery!',
        'order_detail' => 'Order details',

        'product' => [
            'name' => 'Name',
            'code' => 'Code',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ],

        'order_id' => 'Order ID',
        'purchased_date' => 'Date of purchase',
        'payment_method' => 'Payment type',

        'customer' => [
            'name' => 'First name',
            'surname' => 'Last name',
            'email' => 'E-mail',
            'phone' => 'Phone',
        ],

        'address' => [
            'delivery_address' => 'Delivery address',
            'address' => 'Address',
            'city' => 'City',
            'postal_code' => 'Postal code',
            'country' => 'Country',
        ],

        'subtotal_price' => 'Subtotal',
        'transport_and_delivery' => 'Transport and delivery',
        'total_price' => 'Total',
    ],
];