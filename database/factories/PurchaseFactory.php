<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'transactionId'     => $faker->sentence(),
        'refId'             => $faker->numberBetween(1000, 50000),

        'description'       => $faker->sentence(),
        'purchase'          => $faker->numberBetween(1000, 100000),
        'inventory'         => $faker->numberBetween(1000, 100000),
    ];
});
