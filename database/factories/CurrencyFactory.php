<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Currency\Currency::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'                 => $faker->name(),
        'short_description'     => nullable($faker->realText(255)),
        'price'                 => $faker->numberBetween(1000, 500000),
        'inventory'             => $faker->numberBetween(1, 500000),
        'status'                => $faker->numberBetween(0, 1),
        'code'                  => $faker->numberBetween(1, 500000),
        'photo'                 => $faker->imageUrl(50, 50),
    ];
});
