<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Currency\Currency::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'         => $faker->name(),
        'description'   => nullable($faker->realText(255)),
        'price'         => $faker->numberBetween(1000, 500000),
        'inventory'     => $faker->numberBetween(1, 500000),
        'image'         => nullable($faker->imageUrl($width = 640, $height = 480))
    ];
});
