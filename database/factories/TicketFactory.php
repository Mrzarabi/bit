<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Ticket\Ticket::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'    => $faker->name(),
        'is_close' => $faker->numberBetween(0, 1),
        'status'   => $faker->numberBetween(0, 3),
    ];
});

$factory->define(App\Models\Ticket\TicketMessage::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title'   => $faker->name(),
        'message' => $faker->sentence()
    ];
});