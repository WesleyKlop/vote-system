<?php

namespace App\VoteSystem\Helpers;

use App\VoteSystem\Models\Proposition;
use App\VoteSystem\Models\PropositionOption;
use Illuminate\Support\Collection;

final class PropositionHelper
{
    public static function getListQuestion(
        Proposition $proposition
    ): PropositionOption {
        return $proposition->horizontalOptions()->first();
    }

    public static function getListOptions(Proposition $proposition): Collection
    {
        return $proposition->verticalOptions();
    }

    public static function getOptionCount(
        Proposition $proposition,
        PropositionOption $vertical,
        PropositionOption $horizontal = null
    ): int {
        $answers = $proposition->answers->where(
            'vertical_option_id',
            $vertical->id
        );

        if (!is_null($horizontal)) {
            $answers = $answers->where('horizontal_option_id', $horizontal->id);
        }

        return $answers->count();
    }
}
