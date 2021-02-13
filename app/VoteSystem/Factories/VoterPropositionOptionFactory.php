<?php


namespace App\VoteSystem\Factories;


use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\Voter;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class VoterPropositionOptionFactory
{
    public static function make(Voter $voter, Proposition $proposition, Collection $answers): Collection
    {
        return $answers->map(
            fn (string $vertical, string $horizontal) => $proposition->type === 'grid'
                ? self::mapRow($voter->id, $proposition->id, $vertical, $horizontal)
                : self::mapRow($voter->id, $proposition->id, $horizontal, $vertical)
        );
    }

    protected static function mapRow(
        string $voterId,
        string $propositionId,
        string $horizontal,
        string $vertical
    ): array {
        return [
            'id' => Str::uuid(),
            'voter_id' => $voterId,
            'proposition_id' => $propositionId,
            'horizontal_option_id' => $horizontal,
            'vertical_option_id' => $vertical,
        ];
    }
}
