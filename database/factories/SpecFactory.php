<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Spec\Spec::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        //
    ];
});

$factory->define(App\Models\Spec\SpecHeader::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'title' => $faker->name(),
        'description' => $faker->realText()
    ];
});

$factory->define(App\Models\Spec\SpecRow::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    $multiple = $faker->numberBetween(0, 1);

    return [
        'title' => $faker->name(),
        'label' => $faker->name(),
        'values' => ($multiple) ? $faker->words(rand(1, 10)) : null,
        'help' => $faker->realText(),
        'multiple' => $multiple,
    ];
});

$factory->define(App\Models\Spec\SpecData::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        
    ];
});