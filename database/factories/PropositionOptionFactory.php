<?php

namespace Database\Factories;

use App\Models\PropositionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropositionOptionFactory extends Factory
{
    protected $model = PropositionOption::class;

    public function vertical(): self
    {
        return $this->state(
            fn(array $attributes) => [
                'axis' => 'vertical',
            ]
        );
    }

    public function horizontal(): self
    {
        return $this->state(
            fn(array $attributes) => [
                'axis' => 'horizontal',
            ]
        );
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'option' => $this->faker->words(3, true),
        ];
    }
}
