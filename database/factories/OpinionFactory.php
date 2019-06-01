<?php

use Faker\Generator as Faker;

$disadvantages = [
    [
        'dis'   => 'طراحی قالب ضعیف بود '
    ], [
        'dis'   => 'باگ سرور زیاد دارد '
    ], [
        'dis'   => 'خیلی خز بود'
    ], [
        'dis'   => 'طراحی داشبورد بسیار انیمیتیو بود که من حال نکردم'
    ]
];

$advantages = [
    [
        'adv'   => 'طراحی زیباد بود '
    ], [
        'adv'   => 'اصلا ارور نداشت'
    ], [
        'adv'   => 'خیلی دوست دارم سایتمو'
    ], [
        'adv'   => 'دمتون گرم'
    ], [
        'adv'   => 'داشبورد زیبا'
    ], [
        'adv'   => 'قالب فوقالعاده بود'
    ], [
        'adv'   => 'کارتون عالیه'
    ]
];

$factory->define(App\Models\Opinion\Comment::class, function (Faker $faker) {
    
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'message'    => $faker->sentence(),
        'is_accept'  => $faker->numberBetween(0, 1),
    ];
});

$factory->define(App\Models\Opinion\Review::class, function (Faker $faker) use ( $disadvantages, $advantages ) {
    $select_dis = rand(0 ,count( $disadvantages )-1 );
    $select_adv = rand(0 ,count( $advantages )-1 );
    
    return [
        'ranks'         => $faker->numberBetween(0, 50),
        'advantages'    => nullable( $advantages[$select_adv]['adv'] ),
        'disadvantages' => nullable( $disadvantages[$select_dis]['dis'] ),
        'message'       => $faker->sentence(),
        'is_accept'     => $faker->boolean(),
    ];
});
