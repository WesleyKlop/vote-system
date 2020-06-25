<?php

/** @var Factory $factory */

use App\VoteSystem\Helpers\TokenHelper;
use App\VoteSystem\Models\Voter;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Voter::class,
    fn(Faker $faker) => [
        'id' => $faker->uuid,
        // 16 chars
        'token' => TokenHelper::generateToken(
            config('vote-system.token_length')
        ),
    ]
);
