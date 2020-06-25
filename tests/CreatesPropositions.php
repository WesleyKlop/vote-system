<?php


namespace Tests;


use App\VoteSystem\Models\Proposition;

trait CreatesPropositions
{

    public function createProposition(string $type = 'list', int $verticalOptions = 4, int $horizontalOptions = 1): Proposition
    {
        return factory(Proposition::class)
            ->create([
                'type' => $type,
            ]);
    }
}
