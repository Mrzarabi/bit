<?php

use Faker\Generator as Faker;

function nullable($field)
{
    return [null, $field][rand(0, 1)];
}

$factory->define(App\Models\Article\Article::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'         => $faker->name(),
        'description'   => nullable($faker->realText(255)),
        'body'          => $faker->realText(255),
        'image'         => $faker->imageUrl($width = 640, $height = 480)
    ];
});
