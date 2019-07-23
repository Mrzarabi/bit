<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Grouping\Category::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'         => $faker->name(),
        'description'   => nullable($faker->text(255)),
        'logo'          => $faker->imageUrl($width = 640, $height = 480)
    ];
});

$factory->define(App\Models\Grouping\Subject::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'         => $faker->name(),
        'description'   => nullable($faker->text(255)),
        'logo'          => $faker->imageUrl($width = 640, $height = 480)
    ];
});
