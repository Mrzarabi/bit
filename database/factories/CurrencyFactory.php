<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Currency\Currency::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'                 => $faker->name(),
        'short_description'     => nullable($faker->realText(255)),
        'short_description'     => nullable($faker->realText(255)),
        'price'                 => $faker->numberBetween(1000, 500000),
        'inventory'             => $faker->numberBetween(1, 500000),
        'status'                => $faker->numberBetween(0, 1),
        'photo'                 => $faker->imageUrl($width = 640, $height = 480),
        'code'                  => $faker->numberBetween(1, 500000)
    ];
});
