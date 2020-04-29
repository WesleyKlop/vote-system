<?php

/** @var Factory $factory */

use App\Voter;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Voter::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        // 16 chars
        'token' => $faker->unique()->lexify('????????????????'),
    ];
});
