<?php

/** @var Factory $factory */

use App\VoteSystem\Models\PropositionOption;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    PropositionOption::class,
    fn(Faker $faker) => [
        'id' => $faker->uuid,
        'option' => $faker->words(3, true),
    ]
);

$factory->state(PropositionOption::class, 'vertical', [
    'axis' => 'vertical',
]);

$factory->state(PropositionOption::class, 'horizontal', [
    'axis' => 'horizontal',
]);
