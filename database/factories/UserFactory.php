<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'first_name'                 => $faker->firstName(),
        'last_name'                  => $faker->lastName(),

        'national_code'              => $faker->numberBetween(00000, 99999),
        'phone_number'               => $faker->phoneNumber,
        'birthday'                   => $faker->dateTimeThisCentury->format('Y-m-d'),
        'address'                    => $faker->address,

        'email'                      => $faker->unique()->safeEmail,
        'email_verified_at'          => now(),
        'password'                   => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        
        'can_buy'                    => rand(0, 1),
        'avatar'                     => $faker->imageUrl(50, 50),

        'image_national_code'        => $faker->imageUrl(50, 50),
        'identify_certificate'       => $faker->imageUrl(50, 50),
        'image_bill'                 => $faker->imageUrl(50, 50),
        'image_selfie_national_code' => $faker->imageUrl(50, 50),

        'accept_image_national_code' => $faker->boolean(),
        'accept_identify_certificate'=> $faker->boolean(),
        'accept_image_bill'          => $faker->boolean(),
        'accept_image_selfie_national_code' => $faker->boolean(),

        'remember_token'             => str_random(10),
    ];
});
