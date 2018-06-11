<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->text('300'),
        'details' => $faker->text('300'),
        'image' => 'product0'.$faker->numberBetween(1,10).'.png',
        'price' => $faker->numerify('###'),
        'category_id' => $faker->numberBetween(1,4),
        'manufacturer_id' => $faker->numberBetween(1,4),
        'featured' => $faker->numberBetween(0,1),
    ];
});
