<?php

namespace App\VoteSystem\Repositories;

use App\Events\VoterVoted;
use App\Models\Proposition;
use App\Models\VoterPropositionOption;
use Illuminate\Support\Carbon;
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

    public function findVotesBefore(Proposition $proposition, float $before): Collection
    {
        $dBefore = Carbon::createFromTimestampUTC($before);
        return $proposition
            ->answers()
            ->where('created_at', '<', $dBefore)
            ->groupBy(['proposition_id', 'horizontal_option_id', 'vertical_option_id'])
            ->select(['proposition_id', 'horizontal_option_id', 'vertical_option_id', DB::raw('count(*) as votes')])
            ->get();
    }
}
