<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bank\BankCard::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'bank_name'                 => $faker->name(),
        'bank_card'                 => $faker->bankAccountNumber(),
        'code'                      => $faker->bankAccountNumber(),
        'image_bank_card'           => $faker->imageUrl(50, 50),
        'accept_image_bank_card'    => $faker->boolean(0, 1),
    ];
});
