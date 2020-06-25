<?php

namespace Tests;

use App\VoteSystem\Models\Voter;

trait UsesVoters
{
    protected function voter(): Voter
    {
        return factory(Voter::class)->create();
    }
}
