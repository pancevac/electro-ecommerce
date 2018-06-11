<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Gallery::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1,10),
        'gallery_image' => 'product0'.$faker->numberBetween(1,9).'.png',
    ];
});
