<?php

namespace App\VoteSystem\Repositories;

use App\VoteSystem\Models\Voter;
use Illuminate\Support\Facades\DB;

class VoterRepository
{
    public function aggregateVoterStatistics(): Voter
    {
        return Voter::first([
            DB::raw('count(*) as total'),
            DB::raw('count(used_at) AS used'),
            DB::raw('count(*) - count(used_at) as unused'),
        ]);
    }
}
