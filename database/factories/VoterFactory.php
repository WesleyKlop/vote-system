<?php

/** @var Factory $factory */

use App\Voter;
use App\VoteSystem\Helpers\TokenHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Voter::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        // 16 chars
        'token' => TokenHelper::generateToken(
            config('vote-system.token_length')
        ),
    ];
});
