<?php

namespace Database\Factories;

use App\Models\Proposition;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropositionFactory extends Factory
{
    protected $model = Proposition::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->sentence,
            'is_open' => $this->faker->boolean,
            'order' => $this->faker->randomDigitNotNull,
            'type' => $this->faker->randomElement(['list', 'grid']),
        ];
    }
}
