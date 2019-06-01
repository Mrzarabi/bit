<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bank\BankCard::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'bank_name'       => $faker->name(),
        'bank_card'       => $faker->bankAccountNumber(),
        'code'            => $faker->bankAccountNumber(),
        'image_benk_card' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
