<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(\App\Models\Manufacturer::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'category_id' => $faker->numberBetween(1,4),
    ];
});
