<?php

namespace Database\Factories;

use App\Models\Voter;
use App\VoteSystem\Helpers\TokenHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoterFactory extends Factory
{
    protected $model = Voter::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            // 16 chars
            'token' => TokenHelper::generateToken(
                config('vote-system.token_length')
            ),
        ];
    }
}
