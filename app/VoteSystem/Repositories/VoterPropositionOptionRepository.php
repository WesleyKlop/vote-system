<?php

namespace App\VoteSystem\Repositories;

use App\Events\VoterVoted;
use App\Models\VoterPropositionOption;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VoterPropositionOptionRepository
{
    public function create(Collection $voterPropositionOptions): bool
    {
        DB::beginTransaction();
        $success = $voterPropositionOptions
            ->map(fn (VoterPropositionOption $option) => $option->save())
            ->every(fn (bool $result) => $result === true);

        if ($success === true) {
            event(new VoterVoted($voterPropositionOptions->values()));
        }

        DB::commit();
        return $success;
    }
}
