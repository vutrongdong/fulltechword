<?php

use Faker\Generator as Faker;

$factory->define(App\Repositories\LinkedSocialAccounts\LinkedSocialAccount::class, function (Faker $faker) {
    return [
    	'user_id' => 1,
        'provider_name' => 'facebook',
        'provider_id' => 'facebook123',
    ];
});
