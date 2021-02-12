<?php

/** @var Factory $factory */

use App\VoteSystem\Models\Proposition;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Proposition::class,
    fn (Faker $faker) => [
        'id' => $faker->uuid,
        'title' => $faker->sentence,
        'is_open' => $faker->boolean,
        'order' => $faker->randomDigitNotNull,
        'type' => $faker->randomElement(['list', 'grid']),
    ]
);
