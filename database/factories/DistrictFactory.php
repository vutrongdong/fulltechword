<?php

use Faker\Generator as Faker;

$factory->define(FTW\Repositories\Districts\District::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city_id' => 1,
        'slug' => $faker->name,
        'zipcode' => 100000,
        'order' => 1,
        'status' => 1
    ];
});
