<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Ticket\Ticket::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'is_close' => $faker->numberBetween(0, 1),
    ];
});

$factory->define(App\Models\Ticket\TicketMessage::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'message' => $faker->sentence()
    ];
});
