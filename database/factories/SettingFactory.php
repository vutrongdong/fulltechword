<?php

use Faker\Generator as Faker;

$factory->define(FTW\Repositories\Settings\Setting::class, function (Faker $faker) {
    return [
        'title'       => $faker->name,
        'keywords'    => implode($faker->words(10, false), ', '),
        'description' => $faker->text(200),
        'name'        => $faker->company,
        'address'     => $faker->address,
        'phone'       => $faker->phoneNumber,
        'email'       => $faker->email,
        'tax_number'  => '32349394',
        'bank'        => "Nguyen Van A\nNgan hang ngoai thuong Vietcombank\n0211000123456",
        'about'       => $faker->text(200),
        'facebook'    => 'https://www.facebook.com/',
        'instagram'   => 'https://www.instagram.com/',
        'zalo'        => 'https://chat.zalo.me/',
    ];
});
