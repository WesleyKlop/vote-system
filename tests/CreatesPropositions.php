<?php

namespace Tests;

use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;
use Illuminate\Support\Collection;

trait CreatesPropositions
{
    protected function makePropositions(int $amount, string $axis): Collection
    {
        return factory(PropositionOption::class, $amount)
            ->state($axis)
            ->make();
    }

    protected function createProposition(
        string $type = 'list',
        int $verticalOptions = 4,
        int $horizontalOptions = 1
    ): Proposition {
        /** @var Proposition $proposition */
        $proposition = factory(Proposition::class)->create([
            'type' => $type,
            'is_open' => true,
        ]);

        $options = [
            ...$this->makePropositions($verticalOptions, 'vertical')->toArray(),
            ...$this->makePropositions(
                $horizontalOptions,
                'horizontal'
            )->toArray(),
        ];

        $proposition->options()->createMany($options);

        return $proposition;
    }
}
