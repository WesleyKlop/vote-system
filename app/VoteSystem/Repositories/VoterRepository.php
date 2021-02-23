<?php

namespace App\VoteSystem\Repositories;

use App\Models\Voter;
use App\VoteSystem\Domain\VoterStatistics;
use Illuminate\Support\Facades\DB;

class VoterRepository
{
    public function aggregateVoterStatistics(): VoterStatistics
    {
        $stats = Voter::firstOrFail([
            DB::raw('count(*) as total'),
            DB::raw('count(used_at) AS used'),
            DB::raw('count(*) - count(used_at) as unused'),
        ])->attributesToArray();

        return VoterStatistics::fromArray($stats);
    }
}
