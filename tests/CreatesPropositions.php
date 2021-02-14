<?php

namespace Tests;

use App\Models\Proposition;
use App\Models\PropositionOption;
use Database\Factories\PropositionOptionFactory;
use Illuminate\Support\Collection;

trait CreatesPropositions
{
    protected function makePropositions(int $amount, string $axis): Collection
    {
        return PropositionOption::factory()
            ->count($amount)
            ->{$axis}()
            ->make();
    }

    protected function createProposition(
        string $type = 'list',
        int $verticalOptions = 4,
        int $horizontalOptions = 1
    ): Proposition {
        /** @var PropositionOptionFactory $propositionOptionFactory */
        $propositionOptionFactory = PropositionOption::factory();
        return Proposition::factory()
            ->has(
                $propositionOptionFactory->count($verticalOptions)->vertical(),
                'options'
            )
            ->has(
                $propositionOptionFactory
                    ->count($horizontalOptions)
                    ->horizontal(),
                'options'
            )
            ->createOne([
                'type' => $type,
                'is_open' => true,
            ]);
    }
}
